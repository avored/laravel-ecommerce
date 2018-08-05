<?php

namespace AvoRed\Ecommerce;

use Illuminate\Support\ServiceProvider;
use AvoRed\Ecommerce\Models\Database\Country;
use AvoRed\Ecommerce\Models\Database\Page;
use Carbon\Carbon;
use Laravel\Passport\Passport;
use Laravel\Passport\Console\KeysCommand;
use AvoRed\Ecommerce\Shipping\FreeShipping;
use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\InstallCommand;
use AvoRed\Ecommerce\Http\Middleware\AdminApiAuth;
use AvoRed\Ecommerce\Http\Middleware\SiteCurrencyMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use AvoRed\Framework\Widget\Facade as WidgetFacade;
use AvoRed\Framework\Payment\Facade as PaymentFacade;
use AvoRed\Framework\Shipping\Facade as ShippingFacade;
use AvoRed\Framework\Breadcrumb\Facade as BreadcrumbFacade;
use AvoRed\Framework\Permission\Facade as PermissionFacade;
use AvoRed\Framework\AdminConfiguration\Facade as AdminConfigurationFacade;
use AvoRed\Ecommerce\Payment\Stripe\Payment as StripePayment;
use AvoRed\Ecommerce\Widget\TotalUser\Widget as TotalUserWidget;
use AvoRed\Ecommerce\Widget\TotalOrder\Widget as TotalOrderWidget;
//View Composers
use AvoRed\Ecommerce\Http\ViewComposers\ProductFieldsComposer;
use AvoRed\Ecommerce\Http\ViewComposers\SiteCurrencyFieldsComposer;
use AvoRed\Ecommerce\Http\ViewComposers\CategoryFieldsComposer;
use AvoRed\Ecommerce\Http\ViewComposers\AdminNavComposer;
use AvoRed\Ecommerce\Http\ViewComposers\AdminUserFieldsComposer;
use AvoRed\Ecommerce\Console\AdminMakeCommand;
//Model Contracts
use AvoRed\Ecommerce\Models\Contracts\AdminUserInterface;
use AvoRed\Ecommerce\Models\Contracts\MenuInterface;
use AvoRed\Ecommerce\Models\Contracts\PageInterface;
use AvoRed\Ecommerce\Models\Contracts\RoleInterface;
use AvoRed\Ecommerce\Models\Contracts\SiteCurrencyInterface;
//Repositories
use AvoRed\Ecommerce\Models\Repository\AdminUserRepository;
use AvoRed\Ecommerce\Models\Repository\MenuRepository;
use AvoRed\Ecommerce\Models\Repository\PageRepository;
use AvoRed\Ecommerce\Models\Repository\RoleRepository;
use AvoRed\Ecommerce\Models\Repository\SiteCurrencyRepository;
use AvoRed\Framework\Breadcrumb\Breadcrumb;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->registerResources();
        //$this->registerViewComposerData();
        $this->registerPassportResources();
        $this->registerWidget();
        $this->registerAdminMenu();
        $this->registerBreadcrumb();
        $this->registerPaymentOptions();
        $this->registerShippingOption();
        $this->registerPermissions();
        $this->registerAdminConfiguration();
        $this->registerAdminMakeCommand();
        $this->registerModelContracts();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfigData();

        Passport::ignoreMigrations();
    }

    /**
     * Register the Avored Console Admin Make .
     *
     * @return void
     */
    protected function registerAdminMakeCommand()
    {
        $this->app->singleton('avored:admin:make', function ($app) {
            return new AdminMakeCommand($app['files']);
        });

        $this->commands('avored:admin:make');
    }

    /**
     * Registering AvoRed E commerce Resource
     * e.g. Route, View, Database path & Translation.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'avored-ecommerce');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avored-ecommerce');
    }

   


    /*
   *  Registering Passport Oauth2.0 client
   *      *
   * @return void
   */
    public function registerPassportResources()
    {
        Passport::ignoreMigrations();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        $this->commands([
            InstallCommand::class,
            ClientCommand::class,
            KeysCommand::class,
        ]);
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerAdminMenu()
    {
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerAdminConfiguration()
    {
        $configurationGroup = AdminConfigurationFacade::add('general')
            ->label('General');

        $configurationGroup->addConfiguration('general_site_title')
            ->label('Default Site Title')
            ->type('text')
            ->name('general_site_title');

        $configurationGroup->addConfiguration('general_site_description')
            ->label('Default Site Description')
            ->type('text')
            ->name('general_site_description');

        $siteCurrencyRepository = new SiteCurrencyRepository;
        $configurationGroup->addConfiguration('general_site_currency')
            ->label('Default Site Currency')
            ->type('select')
            ->name('general_site_currency')
            ->options($siteCurrencyRepository);

        $configurationGroup->addConfiguration('general_administrator_email')
            ->label('Administrator Email')
            ->type('text')
            ->name('general_administrator_email');

        $configurationGroup->addConfiguration('general_term_condition_page')
            ->label('Term & Condition Page')
            ->type('select')
            ->name('general_term_condition_page')
            ->options(function () {
                $options = Page::all()->pluck('name', 'id');
                return $options;
            });

        $configurationGroup->addConfiguration('general_home_page')
            ->label('Home Page')
            ->type('select')
            ->name('general_home_page')
            ->options(function () {
                $options = Page::all()->pluck('name', 'id');
                return $options;
            });

        $userGroup = AdminConfigurationFacade::add('users')
            ->label('Users');

        $userGroup->addConfiguration('user_default_country')
            ->label('User Default Country')
            ->type('select')
            ->name('user_default_country')
            ->options(function () {
                $options = Country::all()->pluck('name', 'id');
                return $options;
            });

        $userGroup->addConfiguration('user_activation_required')
            ->label('User Activation Required')
            ->type('select')
            ->name('user_activation_required')
            ->options(function () {
                $options = [0 => 'No', 1 => 'Yes'];
                return $options;
            });

        $shippingGroup = AdminConfigurationFacade::add('shipping')
            ->label('Shipping');

        $shippingGroup->addConfiguration('shipping_free_shipping_enabled')
            ->label('Is Free Shipping Enabled')
            ->type('select')
            ->name('shipping_free_shipping_enabled')
            ->options(function () {
                $options = [1 => 'Yes', 0 => 'No'];
                return $options;
            });

        $paymentGroup = AdminConfigurationFacade::add('payment')
            ->label('Payment');

        $paymentGroup->addConfiguration('payment_stripe_enabled')
            ->label('Payment Stripe Enabled')
            ->type('select')
            ->name('payment_stripe_enabled')
            ->options(function () {
                $options = [0 => 'No', 1 => 'Yes'];
                return $options;
            });

        $paymentGroup->addConfiguration('payment_stripe_publishable_key')
            ->label('Payment Stripe Publishable Key')
            ->type('text')
            ->name('payment_stripe_publishable_key');

        $paymentGroup->addConfiguration('avored_stripe_secret_key')
            ->label('Payment Stripe Secret Key')
            ->type('text')
            ->name('avored_stripe_secret_key');

        $taxGroup = AdminConfigurationFacade::add('tax')
            ->label('Tax');

        $taxGroup->addConfiguration('tax_enabled')
            ->label('Is Tax Enabled')
            ->type('select')
            ->name('tax_enabled')
            ->options(function () {
                $options = [1 => 'Yes', 0 => 'No'];
                return $options;
            });

        $taxGroup->addConfiguration('tax_percentage')
            ->label('Tax Percentage')
            ->type('text')
            ->name('tax_percentage');

        $taxGroup->addConfiguration('tax_default_country')
            ->label('Tax Default Country')
            ->type('select')
            ->name('tax_default_country')
            ->options(function () {
                $options = $options = Country::all()->pluck('name', 'id');
                return $options;
            });
    }

    /**
     * Register the Menus.
     *
     * @return void
     */
    protected function registerBreadcrumb()
    {
        BreadcrumbFacade::make('admin.dashboard', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Dashboard');
        });

        BreadcrumbFacade::make('admin.product.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Product')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.product.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.product.index');
        });

        BreadcrumbFacade::make('admin.product.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.product.index');
        });

        BreadcrumbFacade::make('admin.attribute.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Attribute')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.attribute.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.attribute.index');
        });

        BreadcrumbFacade::make('admin.attribute.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.attribute.index');
        });

        BreadcrumbFacade::make('admin.property.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Property')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.property.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.property.index');
        });

        BreadcrumbFacade::make('admin.attribute.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.attribute.index');
        });

        BreadcrumbFacade::make('admin.order.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Order')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.order.view', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('View')
                ->parent('admin.dashboard')
                ->parent('admin.order.index');
        });

        BreadcrumbFacade::make('admin.theme.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Theme')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.theme.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Upload')
                ->parent('admin.dashboard')
                ->parent('admin.theme.index');
        });

        BreadcrumbFacade::make('admin.role.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Role')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.role.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.role.index');
        });

        BreadcrumbFacade::make('admin.role.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.role.index');
        });

        BreadcrumbFacade::make('admin.admin-user.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Admin User')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.admin-user.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.admin-user.index');
        });

        BreadcrumbFacade::make('admin.admin-user.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.admin-user.index');
        });

        BreadcrumbFacade::make('admin.admin-user.show', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Show')
                ->parent('admin.dashboard')
                ->parent('admin.admin-user.index');
        });

        BreadcrumbFacade::make('admin.configuration', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Configuration')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.category.index', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Category')
                ->parent('admin.dashboard');
        });

        BreadcrumbFacade::make('admin.category.create', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Create')
                ->parent('admin.dashboard')
                ->parent('admin.category.index');
        });

        BreadcrumbFacade::make('admin.category.edit', function (Breadcrumb $breadcrumb) {
            $breadcrumb->label('Edit')
                ->parent('admin.dashboard')
                ->parent('admin.category.index');
        });
    }

    /**
     * Registering Payment Option for the App.
     *
     *
     * @return void
     */
    protected function registerPaymentOptions()
    {
        $stripe = new StripePayment();
        PaymentFacade::put($stripe->identifier(), $stripe);
    }

    /**
     * Register Shippiong Option for App.
     *
     * @return void
     */
    protected function registerShippingOption()
    {
        $freeShipping = new FreeShipping();
        ShippingFacade::put($freeShipping->identifier(), $freeShipping);
    }

    /**
     * Register the permissions.
     *
     * @return void
     */
    protected function registerPermissions()
    {
        $permissionGroup = PermissionFacade::add('category')
            ->label('Category Permissions');

        $permissionGroup->addPermission('admin-category-list')
            ->label('Category List')
            ->routes('admin.category.index');

        $permissionGroup->addPermission('admin-category-create')
            ->label('Create Category')
            ->routes('admin.category.create,admin.category.store');

        $permissionGroup->addPermission('admin-category-update')
            ->label('Update Category')
            ->routes('admin.category.edit,admin.category.update');

        $permissionGroup->addPermission('admin-category-destroy')
            ->label('Destroy Category')
            ->routes('admin.category.destroy');

        $permissionGroup = PermissionFacade::add('product')
            ->label('Product Permissions');

        $permissionGroup->addPermission('admin-product-list')
            ->label('Product List')
            ->routes('admin.product.index');
        $permissionGroup->addPermission('admin-product-create')
            ->label('Create Product')
            ->routes('admin.product.create,admin.product.store');
        $permissionGroup->addPermission('admin-product-update')
            ->label('Update Product')
            ->routes('admin.product.edit,admin.product.update');
        $permissionGroup->addPermission('admin-product-destroy')
            ->label('Destroy Product')
            ->routes('admin.product.destroy');

        $permissionGroup = PermissionFacade::add('attribute')
            ->label('Attribute Permissions');

        $permissionGroup->addPermission('admin-attribute-list')
            ->label('Attribute List')
            ->routes('admin.attribute.index');
        $permissionGroup->addPermission('admin-attribute-create')
            ->label('Attribute')
            ->routes('admin.attribute.create,admin.attribute.store');
        $permissionGroup->addPermission('admin-attribute-update')
            ->label('Attribute')
            ->routes('admin.attribute.edit,admin.attribute.update');
        $permissionGroup->addPermission('admin-attribute-destroy')
            ->label('Attribute')
            ->routes('admin.attribute.destroy');

        $permissionGroup = PermissionFacade::add('property')
            ->label('Attribute Permissions');

        $permissionGroup->addPermission('admin-property-list')
            ->label('Property List')
            ->routes('admin.property.index');
        $permissionGroup->addPermission('admin-property-create')
            ->label('Property Create')
            ->routes('admin.property.create,admin.property.store');
        $permissionGroup->addPermission('admin-attribute-update')
            ->label('Property Update')
            ->routes('admin.property.edit,admin.property.update');
        $permissionGroup->addPermission('admin-property-destroy')
            ->label('Property Destroy')
            ->routes('admin.property.destroy');

        $permissionGroup = PermissionFacade::add('admin-user')
            ->label('Admin User Permissions');

        $permissionGroup->addPermission('admin-admin-user-list')
            ->label('Admin User List')
            ->routes('admin.admin-user.index');

        $permissionGroup->addPermission('admin-admin-user-create')
            ->label('Admin User Create')
            ->routes('admin.admin-user.create,admin.admin-user.store');

        $permissionGroup->addPermission('admin-admin-user-update')
            ->label('Admin User Update')
            ->routes('admin.admin-user.edit,admin.admin-user.update');

        $permissionGroup->addPermission('admin-admin-user-destroy')
            ->label('Admin User Destroy')
            ->routes('admin.admin-user.destroy');

        $permissionGroup = PermissionFacade::add('role')
            ->label('Role Permissions');

        $permissionGroup->addPermission('admin-role-list')
            ->label('Role List')
            ->routes('admin.role.index');

        $permissionGroup->addPermission('admin-role-create')
            ->label('Role Create')
            ->routes('admin.role.create,admin.role.store');

        $permissionGroup->addPermission('admin-role-update')
            ->label('Role Update')
            ->routes('admin.role.edit,admin.role.update');

        $permissionGroup->addPermission('admin-role-destroy')
            ->label('Role Destroy')
            ->routes('admin.role.destroy');

        $permissionGroup = PermissionFacade::add('role')
            ->label('Theme Permissions');

        $permissionGroup->addPermission('admin-theme-list')
            ->label('Theme List')
            ->routes('admin.theme.index');

        $permissionGroup->addPermission('admin-theme-create')
            ->label('Theme Upload/Create')
            ->routes('admin.create.index', 'admin.theme.store');

        $permissionGroup->addPermission('admin-theme-activated')
            ->label('Theme Activated')
            ->routes('admin.activated.index');

        $permissionGroup->addPermission('admin-theme-deactivated')
            ->label('Theme Deactivated')
            ->routes('admin.deactivated.index');

        $permissionGroup->addPermission('admin-theme-destroy')
            ->label('Theme Destroy')
            ->routes('admin.destroy.index');

        $permissionGroup = PermissionFacade::add('configuration')
            ->label('Configuration Permissions');

        $permissionGroup->addPermission('admin-configuration')
            ->label('Configuration')
            ->routes('admin.configuration');

        $permissionGroup->addPermission('admin-configuration-store')
            ->label('Configuration Store')
            ->routes('admin.configuration.store');

        $permissionGroup = PermissionFacade::add('order')
            ->label('Order Permissions');

        $permissionGroup->addPermission('admin-order-list')
            ->label('Order List')
            ->routes('admin.order.index');

        $permissionGroup->addPermission('admin-order-view')
            ->label('Order View')
            ->routes('admin.order.view');

        $permissionGroup->addPermission('admin-order-send-invoice-email')
            ->label('Order Sent Invoice By Email')
            ->routes('admin.order.send-email-invoice');

        $permissionGroup->addPermission('admin-order-change-status')
            ->label('Order Change Status')
            ->routes('admin.order.change-status,admin.order.update-status');

        Blade::if('hasPermission', function ($routeName) {
            $condition = false;
            $user = Auth::guard('admin')->user();

            if (!$user) {
                $condition = $user->hasPermission($routeName) ?: false;
            }

            $converted_res = ($condition) ? 'true' : 'false';

            return "<?php if ($converted_res): ?>";
        });
    }

    /**
     * Register the Widget.
     *
     * @return void
     */
    protected function registerWidget()
    {
        $totalUserWidget = new TotalUserWidget();
        WidgetFacade::make($totalUserWidget->identifier(), $totalUserWidget);

        $totalOrderWidget = new TotalOrderWidget();
        WidgetFacade::make($totalOrderWidget->identifier(), $totalOrderWidget);
    }

    /**
     * Register the Config Data
     *
     * @return void
     */
    public function registerConfigData()
    {
        /*
        $authConfig = $this->app['config']->get('auth', []);
        $this->app['config']->set(
                            'auth',
                            array_merge_recursive(require __DIR__ . '/../config/avored-auth.php', $authConfig)
                            );

        */

        $this->mergeConfigFrom(__DIR__ . '/../config/avored-ecommerce.php', 'avored-ecommerce');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['avored:admin:make'];
    }

    /**
     * Register the Publish Files
     *
     * @return void
     */
    public function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../config/avored-ecommerce.php' => config_path('avored-ecommerce.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../config/avored-auth.php' => config_path('avored-auth.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../resources/lang' => base_path('themes/avored/default/lang/vendor')
        ], 'avored-module-lang');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('themes/avored/default/views/vendor')
        ], 'avored-module-views');
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('avored-migrations'),
        ]);
    }

    /**
     * Register the Repository Instance.
     *
     * @return void
     */
    protected function registerModelContracts()
    {
        $this->app->bind(AdminUserInterface::class, AdminUserRepository::class);
        $this->app->bind(MenuInterface::class, MenuRepository::class);
        $this->app->bind(PageInterface::class, PageRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(SiteCurrencyInterface::class, SiteCurrencyRepository::class);
    }
}

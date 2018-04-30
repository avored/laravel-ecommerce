@extends('avored-ecommerce::admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">

            <div class="h1">Configuration</div>

            <form method="post" action="{{ route('admin.configuration.store') }}" enctype="multipart/form-data">
                @csrf

                <div id="configuration-list" class="mb-3" role="tablist">


                    @foreach(AdminConfiguration::all() as $configuration)
                    <div class="card mb-3">


                        <a data-toggle="collapse" href="#avored-{{ $configuration->key() }}">
                            <div class="card-header" role="tab" id="{{ $configuration->key() }}">
                                <h5 class="mb-0">
                                    {{ $configuration->label() }}
                                </h5>
                            </div>
                        </a>

                        <div id="avored-{{ $configuration->key() }}" class="collapse show" role="tabpanel"
                             data-parent="#configuration-list">
                            <div class="card-body">

                                @foreach($configuration->all() as $field)

                                    @if($field->type() == 'text')

                                        @include('avored-ecommerce::forms.text',['name' => $field->name(),
                                                                        'label' => $field->label()])

                                    @endif

                                    @if($field->type() == 'select')

                                        @include('avored-ecommerce::forms.select',['name' => $field->name(),
                                                                        'label' => $field->label(),
                                                                        'options' => call_user_func($field->options())])

                                    @endif

                                @endforeach


                            </div>
                        </div>
                    </div>

                    @endforeach

                    <div class="card mb-3">
                        <a class="collapsed" data-toggle="collapse" href="#user-config">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h5 class="mb-0">
                                    Users
                                </h5>
                            </div>
                        </a>

                        <div id="user-config" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                             data-parent="#configuration-list">
                            <div class="card-body">
                                @include('avored-ecommerce::forms.select',['name' => 'avored_address_default_country',
                                                                           'label' => 'User Address Default Country',
                                                                           'options' => $countryOptions])

                                @include('avored-ecommerce::forms.select',['name' => 'avored_user_activation_required',
                                                                           'label' => 'User Activation Required',
                                                                           'options' => [0 => 'No',1 => 'Yes']])

                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <a class="collapsed" data-toggle="collapse" href="#shipping-config">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h5 class="mb-0">
                                    Shipping
                                </h5>
                            </div>
                        </a>

                        <div id="shipping-config" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                             data-parent="#configuration-list">
                            <div class="card-body">


                                @include('avored-ecommerce::forms.select',['name' => 'avored_free_shipping_enabled',
                                                                            'label' => 'Is Free Shipping Enabled',
                                                                            'options' => [1 => 'Yes',0 => 'No']
                                                                            ])

                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <a class="collapsed" data-toggle="collapse" href="#payment-config">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h5 class="mb-0">
                                    Payment
                                </h5>
                            </div>
                        </a>

                        <div id="payment-config" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                             data-parent="#configuration-list">
                            <div class="card-body">


                                @include('avored-ecommerce::forms.select',['name' => 'avored_pickup_enabled',
                                                                            'label' => 'Is Pick Up  Enabled',
                                                                            'options' => [1 => 'Yes',0 => 'No']
                                                                            ])
                                @include('avored-ecommerce::forms.select',['name' => 'avored_stripe_enabled',
                                                                            'label' => 'Is Stripe Enabled',
                                                                            'options' => [1 => 'Yes',0 => 'No']
                                                                            ])

                                @include('avored-ecommerce::forms.text',['name' => 'avored_stripe_publishable_key',
                                                                    'label' => 'Your Stripe Publishable Key'])

                                @include('avored-ecommerce::forms.text',['name' => 'avored_stripe_secret_key',
                                                                    'label' => 'Your Stripe Secret Key'])


                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <a class="collapsed" data-toggle="collapse" href="#order-config" aria-expanded="false"
                           aria-controls="collapseThree">
                            <div class="card-header" role="tab" id="headingThree">
                                <h5 class="mb-0">

                                    Tax

                                </h5>
                            </div>
                        </a>

                        <div id="order-config" class="collapse" role="tabpanel" aria-labelledby="headingThree"
                             data-parent="#configuration-list">
                            <div class="card-body">

                                @include('avored-ecommerce::forms.select',['name' => 'avored_tax_enabled',
                                                                           'label' => 'Is Tax Enabled?',
                                                                           'options' => [0 => 'No',1 => 'Yes']])


                                @include('avored-ecommerce::forms.text',['name' => 'avored_tax_percentage',
                                                                           'label' => 'Percentage of Tax'])


                                @include('avored-ecommerce::forms.select',['name' => 'avored_tax_class_default_country_for_tax_calculation',
                                                                           'label' => 'Default Country for Tax Calculation',
                                                                           'options' => $countryOptions])

                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>

    </div>
@endsection
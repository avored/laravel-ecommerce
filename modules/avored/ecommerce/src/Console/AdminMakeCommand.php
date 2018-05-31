<?php

namespace AvoRed\Ecommerce\Console;

use AvoRed\Ecommerce\Models\Database\Role;
use AvoRed\Ecommerce\Models\Database\AdminUser;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Laravel\Passport\ClientRepository;

class AdminMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'avored:admin:make';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an Admininistrator Account for AvoRed Admin';

    /**
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        //CREATE AN ADMIN USER
        $firstName  = $this->ask('What is your First Name:');
        $lastName   = $this->ask('What is your Last Name:');
        $email      = $this->ask('What is your Email:');
        $password   = $this->secret('What is your password:');

        $role = Role::create(['name' => 'administrator', 'description' => 'Administrator Role has all access']);

        $adminUser = AdminUser::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => bcrypt($password),
            'is_super_admin' => 1,
            'role_id' => $role->id,
        ]);

        $request            = $this->laravel->make('request');
        $clientRepository   = new ClientRepository;
        $clientRepository->createPasswordGrantClient($adminUser->id, $adminUser->full_name, $request->getUriForPath('/'));

        $this->info('AvoRed Ecommerce Administraotr Account Created Successfully!');
    }
}

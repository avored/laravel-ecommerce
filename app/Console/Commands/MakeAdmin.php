<?php

namespace App\Console\Commands;

use Validator;
use Mage2\Ecommerce\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Administrator Account!!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         $data['name'] = $this->ask('What is your name?');
         $data['email'] = $this->ask('What is your Email?');
         $data['password'] = $this->secret('What is the password?');
         
         $validator = $this->validator($data);
         if($validator->fails()) {
            $this->error('User Exist!');
         } else {
            $user =  User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => bcrypt( $data['password']),
                    ]);
             $this->info('User Created! '. $user->id);
         }
         
    }
    
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }
    
}

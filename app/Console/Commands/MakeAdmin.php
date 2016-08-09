<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\AdminUser;
use Illuminate\Support\Facades\Validator;

class MakeAdmin extends Command {

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
    protected $description = 'Creating Administrator Account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $data['first_name']             = $this->ask('What is your first name?');
        $data['last_name']              = $this->ask('What is your last name?');
        $data['email']                  = $this->ask('What is your email?');
        $data['password']               = $this->secret('What is your password?');
        $data['password_confirmation']  = $this->secret('What is your confirmation Password?');

        $validator = $this->validator($data);

        if ($validator->fails()) {
            // Not sure how to get Validator error messages $validator
             $this->info('Opps Sorry Something went wrong. Please try again!');
        } else {
            
            $this->create($data);
            $this->info('Your Administrator Account Created!');
        }
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:admin_users',
                    'password' => 'required|min:6|confirmed',
        ]);
    }
    
    protected function create ($data) {
        return AdminUser::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}

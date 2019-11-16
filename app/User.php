<?php

namespace App;

use AvoRed\Framework\Database\Models\Address;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\ClientRepository;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the Passport Client for User and If it doesnot exist then create a new one.
     * @return \Laravel\Passport\Client $client
     */
    public function getPassportClient()
    {
        $client = $this->clients->first();
        if (null === $client) {
            $clientRepository = app(ClientRepository::class);

            $redirectUri = env('APP_URL');
            $client = $clientRepository->createPasswordGrantClient($this->id, $this->name, $redirectUri);
        }

        return $client;
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}

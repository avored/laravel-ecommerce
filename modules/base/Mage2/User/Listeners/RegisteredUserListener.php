<?php
namespace Mage2\User\Listeners;

use Mage2\Framework\Events;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mage2\System\Models\Configuration;
use Illuminate\Support\Facades\Mail;
use Mage2\User\Mail\NewUserMail;
use Mage2\User\Models\User;

class RegisteredUserListener
{

    protected $configuration;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Handle the event.
     *
     * @param  mag2.user.registered  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        $totalUserConfiguration  = User::all()->count();

        $configuration = Configuration::where('configuration_key', '=', 'mage2_user_total')->get()->first();

        if (null === $configuration) {
            $data['configuration_key'] = 'mage2_user_total';
            $data['configuration_value'] = $totalUserConfiguration;
            Configuration::create($data);

        } else {
            $configuration->update(['configuration_value' => $totalUserConfiguration]);
        }



        Mail::to($user->email)->send(new NewUserMail($user));
    }
}

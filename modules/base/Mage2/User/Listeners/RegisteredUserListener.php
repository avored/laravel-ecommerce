<?php
namespace Mage2\User\Listeners;

use Mage2\Framework\Events;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mage2\System\Models\Configuration;

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
        $totalUserConfiguration  = 0;
        $userConfiguration = $this->configuration->getConfiguration('mage2_user_total_user');

        if(null === $userConfiguration) {
            $userConfiguration = Configuration::create(['configuration_key' => 'mage2_user_total_user', 'configuration_value' => 1]);
        } else {
            $userConfiguration->update(['configuration_value' => $userConfiguration->configuration_value + 1]);
        }
    }
}

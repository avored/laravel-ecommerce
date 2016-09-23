<?php

use Illuminate\Database\Seeder;
use Mage2\Order\Models\OrderStatus;

class Mage2CommonDatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        OrderStatus::insert(
            ['title' => 'pending', 'is_default' => 0], 
            ['title' => 'processing', 'is_default' => 0], 
            ['title' => 'complete', 'is_default' => 0]
        );
    }

}

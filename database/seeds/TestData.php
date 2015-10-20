<?php

use Illuminate\Database\Seeder;
use App\Admin\Page;

class TestData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=1; $i<25; $i++) {
            Page::create([
                'name' => 'Test' . $i,
                'slug' => "test-". $i,
                'content' => 'Test Content' . $i
            ]);
        }

    }
}

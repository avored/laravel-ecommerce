<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://polymer';

    public function setUp() {
        ini_set('xdebug.max_nesting_level', 120);
        parent::setUp();

        $this->prepareForTests();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication() {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function prepareForTests() {
        Config::set('database.default', 'sqlite');
        Artisan::call('migrate');

    }

}

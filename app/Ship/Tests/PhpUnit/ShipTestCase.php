<?php


namespace App\Ship\Tests\PhpUnit;


use Porto\Core\Tests\PhpUnit\CoreTestCase;
use Illuminate\Contracts\Console\Kernel;
use Faker\Generator;

abstract class ShipTestCase extends CoreTestCase
{

    public function createApplication() {
        $this->baseUrl = env('API_FULL_URL');

        $this->overrideSubDomain();

        $app = require __DIR__ . '/../../../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $this->faker = $app->make(Generator::class);

        return $app;
    }
}
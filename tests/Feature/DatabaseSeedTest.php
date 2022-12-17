<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseSeedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->seed();
        $this->assertDatabaseCount('users',1);
        $this->assertDatabaseCount('tradespersons',20);
        $this->assertDatabaseCount('professions',20);
        $this->assertDatabaseCount('addresses',20);
        $this->assertDatabaseCount('tradesperson_professions',20);
    }

}

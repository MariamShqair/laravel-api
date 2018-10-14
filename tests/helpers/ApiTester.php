<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Faker\Factory as Faker;

abstract  class ApiTester extends TestCase
{
	protected $fake;


	function __construct()
	{

		$this->fake = Faker::create();

	}

	public function setUp()
	{

		patent::setUp();

		Artisan::call('migrate');


		$this->app['artisan']->call('migrate');
	}

	

      protected  function getJson($uri,$method = 'GET',$parameters = [])
    {

        return   json_decode($this->call($method ,$uri,$parameters)->getContent());
    }

     protected function assertObjectHasAttributes($lesson )
    {

        $args = func_get_args();

        $object = array_shift($args);

        foreach ($args  as $attribute) {
            $this->assertObjectHasAttributes($attribute, $object);
        }

    }
   

}
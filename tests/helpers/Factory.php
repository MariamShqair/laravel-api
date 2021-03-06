<?php

trait Factory
{



	protected $times = 1;
	
	protected function times($count)
    {
    	$this->times =$count;

    	return $this;
    }

     protected function make($type, array $fields =[])
    {	
    	while($this->times--)
    		{
    			$stub = array_merge($this->getStub(),$fields);
    			$type::create($stub);
    		}
    	
    }

    protected function getStub()
    {
    	thow new BadMethodCallException('Create your own getStub method to declare your fields.');
    }
}
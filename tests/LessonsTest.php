<?php

namespace Tests\Unit;

use App\Lesson;

use Tests\Unit\ApiTester;

class LessonsTest extends ApiTester
{
    use Factory;

    /**
     * A basic test example.
     *
     * @return void
     */


     

    public function it_feteches_lessons()
    {
    	// arrange
        $this->times(5)->make('Lesson');

        //act
        $this->getJson('api/v1/lessons');

        $this->assertResponseOk();
    }

    public function it_fetches_a_single_lesson()
    {
        $this->make('Lesson');

        $lesson = $this->getJson('api/v1/lessons/1');
        $this->assertResponseOk();

        $this->assertObjectHasAttributes($lesson,'body','active');

    }
    public function it_404s_if_a_lesson_is_not_found()
    {
        $json = $this->getJson('api/v1/lessons/x');

        $this->assertResponseStatus(404);

        $this->assertObjectHasAttributes($json , 'error');
    }

    protected function getStub()
    {

        return [
 
            'title' => $this->fake->sentence,
            'body' => $this->fake->paragraph,
            'some_bool' => $this->fake->boolean

        ];
    }

    public function it_create_a_new_lesson_given_valid_parameters()
    {
        $this->getJson('api/v1/lessons','POST',$this->getStub());
        $this->assertResponseStatus('201');
    }

    public function it_throws_a_422_if_a_new_lesson_request_fails_validation()
    {
        $this->getJson('api/v1/lessons','POST');
    }
    private function makelessons($lessonFields = [])
    {
    	$lesson = array_merge([
    		'title' => $this->fake->sentence,
    		'body' =>$this->fake->paragraph,
    		'some_bool' =>$this->fake->boolean

    	],$lessonFields);

    	while($this->times --) Lesson::create($lesson);
    }
   
  


}

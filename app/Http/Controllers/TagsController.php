<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;

use App\Lesson;

use App\Acme\Transformers\TagTransformer;

class TagsController extends ApiController
{

   protected $tagTransformer;

   function __construct(TagTransformer $tagTransformer)
   {

   	$this->tagTransformer = $tagTransformer ;

   }


   public function index($lessonId = null){
   	
	$tags = $this->getTags($lessonId);

	return $this->respond([
		'data' => $this->tagTransformer->transformCollection($tags->all())
	]);
   }

   private function getTags($lessonId)
   {
      return $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::all();

    }
}

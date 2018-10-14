<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lesson;
use App\Acme\Transformers\LessonTransformer;

use Response;

class LessonsController extends ApiController
{

    protected $lessonTransformer;


    function __construct(LessonTransformer $lessonTransformer){

        $this->lessonTransformer = $lessonTransformer;

        $this->middleware('auth.basic');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = Input::get('limit') ?:3;
        $lessons = Lesson::paginate($limit);

        return $this->respond([
            'data'=>$this->lessonTransformer->transformCollection($lessons->all())

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        if( ! $request->input('title') || ! $request->input('body'))
            {
                return $this->respondUnprocessableEntity('Parameters failed validation for a lesson.');
            }

            Lesson::create($request->all());

            return $this->respondCreated('Lesson successfully created.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if(! $lesson) 
        {
           // return $this->respondInternalError('Iternal Error');
           return $this->responseNotFound('Lesson does not exist.');
        }

        return respond([
            'data' => $this->lessonTransformer->transform($lesson)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    
   
}

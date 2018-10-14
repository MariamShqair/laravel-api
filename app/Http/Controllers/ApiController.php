<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Response;
class ApiController extends Controller
{
	protected $statusCode =200

	;

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function setStatusCode($statusCode)
	{

		$this->statusCode = $statusCode;

		return $this;

	}

	public function responseNotFound($message = 'Not Found')
	{

		return $this->setStatusCode(404)->respondWithError($message);
	}



	public function respondInternalError($message ='Internal Error')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}




	public function respondUnprocessableEntity($message = 'Unprocessable Entity')
	{
		return $this->setStatusCode(422)->respondWithError($message);
	}



	protected function respondCreated($message)
    {
        return $this->setStatusCode(201)->respond([
                'message' => $message
            ]);
    }


	public function respondWithError($message)
	{
		return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]

          ]);
	}


	public function respond($data , $headers = [])
	{
		return Response::json($data , $this->getStatusCode() , $headers);
	}



}
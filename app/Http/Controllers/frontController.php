<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\db_answer;
use App\db_quiz;
use App\db_questions;
use App\payments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class frontController extends Controller
{

    public function index($id,$url,$token){
    	$id = $id;
        $data = db_quiz::find($id);
        $title = $data->title;
        $token = $token; 

        return view('frontend.email', ['id' => $id, 'title' => $title, 'token' => $token]);                 
    }

    public function prueba($id, Request $request){

    	$id = $id;
    	$email = $request->email;
        $token = $request->token;    	
    	
    	/*if(!isset($id))
    		return response()->json($res = array('e' => 2, 'msj' => 'El id de la prueba está vacio'));*/

    	/*if(!isset($email))
    		return response()->json($res = array('e' => 2, 'msj' => 'El correo está vacio'));*/

        $data_payments = payments::where('token',$token)->first();

        if($data_payments->status_token == 0){
        	$data = db_quiz::find($id);
        	$data_question = db_questions::where('id_quiz',$data['id'])->get();
        	$data->questions = $data_question;
        	foreach ($data_question as $q) {
        		$q->answer = db_answer::where('id_question',$q->id)->get();
        	}
        	$data->email = $email;

            $data_payments['status_token'] = 1;
            $data_payments->save();

        	return view('frontend.prueba', compact('data'));
        }else
           return response()->json($res = array('e' => 1, 'msj' => 'Token usado!'));    
    }

    public function indexTest($id, $url, Request $request){

        $data = $request->all();
        //$token = $data['token'];
        $status = $data['status'];

        if($status == 'success' /*&& isset($token)*/ ){
            $id = $id;
            $data = db_quiz::find($id);
            $title = $data->title;
            return response()->json(config('app.url').'prueba/'.$id.'/'.$url);
        }else
            return response()->json($res = array('e' => 1, 'msj' => 'Error'));    
    }

    public function practica($id,Request $request){
        $id = $id;
        $data = db_quiz::find($id);
        $title = $data->title;        
        return view('frontend.practica', ['id' => $id, 'title' => $title]);
    }

    public function practica2($id, $p, Request $request){
        $id = $id;
        $email = $request->email;       
        
        /*if(!isset($id))
            return response()->json($res = array('e' => 2, 'msj' => 'El id de la prueba está vacio'));*/

        /*if(!isset($email))
            return response()->json($res = array('e' => 2, 'msj' => 'El correo está vacio'));*/

        $data = db_quiz::find($id);
        $data_question = db_questions::where('id_quiz',$data['id'])->get();
        $data->questions = $data_question;
        foreach ($data_question as $q) {
            $q->answer = db_answer::where('id_question',$q->id)->get();
        }

        $data->email = $email;
        return view('frontend.practica2', compact('data'));
    }
}

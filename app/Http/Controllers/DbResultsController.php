<?php

namespace App\Http\Controllers;

use App\db_results;
use App\db_answer;
use App\db_quiz;
use App\db_questions;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DbResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
       /* if (!Auth::check()) {
            Auth::logout();
            return redirect('/login');  
        }*/

        $data = db_results::where('total','<>','NULL')->orderBy('id','desc')->Paginate(15);
        foreach($data as $d){
            $quiz = db_quiz::find($d->id_quiz);
            if(isset($quiz))
                $d->quiz = $quiz;            
        }

        //dd($data);
        return view('results.list', compact('data'));
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
        $prueba = $request->all();
        //dd($prueba);

        $email = $prueba['email'];
        $id_quiz = $prueba['id_quiz'];
        $act = $prueba['act'];
        
        switch($act){
            case 'real':
                /*
                    if(!isset($email))
                        return response()->json($res = array('e' => 1, 'msj' => 'E-mail está vacío'));
                */
        
                /*
                    if(!isset($id_quiz))
                        return response()->json($res = array('e' => 1, 'msj' => 'Id de la prueba está vacío'));
                */
        
                $data = db_questions::where('id_quiz',$id_quiz)->get();
                $total = 0;
                $id = '';
                $code_test = str_random(6);

                /*
                    $code_test = 0;
                    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
                    $max = strlen($pattern)-1;
                    for($i=0;$i < 6;$i++){
                        $code_test .= $pattern{mt_rand(0,$max)};
                    }
                */      
        
                //pregunta
                foreach($data as $d){
                    //respuesta            
                    foreach($prueba['answer'] as $p => $k){ 
                        if($p == $d->id){
                            $id_question = $d->id;
                            $id_answer = $k;
        
                            //valor
                            $valor = db_answer::find($id_answer);
                            $total += $valor->value;
        
                            /*if(!isset($id_question))
                                return response()->json($res = array('e' => 1, 'msj' => 'Id de la pregunta está vacío'));*/
        
                            /*if(!isset($id_answer))
                                return response()->json($res = array('e' => 1, 'msj' => 'Id de la respuesta está vacío'));*/ 
        
                            $data = array(
                                'email' => $email,
                                'id_quiz' => $id_quiz,
                                'id_question' => $id_question,
                                'id_answer' => $id_answer,
                                'code_test' => $code_test 
                            );
                            $id = db_results::insertGetId($data); 
                        }                                                
                    }           
                }
        
                $data = db_results::find($id);
                if(isset($total))
                    $data['total'] = $total;
        
                $data->save();        
                
                $test = db_quiz::find($id_quiz);


                //Cliente
                $mail_config = array(
                    'name_app'=> 'Certify College',
                    'subtitle'=> 'Prueba finalizada - '.$test->title,
                    'email_register' => $email,
                    'content' => '¡Has terminado tu prueba! Hemos recibido tus respuestas, las vamos a verificar y en caso de que hayas obtenido una calificación satisfactoria, te enviaremos tu certificado al e-mail con el que te registraste.'
                );

                try{         
                    Mail::send('email',$mail_config, function ($m) use ($mail_config) {
                        $m->from('noreply@certifycollege.com', $mail_config['name_app']);
                        $m->to($mail_config['email_register']);
                        $m->subject($mail_config['subtitle']);
                    });  
                }
                catch(\Exception $e){
                    return redirect('results/'.$id);
                }

                //Admin
                $mail_config = array(
                    'name_app'=> 'Certify College',
                    'subtitle'=> 'Prueba finalizada - '.$test->title,
                    'email_register' => 'diego@certifycollege.com',
                    'content' => 'Un cliente a terminado la prueba de '.$test->title
                );

                try{
                    Mail::send('email',$mail_config, function ($m) use ($mail_config) {
                        $m->from('noreply@certifycollege.com', $mail_config['name_app']);
                        $m->to($mail_config['email_register']);
                        $m->subject($mail_config['subtitle']);
                    });  
                }
                catch(\Exception $e){
                    return redirect('results/'.$id);
                }

                return redirect('results/'.$id);               
            
                break;
                
            case 'practica':
                /*if(!isset($email))
                    return response()->json($res = array('e' => 1, 'msj' => 'E-mail está vacío'));*/
        
                /*if(!isset($id_quiz))
                    return response()->json($res = array('e' => 1, 'msj' => 'Id de la prueba está vacío'));*/
        
                $data = db_questions::where('id_quiz',$id_quiz)->get();
                $total = 0;
                $id = '';
                $code_test = str_random(6);
                /*$code_test = 0;
                $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
                $max = strlen($pattern)-1;
                for($i=0;$i < 6;$i++){
                    $code_test .= $pattern{mt_rand(0,$max)};
                }*/      
        
                //pregunta
                foreach($data as $d){            
                    //respuesta            
                    foreach($prueba['answer'] as $p => $k){ 
                        if($p == $d->id){
                            $id_question = $d->id;
                            $id_answer = $k;
        
                            //valor
                            $valor = db_answer::find($id_answer);
                            $total += $valor->value;
        
                            /*if(!isset($id_question))
                                return response()->json($res = array('e' => 1, 'msj' => 'Id de la pregunta está vacío'));*/
        
                            /*if(!isset($id_answer))
                                return response()->json($res = array('e' => 1, 'msj' => 'Id de la respuesta está vacío'));*/ 
        
                            $data = array(
                                'email' => $email,
                                'id_quiz' => $id_quiz,
                                'id_question' => $id_question,
                                'id_answer' => $id_answer,
                                'code_test' => $code_test 
                            );
                            $id = db_results::insertGetId($data); 
                        }                                                
                    }           
                }
        
                //$data = db_results::find($id);
                //if(isset($total))
                    //$data['total'] = $total;
        
                //$data->save();


                //Mail
                $test = db_quiz::find($id_quiz);                 
                
                $mail_config = array(
                    'name_app'=> 'Certify College',
                    'subtitle'=> 'Resultados de Práctica- '.$test->title,
                    'email_register' => $email,
                    'content' => 'Acabas de realizar la práctica '.$test->title.', obteniendo el puntaje de '.$total
                );
                
                try{ 
                    Mail::send('email',$mail_config, function ($m) use ($mail_config) {
                        $m->from('noreply@certifycollege.com', $mail_config['name_app']);
                        $m->to($mail_config['email_register']);
                        $m->subject($mail_config['subtitle']);
                    }); 
                }
                catch(\Exception $e){
                    $a = array(
                        'title' => $test->title,
                        'description' => $test->description,
                        'total' => $total,
                        'msj' => 'Error al intentar enviar el e-mail'
                    ); 
                    return view('frontend.results',compact('a'));
                }  

                $a = array(
                    'title' => $test->title,
                    'description' => $test->description,
                    'total' => $total,
                    'msj' => 'Success'
                ); 

                return view('frontend.results',compact('a'));
                
                break;          
        }                            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\db_results  $db_results
     * @return \Illuminate\Http\Response
     */
    public function show($id, db_results $db_results)
    {
        /*if(!isset($id))
            return response()->json($res = array('e' => 1, 'msj' => 'Id del resultado está vacío'));*/

        $id = $id;    
        return redirect(config("app.url_from").'test_realizado.html?id='.$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\db_results  $db_results
     * @return \Illuminate\Http\Response
     */
    public function data($id)
    {
        $id = $id;        
        if(isset($id)){
            $results = db_results::find($id);
            //dd($results);
            $quiz = db_quiz::find($results->id_quiz);
            $user = User::where('email',$results->email)->get();
            $data = array(
                'results' => $results,
                'quiz' => $quiz,
                'user' => $user 
                );
            return response()->json($res = array(
                'e' => 0, 
                'msj' => 'datos encontrados',
                'data' => $data
                )                
            );
        }else
            return response()->json($res = array('e' => 1, 'msj' => 'Debe enviar el id del test realizado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\db_results  $db_results
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, db_results $db_results)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\db_results  $db_results
     * @return \Illuminate\Http\Response
     */
    public function destroy(db_results $db_results)
    {
        //
    }

    public function test_details($id)
    {

       /* if (!Auth::check()) {
            Auth::logout();
            return redirect('/login');  
        }*/

        $data = db_results::find($id);
       
        $quiz = db_quiz::find($data->id_quiz);
        $data->quiz = $quiz;

        $questions = db_questions::where('id_quiz',$data->id_quiz)->get();
        $data->questions = $questions;

        foreach ($questions as $q) {
            $answer = db_answer::where('id_question',$q->id)->get();
            $q->answer = $answer;
        }        

        $test_complete = db_results::where('code_test',$data->code_test)->get();
        if(isset($test_complete))
            $data->test_complete = $test_complete;

        foreach ($data->test_complete as $t) {
            foreach ($data->questions as $q) {
                if($q->id == $t->id_question){
                    foreach ($q->answer as $a) {
                        if($a->id == $t->id_answer){
                            $a->check = true;
                        }
                    }    
                }
            }
        }

        return view('results.test_details', compact('data'));
    }
}

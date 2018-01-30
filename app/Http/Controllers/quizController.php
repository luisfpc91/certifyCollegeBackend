<?php

namespace App\Http\Controllers;

use App\db_answer;
use App\db_quiz;
use App\db_questions;
use App\categories;
use App\db_especialista;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class quizController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    
    public function index()
    {
        $data = categories::all();    
        return view('quiz.create',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $id = $id;
        if(isset($id)){
            $data = db_quiz::find($id);
            $data->specialist = db_especialista::where('id_quiz',$id)->first();
            $data->questions = db_questions::where('id_quiz',$data->id)->get();

            return response()->json($res = array('e' => 0, 'data' => $data));
        }else
            return response()->json($res = array('e' => 1, 'msj' => 'Debe enviar el Id de la prueba'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $email = $request->email;
        $description = $request->description;
        $amount = $request->amount;
        $currency = $request->currency;
        $url_to = $request->url_to;
        $id_categorie = $request->id_categorie;

        /*if(!isset($title))
            return response()->json($res = array('e' => 2, 'msj' => 'Título vacío'));*/

        /*if(!isset($email))
            return response()->json($res = array('e' => 2, 'msj' => 'E-mail vacío'));*/

        $values = array(
          'title' => $title,
          'created_at' => Carbon::now(),
          'email' => $email,
          'url_to' => $url_to,
          'description' => $description,
          'amount' => $amount,
          'currency' => $currency,
          'id_user' => Auth::id(),
          'id_categorie' => $id_categorie
        );

        $id = db_quiz::insertGetId($values);

        //Cliente

       $mail_config = array(
         'name_app'=> 'Certify College',
         'subtitle'=> $title,
         'email_register' => $email,
         'content' => 'Acabas de crear una nueva prueba con el nombre de '.$title
       );

      try{ 
        Mail::send('email',$mail_config, function ($m) use ($mail_config) {
          $m->from('noreply@certifycollege.com', $mail_config['name_app']);
          $m->to($mail_config['email_register']);
          $m->subject($mail_config['subtitle']);
        });
      }
      catch(\Exception $e){
        return redirect('quiz/detail/'.$id);
      }
      //Admin
      $mail_config = array(
        'name_app'=> 'Certify College',
        'subtitle'=> 'Nueva prueba '.$title,
        'email_register' => 'diego@certifycollege.com',
        'content' => 'Se acaba de crear una nueva prueba con el nombre de '.$title.' cuyo administrador es '.$email
      );

      try{ 
        Mail::send('email',$mail_config, function ($m) use ($mail_config) {
          $m->from('noreply@certifycollege.com', $mail_config['name_app']);
          $m->to($mail_config['email_register']);
          $m->subject($mail_config['subtitle']);
        });
      }
      catch(\Exception $e){
        return redirect('quiz/detail/'.$id);
      }

      return redirect('quiz/detail/'.$id);
    }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        if(!db_quiz::where('id',$id)->exists()){
            return redirect('quiz/create');
        }
        $data = db_quiz::find($id);
        return view('quiz.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       /*if(!isset($id))
            return response()->json($res = array('e' => 1, 'msj' => 'Id de la prueba esta vacío'));     */

       $data = db_quiz::find($id);
       $data->categorie = categories::find($data->id_categorie);
       $data->categories = categories::all();  
       return view('quiz.edit', compact('data'));     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        /*if(!isset($id))
            return response()->json($res = array('e' => 1, 'msj' => 'Id de la prueba esta vacío'));*/

        $data = db_quiz::find($id);
        $title = $request->title;
        $email = $request->email;
        $description = $request->description;
        $amount = $request->amount;
        $currency = $request->currency;
        $url_to = $request->url_to;
        $id_categorie = $request->id_categorie;

        if(isset($title))
            $data['title'] = $title;
       
        if(isset($email))
            $data['email'] = $email;

        if(isset($description))
            $data['description'] = $description;

        if(isset($url_to))
            $data['url_to'] = $url_to;

        if(isset($amount))
            $data['amount'] = $amount;

        if(isset($currency))
            $data['currency'] = $currency;
        
        $data->save();

        return redirect('quiz/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        /*if(!isset($id))
            return response()->json($res = array('e' => 1, 'msj' => 'Id de la prueba esta vacío'));*/
                    
       $data_quiz = db_quiz::find($id);       
       $data_answers = db_answer::where('id_quiz',$id)->delete();
       $data_questions = db_questions::where('id_quiz',$id)->delete();
       $data_quiz->delete();

       return redirect('quiz/list');
    }

    public function getlist()
    {
        $url = config('app.url');
        //dd($url);

        $data = db_quiz::orderBy('id','desc')->Paginate(15);
       // dd($data);
        foreach ($data as $d) {
            $id_q = $d->id;
            $url_to = $d->url_to;
            $d->link = $url.'practica/'.$id_q;
            $d->categorie = categories::find($d->id_categorie);
           //dd($d->categorie->name);
        }   
        //dd($data);

        return view('quiz.list', compact('data'));
    }

    public function show_edit($id)
    {
        if(!db_quiz::where('id',$id)->exists()){
            return redirect('quiz/create');
        }
        $questions = db_questions::where('id_quiz',$id)->get();
        $data = db_quiz::find($id);
        $data->questions = $questions;
        foreach ($questions as $q) {
            $q->answer = db_answer::where('id_question',$q->id)->get();
        }

        $data->categorie = categories::find($data->id_categorie);

        return view('quiz.show',$data);
    }
}

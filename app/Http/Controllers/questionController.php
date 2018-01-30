<?php

namespace App\Http\Controllers;

use App\db_answer;
use App\db_questions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class questionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function index()
    {
        //
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
        $name = $request->name;
        $id_quiz = $request->id_quiz;

        /*if(!isset($name))
            return response()->json($res = array('e' => 1, 'msj' => 'La pregunta está vacía'));*/
        
        /*if(!isset($id_quiz))
            return response()->json($res = array('e' => 1, 'msj' => 'Id de la prueba esta vacío'));*/        

        $values = array(
            'name' => $name,
            'id_quiz' => $id_quiz,
            'created_at' => Carbon::now(),
        );

        db_questions::insertGetId($values);
        return redirect('quiz/detail/'.$id_quiz);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = db_questions::find($id);        
        $data['answers'] = db_answer::where('id_question',$id)->get();
        
       
        return view('question.edit', compact('data') );
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
            return response()->json($res = array('e' => 1, 'msj' => 'Id de la pregunta está vacío'));*/

        $data = db_questions::find($id);
        $name = $request->name;

        if(isset($name))
            $data['name'] = $name;

        $data->save();

        return redirect('question/edit/'.$id.'');
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
            return 'Id de la pregunta esta vacio';*/

        $data_questions = db_questions::find($id);        
        $id_quiz = $data_questions['id_quiz']; 

        $data_answer = db_answer::where('id_question',$id)->delete();
        $data_questions->delete();

       return redirect('quiz/detail/'.$id_quiz.'');
    }
}

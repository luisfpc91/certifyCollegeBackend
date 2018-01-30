<?php

namespace App\Http\Controllers;

use App\db_answer;
use App\db_questions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class answerController extends Controller
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
        $value = $request->value;
        $id_quiz = $request->id_quiz;
        $id_question = $request->id_question;                   

        /*if(!isset($name))
            return response()->json($res = array('e' => 1, 'msj' => 'la respuesta está vacía'));*/        

        /*if(!isset($value))
            return response()->json($res = array('e' => 2, 'msj' => 'El valor está vacío'));*/        

        /*if(!isset($id_quiz))
            return response()->json($res = array('e' => 3, 'msj' => 'Id de la prueba está vacío'));*/      

        /*if(!isset($id_question))
            return response()->json($res = array('e' => 4, 'msj' => 'Id de la pregunta está vacío'));*/           

        $values = array(
            'name' => $name,
            'value' => $value,
            'id_quiz' => $id_quiz,            
            'id_question' => $id_question,
            'created_at' => Carbon::now()
        );

        $id = db_answer::insertGetId($values);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $id_q, Request $request)
    {
        $data = db_answer::find($id);
        $name = $request->name;
        $value = $request->value;
        //dd($name);
        if(isset($name))
            $data['name'] = $name;
        
        if(isset($value))
            $data['value'] = $value;
        
        $data->save();

        return redirect('question/edit/'.$id_q.'');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id, $id_q)
    {
        /*if(!isset($id))
            return response()->json($res = array('e' => 1, 'msj' => 'Id de la respuesta está vacío'));*/

        /*if(!isset($id_q))
            return response()->json($res = array('e' => 1, 'msj' => 'Id de la pregunta está vacío'));*/
        //dd($id);
        $data_answer = db_answer::find($id);
        $data_answer->delete();
        return redirect('question/edit/'.$id_q.'');
    }
}

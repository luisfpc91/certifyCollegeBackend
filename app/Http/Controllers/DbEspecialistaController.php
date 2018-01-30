<?php

namespace App\Http\Controllers;

use App\db_especialista;
use App\db_quiz;
use Illuminate\Http\Request;

class DbEspecialistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    
    public function index()
    {
        $data = db_quiz::all();    
        return view('specialist.create',compact('data'));
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
        $description = $request->description;
        $id_quiz = $request->id_quiz;

        $values = array(
            'name' => $name,
            'description' => $description,
            'id_quiz' => $id_quiz
        );

        $id = db_especialista::insertGetId($values);
        $data = db_quiz::all();  
        return view('specialist.create',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\db_especialista  $db_especialista
     * @return \Illuminate\Http\Response
     */
    public function show(db_especialista $db_especialista)
    {
        $data = db_especialista::orderBy('id','desc')->Paginate(15);

        foreach ($data as $i) {
            $datos = db_quiz::find($i->id_quiz);
            $i->prueba = $datos;    
        }

        return view('specialist.list',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\db_especialista  $db_especialista
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = db_especialista::find($id);       
        $datos = db_quiz::all();
        $data->prueba = $datos;
        return view("specialist.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\db_especialista  $db_especialista
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $id_quiz = $request->id_quiz;

        $data = db_especialista::find($id);

        if(isset($name)){
            $data['name'] = $name;
        }

        if(isset($description)){
            $data['description'] = $description;
        }

        if(isset($id_quiz)){
            $data['id_quiz'] = $id_quiz;
        }

        $data->save();
        return redirect('specialist/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\db_especialista  $db_especialista
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = db_especialista::find($id);
        $data->delete();
        return redirect('specialist/list');
    }
}

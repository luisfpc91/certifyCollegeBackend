<?php

namespace App\Http\Controllers;

use App\categories;
use Illuminate\Http\Request;
use App\db_quiz;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
        $data = categories::orderBy('id','desc')->Paginate(15);
        foreach ($data as $d) {
            $d->quiz = db_quiz::where('id_categorie',$d->id)->get();
        }
        //dd($data);
        return view('categorie.list',compact('data')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorie.create');
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
        $data = array(
            'name' => $name
            );
            
        $id = categories::insertGetId($data);
        
        return view('categorie.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(categories $categories)
    {
        $data = categories::all();
        foreach ($data as $d) {
            $d->quiz = db_quiz::where('id_categorie',$d->id);
        }

        return response()->json($res = array('e' => 0, 'data' => $data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id, categories $categories)
    {
        $id = $id;
        $data = categories::find($id);
        return view('categorie.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, categories $categories)
    {
        $name = $request->name;

        $data = categories::find($id);
        if(isset($name))
            $data['name'] = $name;
            
        $data->save();            

        return redirect('categorie/edit/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, categories $categories)
    {
        $id = $id;
        $data = categories::find($id);
        $data->delete();

        return redirect('categorie/list');

    }

    public function index_api(){

        $data = categories::all();
        foreach ($data as $d) {
            $d->quiz = db_quiz::where('id_categorie',$d->id)->get();
        }
        return response()->json($res = array('e' => 0, 'data' => $data));
    }
}

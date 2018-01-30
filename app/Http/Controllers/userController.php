<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //$data = User::orderBy('id','desc')->get();
        $data = User::orderBy('id','desc')->Paginate(15);
        return view('user.list', compact('data'));
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
            $data = User::find($id);
            return response()->json($res = array('e' => 0, 'msj' => 'Datos del Usuario', 'data' => $data));
        }else
            return response()->json($res = array('e' => 1, 'msj' => 'No existe el Id del usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $user = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['pass'])            
        );

        if(isset($user)){
            $id = User::insertGetId($user);

            
            if(isset($id)){

                //Cliente                
                $mail_config = array(
                    'name_app'=> 'Certify College',
                    'subtitle'=> 'Registro exitoso',
                    'email_register' => $data['email'],
                    'content' => '¡Gracias por registrarte! Si estás listo para certificarte entra a nuestro catálogo en certifycollege.com'
                );
                try{  
                    Mail::send('email',$mail_config, function ($m) use ($mail_config) {
                        $m->from('noreply@certifycollege.com', $mail_config['name_app']);
                        $m->to($mail_config['email_register']);
                        $m->subject($mail_config['subtitle']);
                    });
                }
                catch(\Exception $e){
                    return response()->json($res = array(
                        'e' => 0, 
                        'msj' => 'registro exitoso',
                        'msj2' => 'Error al intentar mandar el email',  
                        'id' => $id)
                    );
                }   

                //Admin
                $mail_config = array(
                    'name_app'=> 'Certify College',
                    'subtitle'=> 'Nuevo usuario registrado',
                    'email_register' => 'diego@certifycollege.com',
                    'content' => 'Se acaba de registrar el usuario '.$data['email']
                );

                try{ 
                    Mail::send('email',$mail_config, function ($m) use ($mail_config) {
                        $m->from('noreply@certifycollege.com', $mail_config['name_app']);
                        $m->to($mail_config['email_register']);
                        $m->subject($mail_config['subtitle']);
                    });
                }
                catch(\Exception $e){
                    return response()->json($res = array(
                        'e' => 0, 
                        'msj' => 'registro exitoso',
                        'msj2' => 'Error al intentar mandar el email',  
                        'id' => $id)
                    );
                }  
            }
            

            return response()->json($res = array('e' => 0, 'msj' => 'registro exitoso', 'id' => $id));
        }else
            return response()->json($res = array('e'=> 1, 'msj' => 'registro fallido'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $email = $email;
        if(User::where('email',$email)->exists()){
            $data = User::where('email',$email)->first();
            return response()->json($res = array('e' => 0, 'msj' => 'Bienvenido', 'data' => $data));
        }else
            return response()->json($res = array('e' => 1, 'msj' => 'Debe registrarse'));     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);    
        return view('user.edit', compact('data') );
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
            return response()->json($res = array('e' => 1, 'msj' => 'Id de la pregunta esta vac���o'));*/

        $data = User::find($id);
        $name = $request->name;
        $email = $request->email;
        $level = $request->level;
        $pass = $request->pass;
        $pass_confi = $request->pass_confi;

        if(isset($name))
            $data['name'] = $name;

        if(isset($email))
            $data['email'] = $email;

        if(isset($level))
            $data['level'] = $level;

        if(isset($pass))
            if(isset($pass_confi))
                if ($pass == $pass_confi) {
                    $data['password'] = bcrypt($pass);

                    //Cliente
                    /*
                    $mail_config = array(
                        'name_app'=> 'Certify College',
                        'subtitle'=> 'Contraseña cambiada',
                        'email_register' => $email,
                        'content' => 'Acabas de cambiar la contraseña de tu usuario '.$email
                    );

                    Mail::send('email',$mail_config, function ($m) use ($mail_config) {
                        $m->from('noreply@websquemolan.com', $mail_config['name_app']);
                        $m->to($mail_config['email_register']);
                        $m->subject($mail_config['subtitle']);
                    });

                    if( count(Mail::failures()) > 0 ) {
                        $errors = 'There was one or more failures. They were: <br />';
                        foreach(Mail::failures as $email_address) {
                           $errors = " - $email_address <br />";
                        }
                        return response()->json($res = array('error' => $errors));
                    }

                    //Admin
                    $mail_config = array(
                        'name_app'=> 'Certify College',
                        'subtitle'=> 'Se cambio una contraseña se usuario',
                        'email_register' => 'diego@certifycollege.com',
                        'content' => 'Se acaba de cambiar la contraseña del usuario '.$email
                    );

                    Mail::send('email',$mail_config, function ($m) use ($mail_config) {
                        $m->from('noreply@websquemolan.com', $mail_config['name_app']);
                        $m->to($mail_config['email_register']);
                        $m->subject($mail_config['subtitle']);
                    });
                    
                    if( count(Mail::failures()) > 0 ) {
                        $errors = 'There was one or more failures. They were: <br />';
                        foreach(Mail::failures as $email_address) {
                           $errors = " - $email_address <br />";
                        }
                        return response()->json($res = array('error' => $errors));
                    }
                    */
                }else
                    return response()->json($res = array('e' => 1, 'msj' => 'Las contraseñas deben ser iguales'));

        $data->save();

        if(Auth::id() == $id){
            if($pass == $pass_confi){
                Auth::logout();
                return redirect('/login');
            }        
        }
        return redirect('/user/edit/'.$id.'');
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
            return response()->json($res = array('e' => 1, 'msj' => 'Id del usuario esta vacio'));*/

        $data = User::find($id);   
        $data->delete();

       return redirect('/user/list');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');        
    }

    public function myUser()
    {   
        $id = Auth::id();
        $data = User::find($id);
        return view('user.edit', compact('data'));
    }
}

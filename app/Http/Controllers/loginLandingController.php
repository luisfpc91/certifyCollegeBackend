<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class loginLandingController extends Controller
{
	
	public function login(Request $request){		
		$data = $request->all(); 
		$act = $data['act'];
		if(isset($act)){
			switch ($act) {
				case 'normal':
					$user_data = array(
						'email' => $data['email'],
						'password' => $data['password']
					);

					if(Auth::attempt($user_data)){
						$user = Auth::user();
						return response()->json($res = array('e' => 0, 'msj' => 'Bienvenido', 'data' => $user));
					}else
						return response()->json($res = array('e' => 1, 'msj' => 'Datos incorrectos'));

					break;			
				case 'facebook':
					$user_new_pass = $data['token'];

					User::where('email',$data['email'])->update( ['password' => bcrypt($user_new_pass)] );

					$user_data = array(
						'email' => $data['email'],
						'password' => $user_new_pass
					);

					if(Auth::attempt($user_data)){
						$user = Auth::user();
						return response()->json($res = array('e' => 0, 'msj' => 'Bienvenido usuario de Facebook', 'data' => $user));
					}else
						return response()->json($res = array('e' => 1, 'msj' => 'Datos incorrectos, inicio de sesión con Facebook'));

					break;
			}
		}else
			return reponse()->json($res = array('e' => 1, 'msj' => 'Debe enviar un act'));
		
	} 

	public function logout(){
		Auth::logout();
        return redirect('http://localhost/certify_college');   
	}      				
}

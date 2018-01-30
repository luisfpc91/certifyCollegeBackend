<?php

namespace App\Http\Controllers;

use App\payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentsController extends Controller
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
        
        $currency = $request->currency;
        $amount = $request->amount;
        $status = $request->status;
        $email = $request->email;
        $payment_id = $request->payment_id;
        $payer_id = $request->payer_id;

        if(!isset($currency))
            return response()->json($res = array('e' => 1, 'msj' => 'currency vacío'));   
        
        if(!isset($amount))
            return response()->json($res = array('e' => 1, 'msj' => 'amount vacío'));
        
        if(!isset($status))
            return response()->json($res = array('e' => 1, 'msj' => 'status vacío'));
        
        if(!isset($email))
            return response()->json($res = array('e' => 1, 'msj' => 'email vacío'));
        
        if(!isset($payment_id))
            return response()->json($res = array('e' => 1, 'msj' => 'payment_id vacío'));
        
        if(!isset($payer_id))
            return response()->json($res = array('e' => 1, 'msj' => 'payer_id vacío'));

        $token = str_random(10);
        if(!isset($token))
            return response()->json($res = array('e' => 1, 'msj' => 'token vacío'));

        $data = array(
            'currency' => $currency,
            'amount' => $amount,
            'status' => $status,
            'email' => $email,
            'payment_id' => $payment_id,
            'payer_id' => $payer_id,
            'token' => $token
        );  
        $id = payments::insertGetId($data);

        $datos = payments::find($id);
        $token_db = $datos->token;
        $url = $request->url;

        $url_final = $url.'/'.$token_db;
	
	//dd($id);
        //dd($email);
        
        if(isset($id)){

            //cliente
            $mail_config = array(
                'name_app'=> 'Certify College',
                'subtitle'=> 'Pago realizado exitosamente',
                'email_register' => $email,
                'content' => '¡Genial! Tu pago ha sido procesado. Haz click en el siguiente enlace para comenzar tu certificación '.$url_final
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
                    'msj' => 'Pago registrado',
                    'url_final' => $url_final,
                    'msj2' => 'Error al intentar enviar el e-mail')
                );
            }
            
            //Admin
            $mail_config = array(
                'name_app'=> 'Certify College',
                'subtitle'=> 'Pago realizado exitosamente',
                'email_register' => 'diego@certifycollege.com',
                'content' => 'Se acaba de realizar un pago exitoso de'.$amount.' '.$currency
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
                    'msj' => 'Pago registrado',
                    'url_final' => $url_final,
                    'msj2' => 'Error al intentar enviar el e-mail')
                );
            }
        }       	

        return response()->json($res = array('e' => 0, 'msj' => 'Pago registrado', 'url_final' => $url_final));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function show(payments $payments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit(payments $payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payments $payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function destroy(payments $payments)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\paypal;
use Illuminate\Http\Request;

class PaypalController extends Controller
{

    public function __construct()
    {
        $this->_apiContext = array(
            'clientID' => 'AQARphiP45oew1EcvSZRG7YaaCH-jphTUUYpmhuDBbqDkhMvYm9HhNE0hQyNfY5lMiEzZnk2WyGCpzwi',
            'tokenSecret' => 'EHvJZLca1IjcEu-Y1jaq2tL1awIhMjq1ofK4jUXNXbKbt6U6BhS38MnUM53N8KFtjigMtCwmvqnXedUD',
            'endPoint' => 'https://api.sandbox.paypal.com' //'https://api.paypal.com', //for sandbox /
        );
    }
    /**
     *Dev for Leifer33@gmail.com
     */
    public function call($method=null)
    {
        $params = null;
        if(is_null($method)) return 'Method is NULL';
        if($method=='token') $params = '/v1/oauth2/token';
        $url = $this->_apiContext['endPoint'].$params;

        $headers = array(
            'Content-Type:application/x-www-form-urlencoded',
        );
        $post = array(
            'grant_type'=>'client_credentials'
        );

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD,  $this->_apiContext['clientID'].":". $this->_apiContext['tokenSecret']);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $post ) );
        $return=curl_exec( $ch );
        curl_close($ch);
        $return = json_decode($return);
        return $return->access_token;
    }
    /**
     *Dev for Leifer33@gmail.com
     */
    public function payment($method=null,$access_token=null,$amount=null,$id_order)
    {
        $params = null;
        if(is_null($access_token)) return 'Access token is NULL';
        if(is_null($method)) return 'Method is NULL';
        if($method=='payment') $params = '/v1/payments/payment';
        $url = $this->_apiContext['endPoint'].$params;

        $headers = array(
            'Authorization:Bearer '.$access_token,
            'Content-Type:application/json ',
        );

        $post = array(
            "intent"=>"sale",
            "redirect_urls" => array(
                "return_url" => config("app.url")."/payres?status=success&amount=".$amount."&id_order=".$id_order,
                "cancel_url" => config("app.url")."/payres?status=fail&amount=".$amount."&id_order=".$id_order
            ),
            "payer" => array(
                "payment_method" => "paypal"
            ),
            "transactions" => [
                ["amount"=>array(
                    "total" => floatval($amount),
                    "currency" => "MXN"
                )]
            ]
        );


        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post ) );
        $return=curl_exec( $ch );
        curl_close($ch);
        $return = json_decode($return);
        return $return;
    }

    public function execute($access_token=null,$id_pay=null,$id_payer=null)
    {

        if(is_null($access_token)) return 'Access token is NULL';
        $params = '/v1/payments/payment/'.$id_pay.'/execute';
        $url = $this->_apiContext['endPoint'].$params;

        $headers = array(
            'Authorization:Bearer '.$access_token,
            'Content-Type:application/json ',
        );

        $post = array(
            "payer_id"=>$id_payer,
        );


        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post ) );
        $return=curl_exec( $ch );
        curl_close($ch);
        $return = json_decode($return);
        return $return;
    }
    /**
     *Dev for Leifer33@gmail.com
     */
    public function getdetail($id=null,$access_token=null)
    {

        if(is_null($id)) return 'ID is NULL';

        if(is_null($access_token)) return 'TOken is NULL';

        $params = '/v1/payments/payment/'.$id;
        $url = $this->_apiContext['endPoint'].$params;

        $headers = array(
            'Authorization:Bearer '.$access_token,
            'Content-Type:application/json',
        );


        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        //curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        //curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $post ) );
        $return=curl_exec( $ch );
        curl_close($ch);
        $return = json_decode($return);
        return $return;
    }


    public function create(Request $request)
    {
        $amount = $request->amount;
        $amount = floatval($amount);
        $id_order = $request->id;
        if($amount>0){
            $pay=$this->payment('payment',$this->call('token'),$amount,$id_order);
            return response()->json($pay->links[1]->href);
        }else{
            return 'Amount is 0';
        }

    }


    public function response(Request $request)
    {
        $status = $request->input('status');

        $paymentId = $request->input('paymentId');
        $PayerID = $request->input('PayerID');

        $res = $this->execute($this->call('token'),$paymentId,$PayerID);
        $res =  (array) $res;

        $id_order = $request->input('id_order');

        if(isset($status)){
            if($status=='fail'){

                return redirect(config("app.url_from")."error.php?status=".$status."&id=".$id_order);
            }
        }

        $values = array(
            'status' => $res['state'],
            'id_order' => $id_order,
            'amount' => $res['transactions'][0]->amount->total,
            'state_transition' => $res['transactions'][0]->related_resources[0]->sale->state,


        );



        /*
        AQUI GUARDA EN BD
        if($values['state_transition']=='completed'){
            Reservation::where('id',$id_order)->update([
                'status' => 'authorized',
                'payment_method' => 'PAYPAL'
            ]);

            //AQUI SE DISPARA EL MAIL

        }*/

        return redirect(config("app.url_from")."gracias.php?status=success&amount=".$res['transactions'][0]->amount->total."&id=".$id_order."&PayerID=".$PayerID."&paymentId=".$paymentId);
    }

}

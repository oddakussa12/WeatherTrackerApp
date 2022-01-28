<?php

class CustomController {

    public function registerCustomer()
    {
        
        // $phone = '09034489475';
        // // check if customer exist Already
        // $customer = \App\Models\Customer::where('phone',$phone)->first();
        // if($customer != null){
        //     return "already registered customer";
        // }else{
        //     $customer = new \App\Models\Customer();
        //     $customer->phone = $phone;
        //     $date = date('y-m-d h:i:s');
        //     $payingDate = date('Y-m-d h:i:s', strtotime($date. ' + 3 days'));
        //     $customer->payingDate = $payingDate;
        //     $customer->save();
        // }
    
        // remotly register the user
        $client = new \GuzzleHttp\Client();
        $response = $client->request('post', 'https://jakedu.yenesera.com/api/users', [
            'body' => '{"phone":"0986070044"}',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
                // 'Authorization' => 'Basic BgxsDwd00n.LNNn90QydrjgZ1K9dS13',
            ],
        ]);
        $responseCode = (string) $response->getBody();
        if($responseCode == 1){
            // return "Success";
            $verificationCode = mt_rand(100000,999999);
            echo $verificationCode;
            //send sms
            //$phone
            //$sms
            //file_get_contents("http://localhost:13014/cgi-bin/sendsms?user=Alif@sms&password=Alif@123&encoding=2&charset=ASCII&to=".$phone."&from=7753&text=$sms");
        }else{
            return "Failed";
        }
       

        

    }

    public function deleteCustomer(){
        $customer = \App\Models\Customer::where('phone',$phone)->first();
        if($customer){
            return $customer->delete();
        }
        // remotly delete the user
        $client = new \GuzzleHttp\Client();
        $response = $client->request('post', 'https://jakedu.yenesera.com/api/users/delete', [
            'body' => '{
                "_method":"delete",
                "phone":"0900048941"
            }',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
                // 'Authorization' => 'Basic BgxsDwd00n.LNNn90QydrjgZ1K9dS13',
            ],
        ]);
        echo $response->getBody();
    }

}

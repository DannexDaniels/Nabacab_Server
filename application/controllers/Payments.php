<?php
/**
 * Created by PhpStorm.
 * User: dannexdaniels
 * Date: 13/01/19
 * Time: 16:55
 */
 
 require_once(APPPATH.'libraries/stripe/init.php');

class Payments extends CI_Controller
{
    protected $consumer_key = 'D0Ph4hdxWsprpXRwokIh3JHlDwuvAMDT';
    protected $consumer_secret = 'oAWG2HLw5YAIj3SV';
    protected $header = ['Content-Type:application/json; charset=utf8'];


    
    public function index()
    {
        \Stripe\Stripe::setApiKey('sk_test_k8Dji1AqNrtrneYtjwV84dMy');
        $charge = \Stripe\Charge::create(['amount' => 6000, 'currency' => 'kes', 'source' => 'tok_visa']);
        echo $charge;
    }

    /*
     * Method to reverse a any kind of transaction
     */
    public function reverseTransaction(){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accessToken())); //setting custom header

        $initiator = 'testapi';
        $securityCredential = 'YZI7YL7OctylJPmOHvbL8qnOAcTFT7XXYIhCf3z96PaBnHqOf4FJ/5wZzHhQBMvRg55L0sYtBC04C5wvRJchU+kur+fyChE+clphFime+4MQP5qTTICQpkv2P43T4wDfkBM2nuZt3UXvys2QXYwi+kEO1Ju5L48bf+f+pjceFBrGokf0I1wLgpvb67ez25zkb0NaHzPygcNFqgkkFs2wVitMDQWTJnVW+TCjtGI872c60LPWmtvufQBxYZpFBhPLQeWz0mhoQmiT3V8PZJwC3+YMjYZ+cvaojQloYZ8toFNeutK/J8wlluHlx4bpHhXHgCj3R16e5Qa+7Q2SfXWx5Q==';
        $transactionID = 'NAE71H7XZ9';
        $amount = '70000';
        $paybill = '600165';
        $remarks = 'Check transaction status';
        $resultUrl = 'https://dannextech.com/nabacab/MpesaPayments/callbackUrl';
        $queueTimeOutUrl = 'https://dannextech.com/nabacab/MpesaPayments/callbackUrl';
        $occassion = 'Dannex Tech';

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'Initiator' => $initiator,
            'SecurityCredential' => $securityCredential,
            'CommandID' => 'TransactionReversal',
            'TransactionID' => $transactionID,
            'Amount' => $amount,
            'ReceiverParty' => $paybill,
            'RecieverIdentifierType' => '11',
            'ResultURL' => $resultUrl,
            'QueueTimeOutURL' => $queueTimeOutUrl,
            'Remarks' => $remarks,
            'Occasion' => $occassion
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }

    /*
     * Method to get the transaction status of any transaction that was performed
     */
    public function transactionStatus(){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accessToken())); //setting custom header

        $initiator = 'testapi';
        $securityCredential = 'YZI7YL7OctylJPmOHvbL8qnOAcTFT7XXYIhCf3z96PaBnHqOf4FJ/5wZzHhQBMvRg55L0sYtBC04C5wvRJchU+kur+fyChE+clphFime+4MQP5qTTICQpkv2P43T4wDfkBM2nuZt3UXvys2QXYwi+kEO1Ju5L48bf+f+pjceFBrGokf0I1wLgpvb67ez25zkb0NaHzPygcNFqgkkFs2wVitMDQWTJnVW+TCjtGI872c60LPWmtvufQBxYZpFBhPLQeWz0mhoQmiT3V8PZJwC3+YMjYZ+cvaojQloYZ8toFNeutK/J8wlluHlx4bpHhXHgCj3R16e5Qa+7Q2SfXWx5Q==';
        $transactionID = 'NBI4XIM97K';
        $paybill = '174379';
        $remarks = 'Check transaction status';
        $resultUrl = 'https://dannextech.com/nabacab/MpesaPayments/callbackUrl';
        $queueTimeOutUrl = 'https://dannextech.com/nabacab/MpesaPayments/callbackUrl';
        $occassion = 'Dannex Tech';

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'Initiator' => $initiator,
            'SecurityCredential' => $securityCredential,
            'CommandID' => 'TransactionStatusQuery',
            'TransactionID' => $transactionID,
            'PartyA' => $paybill,
            'IdentifierType' => '1',
            'ResultURL' => $resultUrl,
            'QueueTimeOutURL' => $queueTimeOutUrl,
            'Remarks' => $remarks,
            'Occasion' => $occassion
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }

    /*
     * Method to get account balance for either paybill or till number
     */
    public function accountBalance(){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';

        $initiator = 'testapi';
        $securityCredential = 'ANB+0mxKGZYa+FuUyrCvZvdlVHqbijem+bmqegZ1njRYgMbLkfEtvAaCba6Ioq/B4gFrgm24LCBUg1V1EwDqXIHmh5zCaiNWQGWFwlj67PUy08UakV944QLPpJexSr2PBTNF6F9ZRZQ2eO6cRlwZnKIpGfFiRpW1GivLMR+jtGaaUPdu0F8T6l2NUXL9pSFmFKc4nokwe8MhXtiA5LPARYoGApbF/8300sLm54v12hiUfy0kDOgD8ESAoygqx0c1VpnMZl+imk4HIy95RnZW45dnQYIT9bAN7IseBQMCC5Tv+poYazSFAfgQPt9SH9+NqDLgJiaNOuKl1AwQ4gncpw==';
        $paybill = '600165';
        $remarks = 'Check account balance';
        $resultUrl = 'https://dannextech.com/nabacab/MpesaPayments/callbackUrl';
        $queueTimeOutUrl = 'https://dannextech.com/nabacab/MpesaPayments/callbackUrl';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accessToken())); //setting custom header



        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'Initiator' => $initiator,
            'SecurityCredential' => $securityCredential,
            'CommandID' => 'AccountBalance',
            'PartyA' => $paybill,
            'IdentifierType' => '4',
            'Remarks' => $remarks,
            'QueueTimeOutURL' => $queueTimeOutUrl,
            'ResultURL' => $resultUrl
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;

    }

    /*
     * Method to process payment from one paybill to another
     * Results saved in the callback url
     */
    public function b2bPayment(){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';

        //variables that we'll need
        $initiatorName = 'testapi';
        $securityCredential = 'ANB+0mxKGZYa+FuUyrCvZvdlVHqbijem+bmqegZ1njRYgMbLkfEtvAaCba6Ioq/B4gFrgm24LCBUg1V1EwDqXIHmh5zCaiNWQGWFwlj67PUy08UakV944QLPpJexSr2PBTNF6F9ZRZQ2eO6cRlwZnKIpGfFiRpW1GivLMR+jtGaaUPdu0F8T6l2NUXL9pSFmFKc4nokwe8MhXtiA5LPARYoGApbF/8300sLm54v12hiUfy0kDOgD8ESAoygqx0c1VpnMZl+imk4HIy95RnZW45dnQYIT9bAN7IseBQMCC5Tv+poYazSFAfgQPt9SH9+NqDLgJiaNOuKl1AwQ4gncpw==';
        $commandID = 'BusinessPayBill';
        $amount = '100';
        $receiver = '600000';
        $paybillNo = '600165';
        $accountReference = 'Bill Payment';
        $resultUrl = 'https://dannextech.com/nabacab/MpesaPayments/callbackUrl';
        $queueTimeOutUrl = 'https://dannextech.com/nabacab/MpesaPayments/callbackUrl';
        $senderIdentifierType = '4';
        $recieverIdentifierType = '4';
        $remarks = 'pay for rent and renovation';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accessToken())); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'Initiator' => $initiatorName,
            'SecurityCredential' => $securityCredential,
            'CommandID' => $commandID,
            'SenderIdentifierType' => $senderIdentifierType,
            'RecieverIdentifierType' => $recieverIdentifierType,
            'Amount' => $amount,
            'PartyA' => $paybillNo,
            'PartyB' => $receiver,
            'AccountReference' => $accountReference,
            'Remarks' => $remarks,
            'QueueTimeOutURL' => $queueTimeOutUrl,
            'ResultURL' => $resultUrl
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }

    /*
     * Method to process payment from one paybill to a clients phone number
     * Results saved in the callback url
     */
    public function b2cPayment(){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';

        //variables that we'll need
        $initiatorName = 'testapi';
        $securityCredential = 'j33OCK1eWiSIO2jU8uPwCT7zm64ptmou0uyG6XPqbVebB81aksR78eV28om7SzQarGYtFhMwMN7mgqNtaMjxoEp8I8Bq7O+n5oN2nrPqFdJv6sMa/OVW5AkDh+dHwi/fbJ+1VuOcj4e4EHmP3md/XKwvJODc/MMkGohfPxVc54bJnkimCWvJXGuVZMBAJ4halb5U1sqpkYX3emMbUa4FilDjwAnQK5NCEeJYvvUVRHDU73+RRv3EijjEoj44fUbovP/VrejwuX5sBRA4DH7smurLLf3jfGDXLD7JNomfd1Bg0FDJr1vWcAykoq9P3hMMzebGGXm1esfaNdeNbL5hRg==';
        $commandID = 'SalaryPayment';
        $amount = '5000';
        $receiver = '254708374149';
        $paybillNo = '600165';
        $remarks = 'Salary';
        $resultUrl = 'https://dannextech.com/nabacab/MpesaPayments/callbackUrl';
        $queueTimeOutUrl = 'https://dannextech.com/nabacab/MpesaPayments/callbackUrl';
        $occassion = 'Salary February 2019';


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accessToken())); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'InitiatorName' => $initiatorName,
            'SecurityCredential' => $securityCredential,
            'CommandID' => $commandID,
            'Amount' => $amount,
            'PartyA' => $paybillNo,
            'PartyB' => $receiver,
            'Remarks' => $remarks,
            'QueueTimeOutURL' => $queueTimeOutUrl,
            'ResultURL' => $resultUrl,
            'Occasion' => $occassion
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;

    }

    /*
     * Method to pay on a paybill number i.e. client to a business
     * the response/result of the transaction is shown to the callbackUrl
     */
    public function c2bPayment(){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        date_default_timezone_set("Africa/Nairobi");//set you countary name from below timezone list

        //variables required
        $businessShortCode = '174379';
        $timeStamp = date('YmdHis');
        $payer = $this->input->post('phone');
        $amount = $this->input->post('cost');
        $callbackUrl = 'https://dannextech.com/nabacab/Payments/callbackUrl/'.$this->input->post('pay_no');
        $accountReference = $this->input->post('receipt');//invoice id, checkout id, transaction id etc
        $transactionDesc = $this->input->post('description');
        $passKey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $password = base64_encode($businessShortCode.$passKey.$timeStamp);


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accessToken())); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $businessShortCode,
            'Password' => $password,
            'Timestamp' => $timeStamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $payer,
            'PartyB' => $businessShortCode,
            'PhoneNumber' => $payer,
            'CallBackURL' => $callbackUrl,
            'AccountReference' => $accountReference,
            'TransactionDesc' => $transactionDesc
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);
        
        //print_r($data_string);

        //echo $curl_response;
    }

    /*
     * Method to confirm the PayBill transaction
     * It shows details of the transaction that can be saved in the database
     * You can save the result of the confirmation in a database/file etc
     */
    public function callbackUrl($pay_no){
        $response = '{
            "ResultCode": 0,
            "ResultDesc": "Confirmation Received Successfully"
        }';

        $mpesa_response = file_get_contents('php://input');

        //log the response
        $logfile = "M_PesaResponseCallback.txt";
        $json_mpesa_response = json_decode($mpesa_response, true);

        //write to file
        $log = fopen($logfile,"w");

        fwrite($log,$mpesa_response);
        fclose($log);
        
        $respCode = null;
        
        if($json_mpesa_response["Body"]["stkCallback"]["ResultCode"] == "0"){
            $respCode = array(
                "result_code" => $json_mpesa_response["Body"]["stkCallback"]["ResultCode"],
                "result_desc" => $json_mpesa_response["Body"]["stkCallback"]["ResultDesc"],
                "amount" => $json_mpesa_response["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"],
                "receipt_no" => $json_mpesa_response["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"],
                "transaction_date" => $json_mpesa_response["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"],
                "phone_no" => $json_mpesa_response["Body"]["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"],
                "pay_no" => $pay_no
            );
        }
        
        
        //print_r(json_encode($respCode));
        
        
        $this->paymentModel->addMpesa($respCode);
        
        echo $response;
    }

    /*
     * Simulating a transaction to act like a real one
     * This is an example of making payment to a till number
     * The results should be stored in the file created in the confirmationUrl
     */
    public function simulateTransaction(){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accessToken())); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => '600165',
            'CommandID' => 'CustomerPayBillOnline',
            'Amount' => '70000',
            'Msisdn' => '254708374149',
            'BillRefNumber' => 'Bill200'
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;

    }

    /*
     * Registering the confirmation & the Validation urls
     * They will be used to validate and confirm a transaction before and after it is processed
     */
    public function registerUrl(){
        $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accessToken())); //setting custom header


        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => '600165',
            'ResponseType' => 'Confirmed',
            'ConfirmationURL' => 'https://dannextech.com/nabacab/MpesaPayments/confirmationUrl',
            'ValidationURL' => 'https://dannextech.com/nabacab/MpesaPayments/validationUrl'
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $this->accessToken()."-".$curl_response;
    }

    /*
     * Method to confirm a transaction simulated
     * It shows details of the transaction that can be saved in the database
     * You can save the result of the confirmation in a database/file etc
     */
    public function confirmationUrl(){
        $response = '{
            "ResultCode": 0,
            "ResultDesc": "Confirmation Received Successfully"
        }';

        $mpesa_response = file_get_contents('php://input');

        //log the response
        $logfile = "M_PesaResponseConf.txt";
        $json_mpesa_response = json_decode($mpesa_response, true);

        //write to file
        $log = fopen($logfile,"a");

        fwrite($log,$mpesa_response);
        fclose($log);
        echo $response;
    }

    /*
     * Method to validate the transaction
     */
    public function validationUrl(){
        $response = '{
            "ResultCode": 0,
            "ResultDesc": "Confirmation Received Successfully"
        }';

        $mpesa_response = file_get_contents('php://input');

        //log the response
        $logfile = "M_PesaResponseVal.txt";
        $json_mpesa_response = json_decode($mpesa_response, true);

        //write to file
        $log = fopen($logfile,"a");

        fwrite($log,$mpesa_response);
        fclose($log);
        echo $response;
    }


    /*
     * Generating an access token
     * Required for any transaction to be performed
     */
    public function accessToken(){
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        //initiate the curl
        $curl = curl_init($url);

        //setting up the header
        curl_setopt($curl,CURLOPT_HTTPHEADER, $this->header);
        //setting up the options
        curl_setopt($curl,CURLOPT_HTTPHEADER,$this->header);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($curl,CURLOPT_HEADER,FALSE);
        curl_setopt($curl,CURLOPT_USERPWD, $this->consumer_key.':'.$this->consumer_secret);

        //gettting the status of the request. not required though...
        //$status = curl_getinfo($curl,CURLINFO_HTTP_CODE);

        //changing the result from JSON to Array
        $result = json_decode(curl_exec($curl));

        curl_close($curl);


        return $result->access_token;

    }
    
    
    /*
    * Methods to handle general payments
    */
    
    public function make_payment(){
        $data = array(
            'pay_id' => 'PAY'.rand(),
            'pay_amount' => $this->input->post('amount'),
            'pay_mode' => $this->input->post('mode'),
            'pay_by' => $this->input->post('client'),
            'pay_to' => $this->input->post('driver'),
            'pay_request' => $this->input->post('id')
        );
        
        $this->paymentModel->addPayment($data);
        
        $results = array(
            "status" => "OK",
            "message" => "Success"
        );

        print_r(json_encode($results));
    }
    
    public function check_payment(){
        $id = $this->input->post('id');

        $request = $this->paymentModel->getPayment($id);

        if ($request == null){
            print_r("null");
        }else{
            print_r(json_encode($request[0]));
        }
    }
    
    public function check_Mpesa_Payment(){
        $id = $this->input->post('id');

        $request = $this->paymentModel->getMpesa($id);

        if ($request == null){
            print_r("null");
        }else{
            print_r(json_encode($request[0]));
        }
    }
    
    public function update_payment_status(){
        $id = $this->input->post('id');
        $user = $this->input->post('user');
        
        $status_arr = null;
        
        if($user == "client"){
            $mode = $this->input->post('mode');
            $status_arr = array(
                'pay_mode' => $mode
            );
        }else if($user == "driver"){
            $status = $this->input->post('status');
            
            $status_arr = array(
                'pay_status' => $status
            );
        }
        
        $this->paymentModel->updatePaymentStatus($status_arr,$id);

        $results = array(
            "status" => "OK",
            "message" => "Success"
        );

        print_r(json_encode($results));
    }
    
    public function charge_card(){
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_k8Dji1AqNrtrneYtjwV84dMy");
        
        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $this->input->post('token');
        $amount = $this->input->post('amount');
        
        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'kes',
            'description' => 'Nabacab Taxi service',
            'source' => $token,
        ]);
    }

}
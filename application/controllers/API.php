<?php
/**
 * Created by PhpStorm.
 * User: dannexdaniels
 * Date: 28/12/18
 * Time: 01:10
 */

class API extends CI_Controller
{
    public function index()
    {

    }

    /**
     * methods used for authentication purposes
     */
    public function create_client(){
        $data = array(
            'client_name' => $this->input->post('name'),
            'client_phone' => $this->input->post('phone'),
            'client_email' => $this->input->post('email'),
        );

        $user = array(
            'user_phone' => $this->input->post('phone'),
            'user_category' => 'Client',
            'login_status' => 'out',
        );

        $this->authenticationModel->addUser($user);

        $this->authenticationModel->addClient($data);

        $results = array(
            "status" => "OK",
            "message" => "Success"
        );

        print_r(json_encode($results));
    }

    public function create_driver(){
        $data = array(
            "driver_fname" => $this->input->post('first_name'),
            'driver_lname' => $this->input->post('last_name'),
            'driver_id' => $this->input->post('id_no'),
            'driver_email' => $this->input->post('email'),
            'driver_license' => $this->input->post('license_no'),
            'driver_exp' => $this->input->post('license_exp'),
            'driver_dl_class' => $this->input->post('dl_class'),
            'vehicle_no' => $this->input->post('plate_no'),
            'logbook_no' => $this->input->post('logbook_no'),
            'vehicle_model' => $this->input->post('model'),
            'vehicle_capacity' => $this->input->post('capacity'),
            'insurance_no' => $this->input->post('ins_no'),
            'insurance_exp' => $this->input->post('ins_exp'),
            'owner' => $this->input->post('owner'),
            'owner_fname' => $this->input->post('owner_first_name'),
            'owner_lname' => $this->input->post('owner_last_name'),
            'owner_phone' => $this->input->post('owner_phone'),
            'owner_email' => $this->input->post('owner_email'),
            'owner_bank' => $this->input->post('owner_bank')
        );

        print_r($data);
    }

    public function signup_driver(){
        $this->load->view('signup_driver');
    }



    public function authenticate_user(){
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');
        $userLatt = $this->input->post('latt');
        $userLong = $this->input->post('long');

        $data = $this->authenticationModel->getUser($phone);

        if ($data == null){
            $results = array(
                "status" => "null",
                "message" => "User not found"
            );

            print_r(json_encode($results));
        }else {
            if ($data[0]['user_category'] == "Client"){
                $status = array(
                    'login_status' => 'available',
                    'user_latt' => $userLatt,
                    'user_long' => $userLong
                );
                $this->authenticationModel->updateLoginStatus($status,$phone);
                
                $client = $this->authenticationModel->getClient($phone);

                print_r(json_encode($client[0]));
            }else{
                $driver = $this->authenticationModel->getDriver($phone);
                if ($driver[0]['user_password'] == $password){
                    $status = array(
                        'login_status' => 'available',
                        'user_latt' => $userLatt,
                        'user_long' => $userLong
                    );
                    $this->authenticationModel->updateLoginStatus($status,$phone);
                    $driver = $this->authenticationModel->getDriver($phone);

                    print_r(json_encode($driver[0]));
                }else if($password == ""){
                    $results = array(
                        "status" => "pass_err1",
                        "message" => "Password not set"
                    );
    
                    print_r(json_encode($results));
                }else {
                    $results = array(
                        "status" => "pass_err2",
                        "message" => "Password do not match with this account"
                    );
    
                    print_r(json_encode($results));
                }
            }
        
            
                
                //print_r($data[0]['user_category']);
                
            
        }
    }
    
    public function update_location(){
        $phone = $this->input->post('phone');
        $latt = $this->input->post('latt');
        $long = $this->input->post('long');
        
        $location = array(
            'user_latt' => $latt,
            'user_long' => $long
        );
        $this->authenticationModel->updateLocation($location, $phone);
        
        $results = array(
            "status" => "OK",
            "message" => "Success"
        );

        print_r(json_encode($results));
    }
    
    public function get_location(){
        $phone = $this->input->post('phone');
        
        $client = $this->authenticationModel->getDriver($phone);

        print_r(json_encode($client[0]));
    }
    
    public function logoutUser(){
        $phone = $this->input->post('phone');

        $status = array(
            'login_status' => 'out'
        );
        $this->authenticationModel->updateLoginStatus($status,$phone);

        $results = array(
            "status" => "OK",
            "message" => "Success"
        );

        print_r(json_encode($results));
    }

    /**
     * methods used for requesting a ride
     */
    public function add_drive_request(){
        $data = array(
            'request_id' => "REQ".rand(),
            'request_status' => 'new',
            'request_client' => $this->input->post('client'),
            'request_driver' => $this->input->post('driver'),
            'request_destination' => $this->input->post('destination'),
            'request_origin_latt' => $this->input->post('origlatt'),
            'request_origin_long' => $this->input->post('origlong'),
            'request_destination_latt' => $this->input->post('destlatt'),
            'request_destination_long' => $this->input->post('destlong'),
            'charges' => $this->input->post('charges')
        );

        $this->requestRideModel->addRequest($data);

        $results = array(
            "status" => "OK",
            "message" => "Success"
        );

        print_r(json_encode($results));
    }

    public function check_drive_request(){
        $driver = $this->input->post('license');

        $request = $this->requestRideModel->checkRequest1($driver);

        if ($request == null){
            print_r("null");
        }else{
            print_r(json_encode($request[0]));
        }

    }
    
    public function get_request_id(){
        $client = $this->input->post('phone');
        
        $request = $this->requestRideModel->getRequestId($client);
       
       if ($request == null){
            print_r("null");
        }else{
            print_r($request[0]['id']);
        } 
    }
    
    public function check_client_request(){
        $requestId = $this->input->post('requestId');

        $request = $this->requestRideModel->checkRequest2($requestId);

        if ($request == null){
            print_r("null");
        }else{
            print_r(json_encode($request[0]));
        }
    }

    public function update_drive_request(){
        $req_id = $this->input->post('id');
        $phone = $this->input->post('phone');
        $status = $this->input->post('status');
        $driver_latt = $this->input->post('driver_latt');
        $driver_long = $this->input->post('driver_long');

        $status_arr = array(
            'request_status' => $status
        );

        $this->requestRideModel->updateRequest($status_arr,$req_id);

        if ($status == "accepted"){
            $status = array(
                'login_status' => 'occupied',
                'user_latt' => $driver_latt,
                'user_long' => $driver_long
            );
            $this->authenticationModel->updateLoginStatus($status,$phone);

        }

        $results = array(
            "status" => "OK",
            "message" => "Success"
        );

        print_r(json_encode($results));
    }
    
    public function update_journey_status(){
        $req_id = $this->input->post('id');
        $phone = $this->input->post('phone');
        $status = $this->input->post('status');
        $driver_latt = $this->input->post('driver_latt');
        $driver_long = $this->input->post('driver_long');

        
        $status_arr = array(
            'login_status' => 'occupied',
            'user_latt' => $driver_latt,
            'user_long' => $driver_long
        );
        
        $this->requestRideModel->updateJourney($status,$req_id);
        
        if ($status == "finished"){
            $status = array(
                'login_status' => 'available'
            );
            $this->authenticationModel->updateLoginStatus($status,$phone);
        }
        
        $results = array(
            "status" => "OK",
            "message" => "Success"
        );

        print_r(json_encode($results));
        
    }

    public function get_closest_driver(){

        $origin = $this->input->post('latlng');
        //print_r($orig);

        $drivers = $this->requestRideModel->getDrivers();

        $shortDistance = 1000000000.0;
        $shortTime = 'null';
        $driverPhone = 'null';
        $driverName = 'null';
        $driverGender = 'null';
        $licenseNo = 'null';
        $vehicleNo = 'null';
        $vehicleType = 'null';
        $vehicleCapacity = 'null';
        $vehicleCategory = 'null';
        foreach ($drivers as $driver){

            $destination = $driver['current_latt'].',%20'.$driver['current_long'];

            //getting distance data from the distance api
            $data = $this->get_distance_data("https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origin."&destinations=".$destination."&mode=driving&language=en&key=AIzaSyC5rzT4swvklbLSaGmPfFw-qVGl_efN1dQ");
            if ($data->rows[0]->elements[0]->status = 'OK'){
                $distance = $data->rows[0]->elements[0]->distance->text;
                $driveTime = $data->rows[0]->elements[0]->duration->text;

                $dist = (float) str_replace(' km','',$distance);
                if ($dist < $shortDistance) {
                    $shortDistance = $dist;
                    $shortTime = $driveTime;
                    $driverPhone = $driver['driver_phone'];
                    $driverName = $driver['driver_name'];
                    $driverGender = $driver['driver_gender'];
                    $licenseNo = $driver['license_no'];
                    $vehicleNo = $driver['vehicle_no'];
                    $vehicleType = $driver['vehicle_type'];
                    $vehicleCapacity = $driver['capacity'];
                    $vehicleCategory = $driver['category'];
                }
            }else{
                print_r($data->rows[0]->elements[0]->status);
            }
        }
        $driverData = array(
            'distance' => $shortDistance." km",
            'driveTime' => $shortTime,
            'driver' => $driverName,
            'phone' => $driverPhone,
            'license' => $licenseNo,
            'gender' => $driverGender,
            'vehicle' => $vehicleNo,
            'type' => $vehicleType,
            'capacity' => $vehicleCapacity,
            'category' => $vehicleCategory
        );
        print_r(json_encode($driverData));
    }

    //getting information from the api url and returning it inform of an array
    private function get_distance_data($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data);
    }
    
    
    
}
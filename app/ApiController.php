<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\Types\Self_;

class ApiController
{

    const client_id = 'YR1g9sYHb7ZKnfZwPankGdGDcs5xaxqE6znv3rMq';
    const client_secret = 'raxf9NGvBy2HgfqVhydTwAGQTuPY4DDyA85FSAEB';

    const scope= 'cmuitaccount.all.basicinfo cmuitaccount.all.employee.member mishr.all.basicinfo mishr.0000000021.education mishr.0000000021.executive mishr.0000000021.fame mishr.0000000021.leaveeducation mishr.0000000021.leavehistory mishr.0000000021.personalinfo mishr.0000000021.workhistory';
    const url_access_token = 'https://oauth.cmu.ac.th/v1/GetToken.aspx';

    const url = 'https://mis-api.cmu.ac.th/hr/';

    const version2 = 'v2/';
    const version_1 = 'v2.1/';
    const version_2 = 'v2.2/';

    const personalInfo = 'employees/self/personalinfo';
    const basicInfo = 'employees/self/basicinfo';
    const workStatus = 'employees/self/workcurrentinfo';
//    const workStatus = 'employees/self/personalkeyinfo';
    const addressInfo = 'employees/self/personalkeyinfo';

//    const addressInfo = 'organizations/{_orgID}/employees/{_itAccount}/leavequota';

    public function __constructor(){




    }

    public function getAccessToken($token)
    {
        $authorization = base64_encode(self::client_id.":".self::client_secret);

        //base64_encode(ClientKey:SecretKey)




        $json_string = self::scope;
//        $json_string = "grant_type=client_credentials&scope=research.public research.0000000021";



        $ch = curl_init( url_access_token );

        $options = array(

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_SSL_VERIFYPEER=>false,

            CURLOPT_HTTPHEADER => array(

                "content-type: application/x-www-form-urlencoded",

                "Authorization: Basic $authorization",

            ),

            CURLOPT_POSTFIELDS => $json_string

        );



        curl_setopt_array( $ch, $options );

        $result = curl_exec($ch); // Getting jSON result string


        $obj=json_decode($result,true);



        $token =  $obj['access_token'];



        return $token;

    }

    public function getPersonalInfo($token) {
        $curl = curl_init();

        $url = self::url.self::version_2.self::personalInfo;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "orgid: 0000000043",
                "personalid: 3215487512698",
                "Authorization: Bearer cdfe676c3f6930e109617a1d2af274d28a0405b0"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function getToken($scope) {

//        $authorization = base64_encode("YR1g9sYHb7ZKnfZwPankGdGDcs5xaxqE6znv3rMq:raxf9NGvBy2HgfqVhydTwAGQTuPY4DDyA85FSAEB");
//
//
//        $json_url = 'https://oauth.cmu.ac.th/v1/GetToken.aspx';
//
////old
////$json_string = "grant_type=client_credentials&scope=research.public research.0000000021";
//
////new
////$json_string = "grant_type=client_credentials&scope=cmuitaccount.all.basicinfo&mishr.0000000021.executive&cmuitaccount.all.employee.member&mishr.all.basicinfo&mishr.0000000021.education&mishr.0000000021.fame&mishr.0000000021.leaveeducation&mishr.0000000021.leavehistory&mishr.0000000021.personalinfo&mishr.0000000021.workhistory";
//
////        $scope = $request->get('scope');
//
//
//        $json_string = "grant_type=client_credentials&scope=".$scope;
//
//
//
//        $ch = curl_init( $json_url);
//
//        $options = array(
//
//            CURLOPT_RETURNTRANSFER => true,
//
//            CURLOPT_SSL_VERIFYPEER=>false,
//
//            CURLOPT_HTTPHEADER => array(
//
//                "content-type: application/x-www-form-urlencoded",
//
//                "Authorization: Basic $authorization",
//
//            ),
//
//            CURLOPT_POSTFIELDS => $json_string
//
//        );
//
//
//
//        curl_setopt_array( $ch, $options );
//
//        $result = curl_exec($ch); // Getting jSON result string
//
//
//
//        $obj=json_decode($result,true);
//
//        $token =  $obj['access_token'];
//        return $token;
        $curl = curl_init();

        $url = 'https://smartreport.camt.cmu.ac.th/public/api/get_token/?scope='.$scope;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
//            CURLOPT_HTTPHEADER => array(
//                "orgid: 0000000043",
//                "personalid: 3215487512698",
//                "Authorization: Bearer cdfe676c3f6930e109617a1d2af274d28a0405b0"
//            ),
        ));

        $token = curl_exec($curl);

        curl_close($curl);
        return $token;
    }

}

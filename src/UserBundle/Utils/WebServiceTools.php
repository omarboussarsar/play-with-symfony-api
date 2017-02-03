<?php

namespace UserBundle\Utils;

/**
 * Description of WebServiceTools
 *
 * @author omar
 * 
 * This class contains methods used to call the web service API REST
 */
class WebServiceTools {

    //get the data after calling a specific method of the API REST
    public function getData($method, $url, $parameters = array()) {
        $ch = curl_init();
        \curl_setopt($ch, CURLOPT_URL, $url);
        \curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // just for the example.
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($method == 'POST') {
            $query = json_encode($parameters);
            \curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        }
        \curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));

        $response = \curl_exec($ch);
        curl_close($ch);

        // If using JSON...
        $data = json_decode($response);

        return $data;
    }

}

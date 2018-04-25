<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class Psdkp{

    public function __construct()
    {
        $CI =& get_instance();
        $this->session = $CI->session;
    }

    public function getData($requestUri, $toArray = false)
    {
//        print_r($requestUri);
        $data = [];
        $session = $this->session->userdata();
        $client = new Client();
        if (isset($session['token'])) {
            $headers = array('Authorization'=>'bearer '.$session['token'],'Content-Type'=>'application/json');
            try {
                $response =  $client->get($requestUri, ['headers' => $headers, 'http_errors' => false, 'read_timeout' => 3, 'timeout' => 30]);
                $data = json_decode($response->getBody()->getContents(), $toArray);
            } catch (ConnectException $e) {
                $data = [];
            }
        } else {
            try {
                $response =  $client->get($requestUri, ['http_errors' => false, 'read_timeout' => 3, 'timeout' => 30]);
                $data = json_decode($response->getBody()->getContents(), $toArray);
            } catch (ConnectException $e) {
                $data = [];
                echo ("error disini".$e);
            }
        }
        return $data;
    }
    public function postData($requestUri, $body, $toArray = false)
    {
        $data = [];
        $session = $this->session->userdata();
        $client = new Client();

        if (isset($session['token'])) {
            $headers = array('Authorization'=>'bearer '.$session['token'],'Content-Type'=>'application/json');
            try {
                $response = $client->post($requestUri, ['json' => $body, 'http_errors' => false, 'headers' => $headers]);
                $data = json_decode($response->getBody()->getContents(), $toArray);
            } catch (ConnectException $e) {
                $data = [];
            }
        } else {
            try {
                $response = $client->post($requestUri, ['json' => $body, 'http_errors' => false]);
                $data = json_decode($response->getBody()->getContents(), $toArray);
            } catch (ConnectException $e) {
                $data = [];
            }
        }
        return $data;
    }
    public function putData($requestUri, $body, $toArray = false)
    {
        $data = [];
        $session = $this->session->userdata();
        $client = new Client();

        if (isset($session['token'])) {
            $headers = array('Authorization'=>'bearer '.$session['token'],'Content-Type'=>'application/json');
            try {
                $response = $client->put($requestUri, ['json' => $body, 'http_errors' => false, 'headers' => $headers]);
                $data = json_decode($response->getBody()->getContents(), $toArray);
            } catch (ConnectException $e) {
                $data = [];
            }
        } else {
            try {
                $response = $client->put($requestUri, ['json' => $body, 'http_errors' => false]);
                $data = json_decode($response->getBody()->getContents(), $toArray);
            } catch (ConnectException $e) {
                $data = [];
            }
        }
        return $data;
    }
    public function deleteData($requestUri, $body, $toArray = false)
    {
        $data = [];
        $session = $this->session->userdata();
        $client = new Client();

        if (isset($session['token'])) {
            $headers = array('Authorization'=>'bearer '.$session['token'],'Content-Type'=>'application/json');
            try {
                $response = $client->delete($requestUri, ['headers' => $headers, 'http_errors' => false, 'read_timeout' => 3, 'timeout' => 30]);
                $data = json_decode($response->getBody()->getContents(), $toArray);
            } catch (ConnectException $e) {
                $data = [];
            }
        } else {
            try {
                $response = $client->delete($requestUri, ['json' => $body, 'http_errors' => false, 'read_timeout' => 3, 'timeout' => 30]);
                $data = json_decode($response->getBody()->getContents(), $toArray);
            } catch (ConnectException $e) {
                $data = [];
            }
        }
        return $data;
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: matius
 * Date: 08/04/18
 * Time: 20.55
 */

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class UnitWorkingModel extends CI_Model {

    public function __construct()
    {

    }

    public function get()
    {
        $data = [];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_areas");
        $requestUri.= "/unitWorking";
        $data = $this->psdkp->getData($requestUri);
        return $data;
    }

    public function getById($id = "")
    {
        $data = [];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_areas");
        $requestUri.= "/unitWorking?id=".$id;
        $data = $this->psdkp->getData($requestUri);
        return $data;
    }

    public function getByTypeUnit($type = null)
    {
        $data = [];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_areas");
        $requestUri.= "/unitWorking?typeUnitId=".$type;
        $data = $this->psdkp->getData($requestUri);
        return $data;
    }

    public function post($payload)
    {
        $data = [];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_areas");
        $requestUri.= "/unitWorking";
        $data = $this->psdkp->postData($requestUri, json_decode($payload));
        return $data;
    }

    public function put($payload)
    {
        $data = [];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_areas");
        $requestUri.= "/unitWorking";
        $data = $this->psdkp->putData($requestUri, json_decode($payload));
        return $data;
    }

    public function delete($payload)
    {
        $data = [];
        $session_user = $this->session->userdata();
        $requestUri = $this->config->item("psdkp_areas");
        $requestUri.= "/unitWorking/del";
        $data = $this->psdkp->deleteData($requestUri, json_decode($payload));
        return $data;
    }
}

/* End of file UnitWorkingModel.php */

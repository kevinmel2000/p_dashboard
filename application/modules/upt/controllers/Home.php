<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller
{
    public function __construct()
    {
        $this->load->model('MappingModel','mapping');
        $this->load->model('UnitWorkingModel','unitWorking');
    }

    public function index(){
        $data['content']="upt/uptMapping";
        $data['title']="Data Unit Kerja";
        $data['upt'] = $this->unitWorking->getByTypeUnit(1);
        $this->load->view('layout/main', $data);
    }


}
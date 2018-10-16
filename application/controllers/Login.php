<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends User_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    // load data
    

    $data['content'] = $this->load->view('login', array(), TRUE);

    $this->load->view('template', $data);
  }

}

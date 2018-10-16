<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends User_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_users');
    
  }

  function index()
  {
    // load data
    

    $data['content'] = $this->load->view('register', array(), TRUE);

    $this->load->view('template', $data);
  }

  public function New()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST')
    {
      //form validation
	    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');

	    if(!$this->form_validation->run())
	    {
	      $this->session->set_flashdata('error', validation_errors());
				redirect('Register/New', 'refresh');
	    }
      else
      {
        
          $data['id'] = random_string('alnum', 6) . date('dm') . random_string('alnum', 5);
          $data['nama']    = $this->input->post('nama');
          $data['email']  = $this->input->post('email');
          $data['tgl_lahir']   = $this->input->post('tgl_lahir');
          $data['password']  = md5($this->input->post('password'));

          $this->Model_users->insert($data);

          $this->session->set_flashdata('message', 'Success ! User has been added');
          redirect('/', 'refresh');
       
      }
    }
  }

}

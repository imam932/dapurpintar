<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller{

  public function __construct(){
    parent::__construct();

    if(!$this->session->userdata('logged_in')['admin'])
    {
      redirect('admin/Dashboard', 'refresh');
    }

    $this->load->model('model_users');
  }

  function index()
  {
    // load data
    $data['user']          = $this->model_users->select_all();

    // error handling
		if(!empty($this->session->flashdata('message')))
		{
			$data['message'] = $this->session->flashdata('message');
    }
    
    // load content
    $data['content']       = $this->load->view('admin/users', $data, TRUE);
    // load template
    $data['title']         = "Users";
    $data['desc']		       = "Users";
    $data['breadcrumb']    = array('Dashboard', 'User');
    $this->load->view('admin/template', $data);
  }

  public function New()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST')
    {
      //form validation
	    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|alpha_numeric');
	    $this->form_validation->set_rules('password', 'Password', 'required');
	    $this->form_validation->set_rules('gender', 'Gender', 'required');
	    $this->form_validation->set_rules('birth', 'Birth', 'required');
      $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
      $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean|numeric');

	    if(!$this->form_validation->run())
	    {
	      $this->session->set_flashdata('error', validation_errors());
				redirect('admin/Users/New', 'refresh');
	    }
      else
      {
        $username_exist = $this->Model_auth->select_by_field('username', $this->input->post('username'));
        if($username_exist)
        {
          $this->session->set_flashdata('error', 'Username exist, use another');
          redirect('admin/Users/New', 'refresh');
        }
        else
        {
          $data['id_user'] = random_string('alnum', 6) . date('dm') . random_string('alnum', 5);
          $data['name']    = $this->input->post('name');
          $data['gender']  = $this->input->post('gender');
          $data['birth']   = $this->input->post('birth');
          $data['address'] = $this->input->post('address');
          $data['phone']   = $this->input->post('phone');
          $data['admin'] = $this->input->post('admin');

          $this->model_users->insert($data);

          $data1['id_auth']   = random_string('alnum', 6) . date('dm') . random_string('alnum', 5);
          $data1['username']  = $this->input->post('username');
          $data1['password']  = md5($this->input->post('password'));
          $data1['id_user']    = $data['id_user'];

          $this->Model_auth->insert($data1);

          $this->session->set_flashdata('message', 'Success ! User has been added');
          redirect('admin/Users', 'refresh');
        }
      }
    }
    //error handling
    $data = array();
    if(!empty($this->session->flashdata('error')))
    {
      $data['error'] = $this->session->flashdata('error');
    }
    // load content
    $data['content']        = $this->load->view('admin/admin_new', $data, TRUE);
    // load template
    $data['title']          = "Users";
    $data['desc']		        = "New User";
    $data['breadcrumb']     = array('Dashboard', 'User', 'New');
    $this->load->view('admin/template', $data);
  }

  public function editUsers($id)
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST')
    {
      //form validation
	    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');

	    if(!$this->form_validation->run())
	    {
	      $this->session->set_flashdata('error', validation_errors());
				redirect('admin/Users/editUsers/' . $id, 'refresh');
	    }
      else
      {
        $data['nama']    = $this->input->post('nama');
        $data['email']  = $this->input->post('email');
        $data['tgl_lahir']   = $this->input->post('tgl_lahir');

        $this->model_users->update($data, $id);
        $this->session->set_flashdata('message', 'Success ! User has been edited');
        redirect('admin/Users', 'refresh');
      }
    }
    //error handling
    $data = array();
    if(!empty($this->session->flashdata('error')))
    {
      $data['error'] = $this->session->flashdata('error');
    }
    // load data
    $data['user'] = $this->model_users->select_by_id($id);
    // load page
    $data['content']        = $this->load->view('admin/users_edit', $data, TRUE);

    // load template
    $data['title']          = "Users";
    $data['desc']		        = "Edir User";
    $data['breadcrumb']     = array('Dashboard', 'User', 'Edit');
    $this->load->view('admin/template', $data);
  }

  public function deleteUsers($id)
  {
    $this->model_users->delete($id);
    $this->session->set_flashdata('message', 'Success ! User has been deleted');
    redirect('admin/Users', 'refresh');
  }
}

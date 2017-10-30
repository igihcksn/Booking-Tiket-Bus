<?php 

class Auth extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('admin/m_auth');

		//load library
		$this->load->library('form_validation');

	}

	public function login()
	{
		$this->load->view('admin/auth/login');
	}

	public function login_process()
	{
		//aturan inputan
		$this->form_validation->set_rules('user_name', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		//jalankan validasi
		if ($this->form_validation->run() !== FALSE)
		{
			//cek username & password
			$where = array(

			'user_name' => $this->input->post('user_name'),
			'user_password' => sha1($this->input->post('password'))
			);

			//ambil data user berdasarkan $where
			$user = $this->m_auth->get_user($where);
			// jika tidak di temukan
			if (!empty($user))
			{
				//jika betul
				$this->session->set_userdata('auth_admin', $user);

				//arahkan ke dashboard
				redirect('admin/dashboard/dashboard');
			}

			//s
			$this->session->set_flashdata('login_error', 'Username or password incorrect');
			redirect('admin/auth/login');

			//tampilkan lagi form validasi
			$this->load->view('admin/auth/login');
		}

	}

	public function logout()
	{
		//hapus session auth_admin
		$this->session->unset_userdata('auth_admin');
		//redirect ke form login
		redirect('admin/auth/login');
	}
}
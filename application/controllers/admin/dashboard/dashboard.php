<?php 
	class Dashboard extends CI_Controller
	{
		
		public function index ()
		{
			//ketika menggunakan base_url harus menggunakan helper
			// $this->load->helper('url'); //untuk banyaknya function maka helper di taruh di autoload

			$this->load->view('admin/dashboard/dashboard/index');
		}
	}
 ?>
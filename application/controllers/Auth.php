<?php
class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model');
		$this->load->library('Form_validation', 'session');
		$this->load->helper(array('Form', 'Cookie', 'String'));
	}

	function index()
	{
		$cookie = get_cookie('maps');
		if ($this->session->userdata('logged')) {
			redirect('welcome');
		} else if ($cookie <> '') {
			// cek cookie
			$row = $this->Auth_model->get_by_cookie($cookie)->row();
			if ($row) {
				$this->_daftarkan_session($row);
			} else {
				$data = array(
					'email' => set_value('email'),
					'password' => set_value('password'),
					'remember' => set_value('remember'),
					'message' => $this->session->flashdata('message'),
				);
				$this->load->view('auth/login', $data);
			}
		} else {
			$data = array(
				'email' => set_value('email'),
				'password' => set_value('password'),
				'remember' => set_value('remember'),
				'message' => $this->session->flashdata('message'),
			);
			$this->load->view('auth/login', $data);
		}
		// $this->load->view('auth/login');
	}

	public function cheklogin()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password', TRUE);
		$remember = $this->input->post('remember');
		$row = $this->Auth_model->login($email, $password)->row();
		if ($row) {
			// login berhasil
			// 1. Buat Cookies jika remember di check
			if ($remember) {
				$key = random_string('alnum', 64);
				set_cookie('maps', $key, 3600 * 24 * 360); // set expired 1 tahun
				// simpan key di database
				$update_key = array(
					'cookie' => $key
				);
				$this->Auth_model->update($update_key, $row->id_users);
			}
			$this->_daftarkan_session($row);
		} else {
			// login gagal
			$this->session->set_flashdata('status_login', 'email atau password salah');
			$this->index();
		}
	}

	public function _daftarkan_session($row)
	{
		// 1. Daftarkan Session
		$sess = array(
			'logged' => TRUE,
			'id_users' => $row->id_users,
			'full_name' => $row->full_name,
			'email' => $row->email,
			'images' => $row->images,
			'id_user_level' => $row->id_user_level,
			'kode_departemen' => $row->kode_departemen,
			'is_aktif' => $row->is_aktif,
			'cookie' => $row->cookie,
			'kode_distributor' => $row->kode_distributor,
			'store_code' => $row->store_code,
			'category_id' => $row->category_id,
			'region_code' => $row->region_code,
			'brand_code' => $row->brand_code,
			'id_form' => $row->id_form,
		);
		$this->session->set_userdata($sess);
		// 2. Redirect ke home
		redirect('welcome');
	}

	public function logout()
	{
		// delete cookie dan session
		delete_cookie('maps');
		$this->session->sess_destroy();
		redirect('auth');
	}

	// function chekloginOff()
	// {
	// 	$email = $this->input->post('email');
	// 	$password = $this->input->post('password', TRUE);
	// 	$hashPass = password_hash($password, PASSWORD_DEFAULT);
	// 	$test = password_verify($password, $hashPass);
	// 	// query chek users
	// 	$this->db->where('email', $email);
	// 	$users = $this->db->get('tbl_user');
	// 	if ($users->num_rows() > 0) {
	// 		$user = $users->row_array();
	// 		if (password_verify($password, $user['password'])) {
	// 			// retrive user data to session
	// 			$this->session->set_userdata($user);
	// 			redirect('welcome');
	// 		} else {
	// 			redirect('auth');
	// 		}
	// 	} else {
	// 		$this->session->set_flashdata('status_login', 'email atau password yang anda input salah');
	// 		redirect('auth');
	// 	}
	// }

	// function logout()
	// {
	// 	$this->session->sess_destroy();
	// 	$this->session->set_flashdata('status_login', 'Anda sudah berhasil keluar dari aplikasi');
	// 	redirect('auth');
	// }
}

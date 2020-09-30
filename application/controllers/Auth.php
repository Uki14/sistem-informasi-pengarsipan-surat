<?php
class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->has_userdata('level')) {
			return redirect('dashboard');
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'Username tidak boleh kosong!']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password tidak boleh kosong!']);

		if ($this->form_validation->run() == false) {
			$data['main_title'] = 'Arsip Surat Master';
			$data['title'] = 'Login';
			$this->load->view('index', $data);
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = htmlspecialchars($this->input->post('username'));
		$password = $this->input->post('password');

		$cek = $this->db->get_where('user', ['username' => $username])->row_array();

		if ($cek) {
			if (password_verify($password, $cek['password'])) {
				$this->session->set_flashdata('success', "Login sukses");
				$this->session->set_userdata($cek);
				return redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password salah!');
				return redirect('auth');
			}
		} else {
			$this->session->set_flashdata('error', 'User tidak terdaftar!');
			return redirect('auth');
		}
	}

	public function logout()
	{
		session_destroy();
		$this->session->set_flashdata('success', 'Logout sukses!');
		return redirect('auth');
	}
}

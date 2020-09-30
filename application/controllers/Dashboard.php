<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata('level')) {
            return redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        if ($this->session->userdata('level') == 1) {
            $data['user'] = 'superadmin';
        } elseif ($this->session->userdata('level') == 2) {
            $data['user'] = 'admin';
        }
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}

<?php
class About extends CI_Controller
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
        $data['title'] = 'About';
        if ($this->session->userdata('level') == 1) {
            $data['user'] = 'superadmin';
        } elseif ($this->session->userdata('level') == 2) {
            $data['user'] = 'admin';
        }
        $this->load->view('templates/header', $data);
        $this->load->view('about', $data);
        $this->load->view('templates/footer');
    }
}

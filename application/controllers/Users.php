<?php
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata('level')) {
            return redirect('auth');
        }
        $this->load->model('modelusers');
    }

    private function _superadmin_only()
    {
        if ($this->session->userdata('level') != 1) {
            $this->session->set_flashdata('error', 'Hanya SuperAdmin yang mempunyai hak ini!');
            return redirect('dashboard');
        }
    }

    public function index()
    {
        $this->_superadmin_only();

        $data['title'] = 'Users';
        $data['user'] = 'superadmin';
        $data['users'] = $this->modelusers->get('user')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->_superadmin_only();

        $nama_lengkap = htmlspecialchars($this->input->post('nama_lengkap'));
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));
        $password_conf = htmlspecialchars($this->input->post('password2'));

        $level = htmlspecialchars($this->input->post('level'));

        $cek_username = $this->db->get_where('user', ['username' => $username])->row_array();
        if ($cek_username) {
            $this->session->set_flashdata('error', 'Username sudah ada!');
            return redirect('users');
        }

        if ($password != $password_conf) {
            $this->session->set_flashdata('error', 'Password dan konfirmasi harus sama!');
            return redirect('users');
        }

        $password2 = password_hash($password, PASSWORD_BCRYPT);
        $array = [
            'id_user' => null,
            'username' => $username,
            'password' => $password2,
            'nama_lengkap' => $nama_lengkap,
            'level' => $level
        ];
        $this->modelusers->insert($array);
        $this->session->set_flashdata('success', 'User ditambahkan!');
        return redirect('users');
    }

    public function delete($id)
    {
        $this->_superadmin_only();

        $users = $this->db->get_where('user', ['id_user' => $id]);

        if ($id === null || count($users->result_array()) <= 0) {
            return redirect('users');
        }

        $this->db->where('id_user', $id);
        if ($this->db->delete('user')) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
            return redirect('users');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus!');
            return redirect('users');
        }
    }

    public function profile()
    {
        $data['title'] = 'Profil Saya';

        if ($this->session->userdata('level') == 1) {
            $data['user'] = 'superadmin';
        } elseif ($this->session->userdata('level') == 2) {
            $data['user'] = 'admin';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('users/profile', $data);
        $this->load->view('templates/footer');
    }

    public function edit_profile()
    {
        $data['title'] = 'Ubah Profil Saya';

        if ($this->session->userdata('level') == 1) {
            $data['user'] = 'superadmin';
        } elseif ($this->session->userdata('level') == 2) {
            $data['user'] = 'admin';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('users/edit_profile', $data);
        $this->load->view('templates/footer');
    }

    public function update_profile()
    {
        $nama_lengkap = $this->input->post('nama_lengkap');
        $username = $this->input->post('username');
        $bio = $this->input->post('bio');
        $gambar = $_FILES['gambar']['name'];
        $explode = explode('.', $gambar);
        $image = uniqid('profile_', false) . '.' . end($explode);
        $email = $this->input->post('email');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error',  validation_errors());
            return redirect('users/profile');
        } else {

            $user = $this->modelusers->get_by_id($this->session->id_user)->row();

            $array = [
                'username' => $username,
                'nama_lengkap' => $nama_lengkap,
                'image' => empty($gambar) ? $user->image : $image,
                'bio' => $bio,
                'email' => $email,
                'level' => $user->level
            ];

            if (!empty($gambar)) {
                $path = 'assets/files/profile/' . $user->image;
                unlink($path);

                $config['upload_path'] = 'assets/files/profile/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['file_name'] = $image;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    return redirect('users/profile');
                } else {
                    $this->upload->do_upload();
                    $this->db->update('user', $array, ['id_user' => $this->session->id_user]);
                    session_destroy();
                    $this->session->set_flashdata('success', 'Profil diperbarui, harap login kembali untuk melihat perubahan');
                    return redirect('/');
                }
            } else {
                $this->db->update('user', $array, ['id_user' => $this->session->id_user]);
                session_destroy();
                $this->session->set_flashdata('success', 'Profil diperbarui, harap login kembali untuk melihat perubahan');
                return redirect('/');
            }
        }
    }

    public function edit_password()
    {
        $data['title'] = 'Ubah Password Saya';

        if ($this->session->userdata('level') == 1) {
            $data['user'] = 'superadmin';
        } elseif ($this->session->userdata('level') == 2) {
            $data['user'] = 'admin';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('users/edit_password', $data);
        $this->load->view('templates/footer');
    }

    public function update_password()
    {
        $password = $this->input->post('password');
        $newpassword = $this->input->post('newpassword');
        $newpasswordconf = $this->input->post('newpasswordconf');

        if (!password_verify($password, $this->session->password)) {
            $this->session->set_flashdata('error', 'Password salah');
            return redirect('users/edit_password');
        }

        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('newpassword', 'Password', 'trim|required');
        $this->form_validation->set_rules('newpasswordconf', 'Password', 'trim|required|matches[newpassword]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error',  validation_errors());
            return redirect('users/edit_password');
        } else {
            $this->modelusers->update(['password' => password_hash($newpassword, PASSWORD_BCRYPT)], $this->session->id_user);
            session_destroy();
            $this->session->set_flashdata('success', 'Password diperbarui, harap login kembali!.');
            return redirect('/');
        }
    }

    public function change_level($id)
    {
        $this->_superadmin_only();

        $user = $this->db->get_where('user', ['id_user' => $id])->row();

        if ($user->level == 2) {
            $this->db->update('user', ['level' => 1], ['id_user' => $id]);
            return redirect('users');
        } else {
            $this->db->update('user', ['level' => 2], ['id_user' => $id]);
            return redirect('users');
        }
    }
}

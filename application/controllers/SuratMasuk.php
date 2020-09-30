<?php
class SuratMasuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata('level')) {
            return redirect('auth');
        }

        $this->load->model('modelsuratmasuk');
        $this->load->library('form_validation');
    }

    private function _superadmin_only()
    {
        if ($this->session->userdata('level') != 1) {
            $this->session->set_flashdata('error', 'Hanya SuperAdmin yang mempunyai hak ini!');
            return redirect('suratmasuk');
        }
    }

    public function index()
    {
        $data['title'] = 'Surat Masuk';
        if ($this->session->userdata('level') == 1) {
            $data['user'] = 'superadmin';
        } elseif ($this->session->userdata('level') == 2) {
            $data['user'] = 'admin';
        }

        $data['suratmasuk'] = $this->modelsuratmasuk->get()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('suratmasuk/index', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->_superadmin_only();

        $this->form_validation->set_rules('no_suratmasuk', 'Nomor Surat Masuk', 'required', ['required' => 'Nomor Surat tidak boleh kosong!']);
        $this->form_validation->set_rules('judul_suratmasuk', 'Judul Surat', 'required', ['required' => 'Judul Surat tidak boleh kosong!']);
        $this->form_validation->set_rules('asal_surat', 'Asal Surat', 'required', ['required' => 'Asal Surat tidak boleh kosong!']);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error',  validation_errors());
            return redirect('suratmasuk');
        }

        $cek_no = $this->db->get_where('suratmasuk', ['no_suratmasuk' =>  $this->input->post('no_suratmasuk')])->row_array();
        if ($cek_no) {
            $this->session->set_flashdata('error', 'Nomor surat sudah ada!');
            return redirect('suratmasuk');
        }

        $namaberkas_suratmasuk = $_FILES['berkas_suratmasuk']['name'];
        $exp = explode('.', $namaberkas_suratmasuk);
        $typenamaberkas_suratmasuk = end($exp);
        $berkas_suratmasuk = uniqid('suratmasuk_', false) . '.' . $typenamaberkas_suratmasuk;
        $array = [
            'id_suratmasuk' => null,
            'no_suratmasuk' => $this->input->post('no_suratmasuk'),
            'judul_suratmasuk' => $this->input->post('judul_suratmasuk'),
            'asal_surat' => $this->input->post('asal_surat'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal_diterima' => $this->input->post('tanggal_diterima'),
            'id_indeks' => $this->input->post('id_indeks'),
            'keterangan' => $this->input->post('keterangan'),
            'berkas_suratmasuk' => !empty($namaberkas_suratmasuk) ? $berkas_suratmasuk : ''
        ];

        if (!empty($namaberkas_suratmasuk)) {
            $config['upload_path'] = 'assets/files/suratmasuk/';
            $config['allowed_types'] = 'jpeg|jpg|png|doc|docx|pdf';
            $config['file_name'] = $berkas_suratmasuk;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('berkas_suratmasuk')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                return redirect('suratmasuk');
            } else {
                $this->upload->do_upload();
                $this->modelsuratmasuk->insert($array);
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
                return redirect('suratmasuk');
            }
        } else {
            $this->modelsuratmasuk->insert($array);
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
            return redirect('suratmasuk');
        }
    }

    public function edit($id = null)
    {
        $this->_superadmin_only();

        $suratmasuk = $this->db->get_where('suratmasuk', ['id_suratmasuk' => $id]);

        if ($id === null || count($suratmasuk->result_array()) <= 0) {
            return redirect('suratmasuk');
        }

        $data['title'] = 'Surat Masuk';
        $data['user'] = 'guest';
        $data['suratmasuk'] = $suratmasuk->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('suratmasuk/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $this->_superadmin_only();

        $id = $this->input->post('id');
        $no_suratmasuk = $this->input->post('no_suratmasuk');
        $cek_no = $this->db->query("select * from suratmasuk where no_suratmasuk = '$no_suratmasuk'  AND id_suratmasuk != $id")->row_array();
        $namaberkas_suratmasuk = $_FILES['berkas_suratmasuk']['name'];
        $exp = explode('.', $namaberkas_suratmasuk);
        $typeberkas_suratmasuk = end($exp);
        $berkas_suratmasuk = uniqid('suratmasuk_', false) . '.' . $typeberkas_suratmasuk;
        if ($cek_no) {
            $this->session->set_flashdata('error', 'Nomor surat sudah ada!');
            return redirect('suratmasuk');
        }
        $old = $this->db->get_where('suratmasuk', ['id_suratmasuk' => $id])->row_array();
        $array = [
            'no_suratmasuk' => htmlspecialchars($this->input->post('no_suratmasuk')),
            'judul_suratmasuk' => $this->input->post('judul_suratmasuk'),
            'asal_surat' => $this->input->post('asal_surat'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal_diterima' => $this->input->post('tanggal_diterima'),
            'id_indeks' => $this->input->post('id_indeks'),
            'keterangan' => $this->input->post('keterangan'),
            'berkas_suratmasuk' => !empty($namaberkas_suratmasuk) ? $berkas_suratmasuk : $old['berkas_suratmasuk']
        ];
        if (!empty($namaberkas_suratmasuk)) {
            $config['upload_path']          = 'assets/files/suratmasuk/';
            $config['allowed_types']        = 'gif|jpg|png|pdf|doc|docx';
            $config['file_name'] = $berkas_suratmasuk;
            $this->load->library('upload', $config);

            if ($old['berkas_suratmasuk']) {
                $path = 'assets/files/suratmasuk/' . $old['berkas_suratmasuk'];
                unlink($path);
            }

            if (!$this->upload->do_upload('berkas_suratmasuk')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            } else {
                $this->upload->do_upload();
                $this->modelsuratmasuk->update($array, $id);
                $this->session->set_flashdata('success', 'Data diubah!');
            }
        } else {
            $this->modelsuratmasuk->update($array, $id);
            $this->session->set_flashdata('success', 'Data diubah!');
        }
        return redirect('suratmasuk');
    }

    public function download($id_suratmasuk)
    {
        $this->load->helper('download');
        $data = $this->db->get_where('suratmasuk', ['id_suratmasuk' => $id_suratmasuk])->row();
        $filename = $data->berkas_suratmasuk;
        force_download('assets/files/suratmasuk/' . $filename, NULL);
    }

    public function delete($id)
    {
        $this->_superadmin_only();

        $suratmasuk = $this->db->get_where('suratmasuk', ['id_suratmasuk' => $id]);

        if ($id === null || count($suratmasuk->result_array()) <= 0) {
            return redirect('suratmasuk');
        }

        $data = $suratmasuk->row_array();
        if ($data['berkas_suratmasuk'] != '' || $data['berkas_suratmasuk'] != null) {
            $path = 'assets/files/suratmasuk/' . $data['berkas_suratmasuk'];
            unlink($path);
        }

        $this->db->where('id_suratmasuk', $id);
        if ($this->db->delete('suratmasuk')) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
            return redirect('suratmasuk');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus!');
            return redirect('suratmasuk');
        }
    }

    public function disposisi($id = null)
    {
        $this->_superadmin_only();

        $suratmasuk = $this->db->get_where('suratmasuk', ['id_suratmasuk' => $id]);

        if ($id === null || count($suratmasuk->result_array()) <= 0) {
            return redirect('suratmasuk');
        }


        $data['title'] = 'Surat Masuk';
        $data['user'] = 'guest';
        $data['suratmasuk'] = $suratmasuk->row_array();
        $data['disposisi'] = $this->db->get_where('disposisi', ['id_suratmasuk' => $id])->result();
        $this->load->view('templates/header', $data);
        $this->load->view('suratmasuk/disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function store_disposisi($id_suratmasuk)
    {
        $this->_superadmin_only();

        $instruksi = htmlspecialchars($this->input->post('instruksi'));
        $pengisi = htmlspecialchars($this->input->post('pengisi'));
        $tujuan = htmlspecialchars($this->input->post('tujuan'));
        $catatan = htmlspecialchars($this->input->post('catatan'));

        $store = $this->db->insert('disposisi', [
            'id_disposisi' => null,
            'pengisi' => $pengisi,
            'tujuan' => $tujuan,
            'instruksi' => $instruksi,
            'catatan' => $catatan,
            'id_suratmasuk' => $id_suratmasuk
        ]);

        if ($store) {
            $this->session->set_flashdata('success', ' Disposisi dibuat!');
            return redirect('suratmasuk/disposisi/' . $id_suratmasuk);
        } else {
            $this->session->set_flashdata('error', ' Disposisi gagal dibuat!');
            return redirect('suratmasuk/disposisi/' . $id_suratmasuk);
        }
    }

    public function print_disposisi($id = null)
    {
        $this->_superadmin_only();

        $disposisi = $this->db->get_where('disposisi', ['id_disposisi' => $id]);
        if ($id == null || count($disposisi->result()) < 1) {
            return redirect('suratmasuk');
        }


        $d = $disposisi->row_array();
        $data['title'] = 'Cetak Disposisi #' . $d['id_disposisi'];
        $data['user'] = 'guest';
        $data['disposisi'] = $disposisi->row_array();
        $data['suratmasuk'] = $this->db->query('select * from disposisi inner join suratmasuk on disposisi.id_suratmasuk = suratmasuk.id_suratmasuk where suratmasuk.id_suratmasuk = ' . $d['id_suratmasuk'])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('suratmasuk/print_disposisi.php', $data);
    }

    public function delete_disposisi($id = null)
    {
        $this->_superadmin_only();

        $disposisi = $this->db->get_where('disposisi', ['id_disposisi' => $id]);
        if ($id == null || count($disposisi->result()) < 1) {
            return redirect('suratmasuk');
        }

        $delete = $this->db->delete('disposisi', ['id_disposisi' => $id]);

        if ($delete) {
            $this->session->set_flashdata('success', 'Disposisi berhasil dihapus!');
            return redirect('suratmasuk/disposisi/' . $this->input->get('id_suratmasuk'));
        } else {
            $this->session->set_flashdata('error', 'Disposisi gagal dihapus!');
            return redirect('suratmasuk/disposisi/' . $this->input->get('id_suratmasuk'));
        }
    }

    public function report()
    {
        $data['title'] = 'Laporan Surat Masuk';
        if ($this->session->userdata('level') == 1) {
            $data['user'] = 'superadmin';
        } elseif ($this->session->userdata('level') == 2) {
            $data['user'] = 'admin';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('suratmasuk/report', $data);
        $this->load->view('templates/footer');
    }

    public function print_report()
    {
        $filter = $this->input->get('filter');
        $data['title'] = 'Cetak Laporan Surat Masuk';

        if ($filter == 'indeks') {
            $data['suratmasuk'] = $this->db->get_where('suratmasuk', ['id_indeks' => $this->input->post('id_indeks')])->result();
            $this->load->view('suratmasuk/print_report', $data);
        } elseif ($filter == 'date_in') {
            $first = $this->input->post('first');
            $second = $this->input->post('second');

            $this->db->where('tanggal_masuk >=', $first);
            $this->db->where('tanggal_masuk <=', $second);

            $data['suratmasuk'] = $this->db->get('suratmasuk')->result();
            $this->load->view('suratmasuk/print_report', $data);
        } else {
            return redirect("suratmasuk/report");
        }
    }
}

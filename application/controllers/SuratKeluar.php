<?php
class SuratKeluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata('level')) {
            return redirect('auth');
        }
        $this->load->model('modelsuratkeluar');
    }

    private function _superadmin_only()
    {
        if ($this->session->userdata('level') != 1) {
            $this->session->set_flashdata('error', 'Hanya SuperAdmin yang mempunyai hak ini!');
            return redirect('suratkeluar');
        }
    }

    public function index()
    {
        $data['title'] = 'Surat Keluar';
        if ($this->session->userdata('level') == 1) {
            $data['user'] = 'superadmin';
        } elseif ($this->session->userdata('level') == 2) {
            $data['user'] = 'admin';
        };

        $data['suratkeluar'] = $this->modelsuratkeluar->get()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('suratkeluar/index', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->_superadmin_only();

        $no_suratkeluar = htmlspecialchars($this->input->post('no_suratkeluar'));
        $judul_suratkeluar = htmlspecialchars($this->input->post('judul_suratkeluar'));
        $id_indeks = htmlspecialchars($this->input->post('id_indeks'));
        $tujuan = htmlspecialchars($this->input->post('tujuan'));
        $tanggal_keluar = htmlspecialchars($this->input->post('tanggal_keluar'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $namaberkas_suratkeluar = $_FILES['berkas_suratkeluar']['name'];
        $exp = explode('.', $namaberkas_suratkeluar);
        $typeberkas_suratkeluar = end($exp);
        $berkas_suratkeluar = uniqid('suratkeluar_', false) . '.' . $typeberkas_suratkeluar;

        $cek_no = $this->db->get_where('suratkeluar', ['no_suratkeluar' => $no_suratkeluar])->row_array();
        if ($cek_no) {
            $this->session->set_flashdata('error', 'Nomor surat sudah ada!');
            return redirect('suratkeluar');
        }

        $array = [
            'id_suratkeluar' => null,
            'no_suratkeluar' => $no_suratkeluar,
            'judul_suratkeluar' => $judul_suratkeluar,
            'id_indeks' => $id_indeks,
            'tujuan' => $tujuan,
            'tanggal_keluar' => $tanggal_keluar,
            'keterangan' => $keterangan,
            'berkas_suratkeluar' => !empty($namaberkas_suratkeluar)  ? $berkas_suratkeluar : ''
        ];

        if (!empty($namaberkas_suratkeluar)) {
            $config['upload_path'] = 'assets/files/suratkeluar/';
            $config['allowed_types'] = 'jpeg|jpg|png|doc|docx|pdf';
            $config['file_name'] = $berkas_suratkeluar;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('berkas_suratkeluar')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            } else {
                $this->upload->do_upload();
                $this->modelsuratkeluar->insert($array);
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan!');
            }
        } else {
            $this->modelsuratkeluar->insert($array);
            $this->session->set_flashdata('success', 'Data ditambahkan!');
        }

        return redirect('suratkeluar');
    }

    public function edit($id)
    {
        $this->_superadmin_only();

        $suratkeluar = $this->db->get_where('suratkeluar', ['id_suratkeluar' => $id]);

        if ($id === null || count($suratkeluar->result_array()) <= 0) {
            return redirect('suratkeluar');
        }

        $data['title'] = 'Surat Keluar';
        $data['user'] = 'guest';
        $data['suratkeluar'] = $suratkeluar->row();
        $this->load->view('templates/header', $data);
        $this->load->view('suratkeluar/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $this->_superadmin_only();

        $id = $this->input->post('id');

        $no_suratkeluar = $this->input->post('no_suratkeluar');
        $cek_no = $this->db->query("select * from suratkeluar where no_suratkeluar = '$no_suratkeluar'  AND id_suratkeluar != $id")->row_array();

        $namaberkas_suratkeluar = $_FILES['berkas_suratkeluar']['name'];
        $exp = explode('.', $namaberkas_suratkeluar);
        $typeberkas_suratkeluar = end($exp);
        $berkas_suratkeluar = uniqid('suratkeluar_', false) . '.' . $typeberkas_suratkeluar;

        if ($cek_no) {
            $this->session->set_flashdata('error', 'Nomor surat sudah ada!');
            return redirect('suratkeluar');
        }

        $old = $this->db->get_where('suratkeluar', ['id_suratkeluar' => $id])->row_array();
        $array = [
            'id_suratkeluar' => null,
            'no_suratkeluar' => $this->input->post('no_suratkeluar'),
            'judul_suratkeluar' => $this->input->post('judul_suratkeluar'),
            'id_indeks' => $this->input->post('id_indeks'),
            'tujuan' => $this->input->post('tujuan'),
            'tanggal_keluar' => $this->input->post('tanggal_keluar'),
            'keterangan' => $this->input->post('keterangan'),
            'berkas_suratkeluar' => !empty($namaberkas_suratkeluar) ? $berkas_suratkeluar : $old['berkas_suratkeluar']
        ];

        if (!empty($namaberkas_suratkeluar)) {
            $config['upload_path']          = 'assets/files/suratkeluar/';
            $config['allowed_types']        = 'gif|jpg|png|pdf|doc|docx';
            $config['file_name'] = $berkas_suratkeluar;
            $this->load->library('upload', $config);

            if ($old['berkas_suratkeluar'] != '') {
                $path = 'assets/files/suratkeluar/' . $old['berkas_suratkeluar'];
                unlink($path);
            }

            if (!$this->upload->do_upload('berkas_suratkeluar')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            } else {
                $this->upload->do_upload();
                $this->modelsuratkeluar->update($array, $id);
                $this->session->set_flashdata('success', 'Data diubah!');
            }
            return redirect('suratkeluar');
        } else {
            $this->modelsuratkeluar->update($array, $id);
            $this->session->set_flashdata('success', 'Data diubah!');
        }
        return redirect('suratkeluar');
    }

    public function download($id = null)
    {
        $suratkeluar = $this->modelsuratkeluar->get_by_id($id);
        if ($id == null || count($suratkeluar->result()) < 1) {
            return redirect('suratkeluar');
        }

        $data = $suratkeluar->row();
        $filename = $data->berkas_suratkeluar;
        return force_download('assets/files/suratkeluar/' . $filename, NULL);
    }

    public function delete($id)
    {
        $this->_superadmin_only();

        $suratkeluar = $this->db->get_where('suratkeluar', ['id_suratkeluar' => $id]);

        if ($id === null || count($suratkeluar->result_array()) <= 0) {
            return redirect('suratkeluar');
        }

        $this->db->where('id_suratkeluar', $id);
        if ($this->db->delete('suratkeluar')) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
            return redirect('suratkeluar');
        } else {
            $this->session->set_flashdata('error', 'Data gagal dihapus!');
            return redirect('suratkeluar');
        }
    }

    public function report()
    {
        $data['title'] = 'Laporan Surat Keluar';
        if ($this->session->userdata('level') == 1) {
            $data['user'] = 'superadmin';
        } elseif ($this->session->userdata('level') == 2) {
            $data['user'] = 'admin';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('suratkeluar/report', $data);
        $this->load->view('templates/footer');
    }

    public function print_report()
    {
        $filter = $this->input->get('filter');
        $data['title'] = 'Cetak Laporan Surat Keluar';

        if ($filter == 'indeks') {
            $data['suratkeluar'] = $this->db->get_where('suratkeluar', ['id_indeks' => $this->input->post('id_indeks')])->result();
            $this->load->view('suratkeluar/print_report', $data);
        } elseif ($filter == 'date_out') {
            $first = $this->input->post('first');
            $second = $this->input->post('second');

            $this->db->where('tanggal_keluar >=', $first);
            $this->db->where('tanggal_keluar <=', $second);

            $data['suratkeluar'] = $this->db->get('suratkeluar')->result();
            $this->load->view('suratkeluar/print_report', $data);
        } else {
            return redirect("suratkeluar/report");
        }
    }
}

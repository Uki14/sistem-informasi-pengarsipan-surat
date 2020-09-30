<?php
class IndexSurat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->has_userdata('level')) {
            return redirect('auth');
        }
        $this->_superadmin_only();
        $this->load->library('form_validation');
    }

    private function _superadmin_only()
    {
        if ($this->session->userdata('level') != 1) {
            $this->session->set_flashdata('error', 'Hanya SuperAdmin yang mempunyai hak ini!');
            return redirect('/');
        }
    }

    public function index()
    {
        $data['title'] = 'Index Surat';

        $data['user'] = 'superadmin';
        $data['index_surat'] = $this->db->get('indeks')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('index_surat/index', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $kode_index = $this->input->post('kode_index');
        $judul_index = $this->input->post('judul_index');
        $detail = $this->input->post('detail');

        $cek = $this->db->get_where('indeks', ['kode_indeks' => $kode_index])->row();

        if ($cek != null) {
            $this->session->set_flashdata('error', 'Kode indeks ' . $kode_index . ' sudah digunakan!');
            return redirect('indexsurat');
        }

        $insert = $this->db->insert('indeks', [
            'id_indeks' => null,
            'kode_indeks' => $kode_index,
            'judul_indeks' => $judul_index,
            'detail' => $detail,
        ]);

        if ($insert) {
            $this->session->set_flashdata('success', 'Indeks baru berhasil ditambahkan!');
            return redirect('indexsurat');
        }
    }

    public function edit($id = null)
    {
        $indeks = $this->db->get_where('indeks', ['id_indeks' => $id]);

        if ($id === null || count($indeks->result_array()) <= 0) {
            return redirect('indexsurat');
        }

        $data['title'] = 'Edit  Index Surat';
        $data['user'] = 'superadmin';
        $data['indeks'] = $indeks->row();
        $this->load->view('templates/header', $data);
        $this->load->view('index_surat/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $kode_indeks = $this->input->post('kode_indeks');
        $judul_indeks = $this->input->post('judul_indeks');
        $detail = $this->input->post('detail');
        $indeks = $this->db->get_where('indeks', ['id_indeks' => $id]);

        if ($id === null || count($indeks->result_array()) <= 0) {
            return redirect('indexsurat');
        }

        $cek = $this->db->get_where('indeks', ['kode_indeks' => $kode_indeks, 'id_indeks' != $id])->row_array();
        if ($cek) {
            $this->session->set_flashdata('error', 'Kode indeks sudah dipakai!');
            return redirect('indexsurat');
        } else {
            $this->db->update('indeks', [
                'kode_indeks' => $kode_indeks,
                'judul_indeks' => $judul_indeks,
                'detail' => $detail,
            ], ['id_indeks' => $id]);

            $this->session->set_flashdata('success', 'Data berhasil diubah!');
            return redirect('indexsurat');
        }
    }

    public function delete($id = null)
    {
        $indeks = $this->db->get_where('indeks', ['id_indeks' => $id]);

        if ($id === null || count($indeks->result_array()) <= 0) {
            return redirect('indexsurat');
        }

        $this->db->delete('indeks', ['id_indeks' => $id]);
        $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        return redirect('indexsurat');
    }
}

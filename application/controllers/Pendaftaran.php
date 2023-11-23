<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('role_id') != 2) {
            $this->load->view('errors/html/error_403'); // Menampilkan halaman error 403
            return;
        }
        $query = $this->db->get('pendaftaran');
        $data['pendaftaran'] = $query->result();

        $data['title'] = "Pendaftaran";
        $this->load->view('templates/main/header', $data);
        $this->load->view('pendaftaran/sidebar', $data);
        $this->load->view('pendaftaran/pendaftaran', $data);
        $this->load->view('templates/main/footer');
    }

    public function tambah_pendaftaran()
    {
        if ($this->session->userdata('role_id') != 2) {
            $this->load->view('errors/html/error_403'); // Menampilkan halaman error 403
            return;
        }

        $data['title'] = "Pendaftaran";
        $this->load->view('templates/main/header', $data);
        $this->load->view('pendaftaran/sidebar', $data);
        $this->load->view('pendaftaran/tambah_pendaftaran');
        $this->load->view('templates/main/footer');
    }

    public function proses_tambah_pendaftaran()
    {
        if ($this->session->userdata('role_id') != 2) {
            $this->load->view('errors/html/error_403'); // Menampilkan halaman error 403
            return;
        }

        $this->form_validation->set_rules('nomor_rekam_medis', 'Nomor Rekam Medis', 'required|trim|integer');
        $this->form_validation->set_rules('nama_lengkap_pasien', 'Nomor Lengkap Pasien', 'required|trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'callback_validate_date');
        $this->form_validation->set_rules('kartu_identitas', 'Kartu Identitas', 'required');
        $this->form_validation->set_rules('nomor_kartu_identitas', 'Nomor Kartu Identitas', 'required|trim|integer');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Nomor Lengkap Pasien', 'required|trim');
        $this->form_validation->set_rules('warga_negara', 'Warga Negara', 'required|trim');
        $this->form_validation->set_rules('suku', 'Suku', 'required|trim');
        $this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'required|trim');
        $this->form_validation->set_rules('rt', 'RT', 'required|regex_match[/^[0-9-]+$/]|trim', array(
            'regex_match' => 'Kolom RT harus berisi bulangan bilat atau tanda strip "-"'
        ));
        $this->form_validation->set_rules('rw', 'RW', 'required|regex_match[/^[0-9-]+$/]|trim', array(
            'regex_match' => 'Kolom RW harus berisi bulangan bilat atau tanda strip "-"'
        ));
        $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required|trim');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required|trim');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim');
        $this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('bahasa', 'Bahasa', 'required|trim');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim');
        $this->form_validation->set_rules('nomor_hp', 'Nomor HP', 'required|trim|integer');
        $this->form_validation->set_rules('jenis_pembayaran', 'Jenis Pembayaran', 'required|trim');


        $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required');
        $this->form_validation->set_rules('nama_penanggung_jawab', 'Nama Penanggung Jawab', 'required|trim');
        $this->form_validation->set_rules('hubungan', 'Hubungan Penanggung Jawab', 'required|trim');
        $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required|trim');
        $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required|trim');
        $this->form_validation->set_rules('alamat_penanggung_jawab', 'Alamat Lengkap Penanggung Jawab', 'required|trim');
        $this->form_validation->set_rules('rt_penanggung_jawab', 'RT', 'required|regex_match[/^[0-9-]+$/]|trim', array(
            'regex_match' => 'Kolom RT harus berisi bulangan bilat atau tanda strip "-"'
        ));
        $this->form_validation->set_rules('rw_penanggung_jawab', 'RW', 'required|regex_match[/^[0-9-]+$/]|trim', array(
            'regex_match' => 'Kolom RW harus berisi bulangan bilat atau tanda strip "-"'
        ));
        $this->form_validation->set_rules('kelurahan_penanggung_jawab', 'Kelurahan', 'required|trim');
        $this->form_validation->set_rules('kecamatan_penanggung_jawab', 'Kecamatan', 'required|trim');
        $this->form_validation->set_rules('kabupaten_penanggung_jawab', 'Kabupaten', 'required|trim');
        $this->form_validation->set_rules('provinsi_penanggung_jawab', 'Provinsi', 'required|trim');
        $this->form_validation->set_rules('nomor_hp_penanggung_jawab', 'Nomor HP Penanggung Jawab', 'required|trim|integer');
        $this->form_validation->set_rules('poliklinik', 'Poliklinik', 'required');
        $this->form_validation->set_rules('ketentuan_rs_ke_pasien', 'Ketentuan Rumah Sakit ke Pasien / Keluarga', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pendaftaran';
            $data['tanggal_lahir'] = $_POST['nomor_kartu_identitas'];
            $this->load->view('templates/main/header', $data);
            $this->load->view('pendaftaran/sidebar', $data);
            $this->load->view('pendaftaran/tambah_pendaftaran', $data);
            $this->load->view('templates/main/footer');
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $data_pendaftaran  = [
                'nomor_rekam_medis' => $this->input->post('nomor_rekam_medis'),
                'nama_lengkap_pasien' => $this->input->post('nama_lengkap_pasien'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'kartu_identitas' => $this->input->post('kartu_identitas'),
                'nomor_kartu_identitas' => $this->input->post('nomor_kartu_identitas'),
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'pekerjaan' => $this->input->post('pekerjaan'),
                'warga_negara' => $this->input->post('warga_negara'),
                'suku' => $this->input->post('suku'),
                'alamat_lengkap' => $_POST['alamat_lengkap'] . ', RT ' . $_POST['rt'] . ', RW ' . $_POST['rw'] . ', Kelurahan ' . $_POST['kelurahan'] . ', Kecamatan ' . $_POST['kecamatan'] . ', Kabupaten ' . $_POST['kabupaten'] . ', Provinsi ' . $_POST['provinsi'],
                'status_perkawinan' => $this->input->post('status_perkawinan'),
                'agama' => $this->input->post('agama'),
                'bahasa' => $this->input->post('bahasa'),
                'pendidikan' => $this->input->post('pendidikan'),
                'nomor_hp' => $this->input->post('nomor_hp'),
                'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),

                'penanggung_jawab' => $this->input->post('penanggung_jawab'),
                'nama_penanggung_jawab' => $this->input->post('nama_penanggung_jawab'),
                'hubungan' => $this->input->post('hubungan'),
                'alamat_penanggung_jawab' => $_POST['alamat_penanggung_jawab'] . ', RT ' . $_POST['rt_penanggung_jawab'] . ', RW ' . $_POST['rw_penanggung_jawab'] . ', Kelurahan ' . $_POST['kelurahan_penanggung_jawab'] . ', Kecamatan ' . $_POST['kecamatan_penanggung_jawab'] . ', Kabupaten ' . $_POST['kabupaten_penanggung_jawab'] . ', Provinsi ' . $_POST['provinsi_penanggung_jawab'],
                'nomor_hp_penanggung_jawab' => $this->input->post('nomor_hp_penanggung_jawab'),
                'poliklinik' => $this->input->post('poliklinik'),
                'ketentuan_rs_ke_pasien' => $this->input->post('ketentuan_rs_ke_pasien'),
                'waktu_pendaftaran' => date('Y-m-d H:i:s'),
                'user_id' => $this->session->userdata('user_id'),
            ];
            $this->db->insert('pendaftaran', $data_pendaftaran);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="display: inline-block;">
                                <div>
                                    Pendaftarah pasien baru berhasil ditambahkan!
                                    <i class="bi bi-check-circle-fill"></i> <!-- Menggunakan ikon tanda centang -->
                                </div>
                            </div>');
            redirect('pendaftaran');
        }
    }

    public function profile()
    {
        if ($this->session->userdata('role_id') != 2) {
            $this->load->view('errors/html/error_403'); // Menampilkan halaman error 403
            return;
        }
        $data['title'] = "Profile";
        $this->load->view('templates/main/header', $data);
        $this->load->view('pendaftaran/sidebar', $data);
        $this->load->view('pendaftaran/profile');
        $this->load->view('templates/main/footer');
    }

    public function validate_date($str)
    {
        // Atur format tanggal yang sesuai, misalnya 'Y-m-d'
        $date_format = 'Y-m-d';
        if (empty($str)) {
            return TRUE;
        }
        // Coba mengubah tanggal menjadi format yang diinginkan
        $date = DateTime::createFromFormat($date_format, $str);

        // Periksa apakah tanggal valid
        return $date && $date->format($date_format) === $str;
    }
}

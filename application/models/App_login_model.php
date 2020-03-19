<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class App_Login_Model extends CI_Model
{

	/*
		***	Model : app_login_model.php
	*/

	public function getLoginData($data)
	{
		//$id_tapel				= $data['id_tapel'];

		$login['username'] = $data['username'];
		$login['password'] = md5($data['password']);
		$cek = $this->db->get_where('tb_user', $login);
		if ($cek->num_rows() > 0) {
			foreach ($cek->result() as $qad) {
				$sess_data['logged_in'] = 'yesGetMeLoginBaby';
				$sess_data['id_user'] = $qad->id_user;
				$sess_data['username'] = $qad->username;
				$sess_data['nama_lengkap'] = $qad->nama_lengkap;
				$sess_data['level'] = $qad->level;
				$sess_data['foto'] = $qad->foto;

				$this->session->set_userdata($sess_data);
			}

			if ($this->session->userdata('logged_in') != "" && $this->session->userdata('level') == "Admin") {
				redirect('admin/dashboard');
			} else if ($this->session->userdata('logged_in') != "" && $this->session->userdata('level') == "User") {
				redirect('user/dashboard');
			}
		} else {

			$this->session->set_flashdata('result_login', '<div class="alert alert-danger background-danger" role="alert"> 
			Maaf, kombinasi username dan password yang anda masukkan tidak valid dengan database kami.</div>');

			redirect('app');
		}
	}
}

/* End of file app_login_model.php */
/* Location: ./application/models/app_login_model.php */

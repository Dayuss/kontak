<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

	public function index(){
		$data = [
			'title' => 'Kontak',
			'isi'		=> 'admin/kontak/index' 
		];
		$this->load->view('admin/layout/wrapper', $data); 
	}
	
	public function ambil_data(){
		$kontak = $this->kontak_model->get();
		echo json_encode($kontak);
	}
	public function ambil_id(){
		$id_kontak  = $this->input->post('id_kontak');
		$data 			= array('id_kontak' => $id_kontak);
		$kontak 		= $this->kontak_model->ambil_id($data);
		echo json_encode($kontak);
	}
	public function tambah_data(){
		$nama_kontak 	= $this->input->post('nama_kontak');
		$email_kontak = $this->input->post('email_kontak');
		$pesan_kontak = $this->input->post('pesan_kontak');
		if($nama_kontak == ""){
			$result['pesan'] = 'nama harus diisi';
		}elseif($email_kontak == ""){
			$result['pesan'] = 'email harus diisi';
		}elseif($pesan_kontak == ""){
			$result['pesan'] = 'pesan harus diisi';
		}else{
			$result['pesan'] = "";
			$data = array(
				'nama_kontak'	 => $nama_kontak,
				'email_kontak' => $email_kontak,
				'pesan_kontak' => $pesan_kontak,
			);
			$this->kontak_model->insert($data);
		}
		echo json_encode($result);
	}

	public function edit_data(){
		$id_kontak 			= $this->input->post('id_kontak');
		$nama_kontak 		= $this->input->post('nama_kontak');
		$email_kontak 	= $this->input->post('email_kontak');
		$pesan_kontak 	= $this->input->post('pesan_kontak');
		if($nama_kontak == ""){
			$result['pesan'] = 'nama harus diisi';
		}elseif($email_kontak == ""){
			$result['pesan'] = 'email harus diisi';
		}elseif($pesan_kontak == ""){
			$result['pesan'] = 'pesan harus diisi';
		}else{
			$result['pesan'] = "";
			$data = array(
				'id_kontak' => $id_kontak,
				'nama_kontak' => $nama_kontak,
				'email_kontak' => $email_kontak,
				'pesan_kontak' => $pesan_kontak,
			);
			$this->kontak_model->update($data);
		}
		echo json_encode($result);
	}

	public function hapus(){
		$id_kontak =  $this->input->post('id_kontak');
		$data = array('id_kontak' => $id_kontak);
		$kontak = $this->kontak_model->delete($data);
		echo json_encode($kontak);
	}

}

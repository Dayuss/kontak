<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_model extends CI_Model {
	public function get(){
		$query = $this->db->get('kontak');
		return $query->result();
	}
	public function insert($data){
		$this->db->insert('kontak',$data);
	}
	public function ambil_id($data){
		$query = $this->db->get_where('kontak',$data);
		return $query->result();
	}
	public function update($data){
		$this->db->where('id_kontak',$data['id_kontak']);
		$this->db->update('kontak',$data);
	}
	public function delete($data){
		$this->db->where('id_kontak',$data['id_kontak']);
		$this->db->delete('kontak',$data);
	}
	
}
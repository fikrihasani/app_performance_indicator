<?php
class M_pemeriksaan extends CI_Model{
	public function __Construct(){
	parent:: __Construct();
	}

	public function insert_pemeriksaan($data){
		return $this->db->insert('pemeriksaan', $data);
	}

	public function get_all_pemeriksaan_by_id($id, $filter = [], $limit = 0, $start = 0){

				if($limit <= 0) $limit = 50;
				if($start <= 0) $start = 0;

				$flt = [];

				if(ISSET($filter['trimester']) && $filter['trimester'] != '') {
					$filter['trimester'] = strtolower(inject($filter['trimester']));
					$flt[] = "lower(p.trimester) LIKE '%$filter[trimester]%'";
				}

				if(ISSET($filter['status_resiko']) && $filter['status_resiko'] != '') {
					$filter['status_resiko'] = strtolower(inject($filter['status_resiko']));
					$flt[] = "lower(p.status_resiko) LIKE '%$filter[status_resiko]%'";
				}

				$str_filter = implode(' AND ', $flt);

				if(count($flt) > 0) $str_filter = ' AND '.$str_filter;

		return $this->db->query("
			SELECT p.id_pemeriksaan, k.id_kehamilan, nama_ibu, k.usia_kandungan_daftar, p.tanggal_periksa, p.trimester, p.anamnesis, p.berat_badan, p.tinggi_badan, p.fundung_uterus, p.lingkar_lengan, p.status_gizi, p.refleksi_patella, p.djj,  p.kepala, p.berat_janin, p.jumlah_janin, p.tekanan_a, p.tekanan_b, p.presentasi, p.status_konseling, p.status_imunisasi, p.status_injeksi, p.status_pencatatan, p.protein_urine, p.ps, p.hb, p.gula_darah, p.status_thalasemia, p.status_sifilis, p.hbsag, p.vct, p.serologi, p.arv, p.malaria, p.obat, p.kelambu, p.tb, p.obat2, p.hdk, p.abortus, p.pendarahan, p.infeksi, p.kpd, p.lain_lain, p.status_bpjs, p.status_resiko
			FROM kehamilan k, ibu i, pemeriksaan p
			WHERE p.id_ibu = i.nik and k.id_ibu = p.id_ibu
			AND i.nik = '$id'
			AND k.status_kehamilan = '1'
			AND status_verifikasi = '1'
			$str_filter
			LIMIT $start, $limit
		")->result_array();

		//return $result;
	}

	public function get_pemeriksaan_by_id($id, $waktu){
		return $this->db->query("
		SELECT * FROM pemeriksaan
		WHERE id_ibu = '$id'
		AND waktu_daftar = '$waktu'")->row_array();
	}

	public function get_pemeriksaan_by_idp($idp){
		return $this->db->get_where('pemeriksaan', ['id_pemeriksaan' => $idp])->row_array();
	}

	public function update_pemeriksaan($data, $id){
		return $this->db->update('pemeriksaan', $data, array('id_pemeriksaan' => $id));
	}

	public function get_pemeriksaan_unverified_by_desa($id, $filter = [], $limit = 0, $start = 0){

				if($limit <= 0) $limit = 50;
				if($start <= 0) $start = 0;

				$flt = [];

				if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
					$filter['full_name'] = strtolower(inject($filter['full_name']));
					$flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
				}

				if(ISSET($filter['status_verifikasi']) && $filter['status_verifikasi'] != '') {
					$filter['p.status_verifikasi'] = strtolower(inject($filter['status_verifikasi']));
					$flt[] = "p.status_verifikasi = '$filter[status_verifikasi]'";
				}

				$str_filter = implode(' AND ', $flt);

				if(count($flt) > 0) $str_filter = ' AND '.$str_filter;

		$result = $this->db->query("
			SELECT p.id_pemeriksaan, k.id_kehamilan, nama_ibu, i.id_desa, k.usia_kandungan_daftar, k.waktu_daftar, p.status_resiko, HPL, p.status_verifikasi
			FROM kehamilan k, ibu i, pemeriksaan p
			WHERE p.id_ibu = i.nik and k.id_ibu = p.id_ibu AND i.id_desa = '$id'
			AND k.status_kehamilan = '1'
			AND (p.status_verifikasi = '0' OR p.status_verifikasi = '2')
			$str_filter
			LIMIT $start, $limit
		")->result_array();

		return $result;
	}

	public function get_all_pemeriksaan_unverified($filter = [], $limit = 0, $start = 0){

			if($limit <= 0) $limit = 50;
			if($start <= 0) $start = 0;

			$flt = [];

			if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
				$filter['full_name'] = strtolower(inject($filter['full_name']));
				$flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
			}

			if(ISSET($filter['status_verifikasi']) && $filter['status_verifikasi'] != '') {
				$filter['p.status_verifikasi'] = strtolower(inject($filter['status_verifikasi']));
				$flt[] = "p.status_verifikasi = '$filter[status_verifikasi]'";
			}

			$str_filter = implode(' AND ', $flt);

			if(count($flt) > 0) $str_filter = ' AND '.$str_filter;

		$result = $this->db->query("
			SELECT i.nik, i.nama_ibu, i.alamat, p.id_pemeriksaan, k.id_kehamilan, nama_ibu, i.id_desa, k.usia_kandungan_daftar, k.waktu_daftar, p.status_resiko, HPL, p.status_verifikasi
			FROM kehamilan k, ibu i, pemeriksaan p
			WHERE p.id_ibu = i.nik and k.id_ibu = p.id_ibu
			AND k.status_kehamilan = '1'
			AND (p.status_verifikasi = '0' OR p.status_verifikasi = '2')")->result_array();

		return $result;
	}

	public function get_pemeriksaan_unverified_by_id($id, $waktu){
		return $this->db->query("SELECT * from pemeriksaan where id_ibu = '$id' and waktu_daftar = '$waktu' and (status_verifikasi = '0' OR status_verifikasi = '2')")->row_array();
	}

	public function get_pemeriksaan_unverified_by_idp($idp){
		return $this->db->get_where('pemeriksaan', ['id_pemeriksaan' => $idp])->row_array();
	}

	public function get_all_rujukan_by_id($id){
		return $this->db->query("SELECT * FROM rujukan WHERE id_kehamilan = '$id' ORDER BY waktu_daftar DESC")->result_array();
	}

	public function get_rujukan_unverified_by_id($id){
		return $this->db->get_where('rujukan', ['id_kehamilan' => $id, 'status_verifikasi' => 0])->row_array();
	}

	public function get_resiko_by_id($id){
		return $this->db->query("SELECT id_ibu, status_resiko FROM pemeriksaan WHERE id_ibu = '$id' ORDER BY waktu_ubah DESC LIMIT 1")->row_array();
	}

	public function set_pemeriksaan_verified($idp, $data){
		return $this->db->update('pemeriksaan', $data, array('id_pemeriksaan' => $idp));
	}

	public function set_pemeriksaan_unverified($idp, $data){
		return $this->db->update('pemeriksaan', $data, array('id_pemeriksaan' => $idp));
	}

	public function insert_catatan($idp, $data){
		return $this->db->update('pemeriksaan', $data, array('id_pemeriksaan' => $idp));
	}

	public function delete_pemeriksaan($idp){
		return $this->db->delete('pemeriksaan', ['id_pemeriksaan' => $idp]);
	}
}

?>

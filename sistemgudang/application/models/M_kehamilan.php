<?php
class M_kehamilan extends CI_Model{
	public function __Construct(){
	parent:: __Construct();
	}

	public function get_kehamilan_berjalan_by_desa($id, $filter = [], $limit = 0, $start = 0){

		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];

        if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
            $flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
        }

		if(ISSET($filter['status_resiko']) && $filter['status_resiko'] != '') {
			$filter['status_resiko'] = strtolower(inject($filter['status_resiko']));
            $flt[] = "k.current_risk = '$filter[status_resiko]'";
        }

		if(ISSET($filter['hpl']) && $filter['hpl'] != '') {
			$filter['hpl'] = strtolower(inject($filter['hpl']));
			$flt[] = "month(k.HPL) = $filter[hpl]";
		}

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;


	 	$result = $this->db->query("
			SELECT k.id_kehamilan, i.nama_ibu, i.id_desa, i.nik, i.alamat, i.nomor_darurat, k.waktu_konsepsi, k.current_risk, k.waktu_daftar, k.HPL
			FROM kehamilan k, ibu i
			WHERE k.id_ibu = i.nik  AND i.id_desa = '$id' AND k.status_kehamilan = '1'
			$str_filter
			order by k.waktu_daftar DESC
			LIMIT $start, $limit
		")->result_array();


		return $result;
	}

	public function get_kehamilan_by_id($id){
		$result = $this->db->query("
			SELECT k.id_kehamilan, i.nama_ibu, i.nik, i.tanggal_lahir, i.alamat, i.nomor_darurat, k.waktu_konsepsi, k.current_risk, k.waktu_daftar, k.HPL
			FROM kehamilan k, ibu i
			WHERE k.id_ibu = i.nik
			AND k.id_kehamilan = '$id'
			")->row_array();
		return $result;
	}

	public function get_all_kehamilan($filter = [], $limit = 0, $start = 0){
		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];

        if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
            $flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
        }

		if(ISSET($filter['status_resiko']) && $filter['status_resiko'] != '') {
			$filter['status_resiko'] = strtolower(inject($filter['status_resiko']));
            $flt[] = "k.current_risk = '$filter[status_resiko]'";
        }

		if(ISSET($filter['hpl']) && $filter['hpl'] != '') {
			$filter['hpl'] = strtolower(inject($filter['hpl']));
			$flt[] = "month(k.HPL) = $filter[hpl]";
		}

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;
		return $this->db->query("
			SELECT k.id_kehamilan, i.nama_ibu, i.nik, i.id_desa, i.alamat, i.nomor_darurat, k.waktu_konsepsi, k.current_risk, k.waktu_daftar, k.HPL
			FROM kehamilan k, ibu i
			WHERE k.id_ibu = i.nik
			AND k.status_kehamilan = '1'
			order by k.waktu_daftar DESC
			$str_filter
			LIMIT $start, $limit")->result_array();
	}

	public function kehamilan_per_tahun($id, $year, $filter = [], $limit, $start){
		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];

		if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
            $flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
        }

		if(ISSET($filter['status_kehamilan']) && $filter['status_kehamilan'] != '') {
			$filter['status_kehamilan'] = strtolower(inject($filter['status_kehamilan']));
            $flt[] = "k.status_kehamilan = '$filter[usia_kandungan]'";
        }
		
		if(ISSET($filter['status_resiko']) && $filter['status_resiko'] != '') {
			$filter['status_resiko'] = strtolower(inject($filter['status_resiko']));
            $flt[] = "k.current_risk = '$filter[status_resiko]'";
        }

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;
		return $this->db->query("
			SELECT k.id_kehamilan, i.nama_ibu, i.nik, i.id_desa, i.alamat, i.nomor_darurat, k.waktu_konsepsi, k.current_risk, k.waktu_daftar, k.HPL, k.status_kehamilan
			FROM kehamilan k, ibu i
			WHERE year(k.waktu_daftar) = '$year'
			AND k.id_ibu = i.nik
			AND i.id_desa 		 = '$id'
			AND (k.status_kehamilan = '1' OR k.status_kehamilan = '3' OR k.status_kehamilan = '4' OR k.status_kehamilan = '5')
			$str_filter
			LIMIT $start, $limit")->result_array();
	}

	public function kehamilan_per_tahun_all($year, $filter = [], $limit, $start){
		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];

        if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
            $flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
        }

		if(ISSET($filter['status_kehamilan']) && $filter['status_kehamilan'] != '') {
			$filter['status_kehamilan'] = strtolower(inject($filter['status_kehamilan']));
            $flt[] = "k.status_kehamilan = '$filter[status_kehamilan]'";
        }
		
		if(ISSET($filter['status_resiko']) && $filter['status_resiko'] != '') {
			$filter['status_resiko'] = strtolower(inject($filter['status_resiko']));
            $flt[] = "k.current_risk = '$filter[status_resiko]'";
        }
		
		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;
		return $this->db->query("
			SELECT k.id_kehamilan, i.nama_ibu, i.nik, i.id_desa, i.alamat, i.nomor_darurat, k.waktu_konsepsi, k.current_risk, k.waktu_daftar, k.HPL, k.status_kehamilan
			FROM kehamilan k, ibu i
			WHERE year(k.waktu_daftar) = '$year'
			AND k.id_ibu = i.nik
			AND (k.status_kehamilan = '1' OR k.status_kehamilan = '3' OR k.status_kehamilan = '4' OR k.status_kehamilan = '5')
			$str_filter
			LIMIT $start, $limit")->result_array();
	}

	public function get_kehamilan_unverified_by_desa($id, $filter = [], $limit = 0, $start = 0){

		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];

        $limit = $limit + 1;

		if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
			$flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
		}

		if(ISSET($filter['status_kehamilan']) && $filter['status_kehamilan'] != '') {
			$filter['status_kehamilan'] = strtolower(inject($filter['status_kehamilan']));
			$flt[] = "k.status_kehamilan = '$filter[status_kehamilan]'";
		}
		
		if(ISSET($filter['status_resiko']) && $filter['status_resiko'] != '') {
			$filter['status_resiko'] = strtolower(inject($filter['status_resiko']));
            $flt[] = "k.current_risk = '$filter[status_resiko]'";
        }
		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;

		$result = $this->db->query("
			SELECT k.id_kehamilan, i.nama_ibu, i.nik, i.alamat, i.nomor_darurat, k.waktu_konsepsi, k.current_risk, k.waktu_daftar, k.HPL, k.status_kehamilan
			FROM kehamilan k, ibu i
			WHERE k.id_ibu = i.nik
			AND i.id_desa = '$id'
			AND (k.status_kehamilan = '0' OR k.status_kehamilan = '2')
			$str_filter
			order by k.waktu_daftar DESC
			LIMIT $start, $limit
		")->result_array();

		return $result;
	}

	public function get_kehamilan_unverified_by_id($id){
		return $this->db->query("
			SELECT k.id_kehamilan, i.nama_ibu, i.nik, i.alamat, i.nomor_darurat, k.waktu_konsepsi, k.current_risk, k.waktu_daftar,  k.HPL, k.status_kehamilan
			FROM kehamilan k, ibu i
			WHERE k.id_ibu = i.nik
			AND k.id_kehamilan = '$id'
			")->row_array();
	}

	public function get_all_kehamilan_unverified($filter = [], $limit = 0, $start = 0){

		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];

        $limit = $limit + 1;

		if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
			$flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
		}

		if(ISSET($filter['status_kehamilan']) && $filter['status_kehamilan'] != '') {
			$filter['status_kehamilan'] = strtolower(inject($filter['status_kehamilan']));
			$flt[] = "k.status_kehamilan = '$filter[status_kehamilan]'";
		}

		if(ISSET($filter['status_resiko']) && $filter['status_resiko'] != '') {
			$filter['status_resiko'] = strtolower(inject($filter['status_resiko']));
            $flt[] = "k.current_risk = '$filter[status_resiko]'";
        }
		
		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;
		return $this->db->query("
			SELECT k.id_kehamilan, i.nama_ibu, i.nik, i.alamat, i.nomor_darurat, i.id_desa, k.waktu_konsepsi, k.current_risk, k.waktu_daftar, k.HPL, k.status_kehamilan
			FROM kehamilan k, ibu i
			WHERE k.id_ibu = i.nik
			AND (k.status_kehamilan = '0' OR k.status_kehamilan = '2')
			$str_filter
			order by k.waktu_daftar DESC
			LIMIT $start, $limit
			")->result_array();
	}

	public function insert_kehamilan($data){
		return $this->db->insert('kehamilan', $data);
	}

	public function insert_rujukan($data){
		return $this->db->insert('rujukan', $data);
	}

	public function insert_kelahiran($data){
		return $this->db->insert('kelahiran', $data);
	}

	public function insert_abortus($data){
		return $this->db->insert('abortus', $data);
	}

	public function insert_kematian($data){
		return $this->db->insert('kematian', $data);
	}

	public function update_kehamilan($data, $idk){
		return $this->db->update('kehamilan', $data, array('id_kehamilan' => $idk));
	}

	public function set_kehamilan_verified($id, $time, $bidan){
		//return $this->db->update('kehamilan', $data, array('id_kehamilan' => $idk));
		return $this->db->query("UPDATE kehamilan SET status_kehamilan = '1', waktu_ubah = '$time', ubah_by = '$bidan' WHERE id_ibu = '$id' AND (status_kehamilan = '0' OR status_kehamilan = '2')");
	}

	public function set_kehamilan_unverified($idk, $data){
		return $this->db->update('kehamilan', $data, array('id_kehamilan' => $idk));
	}

	public function delete_kehamilan($idk){
		return $this->db->delete('kehamilan', ['id_kehamilan' => $idk]);
	}

	public function get_all_rujukan($filter = [], $limit = 0, $start = 0){

		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];

        if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
            $flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
        }

		if(ISSET($filter['usia_kandungan']) && $filter['usia_kandungan'] != '') {
			$filter['usia_kandungan'] = strtolower(inject($filter['usia_kandungan']));
            $flt[] = "k.usia_kandungan_daftar = '$filter[usia_kandungan]'";
        }
		
		if(ISSET($filter['status_resiko']) && $filter['status_resiko'] != '') {
			$filter['status_resiko'] = strtolower(inject($filter['status_resiko']));
            $flt[] = "k.current_risk = '$filter[status_resiko]'";
        }

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;


	 	$result = $this->db->query("
			SELECT k.id_kehamilan, i.nama_ibu, i.nik, i.id_desa, i.alamat, k.waktu_konsepsi, k.waktu_daftar, r.tanggal_rujukan, r.tempat_rujukan, r.pendeteksi_resiko, r.keadaan_tiba, r.keadaan_pulang
			FROM rujukan r, kehamilan k, ibu i
			WHERE r.id_kehamilan = k.id_kehamilan
			AND k.status_kehamilan = '1'
			AND k.id_ibu = i.nik
			$str_filter
			LIMIT $start, $limit
		")->result_array();
		return $result;
	}

	public function get_rujukan_by_desa($id, $filter = [], $limit = 0, $start = 0){

		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];

        if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
            $flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
        }

		if(ISSET($filter['usia_kandungan']) && $filter['usia_kandungan'] != '') {
			$filter['usia_kandungan'] = strtolower(inject($filter['usia_kandungan']));
            $flt[] = "k.usia_kandungan_daftar = '$filter[usia_kandungan]'";
        }

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;


	 	$result = $this->db->query("
			SELECT k.id_kehamilan, i.nama_ibu, i.nik, i.id_desa, i.alamat, k.waktu_konsepsi, k.waktu_daftar, r.tanggal_rujukan, r.tempat_rujukan, r.pendeteksi_resiko, r.keadaan_tiba, r.keadaan_pulang
			FROM rujukan r, kehamilan k, ibu i
			WHERE r.id_kehamilan = k.id_kehamilan
			AND k.status_kehamilan = '1'
			AND k.id_ibu = i.nik
			AND i.id_desa = '$id'
			$str_filter
			LIMIT $start, $limit
		")->result_array();
		return $result;
	}

	public function get_all_rujukan_by_id($id, $filter = [], $limit = 0, $start = 0){

		if($limit <= 0) $limit = 50;
		if($start <= 0) $start = 0;

		$flt = [];

        if(ISSET($filter['full_name']) && $filter['full_name'] != '') {
			$filter['full_name'] = strtolower(inject($filter['full_name']));
            $flt[] = "lower(i.nama_ibu) LIKE '%$filter[full_name]%'";
        }

		if(ISSET($filter['usia_kandungan']) && $filter['usia_kandungan'] != '') {
			$filter['usia_kandungan'] = strtolower(inject($filter['usia_kandungan']));
            $flt[] = "k.uwaktu_konsepsi = '$filter[usia_kandungan]'";
        }

		$str_filter = implode(' AND ', $flt);

		if(count($flt) > 0) $str_filter = ' AND '.$str_filter;


	 	$result = $this->db->query("
			SELECT k.id_kehamilan, k.waktu_konsepsi, k.waktu_daftar, r.tanggal_rujukan, r.tempat_rujukan, r.pendeteksi_resiko, r.keadaan_tiba, r.keadaan_pulang
			FROM rujukan r, kehamilan k, ibu i
			WHERE r.id_kehamilan = k.id_kehamilan
			AND k.status_kehamilan = '1'
			AND k.id_ibu = i.nik
			AND i.nik = '$id'
			$str_filter
			LIMIT $start, $limit
		")->result_array();
		return $result;
	}

	public function count_data_all($month,$year){
		$tes = $this->db->query("SELECT i.id_desa, count(id_kehamilan) as jum
								FROM kehamilan k, ibu i
								WHERE k.id_ibu = i.nik
								AND YEAR(k.waktu_daftar) = '$year'
								AND month(k.waktu_daftar) = '$month'
								AND (k.status_kehamilan = '1'OR k.status_kehamilan = '3' OR k.status_kehamilan = '4' OR k.status_kehamilan = '5')
                                GROUP by i.id_desa")->result_array();

        $desa = $this->db->query("SELECT id_desa FROM desa WHERE id_desa <> '99' and id_desa <> '12' order by id_desa ASC")->result_array();
        $jumlah = array();
        foreach($desa as $ds) {
            $jumlah[$ds['id_desa']] = 0;
        }

		foreach($tes as $data){
			$jumlah[$data['id_desa']] = $data['jum'];
		};

		$return = "{";
		foreach ($jumlah  as $val) {
		    $return .= $val.',';
		}

		$return = substr($return, 0, -1);

		$return .= "}";

		return $return;
	}

	public function count_data_desa($id_desa, $year){
				$tes = $this->db->query("SELECT i.id_desa, count(id_kehamilan) as jum
								FROM kehamilan k, ibu i
								WHERE k.id_ibu = i.nik
								AND YEAR(k.waktu_daftar) = '$year'
								AND month(k.waktu_daftar) = '$year'
                                GROUP by i.id_desa")->result_array();

        $desa = $this->db->query("SELECT id_desa FROM desa order by id_desa ASC")->result_array();
        $jumlah = array();
        foreach($desa as $ds) {
            $jumlah[$ds['id_desa']] = 0;
        }

		foreach($tes as $data){
			$jumlah[$data['id_desa']] = $data['jum'];
		};

		$return = "{";
		foreach ($jumlah  as $val) {
		    $return .= $val.',';
		}

		$return = substr($return, 0, -1);

		$return .= "}";

		return $return;
	}

	public function count_kehamilan_th_all(){
			$year	 = date("Y");
			$j		 = $this->db->query("SELECT count(id_kehamilan) as jum
								FROM kehamilan k
								WHERE YEAR(k.waktu_daftar) = '$year'
								AND (k.status_kehamilan = '1' OR k.status_kehamilan = '3' OR k.status_kehamilan = '4' OR k.status_kehamilan = '5')
								")->row_array();
			$jumlah	= $j['jum'];
		return $jumlah;
	}

	public function count_kehamilan_berj_all(){
			$j		 = $this->db->query("SELECT count(id_kehamilan) as jum
								FROM kehamilan k
								WHERE k.status_kehamilan = '1'
								")->row_array();
			$jumlah	= $j['jum'];
		return $jumlah;
	}

	public function count_kehamilan_xx_all(){
			$year	 = date("Y");
			$j		 = $this->db->query("SELECT count(id_kehamilan) as jum
								FROM kehamilan k
								WHERE YEAR(k.waktu_daftar) = '$year'
								AND (k.status_kehamilan = '4' OR k.status_kehamilan = '5')
								")->row_array();
			$jumlah	= $j['jum'];
		return $jumlah;
	}

	public function count_kehamilan_th_desa($id_desa){
			$year	 = date("Y");
			$j		 = $this->db->query("SELECT count(id_kehamilan) as jum
								FROM kehamilan k, ibu i
								WHERE YEAR(k.waktu_daftar) = '$year'
								AND k.id_ibu = i.nik
								AND i.id_desa = '$id_desa'
								AND (k.status_kehamilan = '1' OR k.status_kehamilan = '3' OR k.status_kehamilan = '4' OR k.status_kehamilan = '5')
								")->row_array();
			$jumlah	= $j['jum'];
		return $jumlah;
	}

	public function count_kehamilan_berj_desa($id_desa){
			$j		 = $this->db->query("SELECT count(id_kehamilan) as jum
								FROM kehamilan k, ibu i
								WHERE k.id_ibu = i.nik
								AND i.id_desa = '$id_desa'
								AND k.status_kehamilan = '1'
								")->row_array();
			$jumlah	= $j['jum'];
		return $jumlah;
	}

	public function count_kehamilan_xx_desa($id_desa){
			$year	 = date("Y");
			$j		 = $this->db->query("SELECT count(id_kehamilan) as jum
								FROM kehamilan k, ibu i
								WHERE YEAR(k.waktu_daftar) = '$year'
								AND k.id_ibu = i.nik
								AND i.id_desa = '$id_desa'
								AND (k.status_kehamilan = '4' OR k.status_kehamilan = '5')
								")->row_array();
			$jumlah	= $j['jum'];
		return $jumlah;
	}

	public function get_hb($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_anemia($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.hb BETWEEN 8 AND 11
		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_hbkurang($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.hb < 8
		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_lila($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_lilakurang($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.lingkar_lengan < 23.5
		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_proteinurine($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_proteinurinepositif($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.protein_urine = 1

		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_guladarah($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_guladarahpositif($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.gula_darah = 1

		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_hiv($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_hivpositif($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.vct = 1

		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_kelambu($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.kelambu = 1

		")->row_array();
		return $result['jum'];
	}

	public function get_mikroskopik($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
		")->row_array();
		$jum = $result['jum'];
		return $jum;
	}

	public function get_malaria($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.malaria = 1

		")->row_array();
		return $result['jum'];
	}

	public function get_obatmalaria($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.obat is null

		")->row_array();
		return $result['jum'];
	}

	public function get_tb($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'

		")->row_array();
		return $result['jum'];
	}

	public function get_tbpositif($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.tb = 1

		")->row_array();
		return $result['jum'];
	}

	public function get_obattb($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.obat2 is null

		")->row_array();
		return $result['jum'];
	}

	public function get_ims($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'

		")->row_array();
		return $result['jum'];
	}

	public function get_imspositif($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.status_sifilis = 1

		")->row_array();
		return $result['jum'];
	}

	public function get_hepatitis($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'

		")->row_array();
		return $result['jum'];
	}

	public function get_hepatitispositif($id_desa, $month, $year){
		$result = $this->db->query("SELECT count(p.id_pemeriksaan) as jum
			FROM pemeriksaan p
			WHERE p.id_ibu IN
				(SELECT id_ibu
				FROM kehamilan k, ibu i
				WHERE i.id_desa = '$id_desa' AND k.id_ibu = i.nik AND month(k.waktu_daftar)= '$month' AND year(k.waktu_daftar)='$year' AND k.status_kehamilan = '1')
			AND p.status_verifikasi = '1'
			AND p.hdk = 1

		")->row_array();
		return $result['jum'];
	}
}
?>

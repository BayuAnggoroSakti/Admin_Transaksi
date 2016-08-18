<?php if (! defined('BASEPATH')) EXIT ('No direct script access allowed');

class M_admin extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_data_transaksi()
	{
		$query = $this->db->query('SELECT tanggal,t.alamat, t.id_transaksi as id_transaksi, u.nama as user, lokasi, total from transaksi t, user u where t.id_user = u.id_user order by id_transaksi desc');
		return $query;
	}

	function get_data_dtransaksi()
	{
		$query = $this->db->query('SELECT dt.id_detail as id_detail, t.id_transaksi as id_transaksi, p.nama as nama, qty from detail_transaksi dt, transaksi t, produk p where dt.id_transaksi = t.id_transaksi and dt.id_produk = p.id_produk');
		return $query;
	}

	function get_data_produk()
	{
		return $this->db->get('produk');
	}

	function get_data_byId($tabel, $id)
	{
		$query = $this->db->query("SELECT * FROM $tabel where id_produk = '$id'");
		return $query;
	}


}

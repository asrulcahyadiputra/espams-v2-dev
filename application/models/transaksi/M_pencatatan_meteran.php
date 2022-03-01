<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pencatatan_meteran extends CI_Model
{
	public function select_transaksi($y, $m)
	{
		return $this->db->get_where('transaksi', ['bulan' => $m, 'tahun' => $y])->row_array();
	}
	private function count_all($y, $m)
	{
		$this->db->select('count(a.id_tagihan) as all_total')
			->join('transaksi as b', 'a.id_transaksi=b.id_transaksi')
			->from('trx_tagihan as a')
			->where('b.tahun', $y)
			->where('b.bulan', $m);

		return $this->db->get()->row_array();
	}
	private function count_select($y, $m)
	{
		$this->db->select('count(a.id_tagihan) as select_total')
			->from('trx_tagihan as a')
			->join('transaksi as b', 'a.id_transaksi=b.id_transaksi')
			->where('a.status', 3)
			->where('b.tahun', $y)
			->where('b.bulan', $m);

		return $this->db->get()->row_array();
	}
	public function progress($y, $m)
	{
		$all = $this->count_all($y, $m);
		$select = $this->count_select($y, $m);
		if ($select['select_total'] == 0 || $all['all_total'] == 0) {
			$progress = 0;
		} else {
			$progress = ($select['select_total'] / $all['all_total']) * 100;
		}

		return $progress;
	}
	private function pelanggan($id_pelanggan)
	{
		$this->db->select('a.id_pelanggan,a.nama_pelanggan,a.no_telp,a.alamat,b.nama_golongan')
			->from('m_pelanggan as a')
			->join('m_golongan as b', 'a.id_golongan=b.id_golongan')
			->where('a.id_pelanggan', $id_pelanggan)
			->order_by('a.id_pelanggan', 'ASC');

		return $this->db->get()->row_array();
	}
	public function tagihan($id)
	{
		$this->db->select('d.id_transaksi,d.bulan,d.tahun,d.jenis_tarif,d.tarif_tunggal,d.batas_pembayaran,d.status_denda,d.denda_flat,d.inv_note,c.id_pelanggan,c.id_golongan,c.kode_tagihan,c.meteran_awal,c.meteran_akhir,c.biaya_admin,c.biaya_beban,c.tunggakan,c.denda,c.pemakaian,c.total,c.bayar,c.status')
			->from('trx_tagihan as c')
			->join('transaksi as d', 'c.id_transaksi=d.id_transaksi')
			->where('c.id_tagihan', $id);

		return $this->db->get()->row_array();
	}
	private function golongan($id_golongan)
	{
		return $this->db->get_where('m_golongan', ['id_golongan' => $id_golongan])->row_array();
	}
	private function detail_golongan($id_golongan)
	{
		return $this->db->get_where('m_golongan_detail', ['id_golongan' => $id_golongan])->result_array();
	}
	public function all($y, $m)
	{
		$this->db->select('c.id_tagihan,c.id_pelanggan,a.nama_pelanggan,a.id_golongan,b.nama_golongan,c.meteran_awal,c.meteran_akhir,c.status')
			->from('transaksi as d')
			->join('trx_tagihan as c', 'd.id_transaksi=c.id_transaksi')
			->join('m_pelanggan as a', 'c.id_pelanggan=a.id_pelanggan')
			->join('m_golongan as b', 'c.id_golongan=b.id_golongan')
			->where('d.tahun', $y)
			->where('d.bulan', $m)
			->order_by('c.status,c.id_pelanggan', 'ASC');

		return $this->db->get()->result_array();
	}
	public function get_tagihan($id)
	{
		$tagihan 			= $this->tagihan($id);
		$pelanggan 		= $this->pelanggan($tagihan['id_pelanggan']);
		$golongan			= $this->golongan($tagihan['id_golongan']);
		$detail_golongan	= $this->detail_golongan($tagihan['id_golongan']);
		$data = [
			'tagihan'			=> $tagihan,
			'pelanggan'		=> $pelanggan,
			'golongan'		=> $golongan,
			'detail_golongan'	=> $detail_golongan
		];

		return $data;
	}

	public function select($id_transaksi)
	{
		$this->db->select('c.id_pelanggan,a.nama_pelanggan,a.id_golongan,b.nama_golongan,c.biaya_admin,c.biaya_beban,c.tunggakan,c.denda,c.pemakaian,c.total,c.status')
			->from('trx_tagihan as c')
			->join('m_pelanggan as a', 'c.id_pelanggan=a.id_pelanggan')
			->join('m_golongan as b', 'c.id_golongan=b.id_golongan')
			->where('c.id_transaksi', $id_transaksi)
			->order_by('a.id_pelanggan', 'ASC');

		return $this->db->get()->result_array();
	}

	public function find_transaksi($id_transaksi)
	{
		return $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi, 'trans_type' => 'tagihan'])->row_array();
	}


	//kode tagihan
	private function kode_tagihan()
	{
		$this->db->select('LEFT(kode_tagihan,9) as id', FALSE);
		$this->db->order_by('kode_tagihan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('trx_tagihan');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$code = intval($data->id) + 1;
		} else {
			$code = 1;
		}

		$interval = str_pad($code, 6, "0", STR_PAD_LEFT);
		$id = $interval . '/PA/';
		return $id;
	}

	// store meteran
	public function store()
	{
		$kode_tagihan 		= $this->kode_tagihan();
		$id_tagihan    	= $this->input->post('id_tagihan');
		$id_pelanggan   	= $this->input->post('id_pelanggan');
		$meteran_akhir 	= $this->input->post('meteran_akhir');
		$tagihan 			= $this->db->get_where('trx_tagihan', ['id_tagihan' => $id_tagihan])->row_array();
		if ($tagihan['status'] == 0) {
			$trx = [
				'kode_tagihan'		=> $kode_tagihan,
				'meteran_akhir'	=> $meteran_akhir,
				'status'			=> 1
			];
			$pelanggan = [
				'meteran_awal'		=> $meteran_akhir, //penunjukan awal di periode berikutnya
				'tunggakan'		=> 0, // tunggakan di periode berikutnya
				'denda'			=> 0, //denda di bulan berikutnya
			];
			// echo "<pre>";
			// print_r($trx);
			// print_r($pelanggan);
			// echo "</pre>";
			// die;
			$this->db->trans_start();
			$this->db->update('trx_tagihan', $trx, ['id_tagihan' => $id_tagihan]);
			$this->db->update('m_pelanggan', $pelanggan, ['id_pelanggan' => $id_pelanggan]);
			$this->db->trans_complete();
			$response = [
				'status'		=> 'OK',
				'id_tagihan'	=> $id_tagihan,
				'label'		=> 'success',
				'msg'		=> 'Pencatatan Meteran Berhasil, Silahkan cek kembali sebelum membuat tagihan final !'
			];
		} else {
			$response = [
				'status'		=> 'Warning',
				'id_tagihan'	=> $id_tagihan,
				'label'		=> 'warning',
				'msg'		=> 'Pencatatan Meteran tidak dapat diproses !'
			];
		}

		return $response;
	}
	public function update()
	{

		$id_tagihan    	= $this->input->post('id_tagihan');
		$id_pelanggan   	= $this->input->post('id_pelanggan');
		$meteran_akhir 	= $this->input->post('meteran_akhir');
		$tagihan 			= $this->db->get_where('trx_tagihan', ['id_tagihan' => $id_tagihan])->row_array();
		if ($tagihan['status'] == 1) {
			$trx = [

				'meteran_akhir'	=> $meteran_akhir,
				'status'			=> 1
			];
			$pelanggan = [
				'meteran_awal'		=> $meteran_akhir, //penunjukan awal di periode berikutnya
				'tunggakan'		=> 0, // tunggakan di periode berikutnya
				'denda'			=> 0, //denda di bulan berikutnya
			];
			// echo "<pre>";
			// print_r($trx);
			// print_r($pelanggan);
			// echo "</pre>";
			// die;
			$this->db->trans_start();
			$this->db->update('trx_tagihan', $trx, ['id_tagihan' => $id_tagihan]);
			$this->db->update('m_pelanggan', $pelanggan, ['id_pelanggan' => $id_pelanggan]);
			$this->db->trans_complete();
			$response = [
				'status'		=> 'OK',
				'id_tagihan'	=> $id_tagihan,
				'label'		=> 'success',
				'msg'		=> 'Pencatatan Meteran Berhasil di koreksi, Silahkan cek kembali sebelum membuat tagihan !'
			];
		} else {
			$response = [
				'status'		=> 'Warning',
				'id_tagihan'	=> $id_tagihan,
				'label'		=> 'warning',
				'msg'		=> 'Pencatatan Tidak dapat dikoreksi, karena tagihan sudah final !'
			];
		}

		return $response;
	}
	public function final()
	{

		$id_tagihan    	= $this->input->post('id_tagihan');
		$id_pelanggan   	= $this->input->post('id_pelanggan');
		$pemakaian 		= $this->input->post('pemakaian');
		$denda 			= $this->input->post('denda');
		$total 			= $this->input->post('total');
		$tunggakan 		= $this->input->post('tunggakan');
		$tagihan 			= $this->db->get_where('trx_tagihan', ['id_tagihan' => $id_tagihan])->row_array();
		if ($tagihan['status'] == 1) {
			$trx = [
				'pemakaian'		=> $pemakaian,
				'denda'			=> $denda,
				'tunggakan'		=> $tunggakan,
				'total'			=> $total,
				'status'			=> 2
			];
			// echo "<pre>";
			// print_r($trx);
			// echo "</pre>";
			// die;
			$this->db->trans_start();
			$this->db->update('trx_tagihan', $trx, ['id_tagihan' => $id_tagihan]);
			$this->db->trans_complete();
			$response = [
				'status'		=> 'OK',
				'id_tagihan'	=> $id_tagihan,
				'label'		=> 'success',
				'msg'		=> 'Pencatatan Meteran Berhasil berhasil disimpan sebagai tagihan final !'
			];
		} else {
			$response = [
				'status'		=> 'Warning',
				'id_tagihan'	=> $id_tagihan,
				'label'		=> 'warning',
				'msg'		=> 'Tagihan Sudah Final !'
			];
		}

		return $response;
	}

	// Pembayaran Tagihan
	public function bayar()
	{

		$id_transaksi    	= $this->input->post('id_transaksi');
		$id_tagihan    	= $this->input->post('id_tagihan');
		$id_pelanggan   	= $this->input->post('id_pelanggan');
		$bayar 			= intval(preg_replace("/[^0-9]/", "", $this->input->post('bayar')));
		$denda 			= intval(preg_replace("/[^0-9]/", "", $this->input->post('denda')));
		$total_tagihan 	= intval(preg_replace("/[^0-9]/", "", $this->input->post('total')));

		$transaksi		= $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi])->row_array();
		$tagihan 			= $this->db->get_where('trx_tagihan', ['id_tagihan' => $id_tagihan])->row_array();

		$iuran_wajib		= $tagihan['biaya_admin'] + $tagihan['biaya_beban'];
		$pemakaian 		= $tagihan['pemakaian'];
		$tgg				= $tagihan['tunggakan'];

		if ($tagihan['status'] < 3) {
			if ($bayar > 0) {
				if ($bayar >= $iuran_wajib) {
					$wajib = $iuran_wajib; // pembayaran iuran wajib
					$sisa_1 = $bayar - $wajib;
					if ($denda > 0) {
						//ada denda
						if ($sisa_1 >= $denda) {
							$bayar_denda 		= $denda; //pembayaran  denda
						} else {
							$bayar_denda 		= $sisa_1; //pembayaran  denda
							$bayar_tunggakan 	= 0; //pembayaran tunggakan
						}
					} else {
						//tidak ada denda
						$bayar_denda = 0;
					}
					$sisa_2 			= $sisa_1 - $bayar_denda;
					if ($tgg > 0) {
						//ada tunggakan
						if ($sisa_2 >= $tgg) {
							$bayar_tunggakan = $tgg; //pembayaran tunggakan
						} else {
							$bayar_tunggakan = $sisa_2; //pembayaran tunggakan
						}
					} else {
						//tidak ada tunggakan
						$bayar_tunggakan = 0;
					}
					$sisa_3 = $sisa_2 - $bayar_tunggakan;
					if ($pemakaian > 0) {
						// biaya pemakaian ada 
						if ($sisa_3 >= $pemakaian) {
							$bayar_pemakaian = $pemakaian; //pembayaran biaya pemakaian
						} else {
							$bayar_pemakaian = $sisa_3;
						}
					} else {
						// biaya pemakaian tidak ada
						$bayar_pemakaian = 0;
					}
				} elseif ($bayar < $iuran_wajib) {
					$wajib 			= $bayar; // pembayaran iuran wajib
					$bayar_denda 		= 0; //pembayaran  denda
					$bayar_tunggakan 	= 0; //pembayaran tunggakan
					$bayar_pemakaian	= 0; //pembayaran pemakaian air
				}
			} else {
				$wajib 			= 0; // bayar iuran wajib
				$bayar_denda 		= 0; //bayar denda
				$bayar_tunggakan 	= 0; //bayar tunggakan
				$bayar_pemakaian	= 0; //pembayaran pemakaian air
			}
			$tunggakan = $total_tagihan - $wajib - $bayar_denda - $bayar_tunggakan - $bayar_pemakaian; // tunggakan bulan selanjutnya 

			$pembayaran = [
				'id_tagihan'		=> $id_tagihan,
				'wajib'			=> $wajib,
				'denda'			=> $bayar_denda,
				'tunggakan'		=> $bayar_tunggakan,
				'pemakaian'		=> $bayar_pemakaian
			];

			$trx_global = [
				'total'			=> $transaksi['total']  + $bayar,
				'pemakaian'		=> $transaksi['pemakaian'] + $bayar_pemakaian,
				'iuran_wajib'		=> $transaksi['iuran_wajib'] + $wajib,
				'denda'			=> $transaksi['denda'] + $bayar_denda,
				'tunggakan'		=> $transaksi['tunggakan'] + $bayar_tunggakan
			];

			$pelanggan = [
				'tunggakan'		=> $tunggakan
			];
			$trx_tagihan = [
				'bayar'		=> $bayar,
				'status'		=> 3
			];
			// var_dump($id_transaksi);
			// die;
			// echo "<pre>";
			// print_r($pembayaran);
			// print_r($pelanggan);
			// print_r($trx_global);
			// print_r($trx_tagihan);
			// echo "</pre>";
			// die;
			$this->db->trans_start();
			$this->db->update('m_pelanggan', $pelanggan, ['id_pelanggan' => $id_pelanggan]);
			$this->db->update('transaksi', $trx_global, ['id_transaksi' => $id_transaksi]);
			$this->db->update('trx_tagihan', $trx_tagihan, ['id_tagihan' => $id_tagihan]);
			$this->db->insert('trx_pembayaran_tagihan', $pembayaran);
			$this->db->trans_complete();

			$response = [
				'status'		=> 'OK',
				'id_tagihan'	=> $id_tagihan,
				'label'		=> 'success',
				'msg'		=> 'Pembayaran Tagihan Berhasil Disimpan !'
			];
		} else {
			$response = [
				'status'		=> 'Warning',
				'id_tagihan'	=> $id_tagihan,
				'label'		=> 'warning',
				'msg'		=> 'Pembayaran untuk Tagihan ini telah dilakukan sebelumnya !'
			];
		}

		return $response;
	}
	public function tutup($id_transaksi)
	{
		$transaksi		= $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi])->row_array();
		$iuran_wajib		= $transaksi['iuran_wajib'];
		$pemakaian 		= $transaksi['pemakaian'];
		$denda 			= $transaksi['denda'];
		$tunggakan		= $transaksi['tunggakan'];
		$total 			= $transaksi['total'];
		$tanggal 			= $transaksi['tanggal'];
		if ($transaksi['status'] == 0) {
			$trx = [
				'status'		=> 1
			];
			$gl_kas = [
				'tanggal'			=> $tanggal,
				'id_transaksi'		=> $id_transaksi,
				'account_no'		=> '1-10001',
				'posisi'			=> 'd',
				'nominal'			=> $total
			];
			if ($iuran_wajib > 0) {
				$gl_wajib = [
					'tanggal'			=> $tanggal,
					'id_transaksi'		=> $id_transaksi,
					'account_no'		=> '4-10001',
					'posisi'			=> 'k',
					'nominal'			=> $iuran_wajib
				];
			}
			if ($pemakaian > 0) {
				$gl_pemakaian = [
					'tanggal'			=> $tanggal,
					'id_transaksi'		=> $id_transaksi,
					'account_no'		=> '4-10002',
					'posisi'			=> 'k',
					'nominal'			=> $pemakaian
				];
			}
			if ($denda > 0) {
				$gl_denda = [
					'tanggal'			=> $tanggal,
					'id_transaksi'		=> $id_transaksi,
					'account_no'		=> '4-10003',
					'posisi'			=> 'k',
					'nominal'			=> $denda
				];
			}
			if ($tunggakan > 0) {
				$gl_tunggakan = [
					'tanggal'			=> $tanggal,
					'id_transaksi'		=> $id_transaksi,
					'account_no'		=> '4-10004',
					'posisi'			=> 'k',
					'nominal'			=> $tunggakan
				];
			}

			$this->db->trans_start();
			$this->db->update('transaksi', $trx, ['id_transaksi' => $id_transaksi]);
			$this->db->insert('jurnal_umum', $gl_kas);
			if ($gl_wajib) {
				$this->db->insert('jurnal_umum', $gl_wajib);
			}
			if ($gl_pemakaian) {
				$this->db->insert('jurnal_umum', $gl_pemakaian);
			}
			if ($gl_denda) {
				$this->db->insert('jurnal_umum', $gl_denda);
			}
			if ($gl_tunggakan) {
				$this->db->insert('jurnal_umum', $gl_tunggakan);
			}
			$this->db->trans_complete();

			$response = [
				'status'		=> 'OK',
				'label'		=> 'success',
				'msg'		=> 'Pencatatan Berhasil di tutup !'
			];
		} else {
			$response = [
				'status'		=> 'Warning',
				'label'		=> 'warning',
				'msg'		=> 'Permintaan tidak dapat di proses !'
			];
		}
		return $response;
	}
}

/* End of file M_pencatatan_meteran.php */

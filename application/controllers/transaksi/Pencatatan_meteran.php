<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pencatatan_meteran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi/M_pencatatan_meteran', 'model');
		is_log();
	}


	public function index()
	{
		$periode = $this->input->get('periode');
		if ($periode === null) {
			$m = date('m');
			$y = date('Y');
		} else {
			$m = date('m', strtotime($periode));
			$y = date('Y', strtotime($periode));
		}
		$data = [
			'title'		=> 'Pencatatan Meteran',
			'userdata'	=> $this->M_user->get_user(),
			'trx'		=> $this->model->select_transaksi($y, $m),
			'list'		=> $this->model->all($y, $m),
			'progress'	=> $this->model->progress($y, $m),
			'year'		=> $y,
			'month'		=> $m,
			'menu'		=> $this->menu()
		];
		$this->load->view('transaksi/pencatatan_meteran/pencatatan_meteran', $data);
	}
	public function create($id_tagihan)
	{
		$cek = $this->model->tagihan($id_tagihan);
		if ($cek['jenis_tarif'] == 1) {
			$data = [
				'title'		=> 'Buat Pencatatan Meteran Tarif Progresif',
				'userdata'	=> $this->M_user->get_user(),
				'ref'		=> $this->model->get_tagihan($id_tagihan),
				'id_tagihan'	=> $id_tagihan,
				'menu'		=> $this->menu()

			];
			$this->load->view('transaksi/pencatatan_meteran/pencatatan_create', $data);
		} else {
			$data = [
				'title'		=> 'Buat Pencatatan Meteran Tarif Tunggal',
				'userdata'	=> $this->M_user->get_user(),
				'ref'		=> $this->model->get_tagihan($id_tagihan),
				'id_tagihan'	=> $id_tagihan,
				'menu'		=> $this->menu()

			];
			$this->load->view('transaksi/pencatatan_meteran/pencatatan_create_tunggal', $data);
		}
	}
	public function store()
	{
		$request = $this->model->store();
		$this->session->set_flashdata($request['label'], $request['msg']);

		redirect('transaksi/pencatatan_tagihan/show/' . $request['id_tagihan']);
	}
	public function update()
	{
		$request = $this->model->update();
		$this->session->set_flashdata($request['label'], $request['msg']);

		redirect('transaksi/pencatatan_tagihan/show/' . $request['id_tagihan']);
	}
	public function final()
	{
		$request = $this->model->final();
		$this->session->set_flashdata($request['label'], $request['msg']);

		redirect('transaksi/pencatatan_tagihan/show/' . $request['id_tagihan']);
	}
	public function bayar()
	{
		$request = $this->model->bayar();
		$this->session->set_flashdata($request['label'], $request['msg']);

		redirect('transaksi/pencatatan_tagihan/show/' . $request['id_tagihan']);
	}

	public function tutup($id_transaksi)
	{
		$request = $this->model->tutup($id_transaksi);
		$this->session->set_flashdata($request['label'], $request['msg']);

		redirect('transaksi/pencatatan_tagihan');
	}
}

/* End of file Pencatatan_meteran.php */

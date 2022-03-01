<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/
$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| CUSTOME ERROR ROUTING
| -------------------------------------------------------------------------
*/
$route['error403']									= 'error_custome/Forbidden';
$route['construction']								= 'error_custome/Under_construction';

/*
| -------------------------------------------------------------------------
| MAIN ROUTING
| -------------------------------------------------------------------------
*/
$route['login']									= 'Auth';
$route['login/validate']								= 'Auth/verify';
$route['logout']									= 'Auth/destroy';
$route['dashboard']									= 'Dashboard';

/*
| -------------------------------------------------------------------------
| DATA MASTER GOLONGAN TARIF
| -------------------------------------------------------------------------
*/
$route['master/golongan']							= 'master/Golongan';
$route['master/golongan/create']						= 'master/Golongan/create';
$route['master/golongan/store']						= 'master/Golongan/store';
$route['master/golongan/add_item']						= 'master/Golongan/store_item';
$route['master/golongan/detail/(:any)']					= 'master/Golongan/show/$1';
$route['master/golongan/edit/(:any)']					= 'master/Golongan/edit/$1';
$route['master/golongan/update']						= 'master/Golongan/update';
$route['master/golongan/delete_item/(:any)/(:any)']		= 'master/Golongan/delete_item/$1/$2';

/*
| -------------------------------------------------------------------------
| DATA MASTER PELANGGAN
| -------------------------------------------------------------------------
*/
$route['master/pelanggan']							= 'master/Pelanggan';
$route['master/pelanggan/create']						= 'master/Pelanggan/create';
$route['master/pelanggan/store']						= 'master/Pelanggan/store';
$route['master/pelanggan/edit/(:any)']					= 'master/Pelanggan/edit/$1';

/*
| -------------------------------------------------------------------------
| DATA MASTER CHART OF ACCOUNT
| -------------------------------------------------------------------------
*/
$route['master/coa']								= 'master/Coa';
$route['master/coa/create']							= 'master/Coa/create';
$route['master/coa/store']							= 'master/Coa/store';
$route['master/coa/edit/(:any)']						= 'master/Coa/edit/$1';
$route['master/coa/update']							= 'master/Coa/update';

/*
| -------------------------------------------------------------------------
| DATA MASTER SUMBER PEMASUKAN
| -------------------------------------------------------------------------
*/
$route['master/sumber_pemasukan']						= 'master/Sumber_pemasukan';
$route['master/sumber_pemasukan/store']					= 'master/Sumber_pemasukan/store';
$route['master/sumber_pemasukan/update']				= 'master/Sumber_pemasukan/update';

/*
| -------------------------------------------------------------------------
| DATA MASTER SUMBER PENGELUARAN
| -------------------------------------------------------------------------
*/
$route['master/sumber_pemngeluaran']					= 'master/Sumber_pengeluaran';
$route['master/sumber_pemngeluaran/store']				= 'master/Sumber_pengeluaran/store';
$route['master/sumber_pemngeluaran/update']				= 'master/Sumber_pengeluaran/update';

/*
| -------------------------------------------------------------------------
| DATA MASTER ASET
| -------------------------------------------------------------------------
*/
$route['master/aset']								= 'master/Aset';
$route['master/aset/create']							= 'master/Aset/create';
$route['master/aset/store']							= 'master/Aset/store';
$route['master/aset/edit/(:any)']						= 'master/Aset/edit/$1';
$route['master/aset/update']							= 'master/Aset/update';

/*
| -------------------------------------------------------------------------
| DATA MASTER PENGURUS
| -------------------------------------------------------------------------
*/
$route['master/pengurus']							= 'master/Pengurus';
$route['master/pengurus/store']						= 'master/Pengurus/store';
$route['master/pengurus/update']						= 'master/Pengurus/update';
$route['master/pengurus/active/(:any)/(:any)']			= 'master/Pengurus/active/$1/$2';

/*
| -------------------------------------------------------------------------
| DATA MASTER WILAYAH
| -------------------------------------------------------------------------
*/
$route['master/wilayah']								= 'master/Wilayah';
$route['master/wilayah/store']						= 'master/Wilayah/store';
$route['master/wilayah/update']						= 'master/Wilayah/update';


/*
| -------------------------------------------------------------------------
| TRANSAKSI PERIODE TAGIHAN
| -------------------------------------------------------------------------
*/
$route['transaksi/periode_tagihan']					= 'transaksi/Periode_tagihan';
$route['transaksi/periode_tagihan/store']				= 'transaksi/Periode_tagihan/store';
$route['transaksi/periode_tagihan/show/(:any)']			= 'transaksi/Periode_tagihan/show/$1';

/*
| -------------------------------------------------------------------------
| TRANSAKSI PENCATATAN TAGIHAN
| -------------------------------------------------------------------------
*/
$route['transaksi/pencatatan_tagihan']					= 'transaksi/Pencatatan_meteran';
$route['transaksi/pencatatan_tagihan/show/(:any)']		= 'transaksi/Pencatatan_meteran/create/$1';
$route['transaksi/pencatatan_tagihan/store']				= 'transaksi/Pencatatan_meteran/store';
$route['transaksi/pencatatan_tagihan/update']			= 'transaksi/Pencatatan_meteran/update';
$route['transaksi/pencatatan_tagihan/final']				= 'transaksi/Pencatatan_meteran/final';
$route['transaksi/pencatatan_tagihan/bayar']				= 'transaksi/Pencatatan_meteran/bayar';
$route['transaksi/pencatatan_tagihan/tutup/(:any)']		= 'transaksi/Pencatatan_meteran/tutup/$1';

/*
| -------------------------------------------------------------------------
| TRANSAKSI KAS MASUK
| -------------------------------------------------------------------------
*/
$route['keuangan/kas_masuk']							= 'transaksi/Kas_masuk';
$route['keuangan/kas_masuk/store']						= 'transaksi/Kas_masuk/store';
$route['keuangan/kas_masuk/update']					= 'transaksi/Kas_masuk/update';

/*
| -------------------------------------------------------------------------
| TRANSAKSI KAS KELUAR
| -------------------------------------------------------------------------
*/
$route['keuangan/kas_keluar']							= 'transaksi/Kas_keluar';
$route['keuangan/kas_keluar/store']					= 'transaksi/Kas_keluar/store';
$route['keuangan/kas_keluar/update']					= 'transaksi/Kas_keluar/update';



/*
| -------------------------------------------------------------------------
| AKUNTANSI JURNAL UMUM
| -------------------------------------------------------------------------
*/
$route['akuntansi/jurnal_umum']						= 'laporan/Jurnal_umum';
$route['akuntansi/jurnal_umum/export_excel/(:any)/(:any)']	= 'laporan/Jurnal_umum/excel/$1/$2';

/*
| -------------------------------------------------------------------------
| AKUNTANSI BUKU BESAR
| -------------------------------------------------------------------------
*/
$route['akuntansi/buku_besar']							= 'laporan/Buku_besar';
$route['akuntansi/buku_besar/export_excel/(:any)/(:any)/(:any)']	= 'laporan/Buku_besar/excel/$1/$2/$3';

/*
| -------------------------------------------------------------------------
| AKUNTANSI TRIAL BALANCE
| -------------------------------------------------------------------------
*/
$route['akuntansi/trial_balance']							= 'laporan/Trial_balance';
$route['akuntansi/trial_balance/export_excel/(:any)/(:any)']	= 'laporan/Trial_balance/excel/$1/$2';

/*
| -------------------------------------------------------------------------
| AKUNTANSI LABA RUGI
| -------------------------------------------------------------------------
*/
$route['akuntansi/laba_rugi']								= 'laporan/Laba_rugi';
$route['akuntansi/laba_rugi/export_excel/(:any)/(:any)']		= 'laporan/Laba_rugi/excel/$1/$2';

/*
| -------------------------------------------------------------------------
| AKUNTANSI ARUS KAS
| -------------------------------------------------------------------------
*/
$route['akuntansi/arus_kas']								= 'laporan/Arus_kas';
$route['akuntansi/arus_kas/export_excel/(:any)/(:any)']		= 'laporan/Arus_kas/excel/$1/$2';


/*
| -------------------------------------------------------------------------
| BUKU PEMBANTU -BUKU IURAN
| -------------------------------------------------------------------------
*/
$route['laporan/buku_iuran']							= 'laporan/Buku_iuran';
$route['laporan/buku_iuran/export_excel/(:any)/(:any)']	= 'laporan/Buku_iuran/excel/$1/$2';

/*
| -------------------------------------------------------------------------
| BUKU PEMBANTU -BUKU PENERIMAAN
| -------------------------------------------------------------------------
*/
$route['laporan/penerimaan']							= 'laporan/Buku_penerimaan';
$route['laporan/penerimaan/export_excel/(:any)/(:any)']	= 'laporan/Buku_penerimaan/excel/$1/$2';

/*
| -------------------------------------------------------------------------
| BUKU PEMBANTU -BUKU PENGELUARAN
| -------------------------------------------------------------------------
*/
$route['laporan/pengeluaran']							= 'laporan/Buku_pengeluaran';
$route['laporan/pengeluaran/export_excel/(:any)/(:any)']	= 'laporan/Buku_pengeluaran/excel/$1/$2';

/*
| -------------------------------------------------------------------------
| BUKU PEMBANTU -BUKU BANK
| -------------------------------------------------------------------------
*/
$route['laporan/bank']							= 'laporan/Buku_bank';
$route['laporan/bank/export_excel/(:any)/(:any)']		= 'laporan/Buku_bank/excel/$1/$2';

/*
| -------------------------------------------------------------------------
| BUKU PEMBANTU -BUKU KAS HARIAN
| -------------------------------------------------------------------------
*/
$route['laporan/kas']							= 'laporan/Buku_kas';
$route['laporan/kas/export_excel/(:any)/(:any)']		= 'laporan/Buku_kas/excel/$1/$2';

/*
| -------------------------------------------------------------------------
| SETTING KP-SPAMS
| -------------------------------------------------------------------------
*/
$route['setting/company_profile']						= 'setting/Kp_spams';
$route['setting/company_profile/update']				= 'setting/Kp_spams/update';

/*
| -------------------------------------------------------------------------
| SETTING KP-SPAMS
| -------------------------------------------------------------------------
*/
$route['setting/tagihan']							= 'setting/Invoice';
$route['setting/tagihan/update']						= 'setting/Invoice/update';

/*
| -------------------------------------------------------------------------
| SETTING PENGGUNA
| -------------------------------------------------------------------------
*/
$route['setting/pengguna']							= 'setting/Pengguna';
$route['setting/pengguna/store']						= 'setting/Pengguna/store';
$route['setting/pengguna/update']						= 'setting/Pengguna/update';

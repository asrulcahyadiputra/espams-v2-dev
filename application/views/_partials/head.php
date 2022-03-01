<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?= $title ?> | E-SPAMS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico">
	<!-- third party css -->
	<link href="<?= base_url() ?>assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
	<!-- third party css end -->

	<!-- dropify -->
	<link href="<?= base_url() ?>assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
	<?php if ($this->uri->segment(2) == 'pencatatan_meteran' || $this->uri->segment(2) == 'periode_tagihan') : ?>
		<!-- Responsive Table css -->
		<link href="<?= site_url() ?>assets/libs/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
	<?php endif ?>
	<!-- Plugins css -->
	<link href="<?= base_url() ?>assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />

	<link href="<?= base_url() ?>assets/libs/multiselect/multi-select.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/libs/switchery/switchery.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<!-- Bootstrap Css -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="<?= base_url() ?>assets/css/app.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
	<!-- Custom box css -->
	<link href="<?= base_url() ?>assets/libs/custombox/custombox.min.css" rel="stylesheet">
</head>

<body>
	<?php $this->load->view('_partials/navbar'); ?>
	<?php $this->load->view('_partials/sidebar'); ?>

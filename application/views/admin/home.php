<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Dashboard | Admin</title>

	<!-- Main Styles -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/style.min.css">
	
	<!-- Material Design Icon -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-design/css/materialdesignicons.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/waves/waves.min.css">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/sweet-alert/sweetalert.css">
	
	<!-- Morris Chart -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/chart/morris/morris.css">

	<!-- FullCalendar -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/fullcalendar/fullcalendar.print.css" media='print'>

	<!-- Dark Themes -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/style-dark.min.css">
</head>

<body>
<div class="main-menu">
	<header class="header">
		<a href="" class="logo"><i class="ico mdi mdi-cube-outline"></i>Aplikasi E-Kedai</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<!------- IF untuk avatar foto -------->
                <?php
                    $iu = $this->session->userdata('id_user');
                    $avatar = $this->db->query("select foto from tb_user where id_user=$iu");
                     foreach ($avatar->result_array() as $r) {
                      if ($r['foto'] == '') {
                       echo "<a href='#' class='avatar'><img src='" . base_url() . "assets/file_user/user-b.png' class='img-radius' alt='User-Profile-Image'><span class='status online'></span></a>";
                      } else {
                        echo "<a href='#' class='avatar'><img src='" . base_url() . "assets/file_user/thumb/$r[foto]' class='img-radius' alt='User-Profile-Image'><span class='status online'></span></a>";
                      }
                    }
                 ?>

			<h5 class="name"><a href="#"><?php echo $this->session->userdata('nama_lengkap'); ?></a></h5>
			<h5 class="position"><?php echo $this->session->userdata('level'); ?></h5>
			<!-- /.name -->
			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
					<div class="control-item"><a href="<?php echo site_url('admin/profil');?>"><i class="fa fa-user"></i> Profile</a></div>
					<div class="control-item"><a href="<?php echo base_url(); ?>admin/pengguna/edit/<?php echo $this->session->userdata('id_user'); ?>"><i class="fa fa-gear"></i> Settings</a></div>
					<div class="control-item"><a href="<?php echo site_url('app/logout');?>"><i class="fa fa-sign-out"></i> Log out</a></div>
				</div>
				<!-- /.control-list -->
			</div>
			<!-- /.control-wrap -->
		</div>
		<!-- /.user -->
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
			<h5 class="title">Navigation</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li class="current">
					<a class="waves-effect" href="<?php echo base_url();?>admin/dashboard"><i class="menu-icon mdi mdi-view-dashboard"></i><span>Dashboard</span></a>
				</li>
				<li>
					<a class="waves-effect parent-item js__control"><i class="menu-icon mdi mdi-cube-outline"></i><span>Master Data</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="<?php echo site_url('admin/pengguna');?>">Pengguna</a></li>
						<li><a href="<?php echo site_url('admin/barang');?>">Barang</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				<li>
					<a class="waves-effect" href="<?php echo site_url('app/logout');?>"><i class="menu-icon mdi mdi-exit-to-app"></i><span>Logout</span></a>
				</li>
			</ul>
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>
<!-- /.main-menu -->

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title">Home</h1>
		<!-- /.page-title -->
	</div>
</div>
<!-- /.fixed-navbar -->
<?php
    $query=$this->db->query("SELECT count(barang) AS jumlah FROM tb_barang");
    $data = $query->row();      
    $jumlahB = $data->jumlah;  
?>
<?php
    $query=$this->db->query("SELECT count(id_user) AS user FROM tb_user");
    $data = $query->row();      
    $jUser = $data->user;  
?>

<!-- /#message-popup -->
<div id="wrapper">
	<div class="main-content">

		<div class="row small-spacing">
			<div class="col-lg-6 col-md-12 col-xs-12">
				<div class="box-content bg-success text-white">
					<a style="color:white;" href="<?php echo site_url('admin/barang');?>">
					<div class="statistics-box with-icon">
						<i class="ico small fa fa-shopping-basket"></i>
						<p class="text text-white">Data Barang</p>
						<h2 class="counter"><?php echo $jumlahB;?></h2>
					</div>
					</a>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-3 col-md-6 col-xs-12 -->
			<div class="col-lg-6 col-md-12 col-xs-12">
				<div class="box-content bg-info text-white">
					<a style="color:white;" href="<?php echo site_url('admin/pengguna');?>">
					<div class="statistics-box with-icon">
						<i class="ico small fa fa-users"></i>
						<p class="text text-white">Data Pengguna</p>
						<h2 class="counter"><?php echo $jUser;?></h2>
					</div>
				</a>
				</div>
				<!-- /.box-content -->
			</div>

		</div>
		<!-- .row -->

		<div class="row small-spacing">
			<div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">HARGA BARANG</h4>

					<!-- /.dropdown js__dropdown -->
					<div class="table-responsive table-purchases">
						<table class="table table-striped margin-bottom-10">
							<thead>
								<tr>
									<th style="width:8%;">No</th>
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>Satuan</th>
								</tr>
							</thead>
							<tbody>
								<?php
									 $no = 1;
                                     foreach ($barang->result_array() as $dp) {
                                      ?>
								<tr>
									<td><?php echo $no; ?></td>
									<td><?php echo $dp['barang']; ?></td>
									<td class="text-danger" ><?php echo $dp['harga']; ?></td>
									<td class="text-success"><?php echo $dp['satuan']; ?></td>
								</tr>
								<?php
                                 	$no++;
                                    }
                                  ?>
							</tbody>
						</table>
						<!-- /.table -->
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-6 col-xs-12 -->
		</div>
		<!-- /.row -->		
		<footer class="footer">
			<ul class="list-inline">
				<li>Created by Ade Saputra © 2020</li>
			</ul>
		</footer>
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo base_url(); ?>assets/scripts/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/scripts/modernizr.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/nprogress/nprogress.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/sweet-alert/sweetalert.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/waves/waves.min.js"></script>

	<!-- Morris Chart -->
	<script src="<?php echo base_url(); ?>assets/plugin/chart/morris/morris.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/chart/morris/raphael-min.js"></script>
	<script src="<?php echo base_url(); ?>assets/scripts/chart.morris.init.min.js"></script>

	<!-- Flot Chart -->
	<script src="<?php echo base_url(); ?>assets/plugin/chart/plot/jquery.flot.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/chart/plot/jquery.flot.tooltip.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/chart/plot/jquery.flot.categories.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/chart/plot/jquery.flot.pie.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/chart/plot/jquery.flot.stack.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/scripts/chart.flot.init.min.js"></script>

	<!-- Sparkline Chart -->
	<script src="<?php echo base_url(); ?>assets/plugin/chart/sparkline/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/scripts/chart.sparkline.init.min.js"></script>

	<!-- FullCalendar -->
	<script src="<?php echo base_url(); ?>assets/plugin/moment/moment.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/fullcalendar/fullcalendar.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/scripts/fullcalendar.init.js"></script>

	<script src="<?php echo base_url(); ?>assets/scripts/main.min.js"></script>
</body>
</html>
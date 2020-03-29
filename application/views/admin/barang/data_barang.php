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
	<!-- Favicon icon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/ekedai.png" type="image/x-icon">
	
	<!-- Material Design Icon -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/material-design/css/materialdesignicons.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/waves/waves.min.css">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/sweet-alert/sweetalert.css">

	<!-- Data Tables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datatables/media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css">

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
		<h1 class="page-title">Data Barang</h1>
		<!-- /.page-title -->
	</div>
</div>
<!-- /.fixed-navbar -->


<!-- /#message-popup -->
<div id="wrapper">
	<div class="main-content">

		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">

					<!------ Message berhasil atau tidak ---------->
                      <?php echo $this->session->userdata('message'); ?>
                        <br>

                         <a href="<?php echo base_url(); ?>admin/barang/tambah">
                            <button type="button" class="btn-sm btn-primary m-b-20 m-l-15">+ Tambah Data</button>
                          </a>

					<div class="table-responsive" data-pattern="priority-columns">
					<br>
					<table id="example" class="table table-striped table-bordered display" style="width:100%;">
						<thead>
							<tr>
                            	<th style="width:8px;">No</th>
                            	<th>Nama Barang</th>
                            	<th>Harga</th>
                            	<th>Satuan</th>
                            	<th style="width:20%;">Pilihan</th>
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
								<td style="color:green;"><?php echo rupiah($dp['harga']); ?></td>
								<td align="center"><?php echo $dp['satuan']; ?></td>
								<td align="center">
                                    <a href="<?php echo base_url(); ?>admin/barang/edit/<?php echo $dp['id']; ?>"><button class="btn-sm btn-success"><i class="ace-icon fa fa-pencil-square-o "></i></button>
                                    </a>
                                    <a href="<?php echo base_url(); ?>admin/barang/hapus/<?php echo $dp['id']; ?>" onClick="return confirm('Anda yakin..???');" title="Hapus"><button class="btn-sm btn-danger"><i class="ace-icon fa fa-trash"></i></button>
                                    </a>
                                </td>
							</tr>

							<?php
                                $no++;
                                }
                             ?>
						</tbody>
					</table>
				</div>
			</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-xs-12 -->
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

	<!-- Data Tables -->
	<script src="<?php echo base_url(); ?>assets/plugin/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datatables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/scripts/datatables.demo.min.js"></script>

	<script src="<?php echo base_url(); ?>assets/scripts/main.min.js"></script>
</body>
</html>
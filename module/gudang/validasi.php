<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 16;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
$resetDataView = $DBVAR->is_table_exists('filter_distribusi_barang_'.$SessionUser['ses_uoperatorid'], 0);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>

 
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Validasi Distribusi Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Validasi Distribusi Barang</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form name="myform" method="post" action="gudang_validasi_daftar.php">
				<ul>
					<li>
						<span class="span2">Tanggal Distribusi</span>
						<input id="datepicker" type="text" name="tglDistribusi"value="" style="width:205px;">
					</li>
					<li>
						<span class="span2">Nomor Dokumen</span>
						<input type="text" name="noDokumen" value="" style="width:205px;">
					</li>
					<?=selectAllSatker('toSatker','205',true,false);?>
				</ul>
				<ul>
					<li>
						<span class="span2">&nbsp;</span>
						<input type="submit" class="btn btn-primary" value="Tampilkan Data" />
						<input type="reset" name="reset" class="btn" value="Bersihkan Data">
					</li>
				</ul>
			</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>
<?php
include "../../config/config.php";
$menu_id = 2;
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Buat Rencana Kebutuhan Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Buat Rencana Kebutuhan Barang</div>
			<div class="subtitle">Import Data</div>
		</div><section class="formLegend">
			
			<div class="detailright">
				<a href="<?php echo"$url_rewrite/module/perencanaan/rkb_daftar_data.php";?>" class="btn">
					Kembali ke Halaman Sebelumnya</a>
							
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			<fieldset>
				<?php include "$path/function/import/module/rkb/index.php"; ?>	
			</fieldset>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>
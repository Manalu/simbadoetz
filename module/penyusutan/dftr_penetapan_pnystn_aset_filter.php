<?php
include "../../config/config.php";
		
$menu_id = 64;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;

$id_usulanPenetapan = $_POST['id_usulanPenetapan'];
$implodeUsulan = implode(',',$id_usulanPenetapan);
$Penyusutan_ID = $_POST['Penyusutan_ID'];
$Satker_ID = $_POST['Satker_ID'];
$deleteapluserlist=$PENYUSUTAN->apl_userasetlistHPS_del("PNTPNUSULASET");

//update Penetapan_ID dan StatusPenetapan di tabel usulan
$Update_Penetapan_ID_StatusPenetapan=$PENYUSUTAN->Update_Penetapan_ID_StatusPenetapan($id_usulanPenetapan,$Penyusutan_ID);

//update Usulan_ID di tabel penyusutan
$Update_Usulan_ID=$PENYUSUTAN->Update_Usulan_ID($implodeUsulan,$Penyusutan_ID);

// select ket Penetapan penyusutan
$FlagPenetapan=$PENYUSUTAN->getPenetapanKet($Penyusutan_ID,$Satker_ID);

$par_data_table = "id_usulanPenetapan={$implodeUsulan}&Penyusutan_ID={$Penyusutan_ID}&Satker_ID={$Satker_ID}";
// echo $par_data_table;
// exit;
?>
<script>
	jQuery(function($) {
		AreAnyCheckboxesChecked();
	});
		
	function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('PNTPNUSULASETFIX');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('PNTPNUSULASETFIX');
			}}, 100);
		}
	
	</script>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Penyusutan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Penyusutan</div>
				<div class="subtitle">Filter Aset Data </div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penyusutan/dftr_usulan_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penyusutan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penyusutan/dftr_penetapan_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penyusutan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penyusutan/validasi_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penyusutan</span>
				</a>
			</div>		

		<section class="formLegend">
			<form id="Form2" name="myform" method="POST" action ="<?=$url_rewrite?>/module/penyusutan/proses_penetapan_pynstn_aset.php">
			<div class="detailLeft" style="width:100%">
			<ul>
				<li>
					<span class="labelInfo">No Penetapan</span>
					<input type="text" name = "NoSKPenyusutan" value="<?=$FlagPenetapan['NoSKPenyusutan']?>" disabled/>
				</li>
				<li>
					<span class="labelInfo">Tgl Penetapan</span>
					<?php
						$Tgl=$FlagPenetapan['TglPenyusutan']; 
						$FixTgl=  format_tanggal_db3($Tgl); 
					?>
					<input type="text" name = "TglPenyusutan"  value="<?=$FixTgl?>" disabled/>
				</li>
				<li>
					<span class="labelInfo">Keterangan</span>
					<input type="text" name="AlasanPenyusutan" style="width:350px" id="" value="<?=$FlagPenetapan['AlasanPenyusutan']?>" disabled/> 
				</li>
				<li>
					<span class="labelInfo">Satker</span>
					<input type="text" name="SatkerUsul" style="width:350px" value="<?=$FlagPenetapan['NamaSatker']?>" disabled/>
				</li>
				<li>
					<input type="submit" class="btn btn-info btn-small" id= "submit" value="Pilih Usulan" name="submit"  onclick="return check_pilihan(); disabled"/>
					<input type="hidden" name="Satker_ID" value="<?=$Satker_ID?>">
					<input type="hidden" name="Penyusutan_ID" value="<?=$Penyusutan_ID?>">
				</li>
			</ul>
		</div>
			<script>
    $(document).ready(function() {
          $('#iman').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
						 {"bSortable": false},
						 {"bSortable": false,"sClass": "checkbox-column" },
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": false},
						 {"bSortable": false}],
					"sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_penetapan_pnyst_daftar_aset.php?<?php echo $par_data_table?>"
               }
                  );
      });
    </script>
			<p>
			<!--<a href="buat_aset_usulan_pnystn.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Usulan</a>-->
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="iman">
				<thead>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>Kode / <br>Nama Barang</th>
						<th>Merk</th>
						<th>NoRegister</th>
						<th>Nilai Perolehan</th>
						<th>Tahun</th>
						<th>Keterangan</th>
						<th>Penyusutan<br>Per Tahun</th>
						<th>Akumulasi<br>Penyusutan</th>
						<th>Nilai Buku</th>
					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="11">Data Tidak di temukkan</td>
                     </tr>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			</form>    
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>
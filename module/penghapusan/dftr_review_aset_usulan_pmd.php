<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

// $get_data_filter = $RETRIEVE->retrieve_kontrak();
// ////////pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
	if($_SESSION['kdSatkerFilterPMD']){
		$kdSatkerFilter=$_SESSION['kdSatkerFilterPMD'];
	}


	$data_post=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPMD");
	
	$POST=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
	$POST['penghapusanfilter']=$POST;
	// exit;
	$data = $PENGHAPUSAN->retrieve_usulan_penghapusan_eksekusi_pmd($POST);
	////pr($data);
		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                $kontrak[] = $dataKontrak;
            }
	?>
	<!-- End Sql -->
	
	<script>
        $(function()
        {
       		 $('#tanggal1').datepicker($.datepicker.regional['id']);

        }
		);
	</script>
	
	<script>
		function confirmValidate(){	
			var ConfH = $("#countcheckboxH").html();
			var conf = confirm(ConfH);
			if(conf){return true;} else {return false;}
		}
		function countCheckbox(item,rvwitem){
			setTimeout(function() {
				$.post('<?=$url_rewrite?>/function/api/countapplist.php', { UserNm:'<?=$_SESSION['ses_uoperatorid']?>',act:item,rvwact:rvwitem,sess:'<?=$_SESSION['ses_utoken']?>'}, function(data){
						$("#countcheckbox").html("<h5>Jumlah Data FIX yang akan diusulkan <div class='blink_text_blue'>"+data.countAset+" Data Dari "+data.totalAset+" Data Aset</div><div>Total Nilai Rp."+data.totalNilaiAset+",-</div></h5>");
						$("#countcheckboxH").html("Jumlah Data FIX yang akan diusulkan "+data.countAset+" Data Dari "+data.totalAset+" Data Aset dengan Total Nilai Rp."+data.totalNilaiAset+",-");
					 },"JSON")
			}, 500);
		}
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('USPMD');
			    countCheckbox('USPMD','RVWUSPMD');
			    
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('USPMD');	
			    countCheckbox('USPMD','RVWUSPMD');
			}}, 100);
		}
		</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Aset Usulan Penghapusan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="	">
				<div class="title">Usulan Penghapusan Pemindahtanganan</div>
				<div class="subtitle">Review Aset yang akan dibuat Usulan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusan/dftr_usulan_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_penetapan_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_validasi_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			<form method="POST" ID="Form2" onsubmit="return confirmValidate()" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>daftar_usulan_penghapusan_usul_proses_pmd.php"> 
			
			<input type="hidden" name="kdSatkerFilter" value="<?=$kdSatkerFilter?>" />
						
			<div class="detailLeft">
			<ul>
				<li>
					<span  class="labelInfo">No Usulan</span>
					<input type="text" name="noUsulan" value="" required/>
				</li>
				<li>
					<span  class="labelInfo">Jenis Penghapusan</span>
					<select  name="jenis_hapus" class="span2" id="NamaJabatan" required="">
		            <option value="" >Pilih Jenis Penghapusan</option>
		            <option value="jual beli">Jual Beli</option>
		            <option value="dihibahkan">Di Hibahkan</option>
		            <option value="dilelang" >Di Lelang</option>
		            <option value="tukar menukar" >Tukar Menukar</option>
		          </select>
				</li>
				<li>
					<span class="labelInfo">Keterangan usulan</span>
					<textarea name="ketUsulan" required></textarea>
				</li>
			</ul>
							
					</div>

			<div class="detailRight">
				<ul>
					<li>
						<span  class="labelInfo">&nbsp;</span>
						&nbsp;
					</li>
					<li>
						<span  class="labelInfo">Tanggal Usulan</span>
							<div class="input-prepend">
								<span class="add-on"><i class="fa fa-calendar"></i></span>								
								<input name="tanggalUsulan" type="text" id="datepicker" <?php echo $disabledForm;?> required/>
							</div>
					</li>
					<li>
						<span  class="labelInfo">&nbsp;</span>
						&nbsp;
					</li>
					<!-- <li>
						<span  class="labelInfo">Total Nilai Usulan</span>
						<input type="text" value="" disabled/>
					</li> -->
				</ul>
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			
			<div id="demo">
			
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="penghapusan10">
				<thead>
					<tr>
						<td colspan="10" align="center">
							<span id="countcheckbox"><h5>Jumlah Data FIX yang akan diusulkan <div class="blink_text_blue">0 Data</div></h5></span>
							<span id="countcheckboxH" class="label label-success" style="display:none">Jumlah Data FIX yang akan diusulkan 0 Data</span>
						</td>
					</tr>
					<tr>
						<td colspan="10" align="Left">
								<span><button type="submit" name="submit" class="btn btn-info " id="submit" disabled/><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Usulkan Untuk Penghapusan</button></span>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_aset_usulan_pmd.php?pid=1&flegAset=0" class="btn"/>Tambahkan Aset</a>
							
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>No Register</th>
						<th>No Kontrak</th>
						<th>Kode / Uraian</th>
						<th>Merk / Type</th>
						<th>Satker</th>
						<th>Tanggal Perolehan</th>
						<th>Nilai Perolehan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>		
				<?php
				if (!empty($data))
				{
			   
					$page = @$_GET['pid'];
					if ($page > 1){
						$no = intval($page - 1 .'01');
					}else{
						$no = 1;
					}
					foreach ($data as $key => $value)
					{
					// ////////pr($get_data_filter);
					if($value[kondisi]==2){
						$kondisi="Rusak Ringan";
					}elseif($value[kondisi]==3){
						$kondisi="Rusak Berat";
					}elseif($value[kondisi]==1){
						$kondisi="Baik";
					}
					// ////////pr($value[TglPerolehan]);
					$TglPerolehanTmp=explode("-", $value[TglPerolehan]);
					// ////////pr($TglPerolehanTmp);
					$TglPerolehan=$TglPerolehanTmp[2]."/".$TglPerolehanTmp[1]."/".$TglPerolehanTmp[0];


					?>
						
					<tr class="gradeA">
						<td><?php echo $no?></td>
						<td class="checkbox-column">
						
							<input type="checkbox" class="icheck-input checkbox" onchange="return AreAnyCheckboxesChecked();" name="penghapusan_nama_aset[]" value="<?php echo $value[Aset_ID];?>" >
							
						</td>
						<td>
							<?php echo $value[noRegister]?>
						</td>
						<td>
							<?php echo $value[noKontrak]?>
						</td>
						<td>
							 [<?php echo $value[kodeKelompok]?>]<br/> 
							<?php echo $value[Uraian]?>
						</td>
						<td>
							<?php echo $value[Merk]?> <?php if ($value[Model]) echo $value[Model];?>
						</td>
						<td>
							<?php echo '['.$value[kodeSatker].'] '?><br/>
							<?php echo $value[NamaSatker];?>
						</td>
						<td>
							<?php echo $TglPerolehan;?>
						</td>
						<td>
							<?php echo number_format($value[NilaiPerolehan],4);?>
						</td>
						<td>
							<?php echo $kondisi. ' - ' .$value[AsalUsul]?>
						</td>
							
					</tr>
					
				   <?php
							$no++;
						}
					}
					else
					{
						$disabled = 'disabled';
					}
					?>
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
					</tr>
				</tfoot>
			</table>
			</div>
			</form>
			<div class="spacer"></div>
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>
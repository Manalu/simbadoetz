<?php
include "../../config/config.php";
$MUTASI = new RETRIEVE_MUTASI_KAPITALISASI;
$menu_id = 79;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

$id=$_GET['id'];
//pr($id);
$par_data_table = "id=$id";
if (isset($id)){
	unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
	$parameter = array('id'=>$id);
	$data = $MUTASI->DataUsulan($id);
	$row=$data[0];	
}
//pr($row);
//exit();
?>
	
	<script>
        $(function(){
       		 $('#tanggal1').datepicker();
       		 $("#aset").show();	
       		 $("#view").click(function(){
		        $("#aset").toggle();
		   	 });
		   	 $(document).on('change','#SatkerTujuan', function(){
    				var temp = '';
    				$("#noRegister").val(temp);
         		$("#TglPerolehan").val(temp);
         		$("#TglPembukuan").val(temp);
         		$("#kodeSatker").val(temp);
         		$("#kodeKelompokInfo").val(temp);
         		$("#NilaiPerolehan").val(temp);
         		$("#kondisi").val(temp);
         		$("#Info").val(temp);
         		$("#Merk").val(temp);
            
            load_modal_onload();
			   });
		   	 
		   	var Aset_ID = $("#Aset_ID").val();	
		   	if(Aset_ID !=''){
		   	 	$.post('<?=$url_rewrite?>/function/api/load_data.php', {id:Aset_ID}, function(data){
		   	 		console.log(data);
					var tmp=data.TglPerolehan.split("-");
               		var sign = '/';
               		var Tahun = tmp[0];
               		var Bulan = tmp[1].concat(sign);
               		var Tgl = tmp[2].concat(sign);
               		var TglPerolehan = Tgl.concat(Bulan, Tahun);
                   	var NilaiPerolehan = parseInt(data.NilaiPerolehan.indexOf(',') >= 3 ? data.NilaiPerolehan.split(',')[0] : data.NilaiPerolehan.replace(/[^0-9\.]/g, ''));
                   		NilaiPerolehan = NilaiPerolehan.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

                   	var kondisi;
                   	var tmpkondisi = data.kondisi;
               		if(tmpkondisi == 1){
               			kondisi = 'Baik'; 
               		}else if(tmpkondisi == 2){
               			kondisi = 'Rusak Ringan'; 
               		}else if(tmpkondisi == 3){
               			kondisi = 'Rusak Berat'; 
               		}

               		var tmp2=data.TglPembukuan.split("-");
               		var Tahun2 = tmp2[0];
               		var Bulan2 = tmp2[1].concat(sign);
               		var Tgl2 = tmp2[2].concat(sign);
               		var TglPembukuan = Tgl2.concat(Bulan2, Tahun2);

               		var Merk;
               		if(data.Merk){
               			Merk = data.Merk+'/'+data.NoSeri+'-'+data.NoSTNK+'/'+data.NoRangka;
               		}else{
               			Merk = '-';
               		}

                  $("#noRegister").val(data.noRegister);
	           		  $("#TglPerolehan").val(TglPerolehan);
	           		  $("#TglPembukuan").val(TglPembukuan);
	           		  $("#kodeSatker").val(data.kodeSatker);
	           		  $("#kodeKelompokInfo").val(data.kodeKelompok);
	           		  $("#NilaiPerolehan").val(NilaiPerolehan);
	           		  $("#kondisi").val(kondisi);
	           		  $("#Info").val(data.Info);
	           		  $("#Merk").val(Merk); 		
			     },"JSON");
		   	  }

       		$("#cekAll").click( function(){
     				if($(this).is(':checked')){
  					//alert("checked");
  					$("#submit").removeAttr("disabled");
  				}else{
  					$('#submit').attr('disabled','disabled');
  				}   					 
  			});
        });
        function confirmValidate(){	
    			var r = confirm("Anda Yakin Menghapus Data!");
    		    if (r == true) {
    		        return true;
    		    } else {
    		        return false;
    		    }		
		    }
		$.fn.dataTableExt.oApi.fnReloadAjax = function(oSettings, sNewSource, fnCallback, bStandingRedraw)
            {
                 // DataTables 1.10 compatibility - if 1.10 then versionCheck exists.
                 // 1.10s API has ajax reloading built in, so we use those abilities
                 // directly.
                 if ($.fn.dataTable.versionCheck) {
                      var api = new $.fn.dataTable.Api(oSettings);

                      if (sNewSource) {
                           api.ajax.url(sNewSource).load(fnCallback, !bStandingRedraw);
                      }
                      else {
                           api.ajax.reload(fnCallback, !bStandingRedraw);
                      }
                      return;
                 }

                 if (sNewSource !== undefined && sNewSource !== null) {
                      oSettings.sAjaxSource = sNewSource;
                 }

                 // Server-side processing should just call fnDraw
                 if (oSettings.oFeatures.bServerSide) {
                      this.fnDraw();
                      return;
                 }

                 this.oApi._fnProcessingDisplay(oSettings, true);
                 var that = this;
                 var iStart = oSettings._iDisplayStart;
                 var aData = [];

                 this.oApi._fnServerParams(oSettings, aData);

                 oSettings.fnServerData.call(oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
                      /* Clear the old information from the table */
                      that.oApi._fnClearTable(oSettings);

                      /* Got the data - add it to the table */
                      var aData = (oSettings.sAjaxDataProp !== "") ?
                              that.oApi._fnGetObjectDataFn(oSettings.sAjaxDataProp)(json) : json;

                      for (var i = 0; i < aData.length; i++)
                      {
                           that.oApi._fnAddData(oSettings, aData[i]);
                      }

                      oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

                      that.fnDraw();

                      if (bStandingRedraw === true)
                      {
                           oSettings._iDisplayStart = iStart;
                           that.oApi._fnCalculateEnd(oSettings);
                           that.fnDraw(false);
                      }

                      that.oApi._fnProcessingDisplay(oSettings, false);

                      /* Callback user function - for event handlers etc */
                      if (typeof fnCallback == 'function' && fnCallback !== null)
                      {
                           fnCallback(oSettings);
                      }
                 }, oSettings);
            };
            var oTable;
            $(document).on('click','#load-data',function() {
            	 var satker = $('#SatkerTujuan').val();
                 var kelompok = $('#kodeKelompok').val();
                 var data_satker=$('#data_satker').val();
                if(data_satker!="")
                {
                	oTable.fnReloadAjax("<?=$url_rewrite?>/api_list/mutasiKptls/api_aset_kapitalisasi.php?kodeSatker="+satker+"&kodeKelompok="+kelompok);
                 }else{
                 	 oTable = $('#daftar_aset').dataTable({
                          "aoColumns": [
                               {"bSortable": false},
                               {"bSortable": true},
                               {"bSortable": true},
                               {"bSortable": true},
                               {"bSortable": true},
                               {"bSortable": true},
                               {"bSortable": true}],

                          "bProcessing": true,
                          "bServerSide": true,
                          "sAjaxSource": "<?=$url_rewrite?>/api_list/mutasiKptls/api_aset_kapitalisasi.php?kodeSatker="+satker+"&kodeKelompok="+kelompok

                     });
                     $('#data_satker').val(satker);
                  }
                $("#aset").show();
                   
			});
			function load_modal_onload(){
				var satker = $('#SatkerTujuan').val();
                var kelompok = $('#kodeKelompok').val();
                var data_satker=$('#data_satker').val();
                if(data_satker!="")
                {
                	oTable.fnReloadAjax("<?=$url_rewrite?>/api_list/mutasiKptls/api_aset_kapitalisasi.php?kodeSatker="+satker+"&kodeKelompok="+kelompok);
                 }else{
                 	 oTable = $('#daftar_aset').dataTable({
                          "aoColumns": [
                               {"bSortable": false},
                               {"bSortable": true},
                               {"bSortable": true},
                               {"bSortable": true},
                               {"bSortable": true},
                               {"bSortable": false},
                               {"bSortable": true},
                               {"bSortable": true}],

                          "bProcessing": true,
                          "bServerSide": true,
                          "sAjaxSource": "<?=$url_rewrite?>/api_list/mutasiKptls/api_aset_kapitalisasi.php?kodeSatker="+satker+"&kodeKelompok="+kelompok

                     });
                     $('#data_satker').val(satker);
                  }
                $("#myModal").modal("show"); 
                $("#aset").show();
			}

             function set_aset(id){
    		  	var hasil=$("#nilai_aset_id"+id).val();
           		var final_hasil=hasil.split("|");
           		console.log(final_hasil);
           		var Aset_ID=final_hasil[0];
           		var noRegister=final_hasil[1];
           		var tmp=final_hasil[2].split("-");
           		var sign = '/';
           		var Tahun = tmp[0];
           		var Bulan = tmp[1].concat(sign);
           		var Tgl = tmp[2].concat(sign);
           		var TglPerolehan = Tgl.concat(Bulan, Tahun);
           		var NilaiPerolehan = parseInt(final_hasil[3].indexOf(',') >= 3 ? final_hasil[3].split(',')[0] : final_hasil[3].replace(/[^0-9\.]/g, ''));
           		NilaiPerolehan = NilaiPerolehan.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
           		var Info = final_hasil[4];
           		var kodeSatker = final_hasil[5];
           		var kodeKelompok = final_hasil[6];
           		var tmpkondisi = final_hasil[7];
           		var kondisi;
           		if(tmpkondisi == 1){
           			kondisi = 'Baik'; 
           		}else if(tmpkondisi == 2){
           			kondisi = 'Rusak Ringan'; 
           		}else if(tmpkondisi == 3){
           			kondisi = 'Rusak Berat'; 
           		}
           		
           		var tmp2=final_hasil[8].split("-");
           		var Tahun2 = tmp2[0];
           		var Bulan2 = tmp2[1].concat(sign);
           		var Tgl2 = tmp2[2].concat(sign);
           		var TglPembukuan = Tgl2.concat(Bulan2, Tahun2);
           		var Merk;
           		if(final_hasil[9]){
           			Merk = final_hasil[9]+'/'+final_hasil[10]+'-'+final_hasil[11]+'/'+final_hasil[12];
           		}else{
           			Merk = '-';
           		}
           		
           		$("#Aset_ID").val(Aset_ID);
           		$("#noRegister").val(noRegister);
           		$("#TglPerolehan").val(TglPerolehan);
           		$("#TglPembukuan").val(TglPembukuan);
           		$("#kodeSatker").val(kodeSatker);
           		$("#kodeKelompokInfo").val(kodeKelompok);
           		$("#NilaiPerolehan").val(NilaiPerolehan);
           		$("#kondisi").val(kondisi);
           		$("#Info").val(Info);
           		$("#Merk").val(Merk);
           		$("#myModal").modal('hide');
			}
	</script>
	
	<script>
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form3 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('DELUSMTSKPTLS');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('DELUSMTSKPTLS');
			}}, 500);
		}
		</script>

		<script>
   		$(document).ready(function() {
          	$('#rvw_aset_usulan_mts').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": false},
                         {"bSortable": false,"sClass": "checkbox-column" },
                         {"bSortable": false},
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": false},
                         {"bSortable": false}],
                    "sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/mutasiKptls/api_review_edit_aset_usulan.php?<?php echo $par_data_table?>"
               });
      	});
    </script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Transfer Kapitalisasi SKPD</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Transfer Kapitalisasi SKPD</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Transfer Kapitalisasi SKPD</div>
				<div class="subtitle">Daftar Usulan Transfer Kapitalisasi SKPD</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/mutasiKptls/list_usulan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Transfer Kapitalisasi SKPD</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/mutasiKptls/list_penetapan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Transfer Kapitalisasi SKPD</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/mutasiKptls/list_validasi.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Transfer Kapitalisasi SKPD</span>
				</a>
			</div>		

		<section class="formLegend">
			<form method="POST" action="<?php echo "$url_rewrite/module/mutasiKptls/"; ?>dftr_asetid_usulan_proses_upd.php">
                <div style=" margin-top: 2%;top: 50%; left: 25%;width: 100%">
                    <div class="formKontrak" style="outline: ridge;outline-color: #eee; margin: 0 10px 0 0;padding: 10px 10px 10px 10px">
            <div>
              <h3><i class="fa fa-group"></i> Detail Aset Tujuan</h3>
            </div>
        <hr style="height:1px;border:none;color:#aaa;background-color:#aaa;margin-top: -2px">
					<div class="row">
						<?php
							if($row['StatusPenetapan']==0){
								$disabled="";
							}elseif($row['StatusPenetapan']==1){	
								$disabled="disabled";
							}

							$TglUsulanTmp=explode("-", $row['TglUpdate']);
							$TglUsulan=$TglUsulanTmp[1]."/".$TglUsulanTmp[2]."/".$TglUsulanTmp[0];
						?>
						<ul>
							<?=selectAllSatker('SatkerTujuan','260',true,$row['SatkerTujuan'],'required',false,1,'Kode Satker Tujuan');?>
							<br/>
								<?php selectAset('kodeKelompok','255',true,$row['kodeKelompok'],'required'); ?>
							<br/>
							<li>
								<span class="span2">Data Kapitalisasi</span>
								<button type="button" id="load-data" class="btn btn-info btn-lg" data-toggle="modal" 
	                                 data-target="#myModal">Open</button>
	                            <button type="button" id="view" class="btn btn-info btn-lg">View / Hide</button>     
	                             <input type="hidden" name="data_satker" id="data_satker" value="">     
							</li>
						</ul>
					</div>	
					<div class="row" id="aset" style="display:none">
					<ul>
						<li>
							<span class="span2">Aset ID</span>
							<input id="Aset_ID" type="text" name="Aset_ID" class="span5" style="width:255px" readonly="" value="<?=$row['Aset_ID']?>">
						</li>
						<li>
							<span class="span2">kode Satker</span>
							<input id="kodeSatker" type="text" name="kodeSatker" class="span5" style="width:255px" readonly="">
						</li>
						<li>
							<span class="span2">kode Kelompok</span>
							<input id="kodeKelompokInfo" type="text" name="kodeKelompokInfo" class="span5" style="width:255px" readonly="">
						</li>
						<li>
							<span class="span2">No Register</span>
							<input id="noRegister" type="text" name="noRegister" class="span5" style="width:255px" readonly="">
						</li>
						<li>
							<span class="span2">Tanggal Perolehan</span>
							<input id="TglPerolehan" type="text" name="TglPerolehan" class="span5" style="width:255px" readonly="">
						</li>
						<li>
							<span class="span2">Tanggal Pembukuan</span>
							<input id="TglPembukuan" type="text" name="TglPembukuan" class="span5" style="width:255px" readonly="">
						</li>
						<li>
							<span class="span2">Kondisi</span>
							<input id="kondisi" type="text" name="kondisi" class="span5" style="width:255px" readonly="">
						</li>
						<li>
							<span class="span2">Nilai Perolehan</span>
							<input id="NilaiPerolehan" type="text" name="NilaiPerolehan" class="span5" style="width:255px" readonly="">
						</li>
						<li>
							<span class="span2">Merk/No.Polisi/No.Rangka</span>
							<input id="Merk" type="text" name="Merk" class="span5" style="width:255px" readonly="">
						</li>
						<li>
							<span class="span2">Info</span>
							<input id="Info" type="text" name="Info" class="span5" style="width:255px" readonly="">
						</li>
					</ul>
				</div>
				</div>

                    <div class="formPerusahaan" style="outline: ridge;outline-color: #eee; margin: 0 0 0 0;padding: 10px 10px 10px 10px">
        <div>
          <h3><i class="fa fa-file"></i> Dokumen</h3>
        </div>
        <hr style="height:1px;border:none;color:#aaa;background-color:#aaa;margin-top: -2px">
				<div class="row">
					<ul>
            <?=selectSatker('SatkerUsul','260',true,$row['SatkerUsul'],'required','Kode Satker Asal');?>
            <br/>
						<li>
							<span  class="labelInfo span2">No Usulan</span>
							<input type="text" class="span3" name="NoUsulan" value="<?=$row['NoUsulan']?>" <?=$disabled?> required/>
						</li>
						<li>
							<span  class="labelInfo span2">Tanggal Usulan</span>
								<span class="add-on"></span>
								<input name="tanggalUsulan" class="span3" type="text" id="tanggal1" <?=$disabled?>  value="<?=$row['TglUpdate']?>" required/>
						</li>
						<li>
							<span class="labelInfo span2">Keterangan usulan</span>
							<textarea rows="3" class="span3" cols="100" name="KetUsulan" <?=$disabled?> required ><?=$row['KetUsulan']?></textarea>
						</li>
						<li>
							<span  class="labelInfo span2">&nbsp;</span>
							<input type="hidden" name="usulanID" value="<?=$id?>"/><br/>
						</li>
						<li>
							<span  class="labelInfo span2">&nbsp;</span>
							<input type="submit" <?=$disabled?> value="Update Informasi Usulan" class="btn"/>
						</li>
					</ul>	
				</div>
				</div>
			 
				<div style="height:5px;width:100%;clear:both"></div>
        </div>
			</form>

			<form method="POST" ID="Form3" action="<?php echo "$url_rewrite/module/mutasiKptls/"; ?>dftr_asetid_usulan_proses_hapus.php" onsubmit="return confirmValidate()" > 
			<div id="demo">
			<?php
				if($row['StatusPenetapan']==0){
					$idtable="penghapusan11";
				}else{
					$idtable="penghapusan10";
				}

			?>
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="rvw_aset_usulan_mts">
				<thead>
					<?php
								if($row['StatusPenetapan']==0){
							?>
					<tr> 
						<td colspan="11" align="center">
							<h4>Ceklis dibawah ini untuk menghapus semua aset :</h4>
							 <label><input type="checkbox" value="1" name ="cekAll" id="cekAll"><h4>Select All</h4></label>
						</td>
					</tr>
					<?php
						}
					?>
					<tr>
						<td colspan="7" align="Left">
							<?php
								if($row['StatusPenetapan']==0){
							?>
								<a href="filter_tambah_aset_usulan.php?usulanID=<?=$id?>" class="btn btn-info " /><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;TambahKan Aset Usulan</a>
								<span><button type="submit" name="submit"  class="btn btn-danger " id="submit" disabled/><i class="icon-trash icon-white"></i>&nbsp;&nbsp;Delete</button></span>
								<input type="hidden" name="usulanID" value="<?=$id?>"/>
							<?php
								}
							?>
						</td>
						<?php
								if($row['StatusPenetapan']==0){
							?>
						<td colspan="4" align="right">
							<?php
								}else{
							?>

						<td colspan="10" align="right">
							<?php
								}
							?>
							<a href="list_usulan.php" class="btn btn-success " /><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali Ke Daftar Usulan</a>
								
						</td>
					</tr>
					<tr>
						<th>No</th>
						<?php
								if($row['StatusPenetapan']==0){
							?>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
							<?php
								}else{
									echo"<th>&nbsp;</th>";
								}
							?>
						<th>No Register</th>
						<th>Kode / Uraian</th>
						<th>Satker</th>
						<th>Tanggal Perolehan</th>
						<th>Nilai Perolehan</th>
						<th>Status</th>
						<th>Status Konfirmasi</th>
						<th>Merk / Type</th>
					</tr>
				</thead>
				<tbody>		
					 <tr>
                        <td colspan="10">Data Tidak di temukkan</td>
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
					</tr>
				</tfoot>
			</table>
			</div>
			</form>

			<!-- Start Modal -->
			<div id="myModal" class="modal fade" role="dialog" style=" width: 90%;max-width:900px;left:40%">
			  <div class="modal-dialog modal-lg" >
			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Data Kapitalisasi</h4>
			      </div>
			      <div class="modal-body">
			          <table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="daftar_aset">
							<thead>
								<tr>
									<th>Pilihan</th>
                                    <th>No Register</th>
									<th>Kode Kelompok</th>
									<th>Tgl Perolehan</th>
									<th>Nilai Perolehan</th>
									<th>Kondisi</th>
									<th>Merk / No.Polisi / No.Rangka</th>
									<th>Info</th>
								</tr>
							</thead>
							<tbody>			 
								<tr>
				                    <td colspan="8">Data Tidak di temukkan</td>
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
								</tr>
							</tfoot>
						</table>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- End Modal -->

			<div class="spacer"></div>
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>
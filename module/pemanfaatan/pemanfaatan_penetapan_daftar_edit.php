<?php
include "../../config/config.php";

$PEMANFAATAN = new RETRIEVE_PEMANFAATAN;
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	 $data = $PEMANFAATAN->pemanfaatan_penetapan_edit($_GET);
?>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Data yang akan ditetapkan pemanfaatan sudah benar ?");
		if (r==true)
		  {
		  alert("Data akan masuk ke form validasi pemanfaatan");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_eksekusi_data.php";
		  }
		}
	</script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
                    <script>
                        $(function()
                        {
                        $('#tanggal1').datepicker($.datepicker.regional['id']);
                        $('#tanggal2').datepicker($.datepicker.regional['id']);
                        $('#tanggal3').datepicker($.datepicker.regional['id']);
                        $('#tanggal4').datepicker($.datepicker.regional['id']);
                        $('#tanggal5').datepicker($.datepicker.regional['id']);
                        $('#tanggal6').datepicker($.datepicker.regional['id']);
                        $('#tanggal7').datepicker($.datepicker.regional['id']);
                        $('#tanggal8').datepicker($.datepicker.regional['id']);
                        $('#tanggal9').datepicker($.datepicker.regional['id']);
                        $('#tanggal10').datepicker($.datepicker.regional['id']);
                        $('#tanggal11').datepicker($.datepicker.regional['id']);
                        $('#id_tgl_start').datepicker($.datepicker.regional['id']);
                        $('#id_tgl_end').datepicker($.datepicker.regional['id']);
                        $('#tanggal14').datepicker($.datepicker.regional['id']);
                        $('#tanggal15').datepicker($.datepicker.regional['id']);
                        }
                        );
                    </script>   
                    <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
                    
                    <!--buat number only-->
                    <style>
                        #errmsg { color:red; }
                        #errmsg2 { color:red; }
                    </style>
                    <!--
                    <script src="../../JS/jquery-latest.js"></script>
                    <script src="../../JS/jquery.js"></script>
                    -->
                    <script type="text/javascript">
                        $(document).ready(function(){

                            //called when key is pressed in textbox
                                $("#posisiKolom").keypress(function (e)  
                                { 
                                //if the letter is not digit then display error and don't type anything
                                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                {
                                        //display error message
                                        $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                    return false;
                            }	
                                });
                        });
                    </script>
                    
                     <!--buat jangka waktu-->
                        <script>
                                        function toggle_data_valid() {
                                        // IDs untuk header BASP
                                        var id_no_tap    = document.getElementById( 'id_no_tap'   );
                                        var id_tgl_tap   = document.getElementById( 'id_tgl_tap'  );   
                                        var id_dtl_manfaat = document.getElementById( 'id_dtl_manfaat' );   	
                                        var id_manfaat = document.getElementById( 'id_manfaat' );  
                                        var id_jangka_waktu = document.getElementById( 'id_jangka_waktu' );  
                                        var id_nama_partner = document.getElementById( 'id_nama_partner' );  
                                        var id_alamat_partner = document.getElementById( 'id_alamat_partner' );  
                                        var id_tgl_start = document.getElementById( 'id_tgl_start' );  
                                        var id_tgl_end = document.getElementById( 'id_tgl_end' );  

                                        // ID untuk action button
                                        var id_btnact   = document.getElementById( 'btn_action' );
                                        var id_jml_aset = document.getElementById( 'jmlaset' ); 
                                        //
                                        var b_aset = false;        
                                        var b_for  = false;
                                        var bdone = false;

                                        if( id_jml_aset.value != 0 ) {
                                        b_aset = true;
                                        }
                                        id_no_tap.disabled  = !b_aset;
                                        id_tgl_tap.disabled     = !b_aset;
                                        id_dtl_manfaat.disabled = !b_aset;
                                        id_manfaat.disabled = !b_aset;

                                        if( b_aset  && id_no_tap.value != '' && id_tgl_tap.value != '' && id_manfaat.value != ''  ) {
                                        b_for = true;
                                        }

                                        id_nama_partner.disabled = !b_for;
                                        id_alamat_partner.disabled = !b_for;
                                        id_tgl_start.disabled = !b_for;
                                        id_tgl_end.disabled = !b_for;


                                        if( b_aset && b_for 
                                            && id_nama_partner.value != '' && id_tgl_start.value != '' && id_tgl_end.value != '' ) {
                                            bdone = true;
                                        }
                                        id_btnact.disabled  = !bdone;
                                    }

                                    function setjangkawaktu() {
                                        var id_jangka_waktu = document.getElementById( 'id_jangka_waktu' ); 
                                        var id_tgl_start = document.getElementById( 'id_tgl_start' );  
                                        var id_tgl_end = document.getElementById( 'id_tgl_end' );  
                                        var tglstart = id_tgl_start.value;
                                        var tglend = id_tgl_end.value;

                                        var date1 = tglstart;
                                                var date2 = tglend;

                                laterdate = date1.split('/');
                                laterY=laterdate[2];
                                laterM=laterdate[1];
                                laterD=laterdate[0];

                                earlierdate = date2.split('/');
                                earlierY=earlierdate[2];
                                earlierM=earlierdate[1];
                                earlierD=earlierdate[0];
                                //
                                //
                                //     var dif = 0;
                                //     dif += (earlierM - laterM);
                                //     dif += ((earlierY - laterY) * 12);
                                //     dif += (earlierD - laterD < 0) ? ((dif > 0) ? -1 : 0) : 0;
                                //

                                yeardiff = earlierY - laterY;
                                monthdiff = earlierM - laterM;
                                daydiff = earlierD - laterD;

                                difference = '';
                                differenceyear = '';
                                differencemonth = '';
                                differencehari = '';

                                if (yeardiff > 0 ) 
                                {
                                        if (monthdiff > 0)	
                                        {
                                                if (daydiff > 0)
                                                {
                                                        differenceyear=yeardiff + ' tahun '; 
                                                        differencemonth=monthdiff + ' bulan ';
                                                        differencehari=daydiff + ' hari ';
                                                }
                                                else if (daydiff == 0)
                                                {
                                                        differenceyear=yeardiff + ' tahun '; 
                                                        differencemonth=monthdiff + ' bulan ';
                                                        differencehari='';
                                                }
                                                else
                                                {
                                                        differenceyear=yeardiff + ' tahun '; 
                                                        if (monthdiff != 1)
                                                        {differencemonth=monthdiff-1 + ' bulan ';}
                                                        laterM1 = (laterM*1) + (monthdiff*1) -1;
                                                        laterY1 = (laterY*1) + (yeardiff*1);
                                                        tlgawal=laterM1+'/'+laterD+'/'+laterY1 ;
                                                        tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;

                                                        var tglakhirr = new Date(tlgakhir).getTime() ;
                                                        var tglawall = new Date(tlgawal).getTime() ;
                                                        var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);
                                                        differencehari=daysDifference + ' hari ';
                                                }
                                        }
                                        else if (monthdiff == 0)
                                        {
                                                if (daydiff > 0)
                                                {
                                                        differenceyear=yeardiff + ' tahun '; 
                                                        differencemonth='';
                                                        differencehari=daydiff + ' hari ';
                                                }
                                                else if (daydiff == 0)
                                                {
                                                        differenceyear=yeardiff + ' tahun '; 
                                                        differencemonth='';
                                                        differencehari='';
                                                }
                                                else  if (daydiff < 0)
                                                {
                                                        if (yeardiff != 1)
                                                        {differenceyear=yeardiff-1 + ' tahun '; }
                                                        differencemonth=12-monthdiff-1 + ' bulan ';
                                                        laterM1 = (laterM*1) + (monthdiff*1) -1;
                                                        laterY1 = (laterY*1) + (yeardiff*1);
                                                        tlgawal=laterM1+'/'+laterD+'/'+laterY1 ;
                                                        tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;

                                                        var tglakhirr = new Date(tlgakhir).getTime() ;
                                                        var tglawall = new Date(tlgawal).getTime() ;
                                                        var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);
                                                        differencehari=daysDifference + ' hari ';
                                                }

                                        }
                                        else
                                        {
                                                if (daydiff > 0)
                                                {
                                                        if (yeardiff != 1)
                                                        {differenceyear=yeardiff-1 + ' tahun '; }
                                                        differencemonth=12+monthdiff + ' bulan ';
                                                        differencehari=daydiff + ' hari ';
                                                }
                                                else if (daydiff == 0)
                                                {
                                                        if (yeardiff != 1)
                                                        {differenceyear=yeardiff-1 + ' tahun '; }
                                                        differencemonth=12+monthdiff + ' bulan ';
                                                        differencehari='';
                                                }
                                                else
                                                {
                                                        if (yeardiff != 1)
                                                        {differenceyear=yeardiff-1 + ' tahun '; }
                                                        differencemonth=12+monthdiff-1 + ' bulan ';
                                                        laterM1 = (laterM*1) + (monthdiff*1) -1;
                                                        laterY1 = (laterY*1) + (yeardiff*1);
                                                        tlgawal=laterM1+'/'+laterD+'/'+laterY1 ;
                                                        tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;

                                                        var tglakhirr = new Date(tlgakhir).getTime() ;
                                                        var tglawall = new Date(tlgawal).getTime() ;
                                                        var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);
                                                        differencehari=daysDifference + ' hari ';
                                                }
                                        }
                                }
                                else if (yeardiff == 0)
                                {
                                        if (monthdiff > 0)	
                                        {
                                                if (daydiff > 0)
                                                {
                                                        differencemonth=monthdiff + ' bulan ';
                                                        differencehari=daydiff + ' hari ';
                                                }
                                                else if (daydiff == 0)
                                                {

                                                        differencemonth=monthdiff + ' bulan ';
                                                        differencehari='';
                                                }
                                                else
                                                {	if (monthdiff != 1)
                                                        {differencemonth=monthdiff-1 + ' bulan ';}

                                                        laterM1 = (laterM*1) + (monthdiff*1) -1;
                                                        laterY1 = (laterY*1) + (yeardiff*1);
                                                        tlgawal=laterM1+'/'+laterD+'/'+laterY1 ;
                                                        tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;

                                                        var tglakhirr = new Date(tlgakhir).getTime() ;
                                                        var tglawall = new Date(tlgawal).getTime() ;
                                                        var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);
                                                        differencehari=daysDifference + ' hari ';
                                                }
                                        }
                                        else if (monthdiff == 0)
                                        {
                                                if (daydiff > 0)
                                                {
                                                        differencemonth='';
                                                        differencehari=daydiff + ' hari ';
                                                }
                                                else if (daydiff == 0)
                                                {
                                                        differencemonth='';
                                                        differencehari='';
                                                }
                                //		else  if (daydiff < 0)
                                //		{
                                //			differencemonth=12-monthdiff-1 + ' bulan ';
                                //			laterM1 = (laterM*1) + (monthdiff*1) -1;
                                //			laterY1 = (laterY*1) + (yeardiff*1);
                                //			tlgawal=laterM1+'/'+laterD+'/'+laterY1 ;
                                //			tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;
                                //			
                                //			var tglakhirr = new Date(tlgakhir).getTime() ;
                                //			var tglawall = new Date(tlgawal).getTime() ;
                                //			var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);
                                //			differencehari=daysDifference + ' hari ';
                                //		}	
                                        }
                                }


                                //tlgawal=laterM+'/'+laterD+'/'+laterY ;
                                //tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;
                                //
                                //var tglakhirr = new Date(tlgakhir).getTime() ;
                                //var tglawall = new Date(tlgawal).getTime() ;
                                //var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);

                                                if ( tglstart == tglend)
                                                {
                                                id_jangka_waktu.value  = 0;	
                                                }
                                                else
                                                {
                                        id_jangka_waktu.value  = differenceyear+differencemonth+differencehari;
                                                }
                                    }
									function spoiler(obj)
										{
										var inner = obj.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("tfoot")[0];
										//alert(obj.parentNode.parentNode.parentNode.parentNode.nodeName);
										if (inner.style.display =="none") {
										inner.style.display = "";
										document.getElementById(obj.id).value="Tutup Detail";}
										else {
										inner.style.display = "none";
										document.getElementById(obj.id).value="View Detail";}
										}
										
										function spoilsub(obj)
										{
										var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("div")[1];
										//alert(obj.parentNode.parentNode.parentNode.parentNode.parentNode.nodeName);
										if (inner.style.display =="none") {
										inner.style.display = "";
										document.getElementById(obj.id).value="Tutup Sub Detail";}
										else {
										inner.style.display = "none";
										document.getElementById(obj.id).value="Sub Detail";}
										}
                        </script>
              
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">pemanfaatan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Penetapan Pemanfaatan	</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Penetapan Pemanfaatan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_daftar_edit_proses.php">
                                <table width="100%">
                                    <tr>
                                        <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang dibuatkan penetapan pemanfaatan :</u></td>
                                    </tr>
									<?php 
										$id=$_GET['id'];
										/*$query="SELECT a.NoSKKDH, a.TglSKKDH, a.Keterangan, b.Aset_ID, c.NamaAset, c.NomorReg
														FROM Pemanfaatan a, PemanfaatanAset b, Aset c
														WHERE a.Pemanfaatan_ID ='$id'
														AND a.Pemanfaatan_ID= b.Pemanfaatan_ID
														AND b.Aset_ID = c.Aset_ID";*/
										$query="SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
													a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
													b.Aset_ID,  
													c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode,g.Uraian
													FROM pemanfaatanaset AS b
													LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
													LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
													LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
													JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
													JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
													JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
													WHERE b.Aset_ID";				
										// $exec=mysql_query($query);
										$no=1;
										foreach ($data as $nilai){
										// pr($nilai);
										if ($nilai['AsetOpr'] == 0)
											$select="selected='selected'";
											if ($nilai['AsetOpr'] ==1)
											$select2="selected='selected'";

											if($nilai['SumberAset'] =='sp2d')
											$pilih="selected='selected'";
											if($nilai['SumberAset'] =='hibah')
											$pilih2="selected='selected'";
												
											echo "<tr>
												<td style='border: 1px solid #004933; height:50px; padding:2px;'>
												<table width='100%'>
												<tr>
												<td></td>
												<td>$no.</td>
												<input type='hidden' name='peman_penet_nama_aset[]' value='$nilai[Aset_ID]'>
												<td>$nilai[noRegister] - $nilai[kodeSatker]</td>
												<td align='right'><input type='button' id ='$nilai[Aset_ID]' value='View Detail' onclick='spoiler(this);'></td>
												</tr>

												<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>$nilai[Uraian]</td>
												</tr>
												<tfoot style='display:none;'>
												<tr>
												<td></td>
												<td></td>
												<td colspan=2>
												<div style='padding:10px; width:98%; height:220px; overflow:auto; border: 1px solid #dddddd;'>

												<table border=0 width=100%>
												<tr>
												<td>
												<input type='text' value='$nilai[kodeSatker]' size='10px' style='text-align:center' readonly = 'readonly'> - 
												<input type='text' value='$nilai[kodeKelompok]' size='20px' style='text-align:center' readonly = 'readonly'> - 
												<input type='text' value='$nilai[kodeRuangan]' size='5px' style='text-align:center' readonly = 'readonly'>
												</td>
												<td align='right'><input type='button' id ='sub$nilai[Aset_ID]' value='Sub Detail' onclick='spoilsub(this);'></td>
												</tr>
												</table>

												<div id='idv_basicinfo' style='padding:5px; border:1px solid #999999;'>
												<table width=100%>
												<tr>
												<td valign='top' align='left' width=10%>Nama Aset</td>
												<td valign='top' align='left' style='font-weight:bold'>
												$nilai[Uraian]
												</td>
												</tr>

												<tr>
												<td valign='top' align='left'>Satuan Kerja</td>
												<td valign='top' align='left' style='font-weight:bold'>
												$nilai[NamaSatker]
												</td>
												</tr>

												

												</table>
												</div>

												<div style='display:none; padding:5px; border:1px solid #999999;'>
												<table width=100%>
												<tr>
												<td width='*' align='left' style='background-color: #cccccc; padding:2px 5px 1px 5px;'>Informasi Tambahan</td>
												</tr>
												</table>

												<table>
												<tr>
												<td valign='top' style='width:150px;'>Nomor Kontrak</td>
												<td valign='top'><input type='text' readonly='readonly' style='width:170px' value='$nilai[NoKontrak]'></td>
												</tr>

												<tr>
												<td valign='top' style='width:150px;'>Operasional/Program</td>
												<td valign='top'>
												<select style='width:130px' readonly>
												<option value=''></option>
												<option value='0' $select>Program</option>
												<option value='1' $select2>Operasional</option>
												</select>
												</td>
												</tr>

												<tr>
												<td valign='top' style='width:150px;'>Kuantitas</td>
												<td valign='top'><input type='text' readonly='readonly' style='width:40px; text-align:right' value='$nilai[Kuantitas]'>
												Satuan
												<input type='text' readonly='readonly' style='width:130px' value='$nilai[Satuan]'>
												</td>
												</tr>

												<tr>
												<td valign='top' style='width:150px;'>Cara Perolehan</td>
												<td valign='top'>
												<select style='width:130px' readonly>
												<option value='-'>-</option>
												<option value='sp2d' $pilih>Pengadaan</option>
												<option value='hibah' $pilih2>Hibah</option>
												</select>
												</td>
												</tr>

												<tr>
												<td valign='top' style='width:150px;'>Tanggal Perolehan</td>
												<td valign='top'><input type='text' readonly='readonly' style='width:130px' value='$nilai[TglPerolehan]'></td>
												</tr>

												<tr>
												<td valign='top' style='width:150px;'>Nilai Perolehan</td>
												<td valign='top'><input type='text' readonly='readonly' style='width:130px; text-align:right' value='$nilai[NilaiPerolehan]'></td>
												</tr>

												<tr>
												<td valign='top' style='width:150px;'>Alamat</td>
												<td valign='top'><textarea style='width:90%' readonly>$nilai[Alamat]</textarea><br>
												RT/RW
												<input type='text' readonly='readonly' style='width:50px' value='$nilai[RTRW]'></td>
												</tr>

												<tr>
												<td valign='top' style='width:150px;'>Lokasi</td>
												<td valign='top'><input type='text' readonly='readonly' style='width:100px' value='$nilai[NamaLokasi]'></td>
												</tr>

												
												</table>

												</div>

												</div>
												</td>
												</tr>
												</tfoot>
												</table>
												</td>
												</tr>";
										$no++; } ?>
                                      
                                </table>
                                <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
                                    <tr>
                                        <td colspan=4><u style="font-weight:bold;">Informasi Surat Penetapan Pemanfaatan</u></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php 
                                            $id=$_GET['id'];
                                            $query="SELECT * FROM Pemanfaatan where Pemanfaatan_ID='$id'";
                                            $exec=mysql_query($query);
                                            $row2=mysql_fetch_array($exec);
                                        ?>
                                    <tr>
                                        <td width="155px">Nomor Penetapan</td>
                                        <td>
                                            <input type="text" name="peman_penet_eks_nopenet" required="required" id="" value="<?php echo "$row2[NoSKKDH]";?>">&nbsp;<span id="errmsg"></span>
                                        </td>
										<td>&nbsp;</td>
                                        <td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
									</tr>
                                    <tr>
                                        <td>Tanggal Penetapan</td>
                                        <td><input type="text" name="peman_penet_eks_tglpenet" required="required" id="tanggal11" value="<?php $change=$row2[TglSKKDH]; $hasil=format_tanggal_db3($change); echo "$hasil";?>"></td>
										<td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
									<tr>
										<td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
									</tr>
                                    <tr>
                                        <td>Tipe Pemanfaatan</td>
                                        <td colspan=3>
                                            <select name="peman_penet_eks_tipe" required="required" selected="<?php echo "$row2[TipePemanfaatan]";?>">
                                                <option value="">-</option>
                                                <option value="Pinjam Pakai" <?php if($row2['TipePemanfaatan']=='Pinjam Pakai'){?>selected="selected"<?php }?>>Pinjam Pakai</option>
                                                <option value="Penyewaan" <?php if($row2['TipePemanfaatan']=='Penyewaan'){?>selected="selected"<?php }?>>Penyewaan</option>
                                                <option value="Kerjasama Pemanfaatan" <?php if($row2['TipePemanfaatan']=='Kerjasama Pemanfaatan'){?>selected="selected"<?php }?>>Kerjasama Pemanfaatan</option>
                                                <option value="Bangun Serah Guna" <?php if($row2['TipePemanfaatan']=='Bangun Serah Guna'){?>selected="selected"<?php }?>>Bangun Serah Guna</option>
                                                <option value="Bangun Guna Serah" <?php if($row2['TipePemanfaatan']=='Bangun Guna Serah'){?>selected="selected"<?php }?>>Bangun Guna Serah</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td colspan=3><textarea name="peman_penet_eks_ket" rows="3" cols="50" required="required"><?php echo "$row2[Keterangan]";?></textarea></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Partner</td>
                                        <td colspan=3><input type="text" size="54" name="peman_penet_eks_nmpartner" required="required" value="<?php echo "$row2[NamaPartner]";?>"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Partner</td>
                                        <td colspan=3><textarea name="peman_penet_eks_alamatpartner" rows="3" cols="50" required="required"><?php echo "$row2[AlamatPartner]";?></textarea></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Mulai</td>
                                        <td><input type="text" name="peman_penet_eks_tglmulai" required="required" id="id_tgl_start" value="<?php $change=$row2[TglMulai]; $hasil=format_tanggal_db3($change); echo "$hasil";?>" onchange="setjangkawaktu();"></td>
										<td>&nbsp;</td>
                                        <td>&nbsp;</td>
									</tr>
									<tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Selesai</td>
                                        <td><input type="text" name="peman_penet_eks_tglselesai" required="required" id="id_tgl_end" value="<?php $change=$row2[TglSelesai]; $hasil=format_tanggal_db3($change); echo "$hasil";?>" onchange="setjangkawaktu();"></td>
										<td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
									<tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Jangka Waktu</td>
                                        <td><input type="text" width="50px" readonly="readonly" name="peman_penet_eks_jangkawaktu" required="required" value="<?php echo "$row2[JangkaWaktu]";?>" id="id_jangka_waktu"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
										<td>&nbsp;</td>
                                        <td>
                                            <input type="submit" name="submit" value="Simpan"/>
                                            <input type="button" value="Batal" onclick="window.location='pemanfaatan_penetapan_daftar.php'"/>
                                             <input type="hidden" name="id" value="<?php echo $row2['Pemanfaatan_ID'];?>"/>
                                        </td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
                                    </tr>
                                </table>	
                                </form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>
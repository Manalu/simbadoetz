<?php 

 include "../../config/config.php";
 include"$path/header.php";
 include"$path/title.php";
     
    
  

$submit=$_POST['submit'];

                            if (isset($submit))
                                {
                            
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                            
                                            $data = $RETRIEVE->retrieve_penetapan_pemindahtanganan_eksekusi();
                                }
                                
                                echo '<pre>';
                                //print_r($data);
                                echo '</pre>';
            
     
?>
<html>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/js/tabel.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
                  <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
                  <script type="text/javascript">
                                function showSpo(data)
                                    {
                                        var id = data.id;
                                        //alert(id);
                                        spoiler = document.getElementById("show_"+id).style.display;

                                        if (spoiler == "")
                                            {
                                                document.getElementById("show_"+id).style.display = "none";
                                            }
                                        else
                                            {
                                                document.getElementById("show_"+id).style.display = "";
                                            }
                                    }
                                    function showSpo1(data)
                                    {
                                        
                                        var id = data.id;
                                        //alert(id);
                                        spoiler1 = document.getElementById("subshow_"+id).style.display;

                                        if (spoiler1 == "")
                                            {
                                                document.getElementById("subshow_"+id).style.display = "none";
                                            }
                                        else
                                            {
                                                document.getElementById("subshow_"+id).style.display = "";
                                            }
                                    }
	</script>
                  <script>
                    $(function()
                    {
                    
                    
                    $('#tanggal12').datepicker($.datepicker.regional['id']);
                    $('#tanggal13').datepicker($.datepicker.regional['id']);
                    

                    }

                    );
                </script> 
                <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	<div id="content">
                            <?php
                                include"$path/menu.php";
                            ?>
	 </div>
                    <div id="tengah1">	
                                    <div id="frame_tengah1">
                                            <div id="frame_gudang">
                                                    <div id="topright">
                                                            Penetapan Pemindahtanganan
                                                    </div>
                                                    <div id="bottomright">
                                                        <?php
                                                        /*
                                                                        $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemindahtangananPenetapan' AND UserSes = '$_SESSION[ses_uid]'";
                                                                        //print_r($query);
                                                                        $result = mysql_query($query) or die (mysql_error());

                                                                        $numRows = mysql_num_rows($result);
                                                                        if ($numRows)
                                                                        {
                                                                            $dataID = mysql_fetch_object($result);
                                                                        }
                                                                        $explodeID = explode(',',$dataID->aset_list);

                                                                        $id=0;
                                                                        foreach($explodeID as $value)
                                                                        {
                                                                            //$$key = $value;
                                                                            $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
                                                                                                        c.NoKontrak, f.NamaLokasi, g.Kode
                                                                                                        FROM UsulanAset AS b
                                                                                                        INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                                                                                        INNER JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                                                                                        INNER JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                                                                                        INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                                                                                        INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                                                                            WHERE b.Aset_ID = '$value' limit 1";
                                                                                //print_r($query);
                                                                                $result = mysql_query($query) or die(mysql_error());
                                                                                $data[$id] = mysql_fetch_object($result);

                                                                                $id++;
                                                                        }
                                                         * 
                                                         */
                                                                    ?>
                                                            <form name="form" action="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>tambah_penetapan_pemindahtanganan_proses.php" method="POST" >
                                                                <table width="100%">
                                                                                <tr>
                                                                                    <td colspan="2" style="margin-top:0px; font-weight:bold; border:1px solid #004933; padding:4px;text-decoration:underline;">Daftar Aset yang akan di buatkan penetapan pemindahtanganan:</td>
                                                                                 </tr>   
                                                                                 <tr>
                                                                                     <td style="margin-top:5px; font-weight:bold; border:1px solid #004933; padding:5px;">
                                                                                        <table width="100%" border="0">
                                                                                            <?php
                                                                                            
                                                                                            $id =0;
                                                                                            $no = 1;
                                                                                            foreach ($data['dataArr'] as $keys => $nilai)
                                                                                            {

                                                                                                if ($nilai['Aset_ID'] !='')
                                                                                                {
                                                                                            ?>
                                                                                           <tr> 
                                                                                               <td valign="top" rowspan="2"><?php echo $no;?>.</td>
                                                                                                <td valign="top"><b><input type="hidden" name="pemindahtanganan_penet_nama_aset[]" value="<?php echo "$nilai[Aset_ID]";?><br/><?php echo "$nilai[NomorReg]";?><br/><?php echo "$nilai[NamaAset]";?>"/><?php echo "$nilai[Aset_ID]";?><br/><br/><?php echo "$nilai[NomorReg]";?><br/><br/><?php echo "$nilai[NamaAset]";?></b></td>
                                                                                                <td align="right" valign="top"><input type="button" onclick="showSpo(this)" value="View Detail" id="<?php echo $i;?>"></td>
                                                                                                <td align="right" style="border-style:none;"rowspan="2"></td>
                                                                                           </tr>
                                                                                           <tr>
                                                                                            <td colspan="3" align="center">
                                                                                                <div  id="show_<?php echo $i?>" style="border:1px solid #dddddd; display: none;">
                                                                                                        <table width="100%">
                                                                                                            <tr>
                                                                                                                <td><input type="text" value="99" readonly="readonly" size="1%" style="text-align:center; font-weight:bold;">-</td>
                                                                                                                <td><input type="text" value="1" readonly="readonly" size="5%" style="text-align:center; font-weight:bold;">-</td>
                                                                                                                <td><input type="text" value="02.03.01.02.02" readonly="readonly" style="text-align:center; font-weight:bold;"></td>
                                                                                                                <td>-
                                                                                                                    <input type="text" value="1" readonly="readonly" size="5%" style="text-align:center; font-weight:bold;">
                                                                                                                </td>
                                                                                                                <td align="right" style="border-style:none;"><input type="button" onclick="showSpo1(this)" value="Sub Detail" id="<?php echo $i;?>"></td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                        <table width="100%" border="1">
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                        <table width="100%" border="0">
                                                                                                                            <tr>
                                                                                                                                <td >Nama Aset</td>
                                                                                                                                <td style="font-weight:bold;"><?php echo $nilai['NamaAset']?></td>
                                                                                                                            </tr>   
                                                                                                                            <tr>
                                                                                                                                <td>Satuan Kerja</td>
                                                                                                                                <td style="font-weight:bold;"><?php echo $nilai['NamaSatker']?></td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td>Jenis Barang</td>
                                                                                                                                <td style="font-weight:bold;"><?php echo $nilai['NamaAset']?></td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                    <td colspan="2"><hr /></td>
                                                                                                                            </tr>
                                                                                                                          </table>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                          </table>
                                                                                                     <div  id="subshow_<?php echo $i?>" style="width:99%; height:200px; overflow:auto; border:1px solid #dddddd; display: none;">
                                                                                                        <table width="50%" border="1" style="border-collapse:collapse;">
                                                                                                            <tr>
                                                                                                                    <td>
                                                                                                                            <table>
                                                                                                                                <tr>
                                                                                                                                    <td colspan="2" style="background-color:#CCCCCC;">Informasi Tambahan</td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Nomor Kontrak</td>
                                                                                                                                    <td><input type="text" value="<?php echo "$nilai[NoKontrak]"?>" readonly="readonly" name="bupt_it_get_nokontrak"></td>
                                                                                                                                <tr>
                                                                                                                                    <td><td>Tidak ada informasi</td></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Operasional/Program</td>
                                                                                                                                    <td>
                                                                                                                                        <select name="bup_it_get_asetOpr">
                                                                                                                                            <option></option>
                                                                                                                                            <option selected="selected">Program</option>
                                                                                                                                            <option>Operasional</option>
                                                                                                                                        </select>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Kuantitas</td>
                                                                                                                                    <td><input type="text" name="bupt_it_get_kuantitas" value="1" size="2"> Satuan <input type="text" name="bup_it_get_satuan" value="unit"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Cara Perolehan</td>
                                                                                                                                    <td>
                                                                                                                                        <select name="bupt_it_get_perolehan">
                                                                                                                                            <option>-</option>
                                                                                                                                            <option>Pengadaan</option>
                                                                                                                                            <option>Hibah</option>
                                                                                                                                        </select>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Tanggal Perolehan</td>
                                                                                                                                    <td><input type="text" name="bupt_it_get_tanggal" readonly="readonly"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Nilai Perolehan</td>
                                                                                                                                    <td><input type="text" value="0" style="text-align:right" name="bupt_it_get_nilai" readonly="readonly"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Alamat</td>
                                                                                                                                    <td><textarea cols="130" name ="bupt_it_get_alamat"rows="2"></textarea></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td></td>
                                                                                                                                    <td>RT/RW <input type="text" name="bupt_it_get_rtrw " readonly="readonly" size="3"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Lokasi</td>
                                                                                                                                    <td><input type="text" readonly="readonly" name="bupt_it_get_lokasi" size="100"> <input type="button" value="Cari Lokasi" disabled="disabled"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Koordinat</td>
                                                                                                                                    <td>Bujur Lintang</td>
                                                                                                                                </tr>
                                                                                                                                </tr>
                                                                                                                            </table>
                                                                                                                    </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                    </div>
                                                                                               </td>
                                                                                       </tr>
                                                                                       <tr>
                                                                                           <td colspan="3"><hr/></td>
                                                                                       </tr>
                                                                                       <?php $id++; $no++; }} ?>
                                                                                        </table>
                                                                                     </td>
                                                                                 </tr>
                                                                    </table>
                                                                
                                                                    <div style="margin-top:0px; padding:5px; padding-top:10px; border: 1px solid #004933;">
                                                                    <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                                                        <tr>
                                                                            <td colspan="4"><u style="font-weight:bold;">Berita Acara Serah Terima</u></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                                <!-- Nomor Ketetapan -->
                                                                                <td valign="top" align="left" width="120px">Nomor&nbsp;Penetapan </td>
                                                                                <td valign="top" align="left" >
                                                                                    <input type="text" name="NoBASP" style="width:180px;" required="required">
                                                                                </td>
                                                                                <td valign="top" align="left" width="120px">
                                                                                    Tanggal&nbsp;Penetapan 
                                                                                </td>
                                                                                <!-- Tanggal Ketetapan -->
                                                                                <td valign="top" align="left" >
                                                                                    <input type="text" name="TglBAST" id="tanggal12" required="required">
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4">&nbsp;</td>
                                                                        </tr>
                                                                         <tr>
                                                                        <!-- Nomor BASP -->
                                                                                <td valign="top" align="left" width="120px">
                                                                                    Nomor&nbsp;BAST
                                                                                </td>
                                                                                <td valign="top" align="left" >
                                                                                    <input type="text" name="bupt_bast_nobast" required="required">
                                                                                </td>
                                                                                <td valign="top" align="left" width="120px">
                                                                                    Tanggal&nbsp;BAST
                                                                                </td>
                                                                                <!-- Tanggal BASP -->
                                                                                <td valign="top" align="left" >
                                                                                    <input type="text" name="bupt_bast_tglbast" id="tanggal13" required="required">
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td valign="top" align="left">
                                                                                    Lokasi&nbsp;Serah&nbsp;Terima
                                                                                </td>
                                                                                <td valign="top" align="left" colspan="3"><input type="text" name="LokasiBASP" required="required">
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td valign="top" align="left">
                                                                                    Tipe Pemindahtanganan
                                                                                </td>
                                                                                <td valign="top" align="left" colspan="3">
                                                                                    <select name="bupt_bast_tipepemindahtanganan" style="width:490px" required="required">
                                                                                            <option value="">-</option>
                                                                                            <option value="pjl" >Penjualan</option>
                                                                                            <option value="tkr" >Tukar Menukar</option>
                                                                                            <option value="hbh" >Hibah</option>
                                                                                            <option value="mdl" >Penyertaan Modal</option>
                                                                                    </select>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td valign="top" align="left">Peruntukan</td>
                                                                                <td valign="top" align="left" colspan="3">
                                                                                    <select name="bupt_bast_peruntukan" style="width:490px" required="required">
                                                                                          <option value="">-</option>
                                                                                          <option value="00" >Kementerian/Lembaga</option>
                                                                                          <option value="11" >Pemerintah Provinsi</option>
                                                                                          <option value="12" >Pemerintah Kabupaten/Kota</option>
                                                                                          <option value="99" >Yayasan/Masyarakat</option>
                                                                                    </select><br>
                                                                                    Alamat Pihak Kedua :<br>
                                                                                    <textarea name="bupt_bast_alamat" style="width:490px" required="required">
                                                                                    </textarea>
                                                                                </td>
                                                                       </tr>
                                                                       <tr>
                                                                            <td colspan="4">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td colspan="4">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td width="50%" valign="top" align="left" colspan="2">
                                                                                    <b><u style="font-weight:bold;">Pihak Pertama</u></b>
                                                                                </td>
                                                                                <td valign="top" align="left" colspan="2">
                                                                                        <b><u style="font-weight:bold;">Pihak Kedua</u></b>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td valign="top" align="left" colspan="2">
                                                                                    <!-- Pihak Pertama -->
                                                                                    <table width="100%">
                                                                                            <tr>
                                                                                                <!-- Nama -->
                                                                                                <td width="95px" valign="top" align="left">Nama</td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" 
                                                                                                        name="bupt_bast_nama_1" required="required">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">&nbsp;</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- Jabatan -->
                                                                                                <td valign="top" align="left">Jabatan</td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" 
                                                                                                        name="bupt_bast_jabatan_1" required="required">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">&nbsp;</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- NIP -->
                                                                                                <td valign="top" align="left">NIP</td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" 
                                                                                                        name="bupt_bast_nip_1" required="required"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">&nbsp;</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- Lokasi -->
                                                                                                <td width="*" valign="top" align="left">Lokasi</td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" 
                                                                                                        name="bupt_bast_lokasi_1" required="required">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">&nbsp;</td>
                                                                                            </tr>
                                                                                    </table>
                                                                                </td>
                                                                                <td valign="top" align="left" colspan="2">
                                                                                    <!-- Pihak Kedua -->
                                                                                    <table width="100%">
                                                                                            <tr>
                                                                                                <!-- Nama -->
                                                                                                <td width="95px" valign="top" align="left">Nama</td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" 
                                                                                                        name="bupt_bast_nama_2" required="required">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">&nbsp;</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- Jabatan -->
                                                                                                <td width="*" valign="top" align="left">Jabatan</td>
                                                                                                <td valign="top" align="left">
                                                                                                        <input type="text" style="width:95%;" 
                                                                                                        name="bupt_bast_jabatan_2" required="required">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">&nbsp;</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- NIP -->
                                                                                                <td valign="top" align="left">NIP</td>
                                                                                                <td valign="top" align="left">
                                                                                                    <input type="text" style="width:95%;" 
                                                                                                        name="bupt_bast_nip_2" required="required">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">&nbsp;</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <!-- Lokasi -->
                                                                                                <td width="*" valign="top" align="left">Lokasi</td>
                                                                                                <td valign="top" align="left"><input type="text" style="width:95%;" 
                                                                                                        name="bupt_bast_lokasi_2" required="required">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">&nbsp;</td>
                                                                                            </tr>
                                                                                    </table>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                                <th colspan="4" align="center">
                                                                                 
                                                                                        <input type="submit" name="btn_action" value="Pemindahtanganan">
                                                                                        <input type="reset"
                                                                                                name="btn_action" style="width:100px;"  value="Batal">
                                                                                        </th>
                                                                            </tr>
                                                            </table>
                                                            </div>
                                                        </form> 
                                                </div>
                        </div>
                </div>
        </div>
          <?php
                include"$path/footer.php";
            ?>
    </body>
</html>	

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
include "../../config/config.php";
?>
<html>
    <head>
        <title>Help SIMBADA</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?=$title?></title>
                <!-- include css file -->
                
                <link rel="stylesheet" href="../../css/simbada.css" type="text/css" media="screen" />
                <link rel="stylesheet" href="../../css/jquery-ui.css" type="text/css">
                <link rel="stylesheet" href="../../css/example.css" TYPE="text/css" MEDIA="screen">
    </head>
    <body>
        <div>
            <div id="frame_header">
                <div id="header"></div>
            </div>
            <div id="list_header"></div>
            <div id="kiri">
            <?php include '../menu_samping.php';?>
        </div>
        
        <div id="tengah">	
            <div id="frame_tengah">
                <div id="" style="padding: 10px">
                    <fieldset style="padding: 5px;">
                    <label style='font-size:18px'>Help &raquo;</label>
					<br><br>
					<p style='font-size:17px' >Sub Menu Cetak Label</p>
					<br>
					<p style='font-size:14px'>Pada Sub Menu Cetak Label akan dilakukan pencetakan label dari informasi aset yang telah di masukan sebelumnya, tahapan-tahapan dari cetak label antara lain :</p>
					<br>
					<p align="center"><img  src="../perolehan/images/cetak_label.jpg" width="350px" height="100px"/> </p>
					<br>
                                        <p align="center"><img  src="../perolehan/images/cetaklabelform.jpg" width="300px" height="300px"/> </p>
					<br>
                                        <br>
                                        <p style='font-size:14px' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; a. Seleksi pencarian aset. pada seleksi ini aset dapat dicari berdasarkan SKPD dan Jenis Barang. </p>
                                        <p align="center"><img  src="../perolehan/images/cetaklabelform1.jpg" width="700px" height="350px"/> </p>
                                        <p style='font-size:14px' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; b. Setelah dilakukan filterisasi/ pencarian aset akan didapatkan List Cetak Label sesuai dengan Filterisasi/ pencarian data aset yang telah dipilih. </p>
                                       
                                        <br>
					
					<p align="center"><input type="button" value="<< Previous" onClick="window.location.href='http://localhost/simbada_v9/help/perolehan/validasi.html'"> &nbsp;<input type='BUTTON' value='TOC' onClick="window.location.href='http://localhost/simbada_v9/help'">&nbsp;  <input type='BUTTON' value='Next >>' onClick="window.location.href='http://localhost/simbada_v9/help/perolehan/cetak_dokumen_pengadaan.html'"></p>
                    </fieldset>
                </div>
            </div>
        </div>
        
        </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
            Powered by BBSDM Team 2012
            </div>
        </div>
    </body>
</html>

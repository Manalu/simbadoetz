<?php
ob_start();
require_once('../../../config/config.php');
include ('../../../function/tanggal/tanggal.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$skpd_id = $_REQUEST['skpd_id'];
$kelompok=$_REQUEST['kelompok'];
$lokasi = $_REQUEST['lokasi'];
$tab = $_REQUEST['tab'];

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
	"kelompok"=>$kelompok,
	"skpd_id"=>$skpd_id,
	"lokasi"=>$lokasi,
	"tab"=>$tab
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan
$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan
$query=$REPORT->list_query();

//mengenerate query
$result_query=$REPORT->retrieve_query($query);

//set gambar untuk laporan
$gambar = $FILE_GAMBAR_KABUPATEN;

//retrieve html
$html=$REPORT->retrieve_html_standarhargabarang($result_query, $gambar);

//print html
$count = count($html);

	for ($i = 0; $i < $count; $i++) {
		 
		 //echo $html[$i];     
	}

//cetak reporting
$REPORT->show_status_download();
$mpdf=new mPDF('','','','',15,15,16,16,9,9,'P');
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;
$mpdf->progbar_heading = '';
$mpdf->StartProgressBarOutput(2);
$mpdf->useGraphs = true;
$mpdf->list_number_suffix = ')';
$mpdf->hyphenate = true;
$count = count($html);

	for ($i = 0; $i < $count; $i++) {
		 if($i==0)
			  $mpdf->WriteHTML($html[$i]);
		 else
		 {
			   $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
			   $mpdf->WriteHTML($html[$i]);
			   
		 }
	}


// $waktu=date("d-m-y h:i:s");
$waktu=date("d-m-y_h-i-s");
$namafile="$path/report/output/Standar kebutuhan Barang_$waktu.pdf";
$mpdf->Output("$namafile",'F');
$namafile_web="$url_rewrite/report/output/Standar Kebutuhan Barang_$waktu.pdf";
echo "<script>window.location.href='$namafile_web';</script>";
exit;

?>

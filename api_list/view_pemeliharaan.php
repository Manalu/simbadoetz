<?php
ob_start();
include "../config/config.php";

$id=$_SESSION['user_id'];//Nanti diganti
// echo  $id;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
 /*SELECT a.Aset_ID,a.kodeKelompok,a.kodeSatker,a.Tahun,k.Uraian,s.NamaSatker from aset a 
 inner join kelompok as k on k.Kode = a.kodeKelompok 
 inner join satker as s on s.kode = a.kodeSatker 
 where a.tahun = '2014' and a.kodeSatker = '01.01.01.01' and a.kodekelompok like '02%' limit 1 */
 
 // echo "masuk aja dulu";
 // pr($_GET);
 // exit;
$aColumns = array('a.Aset_ID','a.kodeKelompok','k.Uraian','a.Tahun','a.kodeSatker',
				 'a.StatusValidasi','a.Status_Validasi_Barang','a.NilaiPerolehan','a.noRegister','a.TipeAset','a.Info');
$test = count($aColumns);
  
// echo $aColumns; 
/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "a.Aset_ID";

/* DB table to use */
$sTable = "aset as a";
$sTable_inner_join_kelompok = "kelompok as k";
// $sTable_inner_join_satker ="satker as s";
$cond_kelompok ="k.Kode = a.kodeKelompok ";
// $cond_satker ="s.kode = a.kodeSatker";
$status = "a.StatusValidasi = 1 AND a.Status_Validasi_Barang = 1 AND";
//variabel ajax
// pr($_GET['id']);
$idpmlrn =$_GET['id'];
// echo "id pemeliharaan=".$idpmlrn; 
// $getUrl = decode($idpmlrn);
// pr($getUrl);
$tahun 		= $_GET['tahun'];
$reg_aw 		= $_GET['Reg_aw'];
$reg_ak 		= $_GET['Reg_ak'];
$satker 		= $_GET['satker'];
$kodeKelompok	= $_GET['kodeKelompok'];
$tipeAset		= $_GET['tipeAset'];
// $par_data_table="tahun=$tahun&satker=$satker";
$par_pmlrhn ="id=$idpmlrn";
// echo $par_pmlrhn; 
$par_data_table="tahun=$tahun&satker=$satker&kodeKelompok=$kodeKelompok&tipeAset=$tipeAset&Reg_aw=$reg_aw&Reg_ak=$reg_ak";

// pr($_GET);
if($tipeAset == 'tanah'){
	$tipe = '01';
}elseif($tipeAset == 'mesin'){
	$tipe = '02';
}elseif($tipeAset == 'bangunan'){
	$tipe = '03';
}elseif($tipeAset == 'jaringan'){
	$tipe = '04';
}elseif($tipeAset == 'asetlain'){
	$tipe = '05';
}elseif($tipeAset == 'kdp'){
	$tipe = '06';
}
// echo $tahun;
/* REMOVE THIS LINE (it just includes my SQL connection user/pass) */
//include( $_SERVER['DOCUMENT_ROOT'] . "/datatables/mysql.php" );


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
 * no need to edit below this line
 */

/*
 * Local functions
 */

function fatal_error($sErrorMessage = '') {
     header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
     
     die(mysql_error());
}

/*
/*
 * Paging
 */
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
     $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
             intval($_GET['iDisplayLength']);
}


/*
 * Ordering
 */
$sOrder = "";
if (isset($_GET['iSortCol_0'])) {
     $sOrder = "ORDER BY  ";
     for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
          if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
               $sOrder .= "" . $aColumns[intval($_GET['iSortCol_' . $i])] . " " .
                       ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
          }
     }

     $sOrder = substr_replace($sOrder, "", -2);
     if ($sOrder == "ORDER BY") {
          $sOrder = "";
     }
}
// ECHO $sOrder;

/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
$sWhere = "";

if ($satker != '' AND $tahun != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  != '' AND $reg_ak  != ''){
	$sWhere=" WHERE $status a.Tahun ='$tahun'  AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak'";
}
elseif($satker != ''  AND $tahun != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  == '' AND $reg_ak  == ''){
	$sWhere=" WHERE $status a.Tahun ='$tahun'  AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok'";
}
elseif($satker != '' AND $tahun != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  != '' AND $reg_ak  != ''){
	$sWhere=" WHERE $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak'";
}
elseif($satker != '' AND $tahun != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  == '' AND $reg_ak  == ''){
	$sWhere=" WHERE $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%'";
}

if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
     //$sWhere = "WHERE (";
	 if ($satker != '' AND $tahun != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  != '' AND $reg_ak  != ''){
		$sWhere=" WHERE $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND (";
	}elseif($satker != '' AND $tahun != '' AND $tipeAset != '' AND $kodeKelompok != '' AND $reg_aw  == '' AND $reg_ak  == ''){
		$sWhere=" WHERE $status a.Tahun ='$tahun'  AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND (";
	}
	elseif($satker != '' AND $tahun != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  != '' AND $reg_ak  != ''){
		$sWhere=" WHERE $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak' AND (";
	}
	elseif($satker != '' AND $tahun != '' AND $tipeAset != '' AND $kodeKelompok == '' AND $reg_aw  == '' AND $reg_ak  == ''){
		$sWhere=" WHERE $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' AND (";
	}
	 
     // $sWhere.="(";
     for ($i = 0; $i < count($aColumns); $i++) {
          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
               $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
          }
     }
     $sWhere = substr_replace($sWhere, "", -3);
     $sWhere .= ')';
}

/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
     if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
          if ($sWhere == "") {
               $sWhere = "WHERE $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%'";
          } else {
               $sWhere .= " AND $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok' AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak'";
          }
          $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
     }
}
// echo $sWhere;

/*
 * SQL queries
 * Get data to display
 */
 /*SELECT a.Aset_ID,a.kodeKelompok,a.kodeSatker,a.Tahun,k.Uraian,s.NamaSatker from aset a 
 inner join kelompok as k on k.Kode = a.kodeKelompok 
 inner join satker as s on s.kode = a.kodeSatker 
 where a.tahun = '2014' and a.kodeSatker = '01.01.01.01' and a.kodekelompok like '02%' limit 1 */
 
 

$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable 
		INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
		$sWhere
		$sOrder
		$sLimit
		";

// echo $sQuery;
$rResult = $DBVAR->query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());


/* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
// echo $sQuery;
$rResultFilterTotal = $DBVAR->query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());
$aResultFilterTotal = $DBVAR->fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
if($kodeKelompok != '' && $reg_aw  != '' && $reg_ak  != ''){
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok'
		AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak'";
}elseif($kodeKelompok != '' && $reg_aw  == '' && $reg_ak  == ''){
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok='$kodeKelompok'";
}elseif($kodeKelompok == '' && $reg_aw  != '' && $reg_ak  != ''){
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%' 
		AND a.noRegister BETWEEN '$reg_aw' AND '$reg_ak'";
}else{
	$sQuery = "
		SELECT COUNT(" . $sIndexColumn . ")
		FROM   $sTable WHERE $status a.Tahun ='$tahun' AND a.kodeSatker='$satker' AND a.kodeKelompok like '$tipe%'";
}
	// 	echo $sQuery;
$rResultTotal = $DBVAR->query($sQuery) or fatal_error('MySQL Error: ' . mysql_errno());
$aResultTotal = $DBVAR->fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];


/*
 * Output
 */
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);
$no=$_GET['iDisplayStart']+1;
while ($aRow = $DBVAR->fetch_array($rResult)) {
		// pr($aRow);
		//DAFTAR FIELD
		$row = array();
		$id =  $aRow['Aset_ID'];
		$Tahun = $aRow['Tahun'];
		$Kd_Satker = $aRow['kodeSatker'];
		$NamaSatker = $aRow['NamaSatker'];
		$Kd_Kelompok = $aRow['kodeKelompok'];
		$Uraian = $aRow['Uraian'];
		$noRegister = $aRow['noRegister'];
		$NilaiPerolehan = $aRow['NilaiPerolehan'];
		$Info = $aRow['Info'];
		$TipeAset = $aRow['TipeAset'];
		
		//cek merk by tipe aset
		/*if($kodeKelompok != '' || $tipe == '02'){
			$exKlmpk = explode('.',$kodeKelompok);
			$kdKlmpk = $exKlmpk[0]; 
		}
		
		if($kdKlmpk == '02' || $tipe == '02'){
			$queryTipe = "select Merk from mesin where kodeSatker ='$Kd_Satker' and Aset_ID = '$id' limit 1";
			// pr($queryTipe);
			$exequeryTipe = $DBVAR->query($queryTipe);
			$GetDataTipe = $DBVAR->fetch_array($exequeryTipe);
			// pr($GetDataTipe);
			$Merk = $GetDataTipe['Merk'];
		}else{
			$Merk = "";
		}*/
		if($TipeAset == 'B'){
			$queryTipe = "select Merk from mesin where kodeSatker ='$Kd_Satker' and Aset_ID = '$id' limit 1";
			// pr($queryTipe);
			$exequeryTipe = $DBVAR->query($queryTipe);
			$GetDataTipe = $DBVAR->fetch_array($exequeryTipe);
			// pr($GetDataTipe);
			$Merk = $GetDataTipe['Merk'];
		}else{
			$Merk = "";
		}
		
		
		 // $identity = "id=$id&tipe=$TipeAset";
		 $identity = "id=$id";
		 $addUrl = encode($identity);
		 $filterUrl = encode($par_data_table);
		 $filterUrlPmlhrn = encode($par_pmlrhn);
		 $skUrl = encode($Kd_Satker);
		 // echo $par_pmlrhn;
		 //cek telah dilakukan pemeliharaan
		 $queryCeck = "select count(Aset_ID) as jml from pemeliharaan_aset where Aset_ID ='$id'";
		// pr($queryTipe);
		$exequeryCeck = $DBVAR->query($queryCeck);
		$GetDataCeck = $DBVAR->fetch_array($exequeryCeck);
		// pr($GetDataCeck);
		$flag = encode(1);
		if($GetDataCeck['jml'] != 0){
			$cekPmlhrn = $GetDataCeck['jml']." x";
			$wrd = "Telah Dilakukan"."<br>"." Pemeliharaan :";
			$label ="label-success";
			//$rincian="";
			$rincian ="<center><a href=\"pemeliharaan_tambah_rincian.php?url=$addUrl&surl=$filterUrl&turl=$filterUrlPmlhrn&skUrl=$skUrl\" class=\"btn btn-info btn-small\">
			<i class=\"icon-plus icon-white\"></i>&nbsp;Pemeliharaan
			</a></center>";
			$view= "<center><a href=\"pemeliharaan_detail.php?url=$addUrl&surl=$filterUrl&turl=$filterUrlPmlhrn&flag=$flag&skUrl=$skUrl\" class=\"btn btn-info btn-small\">
			<i class=\"fa fa-eye\" align=\"center\"></i>&nbsp;&nbsp;Detail</a></center>";
		}else{
			$cekPmlhrn = '';
			$wrd = "Belum Dilakukan"."<br>"." Pemeliharaan ";
			$label ="label-warning";
			$rincian ="<center><a href=\"pemeliharaan_tambah_rincian.php?url=$addUrl&surl=$filterUrl&turl=$filterUrlPmlhrn&skUrl=$skUrl\" class=\"btn btn-info btn-small\">
			<i class=\"icon-plus icon-white\"></i>&nbsp;Pemeliharaan
			</a></center>";
			$view= "";
		}
		  
		  $row[] ="<center>".$no."</center>";
		  $row[] ="[".$Kd_Kelompok."]"."<br>".$Uraian;
		  $row[] =$Merk;
		  $row[] ="<center>".sprintf('%04s',$noRegister)."</center>";
		  $row[] ="<center>".number_format($NilaiPerolehan,2,",",".")."</center>";
		  $row[] ="<center>".$Tahun."</center>";
		  $row[] =$Info;
		  $row[] = "<center><span class=\"label $label\">$wrd $cekPmlhrn </span></center>";
		  $row[] =$rincian;
		  $row[] =$view;
		 
		  
		  
		  
		$no++;
		 $output['aaData'][] = $row;
	}
echo json_encode($output);

?>


<?php
include "../../config/database.php";  
open_connection();  
		
	$term = $_POST['term'];
	$sess = $_POST['sess'];
	if($sess=="") $limit = "LIMIT 10";
	$cond = "KodeSatker is NOT NULL AND KodeUnit is NOT NULL AND Gudang is NOT NULL AND Kd_Ruang is NULL AND";
	if(isset($_GET['free'])) $cond = "";
	$sql = mysql_query("SELECT NamaSatker FROM satker WHERE {$cond} Kd_Ruang IS NULL AND kode LIKE '{$sess}%' AND (kode LIKE '{$term}%' OR NamaSatker LIKE '%{$term}%') ORDER BY Satker_ID ASC {$limit}");	
	
	while ($row = mysql_fetch_assoc($sql)){
				$data = $row;
			}
	
	echo $data['NamaSatker'];	
	
	

exit;

?>
<?php
include "../../config/database.php";  
open_connection();  
		
	$term = $_GET['term'];
	$cond = "Kelompok is NOT NULL AND Jenis is NOT NULL AND Objek is NOT NULL AND RincianObjek is NOT NULL";

	$sql = mysql_query("SELECT * FROM koderekening WHERE {$cond} AND (NamaRekening LIKE '%{$term}%' OR KodeRekening LIKE '{$term}%') ORDER BY Tipe ASC");	
	// print_r($sql);
	while ($row = mysql_fetch_assoc($sql)){
				$data[] = $row;
			}
	foreach ($data as $key => $value) {
				$data[$key] = preg_replace('/[[:^print:]]/', '', $value); 
			}		
	// print_r($test);
	if(!$data){

		$data[] = array("KodeRekening"=>"","NamaRekening"=>"No Results Found..");
	
	}		
	
	echo json_encode($data);

exit;

?>
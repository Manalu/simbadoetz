<?php

include "../../../config/config.php"; 

$log = "back_kir_asetlain_rsud";
$status=exec("php back_kir_asetlain_rsud.php > ../../../log/$log.txt 2>&1 &");

?>

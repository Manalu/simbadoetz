<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
error_reporting (0);
include "../../config/config.php";

$kib = $argv[ 1 ];
$tahun = $argv[ 2 ];
$kodeSatker = $argv[ 3 ];
$id = $argv[ 4 ];

/* if($tahun == 2014 || $tahun == 2015){
  $newTahun = '2014';
  }else{
  $newTahun = $tahun - 1;
  } */

$newTahun = $tahun;
// $newTahun = $tahun - 1; 
$aColumns = array( 'a.Aset_ID', 'a.kodeKelompok', 'k.Uraian', 'a.Tahun', 'a.Info', 'a.NilaiPerolehan', 'a.noRegister', 'a.PenyusutanPerTahun', 'a.AkumulasiPenyusutan', 'a.TipeAset', 'a.kodeSatker', 'a.Status_Validasi_Barang', 'a.MasaManfaat', 'a.NilaiBuku','a.UmurEkonomis' );
$fieldCustom = str_replace (" , ", " ", implode (", ", $aColumns));
$sTable = "aset_tmp as a";
$sTable2 = "aset_tmp2 as a";
$sTable_inner_join_kelompok = "kelompok as k";
$cond_kelompok = "k.Kode = a.kodeKelompok ";
$status = "a.Status_Validasi_Barang = 1 AND";


$TglPerubahan_awal = $tahun . "-01" . "-01";
$TglPerubahan_temp = $tahun . "-12" . "-31";
if($kib == 'B') {
    $queryKib = "create temporary table aset_tmp as
                                      select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                  a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
                                                  a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                  a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                  a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan
                                            from mesin a where a.TglPerolehan <= '$TglPerubahan_temp'  and a.kodeSatker like '$kodeSatker%'";
    $ExeQuery = $DBVAR->query ($queryKib) or die($DBVAR->error ());

    $queryAlter = "ALTER table aset_tmp add primary key(Mesin_ID)";
    $ExeQuery = $DBVAR->query ($queryAlter) or die($DBVAR->error ());

    $queryAlter = "Update aset_tmp set TipeAset='B';";
    $ExeQuery = $DBVAR->query ($queryAlter) or die($DBVAR->error ());

    $queryLog = "replace into aset_tmp (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                 kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
                                                 AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
                                                 NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
                                                 NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
                                                 select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'B',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
                                                       a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                       a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                       a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
                                                       if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), 
                                                       if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), 
                                                       if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis,a.TahunPenyusutan
                                                 from log_mesin a
                                                 inner join mesin t on t.Aset_ID=a.Aset_ID
                                                 inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                                 where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp' and a.TglPerubahan>'$TglPerubahan_temp'"
        . "              order by a.log_id desc";
    $ExeQuery = $DBVAR->query ($queryLog) or die($DBVAR->error ());

    $queryLog = "replace into aset_tmp (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
              TglPembukuan, kodeData, kodeKA,TipeAset, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
              NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, 
              MerkMesin, JumlahMesin, Material, NoSeri, NoRangka, NoMesin, NoSTNK, TglSTNK, 
              NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, NegaraAsal, NegaraRakit, 
              Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan) 
      select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),
              lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, 
              a.kodeData, a.kodeKA, 'B',a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
              a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, 
              a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, 
a.NoSeri, a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen,
a.Pabrik, a.TahunBuat, a.BahanBakar, a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis,t.TahunPenyusutan from 
view_mutasi_mesin a inner join mesin t 
on t.Aset_ID=a.Aset_ID inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID 
and t.Aset_ID is not null and t.Aset_ID != 0
 where a.TglPerolehan <='$TglPerubahan_temp' AND a.TglSKKDH >'$TglPerubahan_temp' AND "
        . "a.TglPembukuan <='$TglPerubahan_temp' AND a.SatkerTujuan like '$kodeSatker%' "
        . "order by a.TglSKKDH desc;";
    $ExeQuery = $DBVAR->query ($queryLog) or die($DBVAR->error ());

    //untuk table selanjutnya
    $queryKib = "create temporary table aset_tmp2 as
                                      select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                  a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
                                                  a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                  a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                  a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis ,a.TahunPenyusutan
                                            from mesin a where  a.kodeSatker like '$kodeSatker%' and  a.TglPerolehan <= '$TglPerubahan_temp' ";
    $ExeQuery = $DBVAR->query ($queryKib) or die($DBVAR->error ());

    $queryAlter = "ALTER table aset_tmp2 add primary key(Mesin_ID)";
    $ExeQuery = $DBVAR->query ($queryAlter) or die($DBVAR->error ());

    $queryAlter = "Update aset_tmp2 set TipeAset='B';";
    $ExeQuery = $DBVAR->query ($queryAlter) or die($DBVAR->error ());

    $queryLog = "replace into aset_tmp2 (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                 kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
                                                 AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
                                                 NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
                                                 NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
                                                 select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'B',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
                                                       a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                       a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                       a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
                                                       if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), 
                                                       if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis,a.TahunPenyusutan 
                                                 from log_mesin a
                                                 inner join mesin t on t.Aset_ID=a.Aset_ID
                                                 inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                                 where (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp' and a.TglPerubahan>'$TglPerubahan_temp'"
        . "                          order by a.log_id desc";
    $ExeQuery = $DBVAR->query ($queryLog) or die($DBVAR->error ());

    $queryLog = "replace into aset_tmp (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
              TglPembukuan, kodeData, kodeKA,TipeAset,kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
              NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, 
              MerkMesin, JumlahMesin, Material, NoSeri, NoRangka, NoMesin, NoSTNK, TglSTNK, 
              NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, NegaraAsal, NegaraRakit, 
              Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan) 
      select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),
              lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, 
              a.kodeData, a.kodeKA, 'B',a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
              a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, 
              a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, 
a.NoSeri, a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen,
a.Pabrik, a.TahunBuat, a.BahanBakar, a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis,t.TahunPenyusutan from 
view_mutasi_mesin a inner join mesin t 
on t.Aset_ID=a.Aset_ID inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID 
and t.Aset_ID is not null and t.Aset_ID != 0
 where a.TglPerolehan <='$TglPerubahan_temp' AND a.TglSKKDH >'$TglPerubahan_temp' AND "
        . "a.TglPembukuan <='$TglPerubahan_temp' AND a.SatkerTujuan like '$kodeSatker%' "
        . "order by a.TglSKKDH desc;";
    $ExeQuery = $DBVAR->query ($queryLog) or die($DBVAR->error ());

    $flagKelompok = '02';
    $AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
					AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan <= '2008-01-01'";

    $AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=300000 OR kodeKA = '1') 
					AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <= '$TglPerubahan_temp'";
} elseif($kib == 'C') {
    $queryKib = "create temporary table aset_tmp  as
                                                 select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                       a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                       a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                       a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan
                                                 from bangunan a
                                                 where  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp'";
    $ExeQuery = $DBVAR->query ($queryKib) or die($DBVAR->error ());

    $queryAlter = "ALTER table aset_tmp add primary key(Bangunan_ID)";
    $ExeQuery = $DBVAR->query ($queryAlter) or die($DBVAR->error ());

    $queryAlter = "Update aset_tmp set TipeAset='C';";
    $ExeQuery = $DBVAR->query ($queryAlter) or die($DBVAR->error ());


    $queryLog = "replace into aset_tmp (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                  kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
                                                  CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
                                                  NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
                                                  KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
                                            select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'C',
                                                  a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                  a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                  a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                  a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
                                                  if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis,a.TahunPenyusutan  
                                            from log_bangunan a
                                            inner join bangunan t on t.Aset_ID=a.Aset_ID
                                            inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                            where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp' and a.TglPerubahan>'$TglPerubahan_temp' "
        . ""
        . "    order by a.log_id desc";

    $ExeQuery = $DBVAR->query ($queryLog) or die($DBVAR->error ());

    $queryLog = "replace into aset_tmp (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
           TglPembukuan, kodeData, kodeKA, TipeAset,kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat,
           Info, AsalUsul, kondisi, CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, 
           Lantai, LangitLangit, Atap, NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, 
           Tmp_Tingkat, Tmp_Beton, Tmp_Luas, KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, 
           AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan) 
        select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, 
           a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
           a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA,'C', a.kodeRuangan,
           a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan,
           a.TglPakai, a.Konstruksi, a.Beton, a.
JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, a.NoSurat, 
a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, 
a.Tmp_Beton, a.Tmp_Luas, a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, 
a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis ,t.TahunPenyusutan
from view_mutasi_bangunan a inner join bangunan t on t.Aset_ID=a.Aset_ID 
inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 
where a.TglPerolehan <='$tgl_perubahan' AND a.TglSKKDH >'$TglPerubahan_temp' AND a.TglPembukuan <='$TglPerubahan_temp' "
        . "AND a.SatkerTujuan like '$kodeSatker%' order by a.TglSKKDH desc";
    $ExeQuery = $DBVAR->query ($queryLog) or die($DBVAR->error ());
    //untuk tabel temp selanjutnya

    $queryKib = "create temporary table aset_tmp2  as
                                                 select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                       a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                       a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                       a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis  ,a.TahunPenyusutan
                                                 from bangunan a
                                                 where  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp'";
    $ExeQuery = $DBVAR->query ($queryKib) or die($DBVAR->error ());

    $queryAlter = "ALTER table aset_tmp2 add primary key(Bangunan_ID)";
    $ExeQuery = $DBVAR->query ($queryAlter) or die($DBVAR->error ());

    $queryAlter = "Update aset_tmp2 set TipeAset='C';";
    $ExeQuery = $DBVAR->query ($queryAlter) or die($DBVAR->error ());


    $queryLog = "replace into aset_tmp2 (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                  kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
                                                  CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
                                                  NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
                                                  KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
                                            select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'C',
                                                  a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                  a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                  a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                  a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
                                                  if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis  ,a.TahunPenyusutan
                                            from log_bangunan a
                                            inner join bangunan t on t.Aset_ID=a.Aset_ID
                                            inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                            where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp' and a.TglPerubahan>'$TglPerubahan_temp' "
        . "   order by a.log_id desc";
    $ExeQuery = $DBVAR->query ($queryLog) or die($DBVAR->error ());

    $queryLog = "replace into aset_tmp (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
           TglPembukuan, kodeData, kodeKA, TipeAset,kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat,
           Info, AsalUsul, kondisi, CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, 
           Lantai, LangitLangit, Atap, NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, 
           Tmp_Tingkat, Tmp_Beton, Tmp_Luas, KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, 
           AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan) 
        select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, 
           a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
           a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA,'C', a.kodeRuangan,
           a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan,
           a.TglPakai, a.Konstruksi, a.Beton, a.
JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, a.NoSurat, 
a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, 
a.Tmp_Beton, a.Tmp_Luas, a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, 
a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis ,t.TahunPenyusutan
from view_mutasi_bangunan a inner join bangunan t on t.Aset_ID=a.Aset_ID 
inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 
where a.TglPerolehan <='$tgl_perubahan' AND a.TglSKKDH >'$TglPerubahan_temp' AND a.TglPembukuan <='$TglPerubahan_temp' "
        . "AND a.SatkerTujuan like '$kodeSatker%' order by a.TglSKKDH desc";
    $ExeQuery = $DBVAR->query ($queryLog) or die($DBVAR->error ());

    $flagKelompok = '03';
    $AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
					AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan <= '2008-01-01'";

    $AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=10000000 OR kodeKA = '1') 
					AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <= '$TglPerubahan_temp'";
} elseif($kib == 'D') {
    $queryKib = "create temporary table aset_tmp as
                                           select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData,  'TipeAset',
                                                 a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
                                                 a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
                                                 a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
                                                 a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan  
                                           from jaringan a
                                           where  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp'";
    $ExeQuery = $DBVAR->query ($queryKib) or die($DBVAR->error ());

    $queryAlter = "ALTER table aset_tmp add primary key(Jaringan_ID)";
    $ExeQuery = $DBVAR->query ($queryAlter) or die($DBVAR->error ());

    $queryAlter = "Update aset_tmp set TipeAset='D';";
    $ExeQuery = $DBVAR->query ($queryAlter) or die($DBVAR->error ());


    $queryLog = "replace into aset_tmp (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, TipeAset,
                                            kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
                                            AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
                                            NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
                                            AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
                                      select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 'D',
                                            a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
                                            a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
                                            a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
                                            if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis,a.TahunPenyusutan
                                      from log_jaringan a
                                      inner join jaringan t on t.Aset_ID=a.Aset_ID
                                      inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                      where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp' and a.TglPerubahan>'$TglPerubahan_temp' "
        . "             order by a.log_id desc";
    $ExeQuery = $DBVAR->query ($queryLog) or die($DBVAR->error ());


    $queryLog = "replace into aset_tmp (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
           TglPembukuan, kodeData, kodeKA, TipeAset,kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
           NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen,
           TglDokumen, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, 
           LuasJaringan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan) 
           select a.Jaringan_ID, a.Aset_ID, 
           a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',
           right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'D',
           a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
           a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, 
           a.TglDokumen, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, 
a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, 
a.PenyusutanPerTahun,t.UmurEkonomis,t.TahunPenyusutan from view_mutasi_jaringan a 
inner join jaringan t on t.Aset_ID=a.Aset_ID 
inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 
where a.TglPerolehan <='$TglPerubahan_temp' AND a.TglSKKDH >'$TglPerubahan_temp' AND "
        . "a.TglPembukuan <='$TglPerubahan_temp' AND a.SatkerTujuan like '$kodeSatker%' order by a.TglSKKDH desc";
    $ExeQuery = $DBVAR->query ($queryLog) or die($DBVAR->error ());

    $flagKelompok = '04';
    $AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3'
							AND a.TglPerolehan <= '$TglPerubahan_temp'";
    $AddCondtn_2 = "";
}


for ($i = 0; $i < 2; $i++) {
    switch ($i) {
        case 0:
            //kondisi untuk barang yang belum pernah penyusutan
/*            $sWhere = " WHERE $status
                ((a.AkumulasiPenyusutan IS NULL AND a.PenyusutanPerTahun IS NULL) or (a.AkumulasiPenyusutan =0 AND a.PenyusutanPerTahun =0) )

                                      AND a.kodeSatker like '$kodeSatker%' AND a.kodeKelompok like '$flagKelompok%' ";*/
            $sWhere = " WHERE $status 
                (a.AkumulasiPenyusutan IS NULL or a.AkumulasiPenyusutan =0 )
                AND a.kodeSatker like '$kodeSatker%' AND a.kodeKelompok like '$flagKelompok%' ";
            break;

        case 1:
            $thn_sblm = $newTahun - 1;
            $sWhere = " WHERE $status a.AkumulasiPenyusutan IS NOT NULL AND a.PenyusutanPerTahun IS NOT NULL  
			  AND a.kodeSatker like '$kodeSatker%' AND a.kodeKelompok like '$flagKelompok%' and a.TahunPenyusutan='$thn_sblm' ";
            break;
    }

    if($kib == 'B' || $kib == 'C') {
        $sQuery = "
                    SELECT $fieldCustom
                            FROM   $sTable 
                            INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
                            $sWhere
                            $AddCondtn_1 
                    UNION ALL
                            SELECT $fieldCustom
                            FROM   $sTable2
                            INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
                            $sWhere
                            $AddCondtn_2 ";
    } elseif($kib == 'D') {
        $sQuery = "
                    SELECT $fieldCustom
                            FROM   $sTable 
                            INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
                            $sWhere
                            $AddCondtn_1";
    }


    $ExeQuery = $DBVAR->query ($sQuery) or die($DBVAR->error ());
    //echo "$i === $sQuery\n";
    if($i == 0) {
        echo "NEW SCRIPT Penyusutan tahun berjalan untuk tahun $newTahun $kodeSatker dengan kondisi penyusutan pertama kali \n"
            . "Aset_ID \t kodeKelompok  \t NilaiPerolehan \t Tahun \t masa_manfaat \t AkumulasiPenyusutan \t NilaiBuku  \t penyusutan_per_tahun \n";

        while ($Data = $DBVAR->fetch_array ($ExeQuery)) {
            $Aset_ID = $Data[ 'Aset_ID' ];

            //proses perhitungan penyusutan
            $kodeKelompok = $Data[ 'kodeKelompok' ];
            $tmp_kode = explode (".", $kodeKelompok);
            $NilaiPerolehan = $Data[ 'NilaiPerolehan' ];
            $Tahun = $Data[ 'Tahun' ];
            $kodeSatker = $Data[ 'kodeSatker' ];
            $masa_manfaat = cek_masamanfaat ($tmp_kode[ 0 ], $tmp_kode[ 1 ], $tmp_kode[ 2 ], $DBVAR);
            //select field dan value tabel kib
            if($Data[ 'TipeAset' ] == 'B') {
                $tableKib = 'mesin';
                $tableLog = 'log_mesin';
            } elseif($Data[ 'TipeAset' ] == 'C') {
                $tableKib = 'bangunan';
                $tableLog = 'log_bangunan';
            } elseif($Data[ 'TipeAset' ] == 'D') {
                $tableKib = 'jaringan';
                $tableLog = 'log_jaringan';
            }

            //pembuatan log penyusutan terlebih dahulu == dengan mengambil nilai dari tabel master
            $data_log = array( "NilaiPerolehan_Awal" => $NilaiPerolehan,
                "AkumulasiPenyusutan" => 0,
                "PenyusutanPerTahun" => 0,
                "AkumulasiPenyusutan_Awal" => 0,
                "PenyusutanPerTahun_Awal" => 0,
                "NilaiBuku_Awal" => $NilaiPerolehan,
                "NilaiBuku" => $NilaiPerolehan,
                "kodeSatker" => $kodeSatker );
            log_penyusutan ($Aset_ID, $tableKib, 49, $newTahun-1, $data_log, $DBVAR);
            //akhir pembuatan log penyusutan

            if($masa_manfaat != "") {
                $penyusutan_per_tahun = round ($NilaiPerolehan / $masa_manfaat);
                $Tahun_Aktif = $tahun;
                // $Tahun_Aktif= $tahun - 1;
                $rentang_tahun_penyusutan = ($Tahun_Aktif - $Tahun) + 1;
                if($rentang_tahun_penyusutan >= $masa_manfaat) {
                    $AkumulasiPenyusutan = $NilaiPerolehan;
                    $NilaiBuku = 0;
                    $UmurEkonomis = 0;
                } else {
                    $AkumulasiPenyusutan = $rentang_tahun_penyusutan * $penyusutan_per_tahun;
                    $NilaiBuku = $NilaiPerolehan - $AkumulasiPenyusutan;
                    $UmurEkonomis = $masa_manfaat - $rentang_tahun_penyusutan;
                }

                //update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat
                $QueryAset = "UPDATE aset SET MasaManfaat = '$masa_manfaat' ,
                                AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                PenyusutanPerTaun = '$penyusutan_per_tahun',
                                NilaiBuku = '$NilaiBuku',
                                UmurEkonomis = '$UmurEkonomis',
                                WHERE Aset_ID = '$Aset_ID'";
                $ExeQueryAset = $DBVAR->query ($QueryAset);
                //untuk log txt
                echo "$Aset_ID \t $kodeKelompok \t $NilaiPerolehan \t $Tahun \t $masa_manfaat \t $AkumulasiPenyusutan \t $NilaiBuku  \t $penyusutan_per_tahun \n";

                //update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat,NilaiBuku



                if($Data[ 'TipeAset' ] == 'B') {
                    $tableKib = 'mesin';
                    $tableLog = 'log_mesin';
                    $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
                                            AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                            PenyusutanPerTahun = '$penyusutan_per_tahun',
                                            NilaiBuku = '$NilaiBuku',
                                            UmurEkonomis = '$UmurEkonomis',
                                            TahunPenyusutan='$tahun'
                                            WHERE Aset_ID = '$Aset_ID'";
                    $ExeQueryKib = $DBVAR->query ($QueryKib);

                    //update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
                    /*$QueryKib = "UPDATE $tableLog SET MasaManfaat = '$masa_manfaat' ,
                                            AkumulasiPenyusutan = '$AkumulasiPenyusutan',
                                            PenyusutanPerTahun = '$penyusutan_per_tahun',
                                            NilaiBuku = '$NilaiBuku',
                                            UmurEkonomis = '$UmurEkonomis',
                                            TahunPenyusutan='$tahun'
                                            WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan_awal' ";*/
                    $ExeQueryKib = $DBVAR->query ($QueryKib);
                } elseif($Data[ 'TipeAset' ] == 'C') {
                    $tableKib = 'bangunan';
                    $tableLog = 'log_bangunan';
                    $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
                                            AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                            PenyusutanPerTahun = '$penyusutan_per_tahun',
                                            NilaiBuku = '$NilaiBuku',
                                            UmurEkonomis = '$UmurEkonomis',
                                            TahunPenyusutan='$tahun'
                                            WHERE Aset_ID = '$Aset_ID'";
                    $ExeQueryKib = $DBVAR->query ($QueryKib);

                    //update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
                   /* $QueryKib = "UPDATE $tableLog SET MasaManfaat = '$masa_manfaat' ,
                                            AkumulasiPenyusutan = '$AkumulasiPenyusutan',
                                            PenyusutanPerTahun = '$penyusutan_per_tahun',
                                            NilaiBuku = '$NilaiBuku',
                                            UmurEkonomis = '$UmurEkonomis'
                                            WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan_awal' ";*/
                    $ExeQueryKib = $DBVAR->query ($QueryKib);
                } elseif($Data[ 'TipeAset' ] == 'D') {
                    $tableKib = 'jaringan';
                    $tableLog = 'log_jaringan';
                    $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
                                     AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                     PenyusutanPerTahun = '$penyusutan_per_tahun',
                                     NilaiBuku = '$NilaiBuku',
                                     UmurEkonomis = '$UmurEkonomis',
                                     TahunPenyusutan='$tahun'
                                     WHERE Aset_ID = '$Aset_ID'";
                    $ExeQueryKib = $DBVAR->query ($QueryKib);

                    //update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
                   /* $QueryKib = "UPDATE $tableLog SET MasaManfaat = '$masa_manfaat' ,
                                     AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                     PenyusutanPerTahun = '$penyusutan_per_tahun',
                                     NilaiBuku = '$NilaiBuku',
                                     UmurEkonomis = '$UmurEkonomis',
                                     TahunPenyusutan='$tahun'
                                     WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan_awal' ";*/
                    $ExeQueryKib = $DBVAR->query ($QueryKib);
                }


                //pembuatan log final penyusutan terlebih dahulu == dengan mengambil nilai dari tabel master
                $data_log = array( "NilaiPerolehan_Awal" => $NilaiPerolehan,
                    "AkumulasiPenyusutan_Awal" => 0,
                    "PenyusutanPerTahun_Awal" => 0,
                    "NilaiBuku_Awal" => $NilaiPerolehan,
                    "kodeSatker" => $kodeSatker );
                log_penyusutan ($Aset_ID, $tableKib, 50, $newTahun, $data_log, $DBVAR);
                //akhir pembuatan log penyusutan
            }
        }
    } else {
        echo "NEW SCRIPT Penyusutan tahun berjalan untuk tahun $newTahun $kodeSatker dengan kondisi penyusutan kedua kali (log ada di log_penyusutan) \n"
            . "Aset_ID \t kodeKelompok  \t NilaiPerolehan \t Tahun \t masa_manfaat \t AkumulasiPenyusutan \t NilaiBuku  \t penyusutan_per_tahun \n";
        while ($Data = $DBVAR->fetch_array ($ExeQuery)) {
            $status_transaksi = 0;
            $Aset_ID = $Data[ 'Aset_ID' ];
            //$Aset_ID=$DATA->Aset_ID;
            $kodeKelompok = $Data[ 'kodeKelompok' ];
            $tmp_kode = explode (".", $kodeKelompok);
            $NilaiPerolehan = $Data[ 'NilaiPerolehan' ];
            $kodeSatker = $Data[ 'kodeSatker' ];
            $Tahun = $Data[ 'Tahun' ];

            $AkumulasiPenyusutan = $Data[ 'AkumulasiPenyusutan' ];
            $PenyusutanPerTahun = $Data[ 'PenyusutanPerTahun' ];
            $PenyusutanPerTahun_sblm = $Data[ 'PenyusutanPerTahun' ];
            $NilaiBuku = $Data[ 'NilaiBuku' ];

            $MasaManfaat = $Data[ 'MasaManfaat' ];
            $UmurEkonomis = $Data[ 'UmurEkonomis' ];
            $masa_manfaat = cek_masamanfaat ($tmp_kode[ 0 ], $tmp_kode[ 1 ], $tmp_kode[ 2 ], $DBVAR);


            switch ($kib) {
                case 'B':
                    $tableKib = "mesin";
                    $tableLog = "log_mesin";
                    break;
                case 'C':
                    $tableKib = "bangunan";
                    $tableLog = "log_bangunan";
                    break;
                case 'D':
                    $tableKib = "jaringan";
                    $tableLog = "log_jaringan";
                    break;

                default:
                    break;
            }

            //query untuk log sblm penyusutan
            $TahunPenyusutan_log = $newTahun - 1;
            $query_log_sblm = "select log_id,kodeKelompok,kodeSatker,Aset_ID,NilaiPerolehan,NilaiPerolehan_Awal,Tahun,Kd_Riwayat,"
                . "(NilaiPerolehan-NilaiPerolehan_Awal) as selisih,"
                . " AkumulasiPenyusutan_Awal,NilaiBuku,NilaiBuku_Awal,PenyusutanPerTahun_Awal,MasaManfaat,UmurEkonomis,TahunPenyusutan "
                . " from $tableLog where TahunPenyusutan='$TahunPenyusutan_log' and kd_riwayat in (50,51,52,55) "
                . "and Aset_ID='$Aset_ID' and (TglPerubahan is not null or TglPerubahan!='0000-00-00')
                  order by log_id desc limit 1 ";
            echo "$query_log_sblm\n";
            $qlog_sblm = $DBVAR->query ($query_log_sblm) or die($DBVAR->error ());
            $AkumulasiPenyusutan_Awal = 0;
            $NilaiBuku_Awal = 0;
            $PenyusutanPerTahun_Awal = 0;
            $status_data_lama=0;
            while ($Data_Log_Sblm = $DBVAR->fetch_object ($qlog_sblm)) {
                $AkumulasiPenyusutan_Awal = $Data_Log_Sblm->AkumulasiPenyusutan_Awal;
                $NilaiBuku_Awal_penyusutan = $Data_Log_Sblm->NilaiBuku;
                $PenyusutanPerTahun_Awal = $Data_Log_Sblm->PenyusutanPerTahun_Awal;
                $NilaiPerolehan_Awal = $Data_Log_Sblm->NilaiPerolehan;
                $status_data_lama=1;

            }
            if($status_data_lama==0){
                echo "Tidak ada data lama $Aset_ID \n";
                $query_log_sblm = "select log_id,kodeKelompok,kodeSatker,Aset_ID,NilaiPerolehan,NilaiPerolehan_Awal,Tahun,Kd_Riwayat,"
                    . "(NilaiPerolehan-NilaiPerolehan_Awal) as selisih,"
                    . " AkumulasiPenyusutan_Awal,NilaiBuku,NilaiBuku_Awal,PenyusutanPerTahun_Awal,MasaManfaat,UmurEkonomis,TahunPenyusutan "
                    . " from $tableLog where TahunPenyusutan='$TahunPenyusutan_log' and kd_riwayat 
                            not in (4) "
                    . "and Aset_ID='$Aset_ID' and (TglPerubahan is not null 
                    or TglPerubahan!='0000-00-00')
                  order by log_id desc limit 1 ";
                $qlog_sblm = $DBVAR->query ($query_log_sblm) or die($DBVAR->error ());
                $AkumulasiPenyusutan_Awal = 0;
                $NilaiBuku_Awal = 0;
                $PenyusutanPerTahun_Awal = 0;

                while ($Data_Log_Sblm = $DBVAR->fetch_object ($qlog_sblm)) {
                    $AkumulasiPenyusutan_Awal = $Data_Log_Sblm->AkumulasiPenyusutan_Awal;
                    $NilaiBuku_Awal_penyusutan = $Data_Log_Sblm->NilaiBuku;
                    $PenyusutanPerTahun_Awal = $Data_Log_Sblm->PenyusutanPerTahun_Awal;
                    $NilaiPerolehan_Awal = $Data_Log_Sblm->NilaiPerolehan;
                }
            }
          /*  $data_log = array( "NilaiPerolehan_Awal" => $NilaiPerolehan,
                "NilaiBuku_Awal" => $NilaiBuku,
                "AkumulasiPenyusutan_Awal" => $AkumulasiPenyusutan,
                "PenyusutanPerTahun_Awal" => $PenyusutanPerTahun,
                "kodeSatker" => $kodeSatker );
            log_penyusutan ($Aset_ID, $tableKib, 49, $newTahun, $data_log, $DBVAR);*/

            //pembuatan log penyusutan terlebih dahulu == dengan mengambil nilai dari tabel master
            $data_log = array( "NilaiPerolehan_Awal" => $NilaiPerolehan,
                "AkumulasiPenyusutan" => $AkumulasiPenyusutan,
                "PenyusutanPerTahun" => $PenyusutanPerTahun,
                "AkumulasiPenyusutan_Awal" => $AkumulasiPenyusutan,
                "PenyusutanPerTahun_Awal" => $PenyusutanPerTahun,
                "NilaiBuku_Awal" => $NilaiPerolehan,
                "NilaiBuku" => $NilaiBuku,
                "kodeSatker" => $kodeSatker );
            log_penyusutan ($Aset_ID, $tableKib, 49, $newTahun-1, $data_log, $DBVAR);
            //akhir pembuatan log penyusutan



            //akhir untuk log sblm penyusutan
            //   pr($Data_Log_Sblm);
            //  echo "NilaiPerolehan Awal==$NilaiPerolehan_Awal | $Aset_ID \n";


            //untuk mengecek bila ada trasaksi
            /* $query_perubahan="select kd_riwayat,log_id,kodeKelompok,kodeSatker,Aset_ID,"
                     . "NilaiPerolehan,NilaiPerolehan_Awal,Tahun,Kd_Riwayat,"
                     . "(NilaiPerolehan-NilaiPerolehan_Awal) as selisih,AkumulasiPenyusutan,"
                     . "PenyusutanPerTahun,NilaiBuku,MasaManfaat,UmurEkonomis,TahunPenyusutan "
                     . " from $tableLog where TglPerubahan>'$TglPerubahan_awal' and kd_riwayat in (2,21,28,7) "
                     . " "
                     . "and Aset_ID='$Aset_ID' order by log_id asc";*/

            $query_perubahan = "select kd_riwayat,log_id,kodeKelompok,kodeSatker,Aset_ID,"
                . "NilaiPerolehan,NilaiPerolehan_Awal,Tahun,Kd_Riwayat,"
                . "sum((NilaiPerolehan-NilaiPerolehan_Awal)) as selisih,AkumulasiPenyusutan,"
                . "PenyusutanPerTahun,NilaiBuku,MasaManfaat,UmurEkonomis,TahunPenyusutan "
                . " from $tableLog where TglPerubahan>'$TglPerubahan_awal' "
                . "and kd_riwayat in (2,291) "
                . " "
                . "and Aset_ID='$Aset_ID'";

            $count = 0;
            $qlog = $DBVAR->query ($query_perubahan) or die($DBVAR->error ());
            $kapitalisasi = 0;
            $status_transaksi = 0;
            $selisih=0;
            while ($Data_Log = $DBVAR->fetch_object ($qlog)) {
                echo "masuk-logg \n";
                $log_id = $Data_Log->log_id;
                $status_transaksi = 1;
                $kd_riwayat = $Data_Log->kd_riwayat;
                $Nilai_Perolehan_log = $Data_Log->NilaiPerolehan;
                $selisih =$selisih+ $Data_Log->selisih;
                $Tahun = $Data[ 'Tahun' ];
                $nb_buku_log = $Data_Log->NilaiBuku;

                $AkumulasiPenyusutan_Awal = $Data_Log->AkumulasiPenyusutan;
                $PenyusutanPerTahun_Awal = $Data_Log->PenyusutanPerTahun;
                $NilaiBuku_Awal = $NilaiBuku_Awal_penyusutan;
                //pr($data_log);
                //ambil dari tabel live
                list($AkumulasiPenyusutan, $UmurEkonomis, $MasaManfaat, $NilaiBuku, $PenyusutanPerTahun_Awal, $NilaiPerolehan) = get_data_akumulasi_from_eksisting ($Aset_ID, $DBVAR);

                $TahunPenyusutan = $Data_Log->TahunPenyusutan;
                $kodeKelompok_log = $Data[ 'kodeKelompok' ];
                $tmp_kode_log = explode (".", $kodeKelompok_log);
                // $kd_riwayat=$Data_Log->kd_riwayat;

                $log_id = $Data_Log->log_id;

                $status_perubahan_kap = 0;

                $count++;

            }

            //cek kapitalisasi
            if($selisih > 0) {
                //$NilaiYgDisusutkan=$nb_buku_log+$selisih;


                $NilaiYgDisusutkan = $NilaiBuku;
                $persen = ($selisih / $NilaiPerolehan_Awal) * 100;
                $penambahan_masa_manfaat = overhaul ($tmp_kode_log[ 0 ], $tmp_kode_log[ 1 ], $tmp_kode_log[ 2 ], $persen, $DBVAR);
                $Umur_Ekonomis_Final = $UmurEkonomis + $penambahan_masa_manfaat;

                $UmurEkonomis_Awal=$UmurEkonomis;
                $MasaManfaat = cek_masamanfaat ($tmp_kode_log[ 0 ], $tmp_kode_log[ 1 ], $tmp_kode_log[ 2 ], $DBVAR);

                $UmurEkonomis = $MasaManfaat - ((2014 - $Tahun) + 1);//untuk sementara waktu

                if($Umur_Ekonomis_Final > $MasaManfaat) {
                    $Umur_Ekonomis_Final = $MasaManfaat;
                }

                $PenyusutanPerTahun_hasil = round ($NilaiYgDisusutkan / $Umur_Ekonomis_Final);
                $AkumulasiPenyusutan_hasil = $AkumulasiPenyusutan + $PenyusutanPerTahun_hasil;
                $NilaiBuku_hasil = $NilaiPerolehan - $AkumulasiPenyusutan_hasil;
                $Sisa_Masa_Manfaat = $Umur_Ekonomis_Final - 1;


                if($Sisa_Masa_Manfaat <= 0) {
                    $NilaiBuku_hasil = 0;
                    $AkumulasiPenyusutan_hasil = $NP;
                    $Sisa_Masa_Manfaat = 0;
                }


                $cetak_informasi="\n------AWAL KAPITALISASI TahunPenyusutan $newTahun------\n".
                    "Data Kapitalisasi untuk Aset_ID=$Aset_ID\n Data Awal \n"
                    . "NilaiPerolehan = $NilaiPerolehan_Awal\n"
                    . "Masa Manfaat= $MasaManfaat\n"
                    . "Umur Ekonomis= $UmurEkonomis_Awal \n"
                    . "AkumulasiPenyusutan $AkumulasiPenyusutan \n"
                    . "NilaiBuku=$nb_buku_log\n"
                    . "----NILAI KAPITALISASI $Aset_ID ---"
                    . "Nilai Kapitalisasi = $selisih \n"
                    . "Persentase =$persen --> ($selisih / $NilaiPerolehan_Awal) * 100\n"
                    . "Penambahan masa Manfaat $penambahan_masa_manfaat\n"
                    . "Umur Ekonomis Final $Umur_Ekonomis_Final\n"
                    . "Nilai Yang Disusutkan $NilaiYgDisusutkan -->$NilaiBuku \n"
                    . "Beban Penyusutan $PenyusutanPerTahun_hasil -->(( $NilaiYgDisusutkan/$Umur_Ekonomis_Final ))\n"
                    . "----FINAL----\n"
                    . "Nilai Perolehan $NilaiPerolehan \n"
                    . "Akumulasi Penyusutan Akhir $AkumulasiPenyusutan_hasil-->($AkumulasiPenyusutan+$PenyusutanPerTahun_hasil) \n"
                    . "Nilai Buku Akhir $NilaiBuku_hasil--> ($NilaiPerolehan-$AkumulasiPenyusutan_hasil)\n"
                    . "Umur Ekonomis Akhir $Sisa_Masa_Manfaat\n"
                    . "-------AKHIR KAPITALISASI $Aset_ID----\n\n";
                echo $cetak_informasi;

                //update aset dan update log untuk kapitalisasi
                $QueryAset = "UPDATE aset SET MasaManfaat = '$MasaManfaat' ,
                                            AkumulasiPenyusutan = '$AkumulasiPenyusutan_hasil',	
                                            PenyusutanPerTaun = '$PenyusutanPerTahun_hasil',
                                            NilaiBuku = '$NilaiBuku_hasil',
                                            UmurEkonomis = '$Sisa_Masa_Manfaat',
                                             TahunPenyusutan='$newTahun',
                                            perhitungan_penyusutan='$cetak_informasi',
                                            nilai_kapitalisasi='$selisih',
                                            penambahan_masa_manfaat='$penambahan_masa_manfaat',
                                            prosentase='$persen'    
                                            WHERE Aset_ID = '$Aset_ID'";
                $ExeQueryAset = $DBVAR->query ($QueryAset) or die($DBVAR->error ());;
                $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$MasaManfaat' ,
                                            AkumulasiPenyusutan = '$AkumulasiPenyusutan_hasil',	
                                            PenyusutanPerTahun = '$PenyusutanPerTahun_hasil',
                                            NilaiBuku = '$NilaiBuku_hasil',
                                            UmurEkonomis = '$Sisa_Masa_Manfaat',
                                            TahunPenyusutan='$newTahun',
                                            perhitungan_penyusutan='$cetak_informasi',
                                            nilai_kapitalisasi='$selisih',
                                            penambahan_masa_manfaat='$penambahan_masa_manfaat',
                                            prosentase='$persen'    
                                          
                                            WHERE Aset_ID = '$Aset_ID'";
                $ExeQueryKib = $DBVAR->query ($QueryKib) or die($DBVAR->error ());;
                //akhir update aset dan update log untuk kapitalisasi
                // $data_log[]="";
                //update log penyusutan
                log_penyusutan ($Aset_ID, $tableKib, 51, $newTahun, $data_log, $DBVAR);


                $data_penyusutan = array( 'id' => NULL, 'Aset_ID' => "$Aset_ID",
                    'kodeKelompok' => "$kodeKelompok",
                    'kodeSatker' => "$kodeSatker",
                    'Tahun' => "$Tahun",
                    'NilaiPerolehan' => "$NilaiPerolehan",
                    'MasaManfaat' => "$MasaManfaat_Final",
                    'NilaiBuku' => "$NilaiBuku_hasil",
                    'info' => "$kd_riwayat | Kapitalisasi",
                    'log_id' => "0",
                    'perhitungan' => "$cetak_informasi",
                    'TahunPenyusutan' => "$newTahun",
                    'changeDate' => date ('Y-m-d'), 'StatusTampil' => '1' );

                catatan_hasil_penyusutan ($data_penyusutan, $DBVAR);
                //akhir update log penyusutan
                $kapitalisasi++;
            } else {
                $status_transaksi = 0;
            }

            //akhir cek penyusutan kapitalisasi



            echo "status_transaksi==$status_transaksi | $Aset_ID\n";
            if($status_transaksi != 1) {
                echo "tidak masuk log \n";
                //bila tidak ada transaksi
                //$PenyusutanPerTahun=$NilaiPerolehan/$MasaManfaat;
                list($a, $b, $c, $d, $PenyusutanPerTahun_Awal, $NilaiPerolehan) = get_data_akumulasi_from_eksisting ($Aset_ID, $DBVAR);

                //dibatalkan karena bisa aja ada penyusutan akibat koreksi
                //$PenyusutanPerTahun = round ($NilaiPerolehan / $masa_manfaat);

                $MasaManfaat = $masa_manfaat;
                //$rentang_tahun_penyusutan = ($newTahun-$Tahun)+1;
                $rentang_tahun_penyusutan = 1;
                //$AkumulasiPenyusutan_thn_berjalan=$rentang_tahun_penyusutan*$PenyusutanPerTahun;
                $AkumulasiPenyusutan_akhir = $AkumulasiPenyusutan + $PenyusutanPerTahun;
                $NilaiBuku_akhir = $NilaiBuku - $PenyusutanPerTahun;
                $Sisa_Masa_Manfaat = $UmurEkonomis - $rentang_tahun_penyusutan;

                if($PenyusutanPerTahun == 0) {
                    list($a, $b, $c, $d, $PenyusutanPerTahun_Awal, $NilaiPerolehan) = get_data_akumulasi_from_eksisting ($Aset_ID, $DBVAR);
                    $PenyusutanPerTahun = $PenyusutanPerTahun_Awal;
                }

                echo "----------------------------------------------\n"
                    . "Aset_ID \t=$Aset_ID\n"
                    . "kodeKelompok \t=$kodeKelompok \n"
                    . "NilaiPerolehan \t=$NilaiPerolehan \n"
                    . "TahunPerolehan \t=$Tahun\n "
                    . "MasaManfaat \t=$MasaManfaat\n "
                    . "AkumulasiPenyusutan \t=$AkumulasiPenyusutan_akhir\n"
                    . "AkumulasiPenyusutan_Sblm \t=$AkumulasiPenyusutan\n"
                    . "Sisa Masa Manfaat Sblm \t $UmurEkonomis\n"
                    . "NilaiBUku \t= $NilaiBuku_akhir\n"
                    . "NilaiBUku_Awal \t=$NilaiBuku_Awal_penyusutan\n"
                    . "NilaiBUku_Sblm \t=$NilaiBuku\n"
                    . "PenyusutanPerTahun \t=$PenyusutanPerTahun \n"
                    . "PenyusutanPerTahun_sblm \t=$PenyusutanPerTahun_sblm\n"
                    . "UmurEkonomis \t=$Sisa_Masa_Manfaat\n\n";


                //echo "$Aset_ID \t $kodeKelompok \t $NilaiPerolehan \t $Tahun \t $MasaManfaat \t $AkumulasiPenyusutan \t $NilaiBuku  \t $PenyusutanPerTahun $Kd_Riwayat \n";

                $perhitungan = "PenyusutanPerTahun=$NilaiBuku/$MasaManfaat;\n"
                    . "rentang_tahun_penyusutan = 1;\n"
                    . "AkumulasiPenyusutan=$AkumulasiPenyusutan+$PenyusutanPerTahun;\n"
                    . "NilaiBuku=$NilaiBuku-$PenyusutanPerTahun;\n"
                    . "Sisa_Masa_Manfaat=$UmurEkonomis-$rentang_tahun_penyusutan;\n";
                echo "$perhitungan\n"
                    . "----------------------------------------------\n";

                if($Sisa_Masa_Manfaat <= 0) {
                    $AkumulasiPenyusutan_akhir = $NilaiPerolehan;
                    $NilaiBuku_akhir = 0;
                    $Sisa_Masa_Manfaat = 0;
                }

                //update aset  dan kib
                $QueryAset = "UPDATE aset SET MasaManfaat = '$MasaManfaat' ,
                                               AkumulasiPenyusutan = '$AkumulasiPenyusutan_akhir',	
                                               PenyusutanPerTaun = '$PenyusutanPerTahun',
                                               NilaiBuku = '$NilaiBuku_akhir',
                                               UmurEkonomis = '$Sisa_Masa_Manfaat',
                                                TahunPenyusutan='$newTahun'     
                                               WHERE Aset_ID = '$Aset_ID'";
                $ExeQueryAset = $DBVAR->query ($QueryAset) or die($DBVAR->error ());;
                $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$MasaManfaat' ,
                                               AkumulasiPenyusutan = '$AkumulasiPenyusutan_akhir',	
                                               PenyusutanPerTahun = '$PenyusutanPerTahun',
                                               NilaiBuku = '$NilaiBuku_akhir',
                                               UmurEkonomis = '$Sisa_Masa_Manfaat',
                                               TahunPenyusutan='$newTahun'
                                               WHERE Aset_ID = '$Aset_ID'";
                $ExeQueryKib = $DBVAR->query ($QueryKib) or die($DBVAR->error ());;
                //akhir update aset dan kib

                //update log penyusutan
                $log_id = log_penyusutan ($Aset_ID, $tableKib, 50, $newTahun, $data_log, $DBVAR);
                //akhir update log penyusutan


                $data_penyusutan = array( 'id' => NULL, 'Aset_ID' => "$Aset_ID",
                    'kodeKelompok' => "$kodeKelompok",
                    'kodeSatker' => "$kodeSatker",
                    'Tahun' => "$Tahun",
                    'NilaiPerolehan' => "$NilaiPerolehan",
                    'MasaManfaat' => "$MasaManfaat",
                    'NilaiBuku' => "$NilaiBuku_akhir",
                    'info' => "biasa",
                    'log_id' => '0',
                    'perhitungan' => "$perhitungan",
                    'TahunPenyusutan' => "$newTahun",
                    'changeDate' => date ('Y-m-d'), 'StatusTampil' => '1' );

                catatan_hasil_penyusutan ($data_penyusutan, $DBVAR);
            }


        }

    }

}
//update table status untuk penyusutan
$query = "update penyusutan_tahun_berjalan  set StatusRunning=2 where id=$id";

$DBVAR->query ($query) or die($DBVAR->error ());

function cek_masamanfaat($kd_aset1, $kd_aset2, $kd_aset3, $DBVAR)
{
    $query = "select * from ref_masamanfaat where kd_aset1='$kd_aset1' "
        . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
    $result = $DBVAR->query ($query) or die($DBVAR->error ());
    while ($row = $DBVAR->fetch_object ($result)) {
        $masa_manfaat = $row->masa_manfaat;
    }
    return $masa_manfaat;
}

function overhaul($kd_aset1, $kd_aset2, $kd_aset3, $persen, $DBVAR)
{
    $kd_aset1 = intval ($kd_aset1);
    $kd_aset2 = intval ($kd_aset2);
    $kd_aset3 = intval ($kd_aset3);
    $query = "select * from re_masamanfaat_tahun_berjalan where kd_aset1='$kd_aset1' "
        . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
    // echo "$query\n\n";
    $result = $DBVAR->query ($query) or die($query);
    while ($row = $DBVAR->fetch_object ($result)) {
        $masa_manfaat = $row->masa_manfaat;
        $prosentase1 = $row->prosentase1;
        $penambahan1 = $row->penambahan1;
        $prosentase2 = $row->prosentase2;
        $penambahan2 = $row->penambahan2;
        $prosentase3 = $row->prosentase3;
        $penambahan3 = $row->penambahan3;
        $prosentase4 = $row->prosentase4;
        $penambahan4 = $row->penambahan4;
        $prosentase5 = $row->prosentase4;;
    }
    //echo "<pre> ";
    // print($prosentase3);
    if($prosentase4 != 0) {
        echo " masuk 11 $persen====$prosentase1 $prosentase2 $prosentase3 $prosentase4 \n";
        if($persen > $prosentase4) {
            echo "0 =4";
            $hasil = $penambahan4;

        } else if($persen > $prosentase3 && $persen <= $prosentase4) {
            echo "0 =3";
            $hasil = $penambahan3;
        } else if($persen > $prosentase2 && $persen <= $prosentase3) {
            echo "0 =2";
            $hasil = $penambahan2;
        } else if($persen <= $prosentase2) {
            echo "0 =1";
            $hasil = $penambahan1;
        }
    } else { 
      
      echo " masuk 00 $persen====$prosentase1 $prosentase2 $prosentase3 $prosentase4 \n";

        if($persen > $prosentase3) {
               echo "1 =3";

            $hasil = $penambahan3;
        } else if($persen > $prosentase2 && $persen <= $prosentase3) {
             echo "1 =2 ";
            $hasil = $penambahan3;
        } else if($persen > $prosentase1 && $persen <= $prosentase2) {
             echo "1 =3 ";
            $hasil = $penambahan2;
        } else if($persen <= $prosentase1) {
            echo "1 ";
            $hasil = $penambahan1;
        }

    }
    if($hasil == "")
        $hasil = 0;
    echo " prosentase $persen====$hasil \n";

    return $hasil;
}

function microtime_float()
{
    list($usec, $sec) = explode (" ", microtime ());
    return ((float)$usec + (float)$sec);
}


function log_penyusutan($Aset_ID, $tableKib, $Kd_Riwayat, $tahun, $Data, $DBVAR)
{
    //select field dan value tabel kib

    $QueryKibSelect = "SELECT * FROM $tableKib WHERE Aset_ID = '$Aset_ID'";
    $exequeryKibSelect = $DBVAR->query ($QueryKibSelect);
    $resultqueryKibSelect = $DBVAR->fetch_object ($exequeryKibSelect);

    $tmpField = array();
    $tmpVal = array();
    $sign = "'";
    if($Kd_Riwayat==49)
    {
        $ThnPenyusutan49=$tahun;
        $ThnLog=$tahun+1;
        $AddField = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal,TahunPenyusutan";


    }   else{
        $ThnLog=$tahun;
        $AddField = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal";

    }
    $action = "Penyusutan_" . $ThnLog . "_" . $Data[ 'kodeSatker' ];
    $TglPerubahan = "$ThnLog-12-31";
    $changeDate = date ('Y-m-d');
    $NilaiPerolehan_Awal = 0;
    /* $NilaiPerolehan_Awal = $Data['NilaiPerolehan_Awal'];
     if($NilaiPerolehan_Awal ==""||$NilaiPerolehan_Awal ==0){
         $NilaiPerolehan_Awal ="NULL";
     }*/
    $AkumulasiPenyusutan_Awal = $Data[ 'AkumulasiPenyusutan_Awal' ];
    if($AkumulasiPenyusutan_Awal == "" || $AkumulasiPenyusutan_Awal == "0") {
        $AkumulasiPenyusutan_Awal = "NULL";
    }

    $NilaiBuku_Awal = $Data[ 'NilaiBuku_Awal' ];
    if($NilaiBuku_Awal == "" || $NilaiBuku_Awal == "0") {
        $NilaiBuku_Awal = "NULL";
    }

    $PenyusutanPerTahun_Awal = $Data[ 'PenyusutanPerTahun_Awal' ];
    if($PenyusutanPerTahun_Awal == "" || $PenyusutanPerTahun_Awal == "0") {
        $PenyusutanPerTahun_Awal = "NULL";
    }
    foreach ($resultqueryKibSelect as $key => $val) {
        if($Kd_Riwayat==49) {
            if($key!="TahunPenyusutan"){
                $tmpField[] = $key;
                if ($val == '') {
                    $tmpVal[] = $sign . "NULL" . $sign;
                } else {
                    $tmpVal[] = $sign . addslashes($val) . $sign;
                }
            }

        }else{
            $tmpField[] = $key;
            if ($val == '') {
                $tmpVal[] = $sign . "NULL" . $sign;
            } else {
                $tmpVal[] = $sign . addslashes($val) . $sign;
            }
        }

    }
    $implodeField = implode (',', $tmpField);
    $implodeVal = implode (',', $tmpVal);

    if($Kd_Riwayat==49){
        $QueryLog = "INSERT INTO log_$tableKib ($implodeField,$AddField) VALUES"
            . "      ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','{$resultqueryKibSelect->NilaiPerolehan}',$AkumulasiPenyusutan_Awal,"
            . "$NilaiBuku_Awal,$PenyusutanPerTahun_Awal,$ThnPenyusutan49)";
    }else {
        $QueryLog = "INSERT INTO log_$tableKib ($implodeField,$AddField) VALUES"
            . "      ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','{$resultqueryKibSelect->NilaiPerolehan}',$AkumulasiPenyusutan_Awal,"
            . "$NilaiBuku_Awal,$PenyusutanPerTahun_Awal)";
    }
    $exeQueryLog = $DBVAR->query ($QueryLog) or die($DBVAR->error ());;


    return $tableLog;
}

function catatan_hasil_penyusutan($data, $DBVAR)
{
    $Aset_ID = $data[ 'Aset_ID' ];
    $kodeKelompok = $data[ 'kodeKelompok' ];
    $kodeSatker = $data[ 'kodeSatker' ];
    $Tahun = $data[ 'Tahun' ];
    $NilaiPerolehan = $data[ 'NilaiPerolehan' ];
    $MasaManfaat = $data[ 'MasaManfaat' ];
    $NilaiBuku = $data[ 'NilaiBuku' ];
    $info = $data[ 'info' ];
    $log_id = $data[ 'log_id' ];
    $perhitugan = $data[ 'perhitungan' ];
    $TahunPenyusutan = $data[ 'TahunPenyusutan' ];
    $changeDate = $data[ 'changeDate' ];

    $query = "INSERT INTO log_penyusutan (id, Aset_ID, kodeKelompok, kodeSatker, Tahun, NilaiPerolehan, "
        . "             MasaManfaat, NilaiBuku, info, log_id, perhitungan, TahunPenyusutan, changeDate,StatusTampil)"
        . " VALUES (NULL, '$Aset_ID', '$kodeKelompok', '$kodeSatker', '$Tahun', '$NilaiPerolehan', "
        . "     '$MasaManfaat', '$NilaiBuku', '$info', $log_id, '$perhitugan', '$TahunPenyusutan', '$changeDate',1);";
    $exeQueryLog = $DBVAR->query ($query) or die($DBVAR->error ());;
}

function get_data_akumulasi_from_eksisting($Aset_ID, $DBVAR)
{
    $query = "SELECT AkumulasiPenyusutan,UmurEkonomis,MasaManfaat,NilaiBuku,PenyusutanPerTaun,NilaiPerolehan FROM aset WHERE Aset_ID = '$Aset_ID' limit 1";
    $hasil = $DBVAR->query ($query);
    $data = $DBVAR->fetch_array ($hasil);
    $Akumulasi = $data[ 'AkumulasiPenyusutan' ];
    $UmurEkonomis = $data[ 'UmurEkonomis' ];
    $MasaManfaat = $data[ 'MasaManfaat' ];
    $NilaiBuku = $data[ 'NilaiBuku' ];
    $PenyusutanPerTaun = $data[ 'PenyusutanPerTaun' ];
    $NilaiPerolehan = $data[ 'NilaiPerolehan' ];
    return array( $Akumulasi, $UmurEkonomis, $MasaManfaat, $NilaiBuku, $PenyusutanPerTaun, $NilaiPerolehan );
}

function get_data_np_transfer($Aset_ID, $log_id, $table_log, $DBVAR)
{
    $query_1 = "select NilaiPerolehan from $table_log where Aset_ID='$Aset_ID' and log_id > $log_id limit 1";
    $hasil = $DBVAR->query ($query);
    $data = $DBVAR->fetch_array ($hasil);
    $NP = 0;
    $NP = $data[ 'NilaiPerolehan' ];
    if($NP == "" || $NP == "0") {
        $query_1 = "select NilaiPerolehan from aset where Aset_ID='$Aset_ID'  limit 1";
        $hasil = $DBVAR->query ($query_1);
        $data = $DBVAR->fetch_array ($hasil);
        $NP = $data[ 'NilaiPerolehan' ];
    }
    return $NP;
}

?>

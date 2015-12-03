<?php /* Smarty version Smarty-3.1.15, created on 2015-12-03 05:55:54
         compiled from "app/view/module/mengolahDataKodeSatker.html" */ ?>
<?php /*%%SmartyHeaderCode:1352072878565fd8afd27965-59157906%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da70107249917cd7ad9ef99ab582d41e468b9d3c' => 
    array (
      0 => 'app/view/module/mengolahDataKodeSatker.html',
      1 => 1449122149,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1352072878565fd8afd27965-59157906',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_565fd8afdacf62_03350583',
  'variables' => 
  array (
    'basedomain' => 0,
    'JsonDecode' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565fd8afdacf62_03350583')) {function content_565fd8afdacf62_03350583($_smarty_tpl) {?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mengolah Data Services Simbada <i>(Contoh)</i>
            <!-- <small>Daftar Aset Tetap</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <!-- <li><a href="#"> Daftar Aset Tetap</a></li> -->
            <li class="active">Kode Satker</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
         <div class="row">
              <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=1">Penjelasan</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=2">Daftar Aset Tetap</a></li>
                  <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=3">Kode Satker</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=4">Kode Kelompok</a></li>
                 
                </ul>
                <div class="tab-content">
                  <div id="tab_1" class="tab-pane active">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab_1">Get Data</a></li>
                            <li><a data-toggle="tab" href="#tab_2">Fetch Data</a></li>
                            <li><a data-toggle="tab" href="#tab_3">View Data</a></li>
                            
                          </ul>
                          <div class="tab-content">
                            <div id="tab_1" class="tab-pane active">
                              <b>Get Data Via Url:</b>
<pre style="font-weight: 600;">
&lt;?php
$url='<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/satker/?term=04.02';

$resultJsonEncode=file_get_contents($url);
?&gt;
</pre>
<b>Result :</b>

<pre style="font-weight: 600;">
{"04.02.01.01":{"Tanah":[{"Uraian":"Cina","Alamat":"Jl.HOS.COKROAMINOTO. Kuripan Lor.Kec.PKL Selatan","LuasTotal":"121150","NilaiPerolehan":"10232913295.0000"},{"Uraian":"Cina","Alamat":"JL.HOS.COKROAMINOTO.KURIPAN LOR.KEC.PKL SELATAN","LuasTotal":"22320","NilaiPerolehan":"770040000.0000"},{"Uraian":"Cina","Alamat":"JL.HOS.COKROAMINOTO.KURIPAN LOR.KEC.PKL.SELATAN","LuasTotal":"13160","NilaiPerolehan":"454020000.0000"},{"Uraian":"Cina","Alamat":"YOSOREJO KEC.PKL SELATAN","LuasTotal":"42425","NilaiPerolehan":"3676508490.0000"},{"Uraian":"Tanah Pertanian Lainnya","Alamat":"JL KURINCI KEL PODOSUGIH","LuasTotal":"960","NilaiPerolehan":"202080000.0000"},{"Uraian":"Tanah Pertanian Lainnya","Alamat":"JL KURINCI KEL PODOSUGIH","LuasTotal":"1000","NilaiPerolehan":"210500000.0000"},{"Uraian":"Tanah Pertanian Lainnya","Alamat":"JL KURINCI KEL PODOSUGIH","LuasTotal":"960","NilaiPerolehan":"202080000.0000"},{"Uraian":"Tanah Pertanian Lainnya","Alamat":"JL KURINCI KEL PODOSUGIH","LuasTotal":"475","NilaiPerolehan":"99987500.0000"},{"Uraian":"Hutan Untuk Penggunaan Khusus Lainnya","Alamat":"Kel. Degayu Pekalongan","LuasTotal":"20000","NilaiPerolehan":"400000000.0000"},{"Uraian":"Tanah Bangunan Rumah Negara Tanpa Golongan","Alamat":"JL.PEMBANGUNAN 1,3,7","LuasTotal":"650","NilaiPerolehan":"306475000.0000"},{"Uraian":"Tanah Bangunan Rumah Negara Tanpa Golongan","Alamat":"JL VETERAN","LuasTotal":"196","NilaiPerolehan":"64876000.0000"},{"Uraian":"Tanah Bangunan Rumah Negara Tanpa Golongan","Alamat":"JL VETERAN dukuh kEC pEK BARAT","LuasTotal":"391","NilaiPerolehan":"110262000.0000"},{"Uraian":"Tanah Bangunan Rumah Negara Tanpa Golongan","Alamat":"JL BAHAGIA 13.15.17.19.21.23.25","LuasTotal":"7838","NilaiPerolehan":"2210316000.0000"},{"Uraian":"Tanah Bangunan Perumahan Lain-lain","Alamat":"Jl. Hos Coroaminoto","LuasTotal":"400","NilaiPerolehan":"596462000.0000"},{"Uraian":"Tanah Bangunan Perumahan Lain-lain","Alamat":" Jl. WR Supratman","LuasTotal":"600","NilaiPerolehan":"275232000.0000"},{"Uraian":"Tanah Bangunan Perumahan Lain-lain","Alamat":"Jl. Rinjani Bendan","LuasTotal":"600","NilaiPerolehan":"1495598000.0000"},{"Uraian":"Tanah Bangunan Perumahan Lain-lain","Alamat":"Kel. Noyontaan","LuasTotal":"505","NilaiPerolehan":"205860000.0000"},{"Uraian":"Tanah Bangunan Perumahan Lain-lain","Alamat":"podosugih","LuasTotal":"113","NilaiPerolehan":"23786500.0000"},{"Uraian":"Tanah Bangunan Perumahan Lain-lain","Alamat":"kauman","LuasTotal":"80","NilaiPerolehan":"19040000.0000"},{"Uraian":"Tanah Bangunan Perumahan Lain-lain","Alamat":"Jl Tondano Poncol","LuasTotal":"882","NilaiPerolehan":"163216000.0000"},{"Uraian":"Tanah Bangunan Perumahan Lain-lain","Alamat":"Jl. Tondano poncol","LuasTotal":"530","NilaiPerolehan":"1078307000.0000"},{"Uraian":"Tanah Bangunan Perumahan Lain-lain","Alamat":"Jl. wahid Hasyim Noyontaan","LuasTotal":"2690","NilaiPerolehan":"1126811000.0000"},{"Uraian":"Tanah Bangunan Pasar","Alamat":"JL MANGA KEL SAMPANGAN","LuasTotal":"13430","NilaiPerolehan":"4297600000.0000"},{"Uraian":"Tanah Bangunan Gedung","Alamat":"JL. SRIWIJAYA","LuasTotal":"704","NilaiPerolehan":"921000000.0000"},{"Uraian":"Tanah Bangunan Gedung","Alamat":"Jl. Kurinci","LuasTotal":"517","NilaiPerolehan":"362934000.0000"},{"Uraian":"Tanah Utk Bangunan Gd. Perdagangan Lain-lain","Alamat":"Jl. Nusantara","LuasTotal":"1707.38","NilaiPerolehan":"41830810.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.VETERAN","LuasTotal":"205","NilaiPerolehan":"67855000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.JETAYU 3","LuasTotal":"3675","NilaiPerolehan":"549412500.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.VETERAN","LuasTotal":"210","NilaiPerolehan":"69510000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.TONDANO","LuasTotal":"435","NilaiPerolehan":"103530000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.SRIWIJAYA 17","LuasTotal":"1320","NilaiPerolehan":"622380000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.MAJAPAHIT","LuasTotal":"824","NilaiPerolehan":"173452000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.MAJAPAHIT","LuasTotal":"615","NilaiPerolehan":"129457500.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.BANDUNG","LuasTotal":"145","NilaiPerolehan":"46400000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"Jl. Majapahit Podosugih Kecamatan Pekalongan Barat Kota Pekalongan","LuasTotal":"1000","NilaiPerolehan":"210500000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"Jl.Rajawali Panjang Wetan","LuasTotal":"940","NilaiPerolehan":"140530000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.HOS COKROAMINOTO","LuasTotal":"1675","NilaiPerolehan":"338350000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.HOSCOKROAMINOTO","LuasTotal":"1205","NilaiPerolehan":"243410000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.PEMBANGUNAN","LuasTotal":"411","NilaiPerolehan":"565800000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.PEMBANGUNAN","LuasTotal":"1898","NilaiPerolehan":"928855000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"Jl. Sriwijaya Kel. Bendan","LuasTotal":"323","NilaiPerolehan":"307000000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"JL.VETERAN NO. 27 KELURAHAN KRATON LOR \r\nKECAMATAN PEKALONGAN UTARA","LuasTotal":"2012","NilaiPerolehan":"665972000.0000"},{"Uraian":"Tanah Bangunan Kantor Pemerintah","Alamat":"Jl. Trikora No. 38 Kel. Yosorejo Pekalongan Selatan","LuasTotal":"120","NilaiPerolehan":"6390000.0000"},{"Uraian":"Tanah Bangunan Pendidikan dan Latihan (Sekolah)","Alamat":"JL.RAJAWALI UTARA","LuasTotal":"1045","NilaiPerolehan":"156227500.0000"},{"Uraian":"Tanah Bangunan Pendidikan dan Latihan (Sekolah)","Alamat":"JL.SRIWIJAYA","LuasTotal":"17450","NilaiPerolehan":"8227675000.0000"},{"Uraian":"Tanah Bangunan Pendidikan dan Latihan (Sekolah)","Alamat":"JL.JERUK","LuasTotal":"1730","NilaiPerolehan":"553600000.0000"},{"Uraian":"Tanah Bangunan Pendidikan dan Latihan (Sekolah)","Alamat":"JL.SRIWIJAYA BENDAN","LuasTotal":"685","NilaiPerolehan":"322977500.0000"},{"Uraian":"Tanah Bangunan Pendidikan dan Latihan (Sekolah)","Alamat":"Jl. Perintis Kemerdekaan","LuasTotal":"3140","NilaiPerolehan":"696000000.0000"},{"Uraian":"Tanah Bangunan Pendidikan dan Latihan (Sekolah)","Alamat":"Jl. Kalisari Kalibanger ","LuasTotal":"1500","NilaiPerolehan":"696000000.0000"},{"Uraian":"Tanah Bangunan Pendidikan dan Latihan (Sekolah)","Alamat":"Jl. Maninjau Keputran","LuasTotal":"1398","NilaiPerolehan":"981396000.0000"},{"Uraian":"Tanah Bangunan Pendidikan dan Latihan (Sekolah)","Alamat":"Kradenan Gg 10","LuasTotal":"695","NilaiPerolehan":"71585000.0000"},{"Uraian":"Tanah Bangunan Pendidikan dan Latihan (Sekolah)","Alamat":"JL. Salak No. 31 Pekalongan","LuasTotal":"2540","NilaiPerolehan":"812800000.0000"},{"Uraian":"Tanah Bangunan Olah Raga","Alamat":"JL.JETAYU","LuasTotal":"1186","NilaiPerolehan":"177307000.0000"},{"Uraian":"Tanah Bangunan Olah Raga","Alamat":"JL.P.KEMERDEKAAN","LuasTotal":"5785","NilaiPerolehan":"1631370000.0000"},{"Uraian":"Tanah Bangunan Taman\/Wisata\/Rekreasi","Alamat":"Jl. Singosari (Majapahit)","LuasTotal":"302","NilaiPerolehan":"512205000.0000"},{"Uraian":"Tanah Bangunan Taman\/Wisata\/Rekreasi","Alamat":"Jl. Jendral Sudirman","LuasTotal":"142","NilaiPerolehan":"29784000.0000"},{"Uraian":"Tanah Bangunan Poliklinik","Alamat":"JL.VETERAN","LuasTotal":"723","NilaiPerolehan":"347550000.0000"},{"Uraian":"Tanah Bangunan Tempat Kerja Lainnya","Alamat":"JL.PEMBANGUNAN","LuasTotal":"2353","NilaiPerolehan":"1109439500.0000"},{"Uraian":"Tanah Bangunan Tempat Kerja Lainnya","Alamat":"JL.BINAGRIYA","LuasTotal":"670","NilaiPerolehan":"148070000.0000"},{"Uraian":"Tanah Bangunan Tempat Kerja Lainnya","Alamat":"Jl. Sriwijaya","LuasTotal":"526","NilaiPerolehan":"369252000.0000"},{"Uraian":"Tanah kosong yang tidak diusahakan","Alamat":"JL.SRIWIJAYA","LuasTotal":"475","NilaiPerolehan":"251739000.0000"},{"Uraian":"Tanah kosong yang tidak diusahakan","Alamat":"JL.SRIWIJAYA","LuasTotal":"475","NilaiPerolehan":"252210500.0000"},{"Uraian":"Tanah kosong yang tidak diusahakan","Alamat":"JL.SRIWIJAYA","LuasTotal":"375","NilaiPerolehan":"176812500.0000"},{"Uraian":"Tanah kosong yang tidak diusahakan","Alamat":"JL.SRIWIJAYA","LuasTotal":"510","NilaiPerolehan":"107355000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.SEJAHTERA","LuasTotal":"775","NilaiPerolehan":"243350000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.PROGO","LuasTotal":"690","NilaiPerolehan":"228390000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.PEMBANGUNAN","LuasTotal":"126","NilaiPerolehan":"41706000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.PEMBANGUNAN","LuasTotal":"100","NilaiPerolehan":"33100000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.BENDAN(BENDAN BARAT)","LuasTotal":"240","NilaiPerolehan":"113160000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.MURIYA 10(BENDAN BARAT)","LuasTotal":"300","NilaiPerolehan":"141450000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.MERAPI 7(BENDAN BARAT)","LuasTotal":"400","NilaiPerolehan":"188600000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.RINJANI 3(BENDAN BARAT)","LuasTotal":"320","NilaiPerolehan":"150880000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.MERAPI 7(BENDAN BARAT)","LuasTotal":"360","NilaiPerolehan":"169740000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.VETERAN 23","LuasTotal":"364","NilaiPerolehan":"120484000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.VETERAN GG. III","LuasTotal":"176","NilaiPerolehan":"58256000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.VETERAN GG.III","LuasTotal":"160","NilaiPerolehan":"52960000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.VETERAN 46","LuasTotal":"209","NilaiPerolehan":"69179000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.VETERAN 46 B","LuasTotal":"176","NilaiPerolehan":"58256000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.VETERAN 46 C","LuasTotal":"11.5","NilaiPerolehan":"3806500.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.KALIBANGER","LuasTotal":"5500","NilaiPerolehan":"1309000000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.PONCOL BARU","LuasTotal":"3000","NilaiPerolehan":"826500000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.JAWA","LuasTotal":"2984","NilaiPerolehan":"987704000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.KARIMUNJAWA","LuasTotal":"1478","NilaiPerolehan":"489218000.0000"},{"Uraian":"Tanah kosong yang sudah diperuntukkan","Alamat":"JL.WILIS PODOSUGIH","LuasTotal":"5631","NilaiPerolehan":"1241661500.0000"},{"Uraian":"Tanah Kosong Lainnya","Alamat":"JL.PODOSUGIH","LuasTotal":"960","NilaiPerolehan":"202080000.0000"},{"Uraian":"Tanah Kosong Lainnya","Alamat":"JL.PODOSUGIH","LuasTotal":"475","NilaiPerolehan":"99987500.0000"},{"Uraian":"Tanah Kosong Lainnya","Alamat":"JL.PODOSUGIH","LuasTotal":"475","NilaiPerolehan":"99987500.0000"},{"Uraian":"Tanah Kosong Lainnya","Alamat":"JL.PODOSUGIH","LuasTotal":"375","NilaiPerolehan":"78937500.0000"},{"Uraian":"Tanah Kosong Lainnya","Alamat":"Jl. Perintis Kemerdekaan Kramatsari","LuasTotal":"600","NilaiPerolehan":"619200000.0000"},{"Uraian":"Tanah Kosong Lainnya","Alamat":"Jl. Toba Keputran","LuasTotal":"106","NilaiPerolehan":"74412000.0000"},{"Uraian":"Tanah Kosong Lainnya","Alamat":"Kel. Kandang Panjang","LuasTotal":"57583","NilaiPerolehan":"1525032650.0000"},{"Uraian":"Tanah Kosong Lainnya","Alamat":"Jl Sriwijaya Kel. Podosugih","LuasTotal":"465","NilaiPerolehan":"554617000.0000"},{"Uraian":"Tanah Kosong Lainnya","Alamat":"Jl. Kapulogo Kel. Medono","LuasTotal":"370","NilaiPerolehan":"300000000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"JL GAJAH MADA\/MERDEKA NO 21, 23, Jl BAHAGIA 1,3,5","LuasTotal":"5130","NilaiPerolehan":"1446660000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"JL BINA GRIYA PRINGLANGU","LuasTotal":"239","NilaiPerolehan":"20315000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"JL MAJAPAHIT BENDAN","LuasTotal":"1470","NilaiPerolehan":"693105000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"JL IINPRES KRAPYAK LOR","LuasTotal":"600","NilaiPerolehan":"27600000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"KEL MEDONO","LuasTotal":"852","NilaiPerolehan":"188292000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"JL KH WAHID HASYIM KEL KEPUTRAN","LuasTotal":"10740","NilaiPerolehan":"3141450000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"JL TONDANO KEL PONCOL","LuasTotal":"458","NilaiPerolehan":"126179000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"DESA KARANGANYAR","LuasTotal":"288","NilaiPerolehan":"30240000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"KEL KLEGO","LuasTotal":"78","NilaiPerolehan":"11895000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"KEL KANDANG PANJANG","LuasTotal":"71","NilaiPerolehan":"8981500.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"DESA PRINGLANGU","LuasTotal":"38","NilaiPerolehan":"3230000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"KEL KANDANGPANNJANG Jl Kusuma Bangsa No 45","LuasTotal":"8","NilaiPerolehan":"1196000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"BINAGRIYA KEL TEGALREJO","LuasTotal":"12","NilaiPerolehan":"828000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"KEL KANDANGPANJANG","LuasTotal":"12","NilaiPerolehan":"1518000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"KEL PONCOL","LuasTotal":"32","NilaiPerolehan":"8816000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"GANG PONCOL BARU KEL PONCOL","LuasTotal":"120","NilaiPerolehan":"33060000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"JL PATINUS KEL SUGIH WARAS","LuasTotal":"1277","NilaiPerolehan":"395231500.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"JL PATINUS KEL SUGIH WARAS","LuasTotal":"1483","NilaiPerolehan":"458988500.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"JL IRIAN KEL KERGON","LuasTotal":"350","NilaiPerolehan":"107450000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"Jl Merbabu","LuasTotal":"570","NilaiPerolehan":"268755000.0000"},{"Uraian":"Tanah Bangunan Lainnya","Alamat":"Jl Merdeka","LuasTotal":"8258","NilaiPerolehan":"4224640000.0000"},{"Uraian":"Tanah Lapangan Tenis","Alamat":"JL.PEMBANGUNAN","LuasTotal":"2515","NilaiPerolehan":"1187098631.0000"},{"Uraian":"Tanah Lapangan Sepak Bola","Alamat":"JL.MATARAM PODOSUGIH","LuasTotal":"2891","NilaiPerolehan":"608555500.0000"},{"Uraian":"Tanah Lapangan Sepak Bola","Alamat":"JL.BAHAGIA KRATON KIDUL","LuasTotal":"32400","NilaiPerolehan":"10173600000.0000"},{"Uraian":"Tanah Lapangan Parkir Konstruksi Aspal","Alamat":"Jl. Perintis Kemerdekaan \/Bahagia Utara","LuasTotal":"14525","NilaiPerolehan":"11377800000.0000"},{"Uraian":"Tanah Untuk Jalan Kotamadya","Alamat":"JL.WILIS PODOSUGIH","LuasTotal":"1580","NilaiPerolehan":"332590000.0000"},{"Uraian":"Tanah Untuk Jalan Kotamadya","Alamat":"JL.WILIS PODOSUGIH","LuasTotal":"2365","NilaiPerolehan":"497832500.0000"},{"Uraian":"Tanah Untuk Jalan Kotamadya","Alamat":"JL.WILIS PODOSUGIH","LuasTotal":"3015","NilaiPerolehan":"634657500.0000"},{"Uraian":"Tanah Untuk Bangunan Instalasi Pengolahan Limbah","Alamat":"Sanimas panjangbaru","LuasTotal":"250","NilaiPerolehan":"15086202.0000"},{"Uraian":"Tanah Untuk Bangunan Instalasi Pengolahan Limbah","Alamat":"Kauman","LuasTotal":"322","NilaiPerolehan":"210502808.0000"},{"Uraian":"Tanah Utk Bangunan Jaringan Lain-lain","Alamat":"JL.IRIAN","LuasTotal":"185","NilaiPerolehan":"13135000.0000"}]}}
</pre>

                            </div><!-- /.tab-pane -->
                            <div id="tab_2" class="tab-pane">
                            <b>Fetch Data dengan Json_decode :</b>
<pre style="font-weight: 600;">
&lt;?php
$url='<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/satker/?term=04.02';

$resultJsonEncode=file_get_contents($url);

$resultJsonDecode=json_decode($resultJson);
?&gt;
</pre>
                            <b>Result :</b>
<pre style="font-weight: 600;">
<?php echo pr($_smarty_tpl->tpl_vars['JsonDecode']->value);?>

</pre>

                            </div><!-- /.tab-pane -->
                            <div id="tab_3" class="tab-pane">
                              <pre style="font-weight: 600;">
&lt;?php
$url='<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/satker/?term=04.02';

$resultJsonEncode=file_get_contents($url);

$resultJsonDecode=json_decode($resultJson);

echo  "&lt;table border=&quot;1&quot; width=&quot;100%&quot;&gt;
            &lt;thead&gt;
              &lt;tr&gt;
                &lt;th&gt;Kode Sektor&lt;/th&gt;
                &lt;th&gt;Kode Satker&lt;/th&gt;
                &lt;th&gt;Kode&lt;/th&gt;
                &lt;th&gt;Nama Satker&lt;/th&gt;
              &lt;/tr&gt;
            &lt;/thead&gt;
            &lt;tbody&gt;
";
foreach ($resultJsonDecode as $key => $val){
        echo "&lt;tr&gt;";
        echo "&lt;td&gt;".$val->KodeSektor."&lt;/td&gt;";
        echo "&lt;td&gt;".$val->KodeSatker."&lt;/td&gt;";
        echo "&lt;td&gt;".$val->kode."&lt;/td&gt;";
        echo "&lt;td&gt;".$val->NamaSatker."&lt;/td&gt;";
        echo "&lt;/tr&gt;";
}
echo "   &lt;tbody&gt;
      &lt;/table&gt;";
?&gt;
</pre>
                            <b>Result :</b>
          <table border="1" width="100%">
            <thead>
              <tr>
                <th>Kode Sektor</th>
                <th>Kode Satker</th>
                <th>Kode</th>
                <th>Nama Satker</th>
              </tr>
            </thead>
            <tbody>
              
              <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['JsonDecode']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                <tr>
                  <td><?php echo $_smarty_tpl->tpl_vars['val']->value->KodeSektor;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['val']->value->KodeSatker;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['val']->value->kode;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['val']->value->NamaSatker;?>
</td>
                </tr>

              <?php } ?>
            </tbody>
          </table>
                            </div><!-- /.tab-pane -->
                          </div><!-- /.tab-content -->
                        </div><!-- nav-tabs-custom -->
                      </div><!-- /.col -->

                     
                    </div>
                  </div><!-- /.tab-pane -->
                  
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div>
         </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  
<?php }} ?>

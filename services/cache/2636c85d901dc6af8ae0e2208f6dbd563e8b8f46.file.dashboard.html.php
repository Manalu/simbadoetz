<?php /* Smarty version Smarty-3.1.15, created on 2015-12-03 05:52:30
         compiled from "app/view/dashboard.html" */ ?>
<?php /*%%SmartyHeaderCode:47108110565fd89e725f92-10461447%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2636c85d901dc6af8ae0e2208f6dbd563e8b8f46' => 
    array (
      0 => 'app/view/dashboard.html',
      1 => 1449113583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '47108110565fd89e725f92-10461447',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_565fd89e779be8_74538742',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565fd89e779be8_74538742')) {function content_565fd89e779be8_74538742($_smarty_tpl) {?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Penjelasan Parameter Url Services
            <small>Dashboard</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Dashboard</a></li>
            <li class="active">Penjelasan Parameter Url Services</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
       <div class="row">
 <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><strong>Penjelasan Parameter Services</strong> <br/><i>Daftar Aset Tetap, Aset Tetap lainnya, Barang Non Aset dan Rekapitulasi Barang Ke neraca</i></h3>
                </div>
                <!-- /.box-header -->
                <table class="table table-bordered">
                  <tbody><tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 200px">Parameter</th>
                    <th>Keterangan</th>
                  </tr>
                  <tr>
                    <td>1.</td>
                    <td>skpd_id</td>
                    <td>Diisi dengan kode <i><u>Satker</u></i> contoh :<strong> 04.02</strong></td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>tglawalperolehan</td>
                    <td>Diisi dengan Format Tanggal <i><u>yy-mm-dd</u></i> contoh :<strong> 2015-12-02</strong></td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>tglakhirperolehan</td>
                    <td>Diisi dengan Format Tanggal <i><u>yy-mm-dd</u></i> contoh :<strong> 2015-12-02</strong></td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td>tipe_file</td>
                    <td>Diisi dengan <strong>3</strong></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Contoh Services Daftar Aset Tetap Tanah</strong></td>
                    <td><u><i>http://localhost/simbadoetz/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_tanah.php?menuID=&mode=&tab=&skpd_id=</i><strong>04.02</strong><i>&tglawalperolehan=&tglakhirperolehan=</i><strong>2014-12-31</strong><i>&tipe_file=</i><strong>3</strong></u></td>
                  </tr>
                </tbody>
              </table>
              </div>
              <!-- /.box -->
            </div>
          </div> 


              <div class="row">
               <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title"><strong>Penjelasan Parameter Services</strong> <i>Kode Satuan Kerja (SATKER)</i></h3>
                      </div>
                      <!-- /.box-header -->
                      <table class="table table-bordered">
                        <tbody><tr>
                          <th style="width: 10px">No</th>
                          <th style="width: 200px">Parameter</th>
                          <th>Keterangan</th>
                        </tr>
                        <tr>
                          <td>1.</td>
                          <td>term</td>
                          <td>Diisi dengan kode <i><u>Satker</u></i> contoh :<strong> 04</strong> atau <strong> 04.02</strong>  atau <strong> 04.02.01</strong> atau <strong> 04.02.01.01</strong></td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>Contoh Services</strong></td>
                          <td><u><i>http://localhost/simbadoetz/services/home/satker/?term=</i><strong>04.02</strong></u></td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                    <!-- /.box -->
                  </div>
                </div> 

              <div class="row">
               <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title"><strong>Penjelasan Parameter Services</strong> <i>Kode Kelompok </i></h3>
                      </div>
                      <!-- /.box-header -->
                      <table class="table table-bordered">
                        <tbody><tr>
                          <th style="width: 10px">No</th>
                          <th style="width: 200px">Parameter</th>
                          <th>Keterangan</th>
                        </tr>
                        <tr>
                          <td>1.</td>
                          <td>term</td>
                          <td>Diisi dengan kode <i><u>Kelompok</u></i> contoh :<strong> 02</strong> atau <strong> 02.02</strong>  atau <strong> 02.02.01</strong> atau <strong> 02.02.01.01</strong></td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>Contoh Services</strong></td>
                          <td><u><i>http://localhost/simbadoetz/services/home/kelompok/?term=</i><strong>02.02</strong></u></td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                    <!-- /.box -->
                  </div>
                </div> 
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  

    <?php }} ?>

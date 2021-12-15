<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>


<script type="text/javascript">
    function getDateTime($tgl) {
        if ($tgl == "now") {
            var now = new Date();
        } else {
            var now = $tgl;
        }
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var day = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        if (month.toString().length == 1) {
            var month = '0' + month;
        }
        if (day.toString().length == 1) {
            var day = '0' + day;
        }
        if (hour.toString().length == 1) {
            var hour = '0' + hour;
        }
        if (minute.toString().length == 1) {
            var minute = '0' + minute;
        }
        if (second.toString().length == 1) {
            var second = '0' + second;
        }
        var dateTime = year + '/' + month + '/' + day + ' ' + hour + ':' + minute + ':' + second;
        return dateTime;
    }
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Laporan Penjualan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>dashboard">home</a></li>
                        <li class="breadcrumb-item active"><?php echo $this->uri->segment(1); ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Laporan Penjualan
                            <div class="card-tools">
                                <a href="<?php echo base_url('report/printPenjualan') ?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label">Tanggal</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>

                                        <input type="text" class="form-control pull-right" id="datepicker" value="<?php echo date("m/d/Y") ?>">
                                    </div>
                                </div>
                                s/d
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker2">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <button class="btn btn-block btn-primary">Proses</button>
                                </div>
                            </div>
                            <hr />
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">No</th>
                                            <th>Id Penjualan</th>
                                            <th>Tgl Penjualan</th>
                                            <th>Customer</th>
                                            <th>Nama Barang</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Sub Total</th>
                                            <th>Diskon</th>
                                            <th>Total</th>
                                            <th style="background-color:#B9FFFF">Harga Beli</th>
                                            <th style="background-color:#B9FFFF">Total Beli</th>
                                            <th style="background-color:#A8FC9B">Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($penjualan)) {
                                            $totalsBeli = 0;
                                            $totalsPendapatan = 0;
                                            for ($a = 0; $a < count($penjualan); $a++) { ?>
                                                <?php $idpenjualan = $penjualan[$a]['id_penjualan']; ?>
                                                <tr id="penjualan<?php echo $idpenjualan; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $idpenjualan ?></td>
                                                    <td><?php echo $penjualan[$a]['tgl_penjualan'] ?></td>
                                                    <td><?php echo $penjualan[$a]['nama'] ?></td>
                                                    <td><?php echo $penjualan[$a]['nama_barang'] ?></td>
                                                    <td align="right"><?php echo $penjualan[$a]['qty_keluar'] ?></td>
                                                    <td align="right"><?php echo number_format($penjualan[$a]['harga_jual']) ?></td>
                                                    <td align="right">
                                                        <?php
                                                        $subtotaljual =  $penjualan[$a]['qty_keluar'] * $penjualan[$a]['harga_jual'];
                                                        echo number_format($subtotaljual);
                                                        ?>
                                                    </td>
                                                    <td align="right"><?php echo number_format($penjualan[$a]['diskon']) ?></td>
                                                    <td>
                                                        <?php
                                                        $totaljual =  $subtotaljual -  $penjualan[$a]['diskon'];
                                                        echo number_format($totaljual);
                                                        ?>
                                                    </td>
                                                    <td align="right" style="background-color:#B9FFFF"><?php echo number_format($penjualan[$a]['harga_beli']); ?></td>
                                                    <td align="right" style="background-color:#B9FFFF">
                                                        <?php
                                                        $totalbeli =  $penjualan[$a]['qty_keluar'] *  $penjualan[$a]['harga_beli'];
                                                        echo number_format($totalbeli);
                                                        ?>
                                                    </td>
                                                    <td align="right" style="background-color:#A8FC9B">
                                                        <?php
                                                        $pendapatan =   $totaljual - $totalbeli;
                                                        echo number_format($pendapatan);
                                                        ?>
                                                    </td>
                                                    <?php
                                                    $totalsBeli = $totalsBeli + $totalbeli;
                                                    $totalsPendapatan = $totalsPendapatan + $pendapatan;
                                                    ?>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td align="right" colspan="11">TOTAL</td>
                                            <td align="right" style="background-color:#B9FFFF"><?php echo number_format($totalsBeli); ?></td>
                                            <td align="right" style="background-color:#A8FC9B"><?php echo number_format($totalsPendapatan); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
        <!-- /.row -->



</div>
<!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    window.onload = function exampleFunction() {
        // alert('dfdf');
    }
</script>
<?php $this->load->view('footer'); ?>
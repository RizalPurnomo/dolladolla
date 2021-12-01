<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>


<script type="text/javascript">

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
                                            for ($a = 0; $a < count($penjualan); $a++) { ?>
                                                <?php $idpenjualan = $penjualan[$a]['id_penjualan']; ?>
                                                <tr id="penjualan<?php echo $idpenjualan; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $idpenjualan ?></td>
                                                    <td><?php echo $penjualan[$a]['tgl_penjualan'] ?></td>
                                                    <td><?php echo $penjualan[$a]['nama'] ?></td>
                                                    <td><?php echo $penjualan[$a]['nama_barang'] ?></td>
                                                    <td><?php echo $penjualan[$a]['qty_keluar'] ?></td>
                                                    <td><?php echo $penjualan[$a]['harga_jual'] ?></td>
                                                    <td>
                                                        <?php
                                                        $subtotaljual =  $penjualan[$a]['qty_keluar'] * $penjualan[$a]['harga_jual'];
                                                        echo $subtotaljual;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $penjualan[$a]['diskon'] ?></td>
                                                    <td>
                                                        <?php
                                                        $totaljual =  $subtotaljual -  $penjualan[$a]['diskon'];
                                                        echo $totaljual;
                                                        ?>
                                                    </td>
                                                    <td style="background-color:#B9FFFF"><?php echo $penjualan[$a]['harga_beli'] ?></td>
                                                    <td style="background-color:#B9FFFF">
                                                        <?php
                                                        $totalbeli =  $penjualan[$a]['qty_keluar'] *  $penjualan[$a]['harga_beli'];
                                                        echo $totalbeli;
                                                        ?>
                                                    </td>
                                                    <td style="background-color:#A8FC9B">
                                                        <?php
                                                        $pendapatan =   $totaljual - $totalbeli;
                                                        echo $pendapatan;
                                                        ?>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
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
<?php $this->load->view('footer'); ?>
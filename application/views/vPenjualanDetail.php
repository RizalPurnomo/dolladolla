<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Penjualan Detail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url($this->uri->segment(1)); ?>"><?php echo $this->uri->segment(1); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $this->uri->segment(2); ?></li>
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
                            <h5>Penjualan Detail</h5>
                            <div class="card-tools">
                                <a href="<?php echo base_url() . 'penjualan/detailPrint/' . $this->uri->segment(3) ?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <img src="<?php echo base_url(); ?>assets/images/logo.png" width="100"> <br />
                                            <b>DOLLA DOLLA </b>
                                            <small class="float-right"><b>ID #<?php echo $penjualan[0]['id_penjualan']; ?></b></small><br />
                                            <small class="float-right">Tanggal: <?php echo $penjualan[0]['tgl_penjualan']; ?></small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <strong>Customer</strong>
                                        <address>
                                            <?php echo $penjualan[0]['nama']; ?><br>

                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <strong>Status Reseller</strong>
                                        <address>
                                            <?php echo $penjualan[0]['status']; ?><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <strong>Keterangan</strong>
                                        <address>
                                            <?php echo $penjualan[0]['keterangan']; ?><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Id Barang</th>
                                                    <th>Qty</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Subtotal</th>
                                                    <th>Diskon</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($penjualan)) {
                                                    $totals = 0;
                                                    for ($a = 0; $a < count($penjualan); $a++) { ?>
                                                        <tr id="penjualan<?php echo $penjualan[$a]['id_penjualan']; ?>">
                                                            <td><?php echo $a + 1 ?></td>
                                                            <td><?php echo $penjualan[$a]['id_barang'] ?></td>
                                                            <td align="right"><?php echo number_format($penjualan[$a]['qty_keluar']) ?></td>
                                                            <td align="right"><?php echo number_format($penjualan[$a]['harga_jual']) ?></td>
                                                            <td align="right">
                                                                <?php
                                                                $subtotal = $penjualan[$a]['qty_keluar'] * $penjualan[$a]['harga_jual'];
                                                                echo number_format($subtotal);
                                                                ?>
                                                            </td>
                                                            <td align="right"><?php echo number_format($penjualan[$a]['diskon']) ?></td>
                                                            <td align="right">
                                                                <?php
                                                                $total = $subtotal - $penjualan[$a]['diskon'];
                                                                $totals = $totals + $total;
                                                                echo number_format($total);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td align="right"><?php echo number_format($totals); ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <div class="row">
                                    <div class="col-3 table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td colspan="2">
                                                    <center><b>STATUS</b></center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Payment</td>
                                                <td>: <?php echo $penjualan[0]['status_pembayaran'] . " ( " . number_format($penjualan[0]['pembayaran']) . " )"; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Pengiriman</td>
                                                <td>: <?php echo $penjualan[0]['status_pengiriman']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <!-- /.invoice -->


                        </div>

                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>



        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>
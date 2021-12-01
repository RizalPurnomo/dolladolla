<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pembelian Detail</h1>
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
                            <h5>Pembelian Detail</h5>
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
                                            <small class="float-right"><b>ID #<?php echo $pembelian[0]['id_pembelian']; ?></b></small><br />
                                            <small class="float-right">Tanggal: <?php echo $pembelian[0]['tgl_pembelian']; ?></small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-6 invoice-col">
                                        <strong>Supplier</strong>
                                        <address>
                                            <?php echo $pembelian[0]['nama_supplier']; ?><br>

                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6 invoice-col">
                                        <strong>Keterangan</strong>
                                        <address>
                                            <?php echo $pembelian[0]['keterangan']; ?><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">No</th>
                                                    <th>Id Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Qty</th>
                                                    <th>Harga Beli</th>
                                                    <th>Harga Jual Ecer</th>
                                                    <th>Harga Jual Reseller</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($pembelian)) {
                                                    for ($a = 0; $a < count($pembelian); $a++) { ?>
                                                        <tr>
                                                            <td><?php echo $a + 1 ?></td>
                                                            <td><?php echo $pembelian[$a]['id_barang'] ?></td>
                                                            <td><?php echo $pembelian[$a]['nama_barang'] ?></td>
                                                            <td><?php echo $pembelian[$a]['qty_masuk'] ?></td>
                                                            <td><?php echo $pembelian[$a]['harga_beli'] ?></td>
                                                            <td><?php echo $pembelian[$a]['harga_jual_ecer'] ?></td>
                                                            <td><?php echo $pembelian[$a]['harga_jual_reseller'] ?></td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

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
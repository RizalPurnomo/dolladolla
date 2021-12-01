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
                    <h1 class="m-0 text-dark">Laporan Stock Barang</h1>
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
                            Laporan Stock Barang
                            <div class="card-tools">
                                <a href="<?php echo base_url('report/printStock') ?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>
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
                                            <!-- <th style="width:10%">Id Pembelian</th> -->
                                            <th style="width:10%">Id Barang</th>
                                            <th style="width:10%">Tgl Pembelian</th>
                                            <th style="width:15%">Barcode</th>
                                            <th style="width:65%">Nama Barang</th>
                                            <th style="width:5%">Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($barang)) {
                                            for ($a = 0; $a < count($barang); $a++) { ?>
                                                <?php $idbarang = $barang[$a]['id_pembelian_detail']; ?>
                                                <tr id="barang<?php echo $idbarang; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <!-- <td><?php echo $idbarang ?></td> -->
                                                    <td><?php echo $barang[$a]['id_barang'] ?></td>
                                                    <td><?php echo $barang[$a]['tgl_pembelian'] ?></td>
                                                    <td><?php echo $barang[$a]['barcode'] ?></td>
                                                    <td><?php echo $barang[$a]['nama_barang'] ?></td>
                                                    <td><?php echo $barang[$a]['stock'] ?></td>
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
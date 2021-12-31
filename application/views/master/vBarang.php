<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>


<script type="text/javascript">
    function selectData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        console.log(idData);
        $.ajax({
            success: function(html) {
                var url = "<?php echo base_url(); ?>barang/edit/" + idData;
                window.location.href = url;
            }
        });
    }
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Barang</h1>
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
                            Barang
                            <div class="card-tools">
                                <!-- <a href="<?php echo base_url('report/printStock') ?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Print</a> -->
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
                                            <th style="width:10%">Id Barang</th>
                                            <th style="width:10%">Barcode</th>
                                            <th style="width:20%">Nama Barang</th>
                                            <th style="width:5%">Stock</th>
                                            <th style="width:10%">Harga Beli</th>
                                            <th style="width:10%">Harga Jual Ecer</th>
                                            <th style="width:10%">Harga Jual Reseller</th>
                                            <th style="width:20%">QR Code</th>
                                            <th style="width:10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($barang)) {
                                            for ($a = 0; $a < count($barang); $a++) { ?>
                                                <?php $idbarang = $barang[$a]['id_barang']; ?>
                                                <tr id="barang<?php echo $idbarang; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $barang[$a]['id_barang'] ?></td>
                                                    <td><?php echo $barang[$a]['barcode'] ?></td>
                                                    <td><?php echo $barang[$a]['nama_barang'] ?></td>
                                                    <td><?php echo $barang[$a]['stock'] ?></td>
                                                    <td><?php echo number_format($barang[$a]['harga_beli']) ?></td>
                                                    <td><?php echo number_format($barang[$a]['harga_jual_ecer']) ?></td>
                                                    <td><?php echo number_format($barang[$a]['harga_jual_reseller']) ?></td>
                                                    <td><img style="width: 100px;" src="<?php echo base_url() . 'assets/images/' . $barang[$a]['id_barang'] . '.png'; ?>"></td>

                                                    <td>
                                                        <a class="btn btn-large btn-primary" href="javascript:selectData('barang<?php echo $barang[$a]['id_barang']; ?>')">Edit</a>
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
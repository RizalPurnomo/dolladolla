<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>

<script type="text/javascript">
    function deleteData(id) {
        let iddata = $("#" + id + " td")[1].innerHTML;
        Swal.fire({
            title: 'Apakah yakin data akan di hapus?',
            showCancelButton: true,
            confirmButtonText: `Delete`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>penjualan/delete/" + iddata,
                    success: function(html) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        console.log(html);
                        var url = "<?php echo base_url(); ?>penjualan/";
                        window.location.href = url;
                    }
                })
            } else {
                return;
            }
        })
    }
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Penjualan</h1>
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
                            <a href="<?php echo base_url(); ?>penjualan/add/" class="btn btn-app">
                                <i class="fa fa-plus-square" aria-hidden="true"></i> Tambah
                            </a>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Penjualan</th>
                                            <th>Tanggal</th>
                                            <th>Customer</th>
                                            <th>Reseller</th>
                                            <th>Keterangan</th>
                                            <th style="width:15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($penjualan)) {
                                            for ($a = 0; $a < count($penjualan); $a++) { ?>
                                                <tr id="penjualan<?php echo $penjualan[$a]['id_penjualan']; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $penjualan[$a]['id_penjualan'] ?></td>
                                                    <td><?php echo $penjualan[$a]['tgl_penjualan'] ?></td>
                                                    <td><?php echo $penjualan[$a]['nama'] ?></td>
                                                    <td><?php echo $penjualan[$a]['status'] ?></td>
                                                    <td><?php echo $penjualan[$a]['keterangan'] ?></td>
                                                    <td>
                                                        <a class="btn btn-large btn-success " href="<?php echo base_url('penjualan/detail/') .  $penjualan[$a]['id_penjualan']; ?>">Detail</a>
                                                        | <a class="btn btn-large btn-danger" href="javascript:deleteData('penjualan<?php echo $penjualan[$a]['id_penjualan']; ?>')">Delete</a>
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
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>
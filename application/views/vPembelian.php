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
                    url: "<?php echo base_url(); ?>pembelian/cekRelasi/" + iddata,
                    success: function(result) {
                        console.log(result);
                        if (parseInt(result) > 0) {
                            Swal.fire({
                                icon: 'warning',
                                text: 'Pembelian ini sudah berelasi dengan data penjualan!',
                            })
                            return;
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>pembelian/delete/" + iddata,
                                success: function(html) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data Berhasil Dihapus',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    console.log(html);
                                    var url = "<?php echo base_url(); ?>pembelian/";
                                    window.location.href = url;
                                }
                            })
                        }

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
                    <h1 class="m-0 text-dark">Pembelian</h1>
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
                            <a href="<?php echo base_url(); ?>pembelian/add/" class="btn btn-app">
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
                                            <th>Id Pembelian</th>
                                            <th>Tanggal</th>
                                            <th>Supplier</th>
                                            <th>Keterangan</th>
                                            <th style="width:15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($pembelian)) {
                                            for ($a = 0; $a < count($pembelian); $a++) { ?>
                                                <tr id="pembelian<?php echo $pembelian[$a]['id_pembelian']; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $pembelian[$a]['id_pembelian'] ?></td>
                                                    <td><?php echo $pembelian[$a]['tgl_pembelian'] ?></td>
                                                    <td><?php echo $pembelian[$a]['nama_supplier'] ?></td>
                                                    <td><?php echo $pembelian[$a]['keterangan'] ?></td>
                                                    <td>
                                                        <a class="btn btn-large btn-success " href="<?php echo base_url('pembelian/detail/') .  $pembelian[$a]['id_pembelian']; ?>">Detail</a>
                                                        | <a class="btn btn-large btn-danger" href="javascript:deleteData('pembelian<?php echo $pembelian[$a]['id_pembelian']; ?>')">Delete</a>
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
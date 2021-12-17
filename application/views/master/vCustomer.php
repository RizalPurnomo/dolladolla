<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>


<script type="text/javascript">
    function selectData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        console.log(idData);
        $.ajax({
            success: function(html) {
                var url = "<?php echo base_url(); ?>customer/edit/" + idData;
                window.location.href = url;
            }
        });
    }

    function deleteData(id) {
        let idData = $("#" + id + " td")[1].innerHTML;
        Swal.fire({
            title: 'Apakah yakin data akan di hapus?',
            showCancelButton: true,
            confirmButtonText: `Delete`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>customer/delete/" + idData,
                    success: function(html) {
                        console.log(html);
                        var url = "<?php echo base_url(); ?>customer/";
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
                    <h1 class="m-0 text-dark">Customer</h1>
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
                            <a href="<?php echo base_url(); ?>customer/add" class="btn btn-app">
                                <i class="fas fa-user"></i> Tambah Customer
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
                                            <th>Id Customer</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Alamat</th>
                                            <th>WA</th>
                                            <th>FB</th>
                                            <th>IG</th>
                                            <th style="width:15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($customer)) {
                                            for ($a = 0; $a < count($customer); $a++) { ?>
                                                <?php $idcustomer = $customer[$a]['id_customer']; ?>
                                                <tr id="customer<?php echo $idcustomer; ?>">
                                                    <td><?php echo $a + 1 ?></td>
                                                    <td><?php echo $idcustomer ?></td>
                                                    <td><?php echo $customer[$a]['nama'] ?></td>
                                                    <td><?php echo $customer[$a]['status'] ?></td>
                                                    <td><?php echo $customer[$a]['alamat'] ?></td>
                                                    <td><?php echo $customer[$a]['wa'] ?></td>
                                                    <td><?php echo $customer[$a]['fb'] ?></td>
                                                    <td><?php echo $customer[$a]['ig'] ?></td>
                                                    <td>
                                                        <a class="btn btn-large btn-primary" href="javascript:selectData('customer<?php echo $customer[$a]['id_customer']; ?>')">Edit</a>
                                                        | <a class="btn btn-large btn-danger" href="javascript:deleteData('customer<?php echo $customer[$a]['id_customer']; ?>')">Delete</a>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Customer</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Alamat</th>
                                            <th>WA</th>
                                            <th>FB</th>
                                            <th>IG</th>
                                            <th style="width:15%">Aksi</th>
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
            <!-- /.col -->
        </div>
        <!-- /.row -->



</div>
<!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>
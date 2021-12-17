<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    function saveSupplier() {
        if ($("#idsupplier").val() == "" || $("#namasupplier").val() == "" || $("#tlp").val() == "" || $("#alamat").val() == "" || $("#pic").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var dataArray = {
            "supplier": {
                "id_supplier": $("#idsupplier").val(),
                "nama_supplier": $("#namasupplier").val(),
                "telp": $("#tlp").val(),
                "alamat": $("#alamat").val(),
                "pic": $("#pic").val()
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('supplier/updateData/'); ?>' + $("#idsupplier").val(),
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>supplier";
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
                    <h1 class="m-0 text-dark">Edit Supplier</h1>
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
                            Edit Data Supplier
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-body">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Id Supplier</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="idsupplier" disabled placeholder="Id Customer" value="<?php echo $supplier[0]['id_supplier']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Supplier</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="namasupplier" placeholder="Nama Customer" value="<?php echo $supplier[0]['nama_supplier']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?php echo $supplier[0]['alamat']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Telp</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="tlp" placeholder="Telp" value="<?php echo $supplier[0]['telp']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PIC</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pic" placeholder="PIC" value="<?php echo $supplier[0]['pic']; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button onclick="saveSupplier()" class="btn btn-info">Simpan</button>
                                <!-- <button class="btn btn-default float-right">Cancel</button> -->
                            </div>
                            <!-- /.card-footer -->
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
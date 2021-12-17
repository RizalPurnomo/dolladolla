<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    function updateData() {
        if ($("#idcustomer").val() == "" || $("#namacustomer").val() == "" || $("#status").val() == "" || $("#alamat").val() == "" || $("#wa").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var dataArray = {
            "customer": {
                "id_customer": $("#idcustomer").val(),
                "nama": $("#namacustomer").val(),
                "status": $("#status").val(),
                "alamat": $("#alamat").val(),
                "wa": $("#wa").val(),
                "fb": $("#fb").val(),
                "ig": $("#ig").val()
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('customer/updateData/'); ?>' + $("#idcustomer").val(),
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Di Update',
                    showConfirmButton: false,
                    timer: 1500
                })
                console.log(result);
                window.location = "<?php echo base_url(); ?>customer";
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
                    <h1 class="m-0 text-dark">Edit Customer</h1>
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
                            Input Data Customer
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
                                    <label class="col-sm-3 col-form-label">Id Customer</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="idcustomer" disabled placeholder="Id Customer" value="<?php echo $customer[0]['id_customer']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Customer</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="namacustomer" placeholder="Nama Customer" value="<?php echo $customer[0]['nama']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" style="width: 100%;" id="status">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Reseller" <?php if ($customer[0]['status'] == "Reseller") {
                                                                            echo 'selected';
                                                                        } ?>>Reseller</option>
                                            <option value="Ecer" <?php if ($customer[0]['status'] == "Ecer") {
                                                                        echo 'selected';
                                                                    } ?>>Ecer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?php echo $customer[0]['alamat']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">No Whatsapp</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="wa" placeholder="Whatsapp" value="<?php echo $customer[0]['wa']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Instagram</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="ig" placeholder="Instagram" value="<?php echo $customer[0]['ig']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Facebook</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="fb" placeholder="Facebook" value="<?php echo $customer[0]['fb']; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button onclick="updateData()" class="btn btn-info">Update</button>
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
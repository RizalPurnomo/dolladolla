<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    function editBarang() {
        if ($("#idbrg").val() == "" || $("#namabarang").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var dataArray = {
            "barang": {
                // "id_barang": $("#idbrg").val(),
                "barcode": $("#barcode").val(),
                "nama_barang": $("#namabarang").val(),
                "harga_beli": $("#hargabeli").val().replace(',', ''),
                "harga_jual_ecer": $("#hargajualecer").val().replace(',', ''),
                "harga_jual_reseller": $("#hargajualreseller").val().replace(',', '')
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('barang/updateData/'); ?>' + $("#idbrg").val(),
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Diupdate',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>barang";
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
                    <h1 class="m-0 text-dark">Edit Barang</h1>
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
                            Edit Barang
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card-body">
                                <?php //echo "<pre/>";
                                //print_r($barang); 
                                ?>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Barcode</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" id="idbrg" disabled placeholder="ID Barang" value="<?php echo $barang[0]['id_barang']; ?>">
                                        <input type="text" class="form-control" id="barcode" placeholder="Barcode" value="<?php echo $barang[0]['barcode']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="namabarang" placeholder="Nama Barang" value="<?php echo $barang[0]['nama_barang']; ?>">
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Qty</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="qty" placeholder="Quantity" value="<?php echo $barang[0]['stock']; ?>">
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga Beli</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="hargabeli" placeholder="Harga Beli (Satuan)" value="<?php echo number_format($barang[0]['harga_beli']); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga Jual Ecer</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="hargajualecer" placeholder="Harga Jual Ecer (Satuan)" value="<?php echo number_format($barang[0]['harga_jual_ecer']); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga Jual Reseller</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="hargajualreseller" placeholder="Harga Jual Reseller (Satuan)" value="<?php echo number_format($barang[0]['harga_jual_reseller']); ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button onclick="editBarang()" class="btn btn-info">Simpan</button>
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
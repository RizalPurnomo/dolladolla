<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>

<script type="text/javascript">
    function getDateTime($tgl) {
        if ($tgl == "now") {
            var now = new Date();
        } else {
            var now = $tgl;
        }
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var day = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        if (month.toString().length == 1) {
            var month = '0' + month;
        }
        if (day.toString().length == 1) {
            var day = '0' + day;
        }
        if (hour.toString().length == 1) {
            var hour = '0' + hour;
        }
        if (minute.toString().length == 1) {
            var minute = '0' + minute;
        }
        if (second.toString().length == 1) {
            var second = '0' + second;
        }
        var dateTime = year + '/' + month + '/' + day + ' ' + hour + ':' + minute + ':' + second;
        return dateTime;
    }

    function addBarang() {
        barcode = $("#barcode").val();
        namabarang = $("#namabarang").val();
        qty = $("#qty").val();
        hargabeli = $("#hargabeli").val();
        hargajualecer = $("#hargajualecer").val();
        hargajualreseller = $("#hargajualreseller").val();

        if (barcode == "" || namabarang == "" || hargabeli == "" || hargajualecer == "" || hargajualreseller == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap lengkapi data',
            })
            return;
        }

        var row = $("#dataBarang tbody tr");
        for (var i = 0; i < row.length; i++) {
            var col = $(row[i]).find("td");
            if (col[1].innerHTML == barcode) {
                Swal.fire({
                    icon: 'warning',
                    text: 'Tidak dapat memasukkan Id Barang yang sama',
                })
                return;
            }
        }
        $("#dataBarang tbody").append(
            `<tr>
                <td>- </td>
                <td>${barcode}</td>
                <td>${namabarang}</td>
                <td>${qty}</td>
                <td>${hargabeli}</td>
                <td>${hargajualecer}</td>
                <td>${hargajualreseller}</td>
            </tr>`
        );
        getMaxIdBarang();
        $('#modal-lg').modal('hide');

    }

    function savePembelian() {
        let today = new Date(),
            curr_hour = today.getHours(),
            curr_min = today.getMinutes(),
            curr_sec = today.getSeconds();

        tanggal = getDateTime(new Date($("#datepicker").val() + " " + curr_hour + ":" + curr_min + ":" + curr_sec));

        if ($("#iduser").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Session habis, Harap logout dan login kembali',
            })
            return;
        }
        if ($("#idpembelian").val() == "" || $("#datepicker").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var row = $("#dataBarang tbody tr");
        var jml = 0;
        var dataDetail = new Array();
        idbarang = $("#idbrg").val();
        for (var i = 0; i < row.length; i++) {
            var col = $(row[i]).find("td");
            dataDetail.push({
                "id_pembelian": $("#idpembelian").val(),
                "id_barang": idbarang.toString(),
                "barcode": col[1].innerHTML,
                "nama_barang": col[2].innerHTML,
                "qty_masuk": col[3].innerHTML,
                "harga_beli": col[4].innerHTML,
                "harga_jual_ecer": col[5].innerHTML,
                "harga_jual_reseller": col[6].innerHTML
            });
            idbarang++;
        }

        let dataArray = {
            "pembelian": {
                "id_pembelian": $("#idpembelian").val(),
                "id_user": $("#iduser").val(),
                "tgl_pembelian": tanggal,
                "id_supplier": $("#supplier").val(),
                "keterangan": $("#keterangan").val()
            },
            "pembeliandetail": dataDetail
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('pembelian/saveData'); ?>',
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>pembelian/";
            }
        })

    }

    function getMaxIdBarang() {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('barang/getMaxIdBarang'); ?>',
            success: function(result) {
                console.log(result);
                $("#idbrg").val(result)
            }
        })
    }








    function selectLokasi() {
        document.getElementById("lokasi").disabled = true;
    }



    function getBarangByCabang() {
        // document.getElementById("cabang").disabled = true;
        $.ajax({
            type: "GET",
            url: '<?php echo base_url('barang/getBarangByIdCabang/'); ?>' + $("#cabang").val(),
            success: function(result) {
                let arr = JSON.parse(result)
                let txt = "";
                console.log(arr);
                txt += `<label class="col-sm-2 col-form-label">Pilih Barang</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" style="width: 100%;" id="barang">`
                for (x in arr) {
                    txt += `
                                    <option value="">-- ${arr[0].lokasigudang} --</option>
                        `;
                }
                txt += `
                                </select>
                            </div>
                            `
                document.getElementById("divBarang").innerHTML = txt;
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
                    <h1 class="m-0 text-dark">Tambah Pembelian</h1>
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
                            <h4>Tambah Pembelian</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group row">
                                <input type="hidden" class="form-control" id="iduser" value="<?php echo $this->session->userdata('id_user'); ?>" disabled placeholder="ID User">
                                <input type="hidden" class="form-control" id="idbrg" disabled placeholder="ID Barang">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Id Pembelian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="idpembelian" value="<?php echo $idpembelian; ?>" disabled placeholder="ID Pembelian">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Supplier</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" id="supplier">
                                        <option value="">-- Pilih Supplier --</option>
                                        <?php for ($a = 0; $a < count($supplier); $a++) {  ?>
                                            <option value="<?php echo $supplier[$a]['id_supplier'] ?>">
                                                <?php echo $supplier[$a]['id_supplier'] . ' | ' . $supplier[$a]['nama_supplier'];  ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="keterangan" placeholder="Keterangan">
                                </div>
                            </div>
                            <hr />

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pilih Barang</label>
                                <!-- <div class="col-sm-9">
                                    <input type="text" class="form-control" id="barang" placeholder="Barang">
                                </div> -->
                                <button type="button" class="col-sm-10 btn btn-block btn-primary" data-toggle="modal" data-target="#modal-lg">
                                    Pilih Barang
                                </button>
                            </div>


                            <!-- <div class="form-group row" id="divBarang">
                                <label class="col-sm-2 col-form-label">Pilih Barang</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" id="barang">
                                        <option value="">-- Pilih Barang --</option>
                                        <?php for ($a = 0; $a < count($barang); $a++) {  ?>
                                            <?php
                                            $strBarang = $barang[$a]['idbarang'] . " || " . $barang[$a]['kodebarang'] . " || " . $barang[$a]['namabarang']  . " || " . $barang[$a]['stock'] . " || " . $barang[$a]['satuan'];
                                            ?>
                                            <option value="<?php echo $strBarang ?>">
                                                <?php echo $strBarang;  ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div> -->
                            <!-- 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="qty" placeholder="Qty">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="harga" placeholder="Harga Pembelian">
                                </div>
                                <button class="col-sm-1 btn btn-block btn-primary" onclick="addBarang()">+</button>
                            </div> -->
                            <table id="dataBarang" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Barcode</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual Ecer</th>
                                        <th>Harga Jual Reseller</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <br />
                            <div class="card-footer">
                                <button onclick="savePembelian()" class="btn btn-info">Simpan</button>
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

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-header">
                        <!-- <button type="button" class="btn btn-app" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                            <i class="fa fa-plus-square" aria-hidden="true"></i> Tambah
                        </button> -->
                        Tambah Barang
                    </div>
                    <div class="card-body">
                        <div class="collapse.show" id="collapseExample">
                            <div class="card card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Barcode</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="barcode" placeholder="Barcode">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="namabarang" placeholder="Nama Barang">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Qty</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="qty" placeholder="Quantity">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga Beli</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="hargabeli" placeholder="Harga Beli (Satuan)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga Jual Ecer</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="hargajualecer" placeholder="Harga Jual Ecer (Satuan)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Harga Jual Reseller</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="hargajualreseller" placeholder="Harga Jual Reseller (Satuan)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stock</th>
                                <th>Lokasi</th>
                                <th style="width:15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($barang)) {
                                for ($a = 0; $a < count($barang); $a++) { ?>
                                    <?php $idbarang = $barang[$a]['idbarang']; ?>
                                    <tr id="barang<?php echo $idbarang; ?>">
                                        <td><?php echo $a + 1 ?></td>
                                        <td><?php echo $idbarang ?></td>
                                        <td><?php echo $barang[$a]['namabarang'] ?></td>
                                        <td><?php echo $barang[$a]['kategori'] ?></td>
                                        <td><?php echo $barang[$a]['stock'] . " " . $barang[$a]['satuan'] ?></td>
                                        <td><?php echo $barang[$a]['lokasigudang'] ?></td>
                                        <td>
                                            <a class="btn btn-large btn-primary" href="javascript:selectData('barang<?php echo $barang[$a]['idbarang']; ?>')">Pilih</a>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Id Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stock</th>
                                <th>Lokasi</th>
                                <th style="width:15%">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div> -->
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="addBarang()" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>

<!-- /.modal -->
<?php $this->load->view('footer'); ?>
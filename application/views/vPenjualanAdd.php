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

    function tambahCustomer() {
        getMaxIdCustomer();
        $("#modal-lg").modal()

    }

    function getMaxIdCustomer() {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('customer/getMaxIdCustomer'); ?>',
            success: function(result) {
                console.log(result);
                $("#idcustomer").val(result)
            }
        })
    }

    function tambahBarang() {
        if ($("#customer").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Pilih Customer Terlebih dahulu',
            })
            return;
        }
        $("#modal-barang").modal()

    }

    function addCustomer() {
        if ($("#idcustomer").val() == "" || $("#namacustomer").val() == "" || $("#alamat").val() == "" || $("#wa").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap lengkapi data',
            })
            return;
        }

        let dataArray = {
            "customer": {
                "id_customer": $("#idcustomer").val(),
                "nama": $("#namacustomer").val(),
                "alamat": $("#alamat").val(),
                "status": $("#status").val(),
                "wa": $("#wa").val(),
                "ig": $("#ig").val(),
                "fb": $("#fb").val()
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('customer/saveData'); ?>',
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>penjualan/add/";
            }
        })
    }

    function pilihBarang(id) {
        barang = $("#" + id + " td")[2].innerHTML + ' | ' + $("#" + id + " td")[4].innerHTML + ' | ' + $("#" + id + " td")[5].innerHTML + ' | ' + $("#" + id + " td")[7].innerHTML + ' | ' + $("#" + id + " td")[8].innerHTML + ' | ' + $("#" + id + " td")[9].innerHTML
        $("#barang").val(barang);
        $("#qty").val(1);
        $("#diskon").val(0);
        $("#idbarang").val($("#" + id + " td")[4].innerHTML);
        $("#idpembelian").val($("#" + id + " td")[2].innerHTML);
        $("#namabarang").val($("#" + id + " td")[5].innerHTML);
        $("#stock").val($("#" + id + " td")[7].innerHTML);
        arrcust = $("#customer").val().split(' | ');
        if (arrcust[2] == "Reseller") {
            $("#hargasatuan").val($("#" + id + " td")[9].innerHTML);
            $("#subtotal").val($("#" + id + " td")[9].innerHTML);
            $("#total").val($("#" + id + " td")[9].innerHTML);
        } else {
            $("#hargasatuan").val($("#" + id + " td")[8].innerHTML);
            $("#subtotal").val($("#" + id + " td")[8].innerHTML);
            $("#total").val($("#" + id + " td")[8].innerHTML);
        }
        $('#modal-barang').modal('hide');
    }

    function hitung() {
        subtotal = parseInt($("#qty").val()) * parseInt($("#hargasatuan").val());
        total = parseInt(subtotal) - parseInt($("#diskon").val());
        $("#subtotal").val(subtotal);
        $("#total").val(total);
    }

    function addBarang() {
        document.getElementById("pembayaran").disabled = true;
        document.getElementById("totals").disabled = true;

        idpembelian = $("#idpembelian").val();
        idbarang = $("#idbarang").val();
        namabarang = $("#namabarang").val();
        qty = $("#qty").val();
        stock = $("#stock").val();
        hargasatuan = $("#hargasatuan").val();
        subtotal = $("#subtotal").val();
        diskon = $("#diskon").val();
        total = parseInt($("#total").val());
        totals = parseInt($("#totals").val());


        if (idpembelian == "" || idbarang == "" || qty == "" || hargasatuan == "" || subtotal == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap lengkapi data',
            })
            return;
        }

        if (parseInt(qty) > parseInt(stock)) {
            Swal.fire({
                icon: 'warning',
                text: 'Stock Tidak Cukup!!',
            })
            return;
        }

        var row = $("#dataBarang tbody tr");
        for (var i = 0; i < row.length; i++) {
            var col = $(row[i]).find("td");
            if (col[2].innerHTML == idbarang) {
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
                <td>${idpembelian}</td>
                <td>${idbarang}</td>
                <td>${namabarang}</td>
                <td>${qty}</td>
                <td>${hargasatuan}</td>
                <td>${subtotal}</td>
                <td>${diskon}</td>
                <td>${total}</td>
            </tr>`
        );
        totals = totals + total;
        $("#totals").val(totals);
        $("#pembayaran").val(totals);

        // $('#modal-lg').modal('hide');
        $("#idpembelian").val("");
        $("#idbarang").val("");
        $("#namabarang").val("");
        $("#qty").val("");
        $("#stock").val("");
        $("#hargasatuan").val("");
        $("#subtotal").val("");
        $("#diskon").val("");
        $("#total").val("");
        $("#barang").val("");

    }

    function savePenjualan() {
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
        if ($("#dataBarang tbody tr").length < 1 || $("#datepicker").val() == "" || $("#customer").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var row = $("#dataBarang tbody tr");
        var jml = 0;
        var datadetailpenjualan = new Array();
        var datadetailpembelian = new Array();
        for (var i = 0; i < row.length; i++) {
            var col = $(row[i]).find("td");
            datadetailpenjualan.push({
                "id_penjualan": $("#idpenjualan").val(),
                "id_pembelian_detail": col[1].innerHTML,
                "id_barang": col[2].innerHTML,
                "qty_keluar": col[4].innerHTML,
                "harga_jual": col[5].innerHTML,
                "diskon": col[7].innerHTML,
            });
            datadetailpembelian.push({
                "id_pembelian_detail": col[1].innerHTML,
                "id_barang": col[2].innerHTML,
                "qty_keluar": col[4].innerHTML
            });
        }

        let dataArray = {
            "penjualan": {
                "id_penjualan": $("#idpenjualan").val(),
                "id_user": $("#iduser").val(),
                "tgl_penjualan": tanggal,
                "id_customer": $("#customer").val().split(' | ')[0],
                "keterangan": $("#keterangan").val(),
                "total_penjualan": $("#totals").val(),
                "status_pembayaran": document.getElementById('btnPembayaran').innerText,
                "status_pengiriman": $("#pengiriman").val()
            },
            "pembayaran": {
                "id_penjualan": $("#idpenjualan").val(),
                "pembayaran": $("#pembayaran").val()
            },
            "penjualandetail": datadetailpenjualan,
            "pembeliandetail": datadetailpembelian

        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('penjualan/saveData'); ?>',
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Disimpan',
                    showConfirmButton: false,
                    timer: 1500
                })

                console.log(result);
                window.location = "<?php echo base_url(); ?>penjualan/";
            }
        })

    }

    function lunas() {
        document.getElementById('btnPembayaran').innerText = 'Lunas';
        document.getElementById("pembayaran").disabled = true;
    }

    function dp() {
        document.getElementById('btnPembayaran').innerText = 'DP';
        document.getElementById("pembayaran").disabled = false;
    }
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Penjualan</h1>
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
                            <h4>Tambah Penjualan</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group row">
                                <input type="hidden" class="form-control" id="iduser" value="<?php echo $this->session->userdata('id_user'); ?>" disabled placeholder="ID User">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Id Pembelian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="idpenjualan" value="<?php echo $idpenjualan; ?>" disabled placeholder="ID Penjualan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Customer</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" style="width: 100%;" id="customer">
                                        <option value="">-- Pilih Customer --</option>
                                        <?php for ($a = 0; $a < count($customer); $a++) {  ?>
                                            <?php $cust = $customer[$a]['id_customer'] . ' | ' . $customer[$a]['nama'] . ' | ' . $customer[$a]['status'] . ' | ' . $customer[$a]['alamat'];  ?>
                                            <option value="<?php echo $cust; ?>">
                                                <?php echo $cust;  ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <button type="button" class="col-sm-1 btn btn-block btn-primary" onclick="tambahCustomer()">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                </button>
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
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="barang" placeholder="Barang">
                                </div>
                                <button type="button" class="col-sm-1 btn btn-block btn-primary" onclick="tambahBarang()">
                                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-1">
                                    Qty
                                    <input type="text" class="form-control" id="qty" placeholder="Qty" onchange="hitung()">
                                </div>
                                <div class="col-sm-2">
                                    Harga Satuan
                                    <input type="text" class="form-control" id="hargasatuan" disabled placeholder="Harga Satuan">
                                </div>
                                <div class="col-sm-2">
                                    Sub Total
                                    <input type="text" class="form-control" id="subtotal" disabled placeholder="Sub Total">
                                </div>
                                <div class="col-sm-2">
                                    Diskon
                                    <input type="text" class="form-control" id="diskon" placeholder="Diskon" onchange="hitung()">
                                </div>

                                <div class="col-sm-3">
                                    Total
                                    <input type="text" class="form-control" id="total" disabled placeholder="Total">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-2">

                                    <input type="hidden" class="form-control" id="idbarang" placeholder="Id Barang">
                                </div>
                                <div class="col-sm-2">

                                    <input type="hidden" class="form-control" id="idpembelian" placeholder="Id Pembelian">
                                </div>
                                <div class="col-sm-2">

                                    <input type="hidden" class="form-control" id="namabarang" placeholder="Nama Barang">
                                </div>
                                <div class="col-sm-2">

                                    <input type="hidden" class="form-control" id="stock" placeholder="Stock">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <button type="button" class="col-sm-1 btn btn-block btn-primary" onclick="addBarang()">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                </button>
                                <div class="col-sm-9">

                                </div>
                            </div>

                            <table id="dataBarang" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Id Pembelian</th>
                                        <th>Id Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Harga Jual</th>
                                        <th>Sub Total</th>
                                        <th>Diskon</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-8">

                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" disabled id="totals" placeholder="Total" value="0">
                                </div>
                            </div>
                            <br />
                            <hr />
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Payment</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" id="btnPembayaran" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Lunas</button>
                                            <ul class="dropdown-menu">
                                                <li onclick="lunas()">Lunas</li>
                                                <li onclick="dp()">DP</li>
                                            </ul>
                                        </div>
                                        <input type="text" class="form-control" disabled id="pembayaran" placeholder="Payment">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pengiriman</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" id="pengiriman">
                                        <option value="Done">Done</option>
                                        <option value="Hold">Hold</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button onclick="savePenjualan()" class="btn btn-info">Simpan</button>
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
                <h4 class="modal-title">Tambah Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Id Customer</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="idcustomer" disabled placeholder="Id Customer">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Customer</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="namacustomer" placeholder="Nama Customer">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width: 100%;" id="status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Reseller">Reseller</option>
                                    <option value="Ecer">Ecer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alamat" placeholder="Alamat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No Whatsapp</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="wa" placeholder="Whatsapp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Instagram</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ig" placeholder="Instagram">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Facebook</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="fb" placeholder="Facebook">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="addCustomer()" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-barang">
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
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:15%">Aksi</th>
                                    <th>No</th>
                                    <th>Id</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Id Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Barcode</th>
                                    <th>Stock</th>
                                    <th>Harga Ecer</th>
                                    <th>Harga Reseller</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($barang)) {
                                    for ($a = 0; $a < count($barang); $a++) { ?>
                                        <?php $idbarang = $barang[$a]['id_pembelian_detail']; ?>
                                        <tr id="barang<?php echo $idbarang; ?>">
                                            <td>
                                                <a class="btn btn-large btn-primary" href="javascript:pilihBarang('barang<?php echo $idbarang; ?>')">Pilih</a>
                                            </td>
                                            <td><?php echo $a + 1 ?></td>
                                            <td><?php echo $idbarang ?></td>
                                            <td><?php echo $barang[$a]['tgl_pembelian'] ?></td>
                                            <td><?php echo $barang[$a]['id_barang'] ?></td>
                                            <td><?php echo $barang[$a]['nama_barang'] ?></td>
                                            <td><?php echo $barang[$a]['barcode'] ?></td>
                                            <td><?php echo $barang[$a]['stock'] ?></td>
                                            <td><?php echo $barang[$a]['harga_jual_ecer'] ?></td>
                                            <td><?php echo $barang[$a]['harga_jual_reseller'] ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="pilihBarang()" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- /.modal -->
<?php $this->load->view('footer'); ?>
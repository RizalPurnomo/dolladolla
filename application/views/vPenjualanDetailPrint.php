<!DOCTYPE html>
<html>

<?php
$query = "SELECT * FROM profile WHERE id='1'";
$appName = $this->db->query($query)->result_array()[0]['appname'];
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $appName; ?> | Laporan Penjualan</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <div class="row">
                <div class="col-12">
                    <h4>
                        <img src="<?php echo base_url(); ?>assets/images/logo.png" width="100"> <br />
                        <b>DOLLA DOLLA </b>
                    </h4>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-12">
                    <h5>
                        <b>
                            <center>Invoice Penjualan</center>
                        </b>
                    </h5>
                </div>
                <!-- /.col -->
            </div>

            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-2 invoice-col">
                    <address>
                        Tanggal Cetak<br />
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-10 invoice-col">
                    <address>
                        : <?php echo date('l, d-m-Y'); ?><br />
                    </address>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <!-- <div class="col-12"> -->
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Barang</th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th>Subtotal</th>
                                <th>Diskon</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($penjualan)) {
                                for ($a = 0; $a < count($penjualan); $a++) { ?>
                                    <tr id="penjualan<?php echo $penjualan[$a]['id_penjualan']; ?>">
                                        <td><?php echo $a + 1 ?></td>
                                        <td><?php echo $penjualan[$a]['id_barang'] ?></td>
                                        <td><?php echo $penjualan[$a]['qty_keluar'] ?></td>
                                        <td><?php echo $penjualan[$a]['harga_jual'] ?></td>
                                        <td>
                                            <?php
                                            $subtotal = $penjualan[$a]['qty_keluar'] * $penjualan[$a]['harga_jual'];
                                            echo $subtotal;
                                            ?>
                                        </td>
                                        <td><?php echo $penjualan[$a]['diskon'] ?></td>
                                        <td>
                                            <?php
                                            $total = $subtotal - $penjualan[$a]['diskon'];
                                            echo $total;
                                            ?>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>

                <!-- </div> -->
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-3 table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2">
                                <center><b>STATUS</b></center>
                            </td>
                        </tr>
                        <tr>
                            <td>Payment</td>
                            <td>: <?php echo $penjualan[0]['status_pembayaran'] . " ( " . $penjualan[0]['pembayaran'] . " )"; ?></td>
                        </tr>
                        <tr>
                            <td>Pengiriman</td>
                            <td>: <?php echo $penjualan[0]['status_pengiriman']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        // window.addEventListener("load", window.print());
    </script>
</body>

</html>
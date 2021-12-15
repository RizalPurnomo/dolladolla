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
                            <center>Laporan Penjualan</center>
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
                                <th style="width:5%">No</th>
                                <th>Id Penjualan</th>
                                <th>Tgl Penjualan</th>
                                <th>Customer</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                                <th>Diskon</th>
                                <th>Total</th>
                                <th style="background-color:#B9FFFF">Harga Beli</th>
                                <th style="background-color:#B9FFFF">Total Beli</th>
                                <th style="background-color:#A8FC9B">Pendapatan</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($penjualan)) {
                                $totalsBeli = 0;
                                $totalsPendapatan = 0;
                                for ($a = 0; $a < count($penjualan); $a++) { ?>
                                    <?php $idpenjualan = $penjualan[$a]['id_penjualan']; ?>
                                    <tr id="penjualan<?php echo $idpenjualan; ?>">
                                        <td><?php echo $a + 1 ?></td>
                                        <td><?php echo $idpenjualan ?></td>
                                        <td><?php echo $penjualan[$a]['tgl_penjualan'] ?></td>
                                        <td><?php echo $penjualan[$a]['nama'] ?></td>
                                        <td><?php echo $penjualan[$a]['nama_barang'] ?></td>
                                        <td align="right"><?php echo number_format($penjualan[$a]['qty_keluar']) ?></td>
                                        <td align="right"><?php echo number_format($penjualan[$a]['harga_jual']) ?></td>
                                        <td align="right">
                                            <?php
                                            $subtotaljual =  $penjualan[$a]['qty_keluar'] * $penjualan[$a]['harga_jual'];
                                            echo number_format($subtotaljual);
                                            ?>
                                        </td>
                                        <td align="right"><?php echo number_format($penjualan[$a]['diskon']) ?></td>
                                        <td align="right">
                                            <?php
                                            $totaljual =  $subtotaljual -  $penjualan[$a]['diskon'];
                                            echo number_format($totaljual);
                                            ?>
                                        </td>
                                        <td align="right" style="background-color:#B9FFFF"><?php echo $penjualan[$a]['harga_beli'] ?></td>
                                        <td align="right" style="background-color:#B9FFFF">
                                            <?php
                                            $totalbeli =  $penjualan[$a]['qty_keluar'] *  $penjualan[$a]['harga_beli'];
                                            echo number_format($totalbeli);
                                            ?>
                                        </td>
                                        <td align="right" style="background-color:#A8FC9B">
                                            <?php
                                            $pendapatan =   $totaljual - $totalbeli;
                                            echo number_format($pendapatan);
                                            ?>
                                        </td>
                                        <?php
                                        $totalsBeli = $totalsBeli + $totalbeli;
                                        $totalsPendapatan = $totalsPendapatan + $pendapatan;
                                        ?>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td align="right" colspan="11">TOTAL</td>
                                <td align="right" style="background-color:#B9FFFF"><?php echo number_format($totalsBeli); ?></td>
                                <td align="right" style="background-color:#A8FC9B"><?php echo number_format($totalsPendapatan); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- </div> -->
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <br />
            <br />



        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        // window.addEventListener("load", window.print());
    </script>
</body>

</html>
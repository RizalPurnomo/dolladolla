<!DOCTYPE html>
<html>

<?php
$query = "SELECT * FROM profile WHERE id='1'";
$appName = $this->db->query($query)->result_array()[0]['appname'];
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $appName; ?> | Laporan Stock Barang</title>
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
                        <a href="<?php echo base_url('report/rptStock'); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png" width="100"> </a> <br />
                        <b>DOLLA DOLLA </b>
                    </h4>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-12">
                    <h5>
                        <b>
                            <center>LAPORAN STOCK BARANG</center>
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
                                <!-- <th style="width:10%">Id Pembelian</th> -->
                                <th style="width:10%">Id Barang</th>
                                <th style="width:10%">Tgl Pembelian</th>
                                <th style="width:15%">Barcode</th>
                                <th style="width:65%">Nama Barang</th>
                                <th style="width:5%">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($barang)) {
                                for ($a = 0; $a < count($barang); $a++) { ?>
                                    <?php $idbarang = $barang[$a]['id_pembelian_detail']; ?>
                                    <tr id="barang<?php echo $idbarang; ?>">
                                        <td><?php echo $a + 1 ?></td>
                                        <!-- <td><?php echo $idbarang ?></td> -->
                                        <td><?php echo $barang[$a]['id_barang'] ?></td>
                                        <td><?php echo $barang[$a]['tgl_pembelian'] ?></td>
                                        <td><?php echo $barang[$a]['barcode'] ?></td>
                                        <td><?php echo $barang[$a]['nama_barang'] ?></td>
                                        <td><?php echo $barang[$a]['stock'] ?></td>
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
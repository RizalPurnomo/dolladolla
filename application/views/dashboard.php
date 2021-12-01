<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>

<style type="text/css">
    * {
        font-size: 9pt;
        font-family: Segoe UI;

    }

    #refdocs {
        border: 0;
        padding: 2px;
    }

    #box1 {
        border: 1px solid rgb(170, 170, 170);
        width: 200px;
    }

    #box2 {
        width: 100%;
        display: block;
        position: relative;
        border-bottom: 1px solid rgb(170, 170, 170);
    }

    #container {
        height: 100px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    #list1 {
        width: 100%;
    }

    #list1 ul {
        margin: 0;
        padding: 0px;
        list-style-type: none;
    }

    #list1 li {
        cursor: default;
        padding: 2px;
    }

    .selected {
        background: rgb(228, 228, 228);
    }
</style>

<script type="text/javascript">
    window.onload = function() {

        refresh_list()

    }

    // function remove_selected_item() {

    //     if ( $('#list1 ul li').hasClass("selected") ) {

    //         alert("yup")
    //         $('#list1 ul li').remove()  
    //     }
    //     else {
    //         alert("nope")
    //     }
    // }

    function remove_selected_item() {
        $('#list1 ul li.selected').remove()
    }



    function refresh_list() {

        $('#list1 ul li').click(function() {
            $('#list1 ul li').removeClass('selected');
            $(this).addClass('selected');

            document.getElementById('refdocs').value = $(this).text()

        });

    }
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard v2</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Barang</span>
                            <span class="info-box-number"> <?php echo count($barang); ?> Items</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Penjualan</span>
                            <span class="info-box-number"><?php echo count($penjualan); ?> Transaksi</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pembelian</span>
                            <span class="info-box-number"><?php echo count($pembelian); ?> Transaksi</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"></span>
                            <span class="info-box-number"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- <div id="box1">
                <div id="box2"><input type="text" id="refdocs"></div>
                    <div id="container">
                        <div id="list1">
                            <ul>
                                <li>Coffee<span> X </span></li>
                                <li>Tea<span> X </span></li>
                                <li>Milk<span> X </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <input type="button" value="delete" onclick="remove_selected_item()"> -->



        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('footer'); ?>
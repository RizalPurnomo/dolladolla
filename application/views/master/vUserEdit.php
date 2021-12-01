<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    async function resetPassword() {
        const {
            value: password
        } = await Swal.fire({
            title: 'Reset Password',
            input: 'password',
            inputLabel: 'Password',
            inputPlaceholder: 'Reset Password',
            inputAttributes: {
                maxlength: 100,
                autocapitalize: 'off',
                autocorrect: 'off'
            }
        })

        if (password) {
            var dataArray = {
                "user": {
                    "password": CryptoJS.MD5(password).toString()
                }
            }

            console.log(dataArray);
            // return;
            $.ajax({
                type: "POST",
                data: dataArray,
                url: '<?php echo base_url('user/resetPassword/'); ?>' + $("#iduser").val(),
                success: function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password berhasil di RESET',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log(result);
                }
            })
        }
    }

    function updateData() {
        if ($("#username").val() == "" || $("#password").val() == "" || $("#realname").val() == "" || $("#level").val() == "") {
            Swal.fire({
                icon: 'warning',
                text: 'Harap Melengkapi Data!',
            })
            return;
        }

        var dataArray = {
            "user": {
                "id_user": $("#iduser").val(),
                "username": $("#username").val(),
                "realname": $("#realname").val(),
                // "password": $("#password").val(),
                "level": $("#level").val()
            }
        }

        console.log(dataArray);
        // return;
        $.ajax({
            type: "POST",
            data: dataArray,
            url: '<?php echo base_url('user/updateData/'); ?>' + $("#iduser").val(),
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Di Update',
                    showConfirmButton: false,
                    timer: 1500
                })
                console.log(result);
                window.location = "<?php echo base_url(); ?>user";
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
                    <h1 class="m-0 text-dark">Edit User</h1>
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
                            Input Data User
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
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Id</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="iduser" value="<?php echo $user[0]['id_user']; ?>" disabled placeholder="User Id">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" value="<?php echo $user[0]['username']; ?>" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Real Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="realname" value="<?php echo $user[0]['realname']; ?>" placeholder="Real Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <button type="button" class="col-sm-6 btn btn-block btn-primary" onclick="resetPassword()">Ganti Password</button>
                                        <!-- <input type="password" class="form-control" id="password" value="<?php echo $user[0]['password']; ?>" placeholder="Password"> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Level</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="level">
                                            <option value="" <?php if ($user[0]['level'] == "") {
                                                                    echo "selected";
                                                                } ?>>-- Pilih --</option>
                                            <option value="Administrator" <?php if ($user[0]['level'] == "Administrator") {
                                                                                echo "selected";
                                                                            } ?>>Administrator</option>
                                            <option value="Staff" <?php if ($user[0]['level'] == "Staff") {
                                                                        echo "selected";
                                                                    } ?>>Staff</option>

                                        </select>
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
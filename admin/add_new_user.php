<?php
include('connection/connection.php');
if ($_SESSION['USERTYPE'] == 2 || $_SESSION['USERTYPE'] == 3) {
    if (isset($_REQUEST['sub_btn'])) {
        $fnam = $_POST['fname'];
        $lnam = $_POST['lname'];
        $fathernam = $_POST['fathername'];
        $mail = $_POST['email'];
        $add = $_POST['address'];
        $gen = $_POST['gender'];
        if (isset($_POST['dept'])) {
            $dept = $_POST['dept'];
        } else {
            $dept = $_SESSION['DEPTID'];
        }
        $phone = $_POST['phone'];
        $check_query = "SELECT * FROM persons where `person_email`='$mail'";
        $result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($result) > 0) {
            header('location:add_new_user.php?account-already-exist=1');
        } else {


            $qy = "insert into persons(person_name, last_name, father_name, person_email, address, gender,phone) values('$fnam','$lnam','$fathernam','$mail','$add','$gen','$phone')";
            mysqli_query($con, $qy);

            //get max person id
            $max_person = "SELECT max(`person_id`) as max FROM `persons`";
            $result = mysqli_query($con, $max_person);

            while ($row = mysqli_fetch_array($result)) {
                $max_id = $row['max'];
            }

            //insertion in account table
            $account_data = "INSERT INTO accounts(`person_id`,`password`,`user_type`,`department_id`,`status`) values('$max_id','" . $_REQUEST['c_pass'] . "','1','$dept','1')";
//            die($account_data);
            $result2 = mysqli_query($con, $account_data);

            //redirect
            header('location:add_new_user.php?account-registered=1');
        }
    }
    ?>
    <!doctype html>
    <html lang="en">


        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>New User Adding | Complain Managment System GCUF main Campus</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
            <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
            <link rel="stylesheet" href="assets/libs/css/style.css">
            <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
            <link rel="stylesheet" href="../css/toastr.min.css">
        </head>

        <body>
            <!-- ============================================================== -->
            <!-- main wrapper -->
            <!-- ============================================================== -->
            <div class="dashboard-main-wrapper">
                <?php
                include 'components/head.php';
                include 'components/leftsidebar.php';
                ?>
                <!-- ============================================================== -->
                <!-- end left sidebar -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- wrapper  -->
                <!-- ============================================================== -->
                <div class="dashboard-wrapper">
                    <div class="container-fluid  dashboard-content">
                        <!-- ============================================================== -->
                        <!-- pageheader -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header">
                                    <h2 class="pageheader-title">Add New User</h2>
                                    <p class="pageheader-text">Complain Managment System</p>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a  class="breadcrumb-link">User</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Add New User</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end pageheader -->
                        <!-- ============================================================== -->

                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- valifation types -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">New User Form</h5>
                                    <div class="card-body">
                                        <form id="validationform" method="post">
                                            <?php
                                            if ($_SESSION['USERTYPE'] == 2) {
                                                ?>
                                                <div class="form-group row">
                                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Select Department</label>
                                                    <div class="col-12 col-sm-8 col-lg-6">
                                                        <select class="form-control" id="dept" name="dept">
                                                            <option value="0">Select Category</option>
                                                            <?php
                                                            $query = "SELECT * FROM `departments` where `dept_status`=1";
                                                            $result = mysqli_query($con, $query);
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                <option value="<?= $row['department_id'] ?>"><?= $row['department'] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >First Name</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <input type="text" class="form-control" name="fname" id="fname" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >Last Name</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <input type="text" class="form-control"  id="lname" name="lname" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >Father Name</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <input type="text" class="form-control" id="fathername" name="fathername" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >User Email</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <input type="text" class="form-control"  id="email" name="email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >User Phone</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <input type="number" class="form-control"  id="phone" name="phone">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >User Password</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <input type="password" class="form-control"  id="pass" name="pass">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >Confirm Password</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <input type="password" class="form-control"  id="c_pass" name="c_pass">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >User Address</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <textarea required="" class="form-control" id="address" name="address"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >Select Gender</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <select id="gender" name="gender" class="form-control">
                                                        <option value="00">Select Gender</option>
                                                        <option value="1">Male</option>
                                                        <option value="0">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row text-right">
                                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                    <button type="submit" name="sub_btn" onclick="return valid()" class="btn btn-space btn-primary">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end valifation types -->
                            <!-- ============================================================== -->
                        </div>

                    </div>
                    <!-- ============================================================== -->
                    <!-- footer -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- end footer -->
                    <!-- ============================================================== -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end main wrapper -->
            <!-- ============================================================== -->
            <!-- Optional JavaScript -->
            <?php
            include 'components/footerjs.php';
            ?>
            <script src="../js/toastr.min.js"></script>
            <script>
                                                        $('#form').parsley();
            </script>
            <?php
            if ($_SESSION['USERTYPE'] != 3) {
                ?>
                <script>
                    var department = $('#department').val();
                </script>


                <?php
            }
            ?>
            <script>
                //fields validation section
                function valid() {
                    var f_name, l_name, father_name, e_mail, p_pass, cp_pass, add, gen;
                    f_name = $('#fname').val();
                    l_name = $('#lname').val();
                    father_name = $('#fathername').val();
                    e_mail = $('#email').val();
                    p_pass = $('#pass').val();
                    cp_pass = $('#c_pass').val();
                    add = $('#address').val();
                    var gender = $('#gender').val();
                    var temp = 1;
                    if ($('#dept').val() == 0) {
                        alert("Select Department");
                        temp++;
                    }
                    if (gender == 00) {
                        alert("Select Gender");
                        temp++;
                    }
                    if (f_name == '') {
                        $('#fname').css('border', 'solid red 1px');
                        $('#error_f_name').css('display', 'block');
                        temp++;
                    } else {
                        $('#fname').css('border', 'solid gray 1px');
                        $('#error_f_name').css('display', 'none');
                    }
                    if (department == 0) {
                        toastr.options = {
                            "closeButton": true,
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.error('Department Not Selected!');
                        $('#department').css('border', 'solid red 1px');
                        temp++;
                    } else {
                        $('#department').css('border', 'solid gray 1px');
                    }

                    if (l_name == '') {
                        $('#lname').css('border', 'solid red 1px');
                        $('#error_l_name').css('display', 'block');
                        temp++;
                    } else {
                        $('#lname').css('border', 'solid gray 1px');
                        $('#error_l_name').css('display', 'none');
                    }
                    if (father_name == '') {
                        $('#fathername').css('border', 'solid red 1px');
                        $('#error_father_name').css('display', 'block');
                        temp++;
                    } else {
                        $('#fathername').css('border', 'solid gray 1px');
                        $('#error_father_name').css('display', 'none');
                    }
                    if (e_mail == '') {
                        $('#email').css('border', 'solid red 1px');
                        $('#error_email').css('display', 'block');
                        temp++;
                    } else {
                        $('#email').css('border', 'solid gray 1px');
                        $('#error_email').css('display', 'none');
                    }
                    if (p_pass == '') {
                        temp++;
                        $('#pass').css('border', 'solid red 1px');
                        $('#error_password').css('display', 'block');
                    } else {
                        $('#pass').css('border', 'solid gray 1px');
                        $('#error_password').css('display', 'none');
                    }
                    if (cp_pass == '') {
                        temp++;
                        $('#c_pass').css('border', 'solid red 1px');
                        $('#error_c_password').css('display', 'block');
                    } else {
                        $('#c_pass').css('border', 'solid gray 1px');
                        $('#error_c_password').css('display', 'none');
                    }
                    if (add == '') {
                        temp++;
                        $('#address').css('border', 'solid red 1px');
                        $('#error_address').css('display', 'block');
                        //                                                    return false;
                    } else {
                        $('#address').css('border', 'solid gray 1px');
                        $('#error_address').css('display', 'none');
                    }
                    if (temp != 1) {
                        return false;
                    }

                }
            </script>
            <?php
            if (isset($_GET['account-already-exist'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.error('Email Already Exist!');
                </script>
                <?php
            }
            ?>
            <?php
            if (isset($_GET['account-registered'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success('Account Created Successfuly!');
                </script>
                <?php
            }
            ?>
        </body>

    </html>
    <?php
}
?>
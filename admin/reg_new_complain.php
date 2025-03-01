<?php
include('connection/connection.php');
if ($_SESSION['USERTYPE'] == 1) {
    if (isset($_REQUEST['send_btn'])) {
        $dept_id = $_SESSION['DEPTID'];
        $cat_id = $_POST['cat'];
        $desc = $_POST['desc'];
        $date = date("Y-m-d");
        $query = "INSERT INTO complaint(department_id,category_id,description,date) values('$dept_id','$cat_id','$desc','$date')";
        mysqli_query($con, $query);
        $max_com = "SELECT max(`complaint_id`) as max FROM `complaint`";
        $result = mysqli_query($con, $max_com);
        while ($row = mysqli_fetch_array($result)) {
            $max_id = $row['max'];
        }
        $user_id = $_SESSION['USERID'];
        $link_query = "INSERT INTO user_complaint_link(complaint_id,person_id) values('$max_id','$user_id')";
        mysqli_query($con, $link_query);
        header("location:reg_new_complain.php?new_complain_registered=1");
    }
    ?>
    <!doctype html>
    <html lang="en">


        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Register Complian | Complain Managment System GCUF Sahiwal Campus</title>
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
                                    <h2 class="pageheader-title">Register New Complain</h2>
                                    <p class="pageheader-text">Complain Managment System</p>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a  class="breadcrumb-link">Register New Complain</a></li>
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
                                    <h5 class="card-header">Complain Form</h5>
                                    <div class="card-body">
                                        <form id="validationform" method="post">
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Select Category</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <select class="form-control" id="cat" name="cat">
                                                        <option value="0">Select Category</option>
                                                        <?php
                                                        $query = "SELECT * FROM `complain_category` where `compl_status`=1";
                                                        $result = mysqli_query($con, $query);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?= $row['category_id'] ?>"><?= $row['category'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        <option value="00">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >Complan Description</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <textarea required="" class="form-control" id="desc" name="desc"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row text-right">
                                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                    <button type="submit" name="send_btn" onclick="return valid()" class="btn btn-space btn-primary">Send</button>
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
        <script>
            function valid() {
                var category, desc;
                category = $('#cat').val();
                desc = $('#desc').val();
                $('#cat,#desc').css('border', 'solid green 1px');
                var temp = 1;
                if (category == 0) {
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.error('Category Not Selected!');
                    $('#cat').css('border', 'solid red 1px');
                    temp++;
                }
                if (desc == '') {
                    $('#desc').css('border', 'solid red 1px');
                    temp++;
                }
                if (temp != 1) {
                    return false;
                }
            }


            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function () {
                'use strict';
                window.addEventListener('load', function () {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
        <?php
        if (isset($_GET['new_complain_registered'])) {
            ?>
            <script type="text/javascript">
                toastr.options = {
                    "closeButton": true,
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success('Complain Registered Successfuly!');
            </script>
            <?php
        }
        ?>
    </body>

    </html>
    <?php
} else {
    header('location:error404.php');
}
?>
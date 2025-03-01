<?php
include('connection/connection.php');
if ($_SESSION['USERTYPE'] == 2 || $_SESSION['USERTYPE'] == 3) {
    if (isset($_REQUEST['sub_response'])) {
        if ($_FILES["fileToUpload"]["name"]) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
// Check if file already exists
            if (file_exists($target_file)) {
                $uploadOk = 0;
            }
// Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                header('location:complain_response.php?error');
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $query = 'insert into complain_response(complaint_id,description,file) values("' . $_GET['complain'] . '","' . $_REQUEST['desc'] . '","' . $target_file . '")';
                    $result = mysqli_query($con, $query);

                    $query = 'UPDATE `complaint` SET `com_status`=3 where `complaint_id`=' . $_GET['complain'];
                    $result = mysqli_query($con, $query);
                    header('location:all_complians.php?responded');
                } else {
                    header('location:complain_response.php?error');
                }
            }





            //
        } else {
            $query = 'insert into complain_response(complaint_id,description) values("' . $_GET['complain'] . '","' . $_REQUEST['desc'] . '")';
            $result = mysqli_query($con, $query);

            $query = 'UPDATE `complaint` SET `com_status`=3 where `complaint_id`=' . $_GET['complain'];
            $result = mysqli_query($con, $query);
            header('location:all_complians.php?responded');
        }
    }
    ?>
    <!doctype html>
    <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Complain response | Complain Managment System GCUF Main Campus</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
            <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
            <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
            <link rel="stylesheet" href="assets/libs/css/style.css">
            <link rel="stylesheet" href="../css/toastr.min.css">
        </head>

        <body>
            <!-- ============================================================== -->
            <!-- main wrapper -->
            <!-- ============================================================== -->
            <div class="dashboard-main-wrapper">
                <!-- ============================================================== -->
                <!-- navbar -->
                <!-- ============================================================== -->
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
                    <div class="container-fluid dashboard-content ">

                        <div class="row">
                            <div class="col-xl-12">
                                <!-- ============================================================== -->
                                <!-- pageheader  -->
                                <!-- ============================================================== -->
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="page-header" id="top">
                                            <h2 class="pageheader-title">Complain Detail </h2>
                                            <div class="page-breadcrumb">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                                        <li class="breadcrumb-item"><a  class="breadcrumb-link">Manage Complains</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page">Panding Complains</li>
                                                        <li class="breadcrumb-item active" aria-current="page">Complain Detail</li>
                                                    </ol>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ============================================================== -->
                                <!-- alignment  -->
                                <!-- ============================================================== -->
                                <?php
                                $query = 'SELECT * FROM `complaint` as com INNER join `departments` as dept on com.department_id=dept.department_id INNER join `complain_category` as comp_cat  ON com.category_id=comp_cat.category_id INNER JOIN user_complaint_link as c_l on com.complaint_id=c_l.complaint_id INNER JOIN persons as p ON p.person_id=c_l.person_id WHERE com.complaint_id=' . $_GET['complain'];
//    die($query);
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_array($result);
                                    ?>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="card" id="align">
                                                <h5 class="card-header">Applicant Name: <?= $row['person_name'] . ' ' . $row['last_name'] ?></h5>
                                                <div class="card-body">
                                                    <p class="text-left">Applicant Department: <?= $row['department'] ?></p>
                                                    <p class="text-left">Application Category: <?= $row['category'] ?></p>
                                                </div>
                                                <div class="card-body border-top">
                                                    <h3 class="text-center">Complain Description</h3>
                                                    <p class="text-center"><?= $row['description'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row">
                                    <!-- ============================================================== -->
                                    <!-- valifation types -->
                                    <!-- ============================================================== -->
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="card">
                                            <h5 class="card-header">Response Form</h5>
                                            <div class="card-body">
                                                <form id="validationform" data-parsley-validate="" method="post" novalidate="" enctype="multipart/form-data">
                                                    <div class="form-group row">
                                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Upload Response File(Not Nesessary)</label>
                                                        <div class="col-12 col-sm-8 col-lg-6">
                                                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-12 col-sm-3 col-form-label text-sm-right">Response Description</label>
                                                        <div class="col-12 col-sm-8 col-lg-6">
                                                            <textarea required="" name="desc" id="desc" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row text-right">
                                                        <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                            <button class="btn btn-space btn-secondary" name="sub_response" id="sub_response"  type="submit">Submit</button>
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
                                <!-- ============================================================== -->
                                <!-- end alignment  -->
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
            <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
            <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
            <script src="assets/libs/js/main-js.js"></script>
            <script src="../js/toastr.min.js"></script>

        </body>

    </html>
    <?php
}
?>
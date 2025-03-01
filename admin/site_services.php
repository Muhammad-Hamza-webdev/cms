<?php
include('connection/connection.php');
if ($_SESSION['USERTYPE'] == 2 || $_SESSION['USERTYPE'] == 3) {
    if (isset($_REQUEST['sub_btn'])) {
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
                header('location:site_services.php?error');
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $name = $_POST['s_name'];
                    $dec = $_POST['s_desc'];
                    $qy = "insert into services(service_tittle,pict,description) values('$name','$target_file','$dec')";
//                    die($qy);

                    $result = mysqli_query($con, $qy);

                    header('location:site_services.php?added');
                } else {
                    header('location:site_services.php?error');
                }
            }
        }
    }
    if (isset($_GET['disable'])) {
        $query = 'UPDATE `services` SET `ser_status`=0 where `service_id`=' . $_GET['disable'];
        $result = mysqli_query($con, $query);
        header('location:site_services.php?disabled');
    }
    if (isset($_GET['active'])) {
        $query = 'UPDATE `services` SET `ser_status`=1 where `service_id`=' . $_GET['active'];
        $result = mysqli_query($con, $query);
        header('location:site_services.php?actived');
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
                                    <h2 class="pageheader-title">Services Detail</h2>
                                    <p class="pageheader-text">Complain Managment System</p>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a  class="breadcrumb-link">Manage Site</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Services</li>
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
                                    <h5 class="card-header">New Services Form</h5>
                                    <div class="card-body">
                                        <form id="validationform" method="post" enctype="multipart/form-data">

                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >New Service Name</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <input type="text" class="form-control" required="" name="s_name" id="s_dept" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >Service description</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <textarea class="form-control" required="" name="s_desc" id="s_desc"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >Service picture</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <input type="file" class="form-control" required="" name="fileToUpload" id="fileToUpload" >
                                                </div>
                                            </div>
                                            <div class="form-group row text-right">
                                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                    <button type="submit" name="sub_btn"  class="btn btn-space btn-primary">Add</button>
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
                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- data table  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">All Services List</h5>
                                        <!--<p>All Services (Search for Specific Name)</p>-->
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.</th>
                                                        <th>Services</th>
                                                        <th>Picture</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = 'SELECT * FROM `services` ';
                                                    $result = mysqli_query($con, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        $sr = 1;
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $sr . "." ?></td>
                                                                <td><?= $row['service_tittle'] ?></td>
                                                                <td><?= $row['pict'] ?></td>
                                                                <td><?= $row['description'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['ser_status'] == 1) {
                                                                        echo '<span style="color: green">Active</span>';
                                                                    } else {
                                                                        echo '<span style="color: red">Dead</span>';
                                                                    }
                                                                    ?>

                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['ser_status'] == 1) {
                                                                        echo '<input type="button" value="Turn Off Service." onclick="return turn_off(' . $row['service_id'] . ')" class="btn btn-danger"/>';
                                                                    } else {
                                                                        echo '<input type="button" value="Turn On Service." onclick="return turn_on(' . $row['service_id'] . ')" class="btn btn-info"/>';
                                                                    }
                                                                    ?>

                                                                </td>

                                                            </tr>
                                                            <?php
                                                            $sr++;
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="4"><center>No Record Found</center></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end data table  -->
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
            <script>
                function turn_off(id) {
                    if (confirm("Are you sure you want to Disable Service?")) {
                        window.window.location.href = 'site_services.php?disable=' + id;
                    }
                }
                function turn_on(id) {
                    if (confirm("Are you sure you want to Active Service?")) {
                        window.window.location.href = 'site_services.php?active=' + id;
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
                    toastr.error('Service Already Exist!');
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
                    toastr.success('Service Created Successfuly!');
                </script>
                <?php
            }
            ?>
            <?php
            if (isset($_GET['disabled'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.error('Service Deactivated');
                </script>
                <?php
            }
            ?>
            <?php
            if (isset($_GET['actived'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success('Service Activated!');
                </script>
                <?php
            }
            ?>
            <?php
            if (isset($_GET['error'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.error('Not Uploaded, Try Again Latter!');
                </script>
                <?php
            }
            ?>
            <?php
            if (isset($_GET['added'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.success('Service Added!');
                </script>
                <?php
            }
            ?>
        </body>

    </html>
    <?php
}
?>
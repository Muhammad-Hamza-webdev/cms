<?php
include('connection/connection.php');
if ($_SESSION['USERTYPE'] == 2 || $_SESSION['USERTYPE'] == 3) {
    if (isset($_REQUEST['sub_btn'])) {
        $dpt = $_POST['dept'];
        $check_query = "SELECT * FROM departments where `department`='$dpt'";
        $result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($result) > 0) {
            header('location:department_detail.php?account-already-exist=1');
        } else {


            $qy = "insert into departments(department) values('$dpt')";
            mysqli_query($con, $qy);

            //get max person id
            //redirect
            header('location:department_detail.php?account-registered=1');
        }
    }
    if (isset($_GET['disable'])) {
        $query = 'UPDATE `departments` SET `dept_status`=0 where `department_id`=' . $_GET['disable'];
        $result = mysqli_query($con, $query);
        header('location:department_detail.php?disabled');
    }
    if (isset($_GET['active'])) {
        $query = 'UPDATE `departments` SET `dept_status`=1 where `department_id`=' . $_GET['active'];
        $result = mysqli_query($con, $query);
        header('location:department_detail.php?actived');
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
                                    <h2 class="pageheader-title">Department Detail</h2>
                                    <p class="pageheader-text">Complain Managment System</p>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a  class="breadcrumb-link">Manage Department</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Departments</li>
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
                                    <h5 class="card-header">New Department Form</h5>
                                    <div class="card-body">
                                        <form id="validationform" method="post">

                                            <div class="form-group row">
                                                <label class="col-12 col-sm-3 col-form-label text-sm-right" >New Department Name</label>
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <input type="text" class="form-control" required="" name="dept" id="dept" >
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
                                        <h5 class="mb-0">All Departments List</h5>
                                        <p>All Departments (Search for Specific Name)</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.</th>
                                                        <th>Department</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = 'SELECT * FROM `departments` ';
                                                    $result = mysqli_query($con, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        $sr = 1;
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $sr . "." ?></td>
                                                                <td><?= $row['department'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['dept_status'] == 1) {
                                                                        echo '<span style="color: green">Active</span>';
                                                                    } else {
                                                                        echo '<span style="color: red">Dead</span>';
                                                                    }
                                                                    ?>

                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['dept_status'] == 1) {
                                                                        echo '<input type="button" value="Turn Off Dept." onclick="return turn_off(' . $row['department_id'] . ')" class="btn btn-danger"/>';
                                                                    } else {
                                                                        echo '<input type="button" value="Turn On Dept." onclick="return turn_on(' . $row['department_id'] . ')" class="btn btn-info"/>';
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
                    if (confirm("Are you sure you want to Disable Department?")) {
                        window.window.location.href = 'department_detail.php?disable=' + id;
                    }
                }
                function turn_on(id) {
                    if (confirm("Are you sure you want to Active Department?")) {
                        window.window.location.href = 'department_detail.php?active=' + id;
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
                    toastr.error('Department Already Exist!');
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
                    toastr.success('Department Created Successfuly!');
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
                    toastr.error('Department Suspended!');
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
                    toastr.success('Department Activated!');
                </script>
                <?php
            }
            ?>
        </body>

    </html>
    <?php
}
?>
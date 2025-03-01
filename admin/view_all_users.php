<?php
include('connection/connection.php');
if ($_SESSION['USERTYPE'] == 2 || $_SESSION['USERTYPE'] == 3) {
    if (isset($_GET['disable'])) {
        $query = 'UPDATE `accounts` SET `status`=3 where `person_id`=' . $_GET['disable'];
        $result = mysqli_query($con, $query);
        header('location:view_all_users.php?disabled');
    }
    if (isset($_GET['active'])) {
        $query = 'UPDATE `accounts` SET `status`=1 where `person_id`=' . $_GET['active'];
        $result = mysqli_query($con, $query);
        header('location:view_all_users.php?actived');
    }
    ?>
    <!doctype html>
    <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>All User | Complain Managment System GCUF Main Campus</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
            <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
            <link rel="stylesheet" href="assets/libs/css/style.css">
            <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
            <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/dataTables.bootstrap4.css">
            <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/buttons.bootstrap4.css">
            <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/select.bootstrap4.css">
            <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
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
                    <div class="container-fluid  dashboard-content">
                        <!-- ============================================================== -->
                        <!-- pageheader -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header">
                                    <h2 class="pageheader-title">All Users</h2>
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a  class="breadcrumb-link">User</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">View All Users</li>
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
                            <!-- data table  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">All Users</h5>
                                        <p>All Departments (Search for Specific Name)</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.</th>
                                                        <th>Name</th>
                                                        <th>Father Name</th>
                                                        <th>Department</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($_SESSION['USERTYPE'] == 3) {
                                                        $query = 'SELECT * FROM `persons` AS p INNER JOIN `accounts` AS a on p.`person_id`=a.`person_id` INNER JOIN departments as d on a.`department_id`=d.`department_id` where a.`user_type`= 1 AND a.department_id=' . $_SESSION['DEPTID'];
                                                    } else {
                                                        $query = 'SELECT * FROM `persons` AS p INNER JOIN `accounts` AS a on p.`person_id`=a.`person_id` INNER JOIN departments as d on a.`department_id`=d.`department_id` where a.`user_type`= 1';
                                                    }
                                                    $result = mysqli_query($con, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        $sr = 1;
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $sr . "." ?></td>
                                                                <td><?= $row['person_name'] . ' ' . $row['last_name'] ?></td>
                                                                <td><?= $row['father_name'] ?></td>
                                                                <td><?= $row['department'] ?></td>
                                                                <td><?= $row['person_email'] ?></td>
                                                                <td><?= $row['phone'] ?></td>
                                                                <td><?= $row['address'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['status'] == 1) {
                                                                        echo '<span style="color: green">Active</span>';
                                                                    } else {
                                                                        echo '<span style="color: red">Dead</span>';
                                                                    }
                                                                    ?>

                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($row['status'] == 1) {
                                                                        echo '<input type="button" value="Turn Off Account" onclick="return turn_off(' . $row['person_id'] . ')" class="btn btn-danger"/>';
                                                                    } else {
                                                                        echo '<input type="button" value="Turn On Account" onclick="return turn_on(' . $row['person_id'] . ')" class="btn btn-info"/>';
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
                                                            <td colspan="8"><center>No Record Found</center></td>
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
            <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
            <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
            <script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script>
            <script src="assets/libs/js/main-js.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script src="assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
            <script src="assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
            <script src="assets/vendor/datatables/js/data-table.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
            <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
            <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
            <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
            <script src="../js/toastr.min.js"></script>
            <script>
                function turn_off(id) {
                    if (confirm("Are you sure you want to Disable account?")) {
                        window.window.location.href = 'view_all_users.php?disable=' + id;
                    }
                }
                function turn_on(id) {
                    if (confirm("Are you sure you want to Active account?")) {
                        window.window.location.href = 'view_all_users.php?active=' + id;
                    }
                }
            </script>
            <?php
            if (isset($_GET['disabled'])) {
                ?>
                <script type="text/javascript">
                    toastr.options = {
                        "closeButton": true,
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    toastr.error('Account Suspended!');
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
                    toastr.success('Account Activated!');
                </script>
                <?php
            }
            ?>
        </body>

    </html>
    <?php
}
?>
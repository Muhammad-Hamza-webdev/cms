<?php
include('connection/connection.php');
$queryPerson = 'SELECT * FROM `persons` AS p 
INNER JOIN `accounts` as a on p.`person_id`=a.`person_id` 
INNER JOIN `accounts_img` AS ai on p.`person_id`=ai.`user_img_id` 
WHERE p.`person_id`='. $_SESSION['USERID'];
$queryPerson = mysqli_query($con, $queryPerson);
$rowPerson = mysqli_fetch_array($queryPerson);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['USERID'];
    $fnam = $_POST['fname'];
    $lnam = $_POST['lname'];
    $fathernam = $_POST['fathername'];
    $mail = $_POST['email'];
    $add = $_POST['address'];
    $gen = $_POST['gender'];
    $dept = $_POST['department'];
    $phone = $_POST['phone'];
    $password = $_POST['c_pass']; // Consider hashing if not already hashed

    // Update user details
    $updateUserQuery = "UPDATE persons SET 
        person_name = ?, 
        last_name = ?, 
        father_name = ?, 
        person_email = ?, 
        address = ?, 
        gender = ?, 
        phone = ?
    WHERE person_id = ?";
    
    $stmt = mysqli_prepare($con, $updateUserQuery);
    mysqli_stmt_bind_param($stmt, "sssssssi", $fnam, $lnam, $fathernam, $mail, $add, $gen, $phone, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Update user account details
    $updateAccountQuery = "UPDATE accounts SET 
        password = ?, 
        department_id = ? 
    WHERE person_id = ?";
    
    $stmt = mysqli_prepare($con, $updateAccountQuery);
    mysqli_stmt_bind_param($stmt, "ssi", $password, $dept, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Check if user uploaded an image
    if (!empty($_FILES["pict"]["name"])) {
        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["pict"]["name"], PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . "." . $imageFileType; // Unique file name

        // Validate image type and size
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowedTypes) && $_FILES["pict"]["size"] < 5000000) { // 5MB limit
            if (move_uploaded_file($_FILES["pict"]["tmp_name"], $target_file)) {
                // Update image in accounts_img table
                $updateImageQuery = "UPDATE accounts_img SET pict = ? WHERE person_id = ?";
                $stmt = mysqli_prepare($con, $updateImageQuery);
                mysqli_stmt_bind_param($stmt, "si", $target_file, $userId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }

    header('Location: dashboard.php?update_success=1');
    exit();
}
?>


<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account Settings</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/images/Hajvery-University-logo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <?php
   include('components/custom-header.php');
    ?>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- header and nav bar code starts here -->
        <!-- ============================================================== -->
        <?php
                include 'components/head.php';
                include 'components/leftsidebar.php';
                ?>
        <!-- ============================================================== -->
        <!-- header and nav bar code end here -->
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
                            <h2 class="pageheader-title">User Account Settings </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php"
                                                class="breadcrumb-link">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Account Settings</li>
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
                    <!-- validation form -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">user name</h5>
                            <div class="card-body">
                                <form class="needs-validation" method="post" novalidate enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <label for="productImage" class="mt-2">Curent Image</label><br>
                                            <?php
                                                 if ($imgRow['pict']==NULL) { 
                                            ?>
                                            <i class="user-avatar-md rounded-circle fas fa-user-circle"
                                                style="font-size: 100px;"></i>
                                            <?php
                                                } else {
                                            ?>
                                            <img src="<?= $imgRow['pict'] ?>" alt="User Image"
                                                class="user-avatar-md rounded-circle"
                                                style="width: 100px; height: 100px; object-fit: cover;"
                                                alt="user Image">
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <label for="image">Image</label>
                                            <input type="file" name="pict" id="pict" class="form-control">
                                        </div>
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <label for="department">Select Department</label>
                                            <select class="form-control" id="department" name="department"
                                                style="width: 100%; text-indent: 5px;  height: 45px;background-color: white;">
                                                <option value=''>Select Department</option>
                                                <?php
                                            $query = "SELECT * FROM `departments` where `dept_status`=1";
                                            $query = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                <option selected value="<?= $row['department_id'] ?>">
                                                    <?= $row['department'] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                            </select>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter a select department.
                                            </div>
                                        </div>
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <label for="fname">First name</label>
                                            <input type="text" class="form-control" id="fname" name="fname"
                                                placeholder="First name" value="<?=$rowPerson['person_name']?>"
                                                required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter a first name.
                                            </div>
                                        </div>
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <label for="lname">Last name</label>
                                            <input type="text" class="form-control" id="lname" name="lname"
                                                placeholder="Last name" value="<?=$rowPerson['last_name']?>" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter a Last name.
                                            </div>
                                        </div>
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <label for="fathername">Father name</label>
                                            <input type="text" class="form-control" id="fathername" name="fathername"
                                                placeholder="Father name" value="<?=$rowPerson['father_name']?>"
                                                required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter a father name.
                                            </div>
                                        </div>
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email" value="<?=$rowPerson['person_email']?>" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter a email.
                                            </div>
                                        </div>
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <label for="phone">Phone</label>
                                            <input type="number" class="form-control" id="phone" name="phone"
                                                placeholder="Phone Number" value="<?=$rowPerson['phone']?>" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter a phone.
                                            </div>
                                        </div>
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <label for="c_pass">Password</label>
                                            <input type="text" class="form-control" id="c_pass" name="c_pass"
                                                placeholder="Password" value="<?=$rowPerson['password']?>" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter a password.
                                            </div>
                                        </div>
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Address" value="<?=$rowPerson['address']?>" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter a address.
                                            </div>
                                        </div>
                                        <!-- field -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <label for="fname">Gender</label>
                                            <select class="form-control" id="gender" name="gender"
                                                style="width: 100%; text-indent: 5px;  height: 45px;background-color: white;">
                                                <option value="1" <?= ($rowPerson['gender'] == 1) ? 'selected' : '' ?>>
                                                    Male
                                                </option>
                                                <option value="0" <?= ($rowPerson['gender'] == 0) ? 'selected' : '' ?>>
                                                    Female
                                                </option>
                                            </select>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter a first name.
                                            </div>
                                        </div>
                                        <!-- button -->
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-t-10">
                                            <button class="btn btn-success" type="submit">Update</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end validation form -->
                    <!-- ============================================================== -->
                </div>

            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="assets/vendor/parsley/parsley.js"></script>
    <script src="assets/libs/js/main-js.js"></script>
    <script>
    $('#form').parsley();
    </script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
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
</body>

</html>
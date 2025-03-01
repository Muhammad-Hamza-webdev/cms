<?php

$con = mysqli_connect('localhost', 'root', '', 'cms');
if ($con) {
    session_start();
//    echo "Connection Established";
} else {
    echo 'Error Connection';
}
//* ----------signup start-------- */
//* ----------signup end-------- */
?>
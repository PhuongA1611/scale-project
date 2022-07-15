<?php

$con = mysqli_connect("localhost", "root", "", "candientu");

if(!$con) {
    echo "Connection Failed" . mysqli_connect_error();
}
?>
<?php
  //koneksi ke database
  $con = mysqli_connect("localhost", "root", "", "candientu");
  //baca data yang dikirim oleh nodemcu
  $v_weight = $_GET["weight"];

  // if ($v_weight < 1000)
  // {
  //  //update data di database (table loadcell)
  // mysqli_query($con, "UPDATE loadcell SET weight='$v_weight', unit='Gr'");
  // }
  // else{
    $v_weight = $v_weight/1000;
  mysqli_query($con, "UPDATE loadcell SET weight='$v_weight', unit='Kg'");
  // }
?>
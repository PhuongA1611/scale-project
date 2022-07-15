<?php
  $con = mysqli_connect("localhost", "root", "", "candientu");

  //baca isi table loadcell
  $sql = mysqli_query($con, "SELECT * FROM loadcell");
  $data = mysqli_fetch_array($sql);
  $nilai = $data["weight"];
  // convert from lbs to kg
  echo $nilai;
 ?>

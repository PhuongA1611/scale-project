<?php 


$mysqli = new mysqli("localhost", "root", "", "candientu") or die(mysqli_error($mysqli));

$id = 0;
$name = '';
$weight='';
$cost='';
$costcal = '';

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from products WHERE id=$id") or die($mysqli->error);
    // if (count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $cost = $row['cost'];
    // }
}

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $weight = $_POST['weight'];
    $costcal = $_POST['costcal'];

    $mysqli->query("INSERT INTO history (name, cost, weight, costcal ) VALUES ('$name','$cost','$weight','$costcal')") or 
        die($mysqli->error);
     
    $_SESSION['message'] = "Lưu thành công!";
    $_SESSION['msg_type'] = "success";
    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM history WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Xóa thành công!";
    $_SESSION['msg_type'] = "danger";
    header("location: index.php");
}

?>
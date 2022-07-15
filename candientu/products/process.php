<?php 

$mysqli = new mysqli("localhost", "root", "", "candientu") or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$cost = '';

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $cost = $_POST['cost'];

    $mysqli->query("INSERT INTO products (name, cost) VALUES ('$name','$cost')") or 
        die($mysqli->error);
     
    $_SESSION['message'] = "Lưu thành công!";
    $_SESSION['msg_type'] = "success";
    header("location: products.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM products WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Xóa thành công!";
    $_SESSION['msg_type'] = "danger";
    header("location: products.php");
}

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

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $cost = $_POST['cost'];

    $mysqli->query("UPDATE products SET name='$name', cost='$cost' WHERE id=$id") or die($mysqli->error);

    header('location: products.php');
}
?>
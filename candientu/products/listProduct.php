<?php

$con = new mysqli("localhost", "root", "", "candientu") or die(mysqli_error($con));
$result = $con->query("SELECT * from products") or die($con->error);

?>
<div class="col">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá(VNĐ)</th>
                <th colspan="2"></th>
            </tr>
        </thead>
    <?php
    while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['cost']; ?></td>
            <td>
                <a href="products.php?edit=<?php echo $row['id']; ?>"
                    class="btn btn-warning">Sửa</a>
                <a href="products.php?delete=<?php echo $row['id']; ?>"
                    class="btn btn-danger">Xóa</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </table>
</div>
<?php
function pre_r($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>
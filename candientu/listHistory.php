<?php

$con = new mysqli("localhost", "root", "", "candientu") or die(mysqli_error($con));
$result = $con->query("SELECT * from history") or die($con->error);

?>
<div class="col-6">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá (VNĐ)</th>
                <th>Khối lượng (KG)</th>
                <th>Thành tiền (VNĐ)</th>
                <th colspan="1"></th>
            </tr>
        </thead>
    <?php
    while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['cost']; ?></td>
            <td><?php echo $row['weight']; ?></td>
            <td><?php echo $row['costcal']; ?></td>
            <td>
                <a href="index.php?delete=<?php echo $row['id']; ?>"
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
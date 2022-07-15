<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php require_once 'process.php'; ?>

    <?php 

    if (isset($_SESSION['message'])): ?>

    <div class="alert alert-danger" role="alert">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif; ?>
    <div class="container">
        <h1>Sản phẩm</h1>
        <div class="row justify-content-center">
            <div class="col-5">
                <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label>Tên sản phẩm:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <label>Giá(VNĐ):</label>
                        <input type="text" name="cost" class="form-control" value="<?php echo $cost; ?>">
                    </div>
                    <div class="form-group">
                        <?php
                        if ($update == true):
                        ?>
                        <button type="submit" class="btn btn-warning" name="update">Lưu</button>
                        <?php else: ?>
                        <button type="submit" class="btn btn-success" name="save">Lưu</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <?php require_once 'listProduct.php'; ?>
                
        </div>
    </div>
</body>
</html>
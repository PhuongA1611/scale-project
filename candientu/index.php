<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./main.css">
    <title>Cân điện tử</title>
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#search").keyup(function(){
                var name = $(this).val();
                if(name != "") {
                    $.post("livesearch.php", {name:name}, function(data){
                    $('div#back_result').css({'display':'block'});
                    $('div#back_result').html(data);
                })
                } else {
                    $('div#back_result').css({'display':'none'});
                }
            })
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $("#display").load('display.php');
            }, 1000);
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(mult, 1000);
        });
        function mult() {
            var value, cost, costcal;
            value = document.getElementById('weight').value;
            cost = document.getElementById('cost').value;
            costcal = cost * value;
            document.getElementById('cal_cost').value = costcal;
        }
    </script>
</head>
<body>
    <?php require_once 'history.php'; ?>
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
        <div class="row justify-content-center">
            <div class="col">
                <h1>Cân điện tử</h1>
                <div class="card">
                    <div class="card-body">
                        <h1 style='font-size:70px;'><span id="display"></span></h1>            
                    </div>  
                </div>
                <div class="form-group">
                    <button onclick="calcul()" id="calcul" class="btn btn-success" name="calcul">Tính toán</button>
                </div>
            </div>
            <div class="col-3">
                <form method="post" action="history.php">
                    <div class="form-group">
                        <label>Sản phẩm:</label>
                            <input type="text" class="form-control" id="search" name="name" value="<?php echo $name; ?>" placeholder="Tên sản phẩm">
                        <div id="back_result"></div>
                    </div>
                    <div class="form-group">
                            <label>Giá (VNĐ):</label>
                            <input type="text" name="cost" class="form-control" id="cost" value="<?php echo $cost; ?>">
                        </div>
                    <div class="form-group">
                        <label>Khối lượng (KG):</label>
                        <input type="text" name="weight" id="weight" class="form-control weight">
                    </div>
                    <div class="form-group">
                        <label>Thành tiền (VNĐ):</label>
                        <input type="text" name="costcal" class="form-control" id="cal_cost" >
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="save">Lưu</button>
                    </div>
                </form>
            </div>
            <?php require_once 'listHistory.php'; ?>
        </div>  
        
    </div>


    <script>
        function calcul(){
            w = document.getElementById('display').innerHTML;
            document.getElementById('weight').value = w;
        };
    </script>
</body>
    
</html>
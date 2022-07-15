<?php

include("config.php");

$query = "SELECT * FROM products WHERE name like '".$_POST['name']."%'";
$result = $con->query($query);
    
foreach($result as $key) {
    ?>
    <a href="index.php?edit=<?php echo $key['id']; ?>" id="product"><span><?php echo $key['name'] ?></span>: <span><?php echo $key['cost'] ?></span>vnđ</a>

    <?php
    
}
?>

<?php
require_once '../db/db.php';

if (isset($_POST['change_min'])) {
                
    $min_part=mysqli_real_escape_string($conn,$_POST['min_part']);
    $query_min="UPDATE `cot_min` SET `cotisation_minimum`='$min_part'";
    if($conn->query($query_min)){
        header("Location: ../settings?success=1");
    }else{
        header("Location: ../settings?error=1");
    }
   


}

?>
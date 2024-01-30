<?php
require_once './db/db.php';
$fgen_id=$_GET['gen_id'];
$gen_id=mysqli_real_escape_string($conn, $fgen_id);
$idd=$_GET['id'];
$id=mysqli_real_escape_string($conn, $idd);

$query="DELETE FROM credit WHERE id='$id'";

if($conn->query($query)){
        header('Location:./single_credit_details?id='.$gen_id.' && success=1');
}else{
        header('Location:./single_credit_detailsid='.$gen_id.' && error=1');
}

?>

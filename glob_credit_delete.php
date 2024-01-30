<?php
require_once './db/db.php';
$id=$_GET['id'];
$query="DELETE FROM `credit` WHERE gen_credit_id='$id'";

if($conn->query($query)){
        header('Location:./all_credits?success=1');
}else{
        header('Location:./all_credits?error=1');
}

?>

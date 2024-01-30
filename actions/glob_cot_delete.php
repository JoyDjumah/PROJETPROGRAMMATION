<?php
require_once '../db/db.php';
$id=$_GET['id'];
$query="DELETE FROM `cotisations` WHERE date='$id'";

if($conn->query($query)){
        header('Location:../all_members_cotisation?success=1');
}else{
        header('Location:../all_members_cotisation?error=1');
}

?>

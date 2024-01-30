<?php
require_once '../db/db.php';
$class_id=$_GET['id'];
$query="DELETE FROM membres WHERE id='$class_id'";

if($conn->query($query)){
        header('Location:../all_members?success=1');
}else{
        header('Location:../all_members?error=1');
}

?>

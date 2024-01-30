<?php
require_once '../db/db.php';
$class_id=$_GET['id'];
$query="DELETE FROM fed WHERE id='$class_id'";

if($conn->query($query)){
        header('Location:../docs_inspection?success=1');
}else{
        header('Location:../docs_inspection?error=1');
}

?>

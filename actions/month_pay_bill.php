

<?php
require_once '../db/db.php';
$idd=$_GET['id'];
$id=mysqli_real_escape_string($conn, $idd);

$query="UPDATE `credit` SET`due_monthly_account_status`='Payé' WHERE id='$id'";

if($conn->query($query)){
        header('Location:../monthly_due_credit?success=1');
}else{
        header('Location:../monthly_due_credit?error=1');
}

?>





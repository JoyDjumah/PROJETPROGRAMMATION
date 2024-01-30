

<?php
require_once './db/db.php';
$idd=$_GET['id'];
$id=mysqli_real_escape_string($conn, $idd);

$query="UPDATE `credit` SET`due_monthly_account_status`='Payé' WHERE gen_credit_id='$id'";
$query2="UPDATE `credit` SET`gen_account_status`='Reglé' WHERE gen_credit_id='$id'";

if($conn->query($query) && $conn->query($query2) ){
        header('Location:./single_credit_details?id='.$id.' && success=1');
}else{
        header('Location:./single_credit_details?id='.$id.' && error=1');
}

?>





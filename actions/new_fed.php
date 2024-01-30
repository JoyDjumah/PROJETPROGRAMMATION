<?php
require '../db/db.php';
if (isset($_POST['submit'])) {
    
    $t_mat=mysqli_real_escape_string($conn,$_POST['op_id']);

    $member_id=mysqli_real_escape_string($conn,$_POST['member_id']);
    $cot_amount=mysqli_real_escape_string($conn,$_POST['fed_account']);
    $clt_date=mysqli_real_escape_string($conn,$_POST['clt_date']);
    $amt=$cot_amount*0.02;
}

$query="INSERT INTO `fed`(`id`, `member_id`, `amount`, `opened_date`) VALUES ('$t_mat','$member_id','$amt','$clt_date')";
if($conn->query($query)){
    header('Location:../docs_inspection?success=1');
}else{
    header('Location:../docs_inspection?error=1'); 
}
?>
<?php
require '../db/db.php';
if (isset($_POST['submit'])) {
    
    $t_mat=mysqli_real_escape_string($conn,$_POST['op_id']);

    $member_id=mysqli_real_escape_string($conn,$_POST['member_id']);
    $cot_amount=mysqli_real_escape_string($conn,$_POST['cot_amount']);
    $clt_date=mysqli_real_escape_string($conn,$_POST['clt_date']);
}

$query="INSERT INTO `cotisations`(`cotisation_id`, `member_id`, `amount`, `date`) VALUES ('$t_mat','$member_id','$cot_amount','$clt_date')";
if($conn->query($query)){
    header('Location:../all_credits?success=1');
}else{
    header('Location:../all_credits?error=1'); 
}
?>
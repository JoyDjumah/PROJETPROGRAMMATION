<?php
require '../db/db.php';
if (isset($_POST['submit'])) {
    
    $t_mat=mysqli_real_escape_string($conn,$_POST['std_mat']);

    $t_fname=mysqli_real_escape_string($conn,$_POST['std_fname']);
    $t_mname=mysqli_real_escape_string($conn,$_POST['std_mname']);
    $t_lname=mysqli_real_escape_string($conn,$_POST['std_lname']);
    $t_sex=mysqli_real_escape_string($conn,$_POST['std_sex']);
    $t_bplace=mysqli_real_escape_string($conn,$_POST['std_bplace']);
    $t_bday=mysqli_real_escape_string($conn,$_POST['std_bday']);
    $t_phone=mysqli_real_escape_string($conn,$_POST['std_tel']);
    $t_adr=mysqli_real_escape_string($conn,$_POST['std_adresse']);
    $user_type=mysqli_real_escape_string($conn,$_POST['user_type']);
    $parts_account=mysqli_real_escape_string($conn,$_POST['parts_account']);
}

$query="INSERT INTO `membres`(`id`, `fname`, `postnom`, `prenom`, `sex`, `bplace`, `bday`, `phone`, `member_type`, `adress`, `parts`) VALUES ('$t_mat','$t_fname','$t_mname','$t_lname','$t_sex','$t_bplace','$t_bday','$t_phone','$user_type','$t_adr','$parts_account')";
if($conn->query($query)){
    header('Location:../all_members?success=1');
}else{
    header('Location:../all_members?error=1'); 
}
?>
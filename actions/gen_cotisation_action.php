<?php
require_once '../db/db.php';
$number =hexdec( uniqid());
$varray = str_split($number);
$len = sizeof($varray);
$otp = array_slice($varray, $len-2, $len);
$otp = implode(",", $otp);
$otp = str_replace(',', '', $otp);
$year= date("y-d-s");
$year = str_replace('-', '', $year);

$idgen= $year.$otp;

?>

<?php

if(isset($_POST['submit'])){
    foreach (($_POST['user_id']) as $key=> $value){
    //loop 
        
        $user_id=mysqli_real_escape_string($conn,$_POST['user_id'][$key]);
        $cot_id=mysqli_real_escape_string($conn,$_POST['cot_id'][$key]);
        $date=mysqli_real_escape_string($conn,$_POST['date']);
        $mpartsens=mysqli_real_escape_string($conn,$_POST['parts'][$key]);
      


        $query="INSERT INTO `cotisations`(`cotisation_id`, `member_id`, `amount`, `date`) VALUES ('$cot_id','$user_id','$mpartsens','$date')";
if($conn->query($query)){
    header('Location:../all_members_cotisation?success=1');
}else{
    header('Location:../all_members_cotisation?error=1'); 
};
    }}
?>
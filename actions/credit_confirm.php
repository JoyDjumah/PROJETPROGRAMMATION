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
    // generals and unique
        $member_id=mysqli_real_escape_string($conn,$_POST['member_id']);
        $tr_1=mysqli_real_escape_string($conn,$_POST['tr_1']);
        $mois_1=mysqli_real_escape_string($conn,$_POST['mois_1']);
        $mens_1=mysqli_real_escape_string($conn,$_POST['mens_1']);
        $total_due_m1=mysqli_real_escape_string($conn,$_POST['total_due_m1']);
        $credit_origine_amount=mysqli_real_escape_string($conn,$_POST['credit_origine_amount']);
        $interet_gen=mysqli_real_escape_string($conn,$_POST['interet_gen']);
        $total_due=mysqli_real_escape_string($conn,$_POST['total_due']);
        $member_id=mysqli_real_escape_string($conn,$_POST['member_id']);
         $tranchesnumbers=mysqli_real_escape_string($conn,$_POST['tranchesnumbers']);
         $interet_1=mysqli_real_escape_string($conn,$_POST['interet_1']);

    
    foreach (($_POST['mens']) as $key=> $value){
  
        
        $mois=mysqli_real_escape_string($conn,$_POST['mois'][$key]);
        $mens=mysqli_real_escape_string($conn,$_POST['mens'][$key]);
        $interet=mysqli_real_escape_string($conn,$_POST['interet'][$key]);
        $total_due_m=mysqli_real_escape_string($conn,$_POST['total_due_m'][$key]);
        $trnches_n=mysqli_real_escape_string($conn,$_POST['trnches_n'][$key]);
        $interet=mysqli_real_escape_string($conn,$_POST['interet'][$key]);
        
        $query="INSERT INTO `credit`(`cr_member_id`, `gen_credit_id`, `gen_credit_amount`, `tranches`,`tranche_number`, `due_month`, `due_amount`, `due_monthly_account_status`, `month_due_interet`, `gen_account_status`) VALUES
        ('$member_id','$idgen','$credit_origine_amount','$tranchesnumbers','$trnches_n','$mois','$total_due_m','Non Payé','$interet','Non Reglé')";
       
        $conn->query($query);

    };
   
}
$query2="INSERT INTO `credit`(`cr_member_id`, `gen_credit_id`, `gen_credit_amount`, `tranches`,`tranche_number`, `due_month`, `due_amount`, `due_monthly_account_status`, `month_due_interet`,`gen_account_status`) VALUES
    ('$member_id','$idgen','$credit_origine_amount','$tranchesnumbers','$tr_1','$mois_1','$total_due_m1','Non Payé','$interet_1','Non Reglé')";
    $conn->query($query2);



if($conn->query($query) && ($conn->query($query2))){
    header('Location:../all_credits?success=1');
}else{
    header('Location:../all_credits?error=1'); 
}
?>
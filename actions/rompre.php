<?php
require '../db/db.php';




if(isset($_POST['submit'])){
    foreach (($_POST['tranches']) as $key=> $value){
    $tranches =mysqli_real_escape_string($conn,$_POST['tranches'][$key]);
    $clot_all=mysqli_real_escape_string($conn,$_POST['clot_all']);
    $montant=mysqli_real_escape_string($conn,$_POST['montant'][$key]);
    $gen_credit_amount=mysqli_real_escape_string($conn,$_POST['gen_credit_amount']);
    $tranchesn=mysqli_real_escape_string($conn,$_POST['tranchesn']);
    $credit_id=mysqli_real_escape_string($conn,$_POST['credit_id'][$key]);
    $single_id=mysqli_real_escape_string($conn,$_POST['single_id'][$key]);
    $count=mysqli_real_escape_string($conn,$_POST['count']);

    $mensualite=$gen_credit_amount/$tranchesn;
    $refound=$mensualite*$count;



    echo $tranches.' '.$clot_all.' '.$montant.' '.$gen_credit_amount.' '.$tranchesn.' '.$credit_id.' '.$single_id.' '.$mensualite.' '.$refound.'$<p>';
        $query="UPDATE `credit` SET `due_amount`='$mensualite',`month_due_interet`='0',`due_monthly_account_status`='Payé',`gen_account_status`='Reglé' WHERE id='$single_id'";
        $query2="UPDATE `credit` SET `gen_account_status`='Reglé' WHERE gen_credit_id='$credit_id'";
        if($conn->query($query) && $conn->query($query2)){
            header("Location: ../interrompre_contrat?id=$credit_id && success=1");
        }else{
            header("Location: ../interrompre_contrat?id=$credit_id && error=1");
        }

    }

    

}
    


    


?>





</html>
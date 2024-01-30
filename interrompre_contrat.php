<?php
include './headers.php';
require './db/db.php';
 ?>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Header ] end -->
    <?php
    include './navbar.php';
    ?>
    <div class="separator" style="height:40px;"></div>

    <?php


$idd=$_GET['id'];
$id=mysqli_real_escape_string($conn, $idd);


$sqlquery="SELECT *, SUM(month_due_interet) FROM credit JOIN membres ON credit.cr_member_id=membres.id WHERE gen_credit_id='$id' GROUP BY gen_credit_id";
$result=mysqli_query($conn, $sqlquery);
$count=mysqli_num_rows($result);
if($count> 0){
while($row=mysqli_fetch_assoc($result)){
$interet=$row['SUM(month_due_interet)'];
$names=$row['fname'].' '.$row['postnom'].' '.$row['prenom'];
$borrow=$row['gen_credit_amount'];
$tranches=$row['tranches'];
$gen_status=$row['gen_account_status'];
}}

?>
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tableau de Bord</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#!"><?php echo $names ?></a></li>
                                <li class="breadcrumb-item"><a href="#!"> CREDIT N°: <?php echo $id ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row">
    
                <div class="col-xl-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3><?php echo number_format($borrow, 2, ',',' '); ?> $</h3>
                                    <h6 class="text-muted m-b-0">Montant du Prêt<i
                                            class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart1" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3><?php echo number_format($interet, 2, ',',' '); ?> $</h3>
                                    <h6 class="text-muted m-b-0">Intérêt sur Prêt<i
                                            class="fa fa-caret-up text-c-green m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart2" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3><?php  echo number_format($interet+$borrow, 2, ',',' '); ?> $</h3>
                                    <h6 class="text-muted m-b-0">Total à Rembourser<i
                                            class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                                </div>
                                <div class="col-3">
                                    <div id="seo-chart3" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <?php $effectif="SELECT *, SUM(due_amount) FROM credit JOIN membres ON credit.cr_member_id=membres.id WHERE gen_credit_id='$id' AND due_monthly_account_status!='Payé' GROUP BY gen_credit_id";
                                    $result_eff=mysqli_query($conn, $effectif);
                                    $count_eff=mysqli_num_rows($result_eff);
                                    if($count_eff> 0){
                                    while($row_eff=mysqli_fetch_assoc($result_eff)){
                                    $pay_effe=$row_eff['SUM(due_amount)'];
                                    
                                }}else{
                                    $pay_effe=0;
                                }

                                    ?>
                                    <h3><?php echo number_format($pay_effe, 2, ',',' '); ?> $</h3>
                                    <h6 class="text-muted m-b-0">Reste à Remboursement<i
                                            class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart1" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h3><?php $rest=($interet+$borrow)-$pay_effe; echo number_format($rest, 2, ',',' '); ?>
                                        $</h3>
                                    <h6 class="text-muted m-b-0">Remboursement effectué<i
                                            class="fa fa-caret-up text-c-green m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart2" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h3><?php echo  $tranches ?> Tranches</h3>
                                    <h6 class="text-muted m-b-0">Nombre des Tranches du Prêt<i
                                            class="fa fa-caret-up text-c-green m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart2" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-12">
                    <form action="./actions/rompre.php" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <h5> Toutes les Tranches du Credit N° <?php echo $id ?> non Payées</h5>
                                <br>Status General :
                                <?php if($gen_status=="Reglé")
                             { echo '<span class="badge badge-success" style="font-size:16px;"><b>'.$gen_status.'</b></span>';
                             } else{ echo '<span class="badge badge-danger" style="font-size:16px;"><b>'.$gen_status.'</b></span>';} ?>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Montant à Rembourser</th>
                                                <th>ECHEANCES</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $sqlquery="SELECT * FROM `credit` WHERE `gen_credit_id`='$id' AND due_monthly_account_status!='Payé' order by due_amount DESC ";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        
                                        $n=0;
                                        
                                        if($count> 0){
                                          while($rows=mysqli_fetch_assoc($result)){
                                            $n++;
                                           
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $rows['tranche_number']  ?> <input
                                                        value="<?php echo $rows['tranche_number']  ?>" type="hidden"
                                                        name="tranches[]"> </td>
                                                <td><?php echo $rows['due_amount'] ?> $ <input
                                                        value="<?php echo $rows['due_amount'] ?>" type="hidden"
                                                        name="montant[]">

                                                    <input value="<?php echo $rows['gen_credit_amount'] ?>"
                                                        type="hidden" name="gen_credit_amount">

                                                    <input value="<?php echo $rows['tranches'] ?>" type="hidden"
                                                        name="tranchesn">
                                                </td>
                                                <td><?php echo $rows['due_month'] ?> <input
                                                        value="<?php echo $rows['due_month'] ?>" type="hidden"
                                                        name="mois[]"> </td>
                                                <td><?php echo $rows['due_monthly_account_status'] ?> <input
                                                        type="hidden"
                                                        value="<?php echo $rows['due_monthly_account_status'] ?>"
                                                        type="hidden" name="status[]"> </td>

                                                <input type="hidden" value="<?php echo $rows['gen_credit_id'] ?>"
                                                    name="credit_id[]">

                                                <input type="hidden" value="<?php echo $rows['id'] ?>"
                                                    name="single_id[]">
                                                <input type="hidden" value="<?php echo $count ?>"
                                                    name="count">

                                            </tr>
                                            <?php }} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>


                <div class="separator" style="hieght:30px;">

                </div>
                <?php  if ($gen_status=='Non Reglé') { ?>


                <div class="col-12">
                    <div class="row">

                        <div class="row p-2">
                            <div class="col-md-6"><input class="form-control" type="month" name="clot_all" id=""></div>
                            <div class="col-md-6">
                                <input class="btn btn-success" name="submit" type="submit" value="Clôturer">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

                <?php        } ?>
                <!-- Latest Customers start -->

                <!-- Latest Customers end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

    <!-- Apex Chart -->
    <script src="assets/js/plugins/apexcharts.min.js"></script>


    <!-- custom-chart js -->
    <script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>
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
            <h5 class="d-center"> <?php echo $names ?></h5>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">

            
                <p style="page-break-after: always;"></p>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5> Toutes les Tranches du Credit N° <?php echo $id ?> de <?php echo $names ?></h5>
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
                                            <th class="hidden">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlquery="SELECT * FROM `credit` WHERE `gen_credit_id`='$id' order by due_amount DESC ";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        
                                        $n=0;
                                        
                                        if($count> 0){
                                          while($rows=mysqli_fetch_assoc($result)){
                                            $n++;
                                           
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo $rows['tranche_number']  ?> </td>
                                            <td><?php echo $rows['due_amount'] ?> $</td>
                                            <td><?php echo $rows['due_month'] ?></td>
                                            <td><?php echo $rows['due_monthly_account_status'] ?> </td>
                                            <td class="hidden"><a style="color:red"
                                                    href="single_duplicate?id=<?php echo $rows['id'] ?> && gen_id=<?php echo $id ?>"><i
                                                        class="feather icon-trash-2"
                                                        style="color: rgb(238, 54, 54); font-size: 20px;padding: 5px; margin:5px"></i></a>
                                            </td>
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
                <div class="col-md-4">
                    <a href="./pay_general_bill?id=<?php echo $id ?>" style="width:100%; float:right"
                        class="btn btn-primary">Regler la dette Entière</a></td>
                </div>

                <div class="col-md-4">
                    <a href="./interrompre_contrat?id=<?php echo $id ?>" style="width:100%; float:right"
                        class="btn btn-danger">Interrompre le Contrat</a></td>
                </div>

                <?php        } ?>
               
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
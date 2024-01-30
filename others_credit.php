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


    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tous les Crédits</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">Crédits</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
           
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5> Remboursements des Credits </h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Noms</th>
                                            <th>Montant </th>
                                            <th>Montant </th>
                                            <th>Echeance</th>
                                            <th>Status</th>
                                            <th>Payé</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $newDate=date('F-Y');
                                        $sqlquery="SELECT *, (credit.id) as credit_id  FROM credit JOIN membres ON credit.cr_member_id=membres.id WHERE due_monthly_account_status!='Payé' ORDER BY tranche_number ASC";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        
                                        $n=0;
                                        
                                        if($count> 0){
                                          while($row=mysqli_fetch_assoc($result)){
                                            $n++;
                                            $status=$row['due_monthly_account_status'];
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo $n ?></td>
                                            <td><?php echo $row['fname'].' '.$row['postnom'].' '.$row['prenom'] ?></td>
                                            <td><?php echo $capital=$row['due_amount']  ?> $</td>
                                            <td><?php echo $row['tranche_number'] ?></td>
                                            <td><?php echo  $row['due_month'] ?> </td>
                                            <?php if ($status=='Payé') {
                                                echo '<td style="color:green">'.$status.'</td>';
                                                # code...
                                            }else{
                                                echo '<td style="color:red">'.$status.'</td>';
                                            } ?>
                                            <td>
                                            <?php if ($status=='Payé') {
                                                
                                                # code...
                                            }else{
                                                echo '<a href="./actions/month_pay_bill?id='.$row['credit_id'].'" class="btn btn-primary">Regler la dette</a></td>';
                                            } ?>
                                            </td>


                                        </tr>
                                        <?php }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                

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
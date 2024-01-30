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
                            <h5> Tous les Crédits</h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Noms</th>
                                            <th>Montants du Prêt</th>
                                            <th>Tranches</th>
                                            <th>Debut</th>
                                            <!-- <th>Fin</th> -->
                                            <th>Montant à Rembourser</th>
                                            <th>Status</th>
                                            <th class="hidden">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlquery="SELECT *, SUM(month_due_interet) FROM credit JOIN membres ON credit.cr_member_id=membres.id GROUP BY gen_credit_id";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        
                                        
                                        $n=0;
                                        
                                        if($count> 0){
                                            $sqlquery2="SELECT *, SUM(month_due_interet) FROM credit JOIN membres ON credit.cr_member_id=membres.id WHERE tranche_number='Tranche 1'";
                                            $result2=mysqli_query($conn, $sqlquery2);
                                            $count2=mysqli_num_rows($result2);
                                            
                                            if($count2> 0){
                                              while($rows2=mysqli_fetch_assoc($result2)){
                                                $debuter=$rows2['due_month'];
                                              }}


                                              $crediTotl_acc=0;
                                              $crediTotRem_acc=0;
                                            $crediTotl=0;
                                              
                                          while($row=mysqli_fetch_assoc($result)){
                                            $interet=$row['SUM(month_due_interet)'];
                                            $tranches=$row['tranches'];
                                            $tr=$tranches-1;
                                           


                                            $n++;
                                            $t=$n+3;
                                            $fin=date('F-Y', strtotime('+'.$tr.' month'));
                                            $debut=date('F-Y', strtotime($debuter));
                                            ?>
                                        <tr>
                                            <td><?php echo $n ?></td>
                                            <td><?php echo $names= $row['fname'].' '.$row['postnom'].' '.$row['prenom'] ?>
                                            </td>
                                            <td><b><?php  $capital=$row['gen_credit_amount']; echo number_format($capital,2, ',',' ')  ?> $</b></td>
                                            <td><?php echo $row['tranches'] ?> Tranches</td>
                                            <td><?php echo $debut;  ?> </td>
                                            <!-- <td><?php // echo $fin  ?> </td> -->
                                            <td><b><?php  $rembours=($interet + $capital); echo number_format($rembours,2, ',',' ')   ?> $</b></td>

                                            <td><?php echo $row['gen_account_status'] ?> </td>

                                            <td class="hidden">
                                                <a
                                                    href="./single_credit_details?id=<?php echo  $row['gen_credit_id'] ?> "><i
                                                        class="feather icon-eye"
                                                        style="color: rgb(0, 0, 150); font-size: 20px;;padding: 5px; margin:5px"></i></a></a>

                                                <a style="color:red"
                                                    href="./view_glob_credit_delete?id=<?php echo  $row['gen_credit_id'] ?> && names=<?php echo $names ?>"><i
                                                        class="feather icon-trash-2"
                                                        style="color: rgb(238, 54, 54); font-size: 20px;padding: 5px; margin:5px"></i></a>




                                            </td>
                                        </tr>
                                        <?php 
                                    $crediTotl_acc+=$rembours;
                                    $crediTotl+=$capital;
                                    }} ?>
                                        <tr>
                                            <td colspan="2"><center><b>TOTAL</b></center></td>
                                            <td><b><?= number_format($crediTotl,2, ',',' ') ?> $</b></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?= number_format($crediTotl_acc,2, ',',' ') ?> $</b></td>
                                            <td></td>
                                            <td></td>

                                        </tr>
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

    
    <script src="assets/js/plugins/apexcharts.min.js"></script>

    <script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>
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
    
    <?php
    include './navbar.php';
    ?>
    <div class="separator" style="height:40px;"></div>

    <div class="pcoded-main-container">
        <div class="pcoded-content">
           
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12 p-2">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tableau de Bord</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./dashboard"><i class="feather icon-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">Tableau de Bord</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">

                <div class="col-12">
                    <?php
                                                if(isset($_GET['error']) && $_GET['error']==1){
                                                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Une erreur s'est produite!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>



                    </div>
                    <?php
                                                }
                                       ?>
                    <?php
                                                if(isset($_GET['success']) && $_GET['success']==1){
                                                    ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Opération reussie avec succès!</strong><br>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <?php
                                                }
                                       ?>

                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Toutes les Cotisations</h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mois</th>
                                            <th>Montants</th>
                                            <th class="hidden">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlquery="SELECT *, SUM(amount)FROM cotisations JOIN membres ON cotisations.member_id=membres.id GROUP BY date ORDER BY date DESC";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        $n=0;
                                        $total=0;
                                        if($count> 0){
                                          while($row=mysqli_fetch_assoc($result)){
                                            
                                            $n++;
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo $n ?></td>
                                            <td><?php echo $row['date'] ?></td>
                                            <td><b><?php $sum=($row['SUM(amount)']); echo number_format($sum,2, ',',' ')  ?> $</b></td>

                                            <td class="hidden">
                                                <a href="./single_month_details?id=<?php echo  $row['date'] ?> "><i
                                                        class="feather icon-eye"
                                                        style="color: rgb(0, 0, 150); font-size: 20px;;padding: 5px; margin:5px"></i></a></a>

                                               


                                                <a href="./view_glob_month_cot_delete?id=<?php echo  $row['date'] ?> ">
                                                    <i class="feather icon-trash-2"
                                                        style="color: rgb(350, 30, 30); font-size: 20px;padding: 5px; margin:5px"></i>





                                            </td>
                                        </tr>
                                        <?php $total+=$sum ;}} ?>
                                        <tr>
                                            <td colspan="2"><center><b>TOTAL</b></center></td>
                                            <td><b><?= number_format($total, 2 ,',',' ') ?> $</b></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
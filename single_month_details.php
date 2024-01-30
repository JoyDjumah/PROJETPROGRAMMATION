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
    <div class="hb_nav">
        <?php
    include './navbar.php';
    ?>
    </div>
    <div class="separator" style="height:40px;"></div>


    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
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
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
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
                            <h5>Toutes les Cotisations du mois de <?php echo $_GET['id'] ?></h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mois</th>
                                            <th></th>
                                            <th>Motant</th>
                                            <th>Telephone</th>
                                            <th>MOIS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $date_get=$_GET['id'];
                                        $sqlquery="SELECT * FROM cotisations JOIN membres ON cotisations.member_id=membres.id WHERE date='$date_get'";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        $n=0;
                                        
                                        if($count> 0){
                                          while($row=mysqli_fetch_assoc($result)){
                                            $n++;
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo $n ?></td>
                                            <td><?php echo $row['fname'].' '.$row['postnom'].' '.$row['prenom'] ?></td>
                                            <td><?php echo $row['sex'] ?></td>
                                            <td><?php echo $row['amount']  ?> $</td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td><?php echo $row['date'] ?></td>

                                        </tr>
                                        <?php }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                </div>
                    <?php
                    $idd=$_GET['id'];
                    $id=mysqli_real_escape_string($conn, $idd);
                    ?>




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
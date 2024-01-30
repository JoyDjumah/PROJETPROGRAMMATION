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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nouvelle Cotisation</h5>
                            <?php
                                
                                $sqlquery="SELECT * FROM cot_min limit 1";
                                $result=mysqli_query($conn, $sqlquery);
                                $count=mysqli_num_rows($result);
                                
                                if($count> 0){
                                  while($row=mysqli_fetch_assoc($result)){
                                   $min=$row['cotisation_minimum'];
                                   $i=1;
                                }}
                                ?>
                            <?php
                                $number =hexdec( uniqid());
                                $varray = str_split($number);
                                $len = sizeof($varray);
                                $otp = array_slice($varray, $len-6, $len);
                                $otp = implode(",", $otp);
                                $otp = str_replace(',', '', $otp);
                                $year= date("m-d-s");
                                $idgen= 'COTISATION-'.$otp.$year;
                            ?>
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="POST" action="./actions/new_cotisation_action">
                                <div class="col-md-3 "><label class="form-label ">Date</label><input type="month"
                                        name="clt_date" class="form-control "></div>
                                        <div class="separator" style="height:30px;"></div>
                                        
                                <table class="table">
                                    <thead>
                                        <th>N°</th>
                                        <th>Noms</th>
                                        <th>Cotisations</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlquery="SELECT * FROM membres WHERE member_type='Membre'";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        if($count> 0){
                                        while($row=mysqli_fetch_assoc($result)){
                                        $parts=$row['parts'];
                                        ?>
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $row['fname'].' '.$row['postnom'] ?></td>
                                            <td> <input type="text" value="<?php echo  $parts * $min?>"> </td>
                                        </tr>


                                        <?php }}?>
                                    </tbody>

                                </table>





                                <div class="col-md-12 p-2">
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Enregister" name="submit">
                                        <button type="reset" class="btn btn-secondary">Annuler</button>
                                    </div>
                                </div>
                            </form>
                            <!-- End Multi Columns Form -->

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
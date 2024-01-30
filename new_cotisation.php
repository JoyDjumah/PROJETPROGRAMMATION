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
                                  echo  $min=$row['cotisation_minimum'];
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
                                <input type="hidden" name="op_id" class="form-control" id="inputName5"
                                    value="<?php echo $idgen ?>" required readonly>

                                <div class="col-md-6 ">
                                    <label class="form-label ">Membre </label>
                                    <select name="member_id" class="form-control">
                                        <option value="" selected disable>Selectionner un Membre</option>
                                        <?php
                                        $sqlquery="SELECT * FROM membres WHERE member_type='Membre' ORDER BY parts desc";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        
                                        if($count> 0){
                                          while($row=mysqli_fetch_assoc($result)){
                                            $parts=$row['parts'];
                                            ?>
                                        <option value="<?php echo $row['id'] ?>">
                                            <?php echo $row['fname'].' '.$row['postnom'].' '.$parts ?></option>

                                        <?php }}?>
                                    </select>
                                </div>
                               
                                <div class="col-md-3">
                                    <label for="inputName5" class="form-label">Montant</label>
                                <input type="hidden" name="cot_amount" value="<?php echo  $parts * $min?>">
                                </div>

                                <div class="col-md-3 "><label class="form-label ">Date</label><input type="month"
                                        name="clt_date" class="form-control "></div>

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
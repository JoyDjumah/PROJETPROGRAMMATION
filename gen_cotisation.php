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
                <div class="col-lg-12 hidden">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Selectionner un Mois </h5>

                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="POST">
                                <div class="col-md-1 ">
                                    <label for="date">Mois</label>
                                </div>
                                <div class="col-md-3 "><input type="month" required name="clt_date"
                                        class="form-control">
                                </div>
                                <div class="col-md-3 ">
                                    <input type="submit" class="btn btn-primary" value="Generer" name="mois">
                                </div>
                            </form>
                            <!-- End Multi Columns Form -->

                        </div>
                    </div>

                </div>
                <?php 
               if (isset($_POST['mois'])) {
                ?>

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
                            <form class="row g-3" method="POST" action="./actions/gen_cotisation_action">


                                <table class="table" style="width:100%">
                                    <thead>
                                        <th>N°</th>
                                        <th>Mois</th>
                                        <th>Noms</th>
                                        <th>Parts</th>
                                        <th>Valeur Unitaire</th>
                                        <th>Cotisations</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlquery="SELECT * FROM membres WHERE member_type='Membre' ORDER BY parts desc";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        if($count> 0){
                                        $globval=0;
                                        $globpart=0;
                                        $globmins=0;
                                        while($row=mysqli_fetch_assoc($result)){
                                        $parts=$row['parts'];
                                        $number =hexdec( uniqid());
                                        $varray = str_split($number);
                                        $len = sizeof($varray);
                                        $otp = array_slice($varray, $len-6, $len);
                                        $otp = implode(",", $otp);
                                        $otp = str_replace(',', '', $otp);
                                        $year= date("m-d-s");
                                        $idgen= 'COTISATION-'.$otp.$year;
                                        ?>
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <input type="hidden" name="cot_id[]" value="<?php echo $idgen ?>">
                                            <td><?php echo $newDate=date('F-Y',strtotime($_POST['clt_date']));
                                             ?>
                                                <input type="hidden" name="date" value="<?php echo $newDate ?>">
                                            </td>
                                            <td><?php echo $row['fname'].' '.$row['postnom'] ?></td>
                                            <input type="hidden" name="user_id[]" value="<?php echo $row['id'] ?>">
                                            <td><?php echo $parts ?></td>
                                            <td><?php echo $min ?> $</td>
                                            <td> <input type="hidden" name="parts[]"
                                                    value="<?php echo  $vals=$parts * $min?>"><?php echo  $parts * $min?>
                                                $
                                            </td>
                                        </tr>


                                        <?php 
                                    $globpart+=$parts;
                                    $globval+=$vals;
                                    $globmins+=$min;
                                    
                                    }}?>
                                        <tr>
                                            <td colspan="3">
                                                <center><b>TOTAL</b></center>
                                            </td>
                                            <td><b><?= $globpart ?></b></td>
                                            <td></td>
                                            <td><b><?= $globval ?></b></td>
                                        </tr>
                                    </tbody>



                                </table>





                                <div class="col-md-12 p-2 hidden">
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



                <?php }
               
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
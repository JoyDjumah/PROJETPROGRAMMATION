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
<style>
    @media print {
    * {
        font-family: Arial;
        background: white;
        font-size: 15px;
    }
    
    }
</style>

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
                            <h5 class="card-title">Selectionner un Mois Pour generer le rapport</h5>

                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="POST">
                                <div class="col-md-1 ">
                                    <label for="date">Mois</label>
                                </div>
                                <div class="col-md-3 "><input type="month" required name="clt_date"
                                        class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" class="btn btn-primary" value="Generer" name="mois">
                                </div>
                            </form>
                            <!-- End Multi Columns Form -->

                        </div>
                    </div>

                </div>
                <?php 
               if (isset($_POST['mois'])) {
             $newDate=date('F-Y',strtotime($_POST['clt_date']))
                ?>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">SITUATION CASAK-ULPGL / <?php echo $newDate ?></h5>
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



                            <table class="table" style="width:100%">
                                <thead>
                                    <th>N°</th>
                                    <th>Noms</th>
                                    <th>Cotisations</th>
                                    <th>Remboursement</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $sqlquery="SELECT *,(membres.id)as tit_id FROM `membres` LEFT JOIN cotisations ON membres.id=cotisations.member_id  AND date='$newDate' GROUP BY membres.id";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        if($count> 0){
                                            $totalC=0;
                                            $totlCotisation=0;
                                            $totlCcredit=0;
                                        while($row=mysqli_fetch_assoc($result)){
                                            $gen=$row['tit_id'];
                                        
                                        
                                        $credit_q="SELECT * FROM `membres` LEFT JOIN credit ON membres.id=credit.cr_member_id AND due_month='$newDate' AND due_monthly_account_status='Non Payé' WHERE membres.id='$gen' GROUP BY membres.id;";
                                        $credi_r=mysqli_query($conn, $credit_q);
                                        $res_count=mysqli_num_rows($credi_r);
                                        if($res_count> 0){
                                        while($cr_row=mysqli_fetch_assoc($credi_r)){
                                          $credit=$cr_row['due_amount'];
                                         }}
                                        
                                        ?>

                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo $row['fname'].' '.$row['postnom'] ?></td>
                                        <td><b><?php   $cot=$row['amount']; echo number_format($cot,'2', ',', ' ') ?></b> </td>
                                        <td><b><?php echo number_format($credit, '2',',', ' ') ?> $</b> </td>
                                        <td><b><?php  $otal=$cot + $credit; echo number_format($otal, '2',',', ' ') ?> $</b></td>
                                    </tr>


                                    <?php $totalC+=$otal;
                                $totlCotisation+=$cot;
                                $totlCcredit+=$credit; }}?>
                                    <tr>
                                        <td colspan="2"><center><b>TOTAL</b></center></td>
                                        
                                        <td><b><?= number_format($totlCotisation,'2',',',' ') ?></b></td>
                                        <td><b><?= number_format($totlCcredit,'2',',',' ') ?></b></td>
                                        <td><b><?= number_format($totalC,'2',',',' ') ?></b></td>
                                    </tr>

                                </tbody>

                            </table>

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
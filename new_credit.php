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
                        <div class="card-body">
                            <h5 class="card-title">Accorder un Crédit</h5>
                            <?php
                                               $number =hexdec( uniqid());
                                               $varray = str_split($number);
                                               $len = sizeof($varray);
                                               $otp = array_slice($varray, $len-6, $len);
                                               $otp = implode(",", $otp);
                                               $otp = str_replace(',', '', $otp);
                                               $year= date("m-d-s");
                                               $idgen= 'CREDIT-'.$otp.$year;
                                            ?>
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="POST" action="./new_credit_action">
                                <input type="hidden" name="op_id" class="form-control" id="inputName5"
                                    value="<?php echo $idgen ?>" required readonly>

                                <div class="col-md-3">
                                    <label class="form-label ">Membre </label>
                                    <select name="member_id" class="form-control">
                                        <option value="" selected disabled>Selectionner un Membre</option>
                                        <?php
                                        $sqlquery="SELECT * FROM membres";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        
                                        if($count> 0){
                                          while($row=mysqli_fetch_assoc($result)){
                                            
                                            ?>
                                        <option value="<?php echo $row['id'] ?>">
                                            <?php echo $row['fname'].' '.$row['postnom']?></option>



                                        <?php }}?>
                                    </select>
                                </div>

                                <div class="col-md-3 ">
                                    <label class="form-label ">Type de Crédit </span></label>
                                    <select id="tut_selector" onchange="f1()" name="credit_type" class="form-control">
                                        <option value="" disabled="" selected="">Selectionnez un Type</option>
                                        <option value="Normal">Normal</option>
                                        <option value="Express">Express</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputName5" class="form-label">Montant</label>
                                    <input type="number" required name="credit_account" min="0" step="0.1" class="form-control"
                                        id="inputName5">
                                    <label style="margin-top:-35px;margin-right:50px; float:right; margin-bottom:35px;"
                                        for="">USD</label>
                                </div>

                                <div class="col-md-3">
                                    <label for="inputName5" class="form-label">Debut Pret</label>
                                    <input type="month" required name="clt_date" class="form-control" required>
                                </div>








                                <div id="titu_name" style="display:none" class="col-md-3">
                                    <label class="form-label">Mensualités</label>
                                    <!-- <input type="date" name="clt_date" class="form-control "> -->
                                    <input type="number" required value="1" name="mens_nbre" step="1" min="1" class="form-control"
                                        id="mensual">
                                    <label style="margin-top:-35px;margin-right:50px; float:right; margin-bottom:35px;"
                                        for="">MOIS</label>
                                </div>
                                <div class="col-md-12 p-2">
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Enregister" name="submit">
                                        <button type="reset" class="btn btn-secondary">Annuler</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

            <script src="assets/js/vendor-all.min.js"></script>
            <script src="assets/js/plugins/bootstrap.min.js"></script>
            <script src="assets/js/pcoded.min.js"></script>
           
            <script src="assets/js/plugins/apexcharts.min.js"></script>

            <script src="assets/js/pages/dashboard-main.js"></script>

            <script>
            function f1() {;
                var v = document.getElementById("tut_selector");
                var v1 = document.getElementById("titu_name");
                if (v.value == "Express") {
                    v1.style.display = 'none';
                } else {
                    v1.style.display = 'block';
                }
            }
            </script>

</body>

</html>
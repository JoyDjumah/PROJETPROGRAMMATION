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
                                <li class="breadcrumb-item"><a href="#!">Demande des Crédits</a></li>
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

                <div class="col-md-8 hidden">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Frais d'Etude du dossier</h5>
                            <?php
                                               $number =hexdec( uniqid());
                                               $varray = str_split($number);
                                               $len = sizeof($varray);
                                               $otp = array_slice($varray, $len-6, $len);
                                               $otp = implode(",", $otp);
                                               $otp = str_replace(',', '', $otp);
                                               $year= date("m-d-s");
                                               $idgen= 'FED-'.$otp.$year;
                                            ?>
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="POST" action="./actions/new_fed.php">
                                <input type="hidden" name="op_id" class="form-control" id="inputName5"
                                    value="<?php echo $idgen ?>" required readonly>

                                <div class="col-md-4">
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


                                <div class="col-md-4">
                                    <label for="inputName5" class="form-label">Montant du prêt demandé</label>
                                    <input type="number" required name="fed_account" min="0" step="0.1"
                                        class="form-control" id="inputName5">
                                    <label style="margin-top:-35px;margin-right:50px; float:right; margin-bottom:35px;"
                                        for="">USD</label>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputName5" class="form-label">Date d'Enregistrement</label>
                                    <input type="date" required name="clt_date" class="form-control" id="inputName5">

                                </div>




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
                   
                    <em style="color:red">Le montant des frais d'Etude du dossier est fixé à 2% du Crédit Demandé pour
                        tout nouveau Membre</em>


                </div>
            </div>
            <div class="divisor hidden" style="height:80px"></div>

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tous les Frais de Dossier</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped" id="tables">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Noms</th>
                                        <th>Sexe</th>
                                        <th>Categorie</th>
                                        <th>Montant</th>
                                        <th class="hidden">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sqlquery="SELECT  *,(fed.id)as OpId FROM `fed` JOIN membres ON membres.id=fed.member_id";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        
                                        if($count> 0){
                                          while($row=mysqli_fetch_assoc($result)){
                                            
                                            ?>
                                    <tr>
                                        <td><?php echo $row['OpId'] ?></td>
                                        <td><?php echo $names= $row['fname'].' '.$row['postnom'].' '.$row['prenom'] ?>
                                        </td>
                                        <td><?php echo $row['sex'] ?></td>
                                        <td><?php echo $row['member_type'] ?></td>
                                        <td><?php echo $row['amount'] ?> $</td>
                                        <td class="hidden">
                                            
                                           


                                            <a style="color:red"
                                                href="./actions/delete_fed.php?id=<?php echo $row['OpId'] ?>"><i
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

            <script src="assets/js/vendor-all.min.js"></script>
            <script src="assets/js/plugins/bootstrap.min.js"></script>
            <script src="assets/js/pcoded.min.js"></script>

            <!-- Apex Chart -->
            <script src="assets/js/plugins/apexcharts.min.js"></script>


            <!-- custom-chart js -->
            <script src="assets/js/pages/dashboard-main.js"></script>

            <script>
            function f1() {
                // document.write('option changed!');
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
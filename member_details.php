<?php
include './headers.php';
require './db/db.php';
$idd=$_GET['id'];
$id=mysqli_real_escape_string($conn, $idd);
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
    <?php
            $sqlquery="SELECT * FROM membres WHERE id='$id'";
            $result=mysqli_query($conn, $sqlquery);
            $count=mysqli_num_rows($result);

            if($count> 0){
            while($row=mysqli_fetch_assoc($result)){
            $user_data=$row['fname'].' '.$row['postnom'].' '.$row['prenom'];
            $sex=$row['sex'];
            $u_type=$row['member_type'];
            $phone=$row['phone'];
            $fname=$row['fname'];
            $mname=$row['postnom'];
            $lname=$row['prenom'];
            $bplace=$row['bplace'];
            $bday=$row['bday'];
            $parts=$row['parts'];


            }
            }?>



    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->

            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">


            </div>
            <section class="section profile align-center">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-3">
                            <img class="img-fluid card-img-top" style="height:200px; object-fit:cover"
                                src="./assets/images/auth/img-auth-big.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="card-title text-center"><?php echo $user_data ?></h3>

                                <div class="details">
                                    Noms : <b><?php echo $fname ?></b> <br>
                                    Post Nom : <b><?php echo $mname ?></b> <br>
                                    Prenon : <b><?php echo $lname ?></b> <br>
                                    Type d'Utilisateur : <b><?php echo $u_type ?></b> <br>
                                    <?php
                                    if ($u_type=="Membre") {
                                    echo 'Nombre des Parts :'.$parts.'<br>';
                                    # code...
                                    }
                                    ?>


                                    Sexe : <b><?php echo $sex ?></b> <br>
                                    Lieu et Date de Naissance :<b><?php echo $bplace ?>, le <?php echo $bday ?></b>
                                    <br>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">ACTIONS</h5>
                            </div>
                            <div class="card-footer">
                                <a class="btn  btn-primary  col-12 m-1" data-toggle="collapse" href="#collapseExample"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">Credits</a>
                                <?php if ($u_type=="Membre") {?>
                                    <a class="btn  btn-primary  col-12 m-1" data-toggle="collapse" href="#cotisations"
                                    role="button" aria-expanded="false" aria-controls="cotisations">Cotisations</a>
                                <?php } ?>
                                <a href="./delete_member_view?id=<?php echo $id ?> && names=<?php echo $user_data ?>"
                                    class="btn  btn-danger col-12 m-1">Supprimer le Compte</a>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-xl-12">
                    <div class="collapse" id="cotisations">
                        <div class="card">

                            <div class="card-body">
                                <div class="card-header">
                                    <h5 class="card-title">TOUTES LES COTISATIONS DE <b><?php echo $user_data ?></b></h5>
                                </div>
                                <div class="card-body">

                                    <div class="col-md-12">
                                        <table class="table table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>MOIS</th>
                                                    <th>Montants</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        $sqlquery="SELECT * FROM `cotisations` WHERE member_id=$id";
                                                        $result=mysqli_query($conn, $sqlquery);
                                                        $count=mysqli_num_rows($result);

                                                        $n=0;

                                                        if($count> 0){
                                                        while($row=mysqli_fetch_assoc($result)){
                                                        $n++;

                                                        ?>
                                                <tr>
                                                    <td><?php echo $n ?></td>
                                                    <td><?php echo $row['date'] ?>
                                                    </td>
                                                    <td><?php echo $row['amount']  ?> $</td>


                                                </tr>
                                                <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="collapse" id="collapseExample">
                        <div class="card">

                            <div class="card-body">
                                <div class="card-header">
                                    <h5 class="card-title">TOUS LES CREDITS DE <?php echo $user_data ?></b></h5> <b>
                                </div>
                                <div class="card-body">

                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Noms</th>
                                                    <th>Montants du Prêt</th>
                                                    <th>Tranches</th>
                                                    <th>Montant à Rembourser</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        $sqlquery="SELECT *, SUM(month_due_interet) FROM credit JOIN membres ON credit.cr_member_id=membres.id WHERE membres.id=$id  GROUP BY gen_credit_id";
                                                        $result=mysqli_query($conn, $sqlquery);
                                                        $count=mysqli_num_rows($result);

                                                        $n=0;

                                                        if($count> 0){
                                                        while($row=mysqli_fetch_assoc($result)){
                                                        $interet=$row['SUM(month_due_interet)'];
                                                        $n++;

                                                        ?>
                                                <tr>
                                                    <td><?php echo $n ?></td>
                                                    <td><?php echo $row['fname'].' '.$row['postnom'].' '.$row['prenom'] ?>
                                                    </td>
                                                    <td><?php echo $capital=$row['gen_credit_amount']  ?> $</td>
                                                    <td><?php echo $row['tranches'] ?> Tranches</td>
                                                    <td><?php echo $interet + $capital  ?> $</td>

                                                    <td><?php echo $row['gen_account_status'] ?> </td>

                                                    <td>
                                                        <a
                                                            href="./single_credit_details?id=<?php echo  $row['gen_credit_id'] ?> "><i
                                                                class="feather icon-eye"
                                                                style="color: rgb(0, 0, 150); font-size: 20px;;padding: 5px; margin:5px"></i></a></a>






                                                    </td>
                                                </tr>
                                                <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




        </div>
        </section>
















        <script src="assets/js/vendor-all.min.js"></script>
        <script src="assets/js/plugins/bootstrap.min.js"></script>
        <script src="assets/js/pcoded.min.js"></script>

        <!-- Apex Chart -->
        <script src="assets/js/plugins/apexcharts.min.js"></script>


        <!-- custom-chart js -->
        <script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>
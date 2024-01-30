<?php
require './db/db.php';
include './headers.php';
if (isset($_POST['submit'])) {
    
    $op_id=mysqli_real_escape_string($conn,$_POST['op_id']);
    $member_id=mysqli_real_escape_string($conn,$_POST['member_id']);
    $sqlquery="SELECT * FROM membres WHERE id='$member_id'";
    $result=mysqli_query($conn, $sqlquery);
    $count=mysqli_num_rows($result);
    
    if($count> 0){
      while($row=mysqli_fetch_assoc($result)){
        $member_type=$row['member_type'];
        $names=$row['fname'].' '.$row['postnom'].' '.$row['prenom'];
        $sexe=$row['sex'];

      }
    }
    $credit_type=mysqli_real_escape_string($conn,$_POST['credit_type']);
    $credit_account=mysqli_real_escape_string($conn,$_POST['credit_account']);
    if ($credit_type=="Normal") {
        $mens_nbre=mysqli_real_escape_string($conn,$_POST['mens_nbre']);
       
        if($member_type=="Membre"){
            $tax="2";
        }else{
            $tax="3";
        }
       
    }elseif($credit_type=="Express") {
        $mens_nbre="12";
        $tax="5";

    };
  
    


    


}
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
    <div class="separator" style="height:60px;"></div>


    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container" style="align-self: center; align-items: center; align-content: center">
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
            <form action="./actions/credit_confirm.php" method="POST">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="print card" style="width:100%">
                            <div class="card-body">

                                <?php
                                     'OP Num :'.$op_id.'; Membre '.$member_id.
                                    '; Status: '.$member_type.';Type de Credit: '.$credit_type.'; Montant '
                                    .$credit_account.'; Nmbre de Mois : '.$mens_nbre.' Taux : '.$tax.'%'.' Mensualite='.$mensualite=$credit_account / $mens_nbre;
                                    $nombre=$credit_account / $mens_nbre;

                                    ?>

                                <p></p>
                                <div class="pagecontent">
                                    <div class="title" style="text-align:center">
                                        <div class="col-md-12" style="text-align:left">
                                            <img src="./favicon.png" alt="" style="width:50px">
                                        </div>
                                        <h5 style="margin-bottom:45px;" class="card-title">MONEY TRANSACTION ULPGL</h5>
                                    </div>

                                    <div class="header" style="font-size:16px">
                                        Moi, <b><?php echo $names ?></b> je reconnais, par le présent contrat, avoir
                                        pris un
                                        emprunt d'un montant de <b><?php echo $credit_account ?> Dollars</b> (
                                        <b>.......montant en
                                            toutes lettres.........</b>) auprès de la CASAK/ULPGL que je compte
                                        rembourser
                                        en
                                        <b><?php echo $mens_nbre ?> Tranches</b>, avec un Intérêt de
                                        <b><?php echo $tax ?>
                                            %</b>
                                        du montant restant, suivant les modalités reprises dans le tableau suivant :
                                        <p></p>
                                    </div>
                                    <div class="table" style="padding:10px;">
                                        <table class="table table-hover" style="width:100%">
                                            <thead>
                                                <th>Tranches</th>
                                                <th>Mois</th>
                                                <th>Montant Fixe</th>
                                                <th>Intérêts Régressif</th>
                                                <th>Montant à Payer</th>

                                            </thead>
                                            <tbody>



                                                <tr>
                                                    <td> <input type="text" value="Tranche 1" class="credit"
                                                            name="tr_1"> </td>
                                                    <td> <input type="text" class="credit"
                                                            value="<?php echo $today=date('F-Y'); ?>" name="mois_1">
                                                    </td>
                                                    <td><b> $ <input type="text" class="credit"
                                                                value="<?php echo $mensualite ?>" name="mens_1"></b>
                                                    </td>
                                                    <td><b> $ <input type="text" class="credit"
                                                                value="<?php echo $interet1 =(($credit_account-0)*$tax)/100 ?>"
                                                                name="interet_1"> </b></td>
                                                    <td><b> $ <input type="text" class="credit"
                                                                value="<?php echo $mensualite+$interet1 ?>"
                                                                name="total_due_m1"> </b></td>
                                                </tr>
                                                <?php 
                                                $anuiites=NULL;
                                                $interetgenerals=NULL;
                                                
                                                    for ($i=2; $i <= $mens_nbre ; $i++) {
                                                         $start=date('F-Y', strtotime('+'.$i.' month'));
                                                         $anuiites+=$mensualite;
                                                         ?>
                                                <tr>

                                                    <td><input type="text" value="Tranche <?php echo $i ?>"
                                                            class="credit" name="trnches_n[]"></td>

                                                        <input type="text" name="nbre_duplicator[]">
                                                    <td> <input type="text" value="<?php echo $start ?>" class="credit"
                                                            name="mois[]"> </td>
                                                    <td>$ <input type="text" value="<?php echo $nombre ?>" class="credit" name="mens[]"></td>
                                                    <td><b>$ <input type="text" class="credit"
                                                                value="<?php echo $interet =(($credit_account-$anuiites)*$tax)/100  ?>"
                                                                name="interet[]"> </b></td>
                                                    <td><b>$ <input type="text" class="credit"
                                                                value="<?php echo $mensualite+$interet ?>"
                                                                name="total_due_m[]"> </b> </td>
                                                    <?php ;
                                                    $interetgenerals+=$interet ?>
                                                    <?php $interetgeneral=$interet1+ $interetgenerals; ?>
                                                </tr>
                                                <?php
                                                        }
                                                    
                                                    ?>

                                            </tbody>
                                            <tfoot style="background:skyblue">
                                                <th>TOTAL</th>
                                                <th><b><?php echo $mens_nbre ?> Mois</b></th>
                                                <th><b>$ <?php echo $credit_account ?> <input type="hidden"
                                                            value="<?php echo $credit_account ?>"
                                                            name="credit_origine_amount"> </b></th>
                                                <th><b>$ <?php echo $interetgeneral ?><input type="hidden"
                                                            value="<?php echo $interetgeneral ?>" name="interet_gen">
                                                    </b> </th>
                                                <th><b>$ <?php echo $interetgeneral + $credit_account ?> <input
                                                            type="hidden"
                                                            value="<?php echo $interetgeneral + $credit_account ?>"
                                                            name="total_due"> </b></th>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="" style="width:50%">
                                                Pour MONEY TRANSACTION
                                                <br>Le Président
                                                <p></p>
                                            </div>
                                            <div id="benef" class="" style="float:right; width:50%;">
                                                Le Bénéficiaire
                                                <br><?php echo $names ?>
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="NB" style="text-align:center; margin-top:80px;">
                                            N.B : Je m'engage au respect strict de ce contrat sous peine de sanction
                                            d'une
                                            amande de 5% du montant non remboursé.
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?php echo $member_id ?>" name="member_id">
                                    <input type="hidden" value="<?php echo $mens_nbre ?>" name="tranchesnumbers">

                                </div>

                            </div>

                        </div>
                        <div class="btn_submit" style="text-align:center">
                            <input class="btn btn-success" type="submit" name="submit" value="CONFIRMEZ LE CONTRAT">
                        </div>
                    </div>




                </div>
            </form>

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
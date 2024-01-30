<?php
include './headers.php';
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
                                <li class="breadcrumb-item"><a href="#!">Nouveau Membre</a></li>
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
                            <h5 class="card-title">Informations sur le Membre</h5>
                            <?php
                                               $number =hexdec( uniqid());
                                               $varray = str_split($number);
                                               $len = sizeof($varray);
                                               $otp = array_slice($varray, $len-6, $len);
                                               $otp = implode(",", $otp);
                                               $otp = str_replace(',', '', $otp);
                                               $year= date("m-d-s");
                                               $idgen= $otp;
                                            ?>
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="POST" action="./actions/new_member_action">
                                <input type="hidden" name="std_mat" class="form-control" id="inputName5"
                                    value="<?php echo $idgen ?>" required readonly>
                                <div class="col-md-3">
                                    <label for="inputName5" class="form-label"> Nom </label>
                                    <input type="text" class="form-control" name="std_fname" id="inputName5" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputName5" class="form-label">Post nom </label>
                                    <input type="text" class="form-control" name="std_mname" id="inputName5" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputName5" class="form-label">Prenom </label>
                                    <input type="text" class="form-control" name="std_lname" id="inputName5" required>
                                </div>
                                <div class="col-md-3 ">
                                    <label class="form-label ">Sexe </label>
                                    <select name="std_sex" class="form-control" required>
                                        <option value="M">Masculin</option>
                                        <option value="F">Féminin</option>
                                    </select>
                                </div>
                                <div class="col-md-3 "><label class="form-label ">Lieu de Naissance</label><input
                                        type="test" name="std_bplace" class="form-control "></div>
                                <div class="col-md-3 "><label class="form-label ">Date de Naissance</label><input
                                        type="date" name="std_bday" class="form-control "></div>


                                <div class="col-md-3">
                                    <label for="inputName5" class="form-label">N° de Téléphone</label>
                                    <input type="tel" name="std_tel" class="form-control" id="inputName5">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputName5" class="form-label"> Type de Membre</label>
                                    <select name="user_type" onchange="f1()" required id="user_type" class="form-control">
                                        <option value="" selected disabled>Selectionner une Catégorie</option>
                                        <option>Débiteur</option>
                                        <option>Membre</option>
                                    </select>

                                </div>

                                <div class="col-md-3" id="parts_account" style="display:none">
                                    <label for="inputName5" class="form-label">Nombre de Parts</label>
                                    <input type="number"  value="0" name="parts_account" min="0" step="1" class="form-control"
                                        id="inputName5">
                                    <label style="margin-top:-35px;margin-right:50px; float:right; margin-bottom:35px;"
                                        for="">PARTS</label>
                                </div>

                                <div class="col-md-9">
                                    <label for="inputCity" class="form-label">Adresse</label>
                                    <input type="text" name="std_adresse" class="form-control" id="inputCity">
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
                var v = document.getElementById("user_type");
                var v1 = document.getElementById("parts_account");
                if (v.value == "Débiteur") {
                    v1.style.display = 'none';
                } else {
                    v1.style.display = 'block';
                }
            }
            </script>
</body>

</html>
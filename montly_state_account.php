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
    <
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
                                <li class="breadcrumb-item"><a href="#!">Situation CASAK-ULPGL<?php echo $_GET['id'] ?></a></li>
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
                            <h5>Tous les Membres</h5>
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
                                            <th>Telephone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlquery="SELECT * FROM membres";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        
                                        if($count> 0){
                                          while($row=mysqli_fetch_assoc($result)){
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $names= $row['fname'].' '.$row['postnom'].' '.$row['prenom'] ?></td>
                                            <td><?php echo $row['sex'] ?></td>
                                            <td><?php echo $row['member_type'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td>
                                                <a href="member_details?id=<?php echo  $row['id'] ?> "><i
                                                        class="feather icon-eye"
                                                        style="color: rgb(0, 0, 150); font-size: 20px;padding: 5px; margin:5px"></i></a>
                                                <button data-toggle="modal" data-target="#exampleModalLive" name="btn"
                                                    id='<?php echo $row["id"] ?>' class='btn btn-primary'
                                                    style="background:none; border:none"><i class="feather icon-edit"
                                                        style="color: rgb(0, 0, 0); font-size: 20px;padding: 5px; margin:5px"></i></button>

                                                        
                                                <a style="color:red"
                                                    href="delete_member_view?id=<?php echo $row['id'] ?> && names=<?php echo $names ?>"><i
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

            </div>







            <div class="modal fade" id="myModal" data-bs-target="#myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"> Informations sur le Membre </h4>

                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            Modal body..
                        </div>

                        <!-- Modal footer -->

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
            $(document).ready(function() {
                $('.btn').click(function() {
                    id_emp = $(this).attr('id')
                    $.ajax({
                        url: "edit_member.php",
                        method: 'post',
                        data: {
                            emp_id: id_emp
                        },
                        success: function(result) {
                            $(".modal-body").html(result);
                        }
                    });


                    $('#myModal').modal("show");
                })
            })
            </script>
</body>

</html>
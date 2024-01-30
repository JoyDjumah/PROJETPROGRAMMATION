<?php
include './headers.php';
require './db/db.php';
 ?>

<body class="">
    
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <?php
    include './navbar.php';
    ?>
    <div class="separator" style="height:60px;"></div>


    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tableau de Bord</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">Tableau de Bord</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                
               
                <div class="col-xl-6 col-md-12 d-none">
                    <div class="card table-card">
                        
                        
                    </div>
                </div>
                
                <div class="col-md-12 col-xl-4">
                    <div class="card support-bar overflow-hidden">
                        <?php
                            $sqlquery="SELECT COUNT(*) FROM membres";
                            $result=mysqli_query($conn, $sqlquery);
                            $count=mysqli_num_rows($result);
                            if($count> 0){
                            while($row=mysqli_fetch_assoc($result)){
                            $membres=$row['COUNT(*)'];
                            }}?>

                       
                        </div>
                    </div>
                </div>
        
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
                                            <td><?php echo $names= $row['fname'].' '.$row['postnom'].' '.$row['prenom'] ?>
                                            </td>
                                            <td><?php echo $row['sex'] ?></td>
                                            <td><?php echo $row['member_type'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td>
                                                <a href="member_details?id=<?php echo  $row['id'] ?> "><i
                                                        class="feather icon-eye"
                                                        style="color: rgb(0, 0, 150); font-size: 20px;padding: 5px; margin:5px"></i></a>



                                        </tr>
                                        <?php }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 d-none">
                    <div class="card table-card review-card">
                        
                        <div class="card-body pb-0">
                            <div class="review-block">
                                
                               
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       
                    </div>
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
    $(document).ready(function() {
        $('#tables').DataTable({
            scrollX: true,
            info: false,
            paging: false,
            pageLength: 50,
            "language": {
                searchPlaceholder: 'Chercher',
                search: '',
                zeroRecords: 'Rien à Afficher',

                paginate: {
                    previous: 'Précédent',
                    next: 'Suivant',
                }
            }
        });
    });
    </script>



</body>

</html>
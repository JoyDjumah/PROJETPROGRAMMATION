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
   <div class="separator" style="height:40px;"></div>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Tous les Intérêts </h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Tous les Intérêts</a></li>
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
                        <div class="card-header">
                            <h5> Tous les Intérêts</h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>SOURCE</th>
                                            <th>OPERATION</th>
                                            <th>DATE</th>
                                            <th>Montant</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlquery="SELECT *, SUM(month_due_interet) FROM credit JOIN membres ON credit.cr_member_id=membres.id WHERE due_monthly_account_status='Payé' GROUP BY due_month DESC";
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
                                            <td><?php echo $row['fname'].' '.$row['postnom'].' '.$row['prenom'] ?></td>
                                            <td>PRET N° <?php echo $row['gen_credit_id']  ?> </td>
                                            <td> <?php echo $row['due_month']  ?> </td>
                                            <td><?php echo $row['month_due_interet'] ?> $</td>
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

    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

<script src="assets/js/plugins/apexcharts.min.js"></script>

<script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>

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
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Tous les Crédits</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
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
                <!-- table card-1 start -->

                <!-- prject ,team member start -->
                <!-- seo start -->
                <!-- <div class="col-xl-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3>$16 756</h3>
                                    <h6 class="text-muted m-b-0">Intérêts<i
                                            class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart1" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3>49 887 $</h3>
                                    <h6 class="text-muted m-b-0">Crédits Accordés<i
                                            class="fa fa-caret-up text-c-green m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart2" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3>1,62,564 $</h3>
                                    <h6 class="text-muted m-b-0">Cotisation<i
                                            class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                                </div>
                                <div class="col-6">
                                    <div id="seo-chart3" class="d-flex align-items-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- seo end -->

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5> Tous les Remboursements du mois de <?php echo date("F-Y") ?></h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Noms</th>
                                            <th>Montant </th>
                                            <th>Montant </th>
                                            <th>Echeance</th>
                                            <th>Status</th>
                                            <th>Payé</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $newDate=date('F-Y');
                                        $sqlquery="SELECT *, (credit.id) as credit_id  FROM credit JOIN membres ON credit.cr_member_id=membres.id WHERE due_month='$newDate' GROUP BY gen_credit_id";
                                        $result=mysqli_query($conn, $sqlquery);
                                        $count=mysqli_num_rows($result);
                                        
                                        $n=0;
                                        
                                        if($count> 0){
                                            $totCap=0;
                                          while($row=mysqli_fetch_assoc($result)){
                                            $n++;
                                            $status=$row['due_monthly_account_status'];
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo $n ?></td>
                                            <td><?php echo $row['fname'].' '.$row['postnom'].' '.$row['prenom'] ?></td>
                                            <td><b><?php  $capital=$row['due_amount']; echo number_format($capital,2, ',',' ')  ?> $</b></td>
                                            <td><?php echo $row['tranche_number'] ?></td>
                                            <td><?php echo  $newDate=date('F-Y') ?> </td>
                                            <?php if ($status=='Payé') {
                                                echo '<td style="color:green">'.$status.'</td>';
                                                # code...
                                            }else{
                                                echo '<td style="color:red">'.$status.'</td>';
                                            } ?>
                                            <td>
                                            <?php if ($status=='Payé') {
                                                
                                                # code...
                                            }else{
                                                echo '<a href="./actions/month_pay_bill?id='.$row['credit_id'].'" class="btn btn-primary">Regler la dette</a></td>';
                                            } ?>
                                            </td>


                                        </tr>
                                        <?php  $totCap+=$capital;
                                        }
                                   
                                    } ?>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><b><?= number_format($totCap,'2', ',', ' ') ?> $</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 hidden">
                     <a style="float:right" href="others_credit" class="btn btn-primary">Autres Crédits</a>
                </div>

                

                <!-- Latest Customers start -->

                <!-- Latest Customers end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

    <!-- Apex Chart -->
    <script src="assets/js/plugins/apexcharts.min.js"></script>


    <!-- custom-chart js -->
    <script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>
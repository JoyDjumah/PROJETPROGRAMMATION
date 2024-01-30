<?php

require  './db/db.php';


if (isset($_POST['submit'])) {
    $b_uname= $_POST['username'];
    $b_upass=$_POST['password'];
     

    $uname= stripcslashes($b_uname);
    $upass=stripcslashes($b_upass);
    
 $sql="SELECT * FROM users WHERE username='$uname'";
      $result=mysqli_query($conn,$sql);
     $row=mysqli_fetch_assoc($result);

     if ($row<>0) {
         # code..
     $email1=$row['username'];
     $password1=$row['password'];
    // $password1=$row['user_id'];
     //error on verification of logins
     
     $type=$row['user_type'];
     $msg=0;
     if($uname==$email1 && password_verify($b_upass, $password1)){
       
            session_start();
            setcookie ("username", $email1,time()+ 36000);
            setcookie ("password",$upass,time()+ 36000);
            $_SESSION["user_id"]=$email1;
            $_SESSION["user_name"]=$row['names'];
            header("Location: dashboard");
       
    
        }else{
            header("Location: login?error=4");
        }
     }else{

        header("Location: login?error=1");

     }
 }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>MONEY TRANSACTION ULPGL</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="./favicon.png" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="manifest" href="manifest.json">




</head>

<!-- [ auth-signin ] start -->

<div class="auth-wrapper">
    <div class="auth-content text-center">
       
        <div class="card borderless">
            <div class="row align-items-center ">
                <div class="col-12">
                    <?php
                                                if(isset($_GET['error']) && $_GET['error']==1){
                                                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Il s'est produite une erreur!</strong><br> Nom d'utilisateur ou Mot de Passe incorrect
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    
                        

                    </div>
                    <?php
                                                }
                                       ?>
                    <?php
                                                if(isset($_GET['error']) && $_GET['error']==2){
                                                    ?>
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Il s'est produite une erreur!</strong><br> Veuillez vous reconnecter.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <?php
                                                }
                                       ?>
                    <?php
                                                if(isset($_GET['error']) && $_GET['error']==4){
                                                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Il s'est produite une erreur!</strong><br> Mot de passe incorect.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <?php
                                                }
                                       ?>

                    <?php
                                                if(isset($_GET['error']) && $_GET['error']==3){
                                                    ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Il s'est produite une erreur!</strong><br> Veuillez vous reconnecter.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <?php
                                                }
                                       ?>
                </div>
                <div class="col-md-12">
                    <form method="POST">
                        <div class="card-body">
                            <h4 class="mb-3 f-w-400">CONNEXION</h4>
                            <hr>
                            <div class="form-group mb-3">
                                <input type="text" required class="form-control" name="username" id="Email"
                                    placeholder="Adresse Mail">
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" required class="form-control" id="Password" name="password"
                                    placeholder="Mot de Passe">
                            </div>
                            <div class="custom-control custom-checkbox text-left mb-4 mt-2 d-none">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Se souvenir de moi.</label>
                            </div>
                            <input class="btn btn-block btn-primary mb-4" name="submit" type="submit"
                                value="Se Connecter">
                            <hr>
                            <p class="mb-2 text-muted"> <a href="auth-reset-password.html" class="f-w-400">Mot de passe
                                    Oublié?</a></p>
                            <p class="mb-0 text-muted d-none">Don’t have an account? <a href="auth-signup.html"
                                    class="f-w-400">Signup</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>




</body>

</html>
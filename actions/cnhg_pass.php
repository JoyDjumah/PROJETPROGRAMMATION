<?php
require_once '../db/db.php';


                if (isset($_POST['nw_mdp'])) {
                $password=mysqli_real_escape_string($conn,$_POST['password']);
                $new_pass1=mysqli_real_escape_string($conn,$_POST['newpassword']);
                $new_pass2=mysqli_real_escape_string($conn,$_POST['renewpassword']);
                $session_user_id=mysqli_real_escape_string($conn,$_POST['user_id']);
                $names=mysqli_real_escape_string($conn,$_POST['names']);
                if($new_pass1==$new_pass2 && $new_pass2!=$password){
                    $sql="SELECT * FROM users WHERE username='$session_user_id'";
                    $result=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_assoc($result);
                    $password_t= password_hash($new_pass2, PASSWORD_DEFAULT, ['cost'=>12]);   
                    if ($row<>0) { 
                        $pass=$row['password'];
                        $email1=$row['username'];
                        if($session_user_id==$email1 && password_verify($password, $pass)){
                        $query="UPDATE `users` SET `password`='$password_t', `names`='$names' WHERE `username`='$session_user_id'";  
                        $conn->query($query);
                        header("Location: ../settings?success=1");

                                }else{
                                    header("Location: ../settings?error=4");
                                }}
            }elseif($new_pass1==$new_pass2 && $new_pass2==$password){
                header("Location: ../settings?error=2");
            }
            else{
                header("Location: ../settings?error=3");
            }}


          
        

?>



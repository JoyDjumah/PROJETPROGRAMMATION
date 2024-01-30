<?php
include './headers.php';
require './db/db.php';
 ?>

<style>
*,
*:before,
*:after {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.popup {
    background-color: #ffffff;
    width: 450px;
    padding: 30px 40px;
    position: absolute;
    transform: translate(-50%, -50%);
    left: 50%;
    top: 50%;
    border-radius: 8px;
    font-family: "Poppins", sans-serif;
    display: none;
    text-align: center;
}

.popup button {
    display: block;
    margin: 0 0 20px auto;
    background-color: transparent;
    font-size: 30px;
    color: #c5c5c5;
    border: none;
    outline: none;
    cursor: pointer;
}

.popup p {
    font-size: 14px;
    text-align: justify;
    margin: 20px 0;
    line-height: 25px;
}

a {
    display: block;
    width: 150px;
    position: relative;
    margin: 10px auto;
    border-radius: 25px;
    text-align: center;
    background-color: red;
    color: #ffffff;
    text-decoration: none;
    padding: 5px 0;
}

a:hover {
    color: whitesmoke;
    background-color: skyblue;
}
</style>

<body style="background: linear-gradient(rgba(255, 255, 255, 0.6),
rgb(255,100, 100)), url('./assets/images/maintance/growth-1768733.png') 
top center;
 background-size: cover;">



    <?php
$id =$_GET['id'];

?>

    <div class="popup">

        <div class="img" style="margin-top:-80px;">
            <img src="./assets/images/maintance/Delete_96px.png" class="rounded-circle" alt="" style="background:whitesmoke;">
        </div>

        <h2><b>Suppression... !</b></h2>
        <p style=" text-align:center">
        <div class="card">



        </div>
        <h5> Voulez-vous vraiment supprimer toutes le cotisations de  <b style="font-size:20px"><?php echo $id ?></b></h5>
        <p>
        </p>
        <div class="answers" style="display:flex;">
            <a href="./actions/glob_cot_delete?id=<?php echo $id ?>">Oui </a>
            <a href="./all_members_cotisation.php" style="background:blue;">Non </a>
        </div>
    </div>


    <script>
    window.addEventListener("load", function() {
        setTimeout(
            function open(event) {
                document.querySelector(".popup").style.display = "block";
            },
            200
        )
    });
    document.querySelector("#close").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "none";
    });
    </script>
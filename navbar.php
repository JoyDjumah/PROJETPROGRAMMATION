<?php
session_start();
if (isset($_SESSION["user_id"])) {
    $user_id=$_SESSION["user_id"];
    $user_name=$_SESSION["user_name"]; # code...
}else{
    header('Location:./login.php');
}

?>
<style>
@media print {
    * {
        font-family: Arial;
        background: white;
        font-size: 15px;
    }
    .hidden{
        display: none;
    }

    .hb_nav {
        display: none;
    }

    .pcoded-main-container {
        width: 100%;
        margin: 0;
    }

    .pcoded-content {
        width: 100%;
        margin: 0;
    }

    .docfooter {
        display: flex;
    }

    .page-header {
        display: none;
    }

    .print {
        width: 100%;
        max-width: 100%;
    }

    .btn_submit {
        display: none;
    }

    tfoot {
        background: skyblue;
    }

    .btn_gerate_state {
        display: none;
    }
    header{
        display: none;
    }
    .navbar{
        display: none;
    }
    .n-print{
        display:none
    }
}

.credit {
    border: none;
    width: 180px;
}
</style>

<div class="n-print">
<nav class="pcoded-navbar " style="position:fixed">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">

            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="assets/images/user/User_48px.png" alt="User-Profile-Image">
                    <div class="user-details">
                        <span><?php echo $user_name ?></span>
                        <div id="more-details">Administrateur<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        
                        <li class="list-group-item"><a href="./user_logout.php"><i
                                    class="feather icon-log-out m-r-5"></i>Se Déconnecter</a></li>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item">
                    <a href="./dashboard" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span class="pcoded-mtext">Tableau de
                            Bord</span></a>
                </li>
                
                <li class="nav-item pcoded-menu-caption">
                    <label>Gestion</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-users"></i></span><span class="pcoded-mtext">Membres</span></a>

                    <ul class="pcoded-submenu">

                        <li><a href="all_members">Tous les Membres</a></li>
                        <li><a href="new_member">Ajouter un Membre</a></li>
                        <li><a href="docs_inspection">Etude des Dossiers</a></li>

                    </ul>
                </li>

               
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                class="feather icon-credit-card"></i></span><span
                            class="pcoded-mtext">Cotisations</span></a>

                    <ul class="pcoded-submenu">

                        <li><a href="./all_members_cotisation">Toutes les Cotisations</a></li>
                        <li><a href="./gen_cotisation">Liste de Cotisation</a></li>
                    </ul>
                </li>
                
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                class="feather icon-plus"></i></span><span class="pcoded-mtext">Crédits</span></a>

                    <ul class="pcoded-submenu">

                        <li><a href="./all_credits">Tous les Crédits</a></li>
                        <li><a href="./new_credit">Accorder un Crédit</a></li>
                        <li><a href="./monthly_due_credit">Remboursement du Crédit</a></li>
                        
                    </ul>
                </li>
                
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                class="feather icon-file-text"></i></span><span
                            class="pcoded-mtext">Etats</span></a>

                    <ul class="pcoded-submenu">

                        <li><a href="./state_generator">Etats Mensuels</a></li>
                        
                    </ul>
                </li>


            </ul>


        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark" style="position:fixed">


    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <p class="logo p-3"
                STYLE="font-size:35px; font-family:impact; padding:10px; color:skyblue; margin-top:15px">MONEY </p>


        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </li>
            
        </ul>
        <ul class="navbar-nav ml-auto">
            
            <li>
                <div class="dropdown drp-user" style="margin-top:20px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="assets/images/user/User_48px.png" class="img-radius" alt="User-Profile-Image">
                            <span><?php echo $user_name ?></span>
                            <a href="./user_logout.php" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                        <ul class="pro-body">
                          
                    </div>
                </div>
            </li>
        </ul>
    </div>



</header>
</div>

<script src="./assets/datatable/simple-datatables.js"></script>
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
<?php
require_once './db/db.php';

if(isset($_POST["emp_id"]))  
{
    $id=$_POST["emp_id"];
    $output = '';

   
    $query = "SELECT  * FROM cotisations WHERE date = '".$_POST["emp_id"]."'";  
    $result = mysqli_query($conn, $query);  


    while($row = mysqli_fetch_array($result))  
    {  
    ?>
<form class="row g-3" method="POST" action="./actions/update_member.php">
                                <input type="hidden" name="std_mat" class="form-control" id="inputName5"
                                    value="<?php echo $id ?>" required readonly>
                                
                                <div class="col-md-6 "><label class="form-label ">Lieu de Naissance</label><input value="<?php echo $row['bplace'] ?>"
                                        type="test" name="std_bplace" class="form-control "></div>
                                <div class="col-md-6 "><label class="form-label ">Date de Naissance</label><input value="<?php echo $row['bday'] ?>"
                                        type="date" name="std_bday" class="form-control "></div>


                                <div class="col-md-6">
                                    <label for="inputName5" class="form-label">N° de Téléphone</label>
                                    <input type="tel" name="std_tel" value="<?php echo $row['phone'] ?>" class="form-control" id="inputName5">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputName5" class="form-label"> Type de Membre</label>
                                    <select name="user_type" class="form-control">
                                        <option value="<?php echo $row['member_type'] ?>" selected ><?php echo $row['member_type'] ?></option>
                                        <option>Débiteur</option>
                                        <option>Membre</option>
                                    </select>

                                </div>

                                <div class="col-md-6">
                                    <label for="inputName5" class="form-label">Nombre de Parts</label>
                                    <input type="number" name="parts_account" min="0" step="1" class="form-control" value="<?php echo $row['parts'] ?>"
                                        id="inputName5">
                                    <label style="margin-top:-35px;margin-right:50px; float:right; margin-bottom:35px;"
                                        for="">PARTS</label>
                                </div>

                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Adresse</label>
                                    <input type="text" name="std_adresse" class="form-control" value="<?php echo $row['adress'] ?>" id="inputCity">
                                </div>




                                <div class="col-md-12 p-2">
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Enregister" name="submit">
                                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </form>

<?php }  
  







}
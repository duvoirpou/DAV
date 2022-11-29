<?php
        require 'connexion.php';

     if(isset($_GET['id'])){

                      $id = $_GET['id'];
                        

                      $sel = $db->exec("DELETE FROM categories WHERE id_cat = $id");
                         
                        $message = 'suppression effectuée';

                     }

?>
        <div class="card mt-4 border-primary " style="color:rgb(7,7,7);">
            <div class="card-header bg-primary">
                <h5 class="text-center mb-0" style="color:rgb(254,253,253);">Categorie</h5>
            </div>
            <div class="card-body">
                <?php if(!empty($message)): ?>
                        <div class="alert alert-success text-center">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?> 

                    <br />

                    <div class="text-center"><a href="index.php?page=cat" class="btn btn-primary"><i class="fa fa-chevron-left"></i> retour</a></div> 
            </div>
        </div>



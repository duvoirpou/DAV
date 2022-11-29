<?php
    
    require 'connexion.php';
    
    if(isset($_GET['id'])){

        $id_liv = $_GET['id'];

        $reqt = $db->query("SELECT * FROM livraison WHERE id_liv=$id_liv");
        $data = $reqt->fetch();

       
        $date_liv = $data['date_liv'];
        $montant = $data['montant'];
       


        $requette = $db->query("SELECT pr.id_prod,pr.description,fa.id,fa.id_liv,fa.qte,fa.pu,fa.pt FROM produits AS pr INNER JOIN  facture_ach AS fa ON pr.id_prod = fa.id_prod WHERE fa.id_liv=$id_liv");


         $i = 1;

    }

?>
<!doctype html>
<html>
<head>
    <title>LGC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
    <body onload="window.print();" style="margin: ;">
        <div class="container" style="height: 1462px; margin-top: 1px;margin-bottom: 1px;">
            <div class="text-center" style="margin-left: 20px;">
                <table>
                    <tr>
                        <td width="200"><img src="assets/img/logong.png" height="150"></td>
                        <td width="10"></td>
                        <td width="770"><h3 style="letter-spacing: 1px;"><b>ETABLISSEMENT NGUETLEU</b></h3>
                            <h5 style="letter-spacing: 1px;"><b>VENTE DES PRODUITS COSMETIQUES EN GROS ET EN DETAILS</b></h5>
                            <P style="font-size: 20px;">Congo Brazzaville, 47 rue Likouala Marché Poto Poto <br />
                                Tél : (+242) 05 686 47 64 / 04 462 74 12 / 04 456 97 28 <br />
                                Whatsapp : (+237) 679 95 37 10
                            </P>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr style="border: solid 2px #000;" /></td>
                    </tr>
                </table>
            </div>
            <br />
            <div class="text-center"><h4><b>Facture de vente N° <?php echo $id_liv ?></b></h4></div>
            <br />
            <div style="margin-left: 70px;">
            <table>
                <tr>
                    <td width="350" style="font-size: 22px;" ></b></td>
                    <td width="340" ></td>
                    <td width="200" style="font-size: 22px;">Date : <?php echo $date_liv ?></td>
                </tr>
            </table>
            </div>
             
            <div style="margin-left: 20px;" >
                <table border="2">
                    <thead style="font-size: 22px;">
                        <tr>
                            <th width="70" style="padding: 5px 10px;">N°</th>
                            <th width="400" style="padding: 5px 10px;">Designation</th>
                            <th width="70" style="padding: 5px 10px;text-align: center;">Quantité</th>
                            <th width="200" style="padding: 5px 10px;text-align: center;">Prix unitaire</th>
                            <th width="200" style="padding: 5px 10px;text-align: center;">Montant</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 22px;">
                        <?php while($rep = $requette->fetch()){ ?>
                        <tr>
                            <td width="70" style="padding: 5px 10px;"><?php echo $i++; ?></td>
                            <td width="400" style="padding: 5px 10px;"><?php echo $rep['description'] ?></td>
                            <td  width="70" style="padding: 5px 10px;text-align: center;"><?php echo $rep['qte'] ?></td>
                            <td width="200" style="padding: 5px 10px;text-align: center;"><?php echo $rep['pu'] ?> Frs</td>
                            <td width="200" style="padding: 5px 10px;text-align: center;"><?php echo $rep['pt'] ?> Frs</td>
                        </tr>   
                        <?php } ?>
                        <tr> 
                            <td colspan="3"></td>              
                            <td width="220" style="padding: 5px 10px;font-weight: bold;text-align: center;">Montant Total</td>
                            <td width="220" style="padding: 3px 10px;text-align: center;font-weight: bold;"><?php echo $montant ?> Frs </td>
                        </tr>
                    </tbody>
                </table>
            </div> 

            <div style="margin-left: 20px;font-size: 22px;">Arrêtée la presente facture à la somme de : </div> 

            <br /><br /> 

            <div style="margin-left: 20px;font-size: 22px;">
                <table>
                        <tr>                
                            <td width="300" style="padding: 5px 10px;font-weight: bold;text-align: right;">Signature du fournisseur</td>
                            <td width="400"></td>
                            <td width="250" style="padding: 3px 10px;text-align: center;font-weight: bold;">Signature du client</td>
                        </tr>
                        
                </table>
            </div>                                      
                    
                 
                    
               
        </div>
        <div style="margin-left: 27px; font-style: italic;font-size: 18px;"><p>* Les marchandises vendues ne sont ni retournées, ni échangées</p></div>
    </body>
</html>
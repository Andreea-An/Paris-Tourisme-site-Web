<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="'X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Paris Tourisme</title>
</head>
<body>
    <header>
        <div class="principale">
            <div class="Logo">
                    <a href="#"> <img src="pp2.jpg" alt="Logo" width="200" height="50"/></a>
            </div>
            <?php
                session_start();
                 if (isset($_SESSION['id'])){
                  ?>
                  <ul>
                  <li>
                    <a href="deconnexion.php">Se deconnecter</a>  
                 </li>
                 <li>
                    <a href="choix_parcours.php">Choisir un parcours</a>  
                </li>

                <li>
                    <a href="differents_parcours.php">Consulter les parcours</a>  
                </li>

                <li>
                    <a href="profil.php"> Profil</a>  
                </li>
                <?php
                 }
                else{
                    ?>
            <div>
                    <ul>
                <li>
                    <a href="#"> Accueil</a>  
                </li>

                <li>
                    <a href="connexion.php"> Connexion</a>
                </li>


                <li>
                    <a href="propos.php">A propos</a>  
                </li>

                <li>
                    <a href="IMG.php">image</a>  
                </li>
                <li>
                    <a href="#"> Plus </a>  
                </li>

            </ul>
        </div>
        <?php         
                }
        ?>

        <div class="titre">
            <h1>BIENVENUE SUR PARIS TOURISME</h1>
            <p>Découvrez la beauté de Paris à travers nos visites guidées. Cliquez pour en savoir plus.</p>
        </div>
        <div class="Button">
            <a href="#" class="bttn">Voir les differents parcours</a>
        </div>
       
    </header>
    <section class="LALA">
        <h1>A PROPOS DE PARIS TOURISME</h1>
    </section>
    <div class="LALA1">
        <a href="#"><img src="ppp3.webp" alt="logo" width="900" height="500"></a>
    </div>
    
</body>
</html>
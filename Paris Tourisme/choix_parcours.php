<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Réservation de Parcours</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        
        }

       
        body{
            background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url(./pp1.svg);
            height: 100vh;
            background-size: cover;
            background-position: center;
            text-align: center;
            color: #FFF3F3;
            
        }

        form {
            background-color:#0d0d0e;
            padding:10px;
            width:280px;
            left: 40%;
            top: 20%;
            position: absolute;
            
 }
        fieldset {
            padding:0 20px 20px 20px;
            margin-bottom:10px;
            border:1px solid #DF3F3F;
            left: 40%;
            top: 50%;
 }
    legend {
        color:#DF3F3F;
        font-weight:bold
 }
    label {
        margin-top:10px;
        display:block;
 }
    label.inline {
        display:inline;
        margin-right:50px;
 }
    input, textarea, select, option {
        background: color #0d0d0e;;
 }
    input, textarea, select {
        padding:3px;
        border:1px solid #F5C5C5;
        border-radius:5px;
        width:200px;
        box-shadow:1px 1px 2px #C0C0C0 inset;
 }
    select {
        margin-top:10px;
 }
    input[type=radio] {
        background-color:transparent;
        border:none;
        width:10px;
 }
    input[type=submit], input[type=reset] {
        width:100px;
        margin-left:5px;
        box-shadow:1px 1px 1px #7DA3CB;
        cursor:pointer;
 }

    </style>
</head>
<body>
    <h2>Réserver un Parcours</h2>
    <form action="" method="post">
        <input type="hidden" name="id_user" value="<?php echo $_SESSION['user_id']; ?>">

        <label for="id_parcours">Parcours:</label>
        <select name="id_parcours" id="id_parcours" required>
            <?php
            // Connexion à la base de données

            $servername = "localhost"; // Adresse du serveur MySQL
            $username = "root"; // Nom d'utilisateur MySQL
            $password = ""; // Mot de passe MySQL
            $database = "touristes"; // Nom de la base de données

            $bdd = new mysqli($servername,$username,$password,$database);

            // Vérifier la connexion
            if ($bdd->connect_error) {
                die("Connection failed: " . $bdd->connect_error);
            }

            // Récupérer les parcours disponibles
            $sql = "SELECT num_parcours, Nom_Parc FROM parcours";
            $result = $bdd->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['num_parcours'] . "'>" . $row['Nom_Parc'] . "</option>";
                }
            } else {
                echo "<option value=''>Aucun parcours disponible</option>";
            }

            $bdd->close();
            ?>
        </select><br>

        <label for="date_reservation">Date de Réservation:</label>
        <input type="date" id="date_reservation" name="date_reservation" required><br>
        <label for="nom_parcours">Nom de mon parcours:</label>
        <input type="text" id="nom_parcours" name="nom_parcours">

        <input type="submit" value="Réserver">
    </form>
</body>
</html>



<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST['id_user'];
    $id_parcours = $_POST['id_parcours'];
    $date_reservation = $_POST['date_reservation'];
    $nom_parcours = $_POST['nom_parcours'];

    // Connexion à la base de données
    $servername = "localhost"; // Adresse du serveur MySQL
            $username = "root"; // Nom d'utilisateur MySQL
            $password = ""; // Mot de passe MySQL
            $database = "touristes"; // Nom de la base de données
    $bdd= new mysqli($servername, $username,$password,$database);

    // Vérifier la connexion
    if ($bdd->connect_error) {
        die("Connection failed: " . $bdd->connect_error);
    }

    // Insérer la réservation dans la table reservation_parcours
    $sql = "INSERT INTO reservation_parcours (id_user, id_parcours, date_reser ,nom_parcours) VALUES (?, ?, ?,?)";
    $stmt = $bdd->prepare($sql);
    $stmt->bind_param("iis", $id_user, $id_parcours, $date_reservation, $nom_parcours);

    if ($stmt->execute()) {
        echo "Réservation réussie!";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
    $bdd->close();
}
?>

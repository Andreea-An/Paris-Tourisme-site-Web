<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Parcours Payant</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Parcours Gratuit</h1>
    <?php
    require_once 'include/bdd.php';

    // Préparer et exécuter la requête
    $requete = $bdd->prepare(
        'SELECT p.num_parcours, p.Nom_Parc, p.Description, p.Horaire, p.id_type_parcours, m.id AS media_id, m.image 
        FROM parcours p 
        LEFT JOIN media_parcours m ON p.num_parcours = m.site_parcours 
        WHERE p.id_type_parcours = 2'
    );
    $requete->execute();
    $result = $requete->fetchAll();

    if ($result) {
        $parcoursData = [];
        
        // Organiser les données par parcours
        foreach ($result as $row) {
            $num_parcours = $row['num_parcours'];
            if (!isset($parcoursData[$num_parcours])) {
                $parcoursData[$num_parcours] = [
                    'Nom_Parc' => $row['Nom_Parc'],
                    'Description' => $row['Description'],
                    'Horaire' => $row['Horaire'],
                    'media' => []
                ];
            }
            if ($row['media_id']) {
                $parcoursData[$num_parcours]['media'][] = $row['image'];
            }
        }

        // Afficher les données
        echo "<table>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Horaire</th>
                    <th>Media</th>
                </tr>";

        foreach ($parcoursData as $parcours) {
            echo "<tr>
                    <td>" . htmlspecialchars($parcours['Nom_Parc']) . "</td>
                    <td>" . htmlspecialchars($parcours['Description']) . "</td>
                    <td>" . htmlspecialchars($parcours['Horaire']) . "</td>
                    <td>";
            if (!empty($parcours['media'])) {
                foreach ($parcours['media'] as $image) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($image) . '"/>';
                }
            } else {
                echo "Aucun média";
            }
            echo "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Aucun parcours trouvé.</p>";
    }
    ?>
</body>
</html>

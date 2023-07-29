
<?php

// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur MySQL
$password = ""; // Remplacez par votre mot de passe MySQL
$dbname = "devoir"; // Remplacez par le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Fonction pour récupérer les bulletins de notes d'une classe donnée
function afficherBulletinsDeNotesClasse($classeId)
{
    global $conn;

    // Récupérer les informations de la classe
    $classeQuery = "SELECT * FROM classes WHERE id = '$classeId'";
    $classeResult = $conn->query($classeQuery);
    if ($classeResult->num_rows > 0) {
        $classeRow = $classeResult->fetch_assoc();
        $nomClasse = $classeRow["nom_classe"];

        echo "Bulletins de notes - Classe : $nomClasse<br><br>";

        // Récupérer les étudiants de la classe
        $etudiantsQuery = "SELECT * FROM etudiants WHERE id IN 
            (SELECT etudiant_id FROM notes WHERE matiere_id IN 
                (SELECT matiere_id FROM coefficients WHERE classe_id = '$classeId'))";
        $etudiantsResult = $conn->query($etudiantsQuery);

        if ($etudiantsResult->num_rows > 0) {
            while ($etudiantRow = $etudiantsResult->fetch_assoc()) {
                $etudiantId = $etudiantRow["id"];
                $nomEtudiant = $etudiantRow["nom"];
                $prenomEtudiant = $etudiantRow["prenom"];

                echo "Étudiant : $nomEtudiant $prenomEtudiant<br>";

                // Récupérer les matières et coefficients de la classe
                $matieresQuery = "SELECT matieres.nom_matiere, coefficients.coeff 
                    FROM matieres 
                    INNER JOIN coefficients ON matieres.id = coefficients.matiere_id 
                    WHERE coefficients.classe_id = '$classeId'";
                $matieresResult = $conn->query($matieresQuery);

                if ($matieresResult->num_rows > 0) {
                    while ($matiereRow = $matieresResult->fetch_assoc()) {
                        $nomMatiere = $matiereRow["nom_matiere"];
                        $coeff = $matiereRow["coeff"];

                        // Récupérer la note de l'étudiant pour chaque matière
                        $noteQuery = "SELECT note FROM notes 
                            WHERE etudiant_id = '$etudiantId' 
                            AND matiere_id IN 
                                (SELECT matiere_id FROM coefficients 
                                    WHERE classe_id = '$classeId' 
                                    AND matiere_id = matieres.id)";
                        $noteResult = $conn->query($noteQuery);

                        if ($noteResult->num_rows > 0) {
                            $noteRow = $noteResult->fetch_assoc();
                            $note = $noteRow["note"];

                            // Calculer la note pondérée
                            $notePonderee = $note * $coeff;

                            echo "- Matière : $nomMatiere | Note : $note | Coefficient : $coeff | Note Pondérée : $notePonderee<br>";
                        }
                    }
                }

                echo "<br>";
            }
        } else {
            echo "Aucun étudiant trouvé pour cette classe.";
        }

    } else {
        echo "Classe introuvable.";
    }
}

// Exemple d'utilisation : afficher les bulletins de notes de la classe avec l'ID 'cl_1'
afficherBulletinsDeNotesClasse('cl_1');

$conn->close();

?>

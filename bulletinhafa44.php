<!DOCTYPE html>
<html>
	<head>
	<title>bulletin</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="design/bulletinhafa1.css" />
	
	</head>

	<body>
		<?php
			// Étape 1 : Connexion à la base de données (à adapter avec vos informations)
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "devoir";

			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Échec de la connexion à la base de données : " . mysqli_connect_error());
						}
			//poste variable classe
			$class_id = $_POST['id_classe'];
			// Étape 2 : Récupérer les données des étudiants, matières, professeurs et notes
			$sql = "SELECT e.id, e.nom, e.prenom,e.adresse,e.date_naissance, c.nom_classe, m.nom_matiere, n.note, co.coeff, p.nom AS nom_professeur

					FROM etudiants e
					INNER JOIN notes n ON e.id = n.etudiant_id
					INNER JOIN matieres m ON m.id = n.matiere_id
					INNER JOIN coefficients co ON co.matiere_id = n.matiere_id
					INNER JOIN professeurs p ON p.id = n.professeur_id
					INNER JOIN classes c ON c.id = co.classe_id
					WHERE c.id = '$class_id'"; // Remplacez 'cl_1' par l'ID de votre classe

			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0)
				{
					$etudiants = array(); // Tableau pour stocker les informations des étudiants

					while ($row = mysqli_fetch_assoc($result)) 
						{
							$studentId = $row['id'];
							$studentName = $row['prenom'] . ' ' . $row['nom'];
							$className = $row['nom_classe'];
							$studentAddress = $row['adresse'];
							$studentDateOfBirth = $row['date_naissance'];
							$matiere = $row['nom_matiere'];
							$note = $row['note'];
							$coeff = $row['coeff'];
							$professor = $row['nom_professeur'];

							// Vérifier si l'étudiant existe déjà dans le tableau
							if (!array_key_exists($studentId, $etudiants)) {
								$etudiants[$studentId] = array(
									'name' => $studentName,
									'class' => $className,
									'address' => $studentAddress,
									'date_of_birth' => $studentDateOfBirth,
									'matieres' => array()
								);
							}

							// Ajouter les matières, notes, coefficients et professeurs pour chaque étudiant
							$etudiants[$studentId]['matieres'][] = array(
								'matiere' => $matiere,
								'note' => $note,
								'coeff' => $coeff,
								'professor' => $professor
							);
						}
				}
			   
		// Étape 3 : Calculer les moyennes des étudiants et déterminer leur rang
$sqlMoyennes = "SELECT e.id, AVG(n.note) AS moyenne
                FROM etudiants e
                INNER JOIN notes n ON e.id = n.etudiant_id
                INNER JOIN coefficients co ON co.matiere_id = n.matiere_id
                INNER JOIN classes c ON c.id = co.classe_id
                WHERE c.id = '$class_id'
                GROUP BY e.id
                ORDER BY moyenne DESC";

$resultMoyennes = mysqli_query($conn, $sqlMoyennes);
$rang = 1;

while ($rowMoyenne = mysqli_fetch_assoc($resultMoyennes)) {
    $studentId = $rowMoyenne['id'];
    $moyenne = $rowMoyenne['moyenne'];

    // Rechercher l'étudiant correspondant dans le tableau $etudiants
    if (array_key_exists($studentId, $etudiants)) {
        $etudiants[$studentId]['moyenne'] = $moyenne;
        $etudiants[$studentId]['rang'] = $rang;

        $rang++;
    }
}
// Étape 4 : Afficher les bulletins de notes pour chaque étudiant
foreach ($etudiants as $etudiant) {
    echo "<h2>Bulletin de notes - Étudiant : " . $etudiant['name'] . "</h2>";
    echo "<h4>Classe : " . $etudiant['class'] . "</h4>";
    echo "<h4>Adresse : " . $etudiant['address'] . "</h4>";
    echo "<h4>Date de naissance : " . $etudiant['date_of_birth'] . "</h4>";

    echo "<table>
        <thead>
            <tr>
                <th>Matière</th>
                <th>Note</th>
                <th>Coefficient</th>
                <th>Professeur</th>
            </tr>
        </thead>
        <tbody>";
    $totalNotes = 0;
    $totalCoeffs = 0;
    $totalEtudiants = count($etudiants);
    
    foreach ($etudiant['matieres'] as $matiere) {
        echo "<tr>
				<td>" . $matiere['matiere'] . "</td>
				<td>" . $matiere['note'] . "</td>
				<td>" . $matiere['coeff'] . "</td>
				<td>" . $matiere['professor'] . "</td>
			 </tr>";

        // Calculer la note avec coefficient pour chaque matière
        $totalNotes += ($matiere['note'] * $matiere['coeff']);
        $totalCoeffs += $matiere['coeff'];
    }
    
    echo "</tbody>
    </table>";

    // Calculer la moyenne générale de l'étudiant
    $moyenneGenerale = ($totalNotes / $totalCoeffs);
    echo "<h3>Moyenne générale : " . round($moyenneGenerale, 2) . "</h3>";
    
    // Afficher le rang de l'étudiant
    echo "<h3>Rang : " . $etudiant['rang'] . "/" 

. $totalEtudiants ."</h3>";
    
    // Ajouter une appréciation selon la moyenne
    $appreciation = '';
    
    if ($moyenneGenerale >= 16) {
        $appreciation = 'Très bien';
    } elseif ($moyenneGenerale >= 14) {
        $appreciation = 'Bien';
    } elseif ($moyenneGenerale >= 12) {
        $appreciation = 'Assez bien';
    } elseif ($moyenneGenerale >= 10) {
        $appreciation = 'Passable';
    } elseif ($moyenneGenerale >= 8) {
        $appreciation = 'Insuffisant';
    } else {
        $appreciation = 'Faible';
    }
    
    echo "<p>Appréciation : " . $appreciation 

. "</p>";
    echo "<p>"." ********************************************************************************************************************************** "."</p>";
}

// Étape 5 : Fermer la connexion à la base de données
mysqli_close($conn);
?>
</body>
</html>


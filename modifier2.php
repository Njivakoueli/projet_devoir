<!DOCTYPE html>
<html>
	<head>
	<title>Formulaire des matières</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="design/modifier.css" />
	</head>
	
	<body>
		<h1>GESTION DE BULLETIN DES NOTES</h1>
		<?php
		
		// Connexion à la base de données
		$serveur = "localhost";
		$utilisateur = "root";
		$mdp = "";
		$base_de_donnees = "devoir";
		$connexion = mysqli_connect($serveur, $utilisateur, $mdp, $base_de_donnees);

		// Vérification de la connexion

		if (!$connexion) {
			die("La connexion a échoué: " . mysqli_connect_error());
		}

		// Vérification si l'ID de l'étudiant est présent dans l'URL
		if (isset($_GET['id'])) {
			$id_etudiant = $_GET['id'];

			// Vérification si le formulaire de modification a été soumis
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$nom = $_POST["nom"];
				$prenom = $_POST["prenom"];
				$adresse = $_POST["adresse"];
				$date_naissance = $_POST["date_naissance"];

				// Récupération des anciennes valeurs

				$sql_select_old = "SELECT * FROM etudiants WHERE id='$id_etudiant'";
				$resultat_old = mysqli_query($connexion, $sql_select_old);
				$etudiant_old = mysqli_fetch_assoc($resultat_old);

				// Modification des valeurs dans la table etudiants
				$sql = "UPDATE etudiants SET nom='$nom', prenom='$prenom', adresse='$adresse', date_naissance='$date_naissance' WHERE id='$id_etudiant'";
				if (mysqli_query($connexion, $sql)) {
					echo "Les informations de l'étudiant ont été modifiées avec succès.<br><br>";
/*
					// Affichage des anciennes et nouvelles valeurs
					echo '<table >';
					echo '<tr><th colspan="2">Anciennes valeurs</th></tr>';
					echo '<tr><td>Nom</td><td>' . $etudiant_old['nom'] . '</td></tr>';
					echo '<tr><td>Prénom</td><td>' . $etudiant_old['prenom'] . '</td></tr>';
					echo '<tr><td>Adresse</td><td>' . $etudiant_old['adresse'] . '</td></tr>';
					echo '<tr><td>Date de Naissance</td><td>' . $etudiant_old['date_naissance'] . '</td></tr>';
					echo '</table>';

					echo '<br>';

					echo '<table>';

					echo '<tr><th colspan="2">Nouvelles valeurs</th></tr>';
					echo '<tr><td>Nom</td><td>' . $nom . '</td></tr>';
					echo '<tr><td>Prénom</td><td>' . $prenom . '</td></tr>';
					echo '<tr><td>Adresse</td><td>' . $adresse . '</td></tr>';
					echo '<tr><td>Date de Naissance</td><td>' . $date_naissance . '</td></tr>';
					echo '</table>';
				} else {
					echo "Erreur: " . mysqli_error($connexion);
				}
			}*/
// Affichage des anciennes et nouvelles valeurs côte à côte 
echo '<table>'; 
echo '<tr><th>Champ</th><th>Anciennes valeurs</th><th>Nouvelles valeurs</th></tr>'; 
echo '<tr><td>Nom : </td><td>' . $etudiant_old['nom'] . '</td><td>' . $nom . '</td></tr>'; 
echo '<tr><td>Prenom : </td><td>' . $etudiant_old['prenom'] . '</td><td>' . $prenom . '</td></tr>'; 
echo '<tr><td>Adresse : </td><td>' . $etudiant_old['adresse'] . '</td><td>' . $adresse . '</td></tr>'; 
echo '<tr><td>Né(e) le : </td><td>' . $etudiant_old['date_naissance'] . '</td><td>' . $date_naissance . '</td></tr>'; 
echo '</table>';
 } 
 else { 
 echo "Erreur: " . mysqli_error($connexion); 
 } 
 }


			// Récupération des données de l'étudiant à modifier
			$sql_select = "SELECT * FROM etudiants WHERE id='$id_etudiant'";

			$resultat = mysqli_query($connexion, $sql_select);
			$etudiant = mysqli_fetch_assoc($resultat);

			// Formulaire de modification des informations de l'étudiant
			echo"<h3>"."Pour d'autre modification"."</h3>";
			echo '<form method="post" action="">';
			echo '<table>';
			echo '<tr><th>Champ</th><th>Valeur</th></tr>';
			echo '<tr><td>Nom</td><td><input type="text" name="nom" value="' . $etudiant['nom'] . '"></td></tr>';
			echo '<tr><td>Prénom</td><td><input type="text" name="prenom" value="' . $etudiant['prenom'] . '"></td></tr>';
			echo '<tr><td>Adresse</td><td><input type="text" name="adresse" value="' . $etudiant['adresse'] . '"></td></tr>';
			echo '<tr><td>Date de Naissance</td><td><input type="date" name="date_naissance" value="' . $etudiant['date_naissance'] . '"></td></tr>';
			echo '</table>';
			echo '<br>';
			echo '<input type="submit" value="Modifier">';
			echo '</form>';

		} else {
			echo "L'ID de l'étudiant n'est pas spécifié.";
		}
			echo "<br>";
				echo "<a href='formulaire_eleve.php'>"."Inscrire un etudiant"."</a>"."\n";
				echo "<a href='note_matiere.php'>"."Saisir les notes"."</a>"."\n";
				echo "<a href='bulletin.php'>"."Créer un bulletin"."</a>";
			


	// Fermeture de la connexion
	mysqli_close($connexion);
	?>
</body>

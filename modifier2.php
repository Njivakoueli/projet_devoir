<!DOCTYPE html>
<html>
	<head>
	<title>Formulaire des matières</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="design/modifier.css" />
	</head>
	
	<body>
		<h1>GESTION DE BULLETIN DES NOTES</h1>
		<a href="index.php">Accueil</a></br>
		<?php
		
		// Connexion à la base de données
		include ('host/connect.php');
		?>
		<?php
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
				


	// Fermeture de la connexion
	mysqli_close($connexion);
	?>
</body>

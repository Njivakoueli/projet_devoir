<!DOCTYPE html>
<html>
	<head>
	<title>Modidifier classe</title>
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

		// Vérification si l'ID de la classe est présent dans l'URL
		if (isset($_GET['id'])) {
			$id_coeff = $_GET['id'];

			// Vérification si le formulaire de modification a été soumis
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$classe = $_POST["classe_id"]; 
				$matiere = $_POST["matiere_id"]; 
				$coeff = $_POST["coeff"]; 
				
				// Récupération des anciennes valeurs
				$sql_select_old = "SELECT * FROM coefficients WHERE id='$id_coeff'";
				$resultat_old = mysqli_query($connexion, $sql_select_old);
				$coeff_old = mysqli_fetch_assoc($resultat_old);

				// Modification des valeurs dans la table classes
				$sql = "UPDATE coefficients SET classe_id='$classe', matiere_id='$matiere', coeff='$coeff' WHERE id='$id_coeff'";
				if (mysqli_query($connexion, $sql)) {
					echo "Les informations  ont été modifiées avec succès.<br><br>";

				// Affichage des anciennes et nouvelles valeurs côte à côte 
				echo '<table>'; 
				echo '<tr><th>Champ</th><th>Anciennes valeurs</th><th>Nouvelles valeurs</th></tr>'; 
				echo '<tr><td>classe : </td><td>' . $coeff_old["classe_id"] . '</td><td>' . $classe . '</td></tr>'; 
				echo '<tr><td>matiere : </td><td>' . $coeff_old["matiere_id"] . '</td><td>' . $matiere . '</td></tr>'; 
				echo '<tr><td>coefficient: </td><td>' . $coeff_old["coeff"] . '</td><td>' . $coeff . '</td></tr>'; 
				echo '</table>';
				 } 
				 else { 
				 echo "Erreur: " . mysqli_error($connexion); 
				 } 
				 }


			// Récupération des données de l'étudiant à modifier
			$sql_select = "SELECT * FROM coefficients WHERE id='$id_coeff'";

			$resultat = mysqli_query($connexion, $sql_select);
			$coeff = mysqli_fetch_assoc($resultat);

			// Formulaire de modification des informations de l'étudiant
			echo"<h3>"."Pour d'autre modification"."</h3>";
			echo '<form method="post" action="">';
			echo '<table>';
			echo '<tr><th>Champ</th><th>Valeur</th></tr>';
			echo '<tr><td>classe</td><td><input type="text" name="classe_id" value="' . $coeff['classe_id'] . '"></td></tr>';
			echo '<tr><td>matiere</td><td><input type="text" name="matiere_id" value="' . $coeff['matiere_id'] . '"></td></tr>';
			echo '<tr><td>coefficient</td><td><input type="text" name="coeff" value="' . $coeff['coeff'] . '"></td></tr>';
			echo '</table>';
			echo '<br>';
			echo '<input type="submit" value="Modifier">';
			echo '</form>';

		} else {
			echo "L'ID de la classe n'est pas spécifié.";
		}
			echo "<br>";
			//	echo "<a href='formulaire_eleve.php'>"."Inscrire un etudiant"."</a>"."\n";
				//echo "<a href='note_matiere.php'>"."Saisir les notes"."</a>"."\n";
				//echo "<a href='bulletin.php'>"."Créer un bulletin"."</a>";
			


	// Fermeture de la connexion
	mysqli_close($connexion);
	?>
</body>

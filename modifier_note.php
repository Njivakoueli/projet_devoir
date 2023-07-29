<!DOCTYPE html>
<html>
	<head>
	<title>Formulaire des matières</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="design/modifier.css" />
	</head>
	
	<body>
		<h1>Modification des notes</h1>
		<a href="index.php">Accueil</a></br>
		<?php
		
		  // Connexion à la base de données
		include ('host/connect.php');
		?>
		<?php

		// Vérification si l'ID de l'étudiant est présent dans l'URL
		if (isset($_GET['id'])) {
			$id_note = $_GET['id'];

			// Vérification si le formulaire de modification a été soumis
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$etudiant = $_POST["etudiant_id"];
				$matiere = $_POST["matiere_id"];
				$prof = $_POST["professeur_id"];
				$note = $_POST["note"];

				// Récupération des anciennes valeurs

				$sql_select_old = "SELECT * FROM notes WHERE id='$id_note'";
				$resultat_old = mysqli_query($connexion, $sql_select_old);
				$note_old = mysqli_fetch_assoc($resultat_old);

				// Modification des valeurs dans la table etudiants
				$sql = "UPDATE notes SET etudiant_id='$etudiant', matiere_id='$matiere', professeur_id='$prof', note='$note' WHERE id='$id_note'";
				if (mysqli_query($connexion, $sql)) {
					echo "Les informations de note a été modifiée avec succès.<br><br>";

					// Affichage des anciennes et nouvelles valeurs côte à côte 
					echo '<table>'; 
					echo '<tr><th>Champ</th><th>Anciennes valeurs</th><th>Nouvelles valeurs</th></tr>'; 
					echo '<tr><td>etudiant : </td><td>' . $note_old['etudiant_id'] . '</td><td>' . $etudiant . '</td></tr>'; 
					echo '<tr><td>matiere: </td><td>' . $note_old['matiere_id'] . '</td><td>' . $matiere . '</td></tr>'; 
					echo '<tr><td>professeur : </td><td>' . $note_old['professeur_id'] . '</td><td>' . $prof . '</td></tr>'; 
					echo '<tr><td>note: </td><td>' . $note_old['note'] . '</td><td>' . $note . '</td></tr>'; 
					echo '</table>';
					 } 
					 else { 
					 echo "Erreur: " . mysqli_error($connexion); 
					 } 
					 }


			// Récupération des données de l'étudiant à modifier
			$sql_select = "SELECT * FROM notes WHERE id='$id_note'";

			$resultat = mysqli_query($connexion, $sql_select);
			$note = mysqli_fetch_assoc($resultat);

			// Formulaire de modification des informations de l'étudiant
			echo"<h3>"."Pour d'autre modification"."</h3>";
			echo '<form method="post" action="">';
			echo '<table>';
			echo '<tr><th>Champ</th><th>Valeur</th></tr>';
			echo '<tr><td>etudiant</td><td><input type="text" name="etudiant_id" value="' . $note['etudiant_id'] . '"></td></tr>';
			echo '<tr><td>matiere</td><td><input type="text" name="matiere_id" value="' . $note['matiere_id'] . '"></td></tr>';
			echo '<tr><td>prof</td><td><input type="text" name="professeur_id" value="' . $note['professeur_id'] . '"></td></tr>';
			echo '<tr><td>note</td><td><input type="text" name="note" value="' . $note['note'] . '"></td></tr>';
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

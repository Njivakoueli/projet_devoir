<!DOCTYPE html>
<html>
  <head>
    <title>Formulaire pour créer une classe</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Designe" href="design/insertion_eleve.css" />
  </head>
  <body>
	<h1>Affichage de tous les contenus de note</h1>
	<a href="index.php">Accueil</a></br>

		<?php
		    // Connexion à la base de données
		
		include ('host/connect.php');
		?>
		<?php

		  // Récupération des valeurs soumises du formulaire
			  $id_etudiant = $_POST["etudiant_id"];
			  $id_matiere = $_POST["matiere_id"];
			  $id_prof = $_POST["professeur_id"];
			  $id_note = $_POST["note"];
			 
			 
			  
		  // Insertion des valeurs dans la table matiere
			  $sql = "INSERT INTO notes (etudiant_id, matiere_id, professeur_id, note)
					  VALUES ('$id_etudiant','$id_matiere', '$id_prof', '$id_note')";

			  if (mysqli_query($connexion, $sql)) {
				echo "Les notes de l'etudiant ont été insérées avec succès.";
			  } else {
				echo "Erreur: " . mysqli_error($connexion);

			  }
			  
			  // Récupération des données de la table notes
				$sql_select = "SELECT * FROM notes";
				$resultat = mysqli_query($connexion, $sql_select);

				echo '<table border="1">';
				echo '<tr>
					
					<th>etudiant</th>
					<th>matiere</th>
					<th>professeur</th>
					<th>note</th>
					<th>Modification</th>
					<th>Suppression</th>
				</tr>';

				while ($row = mysqli_fetch_assoc($resultat)) {
					echo '<tr>';
					echo '<td>' . $row['etudiant_id'] . '</td>';
					echo '<td>' . $row['matiere_id'] . '</td>';
					echo '<td>' . $row['professeur_id'] . '</td>';
					echo '<td>' . $row['note'] . '</td>';
					echo '<td><a href="modifier_note.php?id=' . $row['id'] . '">Modifier</a></td>'; // Ajout du lien pour la modification
					echo '<td><a href="supprimer_note.php?id=' . $row['id'] . '">Supprimer</a></td>'; // Ajout du lien pour la suppression
					echo '</tr>';
				}

				echo '</table>';



					echo "<br>";
						//echo "<a href='formulaire_eleve.php'>"."Inscrire un etudiant"."</a>"."\n";
						//echo "<a href='note_matiere.php'>"."Saisir les notes"."</a>"."\n";
						//echo "<a href='bulletin.php'>"."Créer un bulletin"."</a>";
					
				
			  
			  
			  
		  // Fermeture de la connexion
		  mysqli_close($connexion);
		?>
	</body>
</html>
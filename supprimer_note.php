<!DOCTYPE html>
<html>
	<head>
	<title>Suppression coefficient</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="design/onglet.css" />
	</head>

		<body>
			<h1>GESTION DE BULLETIN DES NOTES</h1>

			<?php
			  // Connexion à la base de données
		
		include ('host/connect.php');
		?>
		<?php

			// Récupération de l'ID de l'étudiant à supprimer à partir de la requête GET
			$id_note = $_GET["id"];

			// Suppression de l'étudiant de la table etudiants
			$sql = "DELETE FROM notes WHERE id = '$id_note'";
			if (mysqli_query($connexion, $sql)) {
				echo "Le note a été supprimé avec succès.";
			} else {
				echo "Erreur lors de la suppression de coefficient: " . mysqli_error($connexion);
			}


			// Récupération des données de la table etudiants
			$sql_select = "SELECT * FROM notes";
			$resultat = mysqli_query($connexion, $sql_select);

			// Affichage des valeurs dans un tableau avec CSS pour le design
			echo '<style>
				table {
					border-collapse: collapse;
					width: 100%;
				}
				th, td {
					text-align: left;

					padding: 8px;
				}
				th {
					background-color: #f2f2f2;
				}
			</style>';

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

	
			// Fermeture de la connexion
			mysqli_close($connexion);

?>
</body>

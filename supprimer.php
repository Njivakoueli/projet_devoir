<!DOCTYPE html>
<html>
	<head>
	<title>3 onglets liées à des pages</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Designe" href="design/onglet.css" />
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

			// Récupération de l'ID de l'étudiant à supprimer à partir de la requête GET
			$id_etudiant = $_GET["id"];

			// Suppression de l'étudiant de la table etudiants
			$sql = "DELETE FROM etudiants WHERE id = '$id_etudiant'";
			if (mysqli_query($connexion, $sql)) {
				echo "L'étudiant a été supprimé avec succès.";
			} else {
				echo "Erreur lors de la suppression de l'étudiant: " . mysqli_error($connexion);
			}


			// Récupération des données de la table etudiants
			$sql_select = "SELECT * FROM etudiants";
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
				<th>ID Etudiant</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Adresse</th>
				<th>Date de Naissance</th>
				<th>Modification</th>
				<th>Suppression</th>
			</tr>';

			while ($row = mysqli_fetch_assoc($resultat)) {
				echo '<tr>';
				echo '<td>' . $row['id'] . '</td>';
				echo '<td>' . $row['nom'] . '</td>';
				echo '<td>' . $row['prenom'] . '</td>';
				echo '<td>' . $row['adresse'] . '</td>';
				echo '<td>' . $row['date_naissance'] . '</td>';
				echo '<td><a href="modifier2.php?id=' . $row['id'] . '">Modifier</a></td>'; // Ajout du lien pour la modification
				echo '<td><a href="supprimer.php?id=' . $row['id'] . '">Supprimer</a></td>'; // Ajout du lien pour la suppression
				echo '</tr>';
			}

			echo '</table>';

	
			// Fermeture de la connexion
			mysqli_close($connexion);

?>
</body>

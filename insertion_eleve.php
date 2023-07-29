<!DOCTYPE html>
<html>
<head>
    <title>Insertion_eleve</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Designe" href="design/insertion_eleve.css" />
    <style>
       
    </style>
</head>
<body>


		<?php echo"<h1>"."GESTION DE BULLETIN DES NOTES"."</h1>";?>
		<a href="index.php">Accueil</a></br>
		<?php
		  // Connexion à la base de données
		
		include ('host/connect.php');
		?>
		<?php
		  // Récupération des valeurs soumises du formulaire
			  $id_etudiant = $_POST["id_etudiant"];
			  $nom = $_POST["nom"];
			  $prenom = $_POST["prenom"];
			  $adresse = $_POST["adresse"];
			  $date_naissance = $_POST["date_naissance"];
			  
			  
		  // Insertion des valeurs dans la table eleves
			  $sql = "INSERT INTO etudiants (id, nom, prenom, adresse, date_naissance)
					  VALUES ('$id_etudiant', '$nom', '$prenom', '$adresse','$date_naissance')";


			  if (mysqli_query($connexion, $sql)) {
					echo "Les informations de l'étudiant ont été insérées avec succès.";
				} 
				else {
					echo "Erreur: " . mysqli_error($connexion);
		}

		// Récupération des données de la table etudiants
		$sql_select = "SELECT * FROM etudiants";
		$resultat = mysqli_query($connexion, $sql_select);

		// Affichage des valeurs dans un tableau avec CSS pour le design
	/*	echo '<style>
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
		</style>';*/

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



			echo "<br>";
				
			
		  // Fermeture de la connexion
		  mysqli_close($connexion);
		?>
		
</body>
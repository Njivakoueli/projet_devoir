<!DOCTYPE html>
<html>
  <head>
    <title>Formulaire pour créer une classe</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Designe" href="design/formulaire_eleve.css" />
  </head>
  <body>

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

		  // Récupération des valeurs soumises du formulaire
			  $id_classe = $_POST["id_classe"];
			  $nom_classe = $_POST["nom"];

			 
			  
		  // Insertion des valeurs dans la table matiere
			  $sql = "INSERT INTO classes (id, nom_classe)
					  VALUES ('$id_classe','$nom_classe')";

			  if (mysqli_query($connexion, $sql)) {
				echo "La classe est créé avec succès.";
			  } else {
				echo "Erreur: " . mysqli_error($connexion);

			  }
			  
			  // Récupération des données de la table classe
				$sql_select = "SELECT * FROM classes";
				$resultat = mysqli_query($connexion, $sql_select);

			  echo '<table border="1">';
				echo '<tr>
					<th>ID classe</th>
					<th>Nom</th>
					<th>Modification</th>
					<th>Suppression</th>
				</tr>';

				while ($row = mysqli_fetch_assoc($resultat)) {
					echo '<tr>';
					echo '<td>' . $row['id'] . '</td>';
					echo '<td>' . $row['nom_classe'] . '</td>';
					echo '<td><a href="modifier_classe.php?id=' . $row['id'] . '">Modifier</a></td>'; // Ajout du lien pour la modification
					echo '<td><a href="supprimer_classe.php?id=' . $row['id'] . '">Supprimer</a></td>'; // Ajout du lien pour la suppression
					echo '</tr>';
				}

				echo '</table>';



			  
		  // Fermeture de la connexion
		  mysqli_close($connexion);
		?>
	</body>
 
</html>

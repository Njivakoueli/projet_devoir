<!DOCTYPE html>
<html>
	<head>
	<title>Modidifier classe</title>
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

		// Vérification si l'ID de la classe est présent dans l'URL
		if (isset($_GET['id'])) {
			$id_classe = $_GET['id'];

			// Vérification si le formulaire de modification a été soumis
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$nom = $_POST["nom_classe"];
				
				// Récupération des anciennes valeurs
				$sql_select_old = "SELECT * FROM classes WHERE id='$id_classe'";
				$resultat_old = mysqli_query($connexion, $sql_select_old);
				$classe_old = mysqli_fetch_assoc($resultat_old);

				// Modification des valeurs dans la table classes
				$sql = "UPDATE classes SET nom_classe='$nom' WHERE id='$id_classe'";
				if (mysqli_query($connexion, $sql)) {
					echo "Les informations de l'étudiant ont été modifiées avec succès.<br><br>"; //echo Die;

				// Affichage des anciennes et nouvelles valeurs côte à côte 
				echo '<table>'; 
				echo '<tr><th>Champ</th><th>Anciennes valeurs</th><th>Nouvelles valeurs</th></tr>'; 
				echo '<tr><td>Nom : </td><td>' . $classe_old['nom_classe'] . '</td><td>' . $nom . '</td></tr>'; 
				echo '</table>';
				 } 
				 else { 
				 echo "Erreur: " . mysqli_error($connexion); 
				 } 
				 }


			// Récupération des données de l'étudiant à modifier
			$sql_select = "SELECT * FROM classes WHERE id='$id_classe'";

			$resultat = mysqli_query($connexion, $sql_select);
			$classe = mysqli_fetch_assoc($resultat);

			// Formulaire de modification des informations de l'étudiant
			echo"<h3>"."Pour d'autre modification"."</h3>";
			echo '<form method="post" action="">';
			echo '<table>';
			echo '<tr><th>Champ</th><th>Valeur</th></tr>';
			echo '<tr><td>Nom</td><td><input type="text" name="nom" value="' . $classe['nom_classe'] . '"></td></tr>';
			echo '</table>';
			echo '<br>';
			echo '<input type="submit" value="Modifier">';
			echo '</form>';

		} else {
			echo "L'ID de la classe n'est pas spécifié.";
		}
			echo "<br>";
				echo "<a href='formulaire_eleve.php'>"."Inscrire un etudiant"."</a>"."\n";
				echo "<a href='note_matiere.php'>"."Saisir les notes"."</a>"."\n";
				echo "<a href='bulletin.php'>"."Créer un bulletin"."</a>";
			


	// Fermeture de la connexion
	mysqli_close($connexion);
	?>
</body>

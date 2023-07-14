
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
      $id_coef = $_POST["id_coef"];
      $id_classe = $_POST["classe_id"];
      $id_matiere = $_POST["matiere_id"];
      $coef = $_POST["coef"];

     
      
  // Insertion des valeurs dans la table matiere
      $sql = "INSERT INTO coefficients (id, classe_id, matiere_id, coeff)
              VALUES ('$id_coef','$id_classe', '$id_matiere', '$coef')";

      if (mysqli_query($connexion, $sql)) {
        echo "Le coefficient est créé avec succès.";
      } else {
        echo "Erreur: " . mysqli_error($connexion);

      }
	  
	  
	  
	  
	  // Récupération des données de la table coefficients
		$sql_select = "SELECT * FROM coefficients";
		$resultat = mysqli_query($connexion, $sql_select);


		echo '<table border="1">';
		echo '<tr>
			<th>ID Coeff</th>
			<th>Classe_id</th>
			<th>Matière_id</th>
			<th>Coefficient</th>
			<th>Modification</th>
			<th>Suppression</th>
		</tr>';

		while ($row = mysqli_fetch_assoc($resultat)) {
			echo '<tr>';
			echo '<td>' . $row['id'] . '</td>';
			echo '<td>' . $row['classe_id'] . '</td>';
			echo '<td>' . $row['matiere_id'] . '</td>';
			echo '<td>' . $row['coeff'] . '</td>';
			echo '<td><a href="modifier_coeff.php?id=' . $row['id'] . '">Modifier</a></td>'; // Ajout du lien pour la modification
			echo '<td><a href="supprimer_coeff.php?id=' . $row['id'] . '">Supprimer</a></td>'; // Ajout du lien pour la suppression
			echo '</tr>';
		}

		echo '</table>';

	  
  // Fermeture de la connexion
  mysqli_close($connexion);
?>

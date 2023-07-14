
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
  // Fermeture de la connexion
  mysqli_close($connexion);
?>

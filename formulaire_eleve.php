
<!DOCTYPE html>
<html>
  <head>
    <title>Formulaire d'inscription d'un élève</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Designe" href="design/formulaire_eleve.css" />
  </head>
  <body>


    <h1>Formulaire d'inscription d'un élève</h1>
	<table>

			<tr>
				<td><a href="note_matiere.php">Saisir les notes</a></td>
				<td><a href="bulletin.php">Créer un bulletin</a></td>
			</tr>
	</table>
    <div>
      <form action="insertion\insertion_eleve.php" method="post">
   
        <label for="id_eleve">ID de l' etudiant:</label>
        <input type="text" id="id_etudiant" name="id_etudiant" placeholder="Entrez l'ID de l'etudiant de la forme et_1 ou et_2 ..." required>
<!--
		<label for="id_eleve">ID de sa classe:</label>
        <input type="text" id="id_classe" name="id_classe" placeholder="Entrez l'ID classe de l'etudiant de la forme cl_1 ou cl_2 ..." required>-->


        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" placeholder="Entrez le nom de l'élève" required>

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" placeholder="Entrez le prénom de l'élève" required>

		<label for="adresse">Adresse:</label>
        <textarea id="adresse" name="adresse" placeholder="Entrez l'adresse de l'élève"></textarea>
		
        <label for="date_naissance">Date de naissance:</label>
        <input type="date" id="date_naissance" name="date_naissance" placeholder="Entrez la date de naissance de l'élève" required>

        <input type="submit" value="Inscrire">
      </form>
    </div>

	


  </body>
  <?php include("footer.php") ?>
</html>

<!DOCTYPE html>
<html>
  <head>
    <title>Formulaire pour afficher bulletin</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Designe" href="design/bulletin.css" />
  </head>
  <body>


    <h1>creation du bulletin</h1>
	<table>
			<tr>
				<td><a href="formulaire_eleve.php">Inscrire un etudiant</a></td>
				<td><a href="note_matiere.php">Saisir les notes</a></td>
			</tr>
	</table>

    <div>
      <form action="bulletinhafa44.php" method="post">
   
       
		<label for="id_classe">Entrez l'ID de la classe:</label>
        <input type="text" id="id_etudiant" name="id_classe" placeholder="Entrez l'ID du classe  de la forme cl_1 ou cl_2 ..." required>

        

        <input type="submit" value="Valider">
      </form>
    </div>

  </body>
  
</html>

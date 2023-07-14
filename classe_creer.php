
<!DOCTYPE html>
<html>
  <head>
    <title>Formulaire pour créer une classe</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Designe" href="design/formulaire_eleve.css" />
  </head>
  <body>


    <h1>Formulaire pour créer une classe</h1>
	<table>

			<tr>
				<td><a href="note_matiere.php">Saisir les notes</a></td>
				<td><a href="bulletin.php">Créer un bulletin</a></td>
			</tr>
	</table>
    <div>
      <form action="insertion_classe.php" method="post">
   
        <label for="id_classe">ID de la classe:</label>
        <input type="text" id="id_classe" name="id_classe" placeholder="Entrez l'ID classe  de la forme cl_1 ou cl_2 ..." required>

        <label for="nom">Nom classe:</label>
        <input type="text" id="nom" name="nom" placeholder="Entrez le nom de la classe" required>

        
        <input type="submit" value="creer">
      </form>
    </div>

	


  </body>
 
</html>

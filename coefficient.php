
<!DOCTYPE html>
<html>
  <head>
    <title>Formulaire pour créer les coefficients</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Designe" href="design/formulaire_eleve.css" />
  </head>
  <body>


    <h1>Formulaire pour créer les coefficients</h1>
	<table>

			<tr>
				<td><a href="index.php">Accueil</a></br></td>
				
			</tr>
	</table>
    <div>
      <form action="insertion_coef.php" method="post">
   
        <label for="id_classe">ID de la coefficient:</label>
        <input type="text" id="id_coef" name="id_coef" placeholder="Entrez l'ID coefficient  de la forme coef_1 ou coef_2 ..." required>

        <label for="nom">ID de la classe :</label>
        <input type="text" id="classe_id" name="classe_id" placeholder="Entrez l'ID la classe de la forme cl_1 ou cl_2" required>
		
		<label for="nom">ID de la matière</label>
        <input type="text" id="matiere_id" name="matiere_id" placeholder="Entrez l'ID de la matière" required>


		<label for="nom">Coefficient :</label>
        <input type="text" id="coef" name="coef" placeholder="Entrez le coefficient" required>


        
        <input type="submit" value="creer">
      </form>
    </div>

	


  </body>
  
</html>


<!DOCTYPE html>
<html>
	<head>
	<title>Formulaire des matières</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Designe" href="design/note_matiere.css" />
	</head>
	<body>
		<h1>Formulaire de saisie des notes</h1>
		<table>
			<tr>
				<td><a href="index.php">Accueil</a></td>
			</tr>
		</table>
		
		<form method="post" action="insertion_note.php">
			<label for="id_eleve">ID de l'etudiant:</label>
			<input type="text" id="etudiant_id" name="etudiant_id" placeholder="Entrez l'ID de l'etudiant" required>

			<label for="id_eleve">ID de la matiere:</label>
			<input type="text" id="matiere_id" name="matiere_id" placeholder="Entrez l'ID de la matiere" required>

			<label for="id_eleve">ID du professeur:</label>
			<input type="text" id="professeur_id" name="professeur_id" placeholder="Entrez l'ID du  professeur" required>


			<label for="note">Note:</label>
			<input type="text" name="note" id="note" min="0" max="20" required />

			<input type="submit" value="Enregistrer"/>

		</form>
	</body>
	
</html>

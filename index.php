<!DOCTYPE html>
<html>
<head>
    <title>Boutons avec liens</title>
	<link rel="stylesheet" media="screen" type="text/css" title="Designe" href="design/onglet.css" />
    <style>
       
    </style>
</head>
<body>
<?php echo"<h1>"."GESTION DE BULLETIN DES NOTES"."</h1>";?>
    <div class="container">
		<a>Accueil pour : </a>
        <a href="classe.php"><button>Créer une classe</button></a>
		<a href="formulaire_eleve.php"><button>Inscrire un étudiant</button></a>
        <a href="coefficient.php"><button>Créer les coéfficients</button></a>
        <a href="note_matiere.php"><button>Saisir les notes</button></a>
        <a href="test_bulletint.php"><button>Créer les bulletins </button></a>
    </div>
</body>
</html>

CREATE TABLE etudiants (
  id VARCHAR(10) NOT NULL PRIMARY KEY CHECK(id LIKE 'et_%'AND id REGEXP'^et_[0-9]+$'),
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  adresse VARCHAR(255) NOT NULL,
  date_naissance DATE NOT NULL
);

CREATE TABLE classes (
  id VARCHAR(10) NOT NULL PRIMARY KEY CHECK(id LIKE 'cl_%'AND id REGEXP'^cl_[0-9]+$'),
  nom_classe VARCHAR(255) NOT NULL
);

CREATE TABLE matieres (
  id VARCHAR(10) NOT NULL PRIMARY KEY,
  nom_matiere VARCHAR(255) NOT NULL
);

CREATE TABLE coefficients (
id VARCHAR(10) NOT NULL PRIMARY KEY  CHECK(id LIKE 'coef_%'AND id REGEXP'^coef_[0-9]+$'),
classe_id VARCHAR (10) NOT NULL,
matiere_id VARCHAR (10) NOT NULL,
coeff INT NOT NULL,
 FOREIGN KEY (matiere_id) REFERENCES matieres(id),
  FOREIGN KEY (classe_id) REFERENCES classes(id)
);

CREATE TABLE professeurs (
  id VARCHAR(10) NOT NULL PRIMARY KEY,
  matiere_id VARCHAR (10) NOT NULL,
  nom VARCHAR(255) NOT NULL,
  FOREIGN KEY (matiere_id) REFERENCES matieres(id)
);

CREATE TABLE notes (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  etudiant_id VARCHAR(10) NOT NULL,
  matiere_id VARCHAR(10) NOT NULL,
  professeur_id VARCHAR(10) NOT NULL,
  note FLOAT NOT NULL,
  FOREIGN KEY (etudiant_id) REFERENCES etudiants(id),
  FOREIGN KEY (matiere_id) REFERENCES matieres(id),
  FOREIGN KEY (professeur_id) REFERENCES professeurs(id)
);

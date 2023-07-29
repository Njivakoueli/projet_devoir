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

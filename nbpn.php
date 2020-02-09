<?php

//Connexion a la base de données
	//Le paramètre Data Source Name (DSN) est une chaîne de caractères contenant les informations requises pour se connecter à la base de données : 
			//*le nom du pilote PDO (nom du SGBD : mysql,pgsql ...)
			//*le nom de la base de données 
			//*le nom du serveur.

	//objet PDO

//Exercice 2 : Affichage du nombre de prix nobels


	try {
		$bd = new PDO ('mysql:host=localhost;dbname=php','root','root');
		$bd->query("SET NAMES 'utf8'"); //indique que le script PHP communique avec la base de données en utf-8.
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//indique qu’en cas d’erreur, une exception doit être levée.
	}
	catch(PDOException $e) {
		 die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '.$e->getMessage().'</p>');
		} 

	//script qui affiche le nombre de prix de nobels 
	try{
		$requete = 'SELECT COUNT(*) FROM nobels';
		$requete = $bd->prepare($requete);
		$requete->execute();//La requête est ensuite exécutée grâce à la méthode execute
		$tab = $requete->fetch(PDO::FETCH_NUM);//La récupération de la réponse se fait via la méthode fetch
		$nbNobels = $tab[0];
		echo "Il y a $nbNobels lignes dans la table. ";
		}

	//En cas d’erreur lors de la préparation, une exception PDOException est levée
	catch(PDOException $e) {
		 die('<p> La connexion a échoué. Erreur['.$e->getCode().'] : '.$e->getMessage().'</p>');
		}

?>
<?php

	//Exercice 4 : Création de la classe Model

	class Model{

	private $pdo_driver = 'mysql';         // pgsql
	private $pdo_host = 'localhost';			 // aquabdd
	private $pdo_dbname = 'php';    // etudiants
	private $pdo_login = 'root';           // n° étudiant
	private $pdo_password = 'root';

//patern de singleton
		private $bd;
		private static $instance = null; 

		private function __construct (){
			try{
			$dsn = $this->pdo_driver.':'.'host='.$this->pdo_host.';dbname='.$this->pdo_dbname;
			$this->bd = new PDO($dsn, $this->pdo_login, $this->pdo_password);
			$this->bd->query('SET NAMES utf8');
			$this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}//http://notepad.ga/iutv-as
			catch (PDOException $e){
				die('<p> La connexion a échoué . Erreur['.$e -> getCode().'</p>');
			}
		}

		//deux methodes : 
		//le getModel : une fonction qui creer une bases de donnee et la creer si elle n'yest pas 
		// le get_last : execute la requete SQL ,une fonction qui renvoie le resultat de la requete, un tableau de tableau 

		public static function getModel(){
			if (is_null(self::$instance)) //test si l'objet instance est null ou pas si c'est null en fait l'objet(connexion bdd)
					self::$instance = new Model(); //instance un objet , class 
				return self::$instance;
		}
	

		public function get_last(){
		// retournant les 25 derniers prix nobels décernés dans un tableau PHP
		try{
			$req = "SELECT * FROM nobels ORDER BY year DESC LIMIT 25"; //chaine de caractere
			$requete = $this->bd->prepare($req); //renvoie un objet , la en creer une vrai requete
			$requete->execute();
			return $requete->fetchAll(PDO::FETCH_ASSOC); //recuperer le resulat, assoc pour que les cle seront les indices
		}
		catch(PDOException $e) {
			die('<p> Erreur['.$e->getCode().'] : '.$e->getMessage().'<hr/>'.$req.'</p>');
		}
	}

		
		public function get_nb_nobel_prizes(){ //methode c'est une fonction dans une class
		// retournant le nombre total de prix nobels dans la base de données
			try{
				$req = "SELECT COUNT(*) FROM nobels";
				$requete = $this->bd->prepare($req); 
				$requete->execute();
				$tab = $requete->fetch(PDO::FETCH_NUM);
				return $tab[0];
				}
			
			catch(PDOException $e) {
				 die('<p> Erreur['.$e->getCode().'] : '.$e->getMessage().'</p>');
				}

		}
	

		// renvoie les informations du prix n° $id
	public function get_nobel_prize_informations($id){
		//prenant en paramètre un entier et retournant un tableau contenant toutes les informations du prix nobel dont l’identifiant est égal à cet entier
		try{
			$req = "SELECT * FROM nobels WHERE id=:identtemporaire"; //
			$requete = $this->bd->prepare($req);
			$requete ->bindValue(':identtemporaire', $id);//associer une valeur a ma valeur preparer
			$requete->execute();
			return $requete->fetch(PDO::FETCH_ASSOC); //renvoie un tableau associatif
			//le cas ou il existe pas sa renvoie false automatiquement
		}
		catch(PDOException $e) {
			die('<p> Erreur['.$e->getCode().'] : '.$e->getMessage().'<hr/>'.$req.'</p>');
		}
	
	}

//renvoyer la liste des categories 
	public function get_categories(){
		try{
			$req = "SELECT category FROM categories ORDER BY category";
			$requete = $this->bd->prepare($req);
			$requete -> execute();

			$tab =[];
			while ($ligne = $requete->fetch(PDO::FETCH_NUM))
				$tab[] = $ligne[0];

			return $tab;
		}
		catch(PDOException $e) {
			die('<p> Erreur['.$e->getCode().'] : '.$e->getMessage().'<hr/>'.$req.'</p>');
		}
	}

	public function add_nobel_prize($infos){
		try{
			$liste1 = '';
			$liste2 = '';
			foreach ($infos as $key=>$value){
				$liste1 .= $key.',';
				$liste2 .= ':'.$key.',';
			}
			var_dump($liste1);
			var_dump($liste2);
			$liste1 = trim($liste1, ',');
			$liste2 = trim($liste2, ',');
			$req = 'INSERT INTO nobels ('.$liste1.') ';
			$req .= 'VALUES ('.$liste2.')';
			$requete = $this->bd->prepare($req);
			foreach ($infos as $key=>$value)
				$requete->bindValue(':'.$key, $value);
			$requete->execute();
		}
		catch(PDOException $e) {
			die('<p> Erreur['.$e->getCode().'] : '.$e->getMessage().'<hr/>'.$req.'</p>');
		}
	}


}



?>
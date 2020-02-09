<?php

//Exercice 3 : Affichage des informations d’un prix nobel

	//scipt qui affiche les informations d'un prix nobel 
	
	//dont l'identifiant est passé en parametre dans l'url
	if(isset($_GET['id'])) { //si y'a un id 
		$id = $_GET['id'];
		$req= 'SELECT * FROM nobels WHERE id =:id';
		$requete = $bd->prepare($req);
		$requete->bindValue(':id',$id); //le marqeur commence par un : 
		//le bindValue permet de donner une valeur au marqueur
		$requete->execute();

		if ($tab = $requete->fetch(PDO::FETCH_ASSOC)) {
			affVar($tab); // la fonction en bas 
				
				echo '<ul>';
				
				foreach ($tab as $key => $val) 
					echo "<li> $key : $val </li>";

				echo '</ul>';
		else
			echo "Identifiant incorrect";

		}

		else
			echo "Aucun identifiant";
	
	//pour affichage
	function affVar($var){
	echo '<pre>';
		if (is_array($var))
			print_r($var);
		else
			var_dump($var);
	echo '</pre>';
	}
}
?>
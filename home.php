<?php


	//Exercice 5 : Page d’accueil du site
	// Récupérer le nombre de prix nobels dans la base de données pour l'afficher à la place de TO FILL.
	require_once "model.php";
	$model = Model::getModel();
	$nbNobels = $model->get_nb_nobel_prizes();

	require "begin.html";

?>
	<h1> List of the nobel prizes </h1>

	<p> Welcome to the website listing the different nobel prizes given until 2010. It references <strong><?=$nbNobels?></strong> nobel prizes. You can modify this list by adding new Nobel Prizes, and removing or updating the information contained in this database. You can also search among the nobel prizes on the name, the year and the different categories. </p>



<?php 

	require "end.html";
	
?>
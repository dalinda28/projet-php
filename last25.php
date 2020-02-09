

<?php 

//Exercice 6 : Affichage des 25 derniers prix nobels

// Affiche sous forme d’une table HTML les nom et prénom, la catégorie et l’année des 25 derniers prix nobels décernés

require_once "model.php";
//on utilise la classe Model pour récupérer les informations sur les prix nobels.
$model = Model::getModel();
$tab = $model->get_last();

require "begin.html";

?>
<h1>List of the last 25 Nobel prizes</h1>

<table>

		<tr><td><strong>Name</strong></td>
		<td><strong>Category<strong></td>
		<td><strong>Year</strong></td></tr>

		<!--on utilise ?> pour reduire les echo -->
		<?php
		foreach ($tab as $val) : ?> 
			<tr> <td> <a href="informations.php?id=<?=$val['id']?>"> <?=$val['name'] ?></td>  
			<td> <a href=""><?=$val ['category'] ?> </td> 
			<td> <a href=""><?=$val ['year'] ?> </td> </tr>
		<?php endforeach ; ?>
</table>

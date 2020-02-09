<?php 
//Exercice 7 : Informations concernant un prix nobel

//Ce dernier teste s’il existe dans l’url un paramètre id
//il affiche toutes les informations du prix nobels correspondant s’il existe ou un message indiquant qu’il n’existe aucun prix nobel ayant cet identifiant dans la base de données.

require_once "begin.html";
require_once "model.php";

$model = Model::getModel(); //une fonction de class 

if (isset($_GET['id'])){
	$nobel = $model->get_nobel_prize_informations($_GET['id']); //appeler ma fonction 
	if (!$nobel) //si ca marche pas 
		$nobel = [" l'identifiant n'existe pas ! "];
}
else
	$nobel = ["L'identifiant est absent dans l'URL"];

?>
<h1>A nobel prizes</h1>

<ul> <!-- une liste non oordonnee-->
	<?php foreach ($nobel as $key => $info) : ?>

	<li> <?= $key ?> : <?php echo $info; ?> </li> <!-- deux facon d'ecrire-->

	<?php endforeach; ?>

</ul>
<?php
require_once "end.html";
?>




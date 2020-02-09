
<?php

require_once "model.php";
$model = Model::getModel();
$categories = $model->get_categories();

require_once "begin.html";

?>

<h1> Add a nobel prizes</h1>

	<form action="add.php" method="post">
					<p> <label> Name: <input type="text" name="name"> </label> </p>
					<p> <label> Year: </br><input type="text" name="year"> </label> </p>
					<p> <label> Birth Date: <input type="text" name="birthdate"></label> </p>
					<p> <label> Birth Place: <input type="text" name="birthPlace"> </label></p>
					<p> <label> County: <input type="text" name="county"></label> </p>
					<?php foreach ($categories as $cat ): ?>
							<input type="radio" name="category" value="<?=$cat?>" /><?=$cat?><br/ >
					
					<?php endforeach; ?>
	</br>
					<textarea name="Motivation" cols="70" rows="10"></textarea>
					<p>  <input type="submit" value="Add in database"> </p>
	</form>
<?php
require_once "end.html";
?>
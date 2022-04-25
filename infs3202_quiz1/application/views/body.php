<?php
$single_view = '<div class="col mb-4">
					<div class="card">
					  <div class="card-body">
						<p class="card-text">This is Number %d</p>
					  </div>
					</div>
				  </div>';

echo '<div class="row row-cols-1 row-cols-md-2">';
// START WRITING YOUR CODE HERE

for ($i = 1; $i <= 20; $i++) {
	$card = sprintf($single_view, $i);
	echo $card;
}
// END
echo '<div>';
?>


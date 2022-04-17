<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

</style>

<div id="container">
	<h1>Your Courses</h1>
	<div class="container">
		<div class="row">
			<?php 
			$recent_course_template = "
				<div class='col'>
					<div class='card'>
						<div class='bg-image hover-overlay ripple' data-mdb-ripple-color='light'>
							<img src='https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp' class='img-fluid'/>
							<a href='#!'>
							<div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
							</a>
						</div>
						<div class='card-body'>
							<h5 class='card-title'>%s</h5>
							<p class='card-text'>%s</p>
							<div class='d-inline-flex'>
								<a href='#!' class='btn btn-primary'>Button</a>
								<div class='progress'>
									<div class='progress-bar progress-bar-striped' role='progressbar' style='width: %d%%' aria-valuenow='%d' aria-valuemin='0' aria-valuemax='100'></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			";

			for ($i = 0; $i < 3; $i++) {
				echo sprintf($recent_course_template, $i, $i, "60", "60");
			}

			?>
		</div>
	</div>

	
</div>

</body>

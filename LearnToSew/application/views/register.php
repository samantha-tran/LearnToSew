<html>
	<head>
			<title>Learn To Sew</title>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
			<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	</head>
  <body>
	<div class="container">
		<div class="col-4 offset-4">
				<?php echo form_open(base_url().'register/register'); ?>
					<h2 class="text-center">Register</h2>       
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Username" required="required" name="username">
						</div>
                        <div class="form-group">
							<input type="email" class="form-control" placeholder="Email" required="required" name="email">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" required="required" name="password">
						</div>
						<div class="form-group">
						<?php echo $error; ?>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Register</button>
						</div>  
				<?php echo form_close(); ?>
		</div>
	</div>
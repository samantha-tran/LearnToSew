<html>
	<head>
			<title>Learn To Sew</title>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
			<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
      <!-- Google Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

  <body>
  <nav class="navbar navbar-light bg-light">
    <h1><a href="<?php echo base_url(); ?>home">Learn To Sew</a></h1>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>course">Upload a course</a>
      </li>
      <?php if($this->session->userdata('logged_in')) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>user"> My Courses </a>
        </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url();?>cart">
          <svg xmlns="http://www.w3.org/2000/svg" width=20px height=20px viewBox="0 0 20 20" fill="currentColor">
            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
          </svg>
          Cart
        </a>
      </li>
      <?php if(!$this->session->userdata('logged_in')) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>login"> Login </a>
        </li>
      <?php endif; ?>
      <?php if($this->session->userdata('logged_in')) : ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Profile</a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="<?php base_url();?>user/details">My Details</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout">Log out</a>
          </div>
        </li>
      <?php endif; ?>
    </ul>
</nav>
<style>
  body {
    font-family: 'Roboto', sans-serif;
  }
</style>



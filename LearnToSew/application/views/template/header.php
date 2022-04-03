<html>
  <head>
          <title>Learn To Sew</title>
          <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
          <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
          <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
  </head>
  <body>

  <nav class="navbar navbar-light bg-light">
    <h1>Learn To Sew</h1>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Courses</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Patterns</a>
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
            <a class="dropdown-item" href="#">My Purchases</a>
            <a class="dropdown-item" href="#">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout">Log out</a>
          </div>
        </li>
      <?php endif; ?>
    </ul>

</nav>
<div class="container">


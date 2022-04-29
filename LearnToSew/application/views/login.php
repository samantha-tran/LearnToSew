<html>
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
    </head>
  <body>
      <!-- FORM TEMPLATE FROM https://mdbootstrap.com/docs/standard/extended/login/ -->
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex align-items-center justify-content-center h-100">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                        class="img-fluid" alt="Phone image">
                    </div>
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        <?php echo form_open(base_url().'login/check_login'); ?>

                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <label class="form-label">Username</label>
                            <input 
                                value="<?php 
                                echo isset($_COOKIE['remember']) ? $_COOKIE['username'] : ""
                                ?>" 
                                name="username" 
                                type="text" 
                                required="required" 
                                class="form-control form-control-lg" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label">Password</label>
                            <input 
                            value="<?php 
                            echo isset($_COOKIE['remember']) ? $this->encryption->decrypt($_COOKIE['password']) : ""
                            ?>" 
                            name="password" 
                            type="password" 
                            required="required" 
                            class="form-control form-control-lg" />
                        </div>
                        
                        <?php echo $error; ?>


                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="remember" checked="checked"/>
                                <label class="form-check-label"> Remember me </label>
                            </div>
                            <a href="<?php echo BASE_URL(); ?>forgot">Forgot Password</a>
                            
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="mb-2 mt-2 btn btn-primary btn-lg btn-block">Sign in</button>

                        <a href="<?php echo BASE_URL();?>register">
                            <button type="button" class="mb-2 mt-2 btn btn-secondary btn-lg btn-block">Register</button>
                        </a>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                        </div>

                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"
                            role="button">
                            <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
                        </a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </section>

<style>
    body {
        font-family: 'Roboto', sans-serif;
    }
</style>

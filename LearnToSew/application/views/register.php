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
        <script src="https://apis.google.com/js/platform.js" async defer></script>
    </head>
  <body>
      <!-- FORM TEMPLATE FROM https://mdbootstrap.com/docs/standard/extended/login/ -->
        <section class="blue-bg">
            <div class="container py-5">
                <div class="row d-flex align-items-center justify-content-center h-100">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <img class="my-4" src="<?php echo base_url() . "./assets/img/learntosew-white.png";?>">
                    </div>
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center h1 fw-bold mb-2 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <?php echo form_open(base_url().'register/register'); ?>

                                    <div class="d-flex flex-row align-items-center mb-1">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example1c">Username</label>
                                            <input name="username" required="required" type="text" value="<?php echo set_value('username'); ?>" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-1">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example3c">Email</label>
                                            <input name="email" required="required" type="email" value="<?php echo set_value('email'); ?>" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-1">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4c">Password</label>
                                            <input name="password" required="required" type="password" value="<?php echo set_value('password'); ?>" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-1">
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4c">Type the characters below:</label>
                                            <div class="mb-2">
                                                <?php $this->captcha_model->generate_captcha(); ?>
                                            </div>
                                            <input name="captcha" required="required" type="text" class="form-control" />
                                        </div>
                                    </div>

                                    <div>
                                        <?php 
                                            if (null != validation_errors()) {
                                                echo "<div class='text-center alert alert-danger' role='alert'>" . validation_errors() . "</div>";
                                            }
                                            if (isset($captcha_error)) {
                                                echo "<div class='alert alert-danger text-center' role='alert'>" . $captcha_error . "</div>";
                                            }
                                        ?>
                                    </div>

                                    <div class="form-check d-flex mb-2">
                                        <input
                                        class="form-check-input me-2"
                                        type="checkbox"
                                        value=""
                                        required="required"
                                        id="form2Example3c"
                                        />
                                        <label class="form-check-label" for="form2Example3">
                                        I agree all statements in <a href="#!">Terms of service</a>
                                        </label>
                                    </div>
                                    <a href=<?php echo base_url() . "login" ?>>Already have an account? Click here to sign in</a>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mt-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                    </div>
                                    
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<style scoped>
    .card-body {
        width: 450px;
    }

    .blue-bg {
        background-color: #007bff;
    }
</style>
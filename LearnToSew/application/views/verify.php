<html>
	<head>
			<title>Learn To Sew</title>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
			<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	</head>
    <style scoped>
        .inputs input {
            width: 40px;
            height: 40px
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0
        }

        .card-2 {
            background-color: #fff;
            padding: 10px;
            width: 350px;
            height: 100px;
            bottom: -50px;
            left: 20px;
            position: absolute;
            border-radius: 5px
        }

        .card-2 .content {
            margin-top: 50px
        }

        .card-2 .content a {
            color: red
        }

        .form-control:focus {
            box-shadow: none;
            border: 2px solid red
        }

        .validate {
            border-radius: 20px;
            height: 40px;
            background-color: red;
            border: 1px solid red;
            width: 140px
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            function OTPInput() {
                const inputs = document.querySelectorAll('#verification-code > *[id]');
                    for (let i = 0; i < inputs.length; i++) 
                        { inputs[i].addEventListener('keydown', function(event) { 
                            if (event.key==="Backspace" ) { 
                                inputs[i].value = ''; //set input to empty
                                if (i !==0) {
                                    inputs[i - 1].focus(); //
                                } 
                            } else { 
                                if (i === inputs.length - 1 && inputs[i].value !== '') { 
                                    return true; 
                                } else if (event.keyCode> 47 && event.keyCode < 58) { 
                                    inputs[i].value=event.key; 
                                    if (i !==inputs.length - 1) {
                                        inputs[i + 1].focus(); 
                                    }
                                    event.preventDefault(); 
                                } else if (event.keyCode> 64 && event.keyCode < 91) { 
                                    inputs[i].value=String.fromCharCode(event.keyCode); 
                                    if (i !==inputs.length - 1) {
                                        inputs[i + 1].focus(); 
                                    }
                                    event.preventDefault(); 
                                } 
                            } 
                        }); 
                    } 
                } 
                OTPInput(); 
            }
        );

    </script>
  <body>
      <!-- https://mdbootstrap.com/docs/standard/extended/registration/ -->
        <section class="vh-100" style="background-color: #0069d9;">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Verify Your Email</p>

                            <?php echo form_open(base_url().'verify/validate'); ?>
                            <p>An email has been sent to ....<?php ?></p>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                <div class="form-outline flex-fill mb-0">
                                    <label class="form-label" for="form3Example1c">Verification Code</label>
                                    <div id="verification-code" class="inputs d-flex flex-row justify-content-center mt-2"> 
                                        <input required name="field1" class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" /> 
                                        <input required name="field2" class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" /> 
                                        <input required name="field3" class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" /> 
                                        <input required name="field4" class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" /> 
                                        <input required name="field5" class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" /> 
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                <a class="mx-auto" href="<?php echo BASE_URL(); ?>register">
                                    <button type="button" class="btn btn-secondary btn-lg">Resend Email</button>
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg mx-auto">Verify</button>
                            </div>

                            <?php echo form_close(); ?>

                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
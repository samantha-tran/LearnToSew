<html>
    <head>
        <style scoped type='text/css'>
            body {background-color: #CCD9F9;
                font-family: Verdana, Geneva, sans-serif}

            h3 {color:#0146d1}

            p {font-weight:bold}
        </style>
    </head>
    <body>
    <div>
        <h3>Hi <?php echo $this->session->userdata('username'); ?>,</h3>
        <h3>Your account verification code is</h3> 
        <h2><?php echo $verification_token ?></h2>
        <p>Thanks for signing up for LearnToSew.</p>   
        <p>Your sewing journey starts now!</p>
    </div>  
    </body>
</html>
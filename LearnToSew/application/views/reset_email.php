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
        <h3>Hi <?php echo $username; ?>,</h3>
        <h3>You have requested to reset your password.</h3> 
        <h2><a href="<?php echo $reset_url ?>">Click Here To Reset.</a></h2>
        <p>Thanks for being a member of LearnToSew.</p>   
        <p>Your sewing journey starts now!</p>
    </div>  
    </body>
</html>
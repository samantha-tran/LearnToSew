<div class="container" >
    <div class='my-5 card'>
        <div class='card-body'>
            <h2>Update Your Details</h2>
            <?php echo form_open(base_url().'user/update'); ?>
            <div class="col-md-12">
                <label for="inputPassword4" required class="form-label">Username</label>
                <input 
                    type="text" 
                    name="username"
                    class="form-control" 
                    placeholder="<?php echo $user_details->username;?>">
            </div>
            <div class="col-md-12">
                <label for="inputEmail4" required class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email"
                    class="form-control"
                    placeholder="<?php echo $user_details->email;?>"
                    >
            </div>
            <div class="col-md-12">
                <label for="inputPassword4" class="form-label">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    name="password">
            </div>
            <div class="col-md-12">
                <h3 class="pt-3">
                    <?php 
                        if ($user_details->is_verified == 1) {
                            echo "<span class='badge bg-success'>Verified</span>";
                        } else {
                            echo "<a class='text-white' href=".base_url()."/verify><span class='badge badge-dark'>Not Verifed - Click to verify</span>";
                        }
                    ?>
                </h3>
            </div>
            <div class="col-12">
            <button class="btn btn-primary" type="submit">Update</button>
            </div>
            <?php echo $error; ?>
            <?php echo form_close(); ?>
        </div>
    </div>
    </div>
</div>
</body>
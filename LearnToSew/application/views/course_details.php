<div class="container-fluid">
    <h1><?php echo $course_details->title;?></h1>
    <img src="<?php echo base_url().'uploads/images/'.$course_details->image;?>"></img>
    <p><?php echo $course_details->description;?></p>
    <p><?php echo $course_details->username;?></p>
    <video width="320" height="240" controls>
        <source src="<?php echo base_url().'uploads/videos/'.$course_details->video;?>" type="video/mp4">
    </video>
</div>
</body>
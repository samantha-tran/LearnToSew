<div class="container" >
    <h1 class="text-center"><?php echo $course_details->title;?></h1>
    <img src="<?php echo base_url().'uploads/images/'.$course_details->image;?>"></img>
    <p>Course Description: <?php echo $course_details->description;?></p>
    <p>Author: <?php echo $course_details->username;?></p>
    <p>Average Rating: <?php 
        $rating = $this->course_model->get_average_rating($course_details->courseID);
        if ($rating == null) {
            echo 0;
        } else {
            echo $rating;
        }
        ?>
    </p>
    <video width="320" height="240" controls>
        <source src="<?php echo base_url().'uploads/videos/'.$course_details->video;?>" type="video/mp4">
    </video>
    
    <!-- User should only be able to write a review if they've purchased this course -->
    <div class="reviews">
        <?php 
            $reviews = $this->course_model->get_reviews($course_details->courseID);
            $reviewTemplate = "
            <div class='mb-3 card'>
                <div class='card-body'>
                    <h5 class='card-title'>%s</h5>
                    <h6 class='card-subtitle text-muted'>%s</h6>
                    <p class='card-text'>%s <br> Rating: %d/5</p>
                </div>
            </div>";
            foreach ($reviews->result() as $review) {
                echo sprintf(
                    $reviewTemplate, 
                    $review->title = null ? "" : $review->title,
                    $review->username,
                    $review->review = null ? "" : $review->review,
                    $review->rating = null ? "" : $review->rating
                );
            }
        ?>
    </div>
    <div class='mb-3 card'>
        <div class='card-body'>
            <h3>Write A Review</h3>
            <?php echo form_open(base_url().'course/upload_review/'.$course_details->courseID); ?>
            <div class="form-group">
                <label for="exampleFormControlInput1">Title</label>
                <input type="text" class="form-control" name="title" id="exampleFormControlInput1">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Review</label>
                <textarea class="form-control" name="review" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            
            <div class="form-group">
                <label>Rating</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" required type="radio" name="rating" value="1" />
                        <label class="form-check-label">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" required type="radio" name="rating" value="2" />
                        <label class="form-check-label">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" required type="radio" name="rating" value="3" />
                        <label class="form-check-label">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" required type="radio" name="rating" value="4" />
                        <label class="form-check-label">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" required type="radio" name="rating" value="5" />
                        <label class="form-check-label">5</label>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Submit form</button>

            <?php echo form_close(); ?>
        </div>
    </div>
    </div>
</div>
</body>
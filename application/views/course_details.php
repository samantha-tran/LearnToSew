<div class="container" >
    <div class="row">
        <div class="col">
        <h1 class="text-center"><?php echo "<xmp>" . $course_details->title . "</xmp>";?></h1>
        </div>
    </div>
    <div class="row py-5">
        <div class="col">
            <p><?php echo "<xmp>Author: " . $course_details->username . "</xmp>";?></p>
            <p>Average Rating: <?php 
                $rating = $this->course_model->get_average_rating($course_details->courseID);
                if ($rating == null) {
                    echo 0;
                } else {
                    echo $rating;
                }
                ?>
            </p>
            <div id="description">
                <p >Course Description: <?php echo "<xmp>" . $course_details->description . "</xmp>";?></p>
            </div>
            <div>
                <?php
                    if ($this->pattern_model->is_purchased($this->user_model->get_ID($_SESSION['username']), $course_details->courseID)) {
                        echo "<button type='button'class='btn btn-secondary btn-lg'>
                                Already Purchased
                              </button>";
                    } else if ($this->cart_model->is_in_cart($this->user_model->get_ID($_SESSION['username']), $course_details->courseID)) {
                        echo "<button id='cart-button' type='button' onclick='removeFromCart()' class='btn btn-secondary btn-lg'>
                                Remove From Cart
                              </button>";
                    } else {
                        echo "<button id='cart-button' type='button' onclick='addToCart()' class='btn btn-primary btn-lg'>
                                Add Patterns To Cart
                              </button>";
                    }
                ?>
            </div>
        </div>
        <div class="col">
            <video width="400" height="300" controls>
                <source src="<?php echo base_url().'uploads/videos/'.$course_details->video;?>" type="video/mp4">
            </video>
        </div>
    </div>
    <!-- User should only be able to write a review if they've purchased this course -->
    <div class="reviews">
        <?php 
            $reviews = $this->course_model->get_reviews($course_details->courseID);
            $reviewTemplate = "
            <div class='mb-3 card card-blue'>
                <div class='card-body'>
                    <h5 class='card-title'><xmp>%s</xmp></h5>
                    <h6 class='card-subtitle text-muted'><xmp>%s</xmp></h6>
                    <p class='card-text'><xmp>%s</xmp> <br> Rating: %d/5</p>
                </div>
            </div>";

            if (count($reviews->result()) == 0) {
                echo "<div class='mb-3 card card-blue'>
                        <div class='card-body'>
                            <h5 class='card-title text-center'>No Reviews For This Course Yet...</h5>
                        </div>
                      </div>";
            } else {
                foreach ($reviews->result() as $review) {
                    echo sprintf(
                        $reviewTemplate, 
                        $review->title = null ? "" : $review->title,
                        $review->username,
                        $review->review = null ? "" : $review->review,
                        $review->rating = null ? "" : $review->rating
                    );
                }
            }
            
        ?>
    </div>
    
    <div class='mb-3 card card-blue'>
        <div class='card-body '>
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

<style>
    #description {
        height: 150px;
    }

    .card-blue {
        background-color: #D2E8FF;
    }
</style>
<script>

    function addToCart() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().'cart/add';?>",
            data: {
                courseID: <?php echo $course_details->courseID;?>,
                userID: <?php echo $this->user_model->get_ID($_SESSION['username'])?>
            },
            error: function(response) {
                alert("Problem adding to cart. Try again later.");
            },
            success: function(response) {
                $("#cart-button").attr("onclick","removeFromCart()");
                $("#cart-button").html("Remove From Cart");
                $("#cart-button").removeClass("btn-primary").addClass("btn-secondary");
            }
        });
    }

    function removeFromCart() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().'cart/remove';?>",
            data: {
                cartID: <?php echo $this->cart_model->get_cartID($this->user_model->get_ID($_SESSION['username']), $course_details->courseID);?>
            },
            error: function(response) {
                alert("Problem removing from cart. Try again later.");
            },
            success: function(response) {
                $("#cart-button").attr("onclick","addToCart()");
                $("#cart-button").html("Add Patterns To Cart");
                $("#cart-button").removeClass("btn-secondary").addClass("btn-primary");
            }
        });
    }
</script>

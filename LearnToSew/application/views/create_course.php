<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>
<div class="container my-5">
    <?php echo form_open_multipart('course/upload');?>
    <div class="form-group">
        <label for="exampleFormControlInput1">Course Title</label>
        <input type="text" autocomplete="off" class="form-control" name="title" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Course Description</label>
        <textarea autocomplete="off" class="form-control" name='description' required rows="3"></textarea>
    </div>
    <div class="form-group">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Course Difficulty</label>
        <select class="custom-select my-1 mr-sm-2" name='difficulty' required>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
        </select>
    </div>
    <div class="form-group">
        <label class="mb-3 mr-2" for="inlineFormCustomSelectPref">Price</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input autocomplete="off" type="text" name='price' class="form-control" required aria-label="Amount (to the nearest dollar)">
        </div>
    </div>
    <div class="d-flex justify-content-around">
        <div class="form-group my-5 p-2">
            <label class="mb-3 mr-2 center-text">Drag or Click to <b>Upload Thumbnail Image</b></label>
            <div>
                <input class="mb-3 dropzone" type="file" name="thumbnail" required size="20" /> 
            </div>
        </div>
        <div class="form-group my-5 p-2">
            <label class="mb-3 mr-2 center-text">Drag or Click to <b>Upload Course Video</b></label>
            <div>
                <input class="mb-3 dropzone" type="file" name="videoFile" required size="20" /> 
            </div>
        </div>
        <div class="form-group my-5 p-2">
            <label class="mb-3 mr-2 center-text">Drag or Click to <b>Upload PDF Patterns</b></label>
            <div>
                <input class="dropzone mb-3" type="file" name="patternFiles[]" multiple size="20" /> 
            </div>
        </div>
    </div>
    <div>
        <p class="center-text">Note: Images must be under 1000px x 1000px. Images will be cropped / resized to size of 500px x 500px from the top left corner.</p>
    </div>
    <?php if ($error) {
        echo "<div class='text-center alert alert-danger' role='alert'>" . $error . "</div>"; 
    }?>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Upload</button>
    <?php echo form_close(); ?>
</div>
</div>
<style>
    input[type=file] {
        background-color: #f8f9fa;
        border: 2px solid #D3D3D3;
        height:50px;
        margin: 0 auto;
        padding-top: 10px;
        padding-left: 40px;
        width: 300px;
    }

    .center-text {
        width: 100%;
        text-align: center;
    }
</style>
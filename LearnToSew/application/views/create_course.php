<div class="container my-5">
    <?php echo form_open_multipart('course/upload');?>
    <div class="form-group">
        <label for="exampleFormControlInput1">Course Title</label>
        <input type="email" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Course Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Difficulty</label>
        <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
            <option selected>Choose...</option>
            <option value="Beginner">Beginner</option>
            <option value="2">Intermediate</option>
            <option value="3">Advanced</option>
        </select>
    </div>
    <div class="form-group">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Price</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
        </div>
    </div>
    <div class="form-group my-5 p-2">
        <label class="my-1 mr-2">Upload Course Videos</label>
        <div>
            <input type="file" name="videoFiles[]" multiple size="20" /> 
        </div>
    </div>
    <div class="form-group my-5 p-2">
        <label class="my-1 mr-2">Upload PDF Patterns</label>
        <div>
            <input type="file" name="patternFiles[]" multiple size="20" /> 
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Upload</button>
    <?php echo form_close(); ?>
</div>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quiz 2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2 class="text-center">Consultation Appointment Dashboard</h2>
    <hr>
	<h5> The total number of consultants is <?php if(isset($count))echo $count->consultant_count;?></h5>
	<hr>
    <?php echo form_open('quiz2', array('method'=>'get'))?>
	
        <div class="row">
            <div class="col-3 form-inline">
                <label for="Consultant name">Consultant Name:&nbsp;</label>
                <input size="6" id="consultant_name" type="text" class="form-control" name="keyword" 
                value="<?php echo ($this->input->get('keyword') != null) ? $this->input->get('keyword') : "";?>">
            </div>

            <div class="col-4 form-inline">
                <label for="record_limit">Show</label>
                <input size="1" id="record_limit" type="text" class="form-control" name="record_limit" 
                value="<?php echo ($this->input->get('record_limit') != null) ? $this->input->get('record_limit') : "";?>">
                <label for="record_limit">Appointments&nbsp;Only</label>
            </div>

            <div class="col-3 form-inline">
                <div class="form-group">
                    <label for="duration_sort">Duration Sorted in:&nbsp;</label>
                    <select name="sort_by" id="score_sort" class="form-control" >
                        <option <?php echo ($this->input->get("sort_by") == "asc" ? "selected" : "");?> value="asc">Ascending</option>
                        <option <?php echo ($this->input->get("sort_by") == "desc" ? "selected" : ""); ?>  value="desc">Descending</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <button type="submit"  class="btn btn-primary" >Search</button>
            </div>
			
        </div>
    </form>
	
    <hr>
	
    <table class="table table-striped text-center">
        <thead>
        <tr>
            <th>Customer Name</th>
            <th>Consultant Name</th>
            <th>Date</th>
            <th>Duration</th>
        </tr>
        </thead>
        <tbody>
		<?php if(isset($appointment))
			foreach($appointment as $row){
			echo "
				<tr>
					<td>$row->customer_name</td>
					<td>$row->consultant_name</td>
					<td>$row->date</td>
					<td>$row->duration</td>
				</tr>
			";
		}?>		
        </tbody>
    </table>
</div>

</body>
</html>

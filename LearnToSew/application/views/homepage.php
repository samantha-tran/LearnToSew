<div class="container-fluid">
    <?php echo form_open('search/fetch');?>
        <div class="pt-4 input-group d-flex justify-content-center">
            <div class="form-outline">
                <input type="search" id="search-box" list="search-results" name="search" placeholder="Search Courses" class="form-control search-box" />
                <!--<datalist id="search-results"></datalist>-->
                <div id="search-results"></div>
            </div>
            <button type="button" class="btn btn-primary search-button">
                <svg xmlns="http://www.w3.org/2000/svg" height=25px fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
    <?php form_close();?>
    
	<div class="px-5">
        <h1 class="title">Recently Uploaded Courses</h1>
		<div class="row flex flex-wrap">
			<?php 
			$recent_course_template = "
				<div class='col d-flex justify-content-center'>
					<div class='card my-4'>
						<div class='bg-image hover-overlay ripple' data-mdb-ripple-color='light'>
							<img src='%s' class='img-fluid fill'/>
							<a href='#!'>
							<div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
							</a>
						</div>
						<div class='card-body'>
							<h5 class='card-title'><xmp>%s</xmp></h5>
							<p class='card-text'><xmp>%s</xmp></p>
                            <a href='%s' class='btn btn-primary'>View</a>
						</div>
					</div>
				</div>
			";
            $recent_courses = $this->course_model->get_recent_courses();
			foreach ($recent_courses->result() as $row) {
                
                $thumbnail = $this->course_model->get_course_thumbnail($row->courseID);
				echo sprintf($recent_course_template, base_url().'uploads/images/'.$thumbnail->filename, $row->title, $row->descript, base_url()."course/details/".$row->courseID);
			}
			?>
		</div>
	</div>
</div>
</body>
<style scoped>
    .search-box {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        height: 40px;
        width: 40vw;
        margin: auto;
    }

    .search-box:focus {
        box-shadow: 0 0 0 rgb(255, 255, 255);
    }

    .search-button {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .autocomplete {
        background-color: gray;
        width: 40vw;
    }

    .fill {
        object-fit: cover;
        width: 100%;
    }

    .card {
        width: 300px;
    }

    .title {
        padding: 40px;
        text-align: center;
    }

    #search-results {
        position: absolute;
        z-index: 999; /* Whatever number that keeps it above the menu */
        width: 40vw;
        
    }

    #search-item {
        background-color: white;
        border: solid 1px #17a2b8;
        padding: 5px 10px;
    }

    #search-item-link:hover {
        text-decoration: none;
    }
</style>
<script>
    $(document).ready(function() {
        load_data();

        place_search_result();
        
        function load_data(search) {
            $.ajax({
                url: "<?php echo base_url();?>search/fetch",
                method: "GET",
                data: {query:search},
                success: function(response) { //function to be called when request is finished
                    $('#search-results').html("");
                    if (response == "") {
                        $('#search-results').html(response);
                    } else {
                        var obj = JSON.parse(response);
                        console.log(obj);
                        if (obj.length > 0) {
                            var html = "";
                            $.each(obj, function(i, val) {
                                html += "<a id='search-item-link' href='" + "<?php echo base_url();?>" + "course/details/" + val.courseID + "'><div id='search-item'>" + val.title + "</div></a>";
                            });
                            console.log(html);
                            $('#search-results').html(html);
                        }
                    }
                }
            })
        }

        function place_search_result() {
            // get search box top
            var top = parseInt($( "search-box" ).css('top'));
            // get search box right
            var right = parseInt($( "search-box" ).css('right'));

            $( "#search-results" ).css('top', top + 40);
            $( "#search-results" ).css('right', right);
        }


        $('#search-box').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else{
                load_data();
            }
        });

    });
</script>

<div class="container-fluid">
    <?php echo form_open('search/fetch');?>
        <div class="input-group d-flex justify-content-center">
            <div class="form-outline">
                <input type="search" id="search-box" name="search" placeholder="Search Courses" class="form-control search-box" />
            </div>
            <button type="button" class="btn btn-primary search-button">
                <svg xmlns="http://www.w3.org/2000/svg" height=25px fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
    <?php form_close();?>
    <div>
        <div id="search-result"></div>
    </div>
</div>
</body>
<style scoped>
    .container-fluid {
        background-color: pink;
    }

    .search-box {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
        height: 40px;
        width: 400px;
    }

    .search-box:focus {
        box-shadow: 0 0 0 rgb(255, 255, 255);
    }

    .search-button {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }
</style>
<script>
    $(document).ready(function() {
        load_data();
        
        function load_data(search) {
            $.ajax({
                url: "<?php echo base_url();?>search/fetch",
                method: "GET",
                data: {query:search},
                success: function(response) { //function to be called when request is finished
                    $('#search-result').html("");
                    if (response == "") {
                        $('#search-result').html(response);
                    } else {
                        var obj = JSON.parse(response);
                        if (obj.length > 0) {
                            var items=[];
                            $.each(obj, function(i, val) {
                                items.push($("<h4>").text(val.title));
                            });
                            $('#search-result').append.apply($('#search-result'), items);
                        } else {
                            $('#search-result').html("Not Found!");
                        }
                    }
                }
            })
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

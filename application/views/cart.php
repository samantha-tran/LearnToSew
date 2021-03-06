

<html>
    <div class="container my-5">
        <table id="cart" class="table">
        <thead>
            <tr>
            <th scope="col">Course</th>
            <th scope="col">Cost</th>
            <th scope="col"></th>
            </tr>
        </thead>
            <tbody id="cart-body">
                <?php 
                $row_template = "
                    <tr id='%d'>
                        <td><xmp>%s</xmp></td>
                        <td>%d</td>
                        <td style='width:90px'><button type='button' onClick='removeFromCart(%d)' class='btn btn-danger'><i class='far fa-trash-alt'></i></button></td>
                    </tr>";
                $course_details = $this->cart_model->get_cart_details($this->user_model->get_ID($_SESSION['username']));
                foreach ($course_details->result() as $row) {
                    echo sprintf($row_template, $row->cart_id, $row->title, $row->price, $row->cart_id);
                }
                ?>
                <tr>
                    <td id="total-cost" colspan="3" class="text-right">
                        Total Cost: <?php echo $this->cart_model->get_total_cost($this->user_model->get_ID($_SESSION['username']))?>
                    </td>
                </tr>
        </tbody>
        </table>
        <a href="<?php echo base_url()."cart/buy"; ?>" class="btn"><img src="<?php echo base_url()."./assets/img/paypal-btn.PNG"; ?>" /></a>
    </div>
</html>

<script>
        function removeFromCart(cart_id) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().'cart/remove';?>",
                data: {
                    cartID: cart_id
                },
                error: function(response) {
                    alert("Problem removing from cart. Try again later.");
                },
                success: function(response) {
                    //remove table row from html
                    $(`#${cart_id}`).remove();
                    //update total costs
                    var obj = JSON.parse(response);
                    $('#total-cost').html("Total Cost: " + obj['cost']);
                }
            });
	}
</script>

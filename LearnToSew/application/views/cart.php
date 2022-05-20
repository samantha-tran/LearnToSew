

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
                        <td>%s</td>
                        <td>%d</td>
                        <td style='width:90px'><button type='button' onClick='removeFromCart(%d)' class='btn btn-danger'><i class='far fa-trash-alt'></i></button></td>
                    </tr>";
                $course_details = $this->cart_model->get_cart_details($this->user_model->get_ID($_SESSION['username']));
                foreach ($course_details->result() as $row) {
                    echo sprintf($row_template, $row->cart_id, $row->title, $row->price, $row->cart_id);
                }
                ?>
        </tbody>
        </table>
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
                    //remove from html
                    $(`#${cart_id}`).remove();
                }
            });
        }
</script>
<html>
    <div class="container my-5">
        <table id="cart" class="table">
        <thead>
            <tr>
            <th scope="col">Course</th>
            <th scope="col">Pattern Download Link</th>
            </tr>
        </thead>
            <tbody id="cart-body">
                <?php 
                $row_template = "
                    <tr>
                        <td><xmp>%s</xmp></td>
                        <td><a href='%s' download='%s'>%s</a></td>
                    </tr>";
                foreach ($patterns->result() as $row) {
                    $download_link = base_url() . "./uploads/pdfs/" . $row->filename;
                    echo sprintf($row_template, $row->title, $download_link, $row->filename, $row->filename, $row->filename);
                }
                ?>
        </tbody>
        </table>
    </div>
</html>


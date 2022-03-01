<?php
$table_title = str_replace('_', ' ', $table_name);
$string = "<div class=\"content-wrapper\">
    
    <section class=\"content\">
        <div class=\"box box-warning box-solid\">
            <div class=\"box-header with-border\">
                <h3 class=\"box-title\">" .  strtoupper($table_title) . "</h3>
            </div>
            <form action=\"<?php echo \$action; ?>\" method=\"post\">
            
            <div class=\"box-body\">
                <div class=\"row\">
                    <div class=\"col-md-6\">        
            ";
foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text') {
        $string .= "\n\t    
        <div class=\"form-group\">
            <label>" . label($row["column_name"]) . " <?php echo form_error('" . $row["column_name"] . "') ?></label>
            <textarea class=\"form-control\" rows=\"3\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" ><?php echo $" . $row["column_name"] . "; ?></textarea>
        </div>";
    } elseif ($row["data_type"] == 'email') {
        $string .= "\n\t    
        <div class=\"form-group\">
            <label>" . label($row["column_name"]) . " <?php echo form_error('" . $row["column_name"] . "') ?></label>
            <input type=\"email\" class=\"form-control\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" placeholder=\"\" value=\"<?php echo $" . $row["column_name"] . "; ?>\" />
        </div>";
    } elseif ($row["data_type"] == 'date') {
        $string .= "\n\t    
        <div class=\"form-group\">
            <label>" . label($row["column_name"]) . " <?php echo form_error('" . $row["column_name"] . "') ?></label>
            <input type=\"date\" class=\"form-control\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" value=\"<?php echo $" . $row["column_name"] . "; ?>\" />
        </div>";
    } else {
        $string .= "\n\t    
        <div class=\"form-group\">
            <label>" . label($row["column_name"]) . " <?php echo form_error('" . $row["column_name"] . "') ?></label>
            <input type=\"text\" class=\"form-control\" name=\"" . $row["column_name"] . "\" id=\"" . $row["column_name"] . "\" value=\"<?php echo $" . $row["column_name"] . "; ?>\" />
        </div>";
    }
}
$string .= "\n\t    <div class=\"box-footer\">
                        <input type=\"hidden\" name=\"" . $pk . "\" value=\"<?php echo $" . $pk . "; ?>\" /> ";
$string .= "\n\t        <button type=\"submit\" class=\"btn btn-danger\"><i class=\"fa fa-floppy-o\"></i> <?php echo \$button ?></button> ";
$string .= "\n\t        <a href=\"<?php echo site_url('" . $c_url . "') ?>\" class=\"btn btn-info\"><i class=\"fa fa-sign-out\"></i> Cancel</a>
                    </div>";
$string .= "\n\t
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>";

$hasil_view_form = createFile($string, $target . "views/" . $c_url . "/" . $v_form_file);

<?php

$string="
<div class=\"main-container\" style=\"min-height:100%\">
    <div class=\"pd-ltr-20 xs-pd-20-10\">
        <div class=\"min-height-200px\">
            <div class=\"page-header\">
                <div class=\"row\">
                    <div class=\"col-md-6 col-sm-12\">
                        <div class=\"title\">
                            <h4>".ucwords(str_replace('_',' ',$table_name))."</h4>
                        </div>
                        <nav aria-label=\"breadcrumb\" role=\"navigation\">
                            <ol class=\"breadcrumb\">
                                <li class=\"breadcrumb-item\"><a href=\"<?php echo base_url(); ?>dashboard\">Home</a></li>
                                <li class=\"breadcrumb-item active\" aria-current=\"page\">".ucwords(str_replace('_',' ',$table_name))."</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class=\"pd-20 card-box mb-30\">
                <div class=\"clearfix\">
                    <div class=\"pull-left\">
                        <h4 class=\"text-blue h4\">Form ".ucwords(str_replace('_',' ',$table_name))." </h4>
                        <p class=\"mb-30\"></p>
                    </div>
                </div>
                <form action=\"<?php echo \$action; ?>\" method=\"post\" class=\"form-horizontal\">";
                foreach ($non_pk as $row) {
                  if ($row["data_type"] == 'text')
                  {
                    $string .= "\n\t 
                    <div class=\"form-group row\">
                        <label class=\"col-sm-12 col-md-2 col-form-label\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
                        <div class=\"col-sm-12 col-md-10\">
                        <textarea class=\"form-control\" rows=\"3\" readonly name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
                        </div>
                    </div>";
                  }else{
                    $string .= "\n\t   
                    <div class=\"form-group row\">
                        <label class=\"col-sm-12 col-md-2 col-form-label\">".label($row["column_name"])." <?php echo form_error('".$row["column_name"]."') ?></label>
                          <div class=\"col-sm-12 col-md-10\">
                            <input type=\"text\" class=\"form-control\" readonly name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
                          </div>
                    </div>";
                  }
                }
                $string .= "\n\t
            
        <div class=\"card-footer text-left\">
        <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
        $string .= "\n\t    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-icon icon-left btn-success\">Cancel</a>";
        $string .= "\n\t
          </form>
          </div>
      </div>
  </div>
</div>
";



// $hasil_view_read = createFile($string, $target."views/" . $v_read_file);
$hasil_view_read = createViewRead($v_read_file,$v_read_file,$string, $target."views/". $v_read_file);

?>
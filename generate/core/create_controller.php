<?php

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $c . " extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        \$this->load->model('$m');
        \$this->load->library('form_validation');
    }";
    
$string .="\n\n    public function index()
    {
        \$$c_url = \$this->" . $m . "->get_all();

        \$data = array(
            '" . $c_url . "_data' => \$$c_url
        );
        \$this->load->view('header');
        \$this->load->view('".lcfirst($c)."/".$v_list."', \$data);
        \$this->load->view('footer');
    }";

    $string .="\n\n    public function fetch_data(){
        \$starts       = \$this->input->post(\"start\");
        \$length       = \$this->input->post(\"length\");
        \$LIMIT        = \"LIMIT \$starts, \$length \";
        \$draw         = \$this->input->post(\"draw\");
        \$search       = \$this->input->post(\"search\")[\"value\"];
        \$orders       = isset(\$_POST[\"order\"]) ? \$_POST[\"order\"] : ''; 
        
        \$where =\"WHERE 1=1\";
        \$result=array();
        if (isset(\$search)) {
          if (\$search != '') {
                \$where .= \" "; 
                foreach ($non_pk as $row) {
                    $string .="AND (".$row['column_name']." LIKE '%\$search%'";
                    $string .= "\n\t ";
                }
                $string .=')";';
                $string .= "\n\t
              }
          }
    
        if (isset(\$orders)) {
            if (\$orders != '') {
              \$order = \$orders;
              \$order_column =";
              $string.="[";
              foreach ($non_pk as $row) {
                $string .="'".$row['column_name']."',";
            }
            $string .= "];
              \$order_clm  = \$order_column[\$order[0]['column']];
              \$order_by   = \$order[0]['dir'];
              \$where .= \" ORDER BY \$order_clm \$order_by \";
            } else {
              \$where .= \" ORDER BY id ASC \";
            }
          } else {
            \$where .= \" ORDER BY id ASC \";
          }
          if (isset(\$LIMIT)) {
            if (\$LIMIT != '') {
              \$where .= ' ' . \$LIMIT;
            }
          }
        \$index=1;
        \$button=\"\";
        \$fetch = \$this->db->query(\"SELECT * from $c_url \$where\");
        \$fetch2 = \$this->db->query(\"SELECT * from $c_url \");
        foreach(\$fetch->result() as \$rows){
            \$button1= \"<a href=\".base_url('$c_url/read/'.\$rows->id).\" data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>\";
            \$button2= \"<a href=\".base_url('$c_url/update/'.\$rows->id).\" data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>\";
            \$button3 = \"<a href=\".base_url('$c_url/delete/'.\$rows->id).\" data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>\";
        
            \$sub_array=array();
            \$sub_array[]=\$index;";
            foreach($non_pk as $rows){
                $string .="\$sub_array[]=\$rows->".$rows['column_name'].";";
                $string .= "\n\t ";
            }
            $string .= "
            \$sub_array[]='<div class=\"table-actions\">'.\$button1.\" \".\$button2.\" \".\$button3.'</div>';
            \$result[]      = \$sub_array;
            \$index++;
        }
        \$output = array(
          \"draw\"            =>     intval(\$this->input->post(\"draw\")),
          \"recordsFiltered\" =>     \$fetch2->num_rows(),
          \"data\"            =>     \$result,
         
        );
        echo json_encode(\$output);
    
    }";
    
$string .= "\n\n    public function read(\$id) 
    {
        \$row = \$this->" . $m . "->get_by_id(\$id);
        if (\$row) {
            \$data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
$string .= "\n\t    );
            \$this->load->view('header');
            \$this->load->view('".lcfirst($c)."/".$v_read."', \$data);
            \$this->load->view('footer');
        } else {
            \$_SESSION['pesan'] = \"Record Not Found\";
            \$_SESSION['tipe'] = \"error\";
            redirect(site_url('$c_url'));
        }
    }

    public function create() 
    {
        \$data = array(
            'button' => 'Create',
            'action' => site_url('$c_url/create_action'),";
foreach ($all as $row) {
    $string .= "\n\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
}
$string .= "\n\t);

        \$this->load->view('header');
        \$this->load->view('".lcfirst($c)."/".$v_form."', \$data);
        \$this->load->view('footer');
    }
    
    public function create_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}
$string .= "\n\t    );

            \$this->".$m."->insert(\$data);
            \$_SESSION['pesan'] = \"Create Record Success\";
            \$_SESSION['tipe'] = \"success\";
            redirect(site_url('$c_url'));
        }
    }
    
    public function update(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$data = array(
                'button' => 'Update',
                'action' => site_url('$c_url/update_action'),";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
}
$string .= "\n\t    );
            \$this->load->view('header');
            \$this->load->view('".lcfirst($c)."/".$v_form."', \$data);
            \$this->load->view('footer');
        } else {
            \$_SESSION['pesan'] = \"Record Not Found\";
            \$_SESSION['tipe'] = \"error\";
            redirect(site_url('$c_url'));
        }
    }
    
    public function update_action() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->update(\$this->input->post('$pk', TRUE));
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}    
$string .= "\n\t    );

            \$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
            \$_SESSION['pesan'] = \"Update Record Success\";
            \$_SESSION['tipe'] = \"success\";
            redirect(site_url('$c_url'));
        }
    }
    
    public function delete(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$this->".$m."->delete(\$id);
            \$_SESSION['pesan'] = \"Delete Record Success\";
            \$_SESSION['tipe'] = \"success\";
            redirect(site_url('$c_url'));
        } else {
            \$_SESSION['pesan'] = \"Record Not Found\";
            \$_SESSION['tipe'] = \"error\";
            redirect(site_url('$c_url'));
        }
    }

    public function _rules() 
    {";
foreach ($non_pk as $row) {
    $int = $row3['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
    $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim|required$int');";
}    
$string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }";

if ($export_excel == '1') {
    $string .= "\n\n    public function excel()
    {
        \$this->load->helper('exportexcel');
        \$namaFile = \"$table_name.xls\";
        \$judul = \"$table_name\";
        \$tablehead = 0;
        \$tablebody = 1;
        \$nourut = 1;
        //penulisan header
        header(\"Pragma: public\");
        header(\"Expires: 0\");
        header(\"Cache-Control: must-revalidate, post-check=0,pre-check=0\");
        header(\"Content-Type: application/force-download\");
        header(\"Content-Type: application/octet-stream\");
        header(\"Content-Type: application/download\");
        header(\"Content-Disposition: attachment;filename=\" . \$namaFile . \"\");
        header(\"Content-Transfer-Encoding: binary \");

        xlsBOF();

        \$kolomhead = 0;
        xlsWriteLabel(\$tablehead, \$kolomhead++, \"No\");";
foreach ($non_pk as $row) {
        $column_name = label($row['column_name']);
        $string .= "\n\txlsWriteLabel(\$tablehead, \$kolomhead++, \"$column_name\");";
}
$string .= "\n\n\tforeach (\$this->" . $m . "->get_all() as \$data) {
            \$kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber(\$tablebody, \$kolombody++, \$nourut);";
foreach ($non_pk as $row) {
        $column_name = $row['column_name'];
        $xlsWrite = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? 'xlsWriteNumber' : 'xlsWriteLabel';
        $string .= "\n\t    " . $xlsWrite . "(\$tablebody, \$kolombody++, \$data->$column_name);";
}
$string .= "\n\n\t    \$tablebody++;
            \$nourut++;
        }

        xlsEOF();
        exit();
    }";
}

if ($export_word == '1') {
    $string .= "\n\n    public function word()
    {
        header(\"Content-type: application/vnd.ms-word\");
        header(\"Content-Disposition: attachment;Filename=$table_name.doc\");

        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        \$this->load->view('" . $v_doc . "',\$data);
    }";
}

if ($export_pdf == '1') {
    $string .= "\n\n    function pdf()
    {
        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        \$html = \$this->load->view('" . $v_pdf . "', \$data, true);
        \$this->load->library('pdf');
        \$pdf = \$this->pdf->load();
        \$pdf->WriteHTML(\$html);
        \$pdf->Output('" . $table_name . ".pdf', 'D'); 
    }";
}

$string .= "\n\n}\n\n/* End of file $c_file */
/* Location: ./application/controllers/$c_file */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi ".date('Y-m-d H:i:s')." */
/* https://gocodings.web.com */";





$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

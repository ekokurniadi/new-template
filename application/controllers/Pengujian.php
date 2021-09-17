<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengujian extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pengujian_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $pengujian = $this->Pengujian_model->get_all();

        $data = array(
            'pengujian_data' => $pengujian
        );
        $this->load->view('header');
        $this->load->view('pengujian/pengujian_list', $data);
        $this->load->view('footer');
    }

    public function fetch_data(){
        $starts       = $this->input->post("start");
        $length       = $this->input->post("length");
        $LIMIT        = "LIMIT $starts, $length ";
        $draw         = $this->input->post("draw");
        $search       = $this->input->post("search")["value"];
        $orders       = isset($_POST["order"]) ? $_POST["order"] : ''; 
        
        $where ="WHERE 1=1";
        $result=array();
        if (isset($search)) {
          if ($search != '') {
                $where .= " AND (teks LIKE '%$search%'
	 AND (cleaning LIKE '%$search%'
	 AND (casefolding LIKE '%$search%'
	 AND (tokenizing LIKE '%$search%'
	 AND (stemming LIKE '%$search%'
	 AND (rekomendasi LIKE '%$search%'
	 )";
	
              }
          }
    
        if (isset($orders)) {
            if ($orders != '') {
              $order = $orders;
              $order_column =['teks','cleaning','casefolding','tokenizing','stemming','rekomendasi',];
              $order_clm  = $order_column[$order[0]['column']];
              $order_by   = $order[0]['dir'];
              $where .= " ORDER BY $order_clm $order_by ";
            } else {
              $where .= " ORDER BY id ASC ";
            }
          } else {
            $where .= " ORDER BY id ASC ";
          }
          if (isset($LIMIT)) {
            if ($LIMIT != '') {
              $where .= ' ' . $LIMIT;
            }
          }
        $index=1;
        $button="";
        $fetch = $this->db->query("SELECT * from pengujian $where");
        $fetch2 = $this->db->query("SELECT * from pengujian ");
        foreach($fetch->result() as $rows){
            $button1= "<a href=".base_url('pengujian/read/'.$rows->id)." data-color='#265ed7' style='color: rgb(38, 94, 215);'><i class='icon-copy dw dw-eye'></i></a>";
            $button2= "<a href=".base_url('pengujian/update/'.$rows->id)." data-color='orange' style='color: orange'><i class='icon-copy dw dw-edit1'></i></a>";
            $button3 = "<a href=".base_url('pengujian/delete/'.$rows->id)." data-color='#e95959' style='color: rgb(233, 89, 89);' onclick='javasciprt: return confirm(\'Are You Sure ?\')''><i class='icon-copy dw dw-delete-3'></i></a>";
        
            $sub_array=array();
            $sub_array[]=$index;$sub_array[]=$rows->teks;
	 $sub_array[]=$rows->cleaning;
	 $sub_array[]=$rows->casefolding;
	 $sub_array[]=$rows->tokenizing;
	 $sub_array[]=$rows->stemming;
	 $sub_array[]=$rows->rekomendasi;
	 
            $sub_array[]='<div class="table-actions">'.$button1." ".$button2." ".$button3.'</div>';
            $result[]      = $sub_array;
            $index++;
        }
        $output = array(
          "draw"            =>     intval($this->input->post("draw")),
          "recordsFiltered" =>     $fetch2->num_rows(),
          "data"            =>     $result,
         
        );
        echo json_encode($output);
    
    }

    public function read($id) 
    {
        $row = $this->Pengujian_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'teks' => $row->teks,
		'cleaning' => $row->cleaning,
		'casefolding' => $row->casefolding,
		'tokenizing' => $row->tokenizing,
		'stemming' => $row->stemming,
		'rekomendasi' => $row->rekomendasi,
	    );
            $this->load->view('header');
            $this->load->view('pengujian/pengujian_read', $data);
            $this->load->view('footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('pengujian'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengujian/create_action'),
	    'id' => set_value('id'),
	    'teks' => set_value('teks'),
	    'cleaning' => set_value('cleaning'),
	    'casefolding' => set_value('casefolding'),
	    'tokenizing' => set_value('tokenizing'),
	    'stemming' => set_value('stemming'),
	    'rekomendasi' => set_value('rekomendasi'),
	);

        $this->load->view('header');
        $this->load->view('pengujian/pengujian_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'teks' => $this->input->post('teks',TRUE),
		'cleaning' => $this->input->post('cleaning',TRUE),
		'casefolding' => $this->input->post('casefolding',TRUE),
		'tokenizing' => $this->input->post('tokenizing',TRUE),
		'stemming' => $this->input->post('stemming',TRUE),
		'rekomendasi' => $this->input->post('rekomendasi',TRUE),
	    );

            $this->Pengujian_model->insert($data);
            $_SESSION['pesan'] = "Create Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('pengujian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pengujian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengujian/update_action'),
		'id' => set_value('id', $row->id),
		'teks' => set_value('teks', $row->teks),
		'cleaning' => set_value('cleaning', $row->cleaning),
		'casefolding' => set_value('casefolding', $row->casefolding),
		'tokenizing' => set_value('tokenizing', $row->tokenizing),
		'stemming' => set_value('stemming', $row->stemming),
		'rekomendasi' => set_value('rekomendasi', $row->rekomendasi),
	    );
            $this->load->view('header');
            $this->load->view('pengujian/pengujian_form', $data);
            $this->load->view('footer');
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('pengujian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'teks' => $this->input->post('teks',TRUE),
		'cleaning' => $this->input->post('cleaning',TRUE),
		'casefolding' => $this->input->post('casefolding',TRUE),
		'tokenizing' => $this->input->post('tokenizing',TRUE),
		'stemming' => $this->input->post('stemming',TRUE),
		'rekomendasi' => $this->input->post('rekomendasi',TRUE),
	    );

            $this->Pengujian_model->update($this->input->post('id', TRUE), $data);
            $_SESSION['pesan'] = "Update Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('pengujian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pengujian_model->get_by_id($id);

        if ($row) {
            $this->Pengujian_model->delete($id);
            $_SESSION['pesan'] = "Delete Record Success";
            $_SESSION['tipe'] = "success";
            redirect(site_url('pengujian'));
        } else {
            $_SESSION['pesan'] = "Record Not Found";
            $_SESSION['tipe'] = "error";
            redirect(site_url('pengujian'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('teks', 'teks', 'trim|required');
	$this->form_validation->set_rules('cleaning', 'cleaning', 'trim|required');
	$this->form_validation->set_rules('casefolding', 'casefolding', 'trim|required');
	$this->form_validation->set_rules('tokenizing', 'tokenizing', 'trim|required');
	$this->form_validation->set_rules('stemming', 'stemming', 'trim|required');
	$this->form_validation->set_rules('rekomendasi', 'rekomendasi', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pengujian.php */
/* Location: ./application/controllers/Pengujian.php */
/* Please DO NOT modify this information : */
/* Generated by Eko Kurniadi 2021-09-17 12:10:35 */
/* https://gocodings.web.com */
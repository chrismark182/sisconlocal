<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reportevisitantes extends CI_Controller {
    var $data = array();
	
	
	   public function __construct()
    {
        parent::__construct();
		if($this->session->userdata('logged_in')):
            $this->_init();
			$this->load->library('EsandexAccesos');  
			$this->data['session'] = $this->esandexaccesos->session();
            $this->data['accesos'] = $this->esandexaccesos->accesos();
            $empresa = $this->M_crud->read('empresa', array('EMPRES_N_ID' => $this->session->userdata('empresa_id')));
            $this->data['empresa']=$empresa[0];
            $this->load->library('pdfgenerator');  
			$this->load->library('excel');
		else:
			redirect(base_url(),'refresh');
		endif;
    }

    private function _init()
	{
		$this->output->set_template('siscon');
    }
	
	public function index() 
	{  
		//$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO");
		$idcliente =$this->input->post('cliente');
		/*
		if($idcliente=="")
		{
		$this->load->view('reportevisitantes/V_index', $this->data);	
		}
		else
		{
			$url = 'reportevisitantes?n=' . $idcliente; 
			redirect($url,'refresh');
		}
		*/
		
        $this->load->view('reportevisitantes/V_index', $this->data);
    }
	
	/*
	public function reporte(){
		
		 $sql = "EXEC MOVIMIENTO_PERSONA_REPORTE";
		 $query = $this->M_crud->sql($sql);
		 echo json_encode($query, true);
	}
	*/
	
}
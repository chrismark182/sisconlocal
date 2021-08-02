<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_sede extends CI_Controller {
    var $data = array();

    public function __construct()
    {
        parent::__construct();
		
		if($this->session->userdata('logged_in')):
			$this->load->library('EsandexAccesos');  
			$this->data['session'] = $this->esandexaccesos->session();
            $this->data['accesos'] = $this->esandexaccesos->accesos();
            $empresa = $this->M_crud->read('empresa', array('EMPRES_N_ID' => $this->session->userdata('empresa_id')));
            $this->data['empresa']=$empresa[0];
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
        $this->_init();  
        $sql= "Exec SEDE_LIS 0,0" ;
        $this->data['sedes'] = $this->M_crud->sql($sql);  
        $this->load->view('sede/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->_init();
        $this->load->view('sede/V_nuevo', $this->data);
    }
    public function editar($empresa,$sede)
    {  
        $this->_init();
        $sql = "Exec SEDE_LIS "     .$empresa. ","
                                    .$sede ;

        $sedes = $this->M_crud->sql($sql);
        $this->data['sede'] = $sedes[0];
        $this->load->view('sede/V_editar',$this->data);
    }
	public function crear()
	{

        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec SEDE_INS {$data['empresa']}, '{$data['descripcion']}', '{$data['direccion']}', '{$data['abreviatura']}', {$data['usuario']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
        
    }
    public function actualizar($empresa,$id)
    {
        if( trim($this->input->post('descripcion')) != '' &&
            trim($this->input->post('direccion')) != '' &&
            trim($this->input->post('abreviatura')) != ''):
        $sql = "Exec SEDE_UPD "  .$empresa. ","
                                .$id. ",'"
                                .$this->input->post('descripcion'). "','"
                                .$this->input->post('direccion')."','"
                                .$this->input->post('abreviatura')."',"
                                .$this->data['session']->USUARI_N_ID;
                                
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('sedes', 'refresh');  
    else:
       
        $this->session->set_flashdata('message','No puede guardar en vacio');
        header("Location: editar");


    endif;     
    }  
    public function eliminar($empresa, $id)
    {
       $sql = "Exec SEDE_DEL "   .$empresa.","
                                .$id.","
                                .$this->data['session']->USUARI_N_ID;
                                
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('sedes', 'refresh');       
    }  


}

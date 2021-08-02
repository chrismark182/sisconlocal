<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_visita extends CI_Controller {

	var $data = array();

	public function __construct()
    {
        parent::__construct();
		$this->_init();
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
		
		$empresa=$this->data['empresa']->EMPRES_N_ID;
		
		
        $sql = "Exec VISITA_LIS ".$empresa.",0";        
        $this->data['visitas'] = $this->M_crud->sql($sql); 
        $this->load->view('visita/V_index', $this->data);
        
	}
	public function nuevo(){
		
		$this->load->view('visita/V_nuevo',$this->data);
	
	}
	public function editar($empresa,$visita)
    {  

        $sql = "Exec VISITA_LIS "    .$empresa . ","
                                        .$visita ;
                                        
        
         
        $visitas = $this->M_crud->sql($sql);
        $this->data['visita'] = $visitas[0];
        $this->load->view('visita/V_editar',$this->data);
    }
    public function crear(){

        if(trim($this->input->post('descripcion')) != ''):
            
		$sql = "Exec VISITA_INS "     . $this->data['empresa']->EMPRES_N_ID . ",'"
										. $this->input->post('descripcion') . "',"
										. $this->data['session']->USUARI_N_ID ;

            
        $this->M_crud->sql($sql);
        redirect('visitas','refresh');   

        else:

        $this->session->set_flashdata('message','No puede guardar en vacio');
        header("Location: nuevo");
        endif;       
          
    }
    public function actualizar($empresa,$visita)
    {

        if(trim($this->input->post('descripcion')) != ''):

        $sql = "Exec VISITA_UPD "    . $empresa . ","
                                        . $visita . ",'" 
                                        . $this->input->post('descripcion'). "',"
										. $this->data['session']->USUARI_N_ID ;


        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('visitas', 'refresh'); 
        
        else:

            $this->session->set_flashdata('message','No puede guardar en vacio');
            header("Location: editar");
            //redirect('visita/'.$empresa.'/'.$visita.'/editar','refresh');
        endif;

    }  
    public function eliminar($empresa,$visita)
    {
        $sql = "Exec VISITA_DEL "     . $empresa .","
                                        . $visita.
                                        ","
										. $this->data['session']->USUARI_N_ID ; ;
            
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('visitas', 'refresh');       
    }  
}

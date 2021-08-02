<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_contacto extends CI_Controller {

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
        $sql = "Exec CONTACTO_LIS 0,0,0,'%','%','%','%'";        
        $this->data['contactos'] = $this->M_crud->sql($sql); 
        $this->load->view('contacto/V_index', $this->data);
    }

    public function buscar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec CONTACTO_LIS {$data['empresa']}, {$data['idcliente']}, {$data['contacto']}, '{$data['cliente']}', '{$data['ndocumento']}', '{$data['nombres']}', '{$data['apellidos']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

	public function nuevo(){
        $this->_init();
        
        $tipodocumento = "Exec TIPO_DOCUMENTO_PERSONAS_LIS";        
        $this->data['tdocumentos'] = $this->M_crud->sql($tipodocumento); 
        
        $empresa=$this->data['empresa']->EMPRES_N_ID;
        
        //$clientes = "Exec  CLIENTE_ESCLIENTE_LIS 1,'1'";
        
        $clientes = "Exec  CLIENTE_ESCLIENTE_LIS ".  $empresa.",'1'";
        $this->data['clientes'] = $this->M_crud->sql($clientes); 

		$this->load->view('contacto/V_nuevo',$this->data);
    }
    
	public function editar($empresa,$cliente,$contacto)
    {  
        $this->_init();
        $sql = "Exec CONTACTO_LIS "    .$empresa . ","
                                        .$cliente. ","
                                        .$contacto. ",'%','%','%','%'" ;
        
        $tipodocumento = "Exec TIPO_DOCUMENTO_PERSONAS_LIS";
        $this->data['tdocumentos'] = $this->M_crud->sql($tipodocumento); 

        $clientes = "Exec  CLIENTE_ESCLIENTE_LIS 1,'1'";
        $this->data['clientes'] = $this->M_crud->sql($clientes);

        $contactos = $this->M_crud->sql($sql);
        $this->data['contacto'] = $contactos[0];
        $this->load->view('contacto/V_editar',$this->data);
    }

    public function contactoValidar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec CONTACTO_VAL {$data['empresa']} ,{$data['tdocumento']},'{$data['ndocumento']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function crear(){
        if(
            trim($this->input->post('cliente')) != '' &&
            trim($this->input->post('tdocumento'))  != '' &&
            trim($this->input->post('ndocumento')) != '' &&
            trim($this->input->post('nombres')) != '' &&
            trim($this->input->post('apellidos')) != ''
         ):
                $sql = "Exec CONTACTO_INS "     . $this->data['empresa']->EMPRES_N_ID . ","
                                                . $this->input->post('cliente') . ","                                 
                                                . $this->input->post('tdocumento') . ",'" 
                                                . $this->input->post('ndocumento') . "','" 
                                                . $this->input->post('nombres') . "','" 
                                                . $this->input->post('apellidos') . "'," 
                                                . $this->data['session']->USUARI_N_ID ;
                
                                                $this->M_crud->sql($sql);
                                                $url = 'contactos?nu=' . $this->input->post('ndocumento'); 
                                                redirect($url,'refresh');
         else:
            $this->session->set_flashdata('message','No puede guardar en vacio ');
            header("Location: nuevo");
        endif;
    }

    public function actualizar($empresa,$cliente,$contacto)
    {
        if(
            trim($this->input->post('ndocumento')) != '' &&
            trim($this->input->post('nombres')) != '' &&
            trim($this->input->post('apellidos')) != ''
        ):
            $sql = "Exec CONTACTO_UPD "     . $empresa . ","
                                            . $cliente   . ","
                                            . $contacto . ",'"
                                            .$this->input->post('ndocumento') . "','" 
                                            .$this->input->post('nombres') . "','" 
                                            .$this->input->post('apellidos') . "'," 
                                        . $this->data['session']->USUARI_N_ID ;
                                            
            $this->M_crud->sql($sql);      
            $this->session->set_flashdata('message','Datos actualizados correctamente');
            $url = 'contactos?nu=' . $this->input->post('ndocumento');
            redirect($url, 'refresh');
        else:

            $this->session->set_flashdata('message','No puede guardar en vacio');
            header("Location: editar");
            //redirect('visita/'.$empresa.'/'.$visita.'/editar','refresh');
        endif;
    }  

    public function eliminar($empresa,$cliente,$contacto)
    {
        $sql = "Exec CONTACTO_DEL "     . $empresa .","
                                        . $cliente. ","
                                        . $contacto. ","
                                        . $this->data['session']->USUARI_N_ID ;                                       
            
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('contactos', 'refresh');       
    }  
}

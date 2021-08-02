<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_menu extends CI_Controller {
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
			//$empresa=$this->data['empresa']->EMPRES_N_ID;
			//$this->data['empresas'] = $this->M_crud->sql("EXEC EMPRESA_LIS 0");
			
			//$empresas = $this->M_crud->sql('Exec EMPRESA_LIS 0');
			//$this->data['empresas'] = $empresas;
			
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
		//$empresas = $this->M_crud->sql('Exec EMPRESA_LIS 0');
		//$this->data['empresas'] = $empresas;
		//$empresa=$this->data['empresa']->EMPRES_N_ID;
		//$this->data['empresas'] = $this->M_crud->sql("EXEC EMPRESA_LIS 0");
		//$this->data['empresas'] = $this->M_crud->sql("EXEC EMPRESA_LIS "  . $empresa);
        $sql = "Exec MENU_LIS 0, 0";
        $this->data['menus'] = $this->M_crud->sql($sql);  
        $this->load->view('menu/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->data['menus_padre'] = $this->M_crud->read('menu', array('MENU_PADRE_ID' => 0, 'MENU_ESTADO' => 1));  
        $this->load->view('menu/V_nuevo', $this->data);
    }
    public function editar($id)
    {  
        $this->data['menus_padre'] = $this->M_crud->sql("Exec MENU_LIS 0, 0");  
        $sql = "Exec MENU_LIS 0, {$id}";
        $menus = $this->M_crud->sql($sql);
        $this->data['menu'] = $menus[0];
        $this->load->view('menu/V_editar',$this->data);
    }
    public function crear()
    {
        $sql = "Exec MENU_INS '".$this->input->post('descripcion')."', '".$this->input->post('ruta')."', ".$this->input->post('mpadre').", ".$this->data['session']->USUARI_N_ID."";
        $this->M_crud->sql($sql);
		redirect('menus','refresh');   
    }
    public function actualizar($id)
    {
        $sql = "Exec MENU_UPD {$id}, '{$this->input->post('descripcion')}', '{$this->input->post('ruta')}', {$this->input->post('mpadre')}, 
                        {$this->data['session']->USUARI_N_ID}";
        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('menus', 'refresh');       
    }  
    public function eliminar($id)
    {
       $sql = "Exec MENU_DEL " .$id;       

        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('menus', 'refresh');       
    }  



}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_usuario extends CI_Controller {

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
		//Variables de pagina
		$sql = "EXEC USUARIO_LIS ".$this->session->empresa_id.", 0, '', ''";
		$this->data['results'] = $this->M_crud->sql($sql);
		//Carga de vistas
		$this->load->view('usuario/V_index', $this->data);
	}
	public function nuevo()
	{
		$empresa=$this->data['empresa']->EMPRES_N_ID;
		//$this->data['empresas'] = $this->M_crud->sql("EXEC EMPRESA_LIS 0");
		$this->data['empresas'] = $this->M_crud->sql("EXEC EMPRESA_LIS "  . $empresa);

		$sql =  "EXEC CATEGORIA_LIS 0";
		$this->data['categorias'] = $this->M_crud->sql($sql);
		//Carga de vistas
		$this->load->view('usuario/V_nuevo', $this->data);
	}
	public function edit($id){
		//Variables de pagina
		$sql = "EXEC USUARIO_LIS 0, $id, '', ''";
        $usuario = $this->M_crud->sql($sql);
		$this->data['usuario'] = $usuario[0];   

		$sql =  "EXEC CATEGORIA_LIS 0";
		$this->data['categorias'] = $this->M_crud->sql($sql);
		//Carga de vistas		
		$this->load->view('usuario/V_editar', $this->data);		
	}
	public function ver($id){
		//Variables de pagina
        $usuario = $this->M_crud->sql("EXEC Usuario_Lis 'L',$id, '%', '%', '%'");
        $this->data['usuario'] = $usuario[0];
        $this->data['u_menus'] = $this->M_crud->sql("EXEC Usuario_Menu_Lis 'L', $id");
        $this->data['u_menus_faltantes'] = $this->M_crud->sql("EXEC Usuario_Menu_Lis 'F', $id");
		//Carga de vistas
		$this->load->view('master_top', $this->data);
		$this->load->view('usuario/V_ver');
		$this->load->view('master_bottom');	
	}
	public function delete($id){
		$this->M_crud->sql("EXEC Usuario_Del	$id,
												'{$this->session->userdata('id')}',
												'{$_SERVER['REMOTE_ADDR']}'
								        ");	       
        $this->session->set_flashdata('message', 'Usuario eliminado correctamente');    
    	redirect('usuarios', 'refresh');
	}
	public function crear()
	{
		//Validación
		if($this->input->post('username') != '')
		{
			//$existe = $this->M_crud->sql("EXEC USUARIO_LIS 0, 0, '{$this->input->post('username')}',''");
			
			$existe = $this->M_crud->sql("EXEC USUARIO_LIS '{$this->input->post('empresa')}', 0, '{$this->input->post('username')}',''");
			
			
			if (!$existe) {
				$pass = md5(1234);
				
				$this->M_crud->sql("EXEC USUARIO_INS 	'{$this->input->post('username')}',
														'{$pass}',
														{$this->input->post('categoria')},
														{$this->input->post('empresa')},
														{$this->session->userdata('id')},
														'{$this->input->post('firstname')}',
														'{$this->input->post('lastname')}'
													");	       
				$this->session->set_flashdata('message', 'Usuario creado correctamente');    
				redirect('usuarios', 'refresh');
			}else{
				$this->session->set_flashdata('message', 'El nombre de usuario ya se encuentra uso');    
				redirect('usuario/nuevo', 'refresh');        	
			}
		}else{
			$this->session->set_flashdata('message', 'No se puede registrar un nombre de usuario vacio');    
			redirect('usuario/nuevo', 'refresh'); 
		}
	}
	public function update($id)
	{
		$sql = "EXEC USUARIO_UPD 	$id,
									'{$this->input->post('username')}',
									{$this->input->post('categoria')},
									{$this->session->userdata('id')},
									'{$this->input->post('firstname')}',
									'{$this->input->post('lastname')}'
							";
		$this->M_crud->sql($sql);	    	   
		$this->session->set_flashdata('message', 'Usuario actualizado correctamente'); 
    	//$pagina_anterior=$_SERVER['HTTP_REFERER'];  
    	redirect('usuarios', 'refresh');    
	}
	public function add_menu(){
		$this->M_crud->sql("EXEC Usuario_Menu_Ins	{$_POST['usuario_id']},
												{$_POST['menu_id']},
												{$_POST['permiso']},
												{$this->usuario[0]->USUARI_ID},
								        		'{$_SERVER['REMOTE_ADDR']}'
								        ");	 
		echo "Menú agregado correctamente";
	}
	public function update_menu(){
		$this->M_crud->sql("EXEC Usuario_Menu_Upd	{$_POST['usuario_id']},
													{$_POST['menu_id']},
													{$_POST['permiso']},
													{$this->usuario[0]->USUARI_ID},
								        			'{$_SERVER['REMOTE_ADDR']}'
								        ");	 
	}

	public function eliminar($id)
    {
	   $sql = "Exec USUARIO_DEL {$id}";        
	   
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('usuarios', 'refresh');       
	}
	
    public function cambio_pass(){
		$this->load->view('usuario/V_cambio_pass', $this->data);
	}
	public function cambio_pass_usuario($id)
	{
		$this->data['user_id'] = $id;
		$this->load->view('usuario/V_cambio_pass_usuario', $this->data);
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends CI_Controller {

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
		$listadosector = $this->M_crud->sql("Exec EMPRESA_LIS 0");
		$this->data['listadosector'] = $listadosector;
		
		
		//agregado
		$usuario= $this->data['session']->USUARI_N_ID;
		$username= $this->data['session']->USUARI_C_USERNAME;
		
		$categoria= $this->data['session']->CATEGO_N_ID;//Proxima actualizacion
		
		
		/* 	if($usuario==1){
		$this->load->view('V_dashboard', $this->data);
		} */
		
		//SERVIDOR
		//username == "MDiaz"  // "ACuglievan" // Bigote Puerta1(Sflores,JCuzcamayta,JCorozco) // Puerta 3 (JDhernandez,JCchavez) //Puerta 4 (Nhernandez,Wmaldonado)  // Puerta 5 (Jvolcan,Rruiz) //  Aqp Lurin (Mmartinez,Jmendoza)  // AQP CALLAO (Ccapcha,Avalencia,Jburgos)
		
		//BIGOTE usurio= 12,13,14,15 // AQP LURIN usuario= 18  // aqp callao usuario =25  			
		//if($username == "Sflores" || $username == "JCuzcamayta" || $username == "JCorozco" || $username == "JDhernandez" || $username == "JCchavez" || $username == "Nhernandez" || $username == "Wmaldonado" || $username == "Jvolcan" || $username == "Rruiz" || $username == "Mmartinez" ||$username == "Jmendoza" || $username == "Ccapcha" || $username == "Avalencia" || $username == "Jburgos" || $username == "MDiaz" ||   $username == "ACuglievan" ||   $username == "Jmartinez" ||   $username == "Pdiaz" ||   $username == "Apecho" || $username == "Coliver"  || $username == "Lnavarro" || $username == "LCecchi") 
			
		
		//|| $username == "MDiaz" ||   $username == "ACuglievan" ||   $username == "Jmartinez" ||   $username == "Pdiaz" ||   $username == "Apecho" || $username == "Coliver"  || $username == "Lnavarro" || $username == "LCecchi"
		if( $categoria == 3 || $categoria == 5   || $categoria == 7  ||   $username == "ACuglievan" || $username == "Lnavarro" || $username == "LCecchi")			
		//if($usuario == 7 || $usuario == 8 || $usuario == 12 || $usuario == 13 || $usuario == 14 || $usuario == 15 or $usuario == 18 or $usuario == 22 or $usuario == 23 or $usuario==25 ) 
			
		//LOCAL
		//if($usuario == 7 || $usuario == 8 || $usuario == 12 || $usuario == 13 || $usuario == 14 || $usuario == 15 or $usuario == 18 or $usuario == 21 or $usuario == 22 or $usuario==24 ) 
		{
			redirect('ingreso', 'refresh');   
			//$this->load->view('V_dashboard', $this->data);
		}
		//else if($usuario == 18)
		//{
		//	$this->load->view('V_dashboard', $this->data);
		//}
		else{
			$this->load->view('V_dashboard', $this->data);
		}
	}
		
}

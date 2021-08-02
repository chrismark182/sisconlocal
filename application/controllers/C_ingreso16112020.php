<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ingreso extends CI_Controller {
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
		else:
			redirect(base_url(),'refresh');
		endif;
    }

    private function _init()
	{
		$this->output->set_template('siscon');
    }
    
    //Vistas
    public function index() 
	{   $this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO");
        $this->load->view('ingreso/V_index', $this->data);
    }

    public function nuevo()
    {
		$this->data['misdoc'] = $this->M_crud->sql("Exec TIPO_DOCUMENTO_PERSONAS_LIS");
		$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO");
		$this->data['tipo_unidad'] = $this->M_crud->sql("SELECT * FROM TIPO_UNIDAD WHERE TIPUNI_ESTADO='0'");
		$this->data['motivo_visita'] = $this->M_crud->sql("SELECT * FROM MOTIVO_VISITA WHERE MOTVIS_C_ESTADO = '1'");
		$this->data['clientes'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'1'");
		$this->data['persona_contacto'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'1'");
        $this->load->view('ingreso/V_nuevo', $this->data);        
    }

    //Procesos
    public function buscar()
    {
	    $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec ALQUILER_LIS {$data['empresa']}, {$data['acuerdo']}, '{$data['cliente']}', '{$data['sede']}', '{$data['fecha_desde']}', '{$data['fecha_hasta']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function editar($empresa,$cliente)
    {  
        $sql = "Exec CLIENTE_LIS2 "  .$empresa. ","
                                    .$cliente ;
        
        $this->data['tdocumentos'] = $this->M_crud->read('tipo_documento', array());
        $clientes = $this->M_crud->sql($sql);
        $this->data['cliente'] = $clientes[0];
       
        $this->load->view('cliente/V_editar',$this->data);
    }

    public function crear()
    {
        $facturable = '0';
        if($this->input->post('facturable') == 'on'):
            $facturable = '1';
        endif;
        $sql = "Exec ALQUILER_INS   {$this->data['empresa']->EMPRES_N_ID}, 
                                    {$this->input->post('sede')}, 
                                    {$this->input->post('ubicacion')},
                                    {$this->input->post('cliente')}, 
                                    '{$facturable}',
                                    '{$this->input->post('fecha_inicio')}', 
                                    '{$this->input->post('fecha_termino')}', 
                                    {$this->input->post('area')}, 
                                    '{$this->input->post('observaciones')}', 
                                    {$this->input->post('moneda')}, 
                                    {$this->input->post('precio')}, 
                                    {$this->data['session']->USUARI_N_ID}";
        $id = $this->M_crud->sql($sql);
        $url = 'acuerdos?aca=' . $id[0]->ALQUIL_N_ID; 
        redirect($url,'refresh');   
    }


	public function crearC()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		
		
		/*sql = "Exec PERSONA_INS "      . $this->data['empresa']->EMPRES_N_ID . ","
										. $this->input->post('cliente_') . "," 
										. $this->input->post('tdocumento_') . ",'" 
										. $this->input->post('ndocumento_') . "','" 
										. $this->input->post('nombres') . "','" 
										. $this->input->post('apellidos') . "','" 
										. $this->input->post('foto') . "','" 
										. $this->input->post('scrt_ini') . "','" 
										. $this->input->post('scrt_fin') . "'," 
										. $this->data['session']->USUARI_N_ID ;
		*/
		$sql = "Exec PERSONA_INS "      . $this->data['empresa']->EMPRES_N_ID . ","
										. $data['cliente_'] . "," 
										. $data['tdocumento_'] . ",'" 
										. $data['ndocumento_'] . "','" 
										. $data['nombres'] . "','" 
										. $data['apellidos'] . "','" 
										. $data['foto'] . "','" 
										. $data['scrt_ini'] . "','" 
										. $data['scrt_fin'] . "'," 
										. $this->data['session']->USUARI_N_ID ;
		
			//$this->M_crud->sql($sql);
		
									$query = $this->M_crud->sql($sql);
									echo json_encode($query, true);
		//echo "complete";	
										//$url = 'personas?n=' . $this->input->post('ndocumento'); 
										//redirect($url,'refresh');
										
										
										
										
		/*						
	    $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec LIQUIDACION_INS_SERVICIOS_DETALLE {$data['empresa']}, {$data['liquidacion']}, {$data['orden']}, {$data['usuario']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
		*/
	}



    public function actualizar($empresa,$cliente)
    {
        $sql = "Exec CLIENTE_UPD "      . $empresa. ","
                                        . $cliente. ",'" 
                                        . $this->input->post('t_documento')."','"
                                        . $this->input->post('ndocumento') . "','" 
                                        . $this->input->post('razon_social') ."','"
                                        . $this->input->post('direccion')."','"
                                        . $esclient . "','"
                                        . $esproveedor . "','"
                                        . $estransportista . "','"
                                        . $ordencompra . "',"
                                        .$this->data['session']->USUARI_N_ID ; 
        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        $url = 'clientes?n=' . $this->input->post('ndocumento');
        redirect($url, 'refresh');     
    }

    public function eliminar($empresa,$acuerdo)
    {
        $sql = "Exec ALQUILER_DEL "     . $empresa .","
                                        . $acuerdo; 
                                      /*   .","
                                        .$this->data['session']->USUARI_N_ID ;  */
                                        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('acuerdos', 'refresh');       
    }  

    public function eliminar_periodo($empresa,$acuerdo, $periodo)
    {
        $sql = "Exec ALQUILER_DETALLE_DEL {$empresa}, {$acuerdo}, {$periodo}, {$this->data['session']->USUARI_N_ID}";                                         
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('acuerdos', 'refresh');       
    }  

    public function cerrar($empresa,$acuerdo)
    {
        $sql = "Exec ALQUILER_CERRAR "  . $empresa .","
                                        . $acuerdo .","
                                        .$this->data['session']->USUARI_N_ID ;  
                                        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Acuerdo cerrado correctamente');
        $url = 'acuerdos?aca=' . $acuerdo;
        redirect($url, 'refresh');       
    }  

    public function reporte($id)
    {
        $sql= "Exec MOVIMIENTO_PERSONA_LIS_REPORTE {$this->session->userdata('empresa_id')},{$id}";
        $result = $this->M_crud->sql($sql);
        ob_start();        
        require_once(APPPATH.'views/ingreso/reporte/index.php');
        $html = ob_get_clean();
        $this->pdfgenerator->generate($html, "reporte.pdf");
	}




	public function delete($id)
	{
		$sql = "Exec MOVIMIENTO_PERSONA_DEL  {$this->session->userdata('empresa_id')}, {$id}, {$this->data['session']->USUARI_N_ID} ";        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('ingreso', 'refresh');  
	}

	public function confirmar_ingreso($id){
		$sql = "Exec MOVIMIENTO_PERSONA_UPD {$this->session->userdata('empresa_id')}, {$id},'1' ,{$this->data['session']->USUARI_N_ID}";        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Se ha confirmado el ingreso correctamente');
        redirect('ingreso', 'refresh');
	}

	public function confirmar_salida($id){
		$sql = "Exec MOVIMIENTO_PERSONA_UPD {$this->session->userdata('empresa_id')}, {$id},'2' ,{$this->data['session']->USUARI_N_ID}";        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Se ha confirmado la salida correctamente');
        redirect('ingreso', 'refresh');
	}






}


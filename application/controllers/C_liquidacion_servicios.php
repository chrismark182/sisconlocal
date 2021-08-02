<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_liquidacion_servicios extends CI_Controller {
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
	{         
        $this->_init();

        $clientes = "Exec  CLIENTE_ESCLIENTE_LIS 1,'1'";
        $this->data['clientes'] =$this->M_crud->sql($clientes);
        
        $sedes = 'Exec SEDE_LIS 0,0';
        $this->data['sedes'] = $this->M_crud->sql($sedes);

        $this->load->view('liquidacion/servicios/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->_init();
        $this->data['sedes'] = $this->M_crud->read('sede','SEDE_C_ESTADO = 1', array());
        $this->data['clientes'] = $this->M_crud->read('cliente','CLIENT_C_ESCLIENTE = 1 and CLIENT_C_ESTADO = 1', array());
        $this->data['servicios'] = $this->M_crud->read('servicio','SERVIC_C_REQUIERE_OS = 1 AND SERVIC_C_ESTADO = 1', array());
        $this->data['monedas'] = $this->M_crud->read('moneda', array());

        $this->load->view('liquidacion/servicios/V_nuevo', $this->data);        
    }
    
    //Reporte 
    public function reporte($id)
    {
        $sql= "Exec LIQUIDACION_LIS_REPORTE_SERVICIOS {$this->session->userdata('empresa_id')},{$id}";
        $result = $this->M_crud->sql($sql);
        $sql= "Exec LIQUIDACION_LIS_REPORTE_SERVICIOS_RESUMEN {$this->session->userdata('empresa_id')},{$id}";
        $result2 = $this->M_crud->sql($sql);
        ob_start();        
        require_once(APPPATH.'views/liquidacion/servicios/reporte/index.php');
        $html = ob_get_clean();
        $this->pdfgenerator->generate($html, "reporte.pdf");
    }
    
    //Procesos
    public function buscar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec LIQUIDACION_LIS_SERVICIOS {$data['empresa']}, '{$data['desde']}', '{$data['hasta']}', {$data['cliente']}, {$data['sede']}, '{$data['orden_compra']}', '{$data['liquidacion']}', '{$data['situacion']}', '{$data['tipo']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function nuevo_buscar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec LIQUIDACION_LIS_NUEVO_SERVICIOS {$data['empresa']}, '{$data['cliente']}', '{$data['sede']}', '{$data['moneda']}', '{$data['desde']}', '{$data['hasta']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }
    public function grabar_cabecera()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec LIQUIDACION_INS {$data['empresa']}, {$data['cliente']}, {$data['sede']}, 'S', {$data['situacion']}, {$data['usuario']},'','',{$data['ordenservicio']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function grabar_detalle()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec LIQUIDACION_INS_SERVICIOS_DETALLE {$data['empresa']}, {$data['liquidacion']}, {$data['orden']}, {$data['usuario']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function editar($empresa,$id)
    {  
        $sql = "Exec ORDEN_SERVICIO_LIS "    .$empresa . ","
                                            .$id;
         
        $ordenes = $this->M_crud->sql($sql);
        $this->data['ordenes'] = $ordenes[0];
        $this->load->view('ordenservicio/V_editar',$this->data);
    }
    public function crear()
    {
        if( trim($this->input->post('sede')) != ''&&
            trim($this->input->post('cliente')) != ''&&
            trim($this->input->post('servicio')) != ''&&
            trim($this->input->post('horas')) != ''&&
            trim($this->input->post('tarifa')) != ''):

            $sql = "Exec ORDEN_SERVICIO_INS " . $this->data['empresa']->EMPRES_N_ID . ","
                                            . $this->input->post('sede') . "," 
                                            . $this->input->post('cliente') . "," 
                                            . $this->input->post('servicio') . ",'" 
                                            . $this->input->post('numerofisico') . "','" 
                                            . $this->input->post('solicitante') . "','" 
                                            . $this->input->post('codproyecto') . "'," 
                                            . $this->input->post('horas') . "," 
                                            . $this->input->post('tarifa') . "," 
                                            . $this->input->post('moneda') . "," 
                                            . $this->input->post('preciounitario') . "," 
                                            . $this->data['session']->USUARI_N_ID;
                                        

            $this->M_crud->sql($sql);
            redirect('ordenes','refresh');   
        else:
            $this->session->set_flashdata('message','No puede guardar en vacio ');
            header("Location: nuevo");
        endif;
    }
    public function actualizar($empresa,$id)
    {

        if( trim($this->input->post('descripcion')) != ''&&
            trim($this->input->post('metro')) != '' ):

        $sql = "Exec UBICACION_UPD "    . $empresa . ","
                                        . $sede . "," 
                                        . $id . ",'"  
                                        . $this->input->post('descripcion') . "'," 
                                        . $this->input->post('metro').","
                                        . $this->data['session']->USUARI_N_ID; 
            
                    
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('ordenes', 'refresh'); 
        
    else:
        $this->session->set_flashdata('message','No puede guardar en vacio ');
        header("Location: editar");    

    endif;
    }  
    public function eliminar($empresa,$id)
    {
        $sql = "Exec LIQUIDACION_DEL_SERVICIOS "    . $empresa .","
                                        . $id.","
                                        . $this->data['session']->USUARI_N_ID; 
            
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('liq_servicios', 'refresh');       
    }  
    public function updateoc()
    {
        $sql = "Exec LIQUIDACION_UPD_OC {$this->input->post('ocempresa')}, {$this->input->post('ocliquidacion')}, '{$this->input->post('orden_compra')}', {$this->data['session']->USUARI_N_ID}"; 
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Orden de Compra actualizada correctamente');
        redirect('liq_servicios', 'refresh');       
    }  
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_api extends CI_Controller {

	var $data = array();

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in')):
            $this->load->model('M_crud');
			/*Agregado*/
			$this->load->library('EsandexAccesos');  
			$this->data['session'] = $this->esandexaccesos->session();
            $this->data['accesos'] = $this->esandexaccesos->accesos();
			/*fin agregado*/
            $empresa = $this->M_crud->read('empresa', array('EMPRES_N_ID' => $this->session->userdata('empresa_id')));
            $this->data['empresa']=$empresa[0];           
		else:
			redirect(base_url(),'refresh');
		endif;
    }
    
    public function tarifa($empresa, $sede, $cliente, $servicio)
    {
        $sql = "Exec TARIFARIO_LIS_ORDEN_SERVICO "  .$empresa . ","
                                                    .$sede . ","
                                                    .$cliente . ","
                                                    .$servicio;
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function ordenservicio()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "Exec ORDEN_SERVICIO_LIS_BUSQUEDA {$data['empresa']},'{$data['desde']}','{$data['hasta']}',{$data['numero']}, {$data['sede']}, {$data['cliente']},{$data['servicio']},'{$data['solicitante']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function ubicacion()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "Exec UBICACION_LIS {$data['empresa']},{$data['sede']}, {$data['ubicacion']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function tarifaValidar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec TARIFARIO_VALIDAR {$data['empresa']}, {$data['sede']},{$data['cliente']},{$data['servicio']},{$data['moneda']}";
        $query = $this->M_crud->sql($sql);
        $respons = array($sql, $query);
        echo json_encode($query, true);
    }

    public function clienteValidar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec CLIENTE_VAL {$data['empresa']} ,{$data['tdocumento']},'{$data['ndocumento']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function personaValidar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec PERSONA_VAL {$data['empresa']} ,{$data['tdocumento']},'{$data['ndocumento']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }
    
    public function acuerdos_periodos()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec ALQUILER_DETALLE_LIS {$data['empresa']}, {$data['acuerdo']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function acuerdos_periodos_guardar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec ALQUILER_DETALLE_INS {$data['empresa']}, {$data['acuerdo']}, {$data['area']}, {$data['precio']}, {$data['usuario']},{$data['descuento']},{$data['descuentoselect']},'{$data['observacion']}'"; 
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function tarifas()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "Exec TARIFARIO_BUS {$data['empresa']},{$data['numero']}, {$data['sede']}, {$data['cliente']},{$data['servicio']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function validartipocambio()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "Exec TIPO_CAMBIO_VAL {$data['empresa']},'{$data['fecha']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }
    public function execsp()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = '';
        $count = 0;
        foreach ($data as $key => $value) {
            if($count > 1):
                $sql = $sql . ", ";
            endif; 
            if($key == 'sp'):
                $sql = "Exec {$value} ";
            elseif(gettype($value) == 'string'):
                $val = "'{$value}'";
                $sql = $sql . $val;
            else: 
                $sql = $sql . $value;
            endif;
            $count++;
        }
        //echo $sql;
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function listar_tipo_cambio()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "Exec TIPO_CAMBIO_LIS_FECHA {$data['empresa']},'{$data['desde']}','{$data['hasta']}',0";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }
    public function uploadfile()
    {
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $file_name = time().'.'.$ext;
        $file_tmp =$_FILES['file']['tmp_name'];
        move_uploaded_file($file_tmp,__DIR__."/../../uploads/".$file_name);
        echo $file_name;
    }


	public function crearC()
	{
	
		$data = json_decode(file_get_contents('php://input'), true);
        
        if(isset($data['idcheckboxsctr']))
        {
            $idcheckboxsctr=$data['idcheckboxsctr'];
        
        }
        else
        {
           $idcheckboxsctr=0;
        }
    
        
        
        
        
        //$idcheckboxsctr=$data['idcheckboxsctr'];
        
        //if($idcheckboxsctr==0 or $idcheckboxsctr=="")
        //{
        //$idcheckboxsctr=0;
        //}
        
		$sql = "Exec PERSONA_INS "      . $this->data['empresa']->EMPRES_N_ID . ","
										. $data['cliente_'] . "," 
										. $data['tdocumento_'] . ",'" 
										. $data['ndocumento_'] . "','" 
										. $data['nombres'] . "','" 
										. $data['apellidos'] . "','" 
										. $data['foto'] . "','" 
										. $data['scrt_ini'] . "','" 
										. $data['scrt_fin'] . "'," 
										. $this->data['session']->USUARI_N_ID."," 
										. $idcheckboxsctr ;
	
		
		$query = $this->M_crud->sql($sql);
		echo json_encode($query, true);
	}
	
}

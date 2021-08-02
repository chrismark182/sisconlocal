<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_importaralquileres extends CI_Controller {
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
			
			/*
			$empresa=$this->data['empresa']->EMPRES_N_ID;
			$empresas = $this->M_crud->sql("Exec EMPRESA_LIS 1");
			$this->data['empresas'] = $empresas;
			*/
			
			
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
    
    //Vistas
    public function index() 
	{   
		//$empresa=$this->data['empresa']->EMPRES_N_ID;
		//$empresas = $this->M_crud->sql("Exec EMPRESA_LIS ".$empresa);
		//$this->data['empresas'] = $empresas;
		//$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO");
        $this->load->view('importaralquileres/V_index', $this->data);
    }
	
	
	
	function import()
	{
		//condicion fecha
		//setlocale(LC_TIME, "spanish");
		setlocale(LC_ALL,"es_ES");

		//echo 'Data Imported successfully 2';
		
		if(isset($_FILES["file"]["name"]))
		{
		//echo 'Data Imported successfully 1';
		
		$path = $_FILES["file"]["tmp_name"];
		
		$object = PHPExcel_IOFactory::load($path);
		
		$anio="2020"; 
		
		$this->db->simple_query("TRUNCATE TABLE ALQUILER_TMP");
		
		foreach($object->getWorksheetIterator() as $worksheet)
		{	
		
		$highestRow = $worksheet->getHighestRow();
		$highestColumn = $worksheet->getHighestColumn();
		for($row=5; $row<=$highestRow; $row++)
		{
			
		//$cliente = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
	
		
		$sede = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
		$ubicacion = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
		$cliente = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
		$facturable = 1;
		$fecha_mes = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
		
		
		switch ($fecha_mes) {
			case "ENERO":
			$fecha_inicio = "01/01/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;
			case "FEBRERO":
			$fecha_inicio = "01/02/".$anio;
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;
			case "MARZO":
			$fecha_inicio = "01/03/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;	
			case "ABRIL":
			$fecha_inicio = "01/04/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio);  
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;			
			case "MAYO":
			$fecha_inicio = "01/05/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;			
			case "JUNIO":
			$fecha_inicio = "01/06/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;			
			case "JULIO":
			$fecha_inicio = "01/07/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;			
			case "AGOSTO":
			$fecha_inicio = "01/08/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;			
			case "SEPTIEMBRE":
			$fecha_inicio = "01/09/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;			
			case "OCTUBRE":
			$fecha_inicio = "01/10/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;
			case "NOVIEMBRE":
			$fecha_inicio = "01/11/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;
			case "DICIEMBRE":
			$fecha_inicio = "01/12/".$anio;
			//$fecha_conver = new DateTime($fecha_inicio); 
			$fecha_conver = DateTime::createFromFormat('d/m/Y', $fecha_inicio);
			$fecha_fin = $fecha_conver->format( 't/m/Y' );
			break;
			//default:
			//$fecha_inicio = "Your favorite color is neither red, blue, nor green!";
		}
		
		/*
		if($fecha_mes="Enero"){
			$fecha_inicio="01";
		}
		*/
		//
		//$fecha_actual=date('B');
		//$fecha_actual=strftime("%B");
		//
		
		$fecha_final="";
		$area=strval($worksheet->getCellByColumnAndRow(4, $row)->getValue());
		if($area!=0)
		{
		$area=str_replace(',','.',$area);	
		}
		$observacion=$worksheet->getCellByColumnAndRow(12, $row)->getValue();
		$garantia=0;
		$adjunto="";
		$moneda=$worksheet->getCellByColumnAndRow(6, $row)->getValue();
		$costo=$worksheet->getCellByColumnAndRow(5, $row)->getValue();
		
		//$precio_unit=$worksheet->getCellByColumnAndRow(7, $row)->getValue();
		$precio_unit= floatval($area) * floatval($costo);
		if($precio_unit!=0)
		{
		$precio_unit=str_replace(',','.',$precio_unit);	
		}
		
		
		
		
		switch ($moneda) {
			case "S/":
			$moneda_id = "1";
			break;
			case "$":
			$moneda_id = "2";
			break;
		}
		
		
		//$precio_unit="";
		$id_usuario=$this->data['session']->USUARI_N_ID;
		$importestado="1";
		//$fecha_actual=date("B", strtotime($fecha_actual));
		
		/*
		   $sql = "Exec ALQUILER_INS_EXCEL   {$this->data['empresa']->EMPRES_N_ID}, 
											 '{$sede}', 
											 '{$ubicacion}',
											 '{$cliente}', 
											 {$facturable},
											 '{$fecha_inicio}', 
											 '{$fecha_fin}', 
											 {$area}, 
											 '{$observacion}', 
											 '{$garantia}', 
											 '{$adjunto}', 
											 '{$moneda_id}', 
											 '{$precio_unit}', 
											 {$id_usuario}, 
											 {$importestado}";
											 
			*/

			//$sql2="truncate table alquiler_tmp";
						
			//$this->M_crud->sql($sql2);


			

			$sql = "Exec ALQUILER_INS_EXCEL   {$this->data['empresa']->EMPRES_N_ID},
											  '{$sede}', 
											  '{$ubicacion}',
											  '{$cliente}', 
											   {$facturable},
											 '{$fecha_inicio}', 
											 '{$fecha_fin}', 
											 {$area}, 
											 '{$observacion}',
											 {$garantia}, 
											 '{$adjunto}', 
											 '{$moneda_id}', 
											 {$precio_unit}, 
											  {$id_usuario}, 											 
											  {$importestado}";
			
											 
											 
		
			$this->M_crud->sql($sql);
		
		//$sql = "Exec ALQUILER_INS_EXCEL {$this->data['empresa']->EMPRES_N_ID}, {$importestado}";
        
		//$id = $this->M_crud->sql($sql);
		/*
		$data[] = array(
		'Empresa'  => $this->data['empresa']->EMPRES_N_ID,
		'Sede'  => $sede,
		'Ubicacion'  => $ubicacion,
		'Cliente'  => $cliente,
		'Facturable'  => $facturable,
		'Fecha_inicio'  => $fecha_inicio,
		'Fecha_final'  => $fecha_fin,
		'Area'  => $area,
		'Observaciones'  => $observacion,
		'Garantia'  => $garantia,
		'Adjunto'  => $adjunto,
		'Moneda'  => $moneda_id,
		'PrecioUnit'  => $precio_unit,
		'IdUsuario'  => $id_usuario
		);
		*/
		
		
		//echo  "{$this->data['empresa']->EMPRES_N_ID}"."/"."{$sede}";
		/*
		$customer_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
		$address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
		$city = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
		$postal_code = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
		$country = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
		$data[] = array(
		'CustomerName'  => $customer_name,
		'Address'   => $address,
		'City'    => $city,
		'PostalCode'  => $postal_code,
		'Country'   => $country
		);*/
		}
		}
		
		//print_r($data);
		//$this->db->insert_batch('CLIENTE_TMP', $data);
		
		//$this->excel_import_model->insert($data);
		//echo "Data Imported successfully";
		//echo $this->data['empresa']->EMPRES_N_ID ;
		//echo  "{$this->data['empresa']->EMPRES_N_ID}"."/"."";
		} 
	}	
}


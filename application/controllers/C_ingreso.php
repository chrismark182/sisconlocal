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
			$categoria = $this->M_crud->read('usuario', array('USUARI_N_ID' => $this->data['session']->USUARI_N_ID));
            $this->data['categoria']=$categoria[0];
			//echo $empresa[0];
			//$categoria = $this->M_crud->read('categoria', array('USUARI_N_ID' => $this->data['session']->USUARI_N_ID));
            //$this->data['categoria']=$categoria[0];
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
		//OBTENER EMPRESA
		$empresa=$this->data['empresa']->EMPRES_N_ID;
		//OBTENER USUSARIO
		$username= $this->data['session']->USUARI_C_USERNAME;
		
		//$listadosector = $this->M_crud->sql("Exec EMPRESA_LIS 0");
		$listadosector = $this->M_crud->sql("Exec SEDES_USUARIO_LIS 0 , " .$username );
		
		//Listado Sedes(Empresas)
		$this->data['listadosector'] = $listadosector;

		//Obtener categoria
		//$categoria=$this->data['categoria']->CATEGO_N_ID;
		
		$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO where empres_n_id=".$empresa);
		
	 
	    $this->data['tipo_unidad'] = $this->M_crud->sql("SELECT * FROM TIPO_UNIDAD WHERE TIPUNI_ESTADO='0' order by TIPUNI_N_ORDEN asc");
		
		if($empresa==1)
		{
		   $this->load->view('ingreso/V_prueba', $this->data);
		}
		else if($empresa==2)
		{
		   $this->load->view('ingreso/V_index', $this->data);	
		
		}
		else if($empresa==3)
		{
		   $this->load->view('ingreso/V_indexaqpcallao', $this->data);	
		
		}
		else if($empresa==4)
		{
		   $this->load->view('ingreso/V_indexlopud', $this->data);	
		
		}
    }
	
	public function prueba() 
	{   
	    //$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO");
		$empresa=$this->data['empresa']->EMPRES_N_ID;
		$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO where empres_n_id=".$empresa);
	    $this->data['tipo_unidad'] = $this->M_crud->sql("SELECT * FROM TIPO_UNIDAD WHERE TIPUNI_ESTADO='0' order by TIPUNI_N_ORDEN asc");
        $this->load->view('ingreso/V_prueba', $this->data);
    }
	
	public function indexaqpcallao() 
	{   
	    //$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO");
		$empresa=$this->data['empresa']->EMPRES_N_ID;
		$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO where empres_n_id=".$empresa);
	    $this->data['tipo_unidad'] = $this->M_crud->sql("SELECT * FROM TIPO_UNIDAD WHERE TIPUNI_ESTADO='0' order by TIPUNI_N_ORDEN asc");
        $this->load->view('ingreso/V_indexaqpcallao', $this->data);
    }
	
	public function indexlopud() 
	{   
	    //$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO");
		$empresa=$this->data['empresa']->EMPRES_N_ID;
		$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO where empres_n_id=".$empresa);
	    $this->data['tipo_unidad'] = $this->M_crud->sql("SELECT * FROM TIPO_UNIDAD WHERE TIPUNI_ESTADO='0' order by TIPUNI_N_ORDEN asc");
        $this->load->view('ingreso/V_indexlopud', $this->data);
    }
	
	/*
	public function prueba2() 
	{   
	    //$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO");
		$empresa=$this->data['empresa']->EMPRES_N_ID;
		$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO where empres_n_id=".$empresa);
	    $this->data['tipo_unidad'] = $this->M_crud->sql("SELECT * FROM TIPO_UNIDAD WHERE TIPUNI_ESTADO='0' order by TIPUNI_N_ORDEN asc");
        $this->load->view('ingreso/V_prueba2', $this->data);
    }
	*/
	
    public function nuevo()
    {
		$this->data['misdoc'] = $this->M_crud->sql("Exec TIPO_DOCUMENTO_PERSONAS_LIS");
		$empresa=$this->data['empresa']->EMPRES_N_ID;
		//$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO where");
		$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO where empres_n_id=".$empresa);
		//$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO");
		$this->data['tipo_unidad'] = $this->M_crud->sql("SELECT * FROM TIPO_UNIDAD WHERE TIPUNI_ESTADO='0' order by TIPUNI_N_ORDEN asc");
		$this->data['motivo_visita'] = $this->M_crud->sql("SELECT * FROM MOTIVO_VISITA WHERE MOTVIS_C_ESTADO = '1'");
		$this->data['clientes'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'0'");
		$this->data['visitada'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'1'");
		$this->data['persona_contacto'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'1'");
        
		if($empresa==1 or $empresa==4 or $empresa==2 )
		{
		$this->load->view('ingreso/V_nuevo', $this->data);
		}
		else if($empresa==3)
		{
		$this->load->view('ingreso/V_nuevoproaqpcallao', $this->data);
		}
		
    }
	
	public function nuevoalterno()
    {
		$this->data['misdoc'] = $this->M_crud->sql("Exec TIPO_DOCUMENTO_PERSONAS_LIS");
		$empresa=$this->data['empresa']->EMPRES_N_ID;
		//$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO where");
		$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO where empres_n_id=".$empresa);
		//$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO");
		$this->data['tipo_unidad'] = $this->M_crud->sql("SELECT * FROM TIPO_UNIDAD WHERE TIPUNI_ESTADO='0' order by TIPUNI_N_ORDEN asc");
		$this->data['motivo_visita'] = $this->M_crud->sql("SELECT * FROM MOTIVO_VISITA WHERE MOTVIS_C_ESTADO = '1'");
		$this->data['clientes'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'0'");
		$this->data['visitada'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'1'");
		$this->data['persona_contacto'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'1'");
        $this->load->view('ingreso/V_nuevoalterno', $this->data);        
    }
		
	public function nuevotrabajador()
    {
		$this->data['misdoc'] = $this->M_crud->sql("Exec TIPO_DOCUMENTO_PERSONAS_LIS");
		$empresa=$this->data['empresa']->EMPRES_N_ID;
		
		$this->data['tipo_ingreso'] = $this->M_crud->sql("SELECT * FROM TIPO_INGRESO where empres_n_id=".$empresa);
		$this->data['tipo_unidad'] = $this->M_crud->sql("SELECT * FROM TIPO_UNIDAD WHERE TIPUNI_ESTADO='0' order by TIPUNI_N_ORDEN asc");
		$this->data['motivo_visita'] = $this->M_crud->sql("SELECT * FROM MOTIVO_VISITA WHERE MOTVIS_C_ESTADO = '1'");
		$this->data['clientes'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'0'");
		$this->data['visitada'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'1'");
		$this->data['persona_contacto'] = $this->M_crud->sql("Exec  CLIENTE_ESCLIENTE_LIS 1,'1'");
		
        $this->load->view('ingreso/V_nuevotraaqpcallao', $this->data);        
    
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

	public function exportar2excel(){
	$this->excel->setActiveSheetIndex(0);         
    $this->excel->getActiveSheet()->setTitle('test worksheet');
	
	//$empresa=$this->data['empresa']->EMPRES_N_ID;
	$empresa=$this->input->get('var1');
	$dni=$this->input->get('var2');
	$empresa_visitante=$this->input->get('var3');
	$apellido=$this->input->get('var4');
	$placa=$this->input->get('var5');
	$fecha_desde=$this->input->get('var6');
	$fecha_hasta=$this->input->get('var7');
	$situacion=$this->input->get('var8');
	$tipo_ingreso=$this->input->get('var9');
	$tipobusqueda=$this->input->get('var10');
	$tipolistado=$this->input->get('var11');
	$usuario= $this->data['session']->USUARI_N_ID;
	$categoria=$this->data['session']->CATEGO_N_ID;
	
	if($categoria==4 or $categoria==7){
		$usuario=1;
	}
	//else if($empresa==3)
	//{
	//$usuario=24;
	//$usuario=25;
	//}
	
	//$x=2;
	//$xx=1;
	//$tipo_ingreso=$this->input->get('var9');
	if($empresa==1){
	$sql = "Exec MOVIMIENTO_PERSONA_LIS_PRUEBA ".$empresa.",'{$dni}'".",'{$empresa_visitante}'".",'{$apellido}'".",'{$placa}'".",'{$fecha_desde}'".",'{$fecha_hasta}'".",'{$situacion}'".",'{$tipo_ingreso}','{$usuario}','{$tipobusqueda}','{$tipolistado}'";
	}
	else if($empresa==4)
	{
	$sql = "Exec MOVIMIENTO_PERSONA_LIS_LOPUD ".$empresa.",'{$dni}'".",'{$empresa_visitante}'".",'{$apellido}'".",'{$placa}'".",'{$fecha_desde}'".",'{$fecha_hasta}'".",'{$situacion}'".",'{$tipo_ingreso}','{$usuario}','{$tipobusqueda}','{$tipolistado}'";	
	}
	
	$result = $this->M_crud->sql($sql);
		
	//Contador de filas
        $contador = 1;
        //Le aplicamos ancho las columnas.
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        //Le aplicamos negrita a los títulos de la cabecera.
        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
        //Definimos los títulos de la cabecera.
        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Identificacion');
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Empresa');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Nombres');
        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Apellidos');
        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'Tipo');
        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Fecha');
        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Llegada');
        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'Ingreso');
        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'Salida');
		
	/*
	foreach($result as $l){
		
		$contador++;
	
		$this->excel->getActiveSheet()->setCellValue("A{$contador}", $l->sad);
		$this->excel->getActiveSheet()->setCellValue("B{$contador}", $l->adsdasd);
		$this->excel->getActiveSheet()->setCellValue("C{$contador}", $l->adadd);
		$this->excel->getActiveSheet()->setCellValue("D{$contador}", $l->add);
		$this->excel->getActiveSheet()->setCellValue("E{$contador}", $l->adasd);
		$this->excel->getActiveSheet()->setCellValue("F{$contador}", $l->adsad);
		$this->excel->getActiveSheet()->setCellValue("G{$contador}", $l->adsd);
		$this->excel->getActiveSheet()->setCellValue("H{$contador}", $l->ad);
		$this->excel->getActiveSheet()->setCellValue("I{$contador}", $l->adasdasdsad);

	}
	*/
	
	foreach($result as $l){
		
		$contador++;
	
		$this->excel->getActiveSheet()->setCellValue("A{$contador}", $l->PERSON_C_DOCUMENTO);
		$this->excel->getActiveSheet()->setCellValue("B{$contador}", $l->RAZON_SOCIAL_VISITANTE);
		$this->excel->getActiveSheet()->setCellValue("C{$contador}", $l->PERSON_C_NOMBRE);
		$this->excel->getActiveSheet()->setCellValue("D{$contador}", $l->PERSON_C_APELLIDOS);
		$this->excel->getActiveSheet()->setCellValue("E{$contador}", $l->TIPING_C_DESCRIPCION);
		$this->excel->getActiveSheet()->setCellValue("F{$contador}", $l->FECHA_INGRESO);
		$this->excel->getActiveSheet()->setCellValue("G{$contador}", $l->HORA_LLEGADA);
		$this->excel->getActiveSheet()->setCellValue("H{$contador}", $l->HORA_INGRESO);
		$this->excel->getActiveSheet()->setCellValue("I{$contador}", $l->FECHA_HORA_SALIDA);

	}
	
    header('Content-Type: application/vnd.ms-excel');         
    header('Content-Disposition: attachment;filename="MovimientoPersona.xls"');
    header('Cache-Control: max-age=0'); //no cache         
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');         
    
    // Forzamos a la descarga         
    $objWriter->save('php://output');
  }
  
  public function exportaraqpcallao(){
	$this->excel->setActiveSheetIndex(0);         
    $this->excel->getActiveSheet()->setTitle('test worksheet');
	
	//$empresa=$this->data['empresa']->EMPRES_N_ID;
	$empresa=$this->input->get('var1');
	$dni=$this->input->get('var2');
	$empresa_visitante=$this->input->get('var3');
	$apellido=$this->input->get('var4');
	$placa=$this->input->get('var5');
	$fecha_desde=$this->input->get('var6');
	$fecha_hasta=$this->input->get('var7');
	$situacion=$this->input->get('var8');
	$tipo_ingreso=$this->input->get('var9');
	$tipobusqueda=$this->input->get('var10');
	$tipolistado=$this->input->get('var11');
	$tipodatos=$this->input->get('var12');
	
	if($empresa==1 or $empresa==2){
	$usuario=1;
	}
	else if($empresa==3)
	{
	$usuario=24;
	//$usuario=25;
	}
	//$x=2;
	//$xx=1;
	//$tipo_ingreso=$this->input->get('var9');
	
	$sql = "Exec MOVIMIENTO_PERSONA_LIS_AQPCALLAO ".$empresa.",'{$dni}'".",'{$empresa_visitante}'".",'{$apellido}'".",'{$placa}'".",'{$fecha_desde}'".",'{$fecha_hasta}'".",'{$situacion}'".",'{$tipo_ingreso}','{$usuario}','{$tipobusqueda}','{$tipolistado}','{$tipodatos}'";
	
	$result = $this->M_crud->sql($sql);
		
	//Contador de filas
        $contador = 1;
	
	if($tipolistado==1){
			
        //Le aplicamos ancho las columnas.
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        //Le aplicamos negrita a los títulos de la cabecera.
        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("J{$contador}")->getFont()->setBold(true);
        //Definimos los títulos de la cabecera.
        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Identificacion');
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Empresa');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Nombres');
        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Apellidos');
        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'Tipo');
        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Fecha');
        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Llegada');
        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'Ingreso');
        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'Salida');
        $this->excel->getActiveSheet()->setCellValue("J{$contador}", 'Condicion');
	}
	else if($tipolistado==2)
	{
		
		//Le aplicamos ancho las columnas.
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        //Le aplicamos negrita a los títulos de la cabecera.
        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("J{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("K{$contador}")->getFont()->setBold(true);
        //Definimos los títulos de la cabecera.
        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Identificacion');
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Empresa');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Nombres');
        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Apellidos');
        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'Tipo');
        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Fecha');
        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Llegada');
        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'Ingreso');
        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'Salida');
        $this->excel->getActiveSheet()->setCellValue("J{$contador}", 'Almacen');
        $this->excel->getActiveSheet()->setCellValue("K{$contador}", 'Servicio');
		
	}

	foreach($result as $l){
		
	$contador++;
	
		if($tipolistado==1){
			
		$this->excel->getActiveSheet()->setCellValue("A{$contador}", $l->PERSON_C_DOCUMENTO);
		$this->excel->getActiveSheet()->setCellValue("B{$contador}", $l->RAZON_SOCIAL_VISITANTE);
		$this->excel->getActiveSheet()->setCellValue("C{$contador}", $l->PERSON_C_NOMBRE);
		$this->excel->getActiveSheet()->setCellValue("D{$contador}", $l->PERSON_C_APELLIDOS);
		$this->excel->getActiveSheet()->setCellValue("E{$contador}", $l->TIPING_C_DESCRIPCION);
		$this->excel->getActiveSheet()->setCellValue("F{$contador}", $l->FECHA_INGRESO);
		$this->excel->getActiveSheet()->setCellValue("G{$contador}", $l->HORA_LLEGADA);
		$this->excel->getActiveSheet()->setCellValue("H{$contador}", $l->HORA_INGRESO);
		$this->excel->getActiveSheet()->setCellValue("I{$contador}", $l->FECHA_HORA_SALIDA);
		$this->excel->getActiveSheet()->setCellValue("J{$contador}", $l->MOVPER_C_CONDICION);
		
		}
		elseif($tipolistado==2)
		{
			 
		$this->excel->getActiveSheet()->setCellValue("A{$contador}", $l->PERSON_C_DOCUMENTO);
		$this->excel->getActiveSheet()->setCellValue("B{$contador}", $l->RAZON_SOCIAL_VISITANTE);
		$this->excel->getActiveSheet()->setCellValue("C{$contador}", $l->PERSON_C_NOMBRE);
		$this->excel->getActiveSheet()->setCellValue("D{$contador}", $l->PERSON_C_APELLIDOS);
		$this->excel->getActiveSheet()->setCellValue("E{$contador}", $l->TIPING_C_DESCRIPCION);
		$this->excel->getActiveSheet()->setCellValue("F{$contador}", $l->FECHA_INGRESO);
		$this->excel->getActiveSheet()->setCellValue("G{$contador}", $l->HORA_LLEGADA);
		$this->excel->getActiveSheet()->setCellValue("H{$contador}", $l->HORA_INGRESO);
		$this->excel->getActiveSheet()->setCellValue("I{$contador}", $l->FECHA_HORA_SALIDA);
		$this->excel->getActiveSheet()->setCellValue("J{$contador}", $l->TIPLALMACEN_C_DESCRIPCION);
		$this->excel->getActiveSheet()->setCellValue("K{$contador}", $l->TIPSERVICIO_C_DESCRIPCION);
				
		}
	
	}
	
    header('Content-Type: application/vnd.ms-excel');         
    header('Content-Disposition: attachment;filename="MovimientoPersona.xls"');
    header('Cache-Control: max-age=0'); //no cache         
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');         
    
    // Forzamos a la descarga         
    $objWriter->save('php://output');
  }

}
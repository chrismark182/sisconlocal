<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_info extends CI_Controller {

	var $data = array();

	public function __construct()
    {
        parent::__construct();
		$this->_init();
		if($this->session->userdata('logged_in')):
			$this->load->library('EsandexAccesos');  
			$this->data['session'] = $this->esandexaccesos->session();
            $this->data['accesos'] = $this->esandexaccesos->accesos();
		else:
			redirect(base_url(),'refresh');
		endif;
	}
	
	private function _init()
	{
		//$this->output->set_template('siscon');
	}
	
	public function validate(){
		//echo "prueba";
		
		 $sql = "select sa.SOLABAS_N_ID,sa.SOLABAS_DATE,sa.SOLABAS_NUMERO,sa.SOLABAS_EMPRESA,SOLABAS_DEPARTGG,SOLABAS_DEPARTADMI,SOLABAS_DEPARTSISTE,SOLABAS_DEPARTMONI,SOLABAS_DEPARTOPER,SOLABAS_DEPARTGALMA,SOLABAS_DEPARTOPERA,SOLABAS_DEPARTSEGU,SOLABAS_DEPARTRRHH,SOLABAS_DEPARTOTROS,SOLABAS_OTROSOBS,SOLABAS_TIPO,dsa.DESCRIPCION,dsa.FILE1,dsa.FILE2,dsa.FILE3,SOLABAS_DEPARTLEGAL,SOLABAS_SEDE from SOLICITUD_ABASTECIMIENTO sa inner join DETALLE_SOLICITUD_ABASTECIMIENTO dsa on sa.solabas_n_id = dsa.SOLABAS_N_ID where
		sa.SOLABAS_N_ID = '{$this->input->post('vs_var1')}'";
		
		$this->datasoliabas['result'] = $this->M_crud->sql($sql);
		
		//print_r($this->datasoliabas['result']);
		//$var = array('email'=>"1",'password'=>'2');
		
		
		if ($this->datasoliabas['result']!="") {
		//$this->datasoliabas['results']
           echo json_encode($this->datasoliabas);
        }else{
          // echo "2_|_";
        }
		
		//echo json_encode($this->datasoliabas);	
	
	}
	
	
	public function updateprecio(){
	//echo "prueba";
	//$sql = "update SOLICITUD_ABASTECIMIENTO set SOLABAS_PRECIO = '{$this->input->post('vs_var1')}'  WHERE SOLABAS_N_ID ='{$this->input->post('vs_var2')}'";
	
	//$sql="update SOLICITUD_ABASTECIMIENTO set SOLABAS_PRECIO = '78000'  WHERE SOLABAS_N_ID ='28'";
	
	//echo $sql;
	//$this->M_crud->sql($sql);
	
	$this->db->simple_query("update SOLICITUD_ABASTECIMIENTO set SOLABAS_PRECIO = '{$this->input->post('vs_var1')}'  WHERE SOLABAS_N_ID ='{$this->input->post('vs_var2')}'");
	
	
	$sql2 = "select SOLABAS_PRECIO from SOLICITUD_ABASTECIMIENTO WHERE SOLABAS_N_ID ='{$this->input->post('vs_var2')}'";
	
	$this->datasoliabas['result'] = $this->M_crud->sql($sql2);
		
		
	if ($this->datasoliabas['result']!="") {
		//$this->datasoliabas['results']
         echo json_encode($this->datasoliabas);
        }
		else{
          // echo "2_|_";
        }	
		
	//$query->num_rows();
	
	//echo $query;
		
		
	}
	
	
	public function edit(){
		//echo "prueba";
		
		 $sql = "select sa.SOLABAS_N_ID,sa.SOLABAS_DATE,sa.SOLABAS_NUMERO,sa.SOLABAS_EMPRESA,SOLABAS_DEPARTGG,SOLABAS_DEPARTADMI,SOLABAS_DEPARTSISTE,SOLABAS_DEPARTMONI,SOLABAS_DEPARTOPER,SOLABAS_DEPARTGALMA,SOLABAS_DEPARTOPERA,SOLABAS_DEPARTSEGU,SOLABAS_DEPARTRRHH,SOLABAS_DEPARTOTROS,SOLABAS_OTROSOBS,SOLABAS_TIPO,dsa.DESCRIPCION,sa.SOLABAS_PRECIO,dsa.FILE1,dsa.FILE2,dsa.FILE3 from SOLICITUD_ABASTECIMIENTO sa inner join DETALLE_SOLICITUD_ABASTECIMIENTO dsa on sa.solabas_n_id = dsa.SOLABAS_N_ID where
		sa.SOLABAS_N_ID = '{$this->input->post('vs_var1')}'";
		
		$this->datasoliabas['result'] = $this->M_crud->sql($sql);
		
		//print_r($this->datasoliabas['result']);
		//$var = array('email'=>"1",'password'=>'2');
		
		
		if ($this->datasoliabas['result']!="") {
		//$this->datasoliabas['results']
           echo json_encode($this->datasoliabas);
        }else{
          // echo "2_|_";
        }
		
		//echo json_encode($this->datasoliabas);	
	
	}
	
	
	public function conprecio(){
		 //$sql = "select * from DETALLE_PRECIO_SOLICITUD where SOLABAS_N_ID ='{$this->input->post('vs_var1')}'";
		 
		 //$query =$this->db->simple_query("select PAGO from DETALLE_PRECIO_SOLICITUD where SOLABAS_N_ID ='{$this->input->post('vs_var1')}'");
		 
		 
		 
		 $sql = "select PAGO from DETALLE_PRECIO_SOLICITUD where SOLABAS_N_ID ='{$this->input->post('vs_var1')}'";
		 
		$this->datasoliabas['result'] = $query= $this->M_crud->sql($sql);
		 
		 
		if($this->datasoliabas['result']!=""){
			 echo json_encode($this->datasoliabas);
		 	//echo "2";
		 }else
		 {
			 
			 //$data['result'] = ['PAGO' => "0"];
			 //echo "1";
		 }
		 
		
	}
	
	public function pagoins(){
		
		//$sql = "insert into DETALLE_PRECIO_SOLICITUD (SOLABAS_N_ID,DESCRIPCION,PAGO) values('{$this->input->post('vs_var3')}','{$this->input->post('vs_var2')}','{$this->input->post('vs_var1')}')";
		
		//insert
		$this->db->simple_query("insert into DETALLE_PRECIO_SOLICITUD (SOLABAS_N_ID,DESCRIPCION,PAGO,FECHA,REGISTER_USER,REGISTER_DATE,PAGO_FILE) values('{$this->input->post('vs_var3')}','{$this->input->post('vs_var2')}','{$this->input->post('vs_var1')}',GETDATE(),'{$this->session->userdata('id')}',GETDATE(),'{$this->input->post('vs_var6')}')");
		
		
		if($this->input->post('vs_var5')){
			
		$vtotal =($this->input->post('vs_var5')/$this->input->post('vs_var4'))*100;
		}	
		else
		{			
		$vtotal = ($this->input->post('vs_var1')/$this->input->post('vs_var4'))*100;
		
		}
		
		//$vtotal2=$vtotal;
		//$vtotal = round($vtotal, 0, PHP_ROUND_HALF_DOWN); //PHP_ROUND_HALF_UP
		
		$vtotal = intval($vtotal);
		
		
		//update 
		$this->db->simple_query("update SOLICITUD_ABASTECIMIENTO set SOLABAS_PORCEN = '{$vtotal}' where SOLABAS_N_ID ='{$this->input->post('vs_var3')}'  ");
		
		//if($vtotal==100){
		//$this->db->simple_query("update SOLICITUD_ABASTECIMIENTO set SOLABAS_ESTADO = '2' where SOLABAS_N_ID ='{$this->input->post('vs_var3')}'");	
		//}     
		 
		echo $vtotal;
		  
		//echo "1";
		
		

		//select PAGO from DETALLE_PRECIO_SOLICITUD where SOLABAS_N_ID ='{$this->input->post('vs_var1')}'";
		
	}
	
	public function detpagolist(){
		
		//$this->db->simple_query("insert into DETALLE_PRECIO_SOLICITUD (SOLABAS_N_ID,DESCRIPCION,PAGO) values('{$this->input->post('vs_var3')}','{$this->input->post('vs_var2')}','{$this->input->post('vs_var1')}')");
		
		$sql="select DETALLEPRECIOSOLICITUD_N_ID,SOLABAS_N_ID,DESCRIPCION,PAGO,FECHA,PAGO_FILE,DETALLEPAGO_ESTADO from DETALLE_PRECIO_SOLICITUD where SOLABAS_N_ID = '{$this->input->post('vs_var1')}'";
		
		$this->datasoliabas['result'] = $query= $this->M_crud->sql($sql);
		
		
		
		if($this->datasoliabas['result']!=""){
			 echo json_encode($this->datasoliabas);
		 	//echo "2";
		 }else
		 {
			 
			 //$data['result'] = ['PAGO' => "0"];
			 //echo "1";
		 }
					
	}
	
	
	public function detcullist(){
		
		$sql="select SOLABAS_N_ID,DESCRIPCION,PAGO,FECHA,PAGO_FILE from DETALLE_PRECIO_SOLICITUD where SOLABAS_N_ID = '{$this->input->post('vs_var1')}'";
		
		$this->datasoliabas['result'] = $query= $this->M_crud->sql($sql);
		
		
		
		if($this->datasoliabas['result']!=""){
			 echo json_encode($this->datasoliabas);
		 	//echo "2";
		 }else
		 {
			 
			 //$data['result'] = ['PAGO' => "0"];
			 //echo "1";
		 }
		
		
	}
	
	public function aprobarpago(){
		
		$this->db->simple_query("EXEC APROBARPAGO '{$this->input->post('vs_var1')}'");
			
		//$var1=$this->input->post('vs_var1');
		echo "1";

	}
	
	
	
	
	
	public function aprobarsolicitud(){
		
		//$sql="Update SOLICITUD_ABASTECIMIENTO SET SOLABAS_OPC2='1' and SOLABAS_DATE_APRO=GETDATE() where SOLABAS_N_ID = '{$this->input->post('vs_var1')}'";
		
		$this->db->simple_query("Update SOLICITUD_ABASTECIMIENTO SET SOLABAS_OPC2='1', SOLABAS_DATE_APRO=GETDATE() where SOLABAS_N_ID = '{$this->input->post('vs_var1')}'");
		
		//$var1=$this->input->post('vs_var1');
		echo "1";
		//$this->session->set_flashdata('message', 'Solicitud de Abastecimiento creado correctamente');  
		//redirect('solicitudabastecimiento', 'refresh');
	}
	
	
	public function reportlist(){
		
		//$this->db->simple_query("insert into DETALLE_PRECIO_SOLICITUD (SOLABAS_N_ID,DESCRIPCION,PAGO) values('{$this->input->post('vs_var3')}','{$this->input->post('vs_var2')}','{$this->input->post('vs_var1')}')");
		
		$sql="select SOLABAS_N_ID,DESCRIPCION,FECHA,REPORTE_FILE from DETALLE_REPORTE_SOLICITUD where SOLABAS_N_ID = '{$this->input->post('vs_var1')}'";
		
		$this->datasoliabas['result'] = $query= $this->M_crud->sql($sql);
		
		
		
		if($this->datasoliabas['result']!=""){
			 echo json_encode($this->datasoliabas);
		 	//echo "2";
		 }else
		 {
			 
			 //$data['result'] = ['PAGO' => "0"];
			 //echo "1";
		 }
					
	}
	
	
	public function reporteins(){
				
		$this->db->simple_query("insert into DETALLE_REPORTE_SOLICITUD (SOLABAS_N_ID,DESCRIPCION,FECHA,REGISTER_USER,REGISTER_DATE,REPORTE_FILE) values('{$this->input->post('vs_var3')}','{$this->input->post('vs_var1')}',GETDATE(),'{$this->session->userdata('id')}',GETDATE(),'{$this->input->post('vs_var2')}')");
						
		echo "1";
		
	}
	
	
	public function finalrepor(){
		//"Update SOLICITUD_ABASTECIMIENTO set SOLABAS_REPORFINAL = '1'	 where SOLABAS_N_ID = '{$this->input->post('vs_var1')}'"
				
				
		$this->db->simple_query("Update SOLICITUD_ABASTECIMIENTO Set SOLABAS_REPORFINAL = '1' Where SOLABAS_N_ID = '{$this->input->post('vs_var1')}'");
						
		echo "1";
		
	}
	
	
	
	
	
}

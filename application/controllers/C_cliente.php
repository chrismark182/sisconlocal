<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cliente extends CI_Controller {
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
        $this->load->view('cliente/V_index', $this->data);
    }

    public function nuevo()
    {
        $documento ="Exec TIPO_DOCUMENTO_EMPRESAS_LIS";

        $this->data['tdocumentos'] = $this->M_crud->sql($documento);
        $this->load->view('cliente/V_nuevo', $this->data);
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

    public function crear(){
        $esclient='0';
        $esproveedor='0';
        $estransportista='0';
		$otro='0';
        $ordencompra='0';

        if($this->input->post('escliente')=='on'):
            $esclient='1';
        endif;
        if($this->input->post('esproveedor')=='on'):
            $esproveedor='1';
        endif;
        if($this->input->post('estransportista')=='on'):
            $estransportista='1';
        endif;
		if($this->input->post('otro')=='on'):
            $otro='1'; 
        endif;		
        if($this->input->post('ordencompra')=='on'):
            $ordencompra='1';
        endif;

        if(
            trim($this->input->post('tdocumento')) != '' &&
            trim($this->input->post('ndocumento'))  != '' &&
            trim($this->input->post('razon_social')) != '' &&
            trim($this->input->post('direccion')) != ''
         ):
                $sql = "Exec CLIENTE_INS "      . $this->data['empresa']->EMPRES_N_ID . ","
                                                . $this->input->post('tdocumento') . ",'" 
                                                . $this->input->post('ndocumento') . "','" 
                                                . $this->input->post('razon_social') . "','" 
                                                . $this->input->post('direccion') . "','" 
                                                . $esclient . "','"
                                                . $ordencompra . "','"
                                                . $esproveedor . "','"
                                                . $estransportista . "','"
                                                . $otro . "',"
                                                . $this->data['session']->USUARI_N_ID ;
                
                                                $this->M_crud->sql($sql);
                                                $url = 'clientes?n=' . $this->input->post('ndocumento'); 
                                                redirect($url,'refresh');

                                                
         
         else:
            $this->session->set_flashdata('message','No puede guardar en vacio ');
            header("Location: nuevo");
        endif;
    }

    public function actualizar($empresa,$cliente)
    {
        $esclient='0';
        $esproveedor='0';
        $estransportista='0';
        $otro='0';
        $ordencompra='0';

        if($this->input->post('escliente')=='on'):
            $esclient='1';
        endif;
        if($this->input->post('esproveedor')=='on'):
            $esproveedor='1';
        endif;
        if($this->input->post('estransportista')=='on'):
            $estransportista='1';
        endif;
        if($this->input->post('ordencompra')=='on'):
            $ordencompra='1';
        endif;
		if($this->input->post('otro')=='on'):
            $otro='1'; 
        endif;	

        if( trim($this->input->post('ndocumento'))  != '' &&
            trim($this->input->post('razon_social')) != '' &&
            trim($this->input->post('direccion')) != ''
            ):
            $sql = "Exec CLIENTE_UPD "      . $empresa. ","
                                            . $cliente. ",'" 
                                            .$this->input->post('tdocumento')."','"
                                            .$this->input->post('ndocumento') . "','" 
                                            .$this->input->post('razon_social') ."','"
                                            .$this->input->post('direccion')."','"
                                            . $esclient . "','"
                                            . $ordencompra . "','"
                                            . $esproveedor . "','"
                                            . $estransportista . "','"
                                            . $otro . "',"
                                            .$this->data['session']->USUARI_N_ID ; 
            
            $this->M_crud->sql($sql);      
            $this->session->set_flashdata('message','Datos actualizados correctamente');
            $url = 'clientes?n=' . $this->input->post('ndocumento');
            redirect($url, 'refresh');      


        else:
            $this->session->set_flashdata('message','No puede guardar en vacio ');
            header("Location: editar");
        endif;
    }

    public function eliminar($empresa,$cliente)
    {
        $sql = "Exec CLIENTE_DEL "     . $empresa .","
                                        . $cliente.","
                                        .$this->data['session']->USUARI_N_ID ; 
                                        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('clientes', 'refresh');       
    }  
}


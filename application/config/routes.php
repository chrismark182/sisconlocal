<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'C_home';
$route['empresa/crear']='C_empresa/crear';

$route['dashboard'] = 'C_dashboard';


//Login
$route['login']='C_login';
$route['login/create'] = 'C_login/create';
$route['login/login'] = 'C_login/userpass';
//$route['login/cambiosede'] = 'C_login/cambiosede';
$route['login/(:num)/cambiosede'] = function ($id){return 'C_login/cambiosede/'.$id;};
$route['logout'] = 'C_login/logout';

//Acuerdos
$route['acuerdos'] = 'C_acuerdo';
$route['acuerdo/buscar'] = function (){return 'C_acuerdo/buscar'; };
$route['acuerdo/nuevo'] = 'C_acuerdo/nuevo';
$route['acuerdo/crear'] = 'C_acuerdo/crear';
$route['acuerdo/(:num)/(:num)/eliminar'] = function ($empresa,$id){return 'C_acuerdo/eliminar/'.$empresa.'/'.$id;};
$route['acuerdo/periodo/(:num)/(:num)/eliminar'] = function ($empresa,$id){return 'C_acuerdo/eliminar_periodo/'.$empresa.'/'.$id.'/'.$periodo;};
$route['acuerdo/(:num)/(:num)/cerrar'] = function ($empresa,$id){return 'C_acuerdo/cerrar/'.$empresa.'/'.$id;};
$route['acuerdo/reporte/(:num)'] = function ($id){return 'C_acuerdo/reporte/'.$id;};;

//Menu
$route['menus'] = 'C_menu';
$route['menu/nuevo'] = 'C_menu/nuevo';
$route['menu/crear'] = 'C_menu/crear';
$route['menu/(:num)/editar'] = function ($id){return 'C_menu/editar/'.strtolower($id);};
$route['menu/(:num)/actualizar'] = function ($id){return 'C_menu/actualizar/'.strtolower($id);};
$route['menu/(:num)/eliminar'] = function ($id){return 'C_menu/eliminar/'.$id;};

//Sedes
$route['sedes'] = 'C_sede';
$route['sede/nuevo'] = 'C_sede/nuevo';
$route['sede/crear'] = 'C_sede/crear';
$route['sede/(:num)/(:num)/editar'] = function ($empresa,$id){return 'C_sede/editar/'.$empresa.'/'.$id;};
$route['sede/(:num)/(:num)/actualizar'] = function ($empresa,$id){return 'C_sede/actualizar/'.$empresa.'/'.$id;};
$route['sede/(:num)/(:num)/eliminar'] = function ($empresa,$id){return 'C_sede/eliminar/'.$empresa.'/'.$id;};

//Ubicacion
$route['ubicaciones'] = 'C_ubicacion';
$route['ubicacion/nuevo'] = 'C_ubicacion/nuevo';
$route['ubicacion/crear'] = 'C_ubicacion/crear';
$route['ubicacion/(:num)/(:num)/(:num)/editar'] = function ($empresa , $sede , $id){return 'C_ubicacion/editar/'.$empresa.'/'.$sede.'/'.$id;};
$route['ubicacion/(:num)/(:num)/(:num)/actualizar'] = function ($empresa , $sede , $id ){return 'C_ubicacion/actualizar/'.$empresa.'/'.$sede.'/'.$id;};
$route['ubicacion/(:num)/(:num)/(:num)/eliminar'] = function ($empresa , $sede , $id ){return 'C_ubicacion/eliminar/'.$empresa.'/'.$sede.'/'.$id;};

//Orden Servicio
$route['ordenes'] = 'C_ordenservicio';
$route['ordenservicio/reporte/(:num)'] = function ($id){return 'C_ordenservicio/reporte/'.$id;};;
$route['ordenservicio/nuevo'] = 'C_ordenservicio/nuevo';
$route['ordenservicio/crear'] = 'C_ordenservicio/crear';
$route['ordenservicio/(:num)/(:num)/actualizar'] = function ($empresa , $id ){return 'C_ordenservicio/actualizar/'.$empresa.'/'.$id;};
$route['ordenservicio/(:num)/(:num)/eliminar'] = function ($empresa , $id ){return 'C_ordenservicio/eliminar/'.$empresa.'/'.$id;};

//Liquidacion de Servicio
$route['liq_servicios'] = 'C_liquidacion_servicios';
$route['liq_servicios/buscar'] = 'C_liquidacion_servicios/buscar';
$route['liq_servicios/reporte/(:num)'] = function ($id){return 'C_liquidacion_servicios/reporte/'.$id;};;
$route['liq_servicios/nuevo'] = 'C_liquidacion_servicios/nuevo';
$route['liq_servicios/nuevo/buscar'] = 'C_liquidacion_servicios/nuevo_buscar';
$route['liq_servicios/nuevo/grabar_cabecera'] = 'C_liquidacion_servicios/grabar_cabecera';
$route['liq_servicios/nuevo/grabar_detalle'] = 'C_liquidacion_servicios/grabar_detalle';
$route['liq_servicios/(:num)/(:num)/eliminar'] = function ($empresa , $id ){return 'C_liquidacion_servicios/eliminar/'.$empresa.'/'.$id;};
$route['liq_servicios/updateoc'] = function (){return 'C_liquidacion_servicios/updateoc/';};

//Liquidación de Alquiler 
$route['liq_alquiler'] = 'C_liquidacion_alquiler';
$route['liq_alquiler/nuevo'] = 'C_liquidacion_alquiler/nuevo';
$route['liq_alquiler/reporte/(:num)'] = function ($id){return 'C_liquidacion_alquiler/reporte/'.$id;};;
$route['liq_alquiler/(:num)/(:num)/eliminar'] = function ($empresa , $id ){return 'C_liquidacion_alquiler/eliminar/'.$empresa.'/'.$id;};

//Traslado Navasoft - Servicio
$route['navasoft_servicios'] = 'C_navasoft_servicios';
$route['navasoft_servicios/buscar'] = 'C_navasoft_servicios/buscar';
$route['navasoft_servicios/generar_dbf'] = 'C_navasoft_servicios/generar_dbf';

//Traslado Navasoft - Alquiler
$route['navasoft_alquiler'] = 'C_navasoft_alquiler';
$route['navasoft_alquiler/buscar'] = 'C_navasoft_alquiler/buscar';
$route['navasoft_alquiler/generar_dbf'] = 'C_navasoft_alquiler/generar_dbf';

//Clientes
$route['clientes'] = 'C_cliente';
$route['cliente/nuevo'] = 'C_cliente/nuevo';
$route['cliente/crear'] = 'C_cliente/crear';
$route['cliente/(:num)/(:num)/editar'] = function ($empresa , $cliente){return 'C_cliente/editar/'.$empresa.'/'.$cliente;};
$route['cliente/(:num)/(:num)/actualizar'] = function ($empresa , $cliente){return 'C_cliente/actualizar/'.$empresa.'/'.$cliente;};
$route['cliente/(:num)/(:num)/eliminar'] = function ($empresa , $cliente){return 'C_cliente/eliminar/'.$empresa.'/'.$cliente;};

//Servicios
$route['servicios'] = 'C_servicio';
$route['servicio/nuevo'] = 'C_servicio/nuevo';
$route['servicio/crear'] = 'C_servicio/crear';
$route['servicio/(:num)/(:num)/editar'] = function ($empresa , $servicio){return 'C_servicio/editar/'.$empresa.'/'.$servicio;};
$route['servicio/(:num)/(:num)/actualizar'] = function ($empresa , $servicio){return 'C_servicio/actualizar/'.$empresa.'/'.$servicio;};
$route['servicio/(:num)/(:num)/eliminar'] = function ($empresa , $servicio){return 'C_servicio/eliminar/'.$empresa.'/'.$servicio;};

//Ubicacion
$route['usuarios'] = 'C_usuario';
$route['usuario/nuevo'] = 'C_usuario/nuevo';
$route['usuario/crear'] = 'C_usuario/crear';
$route['usuario/cambio_pass'] = 'C_usuario/cambio_pass';
$route['usuario/(:num)/change_pass'] = function ($id){return 'C_usuario/cambio_pass_usuario/'.$id;};
$route['usuario/(:num)/editar'] = function ($id){return 'C_usuario/edit/'.$id;};
$route['usuario/(:num)/actualizar'] = function ($id){return 'C_usuario/update/'.$id;};
$route['usuario/(:num)/eliminar'] = function ($id){return 'C_usuario/eliminar/'.$id;};

//Categorias
$route['categorias'] = 'C_categoria';
$route['categoria/nuevo'] = 'C_categoria/nuevo';
$route['categoria/crear'] = 'C_categoria/crear';
$route['categoria/(:num)/editar'] = function ($id){return 'C_categoria/editar/'.$id;};
$route['categoria/(:num)/permisos'] = function ($id){return 'C_categoria/permisos/'.$id;};
$route['categoria/(:num)/actualizar'] = function ($id){return 'C_categoria/actualizar/'.$id;};
$route['categoria/(:num)/eliminar'] = function ($id){return 'C_categoria/eliminar/'.$id;};

//Visitas
$route['visitas'] = 'C_visita';
$route['visita/nuevo'] = 'C_visita/nuevo';
$route['visita/crear'] = 'C_visita/crear';
$route['visita/(:num)/(:num)/editar'] = function ($empresa , $visita){return 'C_visita/editar/'.$empresa.'/'.$visita;};
$route['visita/(:num)/(:num)/actualizar'] = function ($empresa , $visita){return 'C_visita/actualizar/'.$empresa.'/'.$visita;};
$route['visita/(:num)/(:num)/eliminar'] = function ($empresa , $visita){return 'C_visita/eliminar/'.$empresa.'/'.$visita;};

//Contactos
$route['contactos'] = 'C_contacto';
$route['contacto/buscar'] = 'C_contacto/buscar';
$route['contacto/nuevo'] = 'C_contacto/nuevo';
$route['contacto/crear'] = 'C_contacto/crear';
$route['contacto/contactoValidar'] = function (){return 'C_contacto/contactoValidar'; };
$route['contacto/(:num)/(:num)/(:num)/editar'] = function ($empresa ,$cliente, $contacto){return 'C_contacto/editar/'.$empresa.'/'.$cliente.'/'.$contacto;};
$route['contacto/(:num)/(:num)/(:num)/actualizar'] = function ($empresa ,$cliente, $contacto){return 'C_contacto/actualizar/'.$empresa.'/'.$cliente.'/'.$contacto;};
$route['contacto/(:num)/(:num)/(:num)/eliminar'] = function ($empresa ,$cliente, $contacto){return 'C_contacto/eliminar/'.$empresa.'/'.$cliente.'/'.$contacto;};

//Tarifas
$route['tarifas'] = 'C_tarifario';
$route['tarifa/nuevo'] = 'C_tarifario/nuevo';
$route['tarifa/crear'] = 'C_tarifario/crear';
$route['tarifa/(:num)/(:num)/editar'] = function ($empresa ,$tarifa){return 'C_tarifario/editar/'.$empresa.'/'.$tarifa;};
$route['tarifa/(:num)/(:num)/actualizar'] = function ($empresa ,$tarifa){return 'C_tarifario/actualizar/'.$empresa.'/'.$tarifa;};
$route['tarifa/(:num)/(:num)/eliminar'] = function ($empresa ,$tarifa){return 'C_tarifario/eliminar/'.$empresa.'/'.$tarifa;};

//Tipo de Cambio
$route['cambios'] = 'C_tipo_cambio';
$route['cambio/nuevo'] = 'C_tipo_cambio/nuevo';
$route['cambio/crear'] = 'C_tipo_cambio/crear';
$route['cambio/(:num)/(:num)/eliminar'] = function ($empresa ,$cambio){return 'C_tipo_cambio/eliminar/'.$empresa.'/'.$cambio;};


//API
$route['api/tarifa/(:num)/(:num)/(:num)/(:num)'] = function ($empresa, $sede, $cliente, $servicio){return 'C_api/tarifa/'.$empresa.'/'.$sede.'/'.$cliente.'/'.$servicio;};
$route['api/ubicacion'] = function (){return 'C_api/ubicacion'; };
$route['api/tarifavalidar'] = function (){return 'C_api/tarifaValidar'; };
$route['api/clientevalidar'] = function (){return 'C_api/clienteValidar'; };
$route['api/personavalidar'] = function (){return 'C_api/personaValidar'; };
$route['api/validartipocambio'] = function (){return 'C_api/validartipocambio'; };
$route['api/listar_tipo_cambio'] = function (){return 'C_api/listar_tipo_cambio'; };

$route['api/acuerdos/periodos'] = function (){return 'C_api/acuerdos_periodos'; };
$route['api/acuerdos/periodo/guardar'] = function (){return 'C_api/acuerdos_periodos_guardar'; };

$route['api/sedes_guardar'] = function (){return 'C_api/sedes_guardar'; };
$route['api/tarifas'] = function (){return 'C_api/tarifas'; };
$route['api/ordenservicio'] = function (){return 'C_api/ordenservicio'; };
$route['api/execsp'] = function (){return 'C_api/execsp'; };
$route['api/uploadfile'] = function (){return 'C_api/uploadfile'; };
$route['api/crear'] = function (){return 'C_api/crearC'; };

$route['sistema/sync'] = function (){return 'C_system/sync'; };
$route['sistema/log'] = function (){return 'C_system/log'; };
$route['sistema/revisar'] = function (){return 'C_system/revisar'; };

$route['ind_ser_cliente'] = function (){return 'C_ind_ser_cliente'; };
$route['ind_ser_mes'] = function (){return 'C_ind_ser_mes'; };

$route['ind_alq_cliente'] = function (){return 'C_alquiler_indicadores/cliente'; };
$route['ind_alq_mes'] = function (){return 'C_alquiler_indicadores/mes'; };

$route['ind_vis_cliente'] = function (){return 'C_visitas_indicadores/cliente'; };
$route['ind_tiempo_ent'] = function (){return 'C_recepcion_indicadores/cliente'; };


//bloqueo

$route['bloqueos'] = 'C_bloqueo';
$route['bloqueos/nuevo'] = 'C_bloqueo/nuevo';
$route['bloqueos/bloquear'] = 'C_bloqueo/crea_bloqueo';

//ingreso
//$route['ingreso'] = 'C_ingreso';
$route['ingreso'] = 'C_ingreso';

$route['ingreso/prueba'] = 'C_ingreso/prueba';//este solo es prueba
//$route['ingreso/prueba'] = 'C_ingreso/prueba';//este solo es prueba
$route['ingreso/prueba2'] = 'C_ingreso/prueba2';//este solo es prueba




$route['ingreso/nuevo'] = 'C_ingreso/nuevo';
$route['ingreso/nuevoalterno'] = 'C_ingreso/nuevoalterno';
$route['ingreso/nuevotrabajador'] = 'C_ingreso/nuevotrabajador';
$route['ingreso/crear'] = 'C_ingreso/crearC';
$route['ingreso/(:num)/eliminar'] = function ($id){return 'C_ingreso/delete/'.$id;};
$route['ingreso/(:num)/confirmar_ingreso'] = function ($id){return 'C_ingreso/confirmar_ingreso/'.$id;};
$route['salida/(:num)/confirmar_salida'] = function ($id){return 'C_ingreso/confirmar_salida/'.$id;};
$route['ingreso/reporte/(:num)'] = function ($id){return 'C_ingreso/reporte/'.$id;};
$route['ingreso/exportar'] = 'C_ingreso/exportar2excel';
$route['ingreso/exportaraqpcallao'] = 'C_ingreso/exportaraqpcallao';

//persona
$route['personas'] = 'C_persona';
$route['personas/nuevo'] = 'C_persona/nuevo';
$route['personas/crear'] = 'C_persona/crear';
$route['personas/(:num)/(:num)/editar'] = function ($empresa , $persona){return 'C_persona/editar/'.$empresa.'/'.$persona;};
$route['personas/(:num)/(:num)/actualizar'] = function ($empresa , $persona){return 'C_persona/actualizar/'.$empresa.'/'.$persona;};
$route['personas/(:num)/eliminar'] = function ($id){return 'C_persona/eliminar/'.$id;};

//Mesa de partes 
//Recepción de documentos
$route['recepcion_doc'] = 'C_recepcion_doc';
$route['recepcion_doc/nuevo'] = 'C_recepcion_doc/nuevo';
$route['recepcion_doc/(:num)/editar'] = function ($id) {return 'C_recepcion_doc/editar/'.$id;};
$route['recepcion_doc/(:num)/eliminar'] = function ($id){return 'C_recepcion_doc/eliminar/'.$id;};


//Revision de documentos
$route['revision_doc'] = 'C_revision_doc';
$route['revision_doc/(:num)/aceptar'] = function ($id){return 'C_revision_doc/aceptar/'.$id;};
$route['revision_doc/(:num)/rechazar'] = function ($id){return 'C_revision_doc/rechazar/'.$id;};

//Reasignacion documento
$route['reasignar_doc'] = 'C_reasignar_doc';

//SOLICITUD ABASTECIMIENTO
$route['solicitudabastecimiento'] = 'C_solicitudabastecimiento';
$route['solicitudabastecimiento/contador'] = 'C_solicitudabastecimiento/contador';
$route['solicitudabastecimiento/nuevo'] = 'C_solicitudabastecimiento/nuevo';
$route['solicitudabastecimiento/crear'] = 'C_solicitudabastecimiento/crear';
$route['solicitudabastecimiento/do_upload'] = 'C_solicitudabastecimiento/do_upload';
$route['solicitudabastecimiento/validate'] = 'C_solicitudabastecimiento/validate';
$route['solicitudabastecimiento/autorizar'] = 'C_solicitudabastecimiento/autorizar';

//INFO
$route['info/validate'] = 'C_info/validate';
$route['info/updateprecio'] = 'C_info/updateprecio';
$route['info/edit'] = 'C_info/edit';
$route['info/conprecio'] = 'C_info/conprecio';
$route['info/pagoins'] = 'C_info/pagoins';
$route['info/detpagolist'] = 'C_info/detpagolist';
$route['info/detcullist'] = 'C_info/detcullist';
$route['info/aprobarsolicitud'] = 'C_info/aprobarsolicitud';
$route['info/reportlist'] = 'C_info/reportlist';
$route['info/reporteins'] = 'C_info/reporteins';
$route['info/finalrepor'] = 'C_info/finalrepor';
$route['info/aprobarpago'] = 'C_info/aprobarpago';

//Reporte Excel
$route['movimientopersona/reporte'] = 'C_MovimientoPersonaExcel/exportar2excel';

//ReportesVisitantes
$route['reportevisitantes'] = 'C_reportevisitantes';
$route['info/reporte'] = 'C_info/reporte';

//Importar
$route['importaralquileres'] = 'C_importaralquileres';
$route['importaralquileres/import'] = 'C_importaralquileres/import';

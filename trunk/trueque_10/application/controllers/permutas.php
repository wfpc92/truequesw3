<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permutas extends CI_Controller {

    function Permutas() {
        parent::__construct();
        $this->load->model('permutaModel');
    }

    public function index() {
        $data['sideSelect']=3;
        $data['activo'] = 2;
        $data['contenido'] = 'usuario/propuestasRecibidas';
        $data['title'] = 'Propuestas Recibidas';
        $data['sidebar'] = 'sidebarMiCuenta';
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre'])) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['usuarioActual'] = $usuarioActual;
            if ($usuarioActual['usuario_nivel'] == 0) {
                $data['menu'] = 'menuAdministrador';
            }
        } else {
            $data['sesion'] = 'sesionLogin';
            $data['menu'] = 'menuEstandar';
        }
        $current= $usuarioActual['usuario_id'];
        $this->load->library('pagination');
        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url().'permutas/index';
        $opciones['total_rows'] = $this->permutaModel->getNumPermutas($current);
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';
        $this->pagination->initialize($opciones);
        $permutas= $this->permutaModel->getPermutas($current,$opciones['per_page'], $this->uri->segment(3));
        $data['permutas'] = $permutas;
        $data['paginacion']= $this->pagination->create_links();
        //FIN_PAGINACION...
        $this->load->view('plantilla', $data);
    }
    
    function permutar($peticion){
        $this->permutaModel->hacerPermuta($peticion);
        $data=array();
        $usuarioActual = $this->session->all_userdata();
        $data['usuarioActual']=$usuarioActual;
        $data['title']='Solicitud enviada';
        $data['menu']='menuUsuario';
        $data['sesion']='sesionUsuario';
        $data['sidebar']='sidebarMiCuenta';
        $data['contenido']='estandar/exito';
        list($recibe, $solicita, $usu_recibe, $usu_solicita) = explode(".", $peticion);  
        $id_producto = $solicita;
        $id_usuario = $usu_recibe;
        $data['mensajeAprobacion']=
           'Trueque realizado correctamente.  <br/>
            Puedes ver tu nuevo producto truequeado <a href=\'http://localhost/trueque_10/productos/verProducto/'.$id_producto.'\'>aqu&iacute;</a>.   <br/> 
            El producto Truequeado ya aparece en la lista de tus productos, ver <a href=\'http://localhost/trueque_10/miCuenta/productosNoPublicados\'>aqu&iacute;</a>.    <br/>
            Haz tu donaci&oacute;n voluntaria <a href=\'http://localhost/trueque_10/miCuenta/donacion\'>aqu&iacute;</a>.</h2> ';
        $this->load->view('plantilla',$data);
    }
    
    function rechazar($peticion){
        $this->permutaModel->rechazarPermuta($peticion);
        redirect('permutas');
        
    }
    function permutasEnviadas(){
        $data['sideSelect']=4;
        $data['activo'] = 2;
        $data['contenido'] = 'usuario/propuestasEnviadas';
        $data['title'] = 'Propuestas Enviadas';
        $data['sidebar'] = 'sidebarMiCuenta';
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre'])) {
            $data['sesion'] = 'sesionUsuario';
            $data['menu'] = 'menuUsuario';
            $data['usuarioActual'] = $usuarioActual;
            if ($usuarioActual['usuario_nivel'] == 0) {
                $data['menu'] = 'menuAdministrador';
            }
        } else {
            $data['sesion'] = 'sesionLogin';
            $data['menu'] = 'menuEstandar';
        }
        $current= $usuarioActual['usuario_id'];
        $this->load->library('pagination');
        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url().'permutas/permutasEnviadas';
        $opciones['total_rows'] = $this->permutaModel->getNumPermutasEnviadas($current);
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';
        $this->pagination->initialize($opciones);
        $permutas= $this->permutaModel->getPermutasEnviadas($current,$opciones['per_page'], $this->uri->segment(3));
        $data['permutas'] = $permutas;
        $data['paginacion']= $this->pagination->create_links();
        //FIN_PAGINACION...
        $this->load->view('plantilla', $data);
    }
}
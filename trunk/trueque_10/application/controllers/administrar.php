<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrar extends CI_Controller {

    function _construct() {
        parent::_construct();
    }

    public function index() {
        $data['titulo'] = "administrar";
	$data['activo'] = 2;
        $data['sideSelect']=0;
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $this->load->library('pagination');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $data['title'] = 'Crud Usuarios';
            $data['sesion'] = 'sesionUsuario';
            $data['contenido'] = 'administrador/adminUsuarios';
            $data['usuarioActual'] = $usuarioActual;
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            
            //PAGINACION...
            $opciones = array();
            $opciones['per_page'] = 5;
            $opciones['base_url'] = base_url().'administrar/index/';
            $opciones['total_rows'] = $this->usuariosModel->numUsuarios();
            $opciones['uri_segment'] = 3;
            $opciones['num_links'] = 3;
            $opciones['first_link'] = 'Primero';
            $opciones['last_link'] = 'Ultimo';
            $this->pagination->initialize($opciones);
            $data['paginacion']= $this->pagination->create_links();
            $data['usuarios'] = $this->usuariosModel->getUsuarios($opciones['per_page'], $this->uri->segment(3));//FIN_PAGINACION...
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function updateUsuario() {
        $data['sideSelect']=0;
        $data['activo'] = 2;
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $data['title'] = 'Editar Usuario';
            $data['sesion'] = 'sesionUsuario';
            $data['contenido'] = 'administrador/editarUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            $data['usuario'] = $this->usuariosModel->getUsuario($_POST['usuario_id']);
            $data['ciudades'] = $this->productoModel->cargarCiudad();
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function guardarUsuario() {
        $data['sideSelect']=0;
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $usuarioInfo = $this->input->post('usuario');
        $usuarioInfo['id_ciudad'] = $this->input->post('ciudad');
        $this->usuariosModel->setUsuario($usuarioInfo);
        redirect('administrar');
    }

    public function deleteUsuario() {
        $data['sideSelect']=0;
        $data['activo'] = 2;
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $data['title'] = 'Eliminar Usuario';
            $data['sesion'] = 'sesionUsuario';
            $data['contenido'] = 'administrador/borrarUsuario';
            $data['usuarioActual'] = $usuarioActual;
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            $data['usuario'] = $this->usuariosModel->getUsuario($_POST['usuario_id']);
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function borrarUsuario() {
        $data['sideSelect']=0;
        $this->load->model('usuariosModel');
        $id = $this->input->post('id');
        $data['titulo'] = "administrar";
	$data['activo'] = 2;
        $data['sideSelect']=0;
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $ok=$this->usuariosModel->borrarUsuario($id);
            $data['title'] = 'Mensaje Confirmacion';
            $data['sesion'] = 'sesionUsuario';
            if($ok==TRUE){
                $data['contenido'] = 'estandar/exito';
                $data['mensajeAprobacion']='El Usuario Fue Eliminado con Exito <br/>
                    <a href=\'http://localhost/trueque_10/administrar\'>Volver</a>';
            }
            else{
                $data['contenido'] = 'estandar/error';
                $data['mensajeAprobacion']='Error al Eliminar Usuario, Tiene Productos Asociados <br/>
                    <a href=\'http://localhost/trueque_10/administrar\'>Volver</a>';
            }
            $data['usuarioActual'] = $usuarioActual;
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }     
    }
    public function  estadisticasTrueque(){
        $data['sideSelect']=1;
        $data['activo'] = 2;
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $this->load->model('permutaModel');
            $data['title'] = 'Estadistica Trueques';
            $data['sesion'] = 'sesionUsuario';
            if($_POST['tipo_grafica']==0){
                $data['contenido'] = 'administrador/estadisticasTrueque';
            }
            else{
                $data['contenido'] = 'administrador/estadisticasTortaTrueque';
            }
            $data['usuarioActual'] = $usuarioActual;
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            $this->form_validation->set_rules('anio', 'anio',
            'trim|required|xss_clean|numeric');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('numeric', 'El campo %s debe contener unicamente numeros');
            
         if ($this->form_validation->run() == TRUE) {
            $anio=$_POST['anio'];
            $reporte=$this->permutaModel->crearReportes($anio);
            $series_data[]=array('name'=>'Trueques','data'=>array(
                array('Enero',$reporte[0]),array('Febrero',$reporte[1]),array('Marzo',$reporte[2]),
                array('Abril',$reporte[3]),array('Mayo',$reporte[4]),array('Junio',$reporte[5]),
                array('Julio',$reporte[6]),array('Agosto',$reporte[7]),array('Septiembre',$reporte[8]),
                array('Octubre',$reporte[9]),array('Noviembre',$reporte[10]),array('Diciembre',$reporte[11])));
            $data['reporte']= json_encode($series_data);
         }
         else{
             $data['contenido'] = 'administrador/seleccionarAnio';
        }
        $this->load->view('plantilla', $data);
        }else {
            redirect(base_url());
        }
 }
    public function seleccionarAnio(){
        $data['sideSelect']=1;
        $data['activo'] = 2;
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $this->load->model('permutaModel');
            $data['title'] = 'Estadistica Trueques';
            $data['sesion'] = 'sesionUsuario';
            $data['contenido'] = 'administrador/seleccionarAnio';
            $data['usuarioActual'] = $usuarioActual;
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

public function  estadisticasPublicaciones(){
    $data['sideSelect']=2;
        $data['activo'] = 2;
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $this->load->model('permutaModel');
            $data['title'] = 'Estadistica Trueques';
            $data['sesion'] = 'sesionUsuario';
            if($_POST['tipo_grafica']==0){
                $data['contenido'] = 'administrador/estadisticasPublicaciones';
            }
            else{
                $data['contenido'] = 'administrador/estadisticasTortaPublicaciones';
            }
            $data['usuarioActual'] = $usuarioActual;
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            $this->form_validation->set_rules('anio', 'anio',
            'trim|required|xss_clean|numeric');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('numeric', 'El campo %s debe contener unicamente numeros');
            
         if ($this->form_validation->run() == TRUE) {
            $anio=$_POST['anio'];
            $reporte=$this->permutaModel->crearReportesPublicaciones($anio);
            $series_data[]=array('name'=>'Publicaciones','data'=>array(
                array('Enero',$reporte[0]),array('Febrero',$reporte[1]),array('Marzo',$reporte[2]),
                array('Abril',$reporte[3]),array('Mayo',$reporte[4]),array('Junio',$reporte[5]),
                array('Julio',$reporte[6]),array('Agosto',$reporte[7]),array('Septiembre',$reporte[8]),
                array('Octubre',$reporte[9]),array('Noviembre',$reporte[10]),array('Diciembre',$reporte[12])));
            $data['reporte']= json_encode($series_data);
         }
         else{
             $data['contenido'] = 'administrador/seleccionarAnioP';
        }
        $this->load->view('plantilla', $data);
        }else {
            redirect(base_url());
        }
 }
    public function seleccionarAnioP(){
        $data['sideSelect']=2;
        $data['activo'] = 2;
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $this->load->model('permutaModel');
            $data['title'] = 'Estadistica Trueques';
            $data['sesion'] = 'sesionUsuario';
            $data['contenido'] = 'administrador/seleccionarAnioP';
            $data['usuarioActual'] = $usuarioActual;
            $data['menu'] = 'menuAdministrador';
            $data['sidebar'] = 'sidebarAdministrar';
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }
    public function todosTrueques(){
        $data['sideSelect']=3;
        $data['activo'] = 2;
        $this->load->model('permutaModel');
        $data['contenido'] = 'administrador/todosTrueques';
        $data['title'] = 'Ver Permutas';
        $data['sidebar'] = 'sidebarAdministrar';
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
        $this->load->library('pagination');
        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url().'administrar/todosTrueques';
        $opciones['total_rows'] =  $this->permutaModel->getNumTodasPermutas();
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';
        $this->pagination->initialize($opciones);
        $permutas= $this->permutaModel->getTodasPermutas($opciones['per_page'], $this->uri->segment(3));
        $data['permutas'] = $permutas;
        $data['paginacion']= $this->pagination->create_links();
        //FIN_PAGINACION...
        $this->load->view('plantilla', $data);
}
}

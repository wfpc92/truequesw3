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

    public function updateUsuario($id) {
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
            $data['usuario'] = $this->usuariosModel->getUsuario($id);
            $data['ciudades'] = $this->productoModel->cargarCiudad();
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function guardarUsuario() {
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
        $usuarioInfo = $this->input->post('usuario');
        $usuarioInfo['id_ciudad'] = $this->input->post('ciudad');
        $this->usuariosModel->setUsuario($usuarioInfo);
        redirect('administrar');
    }

    public function deleteUsuario($id) {
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
            $data['usuario'] = $this->usuariosModel->getUsuario($id);
            $this->load->view('plantilla', $data);
        } else {
            redirect(base_url());
        }
    }

    public function borrarUsuario() {
        $this->load->model('usuariosModel');
        $id = $this->input->post('id');
        $this->usuariosModel->borrarUsuario($id);
        redirect('administrar');
    }
    public function  estadisticasTrueque(){
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $this->load->model('permutaModel');
            $data['title'] = 'Estadistica Trueques';
            $data['sesion'] = 'sesionUsuario';
            $data['contenido'] = 'administrador/estadisticasTrueque';
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
            $series_data[]=array('name'=> $anio,'data'=>$reporte);
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
        $usuarioActual = $this->session->all_userdata();
        if (isset($usuarioActual['nombre']) && $usuarioActual['usuario_nivel'] == 0) {
            $this->load->model('permutaModel');
            $data['title'] = 'Estadistica Trueques';
            $data['sesion'] = 'sesionUsuario';
            $data['contenido'] = 'administrador/estadisticasPublicaciones';
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
            $series_data[]=array('name'=> $anio,'data'=>$reporte);
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

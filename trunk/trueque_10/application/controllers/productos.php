<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
class Productos extends CI_Controller {

    function Productos() {
        parent::__construct();
        $this->load->model('productoModel');
    }

    public function index() {
        $data['contenido'] = 'estandar/inicio';
        $data['title'] = 'Trueque Inicio';
        $data['sidebar'] = 'sidebarCategorias';
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

        //PAGINACION...
        $this->load->library('pagination');

        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url() . 'productos/index';
        $opciones['total_rows'] = $this->productoModel->getNumProductos();
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';


        $this->pagination->initialize($opciones);
        $productos = $this->productoModel->getTodosProductos($opciones['per_page'], $this->uri->segment(3));
        $data['productos'] = $productos;
        //FIN_PAGINACION...

        $this->load->view('plantilla', $data);
    }

    public function verProducto($id) {
        $data['title'] = 'Trueque verProducto';
        $data['sidebar'] = 'sidebarCategorias';
        $data['contenido'] = 'estandar/verProducto';
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
        $data['producto'] = $this->productoModel->getProducto($id);
        $this->load->view('plantilla', $data);
    }

    public function verUsuario($id) {
        $data['title'] = 'Trueque verUsuario';
        $data['sidebar'] = 'sidebarCategorias';
        $data['contenido'] = 'estandar/verUsuario';
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
        $this->load->view('plantilla', $data);
    }

    public function buscarProducto() {

        static $criterio;
        $criterio = $this->input->post('buscar');

        $data['title'] = 'Trueque Buscar Producto';
        $data['sidebar'] = 'sidebarCategorias';
        $data['contenido'] = 'estandar/inicio';
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
        // $data['productos'] = $this->productoModel->buscarProductos($criterio);
        //PAGINACION
        $cantidad = $this->productoModel->numBuscarProducto($criterio);
        $this->load->library('pagination');

        $opciones = array();
        $opciones['per_page'] = 2;
        $opciones['base_url'] = base_url() . 'productos/buscarProducto';
        //$opciones['total_rows'] = $productos->num_rows();
        $opciones['total_rows'] = $cantidad;

        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';

        $this->pagination->initialize($opciones);
        $productos = $this->productoModel->buscarProductos($criterio, $opciones['per_page'], $this->uri->segment(3));
        $data['productos'] = $productos;
        //FIN_PAGINACION


        $this->load->view('plantilla', $data);
    }

    public function busquedaAvanzada() {
        $data['title'] = 'Trueque Buscar Producto';
        $data['sidebar'] = 'sidebarCategorias';
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
        $data['contenido'] = 'estandar/busquedaAvanzada';
        $data['categoria'] = $this->productoModel->cargarCategoria();
        $data['ciudades'] = $this->productoModel->cargarCiudad();

        $this->load->view('plantilla', $data);
    }

    public function busquedaAvanzadaProducto() {

        $data['title'] = 'Trueque Buscar Producto';
        $data['sidebar'] = 'sidebarCategorias';
        $data['contenido'] = 'estandar/inicio';
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


        $categoria = $_POST['categorias'];
        $desde = $_POST['fechaIngreso'];

        $hasta = $_POST['hasta'];
        $ciudad = $_POST['ciudades'];
        $data['productos'] = $this->productoModel->busquedaAvanzada($categoria, $desde, $hasta, $ciudad);
        $this->load->view('plantilla', $data);
    }
    
    /*sidebar*/
    
    function getAntiguedades(){
        $this->getProductosSide(1);
    }

    function getCamaras(){
        $this->getProductosSide(2);
    }
    
    function getCasas(){
        $this->getProductosSide(3);
    }
    
    function getCelulares(){
        $this->getProductosSide(4);
    }
    
    function getCine(){
        $this->getProductosSide(5);
    }
    
    function getComputadores(){
        $this->getProductosSide(6);
    }
    
    function getDeporte(){
        $this->getProductosSide(7);
    }
    
    function getElectrodomesticos(){
        $this->getProductosSide(8);
    }
    
    function getJoyas(){
        $this->getProductosSide(9);
    }
    
    function getJuguetes(){
        $this->getProductosSide(10);
    }
    
    function getLibros(){
        $this->getProductosSide(11);
    }
    
    function getLicores(){
        $this->getProductosSide(12);
    }
    
    function getMusica(){
        $this->getProductosSide(13);
    }
    
    function getVehiculos(){
        $this->getProductosSide(14);
    }
    
    function getVideojuegos(){
        $this->getProductosSide(15);
    }
    
    function getOtros(){
        $this->getProductosSide(16);
    }
    
    public function getProductosSide($categoria){

         $data['contenido'] = 'estandar/inicio';
         $data['title'] = 'Trueque Inicio';
         $data['sidebar'] = 'sidebarCategorias';
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
        //PAGINACION...
        $this->load->library('pagination');

        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url() . 'productos/index';
        $opciones['total_rows'] = $this->productoModel->getNumProductosCategoria($categoria);
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';


        $this->pagination->initialize($opciones);
        $productos = $this->productoModel->getCamaras($opciones['per_page'], $this->uri->segment(3),$categoria);
        $data['productos'] = $productos;
        //FIN_PAGINACION...

        $this->load->view('plantilla', $data);

  
    }
    

}
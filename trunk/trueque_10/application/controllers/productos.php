<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
class Productos extends CI_Controller {
    function Productos() {
        parent::__construct();
        $this->load->model('productoModel');
        $this->load->library('pagination');
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
        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url().'productos/index/';
        $opciones['total_rows'] = $this->productoModel->getNumProductos();
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';
        $this->pagination->initialize($opciones);
        $productos = $this->productoModel->getTodosProductos($opciones['per_page'], $this->uri->segment(3));
        $data['productos'] = $productos;
        $data['paginacion']= $this->pagination->create_links();
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
        if(isset($_POST['buscar'])){
            $criterio = $this->input->post('buscar');
             $this->session->set_userdata('buscar',$criterio);
        }
        else{
            $criterio=$this->session->userdata('buscar');
        }
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
        //PAGINACION
        $cantidad = $this->productoModel->numBuscarProducto($criterio);
        $this->load->library('pagination');

        $opciones = array();
        $opciones['per_page'] = 2;
        $opciones['base_url'] = base_url() . 'productos/buscarProducto';
        $opciones['total_rows'] = $cantidad;
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';

        $this->pagination->initialize($opciones);
        $productos = $this->productoModel->buscarProductos($criterio, $opciones['per_page'], $this->uri->segment(3));
        $data['productos'] = $productos;
        $data['paginacion']= $this->pagination->create_links();
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
        $productos = $this->productoModel->busquedaAvanzada($categoria, $desde, $hasta, $ciudad);
        $data['productos'] = $productos;
        
        $this->load->view('plantilla', $data);
    }
    public function getProductosSide($categoria=null){
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
        if(isset($categoria) && $categoria!=null && $categoria!=$this->session->userdata('numProdPag')){
            $categoria=  $this->obtenerIdCategoria($categoria);
            $this->session->set_userdata('categoria',$categoria);
            $this->session->set_userdata('numProdPag',5);
        }
        else{
            $categoria=$this->session->userdata('categoria');
        }
        $opciones = array();
        $opciones['per_page'] = 5;
        $opciones['base_url'] = base_url(). 'productos/getProductosSide';
        $opciones['total_rows'] = $this->productoModel->getNumProductosCategoria($categoria);
        $opciones['uri_segment'] = 3;
        $opciones['num_links'] = 3;
        $opciones['first_link'] = 'Primero';
        $opciones['last_link'] = 'Ultimo';


        $this->pagination->initialize($opciones);
        $productos = $this->productoModel->getCamaras($opciones['per_page'], $this->uri->segment(3),$categoria);
        $data['productos'] = $productos;
        $data['paginacion']= $this->pagination->create_links();
        //FIN_PAGINACION...

        $this->load->view('plantilla', $data);

  
    }
    public function obtenerIdCategoria($nombre){
        echo $nombre;
        $categoria="";
        switch ($nombre){
                case "cine":
                    $categoria=1;
                    break;
                case "electrodomesticos":
                    $categoria=2;
                    break;
                case "videojuegos":
                    $categoria=3;
                    break;
                case "vehiculos":
                    $categoria=4;
                    break;
                case "musica":
                    $categoria=5;
                    break;
                case "antiguedades":
                    $categoria=6;
                    break;
                case "deportes":
                    $categoria=7;
                    break;
                case "libros":
                    $categoria=8;
                    break;
                case "camaras":
                    $categoria=9;
                    break;
                case "celulares":
                    $categoria=10;
                    break;
                case "computadores":
                    $categoria=11;
                    break;
                case "joyas":
                    $categoria=12;
                    break;
                case "casas":
                    $categoria=13;
                    break;
                case "juguetes":
                    $categoria=14;
                    break;
                case "licores":
                    $categoria=15;
                    break;
                case "otras":
                    $categoria=16;
                    break;
            }
            return $categoria;
    }
}
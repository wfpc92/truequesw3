<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//
class MiCuenta extends CI_Controller {
	function _construct(){
		parent::_construct();
	}
	
	public function index()
	{
		$this->load->model('productoModel');
		$data['title']='Trueque Mi Cuenta';
        $usuarioActual=$this->session->all_userdata();
        if(isset($usuarioActual['nombre']))
            {
                $data['sesion']='sesionUsuario';
                $data['menu']='menuUsuario';
                $data['contenido']='misProductos';
                $data['usuarioActual'] = $usuarioActual;
                $data['sidebar']='sidebarMiCuenta';
                $data['productos'] = $this->productoModel->getMisProductos($usuarioActual['usuario_id']);
            }   
            else
            {
                $data['sesion']='sesionLogin';
                $data['menu']='menuEstandar';
                $data['contenido']='contenido';
                $data['sidebar']='sidebarCategorias';
            }
        
        $this->load->view('plantilla', $data);
	}

    public function truequear($idProdTrueque){
        $this->load->model('productoModel');
        $data['title']='Trueque Truequear';
        $usuarioActual=$this->session->all_userdata();
        if(isset($usuarioActual['nombre']))
            {
                $data['sesion']='sesionUsuario';
                $data['menu']='menuUsuario';
                $data['contenido']='misProductosSeleccionar';
                $data['usuarioActual'] = $usuarioActual;
                $data['sidebar']='sidebarCategorias';
                $data['productos'] = $this->productoModel->getMisProductos($usuarioActual['usuario_id']);
                $data['idProdTrueque']=$idProdTrueque;
            }   
            else
            {
                $data['sesion']='sesionLogin';
                $data['menu']='menuEstandar';
                $data['contenido']='contenido';
                $data['sidebar']='sidebarCategorias';
            }
        
        $this->load->view('plantilla', $data);
    }
    public function hacerTrueque(){

    }
}
?>
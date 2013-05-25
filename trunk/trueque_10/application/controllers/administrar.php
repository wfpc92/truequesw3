<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrar extends CI_Controller {
	function _construct(){
		parent::_construct();
	}
	
	public function index()
	{
		$this->load->model('usuariosModel');
		$data['title']='Trueque Mi Cuenta';
        $usuarioActual=$this->session->all_userdata();
        if(isset($usuarioActual['nombre']))
            {
                $data['sesion']='sesionUsuario';
                $data['menu']='menuUsuario';
                $data['contenido']='adminUsuarios';
                $data['usuarioActual'] = $usuarioActual;
                $data['sidebar']='sidebarMiCuenta';
                $data['usuarios'] = $this->usuariosModel->getUsuarios();
                if($usuarioActual['usuario_nivel']==0){
                    $data['menu']='menuAdministrador';
                    $data['sidebar']='sidebarAdministrar';
                }
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

}
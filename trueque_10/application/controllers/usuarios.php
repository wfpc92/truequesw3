<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//
class Usuarios extends CI_Controller {
	//este es el constructor de la clase.
	function Usuarios(){
		/*se hace el llamado al constructor del padre.*/
		parent::__construct();
		/*se cargan los modelos que necesitemos 
		para nuestro controlador:*/
		//$this->load->model('booksModel');
		$this->load->model('usuariosModel');
        $this->load->model('productoModel');
	}

	function registrar(){
        $data['sesion']='sesionLogin';
        $data['menu']='menuEstandar';
        $data['contenido']='estandar/registrar';
        $data['title']='Trueque Registrar';
        $data['sidebar']='sidebarCategorias';
		if($_POST) {
			$config = array(
					array(
                            'field' => 'nombre',
                            'label' => 'Nombre',
                            'rules' => 'trim|required'
                    ),
                    array(
                            'field' => 'apellido',
                            'label' => 'Apellido',
                            'rules' => 'trim|required'
                    ),
                    array(
                            'field' => 'email',
                            'label' => 'E-mail',
                            'rules' => 'trim|required|is_unique[usuarios.email]|valid_email'
                    ),
                    array(
                            'field' => 'confirmaremail',
                            'label' => 'Confirmar E-mail',
                            'rules' => 'trim|required|matches[email]'
                    ),
                    array(
                            'field' => 'contrasena',
                            'label' => 'Contraseña',
                            'rules' => 'trim|required'
                    ),
                    array(
                            'field' => 'confirmarcontrasena',
                            'label' => 'Confirmar Contraseña',
                            'rules' => 'trim|required|matches[contrasena]'
                    )
            );
            $this->load->library('form_validation');
            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('is_unique', 'Este email ya esta registrado');
            $this->form_validation->set_message('matches', 'El campo %s No coinside');

            if($this->form_validation->run() == FALSE) {
                    $data['errores'] = validation_errors();
            } else {
                    $data['usuario'] = array(
                    		'nombre' => $_POST['nombre'],
                    		'apellido' => $_POST['apellido'],
                            'email' => $_POST['email'],
                            'contrasena' => sha1($_POST['contrasena'])
                    );
                    $id = $this->usuariosModel->registrar($data['usuario']);
                    if($id) {
                    	$this->session->set_userdata('usuario_id', $id);
                    	$this->session->set_userdata('nombre', $_POST['nombre']);
                    	$this->session->set_userdata('usuario_nivel', 1);
                        redirect(base_url());
                    }
            }
		}
        
		$this->load->view("plantilla",$data);
	}
	public function login() {
        if($_POST) {
            $email = $this->input->post('email', true);
            $contrasena = $this->input->post('contrasena', true);
            $usuarioActual = $this->usuariosModel->login($email, $contrasena);
            if(!$usuarioActual) {
                redirect(base_url());
            } else {
                $this->session->set_userdata('usuario_id', $usuarioActual['usuario_id']);
                $this->session->set_userdata('usuario_nivel', $usuarioActual['nivel']);
                $this->session->set_userdata('nombre', $usuarioActual['nombre']);
                redirect(base_url());
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function email(){
        $data['contenido']='estandar/email';
        $data['title']='Trueque enviar Contrasena';
        $data['sidebar']='sidebarCategorias';
        $data['sesion']='sesionLogin';
        $data['menu']='menuEstandar';
        $this->load->view('plantilla',$data);
    }
}
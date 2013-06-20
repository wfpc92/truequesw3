<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
class Usuarios extends CI_Controller {

    //este es el constructor de la clase.
    function Usuarios() {
        /* se hace el llamado al constructor del padre. */
        parent::__construct();
        /* se cargan los modelos que necesitemos 
          para nuestro controlador: */
        //$this->load->model('booksModel');
        $this->load->model('usuariosModel');
        $this->load->model('productoModel');
    }

    function registrar() {
        $data['activo'] = 1;
        $data=  $this->cargarEstandar();
        $data['title'] = 'Trueque Registrar';
        $data['contenido']='estandar/registrar';
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'nombre',
                    'label' => 'Nombre',
                    'rules' => 'trim|required|callback_seguraSQL'
                ),
                array(
                    'field' => 'apellido',
                    'label' => 'Apellido',
                    'rules' => 'trim|required|callback_seguraSQL'
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
            $this->form_validation->set_message('matches', 'El campo %s no coincide');
            $this->form_validation->set_message('valid_email', 'El campo %s no corresponde a un Email');
            $this->form_validation->set_message('trim', 'El campo %s no corresponde a un Email');
            if ($this->form_validation->run() == FALSE) {
                $data['errores'] = validation_errors();
            } else {
                $data['usuario'] = array(
                    'nombre' => $_POST['nombre'],
                    'apellido' => $_POST['apellido'],
                    'email' => $_POST['email'],
                    'contrasena' => sha1($_POST['contrasena'])
                );
                $id = $this->usuariosModel->registrar($data['usuario']);
                if ($id) {
                    $usuarioActual = $this->usuariosModel->login($_POST['email'],$_POST['contrasena']);
                    $this->session->set_userdata('usuario_id', $usuarioActual['usuario_id']);
                    $this->session->set_userdata('usuario_nivel', $usuarioActual['nivel']);
                    $this->session->set_userdata('nombre', $_POST['nombre']);
                    $this->session->set_userdata('usuario_nivel', 1);
                    $this->session->set_userdata('avatar', 'http://localhost/trueque_10/images/avatar.jpg');
                    $data=  $this->cargarUsuario();
                    $usuarioActual = $this->session->all_userdata();
                    $data['usuarioActual']=$usuarioActual;
                    $data['contenido'] = 'estandar/exito';
                    $data['mensajeAprobacion']='Usuario Registrado</br> Ve a
                        <a href=\'http://localhost/trueque_10/miCuenta\'>Tu Cuenta</a> o <a href=\'http://localhost/trueque_10/productos\'>Mira los Productos</a>
                        <br/> Para empezar a Truequear';
                }
            }
        }

        $this->load->view("plantilla", $data);
    }

    public function login() {
        if ($_POST) {
            $this->form_validation->set_rules('email', 'Buscar', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('contrasena', 'Buscar', 'trim|required|xss_clean');
            $this->form_validation->set_message('required', 'El campo %s es requerido');
            $this->form_validation->set_message('valid_email', 'El campo %s debe ser un email');
            $this->form_validation->set_message('trim', 'No se admiten caracteres especiales');
            $this->form_validation->set_message('xss_clean', 'Codigo malicioso detectado');
            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email', true);
                $contrasena = $this->input->post('contrasena', true);
                $usuarioActual = $this->usuariosModel->login($email, $contrasena);
                if (isset($usuarioActual) && !$usuarioActual) {
                    $data = $this->cargarEstandar();
                    $data['contenido'] = 'estandar/error';
                    $data['mensajeAprobacion'] = 'Error al iniciar sesion</br>
                    <a href=\'http://localhost/trueque_10/usuarios/registrar\'>Registrate</a> o 
                    <a href=\'http://localhost/trueque_10/usuarios/email/\'>Recupera tu Contraseña</a>';
                } else {
                    $this->session->set_userdata('usuario_id', $usuarioActual['usuario_id']);
                    $this->session->set_userdata('usuario_nivel', $usuarioActual['nivel']);
                    $this->session->set_userdata('nombre', $usuarioActual['nombre']);
                    $this->session->set_userdata('avatar', $usuarioActual['avatar']);
                    redirect(base_url().'miCuenta');
                }
            }
            else{
                $data=  $this->cargarEstandar();
                $data['contenido']='estandar/error';
                $data['mensajeAprobacion'] = 'Error al iniciar sesion</br>
                Ingreso invalido de Datos';
            }
            $this->load->view('plantilla', $data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function email() {
        $data['activo'] = 1;
        $data['contenido'] = 'estandar/email';
        $data['title'] = 'Trueque enviar Contrasena';
        $data['sidebar'] = 'sidebarCategorias';
        $data['sesion'] = 'sesionLogin';
        $data['menu'] = 'menuEstandar';
        $this->load->view('plantilla', $data);
    }

    public function enviarContrasena() {
        $data['activo'] = 1;
        $data['sesion'] = 'sesionLogin';
        $data['menu'] = 'menuEstandar';
        $data['contenido'] = 'estandar/mensajeCorreoEnviado';
        $data['title'] = 'Trueque Registrar';
        $data['sidebar'] = 'sidebarCategorias';
        if ($_POST) {
            $config = array(
                array(
                    'field' => 'email',
                    'label' => 'E-mail',
                    'rules' => 'trim|required|callback_existe|valid_email'
                    ));
            $this->load->library('form_validation');
            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', 'El campo %s es requerido');

            ////////////////////////

            $receptor = $_POST['email'];
            $contrasena = $this->usuariosModel->obtenerContrasena($receptor);

            if ($contrasena != FALSE) {
                
                $this->email->set_newline("\r\n");
                $this->email->from('truequesoporte@gmail.com','Trueque.com');
                $this->email->to($receptor);
                $this->email->subject('Recuperacion de Contrasena de trueque.com');
                $link_recuperacion = 'http://localhost/trueque_10/usuarios/cambiar_contrasena/' . str_replace('@', '_', $receptor) . '-' . $contrasena['contrasena'];
                $mensaje = 'Dale clic a este enlace para recuperar tu contraseña: ' . $link_recuperacion;
                $this->email->message($mensaje);
                $this->email->send();
                $data['mensaje'] = 'Se env&iacute;o a su correo ' . $receptor . ' un link con el que podr&aacute; ingresar directamente a su cuenta.';//\n\n'.$this->email->print_debugger();
            } else {
                $data['mensaje'] = 'No existe la cuenta ' . $receptor . ' en el Sistema';
            }


            //////////////////////
            if ($this->form_validation->run() == FALSE) {
                $data['errores'] = validation_errors();
            }

            $this->load->view('plantilla', $data);
        }
    }

    function cambiar_contrasena($variable) {
        list($email, $contrasena) = explode('-', $variable);
        $email = str_replace('_', '@', $email);
        $usuarioActual = $this->usuariosModel->login_reactivacion($email, $contrasena);
        if (!$usuarioActual) {
            redirect(base_url());
        } else {
            $this->session->set_userdata('usuario_id', $usuarioActual['usuario_id']);
            $this->session->set_userdata('usuario_nivel', $usuarioActual['nivel']);
            $this->session->set_userdata('nombre', $usuarioActual['nombre']);
            $this->session->set_userdata('avatar', $usuarioActual['avatar']);
            $data['activo'] = 1;
            $data['sesion'] = 'sesionLogin';
            $data['menu'] = 'menuEstandar';
            $data['contenido'] = 'usuario/cambiarContrasena';
            $data['title'] = 'Donacion voluntaria';
            $data['sidebar'] = 'sidebarCategorias';
            $this->load->view('plantilla', $data);
        }
    }
    

    function existe($str) {
        $this->load->model('usuariosModel');
        $emails = $this->usuariosModel->getEmails($str);
        if ($emails != FALSE) {
            return TRUE;
        }
        $this->form_validation->set_message('No se encuentra el Email');
        return FALSE;
    }

    function seguraSQL($str) {
        if ((stripos($str, "or") !== false) || (stripos($str, "'") !== false)
                || (stripos($str, ";") !== false) || (stripos($str, "from") !== false)
                || (stripos($str, "drop") !== false) || (stripos($str, "delete") !== false)
                || (stripos($str, "alter") !== false) || (stripos($str, ",") !== false)
                || (stripos($str, "where") !== false) || (stripos($str, "and") !== false)
                || (stripos($str, "<") !== false) || (stripos($str, ">") !== false)
                || (stripos($str, "=") !== false)) {
            return FALSE;
        } else {
            $this->form_validation->set_message('seguraSQL', 'Su Ingreso esta considerado como un ataque a nuestra Base de datos');
            return TRUE;
        }
    }

    public function cargarEstandar() {
        $data['title'] = 'inicio';
        $data['sesion'] = 'sesionLogin';
        $data['menu'] = 'menuEstandar';
        $data['sidebar'] = 'sidebarCategorias';
        return $data;
    }
    public function cargarUsuario() {
        $data['title'] = 'inicio';
        $data['sesion'] = 'sesionUsuario';
        $data['menu'] = 'menuUsuario';
        $data['sidebar'] = 'sidebarMicuenta';
        return $data;
    }

}

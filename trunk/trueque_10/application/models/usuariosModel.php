<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class usuariosModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getUsuarios($limit, $start) {
        $this->db->limit($limit, $start);
        $data = $this->db->get('usuarios');
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }

    function getEmails($str) {
        $email = mysql_real_escape_string($str);
        $this->db->limit(1);
        $this->db->where('email', $email);
        $data = $this->db->get('usuarios');
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }

    function numUsuarios() {
         $data = $this->db->get('usuarios');
        if ($data->num_rows() > 0) {
            return $data->num_rows();
        } else {
            return FALSE;
        }
    }

    function registrar($data) {
        $id = $this->db->insert('usuarios', $data);
        return $id;
    }

    public function login($str1, $str2) {
        $email = mysql_real_escape_string($str1);
        $contrasena = mysql_real_escape_string($str2);
        $where = array(
            'email' => $email,
            'contrasena' => sha1($contrasena)
        );
        $this->db->select()->from('usuarios')->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->first_row('array');
        } else {
            return FALSE;
        }
    }

    public function login_reactivacion($email, $contrasena) {
        $where = array(
            'email' => $email,
            'contrasena' => $contrasena
        );
        $this->db->select()->from('usuarios')->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->first_row('array');
        } else {
            return FALSE;
        }
    }

    public function obtenerContrasena($receptor) {
        $this->db->select('contrasena')->from('usuarios')->where('email', $receptor);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->first_row('array');
        } else {
            return FALSE;
        }
    }

    function getUsuario($id) {
        $data = array();
        $this->db->select('usuario_id,nombre,apellido,email,id_ciudad,avatar');
        $this->db->where('usuario_id', $id);
        $this->db->limit(1);
        $consulta = $this->db->get('usuarios');
        if ($consulta->num_rows() > 0) {
            $data = $consulta->row();
        }
        $consulta->free_result();
        return $data;
    }
    
    function getUsuarioCiudad($id) {
        $data = array();
        $this->db->select('usuario_id,usuarios.nombre as nombre,apellido,email,id_ciudad,avatar,cuidad.nombre as ciudad');
        $this->db->from('usuarios');
        $this->db->join('cuidad', 'cuidad.id = usuarios.id_ciudad');
        $this->db->where('usuario_id', $id);
        $this->db->limit(1);
        $consulta = $this->db->get();
        if ($consulta->num_rows() > 0) {
            $data = $consulta->row();
        }
        $consulta->free_result();
        return $data;
    }

    function setUsuario($data) {
        $this->db->where('usuario_id', $data['usuario_id']);
        $this->db->update('usuarios', $data);
    }

    function borrarUsuario($id) {
            $this->db->where('usuario_id', $id);
            $this->db->limit(1);
            $this->db->delete('usuarios');
            if($this->db->_error_message()){
                return FALSE;
            }
            else {
                return TRUE;
            }
    }

    function cambiarContrasena($usuario_id, $nuevacontrasena) {
        $query = $this->db->query('UPDATE usuarios SET contrasena = \'' . sha1($nuevacontrasena) . '\' WHERE usuario_id = ' . $usuario_id);
    }

}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//
class usuariosModel extends CI_Model {

    //este es el constructor de la clase
    function __construct() {
        /* se hace el llamado al constructor del padre */
        parent::__construct();
    }

    /* obtener la lista de los libros desde la base de datos */

    function getUsuarios($limit,$start) {
        $this->db->limit($limit, $start);
        $data = $this->db->get('usuarios');
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
    function getEmails($str) {
        $email=mysql_real_escape_string($str);
        $this->db->limit(1);
        $this->db->where('email',$email);
        $data = $this->db->get('usuarios');
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
    function numUsuarios() {
        /* dentro de la variable data se van a guardar las tuplas correspondientes a la consulta get sobre la tabla usuarios en la base de datos */
        $data = $this->db->get('usuarios');
        /* se comprueba si se obtiene algun resultado y se retorna */
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
        $email=mysql_real_escape_string($str1);
        $contrasena=mysql_real_escape_string($str2);
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
    
    public function login_reactivacion($email, $contrasena){
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
    
    public function obtenerContrasena($receptor){
        $this->db->select('contrasena')->from('usuarios')->where('email',$receptor);
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

    function setUsuario($data) {
        $this->db->where('usuario_id', $data['usuario_id']);
        $this->db->update('usuarios', $data);
    }

    function borrarUsuario($id) {
        $this->db->where('usuario_id', $id);
        $this->db->limit(1);
        $this->db->delete('usuarios');
        return TRUE;
    }

}

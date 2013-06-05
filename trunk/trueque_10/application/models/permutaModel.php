<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//
class PermutaModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getPermutas($current) {
        
        
        $this->db->select('usu_solicita.usuario_id AS usu_solicita_id, usu_recibe.usuario_id AS usu_recibe_id, p1.nombre AS rec_nombre ,p2.nombre AS sol_nombre, p1.imagen AS rec_imagen,p2.imagen AS sol_imagen, usu_solicita.nombre AS sol_usu_nombre, usu_solicita.apellido AS sol_usu_apellido, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id, usu_solicita.usuario_id AS sol_usu_id, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id');
        $this->db->from('permuta AS per');
        $this->db->join('producto AS p1', 'p1.producto_id = per.producto_recibe');
        $this->db->join('producto AS p2', 'p2.producto_id = per.producto_solicita');
        $this->db->join('usuarios AS usu_recibe', 'p1.usuario_id = usu_recibe.usuario_id');
        $this->db->join('usuarios AS usu_solicita', 'p2.usuario_id = usu_solicita.usuario_id');
        $this->db->where('usu_recibe.usuario_id',  $current);
        $this->db->where('per.fechapermuta',  '0000-00-00');
        
        
        

        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
    
    function hacerPermuta($peticion){
        echo $peticion;
        list($recibe, $solicita, $usu_recibe, $usu_solicita) = explode(".", $peticion);  
        
        $query = $this->db->query('UPDATE permuta SET fechapermuta = CURRENT_TIMESTAMP WHERE producto_recibe = '.$recibe.' AND producto_solicita = '.$solicita); 
        $query1=  $this->db->query('update producto set usuario_id='.$usu_solicita.' where producto_id='.$recibe);
        $query2=  $this->db->query('update producto set usuario_id='.$usu_recibe.' where producto_id='.$solicita);
    }
    
    
    function rechazarPermuta($peticion){
        echo $peticion;
        list($recibe, $solicita, $usu_recibe, $usu_solicita) = explode(".", $peticion);  
        $query = $this->db->query('DELETE FROM permuta where producto_recibe = '.$recibe.' and producto_solicita = '.$solicita.' and fechapermuta = \'0000-00-000\'');
    }
    
    function crearPermuta($data){
        $this->db->insert('permuta',$data);
    }
    function getPermutasEnviadas($current) {
        $this->db->select('usu_solicita.usuario_id AS usu_solicita_id, usu_recibe.usuario_id AS usu_recibe_id, p1.nombre AS rec_nombre ,p2.nombre AS sol_nombre, p1.imagen AS rec_imagen,p2.imagen AS sol_imagen, usu_recibe.nombre AS rec_usu_nombre, usu_recibe.apellido AS rec_usu_apellido, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id, usu_recibe.usuario_id AS rec_usu_id, per.producto_recibe AS rec_producto_id, per.producto_solicita AS sol_producto_id');
        $this->db->from('permuta AS per');
        $this->db->join('producto AS p1', 'p1.producto_id = per.producto_recibe');
        $this->db->join('producto AS p2', 'p2.producto_id = per.producto_solicita');
        $this->db->join('usuarios AS usu_recibe', 'p1.usuario_id = usu_recibe.usuario_id');
        $this->db->join('usuarios AS usu_solicita', 'p2.usuario_id = usu_solicita.usuario_id');
        $this->db->where('usu_solicita.usuario_id',  $current);
        $this->db->where('per.fechapermuta',  '0000-00-00');
       
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            return $data;
        } else {
            return FALSE;
        }
    }
    
}

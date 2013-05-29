<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//
class usuariosModel extends CI_Model {
	//este es el constructor de la clase
	function __construct(){
		/*se hace el llamado al constructor del padre*/
		parent::__construct();	
		
	}


	/*obtener la lista de los libros desde la base de datos*/
    function getUsuarios(){
    	/*dentro de la variable data se van a guardar las tuplas correspondientes a la consulta get sobre la tabla usuarios en la base de datos*/
    	$data=$this->db->get('usuarios');
    	/*se comprueba si se obtiene algun resultado y se retorna*/
    	if($data->num_rows() >0){
    		return $data;
    	}
    	else{
    		return FALSE;
    	}
	}

	function registrar($data) {
		$id = $this->db->insert('usuarios', $data);
		return $id;
	}

	public function login($email, $contrasena) {
        $where = array(
            'email' => $email,
            'contrasena' => sha1($contrasena)
        );
        $this->db->select()->from('usuarios')->where($where);
        $query = $this->db->get();
        if($query->num_rows()>0){
        	return $query->first_row('array');
        }
        else{
        	return FALSE;
        }
    }
}

<?php
class mconfiguracion extends MY_Model {
	public function __construct()
	{
		parent::__construct();
		$this->table = "configuracion";
        $this->alias = 'c';

        $this->selectList = "".
            $this->alias.".id
            ,".$this->alias.".titulo";

        $this->selectDefault = "".
            $this->alias.".id
            ,".$this->alias.".titulo
            ,".$this->alias.".descripcion
            ,".$this->alias.".string
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";
		
	}
    function getAll(){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array();
        $arrayWhere[$this->alias.'.status'] = true; 
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        return $query;
    }

    function getById($id){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array();
        $arrayWhere[$this->alias.'.status'] = true; 
        $arrayWhere[$this->alias.'.id'] = $id; 
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        return $query;
    }

}

<?php
class mgaleria extends MY_Model{

    public function __construct(){
        parent :: __construct();
        $this->table = "galeria";
        $this->alias = 'g';

        $this->selectList = "".
            $this->alias.".id
            ,".$this->alias.".descripcion
            ,".$this->alias.".foto
            ,".$this->alias.".thumbnail
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";

        $this->selectDefault = "".
            $this->alias.".id
            ,".$this->alias.".descripcion
            ,".$this->alias.".foto
            ,".$this->alias.".thumbnail
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";
    }
    function getAll(){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.status' => true);
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }
    }

    function getById($id){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.id' => $id);
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }

    }


}
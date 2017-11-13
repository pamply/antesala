<?php
class mfoto_planos extends MY_Model{

    public function __construct(){
        parent :: __construct();
        $this->table = "fotos_planos";
        $this->alias = 'fg';

        $this->selectList = "".
            $this->alias.".id
            ,".$this->alias.".cat_id
            ,".$this->alias.".titulo
            ,".$this->alias.".foto
            ,".$this->alias.".thumbnail
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";

        $this->selectDefault = "".
            $this->alias.".id
            ,".$this->alias.".id_propiedad
            ,".$this->alias.".titulo
            ,".$this->alias.".foto
            ,".$this->alias.".thumbnail
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";
    }
    function getAllByIdPropiedad($id)
    {
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.id_propiedad' => $id);
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else {
            return 0;
        }
    }
    function getAll(){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array();
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else {
            return 0;
        }
    }

    function getById($id){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array($this->alias.'.id' => $id);
        $this->db->where($arrayWhere);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else {
            return 0;
        }
    }

    function borrarCategoria($id){
        $this->db->delete($this->table,array('cat_id' => $id));
        return true;
    }


}
<?php
class mestado extends MY_Model{

    public function __construct(){
        parent :: __construct();
        $this->table = "estados";
        $this->alias = 'e';

        $this->selectList = "".
            $this->alias.".id
            ,".$this->alias.".titulo";

        $this->selectDefault = "".
            $this->alias.".id
            ,".$this->alias.".titulo";
    }
    function getAll(){
        $this->db->select($this->selectDefault,FALSE);
        $arrayWhere = array();
        $this->db->where($arrayWhere);
        $this->db->join('propiedad as p',$this->alias.'.id=p.estado');
        $this->db->join('tipo_propiedad as tp','p.id_tipo_propiedad=tp.id');
        $this->db->group_by($this->alias.'.titulo');
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

    function getByIdUbicacion($id = null){
        $this->db->select("e.id,tp.id AS tp_id, tp.titulo",FALSE);
        $arrayWhere = array($this->alias.'.id' => $id);
        $this->db->where($arrayWhere);
        $this->db->join('propiedad as p',$this->alias.'.id=p.estado','left');
        $this->db->join('tipo_propiedad as tp','p.id_tipo_propiedad=tp.id','left');
        $this->db->group_by('tp.titulo');
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }
    }

}
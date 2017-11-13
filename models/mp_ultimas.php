<?php
class mp_ultimas extends MY_Model{

    public function __construct(){
        parent :: __construct();
        $this->table = "propiedad";
        $this->alias = 'p';

        $this->selectList = "".
            $this->alias.".id
            ,".$this->alias.".descripcion
            ,".$this->alias.".foto
            ,".$this->alias.".thumbnail
            ,".$this->alias.".status
            ,IF(".$this->alias.".status > 0,'Activo','Inactivo') AS txtstatus";

        $this->selectDefault = "".
            $this->alias.".id
            ,".$this->alias.".titulo
            ,".$this->alias.".foto
            ,".$this->alias.".thumbnail
            ,".$this->alias.".cuartos
            ,".$this->alias.".banos
            ,".$this->alias.".terreno
            ,".$this->alias.".construccion
            ,".$this->alias.".precio
            ,".$this->alias.".latitud
            ,".$this->alias.".id_tipo_propiedad
            ,".$this->alias.".id_operacion
            ,".$this->alias.".longitud
            ,".$this->alias.".marker
            ,".$this->alias.".estado
            ,".$this->alias.".colonia
            ,".$this->alias.".ciudad
            ,".$this->alias.".plantas
            ,".$this->alias.".planos
            ,".$this->alias.".status
            ,".$this->alias.".garage
            ,".$this->alias.".piscina
            ,".$this->alias.".oferta
            ,".$this->alias.".destacada
            ,".$this->alias.".slider_principal
            ,".$this->alias.".descripcion_corta
            ,".$this->alias.".descripcion_larga
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
        }else{
            return 0;
        }

    }
    function getLast(){
        $query = $this->db->query("
            SELECT p.id
		    ,p.titulo
            ,p.foto
            ,p.thumbnail
            ,p.cuartos
            ,p.banos
            ,p.terreno
            ,p.construccion
            ,p.precio
            ,p.latitud
            ,p.id_tipo_propiedad
            ,p.id_operacion
            ,p.longitud
            ,p.marker
            ,p.estado
            ,p.colonia
            ,p.ciudad
            ,p.plantas
            ,p.planos
            ,p.status
            ,p.garage
            ,p.piscina
            ,p.oferta
            ,p.destacada
            ,p.slider_principal
            ,p.descripcion_corta
            ,p.descripcion_larga
            ,IF(p.status > 0,'Activo','Inactivo') AS txtstatus
            ,tp.titulo AS tipo
            ,p.created
            ,top.titulo AS tipo_operacion
            FROM propiedad p
            JOIN tipo_propiedad tp ON tp.id = p.id_tipo_propiedad
            JOIN tipo_operacion top ON top.id = p.id_operacion
            WHERE p.status = 1 AND p.destacada != 1
            ORDER BY p.created DESC
            -- order by str_to_date(p.created,'%d-%m-%Y') DESC
            limit 0,15
        ");
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return 0;
        }
    }
    function getDestacadas(){
        $query = $this->db->query("
            SELECT p.id
		    ,p.titulo
            ,p.foto
            ,p.thumbnail
            ,p.cuartos
            ,p.banos
            ,p.terreno
            ,p.construccion
            ,p.precio
            ,p.latitud
            ,p.id_tipo_propiedad
            ,p.id_operacion
            ,p.longitud
            ,p.marker
            ,p.estado
            ,p.colonia
            ,p.ciudad
            ,p.plantas
            ,p.planos
            ,p.status
            ,p.garage
            ,p.piscina
            ,p.oferta
            ,p.destacada
            ,p.slider_principal
            ,p.descripcion_corta
            ,p.descripcion_larga
            ,IF(p.status > 0,'Activo','Inactivo') AS txtstatus
            ,tp.titulo AS tipo
            ,p.created
            ,top.titulo AS tipo_operacion
            FROM propiedad p
            JOIN tipo_propiedad tp ON tp.id = p.id_tipo_propiedad
            JOIN tipo_operacion top ON top.id = p.id_operacion
            WHERE p.status = 1 AND (p.oferta = 1 OR p.destacada = 1)
            AND p.destacada = 1
            ORDER BY p.oferta DESC
            limit 0,9
        ");
        if ($query->num_rows() > 0){
            return $query;
        }else{
            return 0;
        }
    }


}
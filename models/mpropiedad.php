<?php
class mpropiedad extends MY_Model{

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
            ,".$this->alias.".id_filtro
            ,".$this->alias.".id_servicio
            ,".$this->alias.".id_seguridad
            ,".$this->alias.".id_amenidad
            ,".$this->alias.".codigo
            ,".$this->alias.".titulo
            ,,".$this->alias.".direccion
            ,".$this->alias.".foto
            ,".$this->alias.".thumbnail
            ,".$this->alias.".cuartos
            ,".$this->alias.".banos
            ,".$this->alias.".terreno
            ,".$this->alias.".construccion
            ,".$this->alias.".precio
            ,".$this->alias.".mostrar_dolar
            ,".$this->alias.".precio_dolar
            ,".$this->alias.".latitud
            ,".$this->alias.".id_tipo_propiedad
            ,".$this->alias.".id_operacion
            ,".$this->alias.".longitud
            ,".$this->alias.".marker
            ,".$this->alias.".estado
            ,".$this->alias.".colonia
            ,".$this->alias.".ciudad
            ,".$this->alias.".zona
            ,".$this->alias.".plantas
            ,".$this->alias.".planos
            ,".$this->alias.".status
            ,".$this->alias.".garage
            ,".$this->alias.".piscina
            ,".$this->alias.".oferta
            ,".$this->alias.".destacada
            ,".$this->alias.".slider_principal
            ,".$this->alias.".zoom
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
            return '';
        }
    }

    public function getTotal()
    {
        $consulta = $this->db->get('propiedad');
        return  $consulta->num_rows();
    }

    function getLimit($limit=null, $start=null){
        $this->db->select("$this->selectDefault,top.titulo AS tipo_operacion,tp.titulo AS tipo_propiedad",FALSE);
        $arrayWhere = array($this->alias.'.status' => true);
        $this->db->join('tipo_propiedad as tp',$this->alias.'.id_tipo_propiedad=tp.id');
        $this->db->join('tipo_operacion as top',$this->alias.'.id_operacion=top.id');
        $this->db->where($arrayWhere);
        $this->db->order_by($this->alias.".precio", "DESC");
        //if($limit!='' && $start!=''){
            $this->db->limit($limit, $start);
        //}
        //$this->db->limit(8);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        /*$query = $this->db->query("
        SELECT
        p.titulo
        ,p.foto
        ,p.thumbnail
        ,p.cuartos
        ,p.banos
        ,p.terreno
        ,p.construccion
        ,p.precio
        ,p.latitud
        ,p.longitud
        ,p.id_tipo_propiedad
        ,p.id_operacion
        ,p.marker
        ,p.status
        ,p.oferta
        ,tp.id AS id_propiedad
        ,tp.titulo AS tipo_propiedad
        ,top.id AS id_operacion
        ,top.titulo AS tipo_operacion
        FROM propiedad AS p
        LEFT JOIN  tipo_propiedad AS tp ON p.id_tipo_propiedad = tp.id
        LEFT JOIN  tipo_operacion AS top ON p.id_operacion = top.id

        ");*/

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

    function getRecents(){
        $this->db->select($this->selectDefault,FALSE);
        //$this->db->join('fotos_propiedad as fp',$this->alias.'.id=fp.propiedad_id','left');
        $arrayWhere = array($this->alias.'.status' => true);
        $this->db->where($arrayWhere);
        $this->db->order_by($this->alias.".id", "desc");
        $this->db->limit(6);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }
    }

    function getPhotoByIdPropiedad($id = null){
        $this->db->select("$this->alias.id,$this->alias.titulo,fp.id,fp.id_propiedad,fp.titulo,fp.foto,fp.thumbnail",FALSE);
        $this->db->join('fotos_propiedad as fp',$this->alias.'.id=fp.id_propiedad');
        $this->db->where("$this->alias.status = true AND fp.id_propiedad = $id");

        $query = $this->db->get($this->table.' AS '.$this->alias);
        //echo  $this->db->last_query();
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }
    }

    function getMaxPrice($id = null){
        $this->db->select_max('precio');
        //$arrayWhere = array($this->alias.'.status' => true);
        //$this->db->where($arrayWhere);
        $this->db->where($this->alias.'.status', true);
        if ($id != null){
            $this->db->where($this->alias.'.id_tipo_propiedad', $id);
        }
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }
    }

    function getMinPrice($id = null){
        $this->db->select_min('precio');
/*        $arrayWhere = array($this->alias.'.status' => true);
        $this->db->where($arrayWhere);*/
        $this->db->where($this->alias.'.status', true);
        if ($id != null){
            $this->db->where($this->alias.'.id_tipo_propiedad', $id);
        }
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }
    }

    function search ($string = null, $fin_limit=null, $inicio_limit=null, $tipos = array()){
        $cad = ',';
        $where = '';
        $between = '';
        $orderBy = '';
        $query = '';


        if ( isset($inicio_limit) && isset($fin_limit)){
            $limit = " LIMIT $inicio_limit,$fin_limit";
        }else { $limit = ''; }


/*        if (isset($string['estado'])){
            $idEstado = $string['estado'];
            if ( ($idEstado != '') && ($idEstado != 0) ) {
                $where .= " AND e.id = $idEstado";
            }
        }*/

        if (isset($string['ciudad'])){
            $idCiudad = $string['ciudad'];
            if ( ($idCiudad != '') && ($idCiudad != 0) ) {
                $where .= " AND p.estado = $idCiudad";
            }
        }

        if (isset($string['colonia'])){
            $idColonia = $string['colonia'];
            if ( ($idColonia != '') && ($idColonia != 0) ) {
                $where .= " AND p.colonia = $idColonia";
            }
        }


        if (isset($string['propiedad_id'])){
            $propiedad_id=$string['propiedad_id'];
            $where .= " AND p.id = $propiedad_id";
        }

        if (isset($string['id_tipo_propiedad'])){
            $idPropiedad = $string['id_tipo_propiedad'];
            if ( ($idPropiedad != '') && ($idPropiedad != 0) ) {
                $where .= " AND tp.id = $idPropiedad";
            }
        }

        if (isset($string['tipo'])){
            $tipoPropiedad = $string['tipo'];
            if ( ($tipoPropiedad != '') && ($tipoPropiedad != 0) ) {
                $where .= " AND p.id_filtro = $tipoPropiedad";
            }
        }

        if (isset($string['venta']) || isset($string['renta'])){
            $venta = $string['venta'];
            $renta = $string['renta'];
            if ( ($venta != 0) && ($renta != 0) ) {
                $where .= " AND top.id = 1 OR top.id = 2";
            }elseif ($venta != 0) {
                $where .= " AND top.id = 1";
            }
            elseif ($renta != 0) {
                $where .= " AND top.id = 2";
            }
        }

        if (isset($string['precioI']) || isset($string['precioF'])){
            $precioI = $string['precioI'];
            $precioF = $string['precioF'];
            if ( ($precioI != '' ) && ($precioI != 0) &&  ($precioF != '') && ($precioF != 0 )  ) {
                $between .= " AND p.precio BETWEEN $precioI AND $precioF";
                //$cad .= $precioF.",";
            }
        }

/*        if (count($tipos)>0){
             $arr_where_in = unionIds($tipos);
             $where_in = " OR ftp.id LIKE ('%$arr_where_in%')";
             $left_in =" LEFT JOIN filtros_tipo_propiedad ftp ON p.id_filtro LIKE Concat('%',ftp.id,'%')";
        }else{
            $where_in = '';
            $left_in = '';
        }*/


        $query = $this->db->query("
            SELECT
            p.id
            ,p.id_filtro
            ,p.titulo
            ,p.direccion
            ,p.foto
            ,p.thumbnail
            ,p.cuartos
            ,p.banos
            ,p.terreno
            ,p.construccion
            ,p.precio
            ,p.mostrar_dolar
            ,p.precio_dolar
            ,p.latitud
            ,p.longitud
            ,p.id_tipo_propiedad
            ,p.id_operacion
            ,p.marker
            ,p.status
            ,p.oferta
            ,p.descripcion_corta
            ,p.descripcion_larga
            ,tp.id AS id_propiedad
            ,tp.titulo AS tipo_propiedad
            ,top.id AS id_operacion
            ,top.titulo AS tipo_operacion
            ,e.id as id_estado
            ,p.zona

            FROM propiedad AS p
            LEFT JOIN  tipo_propiedad AS tp ON p.id_tipo_propiedad = tp.id


            LEFT JOIN  tipo_operacion AS top ON p.id_operacion = top.id
            LEFT JOIN estados AS e ON p.estado = e.id


            WHERE p.status = 1
            "
            .$where
            //.$where_in
            .$between
            //." GROUP BY p.id"
            .$orderBy
            .$limit."
            ");
            if ($query->num_rows() > 0) {
                return $query;
            }else {
                return '';
            }

    }


//demo getIn
    public function getIn($ids, $id_prop){

        $this->db->select($this->selectDefault,FALSE);
        $this->db->where($this->alias.'.id_tipo_propiedad',$id_prop);
        $this->db->where_in($this->alias.'.id_filtro', $ids);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }
        return 0;
    }

    public function fastSearch ($string = null){


        /*$query = $this->db->$query("
            SELECT titulo
            ,cuartos
            ,banos
            ,area
            ,tamano
            ,descripcion
            ,precio
            ,colonia
            ,estado
            ,foto
            ,thumbnail
            FROM propiedades
            WHERE MATCH (titulo)
            AGAINST ('$palabra')

        ");*/

        $query = $this->db->query("
            SELECT -- DISTINCT
             p.id
            ,p.titulo
            ,p.direccion
            ,p.foto
            ,p.thumbnail
            ,p.cuartos
            ,p.banos
            ,p.terreno
            ,p.construccion
            ,p.precio
            ,p.mostrar_dolar
            ,p.precio_dolar
            ,p.latitud
            ,p.longitud
            ,p.id_tipo_propiedad
            ,p.id_operacion
            ,p.marker
            ,p.status
            ,p.oferta
            ,p.descripcion_corta
            ,p.descripcion_larga
            ,tp.id AS id_propiedad
            ,tp.titulo AS tipo_propiedad
            ,top.id AS id_operacion
            ,top.titulo AS tipo_operacion
            ,e.id AS id_estado
            FROM propiedad AS p
            LEFT JOIN  tipo_propiedad AS tp ON p.id_tipo_propiedad = tp.id
            LEFT JOIN  tipo_operacion AS top ON p.id_operacion = top.id
            LEFT JOIN estados AS e ON p.estado = e.id
            LEFT JOIN municipios AS m ON p.ciudad = m.id
            LEFT JOIN colonias AS c ON c.id = p.colonia
            WHERE MATCH (p.titulo)
            AGAINST ('$string')
            OR MATCH (tp.titulo)
            AGAINST ('$string')
            OR MATCH (top.titulo)
            AGAINST ('$string')
            OR MATCH (m.titulo)
            AGAINST ('$string')
            OR MATCH (c.titulo)
            AGAINST ('$string')
            OR MATCH (c.tipo)
            AGAINST ('$string')
            OR p.titulo LIKE '%$string%'
            ;
            -- WHERE p.status = 1
            -- AND p.titulo LIKE '%$string%'
            -- OR tp.titulo LIKE '%$string%'
            -- OR top.titulo LIKE '%$string%'
            -- AND p.status = 1

        ");

        if ($query->num_rows() > 0) {
            return $query;
        }else {
            return '';
        }
    }

    function getSliders(){
        $this->db->select($this->selectDefault,FALSE);
        //$this->db->join('fotos_propiedad as fp',$this->alias.'.id=fp.propiedad_id','left');
        $arrayWhere = array($this->alias.'.status' => true,$this->alias.'.slider_principal' => true);
        $this->db->where($arrayWhere);
        $this->db->order_by($this->alias.".id", "desc");
        $this->db->limit(5);
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return '';
        }
    }

    function getIdCiudad($id_tipo_propiedad = null){
        $this->db->select($this->alias.'.ciudad',FALSE);
        $arrayWhere = array($this->alias.'.status' => true);
        $this->db->where($arrayWhere);
        $this->db->distinct();
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return 0;
        }
    }

    function getIdEstado($id_tipo_propiedad = null){
        $this->db->select($this->alias.'.estado',FALSE);
        $arrayWhere = array($this->alias.'.status' => true);
        $this->db->where($arrayWhere);
        $this->db->distinct();
        $query = $this->db->get($this->table.' AS '.$this->alias);
        if($query->num_rows()>0){
            return $query;
        }else{
            return 0;
        }
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class propiedades extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->fv = 'propiedades';
        $this->mainView = 'propiedades';
        $this->data = array(
            /* Parametros SEO */
            'meta_tags' => array(
                'meta_description' => '',
                'meta_keywords' => 'Inmobiliaria',
                'meta_robots' => $this->meta_robots,
                'meta_rating' => $this->meta_rating,
                'meta_distribution' => $this->meta_distribution,
                'meta_copyright' => $this->meta_copyright,
                'meta_author' => $this->meta_author
            ),
            'titulo' => 'Antesala | Inmobiliaria',
            'fjs' => array(),
            'raw_fjs' => '',
            'raw_js' => "",
            'js' => array(
                'js/vistas/propiedades.js',
                'js/vistas/propiedad.js'
            ),
            'css' => array(
                'css/vistas/pultimas.css'
            )
        );
        $this->data['ogg'] ='';

        /* Tools */
        $this->load->helper(array('tools','url','date','text','html2text'));

        /* Modelos */

        $this->load->model(array('mpropiedad','mtipopropiedad','moperacion','mciudad','mestado','mfoto_planos','mfoto_propiedad','mcolonias','mzona','mfiltro_tipo_propiedad','mamenidad', 'mseguridad', 'mservicio'));


        /* Lbrerias */
        $this->load->library(array('email','session','dompdf_lib'));

        /* Debugging */
        $this->output->enable_profiler(false);
    }

    public function index($string = null){
        $data = array();
        $data['ocultar_filtros'] = false;
        $data['total_resultados'] = '';
        $data['filtros'] = '';
        $data['nombre_tipo_propiedad'] = '';
        $data['id_venta'] = '';
        $data['id_renta'] = '';
        $data['id_tipo'] = '';
        $data['all_id_filtro'] = array();
        $data['tipo_propiedad'] = $this->mtipopropiedad->getAll();
        $data['tipo_operacion'] = $this->moperacion->getAll();
        $data['estado'] = $this->mestado->getAll();
        $data['zona'] = $this->mzona->getExcept1();
        $uri = $this->uri->segment(3);
        if ($uri != 'propiedad'){
            $data['uri'] = $uri;
        }else {$data['uri'] = ''; }

        if (isset($_POST['buscando']) && ($_POST['buscando'] == 1)){
            $clic_buscar = $this->input->post('clic_buscar',TRUE);
            if ($clic_buscar == 1){
                $data['scroll'] = true;
            }
            
            $c['id_tipo_operacion'] = $this->input->post('tipo_operacion',TRUE);
            $v['venta'] = $this->input->post('venta',TRUE);
            $v['renta'] = $this->input->post('renta',TRUE);

            list($estado, $tipoPropiedad, $precioI, $precioF, $venta, $renta, $ciudad, $tipos) = explode("_",$uri);

            $est = explode("-",$estado);
            $v['estado'] = $est[1];

            $tipoP = explode("-",$tipoPropiedad);
            $v['id_tipo_propiedad'] = $tipoP[1];
            $id_propiedad = $v['id_tipo_propiedad'];
            $pI = explode("-",$precioI);
            $v['precioI'] = $pI[1];

            $pF = explode("-",$precioF);
            $v['precioF'] = $pF[1];

            //echo $v['precioF'];

            $vent = explode("-",$venta);
            $v['venta'] = $vent[1];

            $rent = explode("-",$renta);
            $v['renta'] = $rent[1];

            $ciu = explode("-",$ciudad);
            $v['ciudad'] = $ciu[1];

            $explode_tipos = explode("=", $tipos);
            $v['tipo'] = $explode_tipos[1];
            $explode_val = explode("-",$explode_tipos[1]);
            $val = array();
            $t = 0;
            foreach ($explode_val as $vt) {
                //array_push($val, $v);
                $val[$t] = $vt;
                $t++;
            }

            $data['all_id_filtro'] = $val;

            switch ($id_propiedad) {

                //=======CASAS======== 
                //VENTA
                case ($id_propiedad == 4 && $vent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 1500000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 1500000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 4 && $vent[1]==1 && $explode_tipos[1] == 2):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 1499999;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 1499999;
                    break;

                case ($id_propiedad == 4 && $vent[1]==1 && $explode_tipos[1] == 1):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;
                //RENTA
                case ($id_propiedad == 4 && $rent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 20000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 20000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 4 && $rent[1]==1 && $explode_tipos[1] == 2):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 19999;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 19999;
                    break;

                case ($id_propiedad == 4 && $rent[1]==1 && $explode_tipos[1] == 1):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;


                //======DEPAS=======
                    //VENTA
                case ($id_propiedad == 3 && $vent[1]==1 && $explode_tipos[1] == 6):
                    $data['minPrice'] = 1500000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 1500000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 3 && $vent[1]==1 && $explode_tipos[1] == 5):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 1490000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 1490000;
                    break;

                case ($id_propiedad == 3 && $vent[1]==1 && $explode_tipos[1] == 4):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;
                //RENTA
                case ($id_propiedad == 3 && $rent[1]==1 && $explode_tipos[1] == 6):
                    $data['minPrice'] = 18000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 18000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 3 && $rent[1]==1 && $explode_tipos[1] == 5):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 14999;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 14999;
                    break;

                case ($id_propiedad == 3 && $rent[1]==1 && $explode_tipos[1] == 4):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                //======DESARROLLOS COMERCIALES=======
                    //VENTA
                case ($id_propiedad == 2 && $vent[1]==1 && $explode_tipos[1] == 9):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $vent[1]==1 && $explode_tipos[1] == 8):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $vent[1]==1 && $explode_tipos[1] == 7):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;
                //RENTA
                case ($id_propiedad == 2 && $rent[1]==1 && $explode_tipos[1] == 9):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $rent[1]==1 && $explode_tipos[1] == 8):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $rent[1]==1 && $explode_tipos[1] == 7):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;


                //======TERRENOS=======
                    //VENTA
                case ($id_propiedad == 1 && $vent[1]==1 && $explode_tipos[1] == 11):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 1 && $vent[1]==1 && $explode_tipos[1] == 10):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

/*                case ($id_propiedad == 1 && $vent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;*/

                //RENTA
                case ($id_propiedad == 1 && $rent[1]==1 && $explode_tipos[1] == 11):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 1 && $rent[1]==1 && $explode_tipos[1] == 10):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

/*                case ($id_propiedad == 1 && $rent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;*/


                default:
                    $data['minPrice'] = $this->mpropiedad->getMinPrice($id_propiedad)->row()->precio;
                    $data['maxPrice'] = $this->mpropiedad->getMaxPrice($id_propiedad)->row()->precio;
                    $data['populadoMin'] = $this->mpropiedad->getMinPrice($id_propiedad)->row()->precio;
                    $data['populadoMax'] = $this->mpropiedad->getMaxPrice($id_propiedad)->row()->precio;
                    break;
            }
 
            $data['id_tipo_propiedad'] = $id_propiedad;
            $data['nombre_tipo_propiedad'] = $this->mtipopropiedad->getById($id_propiedad);
            $data['filtros'] = $this->mfiltro_tipo_propiedad->getByIdPropiedad($id_propiedad);
            $data['ciudades'] = $this->mpropiedad->getIdEstado($id_propiedad);
            $data['mciudad'] = $this->mestado;

            $propiedades = $this->mpropiedad->search($v,null,null,$val);
            if ($propiedades != ''){
                $data['total_resultados'] = $propiedades->num_rows();
            }            
            /*Paginación por búsqueda*/
            if ($propiedades != ''){
                $total_rows = $propiedades->num_rows();
                $pages=6;
                $this->load->library('pagination');
                $config['base_url']	= base_url().'/propiedades/siguiente2/'.$uri.'';
                $config['total_rows'] = $total_rows;//calcula el nmero de filas
                $config['per_page'] = $pages; //Nmero de registros mostrados por pginas
                $config['num_links'] = 3;
                $config['full_tag_open'] = '<ul style="list-style:none;">';//el div que debemos maquetar
                $config['full_tag_close'] = '</ul>';//el cierre del div de la paginacin
                $this->pagination->initialize($config); //inicializamos la paginacin
                $data["propiedades"] = $this->mpropiedad->search($v,$config['per_page'],0);//$this->uri->segment(3)
                $data['paginationC'] = $this->pagination->create_links();

            }else{
                $data['propiedades'] = '';
            }
            /********/
            $data['id_ciudad'] = $ciu[1];
            $data['id_venta'] = $vent[1];
            $data['id_renta'] = $rent[1];
            $data['id_tipo'] = $explode_tipos[1];
            //$data['id_colonia'] = $col[1];

            $data['ciudad'] = $this->mciudad->getCiudadByIdEstado($v['estado']);
            //$data['colonia'] = $this->mcolonias->getColoniaByIdCiudad( $data['id_ciudad']); //2378


            $data['id_estado'] = $v['estado'];
            $data['id_propiedad'] = $v['id_tipo_propiedad'];
/*            $data['populadoMin'] = $v['precioI'];
            $data['populadoMax'] = $v['precioF'];*/


/*            if ($v['ordenPrecio'] ==1){ $data['selectedMenor'] = 'selected="selected"'; $data['inputOrden'] = '<input type="text" id="ordenDA" class="ordenDesc" name="ordenPrecio" value="2">';}
            if ($v['ordenPrecio'] ==2){ $data['selectedMayor'] = 'selected="selected"'; $data['inputOrden'] = '<input type="text" id="ordenDA" class="ordenAsc" name="ordenPrecio" value="1">'; }*/


            if ( ($v['venta'] != '') && ($v['venta'] != 0) ){ $data['checkedv'] = 'checked'; $data['operacion'] = 1; }else{ $data['checkedv'] = ''; }
            if ( ($v['renta'] !='') && ($v['renta'] !=0) ){ $data['checkedr'] = 'checked'; $data['operacion'] = 2; }else{ $data['checkedr'] = ''; }
            if ( ($v['venta'] == 1) && ($v['renta'] == 1) ){ $data['operacion'] = ''; }
            if ($c['id_tipo_operacion'] != '') { $data['operacion'] = $c['id_tipo_operacion']; if ($c['id_tipo_operacion'] == 1){ $data['checkedv'] = 'checked'; }else { $data['checkedr'] = 'checked'; } }


        }elseif (isset($_POST['busquedaGral']) && ($_POST['busquedaGral'] == 1)){
            $captura = $this->input->post('busqueda_general',TRUE);
            $val_id_ciudad = array();
            $id_ciudades = $this->mpropiedad->getIdCiudad();
            if (!is_numeric($id_ciudades)){
                $ci = 0;
                foreach ($id_ciudades->result() as $c) {
                    $val_id_ciudad[$ci] = $c->ciudad;
                    $ci++;
                }
                $data['ciudades_general'] = $this->mciudad->getWhereIn($val_id_ciudad);
                $data['ciudades'] = 0;
            }else{
                $data['ciudades'] = 0;
            }
            $data['filtros'] = $this->mfiltro_tipo_propiedad->getDistinct();
            $data['minPrice'] = $this->mpropiedad->getMinPrice()->row()->precio;
            $data['maxPrice'] = $this->mpropiedad->getMaxPrice()->row()->precio;
            $data['ocultar_filtros'] = true;
            $data['propiedades'] = $this->mpropiedad->fastSearch($captura);

        }elseif ($string != null) {
            if (is_numeric($string)){
                $data['uri'] = '';
                $id_tipo_propiedad = $string;
                $v['precioI'] = $this->mpropiedad->getMinPrice($id_tipo_propiedad)->row()->precio;
                $v['precioF'] = $this->mpropiedad->getMaxPrice($id_tipo_propiedad)->row()->precio;
                //$datoPropiedad = $this->mpropiedad->getById($propiedad_id);
                //$info = $datoPropiedad->row();
                //$v['estado'] = $info->estado;
                $v['id_tipo_propiedad'] = $id_tipo_propiedad;
                $data['id_tipo_propiedad'] = $id_tipo_propiedad;
                //$v['precioF'] = $info->precio;
                //$v['id_operacion'] = $info->id_operacion;
                $data['minPrice'] = $v['precioI'];
                $data['maxPrice'] = $v['precioF'];
                $data['nombre_tipo_propiedad'] = $this->mtipopropiedad->getById($id_tipo_propiedad);
                $data['filtros'] = $this->mfiltro_tipo_propiedad->getByIdPropiedad($id_tipo_propiedad);
                $data['ciudades'] = $this->mpropiedad->getIdCiudad($id_tipo_propiedad);
                $data['mciudad'] = $this->mciudad;
                $propiedades = $this->mpropiedad->search($v,null,null);
                if ($propiedades != ''){
                    $data['total_resultados'] = $propiedades->num_rows();
                }  
                //$data['id_estado'] = $propiedades->row()->id_estado;
                //$data['id_propiedad'] = $propiedades->row()->id_operacion;
                //$total_rows = $propiedades->num_rows();

               if ($propiedades != ''){ 
                $total_rows = $propiedades->num_rows();
                    $pages=6;
                    $this->load->library('pagination');
                    $config['base_url'] = base_url().'/propiedades/siguiente/propiedad-'.$id_tipo_propiedad.'/';
                    $config['total_rows'] = $total_rows;//calcula el nmero de filas
                    $config['per_page'] = $pages; //Nmero de registros mostrados por pginas
                    $config['num_links'] = 3;
                    $config['full_tag_open'] = '<ul style="list-style:none;">';//el div que debemos maquetar
                    $config['full_tag_close'] = '</ul>';//el cierre del div de la paginacin
                    $this->pagination->initialize($config); //inicializamos la paginacin
                    $data["propiedades"] = $this->mpropiedad->search($v,$config['per_page'],0);//$this->uri->segment(3)
                    $data['paginationC'] = $this->pagination->create_links();
                }else{
                    $data["propiedades"] = '';
                }

            }else{
                //$data['scroll'] = true;
                $v = array();
                list($estado, $tipoPropiedad, $precioI, $precioF, $venta, $renta, $ciudad, $tipos) = explode("_",$uri);

                $est = explode("-",$estado);
                $v['estado'] = $est[1];

                $tipoP = explode("-",$tipoPropiedad);
                $v['id_tipo_propiedad'] = $tipoP[1];
                $id_propiedad = $v['id_tipo_propiedad']; //tipo de propiedad casa, depa, etc

                $pI = explode("-",$precioI);
                $v['precioI'] = $pI[1];

                $pF = explode("-",$precioF);
                $v['precioF'] = $pF[1];

                $vent = explode("-",$venta);
                $v['venta'] = $vent[1];

                $rent = explode("-",$renta);
                $v['renta'] = $rent[1];


                $ciu = explode("-",$ciudad);
                $v['ciudad'] = $ciu[1];

                $explode_tipos = explode("=", $tipos);
                $v['tipo'] = $explode_tipos[1];
                $explode_val = explode("-",$explode_tipos[1]);
                $val = array();
                $t = 0;
                foreach ($explode_val as $vt) {
                    //array_push($val, $v);
                    $val[$t] = $vt;
                    $t++;
                }

                $data['all_id_filtro'] = $val;

            switch ($id_propiedad) {

                //=======CASAS======== 
                //VENTA
                case ($id_propiedad == 4 && $vent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 1500000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 1500000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 4 && $vent[1]==1 && $explode_tipos[1] == 2):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 1499999;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 1499999;
                    break;

                case ($id_propiedad == 4 && $vent[1]==1 && $explode_tipos[1] == 1):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;
                //RENTA
                case ($id_propiedad == 4 && $rent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 20000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 20000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 4 && $rent[1]==1 && $explode_tipos[1] == 2):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 19999;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 19999;
                    break;

                case ($id_propiedad == 4 && $rent[1]==1 && $explode_tipos[1] == 1):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;


                //======DEPAS=======
                    //VENTA
                case ($id_propiedad == 3 && $vent[1]==1 && $explode_tipos[1] == 6):
                    $data['minPrice'] = 1500000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 1500000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 3 && $vent[1]==1 && $explode_tipos[1] == 5):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 1490000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 1490000;
                    break;

                case ($id_propiedad == 3 && $vent[1]==1 && $explode_tipos[1] == 4):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;
                //RENTA
                case ($id_propiedad == 3 && $rent[1]==1 && $explode_tipos[1] == 6):
                    $data['minPrice'] = 18000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 18000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 3 && $rent[1]==1 && $explode_tipos[1] == 5):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 14999;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 14999;
                    break;

                case ($id_propiedad == 3 && $rent[1]==1 && $explode_tipos[1] == 4):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                //======DESARROLLOS COMERCIALES=======
                    //VENTA
                case ($id_propiedad == 2 && $vent[1]==1 && $explode_tipos[1] == 9):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $vent[1]==1 && $explode_tipos[1] == 8):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $vent[1]==1 && $explode_tipos[1] == 7):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;
                //RENTA
                case ($id_propiedad == 2 && $rent[1]==1 && $explode_tipos[1] == 9):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $rent[1]==1 && $explode_tipos[1] == 8):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $rent[1]==1 && $explode_tipos[1] == 7):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;


                //======TERRENOS=======
                    //VENTA
                case ($id_propiedad == 1 && $vent[1]==1 && $explode_tipos[1] == 11):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 1 && $vent[1]==1 && $explode_tipos[1] == 10):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

/*                case ($id_propiedad == 1 && $vent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;*/

                //RENTA
                case ($id_propiedad == 1 && $rent[1]==1 && $explode_tipos[1] == 11):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 1 && $rent[1]==1 && $explode_tipos[1] == 10):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

/*                case ($id_propiedad == 1 && $rent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;*/


                default:
                    $data['minPrice'] = $this->mpropiedad->getMinPrice($id_propiedad)->row()->precio;
                    $data['maxPrice'] = $this->mpropiedad->getMaxPrice($id_propiedad)->row()->precio;
                    $data['populadoMin'] = $this->mpropiedad->getMinPrice($id_propiedad)->row()->precio;
                    $data['populadoMax'] = $this->mpropiedad->getMaxPrice($id_propiedad)->row()->precio;
                    break;
            }



                $filtros = $this->mpropiedad->getIn($val,$id_propiedad);

/*            $data['minPrice'] = $this->mpropiedad->getMinPrice($id_propiedad)->row()->precio;
            $data['maxPrice'] = $this->mpropiedad->getMaxPrice($id_propiedad)->row()->precio;
            $data['populadoMin'] = $this->mpropiedad->getMinPrice($id_propiedad)->row()->precio;
            $data['populadoMax'] = $this->mpropiedad->getMaxPrice($id_propiedad)->row()->precio; */

                $data['id_tipo_propiedad'] = $id_propiedad;
                $data['nombre_tipo_propiedad'] = $this->mtipopropiedad->getById($id_propiedad);
                $data['filtros'] = $this->mfiltro_tipo_propiedad->getByIdPropiedad($id_propiedad);
                $data['ciudades'] = $this->mpropiedad->getIdEstado($id_propiedad);
                $data['mciudad'] = $this->mestado;

                $propiedades = $this->mpropiedad->search($v);
            if ($propiedades != ''){
                $data['total_resultados'] = $propiedades->num_rows();
            }  
                /*Paginación por búsqueda*/

                if ($propiedades != ''){
                    $total_rows = $propiedades->num_rows();

                    $pages=6;
                    $this->load->library('pagination');
                    $config['base_url']	= base_url().'/propiedades/siguiente2/'.$uri.'';
                    $config['total_rows'] = $total_rows;//calcula el nmero de filas
                    $config['per_page'] = $pages; //Nmero de registros mostrados por pginas
                    $config['num_links'] = 3;
                    $config['full_tag_open'] = '<ul style="list-style:none;">';//el div que debemos maquetar
                    $config['full_tag_close'] = '</ul>';//el cierre del div de la paginacin
                    $this->pagination->initialize($config); //inicializamos la paginacin
                    $data["propiedades"] = $this->mpropiedad->search($v,$config['per_page'],0);//$this->uri->segment(3)
                    $data['paginationC'] = $this->pagination->create_links();

                    $description = html2text($data['propiedades']->row(1)->descripcion_corta);
                    $keyword = $data["propiedades"]->row();
                    $this->data['titulo'] = 'Antesala, Inmobiliaria, Acabados, Constructora';
                    $this->data['meta_tags'] = array(
                        'meta_description' => $description,
                        'meta_keywords' => $keyword->tipo_operacion.' ,'.$keyword->tipo_propiedad.' ,'.$keyword->titulo,
                        'meta_robots' => $this->meta_robots,
                        'meta_rating' => $this->meta_rating,
                        'meta_distribution' => $this->meta_distribution,
                        'meta_copyright' => $this->meta_copyright,
                        'meta_author' => $this->meta_author
                    );

                }else{
                    $data['propiedades'] = '';
                }


                $data['ciudad'] = $this->mciudad->getCiudadByIdEstado($v['estado']);
                //$data['colonia'] = $this->mcolonias->getColoniaByIdCiudad( $v['ciudad']); //2378

                $data['id_estado'] = $v['estado'];
                $data['id_ciudad'] = $v['ciudad'];
                $data['id_venta'] = $vent[1];
                $data['id_renta'] = $rent[1];
                $data['id_tipo'] = $explode_tipos[1];
                //$data['id_colonia'] = $v['colonia'];
                $data['id_propiedad'] = $v['id_tipo_propiedad'];
                if ($v['venta'] == 1){ $data['operacion'] = $v['venta']; }else{ $data['operacion'] = null; }
                if ($v['renta'] == 1){ $data['operacion'] = $v['renta']; }else{ $data['operacion'] = null; }
            }

        }else {

            $pages=6;
            $this->load->library('pagination');
            $config['base_url']	= base_url().'/propiedades/siguiente/propiedad/';
            $config['total_rows'] = $this->mpropiedad->getTotal();//calcula el nmero de filas
            $config['per_page'] = $pages; //Nmero de registros mostrados por pginas
            $config['num_links'] = 3;
            $config['full_tag_open'] = '<ul style="list-style:none;">';//el div que debemos maquetar
            $config['full_tag_close'] = '</ul>';//el cierre del div de la paginacin
            $this->pagination->initialize($config); //inicializamos la paginacin
            $data["propiedades"] = $this->mpropiedad->getLimit($config['per_page'],0);//$this->uri->segment(3)
            $data['paginationC'] = $this->pagination->create_links();

/*            if ($data['propiedades'] != ''){
                $description = html2text($data['propiedades']->row(1)->descripcion_corta);
            }else { $description = ''; }
            $this->data['titulo'] = 'Antesala, Inmobiliaria, Acabados, Constructora';
            $this->data['meta_tags'] = array(
                'meta_description' => $description,
                'meta_keywords' => '',
                'meta_robots' => $this->meta_robots,
                'meta_rating' => $this->meta_rating,
                'meta_distribution' => $this->meta_distribution,
                'meta_copyright' => $this->meta_copyright,
                'meta_author' => $this->meta_author
            );*/

        }

        $this->data['contenido'] = $this->load->view($this->mainView.'/index_view',$data,true);
        $this->load->view('templates/propiedades_template',$this->data);
    }

    public function siguiente($id = 0, $id_tipo_propiedad = null){
        $data = array();
        $data['ocultar_filtros'] = false;
        $data['filtros'] = '';
        $data['scroll'] = true;
        $data['total_resultados'] = '';
        $data['all_id_filtro'] = array();
        $uri = $this->uri->segment(3);
        $exp = explode("-", $uri);
        $uri = $exp[0];
        $id_tipo_propiedad = $exp[1];
        if ($uri != 'propiedad'){
            $data['uri'] = $uri;
        }else {$data['uri'] = ''; }
        $uriLimit = $this->uri->segment(4);
        if ( ($uriLimit == '') || !isset($uriLimit) ){ $uriLimit = 0; }

        $v['precioI'] = $this->mpropiedad->getMinPrice($id_tipo_propiedad)->row()->precio;
        $v['precioF'] = $this->mpropiedad->getMaxPrice($id_tipo_propiedad)->row()->precio;
        $v['id_tipo_propiedad'] = $id_tipo_propiedad;
        $data['id_tipo_propiedad'] = $id_tipo_propiedad;

        $data['minPrice'] = $v['precioI'];
        $data['maxPrice'] = $v['precioF'];

        $data['nombre_tipo_propiedad'] = $this->mtipopropiedad->getById($id_tipo_propiedad);
        $data['filtros'] = $this->mfiltro_tipo_propiedad->getByIdPropiedad($id_tipo_propiedad);
        $data['ciudades'] = $this->mpropiedad->getIdCiudad($id_tipo_propiedad);
        $data['mciudad'] = $this->mciudad;

        $propiedades = $this->mpropiedad->search($v,null,null);
            if ($propiedades != ''){
                $data['total_resultados'] = $propiedades->num_rows();
            }  
        //$total_rows = $propiedades->num_rows();

        $data['tipo_propiedad'] = $this->mtipopropiedad->getAll();
        $data['tipo_operacion'] = $this->moperacion->getAll();
        $data['estado'] = $this->mestado->getAll();
        $data['zona'] = $this->mzona->getExcept1();

        if ($propiedades != ''){ 
            $total_rows = $propiedades->num_rows();
            $pages=6;
            $this->load->library('pagination');
            $config['base_url']	= base_url().'/propiedades/siguiente/'.$uri.'-'.$id_tipo_propiedad.'/';
            $config['total_rows'] = $total_rows;//calcula el nmero de filas
            $config['per_page'] = $pages; //Nmero de registros mostrados por pginas
            $config['num_links'] = 3;
            $config['full_tag_open'] = '<ul style="list-style:none;">';//el div que debemos maquetar
            $config['full_tag_close'] = '</ul>';//el cierre del div de la paginacin
            $this->pagination->initialize($config); //inicializamos la paginacin
            $data["propiedades"] = $this->mpropiedad->search($v,$config['per_page'],0);
            //$data["propiedades"] = $this->mpropiedad->getLimit($config['per_page'],$uriLimit);//$this->uri->segment(3)
            $data['paginationC'] = $this->pagination->create_links();
        }else{
            $data["propiedades"] = '';
        }    

/*        $description = html2text($data['propiedades']->row(1)->descripcion_corta);
        $this->data['titulo'] = 'Antesala, Inmobiliaria';
        $this->data['meta_tags'] = array(
            'meta_description' => $description,
            'meta_keywords' => '',
            'meta_robots' => $this->meta_robots,
            'meta_rating' => $this->meta_rating,
            'meta_distribution' => $this->meta_distribution,
            'meta_copyright' => $this->meta_copyright,
            'meta_author' => $this->meta_author
        );*/

        $this->data['contenido'] = $this->load->view($this->mainView.'/index_view',$data,true);
        $this->load->view('templates/propiedades_template',$this->data);

    }

    public function siguiente2($id = 0){
        $data = array();
        $data['ocultar_filtros'] = false;
        $data['filtros'] = '';
        $data['scroll'] = true;
        $data['total_resultados'] = '';
        $data['id_venta'] = '';
        $data['id_renta'] = '';
        $data['id_tipo'] = '';
        $data['all_id_filtro'] = array();
        $uri = $this->uri->segment(3);
        if ($uri != 'propiedad'){
            $data['uri'] = $uri;
        }else {$data['uri'] = ''; }
        $uriLimit = $this->uri->segment(4);
        if ( $uriLimit == '' ){ $uriLimit = 0; }

        $data['tipo_propiedad'] = $this->mtipopropiedad->getAll();
        $data['tipo_operacion'] = $this->moperacion->getAll();
        $data['estado'] = $this->mestado->getAll();
        $data['zona'] = $this->mzona->getExcept1();

        $v = array();
        list($estado, $tipoPropiedad, $precioI, $precioF, $venta, $renta, $ciudad, $tipos) = explode("_",$uri);

        $est = explode("-",$estado);
        $v['estado'] = $est[1];

        $tipoP = explode("-",$tipoPropiedad);
        $v['id_tipo_propiedad'] = $tipoP[1];
        $id_propiedad = $v['id_tipo_propiedad'];

        $pI = explode("-",$precioI);
        $v['precioI'] = $pI[1];

        $pF = explode("-",$precioF);
        $v['precioF'] = $pF[1];

        $vent = explode("-",$venta);
        $v['venta'] = $vent[1];

        $rent = explode("-",$renta);
        $v['renta'] = $rent[1];

        $ciu = explode("-",$ciudad);
        $v['ciudad'] = $ciu[1];

        $explode_tipos = explode("=", $tipos);
        $v['tipo'] = $explode_tipos[1];
        $explode_val = explode("-",$explode_tipos[1]);
        $val = array();
        $t = 0;
        foreach ($explode_val as $vt) {
            //array_push($val, $v);
            $val[$t] = $vt;
            $t++;
        }

            $data['all_id_filtro'] = $val;

            switch ($id_propiedad) {

                //=======CASAS======== 
                //VENTA
                case ($id_propiedad == 4 && $vent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 1500000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 1500000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 4 && $vent[1]==1 && $explode_tipos[1] == 2):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 1499999;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 1499999;
                    break;

                case ($id_propiedad == 4 && $vent[1]==1 && $explode_tipos[1] == 1):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;
                //RENTA
                case ($id_propiedad == 4 && $rent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 20000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 20000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 4 && $rent[1]==1 && $explode_tipos[1] == 2):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 19999;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 19999;
                    break;

                case ($id_propiedad == 4 && $rent[1]==1 && $explode_tipos[1] == 1):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;


                //======DEPAS=======
                    //VENTA
                case ($id_propiedad == 3 && $vent[1]==1 && $explode_tipos[1] == 6):
                    $data['minPrice'] = 1500000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 1500000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 3 && $vent[1]==1 && $explode_tipos[1] == 5):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 1490000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 1490000;
                    break;

                case ($id_propiedad == 3 && $vent[1]==1 && $explode_tipos[1] == 4):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;
                //RENTA
                case ($id_propiedad == 3 && $rent[1]==1 && $explode_tipos[1] == 6):
                    $data['minPrice'] = 18000;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 18000;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 3 && $rent[1]==1 && $explode_tipos[1] == 5):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 14999;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 14999;
                    break;

                case ($id_propiedad == 3 && $rent[1]==1 && $explode_tipos[1] == 4):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                //======DESARROLLOS COMERCIALES=======
                    //VENTA
                case ($id_propiedad == 2 && $vent[1]==1 && $explode_tipos[1] == 9):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $vent[1]==1 && $explode_tipos[1] == 8):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $vent[1]==1 && $explode_tipos[1] == 7):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;
                //RENTA
                case ($id_propiedad == 2 && $rent[1]==1 && $explode_tipos[1] == 9):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $rent[1]==1 && $explode_tipos[1] == 8):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 2 && $rent[1]==1 && $explode_tipos[1] == 7):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;


                //======TERRENOS=======
                    //VENTA
                case ($id_propiedad == 1 && $vent[1]==1 && $explode_tipos[1] == 11):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 1 && $vent[1]==1 && $explode_tipos[1] == 10):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

/*                case ($id_propiedad == 1 && $vent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;*/

                //RENTA
                case ($id_propiedad == 1 && $rent[1]==1 && $explode_tipos[1] == 11):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

                case ($id_propiedad == 1 && $rent[1]==1 && $explode_tipos[1] == 10):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;

/*                case ($id_propiedad == 1 && $rent[1]==1 && $explode_tipos[1] == 3):
                    $data['minPrice'] = 0;
                    $data['maxPrice'] = 50000000;
                    $data['populadoMin'] = 0;
                    $data['populadoMax'] = 50000000;
                    break;*/


                default:
                    $data['minPrice'] = $this->mpropiedad->getMinPrice($id_propiedad)->row()->precio;
                    $data['maxPrice'] = $this->mpropiedad->getMaxPrice($id_propiedad)->row()->precio;
                    $data['populadoMin'] = $this->mpropiedad->getMinPrice($id_propiedad)->row()->precio;
                    $data['populadoMax'] = $this->mpropiedad->getMaxPrice($id_propiedad)->row()->precio;
                    break;
            }


/*            $data['minPrice'] = $this->mpropiedad->getMinPrice($id_propiedad)->row()->precio;
            $data['maxPrice'] = $this->mpropiedad->getMaxPrice($id_propiedad)->row()->precio;
            $data['populadoMin'] = $this->mpropiedad->getMinPrice($id_propiedad)->row()->precio;
            $data['populadoMax'] = $this->mpropiedad->getMaxPrice($id_propiedad)->row()->precio; */

                $data['id_tipo_propiedad'] = $id_propiedad;
                $data['nombre_tipo_propiedad'] = $this->mtipopropiedad->getById($id_propiedad);
                $data['filtros'] = $this->mfiltro_tipo_propiedad->getByIdPropiedad($id_propiedad);
                $data['ciudades'] = $this->mpropiedad->getIdEstado($id_propiedad);
                $data['mciudad'] = $this->mestado;

        $propiedades = $this->mpropiedad->search($v);
            if ($propiedades != ''){
                $data['total_resultados'] = $propiedades->num_rows();
            }  
        /*Paginación por búsqueda*/

        if ($propiedades != ''){
            $total_rows = $propiedades->num_rows();

            $pages=6;
            $this->load->library('pagination');
            $config['base_url']	= base_url().'/propiedades/siguiente2/'.$uri.'';
            $config['total_rows'] = $total_rows;//calcula el nmero de filas
            $config['per_page'] = $pages; //Nmero de registros mostrados por pginas
            $config['num_links'] = 3;
            $config['full_tag_open'] = '<ul style="list-style:none;">';//el div que debemos maquetar
            $config['full_tag_close'] = '</ul>';//el cierre del div de la paginacin
            $this->pagination->initialize($config); //inicializamos la paginacin
            $data["propiedades"] = $this->mpropiedad->search($v,$config['per_page'],$uriLimit);//$this->uri->segment(3)
            $data['paginationC'] = $this->pagination->create_links();

/*            $description = html2text($data['propiedades']->row(1)->descripcion_corta);
            $keyword = $data["propiedades"]->row(1);
            $this->data['titulo'] = 'Antesala, Inmobiliaria, Acabados, Constructora';
            $this->data['meta_tags'] = array(
                'meta_description' => $description,
                'meta_keywords' => $keyword->tipo_operacion.' ,'.$keyword->tipo_propiedad.' ,'.$keyword->titulo,
                'meta_robots' => $this->meta_robots,
                'meta_rating' => $this->meta_rating,
                'meta_distribution' => $this->meta_distribution,
                'meta_copyright' => $this->meta_copyright,
                'meta_author' => $this->meta_author
            );*/


        }else{
            $data['propiedades'] = '';
        }
        $data['id_estado'] = $v['estado'];
        $data['id_ciudad'] = $v['ciudad'];
        $data['id_venta'] = $vent[1];
        $data['id_renta'] = $rent[1];
        $data['id_tipo'] = $explode_tipos[1];

        $data['id_propiedad'] = $v['id_tipo_propiedad'];
        if ($v['venta'] == 1){ $data['operacion'] = $v['venta']; }else{ $data['operacion'] = null; }
        if ($v['renta'] == 1){ $data['operacion'] = $v['renta']; }else{ $data['operacion'] = null; }



        $this->data['contenido'] = $this->load->view($this->mainView.'/index_view',$data,true);
        $this->load->view('templates/propiedades_template',$this->data);

    }

    public function obtenerPropiedad(){

        if (isset($_POST['elegido'])){
            $f = $this->input->post('elegido',true);
            $s = $this->mestado->getByIdUbicacion($f);
            if ($s != ''){
                echo "<option value=\"\">Todas</option>\"";
                foreach ($s->result() as $v) {
                    echo "<option value=\"".$v->tp_id."\">".$v->titulo."</option>\"";
                }
            }

        }

    }

    public function ver($cadena = null,$url = null){
        $data = array();

        if ($url != null){
            list($estado, $tipoPropiedad, $precioI, $precioF, $venta, $renta, $ciudad, $tipos) = explode("_",$url);

            $est = explode("-",$estado);
            $data['id_estado'] = $est[1];

            $tipoP = explode("-",$tipoPropiedad);
            $data['id_propiedad'] = $tipoP[1];

            $pI = explode("-",$precioI);
            $data['populadoMin'] = $pI[1];

            $pF = explode("-",$precioF);
            $data['populadoMax'] = $pF[1];

            $vent = explode("-",$venta);
            $v['venta'] = $vent[1];

            $rent = explode("-",$renta);
            $v['renta'] = $rent[1];

            $explode_tipos = explode("=", $tipos);
            $v['tipo'] = $explode_tipos[1];
            $explode_val = explode("-",$explode_tipos[1]);
            $val = array();
            $t = 0;
            foreach ($explode_val as $vt) {
                //array_push($val, $v);
                $val[$t] = $vt;
                $t++;
            }

            $all_id_filtro = $val;            

            if ( ($v['venta'] != '') && ($v['venta'] != 0) ){ $data['checkedv'] = 'checked'; $data['operacion'] = 1; }else{ $data['checkedv'] = ''; }
            if ( ($v['renta'] !='') && ($v['renta'] !=0) ){ $data['checkedr'] = 'checked'; $data['operacion'] = 2; }else{ $data['checkedr'] = ''; }
            if ( ($v['venta'] == 1) && ($v['renta'] == 1) ){ $data['operacion'] = ''; }

        }

        $id=explode("-",$cadena);
        $data['sliders'] = $this->mpropiedad->getPhotoByIdPropiedad($id[0]);
        $data['propiedades'] = $this->mpropiedad->getById($id[0]);
        $pr = $data['propiedades']->row();
        $data['ciudad'] = $this->mciudad->getById($data['propiedades']->row()->ciudad);
        $data['colonia'] = $this->mcolonias->getById($data['propiedades']->row()->colonia);
        $data['tipo_propiedad'] = $pr->id_tipo_propiedad;
        $data['propiedad'] = $data['propiedades']->row();
        $data['zona'] = $this->mzona->getById($data['propiedades']->row()->zona);
        $data['status'] = $this->moperacion->getById($data['propiedades']->row()->id_operacion);
        $data['estado'] = $this->mestado->getById($data['propiedades']->row()->estado);
        $data['planos_propiedad'] = $this->mfoto_planos->getAllByIdPropiedad($data['propiedades']->row()->id);
        $data['fotos_propiedad'] = $this->mfoto_propiedad->getAllByIdPropiedad($data['propiedades']->row()->id);
        $ids_filtros = $this->mpropiedad->getById($id[0])->row()->id_filtro;
        $ids_servicios = $this->mpropiedad->getById($id[0])->row()->id_servicio;
        $ids_seguridad = $this->mpropiedad->getById($id[0])->row()->id_seguridad;
        $ids_amenidad = $this->mpropiedad->getById($id[0])->row()->id_amenidad;

        $explode_tipos = explode(",", $ids_filtros);
        $val = array();
        $t = 0;
        foreach ($explode_tipos as $vt) {
            //array_push($val, $v);
            $val[$t] = $vt;
            $t++;
        }

        //print_r($val);
        $filtros = $this->mfiltro_tipo_propiedad->getByIdIn($ids_filtros);
        $data['amenidades'] = $this->mamenidad->getByIdIn($ids_amenidad);
        $data['servicios'] = $this->mservicio->getByIdIn($ids_servicios);
        $data['seguridad'] = $this->mseguridad->getByIdIn($ids_seguridad);
        //print_r($data['seguridad']->result());


        $this->data['contenido'] = $this->load->view($this->mainView.'/detail_view',$data,true);
        $this->load->view('templates/ficha_propiedad_template',$this->data);
    }

    function sendContacto(){

        $msg = "";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pnombre', 'Nombre', 'required|min_length[2]|trim|xss');
        $this->form_validation->set_rules('pemail', 'Email', 'trim|required|valid_email|xss');
        $this->form_validation->set_rules('ptelefono', 'Teléfono', 'min_length[10]|trim|required|xss');
        $this->form_validation->set_rules('pfecha', 'Fecha', 'xss');
        $this->form_validation->set_rules('phora', 'Hora', 'xss');
        $this->form_validation->set_rules('pmensaje', 'Mensaje', 'xss');
        if ($this->form_validation->run() == FALSE)        {
            $msg = validation_errors();
            $status = 0;
        } else {



            $idPropiedad = $this->input->post("idPropiedad");
            $propiedad = $this->mpropiedad->getById($idPropiedad);
            $pro = $propiedad->row();
            $tipo_propiedad = $this->mtipopropiedad->getById($propiedad->row()->id_tipo_propiedad);
            $status = $this->moperacion->getById($propiedad->row()->id_operacion);
            $colonia = $this->mcolonias->getById($propiedad->row()->colonia);
            $zona = $this->mzona->getById($propiedad->row()->zona);

            $estado = $this->mestado->getById($propiedad->row()->estado);
            $ciudad= $this->mciudad->getById($propiedad->row()->ciudad);

            $codigo = $this->mpropiedad->getCampo("codigo",$idPropiedad);

            // info contacto
            $pcontacto['nombre']  = $this->input->post('pnombre');
            // $pcontacto['ciudad'] = $this->input->post('pciudad');
            $pcontacto['telefono'] = $this->input->post('ptelefono');
            $pcontacto['email'] = $this->input->post('pemail');
            $pcontacto['fecha'] = $this->input->post('pfecha');
            $pcontacto['hora'] = $this->input->post('phora');
            $pcontacto['mensaje'] = $this->input->post('pmensaje');
            $pcontacto['medio'] = $this->input->post('pmedio');

            if( isset($propiedad->row()->oferta) && ($propiedad->row()->oferta != 0) ){
                $enOferta = "En oferta";
            }else { $enOferta = ''; }
            if($propiedad->row()->plantas!="Ninguno"){
                $plantas = "Plantas: ".$propiedad->row()->plantas;
            }else { $plantas = ''; }
            if($propiedad->row()->cuartos!="Ninguno"){
                $cuartos = "Cuartos: ".$propiedad->row()->cuartos;
            }else { $cuartos = ''; }
            if($propiedad->row()->banos!="Ninguno"){
                $banios = "Baños: ".$propiedad->row()->banos;
            }else { $banios = ''; }
            if($propiedad->row()->garage!="No"){
                if($propiedad->row()->garage!="Ninguno"){
                    $garage = "Garage: ".$propiedad->row()->garage;
                }else { $garage = ''; }
            }else { $garage = ''; }
            if($propiedad->row()->piscina!="No"){
                if($propiedad->row()->piscina!="Ninguno"){
                    $piscina = "Piscina: ".$propiedad->row()->piscina;
                }else { $piscina = ''; }
            }else { $piscina = ''; }

            // Mensaje al cliente
            $msgCliente = "
                    --
                    Nombre: ".$pcontacto['nombre']."<br>
                    Email: ".$pcontacto['email']."<br>
                    Teléfono: ".$pcontacto['telefono']."<br>
                    Fecha: ".$pcontacto['fecha']."<br>
                    Hora: ".$pcontacto['hora']."<br>
                    Mensaje: ".$pcontacto['mensaje']."<br><br>
                    --";
            $msgPropiedad = "
                    Interesado en<br>
                    Tipo de propiedad: ".$tipo_propiedad->row()->titulo."<br>
                    ".$enOferta."
                    Propiedad: ".$propiedad->row()->titulo."<br>
                    Estatus: ".$status->row()->titulo."<br>
                    Precio: $".number_format($propiedad->row()->precio)."<br>
                    ".$plantas."
                    ".$cuartos."<br>
                    ".$banios."<br>
                    Ubicación: ".$pro->direccion;


            $msgPropiedad .= "
                    <br> Ciudad: ".utf8_decode($ciudad->row()->titulo)."<br>
                    Estado: ".utf8_decode($estado->row()->titulo)                    
  ;

            $mensaje = $msgCliente .' '. $msgPropiedad;
            $email_form = $pcontacto['email'];
            //$headers="MIME-Version: 1.0\r\nContent-type: text/plain; charset=utf-8\r\nFrom:".$pcontacto['email'];
            $headers = "MIME-Version: 1.0" . "\n";
            $headers .= "Content-type:text/html;charset=utf-8" . "\n";
            $headers .= "From: Antesala <$email_form>" . "\n";
            $subject1="Información Propiedades Antesala";
            $msent = @mail('aviles1189@gmail.com', $subject1, $mensaje,$headers);
            @mail('jesus@navegantes.mx', $subject1, $mensaje,$headers);
            @mail('ventas@antesala.com.mx', $subject1, $mensaje,$headers);
            @mail('agonzalez@antesala.com.mx', $subject1, $mensaje,$headers);
            @mail('jcan@antesala.com.mx', $subject1, $mensaje,$headers);

                $liga="http://www.antesala.com.mx/emailresources";
$cuerpo='
<span class="lato-light" style="color: #6e6d6d; font-size: 18px; text-decoration: none;">Gracias por ponerte en contacto con nosotros.</span><br>
                  <span class="lato-light" style="color: #6e6d6d; font-size: 18px; text-decoration: none;">
                  Hemos recibido tu correo, en breve nos </span><br>
                  <span class="lato-light" style="color: #6e6d6d; font-size: 18px; text-decoration: none;">
                  comunicaremos contigo.
                  </span><br>
                  <br>
                  <br>
                  <br>';
//echo
$mensaje = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Email</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
<link href="https://fonts.googleapis.com/css?family=Lato:300,700" rel="stylesheet" type="text/css">
<style>


body, tr, td, span, div, p, a, li {
    -moz-text-size-adjust:none !important;
    -webkit-text-size-adjust:none !important;
    margin:0px !important;
    -ms-text-size-adjust:none !important;
    white-space: wrap;
}
.lato-light{
  font-family: "lato" sans-serif !important;
  font-weight: 300;
}
.lato-bold{
  font-family: "lato" sans-serif !important;
  font-weight: 700;
}
td img {
    display: block;
}
.ReadMsgBody {
    width: 100%;
}
.ExternalClass * {
    line-height: 100%;
}
 @media only screen and (max-width:480px) {
  #logosim{
    padding:0!important;
  }
*[class="code4email_wrapper"] {
 width: 100% !important;
}
*[class="code4email_main_table"] {
 width: 320px !important;
}
*[class="code4email_hide"] {
 display: none !important;
}
*[class="code4email_hide"] {
 display: none !important;
}
*[class="code4email_center"] {
 text-align: center !important;
 padding:10px !important;
 height:20px !important;
}
*[class="code4email_clear"] {
 width: 100% !important;
 clear: both !important;
 float: left !important;
}
*[class="code4email_br"] {
 display:block !important;
 width: 1px !important;
 height:6px !important;
 clear: both !important;
}
*[class="code4email_text_p10"] {
 padding: 0px 10px 10px 10px !important;
 height:20px !important;
}
*[class="code4email_w20"] {
 width: 20px !important;
}
*[class="code4email_h20"] {
 height: 20px !important;
}
*[class="code4email_h20_center"] {
 height: 20px !important;
 text-align: center !important;
}
}
 @media only screen and (min-width:480px) and (max-width:599px) {
*[class="code4email_wrapper"] {
 width: 100% !important;
}
*[class="code4email_main_table"] {
 width: 480px !important;
}
*[class="code4email_hide"] {
 display: none !important;
}
*[class="code4email_hide"] {
 display: none !important;
}
*[class="code4email_center"] {
 text-align: center !important;
 padding:10px !important;
 height:20px !important;
}
*[class="code4email_clear"] {
 width: 100% !important;
 clear: both !important;
 float: left !important;
}
*[class="code4email_br"] {
 display:block !important;
 width: 1px !important;
 height:6px !important;
 clear: both !important;
}
*[class="code4email_text_p10"] {
 padding: 0px 10px 10px 10px !important;
 height:20px !important;
}
*[class="code4email_w20"] {
 width: 20px !important;
}
*[class="code4email_h20"] {
 height: 20px !important;
}
*[class="code4email_h20_center"] {
 height: 20px !important;
 text-align: center !important;
}
}
</style>
</head>
<body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" bgcolor="#FFFFFE" style="-moz-text-size-adjust:none !important; padding:0px !important; -webkit-text-size-adjust:none !important; margin:0px ! important; -ms-text-size-adjust:none !important; white-space: wrap;">
<table class="code4email_wrapper" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFE"><table class="code4email_wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="650" style="width:650px;">

        <tr>
          <td>
          <a href="'.$liga.'/../" target="_blank">
              <table   height="17px" background="'.$liga.'/header.png" class="code4email_wrapper"  width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td align="" valign="middle" width="650" height="17" style="margin:0px; padding:0px; height:17px; width: 15%;">
                  <br>
                  <br><br><br>
                  <br><br><br>
                  <br><br>
                  </td>
                  <td align="left">

                  </td>
                </tr>

              </table>
              </a>
          </td>
        </tr>
        <tr>
          <td align="left" valign="top" style="line-height:12px; padding:0px; margin:0px; font-size:12px; width:650px;">
          <table  background="'.$liga.'/footer.png" class="code4email_wrapper" align="center" border="0" cellpadding="0" cellspacing="0" width="650" style="width:650px;">
              <tr>
                <td colspan="3" align="right" style="padding-top:12px;padding-right:15px;">
                    <a href="https://www.instagram.com/antesalainmobiliaria/" style="display:inline-table;"><img src="'.$liga.'/icon-instagram.png" /></a>
                  <a href="https://www.facebook.com/Antesala-Inmobiliaria-1655079281375203/" style="display:inline-table;"><img src="'.$liga.'/face.png" /></a>
                </td>
              </tr>
              <tr>
                <td align="left" valign="top" width="58" height="91" style="margin:0px; padding:0px; height:91px; width:58px; line-height:12px; font-size:12px;" class="code4email_hide">&nbsp;</td>
                <td align="left" valign="middle" width="600" height="91" style="width:630px; margin:0px; height:91px; padding-bottom:25px; padding-top:50px; font-family: Arial, Helvetica, sans-serif; color: #333333; font-size: 14px; mso-line-height-rule:exactly; white-space: wrap; line-height:20px;" class="code4email_center"><span style="color: #5b5b5f; font-size: 14px; text-decoration: none;" class="lato-light">
                  <span class="lato-light" style="font-size:37px;color:#fff">¡Hola!</span> <br><br>
                  '.$cuerpo.'
                  <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                </td>
                <td align="left" valign="top" width="58" height="91" style="margin:0px; padding:0px; height:91px; width:58px; line-height:12px; font-size:12px;" class="code4email_hide">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" style="padding-left: 35px;padding-bottom: 15px;">
                  <table>
                      <tr>
                        <td align="right">
                          <img src="'.$liga.'/marker.png">
                        </td>
                        <td align="left" style="padding-left:12px;width:200px;">
                          <span class="lato-light" style="color: #fff; font-size: 15px; text-decoration: none; line-height:22px;">
                            Dirección: Calle 48 #287 <br>por 73 y 75
                            Cordemex. Mérida Yuc.
                          </span>
                        </td>
                        <td align="right" style="width: 390px;">

                        </td>
                      </tr>
                       <tr>
                        <td align="right">
                          <img src="'.$liga.'/phone.png">
                        </td>
                        <td align="left" style="padding-left:12px;width:200px;">
                          <span class="lato-light" style="color: #fff; font-size: 15px; text-decoration: none;">
                            Cel: 9991 09 72 58
                          </span>
                        </td>
                        <td align="right" style="width: 390px;">

                        </td>
                      </tr>
                  </table>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <!--SOCIAL MEDIA STARTS HERE-->
        <td align="left" valign="top">


          <!--SOCIAL MEDIA STARTS HERE-->
              <table   class="code4email_wrapper"  width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td  valign="middle" width="650" height="50" style="margin:0px; padding:0px; height:291px; width: 15%;">


                  </td>
                  <td align="left">

                  </td>
                  <td rowspan="2">

                  </td>
                </tr>


              </table>
            </td>

  </tr>
</table>
</body>
</html>';
/*        $message2 = "".
            "Información recibida.<br>".
            "Gracias por ponerte en contacto con nosotros.<br>".
            "Hemos recibido tu correo y nos pondremos en contacto contigo a la brevedad.<br>";*/



            $message2 = $msgPropiedad;

            $headers2 = "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nFrom: Antesala <ventas@antesala.com.mx>";
            @mail($pcontacto['email'], $subject1, $mensaje,$headers2);






            if ($msent){
                $status = 1;
                $msg = "Muchas gracias por tu inter&eacute;s, muy pronto una persona se pondr&aacute; en contacto contigo.";
                                    $cData['success1'] = true;
                    $cData['mensaje'] = true;

            } else {
                $status = 0;
                $msg = "Error al enviar el mensaje";
                $cData['error']=true;
            }


        }


        $data = json_encode(array("status" => $status,"msg" => $msg));
        echo $data;
    }

    function compartir(){
        $msg = "";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Tu Email', 'trim|required|valid_email|xss');
        $this->form_validation->set_rules('pemail[]', 'Email(s) a enviar', 'trim|required|valid_email|xss');
        $this->form_validation->set_rules('pmensaje', 'Comentarios', 'trim|xss');
        $this->form_validation->set_rules('urlPropiedad', 'Url propiedad', 'trim|xss');
        if ($this->form_validation->run() == FALSE)        {
            $msg = validation_errors();
            $status = 0;
        } else {


            $email = $this->input->post("email");
            $idPropiedad = $this->input->post("idPropiedad");
            $mensajeenvio = $this->input->post("pmensaje");
            $emails = $this->input->post("pemail");
            $url = $this->input->post("urlPropiedad",true);



            $cData['propiedad'] = $this->mpropiedad->getById($idPropiedad);

            $cData['ciudad'] = $this->mciudad->getById($cData['propiedad']->row()->ciudad);
            $cData['tipo_propiedad'] = $this->mtipopropiedad->getById($cData['propiedad']->row()->id_tipo_propiedad);
            $cData['status'] = $this->moperacion->getById($cData['propiedad']->row()->id_operacion);
            $cData['estado'] = $this->mestado->getById($cData['propiedad']->row()->estado);
            $cData['colonia'] = $this->mcolonias->getById($cData['propiedad']->row()->colonia);
            if ($cData['propiedad']->row()->zona != 0){
                $cData['zona'] = $this->mzona->getById($cData['propiedad']->row()->zona);
            }else { $cData['zona'] = ''; }
            $cData['propiedad'] = $cData['propiedad']->row();
            $enOferta = $cData['propiedad']->oferta;
            if( isset($enOferta) && ($enOferta != 0) ){
                $cData['enOferta'] = "En oferta <br><br>";
            }else { $cData['enOferta'] = ''; }

            $data['contenido'] = $this->load->view('propiedades/pdf_view',$cData,true);
            $html = $this->load->view('templates/pdf_template',$data,true);
            $this->dompdf_lib->createPDF2($html, 'Ficha Tecnica '.$idPropiedad.'-'.$cData['propiedad']->titulo);


            if($cData['propiedad']->foto!=""){
                $msgPropiedad = '
                        <br>
                        '.$email.' te ha enviado un mensaje desde el sitio web <a href="http://www.antesala.com.mx/">GRUPO Antesala</a>
                        <br>
                        <br>
                        '.$mensajeenvio.'
                        <br>
                        <a style="font-size:24px" href="'.$url.'">Ver propiedad</a>
                        <br><br>
                        <img src="http://www.navegantes.mx/uploads/propiedad/'.$cData['propiedad']->foto.'"/>';

                $subject1="Información Propiedades Antesala";




                for($i=0;$i<count($emails);$i++){

                    $this->email->clear();
                    $this->email->to($emails[$i]);
                    $this->email->from('ventas@antesala.com.mx');
                    $this->email->subject($subject1);
                    $this->email->set_mailtype("html");
                    $this->email->message($msgPropiedad);
                    if($i==0){
                        $this->email->attach($this->config->item('base_www').'pdfTemporal/'.'Ficha Tecnica '.$idPropiedad.'-'.$cData['propiedad']->titulo.'.pdf');
                    }
                    $msent=$this->email->send();

                }
            }else{
                $msent=FALSE;
            }



            if ($msent){
                $status = 1;
                $msg = "Muchas gracias por tu inter&eacute;s, muy pronto una persona se pondr&aacute; en contacto contigo.";                
                if(file_exists($this->config->item('base_www').'pdfTemporal/'.'Ficha Tecnica '.$idPropiedad.'-'.$cData['propiedad']->titulo.'.pdf')){
                    unlink($this->config->item('base_www').'pdfTemporal/'.'Ficha Tecnica '.$idPropiedad.'-'.$cData['propiedad']->titulo.'.pdf');
                }

            } else {
                $status = 0;
                $msg = "Error al enviar el mensaje";
            }
            //echo $mensaje;

        }


        $data = json_encode(array("status" => $status,"msg" => $msg));
        echo $data;
    }

    public function generatePdf($idPropiedad=0){

        $cData['propiedad'] = $this->mpropiedad->getById($idPropiedad);

        $cData['ciudad'] = $this->mciudad->getById($cData['propiedad']->row()->ciudad);
        $cData['tipo_propiedad'] = $this->mtipopropiedad->getById($cData['propiedad']->row()->id_tipo_propiedad);
        $cData['status'] = $this->moperacion->getById($cData['propiedad']->row()->id_operacion);
        $cData['estado'] = $this->mestado->getById($cData['propiedad']->row()->estado);
        $cData['colonia'] = $this->mcolonias->getById($cData['propiedad']->row()->colonia);
        if ($cData['propiedad']->row()->zona != 0){
            $cData['zona'] = $this->mzona->getById($cData['propiedad']->row()->zona);
        }else { $cData['zona'] = ''; }
        $cData['propiedad'] = $cData['propiedad']->row();
        $enOferta = $cData['propiedad']->oferta;
        if( isset($enOferta) && ($enOferta != 0) ){
            $cData['enOferta'] = "En oferta <br><br>";
        }else { $cData['enOferta'] = ''; }

        $data['contenido'] = $this->load->view('propiedades/pdf_view',$cData,true);
        $html = $this->load->view('templates/pdf_template',$data,true);
        $this->dompdf_lib->createPDF($html, 'Ficha Tecnica');
    }



}

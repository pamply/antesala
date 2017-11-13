<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    // Validation default parameters
    $config = array(
        // Validaciones en controlador contacto
        'contacto' =>  array(
            array(
                'field'   => 'nombre',
                'label'   => 'Nombre',
                'rules'   => 'required|xss'
            ),
            array(
                'field'   => 'apellido',
                'label'   => 'Apellido',
                'rules'   => 'required|xss'
            ),
            array(
                'field'   => 'pais',
                'label'   => 'País',
                'rules'   => 'required|xss'
            ),
            array(
                'field'   => 'estado',
                'label'   => 'Estado/Ciudad',
                'rules'   => 'required|xss'
            ),
            array(
                'field'   => 'correo',
                'label'   => 'Correo',
                'rules'   => 'required|valid_email|xss'
            ),
            array(
                'field'   => 'telefono',
                'label'   => 'Teléfono',
                'rules'   => 'required|numeric|exact_length[10]|xss'
            ),
            array(
                'field'   => 'mensaje',
                'label'   => 'Comentarios',
                'rules'   => 'required|xss'
            ),
            array(
                'field'   => 'comonos',
                'label'   => '¿cómo se enteró de nosotros?',
                'rules'   => 'xss'
            )

        ),
        'footer' =>  array(
            array(
                'field'   => 'nombre',
                'label'   => 'Nombre',
                'rules'   => 'required|xss'
            ),
            array(
                'field'   => 'correo',
                'label'   => 'Email',
                'rules'   => 'required|valid_email|xss'
            ),
            array(
                'field'   => 'mensaje',
                'label'   => 'Mensaje',
                'rules'   => 'required|xss'
            )

        ),
        'propiedades' =>  array(
            array(
                'field'   => 'pnombre',
                'label'   => 'Nombre',
                'rules'   => 'required|xss'
            ),
            array(
                'field'   => 'pemail',
                'label'   => 'Email',
                'rules'   => 'required|valid_email|xss'
            ),
            array(
                'field'   => 'ptelefono',
                'label'   => 'Teléfono',
                'rules'   => 'required|numeric|xss' //required|numeric|exact_length[10]|xss
            ),
            array(
                'field'   => 'pmensaje',
                'label'   => 'Mensaje',
                'rules'   => 'required|xss'
            )

)

    );

<!DOCTYPE html>
<html class="no-js">
<head>
    <base href="<?php echo base_url(); ?>" />
    <title><?php echo $titulo; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,requiresActiveX=true">
    
    <meta name="description" content="">

    <?php
    if (isset($meta_tags)):
        ?>
        <meta name="description" content="<?php echo $meta_tags['meta_description'];?>" />
        <meta name="keywords" content="<?php echo $meta_tags['meta_keywords'];?>" />
        <meta name="robots" content="<?php echo $meta_tags['meta_robots'];?>" />
        <meta name="rating" content="<?php echo $meta_tags['meta_rating'];?>" />
        <meta name="distribution" content="<?php echo $meta_tags['meta_distribution'];?>" />
        <meta name="copyright" content="<?php echo $meta_tags['meta_copyright'];?>" />
        <meta name="author" content="<?php echo $meta_tags['meta_author'];?>" />
    <?php endif;?>
    <!-- /// Favicons ////////  -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144-precomposed.png">
    <link rel="shortcut icon" href="favicon.png">
        
        
    <!-- /// Google Fonts ////////  -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    
    <!-- /// FontAwesome 4.3 Icons ////////  -->
    <link rel="stylesheet" href="css/fontawesome/font-awesome.min.css">
    
    <!-- /// Template CSS ////////  -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/elements.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- /// Cross-browser CSS3 animations ////////  -->
    <link rel="stylesheet" href="css/animate/animate.min.css">
    
    <!-- /// bxSlider ////////  -->
    <link rel="stylesheet" href="js/bxslider/jquery.bxslider.css">
    
    <!-- /// RevolutionSlider ////////  -->
    <link rel="stylesheet" href="js/rs-plugin/css/settings.css">
    
    <!-- /// Magnific Popup ////////  -->
    <link rel="stylesheet" href="js/magnificpopup/magnific-popup.css">
    
        
    <!-- /// Modernizr ////////  -->
    <script src="js/modernizr-2.6.2.min.js"></script>

    <?php
        if (isset($css) && count($css) >0):
            foreach ($css as $value):
                if($value!=''):
                ?>
                <link rel="stylesheet" type="text/css" href="<?php echo $value; ?>" />
            <?php
                endif;
            endforeach;
        endif;
    ?>
    <?php
        if (isset($fjs) && count($fjs) >0):
            foreach ($fjs as $value):
                if($value!=''):
                ?>
                <script type="text/javascript" src="<?php echo $value; ?>"></script>
            <?php
                endif;
            endforeach;
        endif;
    ?>
    <?php  if (isset($raw_fjs) ):
        echo $raw_fjs;
    endif;
    ?>
    
</head>
<body>
    
    <noscript>
        <p class="javascriptrequired">You seem to have Javascript disabled. this website needs javascript in order to function properly.</p>
    </noscript>
        
    <!--[if lte IE 8]>
        <p class="browserupdate">
            You are using an <strong>outdated</strong> browser. Please 
            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">upgrade your browser</a> 
            to improve your experience.
         </p>
    <![endif]-->
 
    <div id="wrap">
    
    <?php echo modules::run('header/header/index'); ?>

        <div id="content">
        
        <!-- /// CONTENT  /////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            <?php echo $contenido; ?>                  
            
        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        
        </div><!-- end #content -->

    <?php echo modules::run('footer/footer/index'); ?>
        
    </div><!-- end #wrap -->

    
    <!-- /// jQuery ////////  -->
    <script src="js/jquery-2.0.3.min.js" ></script>
    
    <!-- /// ViewPort ////////  -->
    <script src="js/viewport/jquery.viewport.js"></script>
 
    <!-- /// Waypoints ////////  -->
    <script src="js/waypoints/waypoints.min.js"></script>

    <!-- /// Superfish ////////  -->
    <script src="js/superfish/superfish.js"></script>
    <script src="js/superfish/hoverIntent.js"></script>
    
    <!-- /// bxSlider ////////  -->
    <script src="js/bxslider/plugins/jquery.easing.1.3.js"></script>
    <script src="js/bxslider/plugins/jquery.fitvids.js"></script>
    <script src="js/bxslider/jquery.bxslider.min.js"></script>
    
    <!-- /// RevolutionSlider ////////  -->
    <script src="js/rs-plugin/pluginsources/jquery.themepunch.plugins.min.js"></script>
    <script src="js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    
    <!-- /// Parallax ////////  -->
    <script src="js/parallax/jquery.parallax.min.js"></script>
    
    <!-- /// Magnific Popup ////////  -->
    <script src="js/magnificpopup/jquery.magnific-popup.min.js"></script>

    <!-- /// EasyPieChart ////////  -->
    <script src="js/easypiechart/jquery.easypiechart.min.js"></script>
  
    <!-- /// Tabs ////////  -->
    <script src="js/tabify/jquery.tabify.min.js"></script>

    
    <!-- /// Isotope ////////  -->
    <script src="js/isotope/jquery.isotope.min.js"></script>

    <!-- /// Custom JS ////////  -->
    <script src="js/plugins.js"></script>   
    <script src="js/scripts.js"></script>

    <?php
        if (isset($js) && count($js) >0):
        if (is_array($js)){ 
        foreach ($js as $value):
            if($value!=''):
        ?>
    <script type="text/javascript" src="<?php echo $value; ?>"></script>
    <?php
            endif;
            endforeach;
        }
        endif;
    ?>
    <?php
        if (isset($raw_js)):
        echo $raw_js;
        endif;
    ?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-49465411-1', 'gruposvm.com');
        ga('send', 'pageview');

    </script>
</body>
</html>

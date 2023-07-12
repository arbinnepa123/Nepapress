<?php

function add_css()

{

   wp_register_style('first', get_template_directory_uri() . '/assets/css/style-starter.css', false,'1.1','all');

   wp_enqueue_style( 'first');
   wp_register_style('second', get_template_directory_uri() . '/assets/css/jquery-ui.css', false,'1.1','all');

   wp_enqueue_style( 'second');

}

add_action('wp_enqueue_scripts', 'add_css');
function add_script()

{
   
   wp_register_script('js-script', get_template_directory_uri() . '/assets/js/date_pick.js', array ( 'jquery' ), 1.1, true);

   wp_enqueue_script( 'js-script');

   wp_register_script('js-script2', get_template_directory_uri() . '/assets/js/jquery-1.10.2.js', array ( 'jquery' ), 1.1, true);

   wp_enqueue_script( 'js-script2');

   wp_register_script('js-script3', get_template_directory_uri() . '/assets/js/jquery-ui.js', array ( 'jquery' ), 1.1, true);

   wp_enqueue_script( 'js-script3');

   wp_register_script('change', get_template_directory_uri() . '/assets/js/theme-change.js', array ( 'jquery' ), 1.1, true);

   wp_enqueue_script( 'change');

   wp_register_script('popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array ( 'jquery' ), 1.1, true);

   wp_enqueue_script( 'popup');

   wp_register_script('carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array ( 'jquery' ), 1.1, true);

   wp_enqueue_script( 'carousel');

   wp_register_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array ( 'jquery' ), 1.1, true);

   wp_enqueue_script( 'bootstrap');

}

add_action('wp_enqueue_scripts', 'add_script');
function enqueue_datepicker_scripts() {
   wp_enqueue_script('jquery-ui-datepicker');
}
add_action('wp_enqueue_scripts', 'enqueue_datepicker_scripts');

function init_datepicker() { ?>
   <script type="text/javascript">
   jQuery(document).ready(function($) {
       $('.datepicker').datepicker({
           dateFormat: 'yy-mm-dd'
       });
   });
   </script>
<?php }
add_action('wp_head', 'init_datepicker');

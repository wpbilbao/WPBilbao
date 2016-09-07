<?php
// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

/*=============================================
=            WPBILBAO FUNCTIONS            =
=============================================*/

/*==========  Functions  ===========*/
@include 'lib/functions/custom-footer.php';
@include 'lib/functions/single-resumenes.php';

/*==========  Sections  ===========*/
@include 'lib/sections/section-autor.php';

<?php

/*
 *
 * @package WPBilbao\Single\Resumenes
 * @author  Ibon Azkoitia
 * @license GPL-2.0+
 * @link    http://www.kreatidos.com
 *
 */

/** Init WPBilbao Single Resumenes **/
add_action('genesis_meta', 'wpbilbao_single_resumenes_meta');

function wpbilbao_single_resumenes_meta() {

  // Force full with content
  add_action('genesis_entry_footer', 'wpbilbao_single_resumenes_content', 1);

}

function wpbilbao_single_resumenes_content() { ?>

  <?php if (get_field('resumenes_presentacion')) : ?>
    <div class="presentacion seccion-single-resumenes">
      <h2><?php _e('Presentación', 'wpbilbao'); ?></h2>
      <?php echo the_field('resumenes_presentacion'); ?>
    </div><!-- .presentacion -->
  <?php endif; ?>

  <?php if (get_field('resumenes_url_video')) : ?>
    <div class="video seccion-single-resumenes">
      <h2><?php _e('Vídeo', 'wpbilbao'); ?></h2>

      <div class="embed-container">
        <?php the_field('resumenes_url_video'); ?>
      </div> <!-- .embed-container -->
    </div> <!-- .video -->
  <?php endif; ?>

  <?php if (have_rows('resumenes_menciones_twitter')) : ?>
    <div class="menciones-twitter seccion-single-resumenes">
      <h2><?php _e('Menciones en Twitter', 'wpbilbao'); ?></h2>

      <p><?php _e('Para completar el resumen de esta presentación os dejamos algunas menciones recogidas de nuestro timeline de Twitter.', 'wpbilbao'); ?></p>
      <?php while (have_rows('resumenes_menciones_twitter')) : the_row(); ?>
        <?php the_sub_field('resumenes_url_tweet'); ?>
      <?php endwhile; ?>
    </div><!-- .menciones-twitter -->
  <?php endif; ?>

  <?php if (get_field('resumenes_url_meetup')) : ?>
    <?php $resumenUrlMeetup = get_field('resumenes_url_meetup'); ?>
    <div class="enlace-meetup seccion-single-resumenes">
      <h2><?php _e('Enlace Meetup', 'wpbilbao'); ?></h2>

      <p><?php printf(__('Si quieres saber qué han comentado los asistentes a este encuentro y dejar tu propia valoración no dejes de pasarte por <a href="%s" title="Enlace Meetup" target="_blank">la página del evento en Meetup</a>.', 'wpbilbao'), $resumenUrlMeetup); ?></p>
    </div> <!-- .enlace-meetup -->
  <?php endif; ?>

  <?php if (get_field('resumenes_nombre_imagen_destacada')) : ?>
    <div class="propiedad-imagen-destacada seccion-single-resumenes">
      <p><strong>Imagen destacada:</strong> <a href="<?php the_field('resumenes_url_imagen_destacada'); ?>" title="Imagen Destacada" target="_blank"><?php the_field('resumenes_nombre_imagen_destacada'); ?></a></p>
    </div><!-- .propiedad-imagen-destacada -->
  <?php endif; ?>

<?php }

genesis();
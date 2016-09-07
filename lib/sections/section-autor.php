<?php
/**
 * Section Autor.
 *
 *
 * @package WPBilbao\Section\Autor
 * @author  Ibon Azkoitia
 * @license GPL-2.0+
 * @link    https://www.wpbilbao.es
 */

// Add custom content before the sidebar widget area
add_action('genesis_before_sidebar_widget_area', 'wpbilbao_single_post_sidebar_autor');

function wpbilbao_single_post_sidebar_autor() {

  if (is_singular('post')) {

    // Assign the 'miembro_escrito_por' field to $miembro_escrito to use it to get the rest of fields
    $miembro_escrito = get_field('miembro_escrito_por');
      $miembro_escrito_nombre = $miembro_escrito[0]['display_name'];
      $miembro_escrito_gravatar = $miembro_escrito[0]['user_avatar'];

    // Assign the 'miembro_traducido_por' field to $miembro_traducido to use it to get the rest of fields
    $miembro_traducido = get_field('miembro_traducido_por');
    $miembro_traducido_nombre = "";
    if ($miembro_traducido) :
      $miembro_traducido_nombre = $miembro_traducido[0]['display_name'];
      $miembro_traducido_gravatar = $miembro_traducido[0]['user_avatar'];
    endif;

    if ($miembro_escrito_nombre != $miembro_traducido_nombre) : ?>

      <section id="miembro-meta" class="widget">
        <h4 class="widget-title"><?php _e('Escrito por', 'wpbilbao'); ?></h4>

        <div class="miembro-meta">
          <div class="miembro-meta-gravatar">
            <?php echo $miembro_escrito_gravatar; ?>
          </div><!-- .miembro-meta-gravatar -->

          <p><?php echo $miembro_escrito_nombre; ?></p>

        </div><!-- .miembro-meta -->
      </section><!-- #miembro-meta -->

      <?php if ($miembro_traducido_nombre) : ?>

        <section id="miembro-meta" class="widget">
          <h4 class="widget-title"><?php _e('Traducido por', 'wpbilbao'); ?></h4>

          <div class="miembro-meta">
            <div class="miembro-meta-gravatar">
              <?php echo $miembro_traducido_gravatar; ?>
            </div> <!-- .miembro-meta-gravatar -->

            <p><?php echo $miembro_traducido_nombre; ?></p>

          </div><!-- .miembro-meta -->
        </section><!-- #miembro-meta -->

      <?php endif; ?>
    <?php else : ?>

      <section id="miembro-meta" class="widget">
        <h4 class="widget-title"><?php _e('Escrito y Traducido por', 'wpbilbao'); ?></h4>

        <div class="miembro-meta">
          <div class="miembro-meta-gravatar">
            <?php echo $miembro_traducido_gravatar; ?>
          </div><!-- .miembro-meta-gravatar -->

          <p><?php echo $miembro_traducido_nombre; ?></p>

        </div><!-- .miembro-meta -->
      </section><!-- #miembro-meta -->

    <?php endif;
  }
}

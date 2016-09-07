<?php
// Customize the entire footer
remove_action('genesis_footer', 'genesis_do_footer');
add_action('genesis_footer', 'wpbilbao_custom_footer');
function wpbilbao_custom_footer() {

  echo '<p>';
    echo '<a href="' . site_url() . '/politica-de-privacidad/" title="' . __( 'Política de Privacidad', 'wpbilbao' ) . '" rel="nofollow">' . __( 'Política de Privacidad', 'wpbilbao' ) . '</a> · ';

    echo '<a href="' . site_url() . '/aviso-legal/" title="' . __( 'Aviso Legal', 'wpbilbao' ) . '" rel="nofollow">' . __( 'Aviso Legal', 'wpbilbao' ) . '</a> · ';

    echo '<a href="' . site_url() . '/politica-de-cookies/"" title="' . __( 'Política de Cookies', 'wpbilbao' ) . '" rel="nofollow">' . __( 'Política de Cookies', 'wpbilbao' ) . '</a>';
  echo '</p>';

  echo '<p>';
    echo 'Copyright ' . do_shortcode( '[footer_copyright]' ) . ' - ' . __( 'Comunidad WordPress Bilbao', 'wpbilbao' ) . ' ' . __( 'it\'s hosted in', 'wpbilbao' ) . ' <a href="http://www.siteground.com/meetup" title="SiteGround" target="_blank">SiteGround</a>';
  echo '</p>';

}
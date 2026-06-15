<?php
/**
 * Funções e definições do tema AqGoes
 */

function aqgoes_theme_scripts() {
    // 1. Preconnect do Google Fonts
    wp_enqueue_style( 'google-fonts-preconnect', 'https://fonts.googleapis.com', array(), null );
    
    // 2. Google Fonts (Syne e DM Sans)
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap', array(), null );

    // 3. O seu arquivo CSS original com todos os seus estilos
    wp_enqueue_style( 'aqgoes-estilos', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all' );

    // 4. O seu arquivo JavaScript do menu mobile
    wp_enqueue_script( 'aqgoes-scripts', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'aqgoes_theme_scripts' );


function aqgoes_theme_config() {
    // Registra a posição do menu do topo para aparecer no painel do WP
    register_nav_menus( array(
        'menu-principal' => 'Menu Principal (Topo)',
        'footer-paginas' => 'Menu Rodapé - Páginas',
        'footer-categoria' => 'Menu Rodapé - Categorias',
    ) );

  // Ativa o suporte a Imagens Destacadas
    add_theme_support( 'post-thumbnails' );

    // Define um tamanho personalizado chamado 'imagem-destaque' (1200px de largura por 675px de altura)
    // O parâmetro 'true' no final ativa o "Hard Crop" (o WordPress corta a imagem exatamente nessa proporção)
    add_image_size( 'imagem-destaque', 1200, 675, true );

}
add_action( 'after_setup_theme', 'aqgoes_theme_config' );


// Filtro para injetar as suas classes e a classe 'active' dinamicamente nos links do menu
function adicionar_classe_nas_ancoras( $atts, $item, $args ) {
    if ( $args->theme_location == 'menu-principal' ) {
        $atts['class'] = 'nav__link';
        
        // Se o usuário estiver na página correspondente ao link, adiciona a classe 'active'
        if ( $item->current ) {
            $atts['class'] .= ' active';
        }
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'adicionar_classe_nas_ancoras', 10, 3 );


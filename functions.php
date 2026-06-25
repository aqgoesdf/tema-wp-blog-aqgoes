<?php
/**
 * Funções e definições do tema AqGoEs
 */

// 1. Injeção correta de Preconnect para o Google Fonts (Otimização de Performance)
function aqgoes_google_fonts_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'aqgoes_google_fonts_preconnect', 1 );


// 2. Enfileiramento correto de Scripts e Estilos
function aqgoes_theme_scripts() {
    // Carrega o Google Fonts (Syne e DM Sans)
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap', array(), null );

    // Carrega o arquivo CSS principal do tema (style.css na raiz)
    //wp_enqueue_style( 'aqgoes-estilos', get_stylesheet_uri(), array(), '1.0.0', 'all' );
      
    // 3. O seu arquivo CSS original com todos os seus estilos
    wp_enqueue_style( 'aqgoes-estilos', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all' );


    // Carrega o script JavaScript do menu mobile no rodapé (true)
    wp_enqueue_script( 'aqgoes-scripts', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'aqgoes_theme_scripts' );


// 3. Configurações base do Tema
if ( ! function_exists( 'aqgoes_theme_config' ) ) :
    function aqgoes_theme_config() {
        // Registra as posições de menu do tema para o painel administrativo
        register_nav_menus( array(
            'menu-principal'   => esc_html__( 'Menu Principal (Topo)', 'aqgoes' ),
            'footer-paginas'   => esc_html__( 'Menu Rodapé - Páginas', 'aqgoes' ),
            'footer-categoria' => esc_html__( 'Menu Rodapé - Categorias', 'aqgoes' ),
        ) );

        // Ativa o suporte a Imagens Destacadas (Thumbnails)
        add_theme_support( 'post-thumbnails' );

        // Define tamanho personalizado com Hard Crop (Corte exato na proporção)
        add_image_size( 'imagem-destaque', 1200, 675, true );
    }
endif;
add_action( 'after_setup_theme', 'aqgoes_theme_config' );


// 4. Injeção de classes utilitárias e estados ativos nos links do menu dinâmico
function aqgoes_adicionar_classe_nas_ancoras( $atts, $item, $args ) {
    if ( $args->theme_location == 'menu-principal' ) {
        // Define a classe padrão para as âncoras do menu do topo
        $atts['class'] = 'nav__link';
        
        // Se o leitor estiver navegando na página correspondente ao link atual, injeta a classe active
        if ( $item->current ) {
            $atts['class'] .= ' active';
        }
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'aqgoes_adicionar_classe_nas_ancoras', 10, 3 );
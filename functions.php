<?php
/**
 * Configurações e funções do aqgoes Theme
 *
 * @package aqgoes
 */

if ( ! function_exists( 'aqgoes_setup' ) ) :
    function aqgoes_setup() {
        // Tag <title> dinâmica do WordPress
        add_theme_support( 'title-tag' );

        // Imagens Destacadas (Thumbnails)
        add_theme_support( 'post-thumbnails' );

        // Registro de Menus
        register_nav_menus( array(
            'primary' => __( 'Menu Principal', 'aqgoes' ),
        ) );

        // Suporte HTML5
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );
    }
endif;
add_action( 'after_setup_theme', 'aqgoes_setup' );


/**
 * Enfileiramento de Estilos e Scripts
 */
function aqgoes_enqueue_scripts() {

    // 1. Google Fonts
    wp_enqueue_style(
        'google-fonts-inter-jakarta',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap',
        array(),
        null
    );

    // 2. Estilo CSS customizado adicional
    if ( file_exists( get_template_directory() . '/assets/css/style.css' ) ) {
        wp_enqueue_style( 
            'aqgoes-main-style', 
            get_template_directory_uri() . '/assets/css/style.css', 
            array(), 
            '1.0.0' 
        );
    }

    // 3. Estilo Padrão do Tema
    wp_enqueue_style( 
        'aqgoes-theme-style', 
        get_stylesheet_uri(), 
        array(), 
        '1.0.0' 
    );

    // 4. Tailwind CSS via CDN
    wp_enqueue_script(
        'tailwind-cdn',
        'https://cdn.tailwindcss.com',
        array(),
        null,
        false
    );

    // 5. Configuração em linha do Tailwind CSS
    $tailwind_config = "
        tailwind.config = {
          darkMode: 'class',
          theme: {
            extend: {
              colors: {
                brand: {
                  DEFAULT: '#2563EB',
                  hover: '#1D4ED8',
                }
              },
              fontFamily: {
                sans: ['Inter', 'sans-serif'],
                title: ['Plus Jakarta Sans', 'sans-serif'],
              }
            }
          }
        };
    ";
    wp_add_inline_script( 'tailwind-cdn', $tailwind_config, 'after' );

    // 6. Script JS Personalizado
    wp_enqueue_script( 
        'aqgoes-main-script', 
        get_template_directory_uri() . '/assets/js/script.js', 
        array(), 
        '1.0.0', 
        true
    );
}
add_action( 'wp_enqueue_scripts', 'aqgoes_enqueue_scripts' );


/**
 * Preconnect e Otimização para Google Fonts
 */
function aqgoes_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array( 'href' => 'https://fonts.googleapis.com' );
        $urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous' );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'aqgoes_resource_hints', 10, 2 );


/**
 * Renderiza a Paginação Personalizada (Anterior, Página X de Y, Próxima)
 */
function aqgoes_custom_pagination( $query = null, $offset_count = 0 ) {
    global $wp_query;

    $current_query = $query ? $query : $wp_query;
    $paged         = max( 1, get_query_var( 'paged' ) );
    
    $posts_per_page = (int) $current_query->get( 'posts_per_page' );
    if ( $posts_per_page <= 0 ) {
        $posts_per_page = (int) get_option( 'posts_per_page' );
    }

    $total_posts   = max( 0, (int) $current_query->found_posts - (int) $offset_count );
    $max_num_pages = ( $posts_per_page > 0 ) ? ceil( $total_posts / $posts_per_page ) : 1;

    if ( $max_num_pages <= 1 ) {
        return;
    }
    ?>

    <div class="mt-12 flex justify-center items-center gap-2">
      <?php if ( $paged > 1 ) : ?>
        <a href="<?php echo esc_url( get_pagenum_link( $paged - 1 ) ); ?>" 
           class="p-2.5 rounded-xl border border-subtle bg-secondary hover:border-brand text-xs font-semibold transition-all">
          Anterior
        </a>
      <?php else : ?>
        <button disabled class="p-2.5 rounded-xl border border-subtle bg-secondary text-xs font-semibold opacity-50 cursor-not-allowed">
          Anterior
        </button>
      <?php endif; ?>

      <span class="px-4 py-2 text-xs font-semibold">
        Página <?php echo $paged; ?> de <?php echo $max_num_pages; ?>
      </span>

      <?php if ( $paged < $max_num_pages ) : ?>
        <a href="<?php echo esc_url( get_pagenum_link( $paged + 1 ) ); ?>" 
           class="p-2.5 rounded-xl border border-subtle bg-secondary hover:border-brand text-xs font-semibold transition-all">
          Próxima
        </a>
      <?php else : ?>
        <button disabled class="p-2.5 rounded-xl border border-subtle bg-secondary text-xs font-semibold opacity-50 cursor-not-allowed">
          Próxima
        </button>
      <?php endif; ?>
    </div>

    <?php
}
<?php
if (!defined('ABSPATH')) {
    exit; // Saída direta se acessado sem o WordPress
}

function aqgoes_theme_setup() {
    // Suporte a título dinâmico da página (<title>)
    add_theme_support('title-tag');

    // Suporte a Imagens Destacadas (Thumbnails) nos posts/páginas
    add_theme_support('post-thumbnails');

    // Suporte a logotipo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Registro dos Menus do WordPress
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'aqgoes'),
        'footer'  => __('Menu Rodapé', 'aqgoes'),
    ));
}
add_action('after_setup_theme', 'aqgoes_theme_setup');

/**
 * Enfileiramento de CSS e JavaScript
 */
function aqgoes_enqueue_assets() {
    $theme_version = wp_get_theme()->get('Version');

    // 1. Tailwind CSS via CDN (Carregado primeiro)
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, false);

    // 2. Configuração customizada do Tailwind
    wp_enqueue_script('tailwind-config', get_template_directory_uri() . '/assets/js/tailwind-config.js', array('tailwind-cdn'), $theme_version, false);

    // 3. Estilo Principal do Tema (main.css)
    wp_enqueue_style('aqgoes-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), $theme_version);

    // 4. Style.css padrão do WordPress (exigido)
    wp_enqueue_style('aqgoes-theme-style', get_stylesheet_uri(), array('aqgoes-main-style'), $theme_version);

    // 5. JavaScript do Dark Mode
    wp_enqueue_script('aqgoes-theme-toggle', get_template_directory_uri() . '/assets/js/theme.js', array(), $theme_version, true);

    // 6. JavaScript Principal (Menu Hambúrguer / Interações)
    wp_enqueue_script('aqgoes-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), $theme_version, true);
}
add_action('wp_enqueue_scripts', 'aqgoes_enqueue_assets');
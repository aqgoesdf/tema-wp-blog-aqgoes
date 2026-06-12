<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

  <header class="header" id="header">
    <nav class="nav container">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo">Aq<span>GoEs</span></a>

      <?php
      // Renderiza o menu do painel com as suas classes estruturais
      wp_nav_menu( array(
          'theme_location' => 'menu-principal',
          'container'      => false,
          'menu_class'     => 'nav__menu',
          'menu_id'        => 'navMenu',
          'fallback_cb'    => false,
      ) );
      ?>

      <button class="nav__toggle" id="navToggle" aria-label="Abrir menu">
        <span></span><span></span><span></span>
      </button>
    </nav>
  </header>
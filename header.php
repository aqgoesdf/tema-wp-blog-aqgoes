<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); // Função nativa essencial para injeção de scripts de plugins no início do body ?>

  <header class="header" id="header">
    <nav class="nav container">
      <!-- Logo com a marcação exata exibida no topo do seu blog -->
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo">
        Aq<span>GoEs</span>
      </a>

      <?php
      // Renderiza o menu dinâmico gerenciado pelo painel do WordPress
      wp_nav_menu( array(
          'theme_location' => 'menu-principal',
          'container'      => false,
          'menu_class'     => 'nav__menu',
          'menu_id'        => 'navMenu',
          'fallback_cb'    => false,
      ) );
      ?>

      <!-- Botão de alternância do menu hambúrguer para dispositivos móveis -->
      <button class="nav__toggle" id="navToggle" aria-label="Abrir menu" aria-expanded="false" aria-controls="navMenu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </nav>
  </header>
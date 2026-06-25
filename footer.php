<footer class="footer">
    <div class="container footer__grid">
      <div class="footer__brand">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo">
          Aq<span>GoEs</span>
        </a>
        <p>Conteúdo técnico de qualidade para desenvolvedores web.</p>
      </div>

      <nav class="footer__nav" aria-label="Links do rodapé">
        <h4>Páginas</h4>
        <?php
        wp_nav_menu( array(
            'theme_location' => 'footer-paginas',
            'container'      => false, // Remove wrappers de div gerados automaticamente
            'menu_class'     => 'footer__menu-list', // Adiciona uma classe limpa na tag ul
            'fallback_cb'    => false, // Oculta o bloco caso o menu não esteja criado no painel
        ) );
        ?>
      </nav>

      <nav class="footer__nav" aria-label="Categorias">
        <h4>Categorias</h4>
        <?php 
        wp_nav_menu( array(
            'theme_location' => 'footer-categoria',
            'container'      => false,
            'menu_class'     => 'footer__menu-list',
            'fallback_cb'    => false,
        ) );
        ?>
      </nav>

      <div class="footer__social">
        <h4>Redes</h4>
        <div class="social__links">
          <a href="#" aria-label="GitHub">GH</a>
          <a href="#" aria-label="Twitter">TW</a>
          <a href="#" aria-label="LinkedIn">LN</a>
        </div>
      </div>
    </div>

    <div class="footer__bottom container">
      <p>&copy; <?php echo date('Y'); ?> Desenvolvido - AqGoEs.</p>
    </div>
  </footer>

  <?php wp_footer(); // Hook nativa crucial para injeção de scripts JavaScript de plugins e do tema antes do fechamento da tag ?>
</body>
</html>
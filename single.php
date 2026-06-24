<?php get_header(); ?>

<main class="single-artigo-main">

  <?php
  // Iniciamos o Loop tradicional do WordPress para exibir o post específico
  if ( have_posts() ) :
      while ( have_posts() ) : the_post(); 
          
          // Resgata a categoria principal do post
          $categories = get_the_category();
          $category_slug = !empty($categories) ? esc_attr($categories[0]->slug) : 'geral';
          $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Geral';
          ?>

          <header class="article-hero section-pad">
            <div class="container article-hero__container">
              
              <a href="<?php echo esc_url( home_url( '/artigos' ) ); ?>" class="article-hero__back">
                ← Voltar para todos os artigos
              </a>

              <span class="news__category category-tag--<?php echo $category_slug; ?>">
                <?php echo $category_name; ?>
              </span>
              
              <h1 class="article-hero__title">
                <?php the_title(); ?>
              </h1>
              
              <div class="article-hero__meta">
                <span class="meta__item">👤 Por <strong><?php the_author(); ?></strong></span>
                <span class="meta__item">📅 Publicado em <?php echo get_the_date('d \d\e F \d\e Y'); ?></span>
                <span class="meta__item">⏱ 8 min de leitura</span>
              </div>

            </div>
          </header>

          <section class="article-body section-pad">
            <div class="container container--narrow">
              
              <?php if ( has_post_thumbnail() ) : ?>
                  <div class="article-body__featured-img">
                      <?php the_post_thumbnail('imagem-destaque'); ?>
                  </div>
              <?php endif; ?>

              <div class="article-body__content">
                <?php the_content(); ?>
              </div>

              <footer class="article-footer">
                <div class="article-footer__tags">
                  <?php the_tags('<span class="tag-item">#', '</span><span class="tag-item">#', '</span>'); ?>
                </div>
              </footer>

            </div>
          </section>

      <?php 
      endwhile;
  else :
      echo '<div class="container section-pad"><p>Desculpe, o artigo solicitado não foi encontrado.</p></div>';
  endif;
  ?>

</main>

<?php get_footer(); ?>
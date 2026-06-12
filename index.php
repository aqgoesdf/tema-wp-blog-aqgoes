<?php get_header(); ?>

<main>
<section class="hero" id="hero">
      <div class="hero__bg"></div>
      <div class="container hero__content">
        <div class="hero__text">
          <span class="hero__tag">🚀 Tecnologia em tempo real</span>
          
          <h1 class="hero__title">
            <?php bloginfo( 'name' ); ?>
          </h1>
          
          <p class="hero__desc">
            <?php bloginfo( 'description' ); ?>
          </p>
          
          <div class="hero__actions">
            <a href="<?php echo esc_url( home_url( '/artigos' ) ); ?>" class="btn btn--primary">Ver Artigos</a>
            <a href="<?php echo esc_url( home_url( '/sobre' ) ); ?>" class="btn btn--ghost">Sobre o projeto</a>
          </div>
        </div>

        <div class="hero__card-stack">
          <article class="hero__card hero__card--1">
            <span class="card__icon">🌐</span>
            <h3>HTML & CSS</h3>
            <p>Estrutura e estilo modernos</p>
          </article>
          
          <article class="hero__card hero__card--2">
            <span class="card__icon">⚡</span>
            <h3>JavaScript</h3>
            <p>Interatividade e DOM</p>
          </article>
          
          <article class="hero__card hero__card--3">
            <span class="card__icon">🐍</span>
            <h3>Python</h3>
            <p>Back-end para a web</p>
          </article>
        </div>
      </div>

      <div class="hero__scroll">
        <span>scroll</span>
        <div class="hero__scroll-line"></div>
      </div>
    </section>
    
    


    <!-- ========== SEÇÃO 2: ÚLTIMAS NOTÍCIAS ========== -->
    <section class="news" id="noticias">
      <div class="container">
        <div class="section__header">
          <h2 class="section__title">Últimas <span>Notícias</span></h2>
          <a href="<?php echo esc_url( home_url( '/artigos' ) ); ?>" class="section__link">Ver todas →</a>
        </div>

        <div class="news__grid">

          <?php
          // Criamos uma consulta para pegar os 4 posts mais recentes
          $args = array(
              'post_type'      => 'post',
              'posts_per_page' => 5,
          );
          $query = new WP_Query( $args );

          // Criamos um contador para identificar qual é o primeiro post
          $contador = 0;

          if ( $query->have_posts() ) :
              while ( $query->have_posts() ) : $query->the_post();
                  $contador++;
                  
                  // Se for o primeiro post, adiciona a classe featured, senão deixa a padrão
                  $card_class = ( $contador === 1 ) ? 'news__card news__card--featured' : 'news__card';
                  
                  // Pega a primeira categoria do post para exibir
                  $categories = get_the_category();
                  $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Geral';
                  ?>

                  <article class="<?php echo $card_class; ?>">
                    <div class="news__card-img">
                      <?php if ( has_post_thumbnail() ) : ?>
                          <!-- Se você subir uma imagem no painel, ela aparece aqui -->
                          <?php the_post_thumbnail('large'); ?>
                      <?php else : ?>
                          <!-- Caso não suba imagem, mantém o seu placeholder original baseado na categoria -->
                          <div class="news__card-placeholder" data-category="<?php echo $category_name; ?>"></div>
                      <?php endif; ?>

                      <?php if ( $contador === 1 ) : ?>
                          <span class="news__badge">Em Alta</span>
                      <?php endif; ?>
                    </div>
                    
                    <div class="news__body-wrapper" style="display: contents;">
                      <div class="news__card-body">
                        <span class="news__category"><?php echo $category_name; ?></span>
                        
                        <h3 class="news__title">
                          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        
                        <!-- Exibe o resumo do post apenas se for o card em destaque -->
                        <?php if ( $contador === 1 ) : ?>
                            <p class="news__excerpt">
                              <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                            </p>
                        <?php endif; ?>
                        
                        <div class="news__meta">
                          <span class="news__author">👤 <?php the_author(); ?></span>
                          <span class="news__date">📅 <?php echo get_the_date('M Y'); ?></span>
                        </div>
                      </div>
                    </div>
                  </article>

              <?php 
              endwhile;
              wp_reset_postdata(); // Limpa a consulta para não afetar o resto da página
          else : 
              echo '<p>Nenhum artigo publicado ainda.</p>';
          endif; 
          ?>

        </div>
      </div>
    </section>




<section class="categories" id="categorias">
      <div class="container">
        <div class="section__header">
          <h2 class="section__title">Explore por <span>Categoria</span></h2>
        </div>

        <div class="categories__grid">

          <?php
          // Buscamos apenas as categorias que mapeamos no seu HTML original
          // Certifique-se de que o "slug" delas no painel seja exatamente: html, css, javascript e python
          $slugs_desejados = array('html', 'css', 'javascript', 'python');
          
          $categorias = get_categories( array(
              'slug'       => $slugs_desejados,
              'hide_empty' => false, // Mostra a categoria mesmo se ainda não tiver posts cadastrados
          ) );

          // Criamos um mapa para os ícones e descrições estáticas do seu projeto,
          // indexados pelo slug da categoria no WordPress
          $dados_customizados = array(
              'html' => array(
                  'icon' => '🌐',
                  'desc' => 'Semântica, acessibilidade e estrutura moderna',
                  'class'=> 'category__card--html'
              ),
              'css' => array(
                  'icon' => '🎨',
                  'desc' => 'Layouts, animações e design systems',
                  'class'=> 'category__card--css'
              ),
              'javascript' => array(
                  'icon' => '⚡',
                  'desc' => 'ES2025, APIs modernas e performance',
                  'class'=> 'category__card--js' // Mantém a classe 'category__card--js' se o seu slug for javascript
              ),
              'python' => array(
                  'icon' => '🐍',
                  'desc' => 'Web scraping, APIs e automação',
                  'class'=> 'category__card--python'
              )
          );

          if ( ! empty( $categorias ) ) {
              foreach ( $categorias as $categoria ) {
                  $slug = $categoria->slug;
                  
                  // Se a categoria mapear com nosso array customizado, usamos os dados dela
                  $icone  = isset($dados_customizados[$slug]['icon']) ? $dados_customizados[$slug]['icon'] : '📂';
                  $desc   = isset($dados_customizados[$slug]['desc']) ? $dados_customizados[$slug]['desc'] : $categoria->description;
                  $classe_extra = isset($dados_customizados[$slug]['class']) ? $dados_customizados[$slug]['class'] : '';
                  
                  // Link correto gerado pelo WordPress para listar os artigos da categoria
                  $link_categoria = get_category_link( $categoria->term_id );
                  
                  // Quantidade real de posts vinculados a essa categoria
                  $total_posts = $categoria->count;
                  $texto_artigos = ( $total_posts == 1 ) ? '1 artigo' : $total_posts . ' artigos';
                  ?>

                  <a href="<?php echo esc_url( $link_categoria ); ?>" class="category__card <?php echo esc_attr( $classe_extra ); ?>">
                    <div class="category__icon"><?php echo esc_html( $icone ); ?></div>
                    <h3><?php echo esc_html( $categoria->name ); ?></h3>
                    <p><?php echo esc_html( $desc ); ?></p>
                    <span class="category__count"><?php echo esc_html( $texto_artigos ); ?></span>
                  </a>

                  <?php
              }
          } else {
              echo '<p>Nenhuma categoria encontrada. Crie as categorias "html", "css", "javascript" e "python" no painel do WordPress.</p>';
          }
          ?>

        </div>
      </div>
    </section>
    




    <section class="newsletter" id="newsletter">
      <div class="container">
        <div class="newsletter__content">
          <span class="newsletter__tag">📬 Newsletter semanal</span>
          <h2>Fique por dentro de tudo</h2>
          <p>Receba os melhores artigos de tecnologia diretamente no seu e-mail, toda semana.</p>

          <form class="newsletter__form" id="newsletterForm" method="POST" action="">
            <div class="newsletter__input-group">
              <input
                type="email"
                id="newsletterEmail"
                name="email"
                placeholder="seu@email.com"
                required
                autocomplete="email"
              />
              <button type="submit" class="btn btn--primary">Inscrever</button>
            </div>
            <p class="newsletter__privacy">🔒 Sem spam. Cancele quando quiser.</p>
            <div class="newsletter__feedback" id="newsletterFeedback" aria-live="polite"></div>
          </form>
          
        </div>
      </div>
    </section>

  </main> <?php 
// Chama o arquivo footer.php para fechar a estrutura da página
get_footer(); 
?>





</main>

<?php get_footer(); ?>
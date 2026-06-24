<?php
/**
 * Template Name: Página de Artigos (Blog)
 * Description: Modelo customizado completo com Hero, Filtros, Busca e Grid Dinâmico de Artigos.
 */

get_header(); ?>

<main>

    <!-- ========== PAGE HERO ========== -->
    <section class="page-hero">
      <div class="container">
        <span class="hero__tag">📚 Biblioteca de conteúdo</span>
        <h1>Todos os <em>Artigos</em></h1>
        <?php 
        // Conta dinamicamente o número total de posts publicados no site
        $total_posts_publicados = wp_count_posts()->publish; 
        ?>
        <p><?php echo esc_html( $total_posts_publicados ); ?> artigos técnicos sobre HTML, CSS, JavaScript e Python.</p>
      </div>
    </section>

    <!-- ========== FILTROS + BUSCA ========== -->
    <section class="articles-controls section-pad">
      <div class="container">
        <div class="controls__bar">
          
          <!-- Busca -->
          <div class="search__wrapper">
            <label for="searchInput" class="sr-only">Buscar artigos</label>
            <input
              type="search"
              id="searchInput"
              placeholder="🔍 Buscar artigos..."
              class="search__input"
            />
          </div>

          <!-- Filtros por categoria -->
          <div class="filter__tabs" role="tablist" aria-label="Filtrar por categoria">
            <button class="filter__tab active" data-filter="all" role="tab" aria-selected="true">Todos</button>
            <button class="filter__tab" data-filter="html" role="tab" aria-selected="false">HTML</button>
            <button class="filter__tab" data-filter="css" role="tab" aria-selected="false">CSS</button>
            <button class="filter__tab" data-filter="javascript" role="tab" aria-selected="false">JavaScript</button>
            <button class="filter__tab" data-filter="python" role="tab" aria-selected="false">Python</button>
          </div>
          
        </div>
      </div>
    </section>

    <!-- ========== LISTA DE ARTIGOS ========== -->
    <section class="articles-list section-pad">
      <div class="container">
        
        <?php
        // Configuramos a consulta para buscar TODOS os posts cadastrados 
        // para que o seu script JS de filtro estático consiga filtrar tudo na mesma página
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => -1, // -1 traz todos os posts existentes sem paginação PHP
            'post_status'    => 'publish'
        );

        $query_todos_posts = new WP_Query( $args );
        $posts_encontrados = $query_todos_posts->post_count;
        ?>

        <p class="articles__count" id="articlesCount">Mostrando <strong><?php echo esc_html( $posts_encontrados ); ?></strong> artigos</p>

        <div class="articles__grid" id="articlesGrid">

          <?php
          if ( $query_todos_posts->have_posts() ) :
              
              // Mapeador de classes de thumb e ícones com base no slug da categoria do WordPress
              $estilos_categorias = array(
                  'html'       => array('class' => 'article__thumb--html', 'icon' => '🌐'),
                  'css'        => array('class' => 'article__thumb--css', 'icon' => '🎨'),
                  'javascript' => array('class' => 'article__thumb--js', 'icon' => '⚡'),
                  'python'     => array('class' => 'article__thumb--python', 'icon' => '🐍')
              );

              while ( $query_todos_posts->have_posts() ) : $query_todos_posts->the_post(); 
                  
                  // Obtém as categorias do post atual
                  $categories = get_the_category();
                  
                  // Se o post tiver categoria, pegamos o slug e nome dela; senão, definimos padrões
                  $cat_slug = !empty($categories) ? $categories[0]->slug : 'all';
                  $cat_name = !empty($categories) ? $categories[0]->name : 'Geral';

                  // Busca as configurações visuais mapeadas acima (fallbacks caso crie slugs diferentes)
                  $thumb_class = isset($estilos_categorias[$cat_slug]['class']) ? $estilos_categorias[$cat_slug]['class'] : '';
                  $icon        = isset($estilos_categorias[$cat_slug]['icon']) ? $estilos_categorias[$cat_slug]['icon'] : '📂';
                  
                  // Formatação amigável do tempo de leitura (caso utilize campos personalizados, ou fixo)
                  $tempo_leitura = '8 min'; 
                  ?>

                  <!-- 
                    Injetamos dinamicamente o slug da categoria no 'data-category'.
                    Seu script.js lerá exatamente esse atributo para fazer a mágica do filtro!
                  -->
                  <article class="article__card" data-category="<?php echo esc_attr( $cat_slug ); ?>">
                    
                    <div class="article__thumb <?php echo esc_attr( $thumb_class ); ?>">
                      <?php if ( has_post_thumbnail() ) : ?>
                          <?php the_post_thumbnail( 'medium' ); // Carrega tamanho menor otimizado para miniaturas ?>
                      <?php else : ?>
                          <span><?php echo esc_html( $icon ); ?></span>
                      <?php endif; ?>
                    </div>
                    
                    <div class="article__body">
                      <span class="news__category"><?php echo esc_html( $cat_name ); ?></span>
                      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                      <p><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); // Limita o resumo a 15 palavras ?></p>
                      
                      <div class="article__meta">
                        <span>👤 <?php the_author(); ?></span>
                        <span>📅 <?php echo get_the_date('M Y'); // Formato compacto: "Fev 2025" ?></span>
                        <span>⏱ <?php echo esc_html( $tempo_leitura ); ?></span>
                      </div>
                    </div>

                  </article>

                  <?php
              endwhile;
              wp_reset_postdata(); // Sempre limpe a consulta customizada após o loop
          else :
              echo '<p>Nenhum artigo publicado encontrado.</p>';
          endif;
          ?>

        </div>

        <!-- Mensagem sem resultados (controlado e exibido pelo seu script.js através da remoção da classe hidden) -->
        <div class="articles__empty hidden" id="articlesEmpty">
          <p>😕 Nenhum artigo encontrado para "<strong id="searchTerm"></strong>"</p>
        </div>

        <!-- Paginação original mantida caso seu JS controle a paginação no front-end -->
        <nav class="pagination" aria-label="Paginação">
          <button class="pagination__btn" disabled>← Anterior</button>
          <span class="pagination__info">Página 1 de 1</span>
          <button class="pagination__btn">Próxima →</button>
        </nav>
        
      </div>
    </section>

</main>

<?php get_footer(); ?>
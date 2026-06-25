<?php
/**
 * Template Name: Página de Artigos (Blog)
 * Description: Modelo customizado completo com Hero, Filtros, Busca e Paginação Dinâmica Nativa.
 * @package Blog_AqGoEs
 */

get_header(); ?>

<main id="primary" class="site-main content-area">

    <section class="page-hero">
      <div class="container">
        <span class="hero__tag">📚 <?php _e('Biblioteca de conteúdo', 'aqgoes'); ?></span>
        <h1><?php printf( __( 'Todos os %sArtigos%s', 'aqgoes' ), '<em>', '</em>' ); ?></h1>
        <?php 
        // Conta dinamicamente o número total de posts publicados no site
        $total_posts_publicados = wp_count_posts()->publish; 
        ?>
        <p><?php echo esc_html( $total_posts_publicados ); ?> <?php _e('artigos técnicos sobre HTML, CSS, JavaScript e Python.', 'aqgoes'); ?></p>
      </div>
    </section>

    <section class="articles-controls section-pad">
      <div class="container">
        <div class="controls__bar">
          
          <div class="search__wrapper">
            <label for="searchInput" class="sr-only"><?php _e('Buscar artigos', 'aqgoes'); ?></label>
            <input
              type="search"
              id="searchInput"
              placeholder="<?php esc_attr_e('🔍 Buscar artigos...', 'aqgoes'); ?>"
              class="search__input"
            />
          </div>

          <div class="filter__tabs" role="tablist" aria-label="<?php esc_attr_e('Filtrar por categoria', 'aqgoes'); ?>">
            <button class="filter__tab active" data-filter="all" role="tab" aria-selected="true"><?php _e('Todos', 'aqgoes'); ?></button>
            <button class="filter__tab" data-filter="html" role="tab" aria-selected="false">HTML</button>
            <button class="filter__tab" data-filter="css" role="tab" aria-selected="false">CSS</button>
            <button class="filter__tab" data-filter="javascript" role="tab" aria-selected="false">JavaScript</button>
            <button class="filter__tab" data-filter="python" role="tab" aria-selected="false">Python</button>
          </div>
          
        </div>
      </div>
    </section>

    <section class="articles-list section-pad">
      <div class="container">
        
        <?php
        // PASSO 1: Captura a página de paginação atual de forma segura
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        // PASSO 2: Configuração da Query Dinâmica e Escalável
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => get_option( 'posts_per_page' ), // Puxa o valor definido no painel do WordPress
            'paged'          => $paged,
            'post_status'    => 'publish'
        );

        $query_todos_posts = new WP_Query( $args );
        $posts_encontrados = $query_todos_posts->found_posts; // Traz o total absoluto encontrado pela query, não apenas da página atual
        ?>

        <p class="articles__count" id="articlesCount">
            <?php printf( __( 'Mostrando %s artigos', 'aqgoes' ), '<strong>' . esc_html( $posts_encontrados ) . '</strong>' ); ?>
        </p>

        <div class="articles__grid" id="articlesGrid">

          <?php
          if ( $query_todos_posts->have_posts() ) :
              
              // Mapeador de classes de thumb e ícones com base no slug da categoria
              $estilos_categorias = array(
                  'html'       => array('class' => 'article__thumb--html', 'icon' => '🌐'),
                  'css'        => array('class' => 'article__thumb--css', 'icon' => '🎨'),
                  'javascript' => array('class' => 'article__thumb--js', 'icon' => '⚡'),
                  'python'     => array('class' => 'article__thumb--python', 'icon' => '🐍')
              );

              while ( $query_todos_posts->have_posts() ) : $query_todos_posts->the_post(); 
                  
                  $categories = get_the_category();
                  $cat_slug = !empty($categories) ? $categories[0]->slug : 'all';
                  $cat_name = !empty($categories) ? $categories[0]->name : __('Geral', 'aqgoes');

                  $thumb_class = isset($estilos_categorias[$cat_slug]['class']) ? $estilos_categorias[$cat_slug]['class'] : '';
                  $icon        = isset($estilos_categorias[$cat_slug]['icon']) ? $estilos_categorias[$cat_slug]['icon'] : '📂';
                  
                  $tempo_leitura = '8 min'; 
                  ?>

                  <article class="article__card" data-category="<?php echo esc_attr( $cat_slug ); ?>">
                    
                    <div class="article__thumb <?php echo esc_attr( $thumb_class ); ?>">
                      <?php if ( has_post_thumbnail() ) : ?>
                          <?php the_post_thumbnail( 'medium' ); ?>
                      <?php else : ?>
                          <span><?php echo esc_html( $icon ); ?></span>
                      <?php endif; ?>
                    </div>
                    
                    <div class="article__body">
                      <span class="news__category"><?php echo esc_html( $cat_name ); ?></span>
                      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                      <p><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                      
                      <div class="article__meta">
                        <span>👤 <?php the_author(); ?></span>
                        <span>📅 <?php echo get_the_date('M Y'); ?></span>
                        <span>⏱ <?php echo esc_html( $tempo_leitura ); ?></span>
                      </div>
                    </div>

                  </article>

                  <?php
              endwhile;
              ?>
        </div> <nav class="pagination" aria-label="<?php esc_attr_e('Paginação de artigos', 'aqgoes'); ?>">
            <?php
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $query_todos_posts->max_num_pages,
                'current'      => max( 1, $paged ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'prev_text'    => __( '← Anterior', 'aqgoes' ),
                'next_text'    => __( 'Próxima →', 'aqgoes' ),
            ) );
            ?>
        </nav>

        <?php
            wp_reset_postdata(); // Restaura dados globais da query do WP
          else :
              ?>
              </div> <div class="articles__empty" id="articlesEmpty">
                <p>😕 <?php _e('Nenhum artigo encontrado.', 'aqgoes'); ?></p>
              </div>
              <?php
          endif;
          ?>
        
      </div>
    </section>

</main>

<?php get_footer(); ?>
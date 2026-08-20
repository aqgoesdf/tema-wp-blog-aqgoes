search.php<?php
/**
 * Template para Resultados de Pesquisa
 *
 * @package aqgoes
 */

get_header(); ?>

<main class="flex-grow pt-28 pb-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- CABEÇALHO DA PESQUISA -->
    <header class="mb-12 border-b border-subtle pb-8">
      <span class="px-3 py-1.5 rounded-md text-xs font-bold bg-brand/10 text-brand border border-brand/20 uppercase tracking-wider font-mono inline-block mb-3">
        Resultado da Busca
      </span>

      <h1 class="font-title text-3xl sm:text-5xl font-extrabold tracking-tight text-primary leading-tight mb-3">
        Resultados para: <span class="text-brand">"<?php echo esc_html( get_search_query() ); ?>"</span>
      </h1>

      <?php if ( have_posts() ) : ?>
        <p class="text-muted text-base sm:text-lg">
          Encontramos <strong class="text-primary"><?php echo $wp_query->found_posts; ?></strong> <?php echo ( $wp_query->found_posts === 1 ) ? 'artigo relacionado' : 'artigos relacionados'; ?> à sua pesquisa.
        </p>
      <?php else : ?>
        <p class="text-muted text-base sm:text-lg">
          Nenhum conteúdo foi encontrado para o termo buscado.
        </p>
      <?php endif; ?>
    </header>

    <?php if ( have_posts() ) : ?>

      <!-- GRID DE RESULTADOS -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php while ( have_posts() ) : the_post(); ?>
          <article class="rounded-2xl border border-subtle bg-secondary overflow-hidden flex flex-col group transition-all duration-300 hover:-translate-y-1 hover:border-brand/50 hover:shadow-lg">
            <div class="aspect-video w-full overflow-hidden bg-subtle">
              <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
                <?php else : ?>
                  <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                <?php endif; ?>
              </a>
            </div>

            <div class="p-6 flex-grow flex flex-col justify-between">
              <div>
                <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-brand/10 text-brand border border-brand/20 uppercase tracking-wider font-mono inline-block mb-3">
                  <?php echo get_the_category()[0]->name ?? 'Geral'; ?>
                </span>
                <h2 class="font-title text-xl font-bold group-hover:text-brand transition-colors leading-snug">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <p class="text-muted text-sm mt-2 line-clamp-2">
                  <?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
                </p>
              </div>

              <div class="mt-6 pt-4 border-t border-subtle flex items-center justify-between text-xs text-muted">
                <span><?php echo get_the_date( 'd \d\e F, Y' ); ?></span>
                <span><?php echo ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ); ?> min</span>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <!-- PAGINAÇÃO PERSONALIZADA DO TEMA -->
      <?php aqgoes_custom_pagination(); ?>

    <?php else : ?>

      <!-- ESTADO DE NENHUM RESULTADO ENCONTRADO (PÁGINA DE ERRO / FEEDBACK) -->
      <div class="max-w-2xl mx-auto text-center py-12 px-6 rounded-3xl border border-subtle bg-secondary shadow-xl my-8">
        <div class="w-20 h-20 bg-brand/10 text-brand rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl">
          🔍
        </div>

        <h2 class="font-title text-2xl sm:text-3xl font-extrabold text-primary mb-3">
          Ops! Nada por aqui.
        </h2>

        <p class="text-muted text-sm sm:text-base mb-8 leading-relaxed">
          Não encontramos nenhum artigo correspondente à sua pesquisa por "<strong class="text-primary"><?php echo esc_html( get_search_query() ); ?></strong>". Tente buscar por outros termos ou palavras-chave relacionadas.
        </p>

        <!-- NOVO CAMPO DE PESQUISA CENTRALIZADO -->
        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative max-w-md mx-auto mb-8">
          <input 
            type="search" 
            name="s" 
            value="<?php echo get_search_query(); ?>" 
            placeholder="Digite outro termo..." 
            required
            class="w-full pl-11 pr-28 py-3 rounded-xl border border-subtle bg-primary text-primary text-sm placeholder-muted focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-all"
          />
          <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 px-4 rounded-lg bg-brand text-white text-xs font-semibold hover:bg-brand-hover transition-colors">
            Pesquisar
          </button>
          <div class="absolute left-3.5 top-3.5 text-muted">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
        </form>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-2 text-xs font-bold text-brand hover:underline uppercase tracking-wider">
          ← Voltar para a página inicial
        </a>
      </div>

    <?php endif; ?>

  </div>
</main>

<?php get_footer(); ?>
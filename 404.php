<?php
/**
 * 404.php — página exibida quando nada é encontrado.
 *
 * @package aqgoes
 */

// Correção: garante que buscadores não indexem a página de erro.
add_action( 'wp_head', 'wp_no_robots' );

get_header();
?>

<main class="flex-grow pt-28 pb-16 flex items-center">
  <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

    <span class="font-title text-7xl sm:text-8xl font-extrabold tracking-tight text-brand block mb-4">404</span>

    <h1 class="font-title text-2xl sm:text-3xl font-extrabold tracking-tight text-primary mb-3">
      Essa página não foi encontrada
    </h1>
    <p class="text-muted text-sm sm:text-base mb-10 max-w-md mx-auto">
      O link pode estar quebrado, ou o conteúdo foi movido. Tenta buscar o que você procurava, ou volta pro início.
    </p>

    <form role="search" method="get" class="flex flex-col sm:flex-row gap-3 justify-center mb-10" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <input
        type="search"
        name="s"
        placeholder="Pesquisar artigos…"
        value="<?php echo esc_attr( get_search_query() ); ?>"
        class="px-5 py-3.5 rounded-xl text-sm bg-secondary border border-subtle text-primary focus:outline-none focus:border-brand transition-colors w-full sm:w-80"
      />
      <button type="submit" class="px-6 py-3.5 rounded-xl bg-brand text-white font-semibold text-sm hover:bg-brand-hover transition-all shadow-md">
        Buscar
      </button>
    </form>

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-sm font-semibold text-brand hover:underline">
      ← Voltar para o início
    </a>

    <?php
    $recent = new WP_Query( array( 'posts_per_page' => 3, 'ignore_sticky_posts' => 1 ) );
    if ( $recent->have_posts() ) :
      ?>
      <div class="mt-16 text-left">
        <h2 class="font-title text-lg font-bold text-primary mb-5 text-center">Ou dá uma olhada nos últimos artigos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
          <?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
            <article class="rounded-2xl border border-subtle bg-secondary p-5 transition-all hover:-translate-y-1 hover:border-brand/50">
              <h3 class="font-title text-sm font-bold text-primary line-clamp-2 mb-2">
                <a href="<?php the_permalink(); ?>" class="hover:text-brand transition-colors"><?php the_title(); ?></a>
              </h3>
              <span class="text-xs text-muted"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></span>
            </article>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      </div>
    <?php endif; ?>

  </div>
</main>

<?php get_footer(); ?>

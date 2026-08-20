<?php
/**
 * Template para Arquivos de Categoria
 *
 * @package aqgoes
 */

get_header(); ?>

<main class="flex-grow pt-28 pb-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <header class="mb-12 border-b border-subtle pb-8">
      <span class="px-3 py-1.5 rounded-md text-xs font-bold bg-brand/10 text-brand border border-brand/20 uppercase tracking-wider font-mono inline-block mb-3">
        Categoria
      </span>

      <h1 class="font-title text-3xl sm:text-5xl font-extrabold tracking-tight text-primary leading-tight mb-3">
        <?php single_cat_title(); ?>
      </h1>

      <?php if ( category_description() ) : ?>
        <div class="text-muted text-base sm:text-lg max-w-3xl leading-relaxed">
          <?php echo category_description(); ?>
        </div>
      <?php else : ?>
        <p class="text-muted text-base sm:text-lg">
          Exibindo artigos publicados na categoria <strong class="text-primary"><?php single_cat_title(); ?></strong>.
        </p>
      <?php endif; ?>
    </header>

    <div class="flex flex-wrap gap-2 mb-10">
      <a href="<?php echo esc_url( home_url('/') ); ?>" class="px-4 py-2 rounded-xl text-xs font-semibold bg-secondary border border-subtle hover:border-brand transition-all text-primary">Todos</a>

      <?php
      $categories     = get_categories( array( 'hide_empty' => true ) );
      $current_cat_id = get_queried_object_id();

      foreach ( $categories as $category ) :
          $is_active = ( $category->term_id === $current_cat_id );
          $class     = $is_active ? 'bg-brand text-white' : 'bg-secondary border border-subtle hover:border-brand text-primary';
      ?>
        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="px-4 py-2 rounded-xl text-xs font-semibold transition-all <?php echo $class; ?>">
          <?php echo esc_html( $category->name ); ?>
        </a>
      <?php endforeach; ?>
    </div>

    <?php if ( have_posts() ) : ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php while ( have_posts() ) : the_post(); ?>
          <article class="rounded-2xl border border-subtle bg-secondary overflow-hidden flex flex-col group transition-all duration-300 hover:-translate-y-1 hover:border-brand/50 hover:shadow-lg">
            <div class="aspect-video w-full overflow-hidden bg-subtle">
              <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
                <?php else : ?>
                  <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                <?php endif; ?>
              </a>
            </div>

            <div class="p-6 flex-grow flex flex-col justify-between">
              <div>
                <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-brand/10 text-brand border border-brand/20 uppercase tracking-wider font-mono inline-block mb-3"><?php single_cat_title(); ?></span>
                <h2 class="font-title text-xl font-bold group-hover:text-brand transition-colors leading-snug">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <p class="text-muted text-sm mt-2 line-clamp-2"><?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?></p>
              </div>

              <div class="mt-6 pt-4 border-t border-subtle flex items-center justify-between text-xs text-muted">
                <span><?php echo get_the_date( 'd \d\e F, Y' ); ?></span>
                <span><?php echo ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ); ?> min</span>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

        
      <div class="mt-12 flex justify-center items-center gap-2">
        <?php echo aqgoes_custom_pagination(); ?>
      </div>
      
    <?php else : ?>
      <p class="text-muted text-center py-12">Nenhum artigo encontrado para esta categoria.</p>
    <?php endif; ?>

  </div>
</main>

<?php get_footer(); ?>
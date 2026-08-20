<?php
/**
 * Template Name: Todos os Artigos
 * Description: Modelo de página personalizado para listar o arquivo de posts.
 *
 * @package aqgoes
 */

get_header(); ?>

<main class="flex-grow pt-28 pb-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="mb-10 text-center sm:text-left">
      <h1 class="font-title text-3xl sm:text-5xl font-extrabold tracking-tight bg-gradient-to-r from-blue-500 via-indigo-400 to-cyan-400 bg-clip-text text-transparent mb-3">
        <?php the_title(); ?>
      </h1>
      <p class="text-muted text-base sm:text-lg">Explore nossos tutoriais, guias e análises sobre desenvolvimento web moderno.</p>
    </div>

    <!-- 1. CARROSSEL -->
    <section class="mb-16 relative">
      <?php
      $carousel_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3, 'ignore_sticky_posts' => 1 ) );
      if ( $carousel_query->have_posts() ) :
          $slide_count = $carousel_query->post_count;
      ?>
        <div class="overflow-hidden rounded-3xl border border-subtle bg-secondary shadow-2xl">
          <div id="carousel-track" class="flex transition-transform duration-500 ease-in-out">
            <?php while ( $carousel_query->have_posts() ) : $carousel_query->the_post(); ?>
              <article class="w-full flex-shrink-0 grid grid-cols-1 lg:grid-cols-12 items-center p-6 sm:p-10 gap-8">
                <div class="lg:col-span-7 space-y-4">
                  <span class="px-3 py-1 rounded-md text-xs font-semibold bg-brand/10 text-brand border border-brand/20 uppercase font-mono inline-block">
                    <?php echo get_the_category()[0]->name ?? 'Geral'; ?>
                  </span>
                  <h2 class="font-title text-2xl sm:text-4xl font-bold tracking-tight text-primary hover:text-brand transition-colors">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h2>
                  <p class="text-muted text-sm sm:text-base line-clamp-3"><?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?></p>
                  <div class="flex items-center gap-4 pt-2 text-xs text-muted">
                    <span><?php echo get_the_date( 'd \d\e F, Y' ); ?></span>
                    <span>•</span>
                    <span><?php echo ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ); ?> min de leitura</span>
                  </div>
                </div>
                <div class="lg:col-span-5 aspect-video rounded-2xl overflow-hidden bg-subtle">
                  <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 hover:scale-105' ) ); ?>
                    <?php else : ?>
                      <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover" />
                    <?php endif; ?>
                  </a>
                </div>
              </article>
            <?php endwhile; ?>
          </div>
        </div>

        <div class="flex items-center justify-between mt-4">
          <div class="flex items-center gap-2">
            <button id="carousel-prev" class="p-2.5 rounded-xl border border-subtle bg-secondary hover:border-brand text-primary">←</button>
            <button id="carousel-next" class="p-2.5 rounded-xl border border-subtle bg-secondary hover:border-brand text-primary">→</button>
          </div>
          <div class="flex items-center gap-2" id="carousel-dots">
            <?php for ( $i = 0; $i < $slide_count; $i++ ) : ?>
              <span class="w-3 h-3 rounded-full <?php echo $i === 0 ? 'bg-brand' : 'bg-subtle'; ?> cursor-pointer" data-slide="<?php echo $i; ?>"></span>
            <?php endfor; ?>
          </div>
        </div>
      <?php 
        wp_reset_postdata();
      endif; 
      ?>
    </section>

    <!-- 2. GRID RECENTES -->
    <section class="mb-16">
      <?php
      $recent_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3, 'offset' => 3, 'ignore_sticky_posts' => 1 ) );
      if ( $recent_query->have_posts() ) :
      ?>
        <div class="mb-6 flex items-center justify-between border-b border-subtle pb-4">
          <h2 class="font-title text-2xl font-bold tracking-tight">Publicações Recentes</h2>
          <span class="text-xs text-muted font-mono"><?php echo $recent_query->post_count; ?> Artigos</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <?php while ( $recent_query->have_posts() ) : $recent_query->the_post(); ?>
            <article class="rounded-2xl border border-subtle bg-secondary overflow-hidden flex flex-col group transition-all duration-300 hover:-translate-y-1 hover:border-brand/50 hover:shadow-lg">
              <div class="aspect-video w-full overflow-hidden bg-subtle">
                <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
                  <?php else : ?>
                    <img src="https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                  <?php endif; ?>
                </a>
              </div>
              <div class="p-6 flex-grow flex flex-col justify-between">
                <div>
                  <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-brand/10 text-brand border border-brand/20 uppercase font-mono inline-block mb-3"><?php echo get_the_category()[0]->name ?? 'Geral'; ?></span>
                  <h3 class="font-title text-xl font-bold group-hover:text-brand transition-colors leading-snug"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
      <?php 
        wp_reset_postdata();
      endif; 
      ?>
    </section>

    <!-- 3. ASSIMÉTRICO -->
    <section class="mb-16">
      <div class="mb-6 border-b border-subtle pb-4">
        <h2 class="font-title text-2xl font-bold tracking-tight">Artigos em Foco</h2>
      </div>
      <?php
      $focus_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 4, 'offset' => 6, 'ignore_sticky_posts' => 1 ) );
      if ( $focus_query->have_posts() ) :
      ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
          <?php 
          while ( $focus_query->have_posts() ) : $focus_query->the_post(); 
            if ( $focus_query->current_post === 0 ) :
          ?>
              <article class="lg:col-span-7 rounded-2xl border border-subtle bg-secondary overflow-hidden flex flex-col justify-between group transition-all duration-300 hover:border-brand/50 hover:shadow-xl">
                <div class="aspect-video w-full overflow-hidden bg-subtle">
                  <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
                    <?php else : ?>
                      <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1000&q=80" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <?php endif; ?>
                  </a>
                </div>
                <div class="p-6 sm:p-8 flex-grow flex flex-col justify-between">
                  <div>
                    <span class="px-3 py-1 rounded-md text-xs font-semibold bg-brand/10 text-brand border border-brand/20 uppercase font-mono inline-block mb-3"><?php echo get_the_category()[0]->name ?? 'Geral'; ?></span>
                    <h3 class="font-title text-2xl sm:text-3xl font-bold group-hover:text-brand transition-colors leading-tight mb-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="text-muted text-sm sm:text-base leading-relaxed mb-6 line-clamp-3"><?php echo wp_trim_words( get_the_excerpt(), 28, '...' ); ?></p>
                  </div>
                  <div class="flex items-center justify-between pt-4 border-t border-subtle text-xs text-muted">
                    <span><?php echo get_the_date( 'd \d\e F, Y' ); ?></span>
                    <span><?php echo ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ); ?> min de leitura</span>
                  </div>
                </div>
              </article>
              <div class="lg:col-span-5 flex flex-col gap-4">
            <?php else : ?>
              <article class="p-5 rounded-2xl border border-subtle bg-secondary flex gap-4 items-center group transition-all duration-300 hover:border-brand/50 hover:shadow-md">
                <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 bg-subtle">
                  <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105' ) ); ?>
                    <?php else : ?>
                      <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <?php endif; ?>
                  </a>
                </div>
                <div class="flex-grow">
                  <span class="text-xs font-semibold text-brand font-mono uppercase tracking-wider"><?php echo get_the_category()[0]->name ?? 'Geral'; ?></span>
                  <h4 class="font-title text-base font-bold mt-1 group-hover:text-brand transition-colors line-clamp-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <p class="text-xs text-muted mt-2"><?php echo get_the_date( 'd \d\e F, Y' ); ?></p>
                </div>
              </article>
            <?php 
            endif; 
          endwhile; 
          ?>
          </div>
        </div>
      <?php 
        wp_reset_postdata();
      endif; 
      ?>
    </section>

  </div>
</main>

<?php get_footer(); ?>
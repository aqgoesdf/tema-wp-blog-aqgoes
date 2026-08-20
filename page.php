<?php
/**
 * Template para Páginas Estáticas do WordPress
 *
 * @package aqgoes
 */

get_header(); ?>

<main class="flex-grow pt-28 pb-16">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <header class="mb-10 text-center sm:text-left border-b border-subtle pb-6">
        <h1 class="font-title text-3xl sm:text-5xl font-extrabold tracking-tight text-primary leading-tight">
          <?php the_title(); ?>
        </h1>
      </header>

      <?php if ( has_post_thumbnail() ) : ?>
        <div class="mb-10 aspect-video w-full rounded-3xl overflow-hidden bg-subtle border border-subtle shadow-xl">
          <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover' ) ); ?>
        </div>
      <?php endif; ?>

      <div class="prose prose-lg dark:prose-invert max-w-none text-primary leading-relaxed space-y-6">
        <?php the_content(); ?>
      </div>

    <?php endwhile; endif; ?>

  </div>
</main>

<?php get_footer(); ?>
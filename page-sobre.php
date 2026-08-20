<?php
/**
 * Template Name: Sobre
 *
 * page-sobre.php — aplicado automaticamente na Página com slug "sobre".
 *
 * @package aqgoes
 */

get_header(); ?>

<main class="flex-grow pt-28 pb-16">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <header class="mb-10 text-center sm:text-left border-b border-subtle pb-8">
      <span class="px-3 py-1.5 rounded-md text-xs font-bold bg-brand/10 text-brand border border-brand/20 uppercase tracking-wider font-mono inline-block mb-3">
        Sobre o blog
      </span>
      <h1 class="font-title text-3xl sm:text-5xl font-extrabold tracking-tight text-primary leading-tight">
        <?php the_title(); ?>
      </h1>
    </header>

    <div class="prose prose-lg dark:prose-invert max-w-none text-primary leading-relaxed space-y-6 mb-14">
      <p>
        Este blog nasceu como um grande rascunho online — um espaço pra eu ir tirando as dúvidas
        que forem aparecendo pelo caminho, documentar o que estou aprendendo e organizar as
        ideias enquanto estudo desenvolvimento web na prática.
      </p>
      <p>
        Os assuntos abordados por aqui giram em torno de <strong class="text-primary">desenvolvimento web</strong>
        — HTML, CSS, JavaScript, Python, Django e PHP para WordPress — além de configurações e
        ajustes de ambiente de desenvolvimento no <strong class="text-primary">Linux Mint</strong>.
      </p>
      <p>
        A ideia não é ser um tutorial perfeito e definitivo sobre cada tema, e sim um registro
        real do processo: o que deu certo, o que deu errado, e como eu resolvi no caminho.
      </p>
    </div>

    <!-- Stack -->
    <div class="mb-14">
      <h2 class="font-title text-xl font-bold text-primary mb-5">O que estuda por aqui</h2>
      <div class="flex flex-wrap gap-2.5">
        <?php
        $stack = array( 'HTML', 'CSS', 'JavaScript', 'Python', 'Django', 'PHP', 'WordPress', 'Linux Mint' );
        foreach ( $stack as $item ) :
          ?>
          <span class="px-4 py-2 rounded-xl text-xs font-semibold bg-secondary border border-subtle text-primary">
            <?php echo esc_html( $item ); ?>
          </span>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Ambiente de desenvolvimento -->
    <div class="rounded-3xl border border-subtle bg-secondary p-6 sm:p-8 mb-14">
      <h2 class="font-title text-lg font-bold text-primary mb-3">Ambiente de desenvolvimento</h2>
      <p class="text-muted text-sm leading-relaxed">
        Os artigos sobre configuração de ambiente partem do <strong class="text-primary">Linux Mint</strong>
        como sistema base — instalação de dependências, editor, servidores locais e as ferramentas
        do dia a dia para desenvolvimento web.
      </p>
    </div>

    <!-- CTA -->
    <div class="rounded-3xl bg-brand text-white p-8 sm:p-10 text-center">
      <h2 class="font-title text-xl sm:text-2xl font-extrabold tracking-tight mb-2">Tem alguma dúvida ou sugestão?</h2>
      <p class="text-white/80 text-sm mb-6">Me chama, vou adorar trocar uma ideia.</p>
      <a href="<?php echo esc_url( home_url( '/contato' ) ); ?>" class="inline-flex items-center px-6 py-3 rounded-xl bg-white text-brand font-semibold text-sm hover:opacity-90 transition-opacity">
        Ir para o contato →
      </a>
    </div>

  </div>
</main>

<?php get_footer(); ?>

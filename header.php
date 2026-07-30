<!DOCTYPE html>
<html <?php language_attributes(); ?> class="dark">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <meta name="google-site-verification" content="eTrlbtdq7bsM5xHgk9osh2-i7MqqCQRutgQ4kyutYys" />
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-bg text-text-primary font-sans antialiased scroll-smooth transition-colors duration-300'); ?>>
<?php wp_body_open(); ?>

    <!-- HEADER -->
    <header class="sticky top-0 z-50 header-backdrop backdrop-blur-md border-b border-custom transition-colors duration-300">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center relative">
            
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-bold tracking-wider text-gradient z-20">
                <?php bloginfo('name'); ?>
            </a>

            <!-- Ações Mobile (Dark Mode + Hambúrguer) -->
            <div class="flex items-center gap-2 z-20 md:hidden">
                <button class="theme-toggle p-2 rounded-lg border border-custom text-text-primary hover:bg-bg-card transition-colors" aria-label="Alternar Tema">
                    <span class="icon-moon text-lg">🌙</span>
                    <span class="icon-sun text-lg hidden">☀️</span>
                </button>

                <button id="menu-btn" aria-label="Abrir Menu" aria-expanded="false" class="text-text-primary hover:text-white focus:outline-none p-2">
                    <svg id="icon-open" class="w-7 h-7 block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="icon-close" class="w-7 h-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Navegação Desktop & Mobile Dropdown -->
            <nav id="menu" class="hidden absolute top-full left-0 w-full menu-backdrop backdrop-blur-lg border-b border-custom p-6 flex-col space-y-4 md:static md:flex md:flex-row md:items-center md:space-y-0 md:space-x-8 md:w-auto md:bg-transparent md:border-none md:p-0 transition-all duration-300 z-10">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'flex flex-col md:flex-row md:items-center md:space-x-8 space-y-4 md:space-y-0',
                        'fallback_cb'    => false
                    ));
                } else {
                    // Menu Padrão Fallback com links para as âncoras da home e blog
                ?>
                    <a href="<?php echo is_front_page() ? '#sobre' : esc_url(home_url('/#sobre')); ?>" class="nav-link hover:text-gradient transition-colors block py-2 md:py-0 font-medium">Sobre</a>
                    <a href="<?php echo is_front_page() ? '#trajetoria' : esc_url(home_url('/#trajetoria')); ?>" class="nav-link hover:text-gradient transition-colors block py-2 md:py-0 font-medium">Trajetória</a>
                    <a href="<?php echo is_front_page() ? '#tecnologias' : esc_url(home_url('/#tecnologias')); ?>" class="nav-link hover:text-gradient transition-colors block py-2 md:py-0 font-medium">Tecnologias</a>
                    <a href="<?php echo esc_url('https://aqgoes.com/blog/'); ?>" class="nav-link hover:text-gradient transition-colors block py-2 md:py-0 font-medium">Artigos</a>
                <?php } ?>

                <div class="pt-4 md:pt-0 border-t border-custom md:border-none md:hidden">
                    <a href="https://wa.me/5561999999999" target="_blank" rel="noopener noreferrer" class="block text-center bg-grad-primary text-white font-semibold px-4 py-2 rounded-lg hover:opacity-90 transition-opacity">
                        Fale Comigo
                    </a>
                </div>
            </nav>

            <!-- Ações Desktop (Dark Mode + Botão WhatsApp) -->
            <div class="hidden md:flex items-center space-x-4">
                <button class="theme-toggle p-2 rounded-lg border border-custom text-text-primary hover:bg-bg-card transition-colors cursor-pointer" aria-label="Alternar Tema">
                    <span class="icon-moon text-lg">🌙</span>
                    <span class="icon-sun text-lg hidden">☀️</span>
                </button>
                <a href="https://wa.me/5561999999999" target="_blank" rel="noopener noreferrer" class="bg-grad-primary text-white font-semibold px-4 py-2 rounded-lg hover:opacity-90 transition-opacity">
                    Fale Comigo
                </a>
            </div>

        </div>
    </header>
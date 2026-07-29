<!-- FOOTER -->
    <footer class="bg-bg-2 border-t border-custom py-8 transition-colors duration-300">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-text-muted">
            <div>
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos os direitos reservados.</p>
                <p class="text-xs mt-1">Desenvolvido por AqGoEs</p>
            </div>
            <div class="flex space-x-6">
                <a href="#sobre" class="hover:text-text-primary transition-colors">Voltar ao topo</a>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
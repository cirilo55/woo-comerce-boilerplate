<footer class="site-footer">
    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                <!-- Col 1: Sobre -->
                <div class="footer-col">
                    <h3>Sobre ArqDeco</h3>
                    <p>Sua loja online de confiança com os melhores produtos e serviços.</p>
                    <div class="footer-social">
                        <a href="https://facebook.com/ArqDeco" target="_blank" rel="noopener noreferrer" aria-label="Facebook" title="Facebook">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/facebook.png'); ?>" alt="Facebook" width="32" height="32">
                        </a>
                        <a href="https://instagram.com/ArqDeco" target="_blank" rel="noopener noreferrer" aria-label="Instagram" title="Instagram">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/instagram.png'); ?>" alt="Instagram" width="32" height="32">
                        </a>
                    </div>
                </div>

                <!-- Col 2: Links -->
                <div class="footer-col">
                    <h3>Navegação</h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/loja')); ?>">Loja</a></li>
                        <li><a href="<?php echo esc_url(home_url('/sobre')); ?>">Sobre</a></li>
                        <li><a href="<?php echo esc_url(home_url('/contato')); ?>">Contato</a></li>
                        <li><a href="<?php echo esc_url(home_url('/faq')); ?>">FAQ</a></li>
                    </ul>
                </div>

                <!-- Col 3: Suporte -->
                <div class="footer-col">
                    <h3>Suporte</h3>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/frete-entrega')); ?>">Frete e Entrega</a></li>
                        <li><a href="<?php echo esc_url(home_url('/trocas-devolucoes')); ?>">Trocas e Devoluções</a></li>
                        <li><a href="<?php echo esc_url(home_url('/politica-privacidade')); ?>">Política de Privacidade</a></li>
                        <li><a href="<?php echo esc_url(home_url('/termos-servico')); ?>">Termos de Serviço</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contato -->
                <div class="footer-col">
                    <h3>Contato</h3>
                    <ul class="footer-contact">
                        <li>
                            <strong>Email:</strong><br>
                            <a href="mailto:contato@ArqDeco.com">contato@ArqDeco.com</a>
                        </li>
                        <li>
                            <strong>Telefone:</strong><br>
                            <a href="tel:+5511977775555">(11) 97777-5555</a>
                        </li>
                        <li>
                            <strong>Horário:</strong><br>
                            Seg-Sex: 9h às 18h
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p>© <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?>. Todos os direitos reservados.</p>
                <!-- <p><a href="https://ciriloandrade.dev" target="_blank">CiriloAV</a></p> -->
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
<?php
get_header();
?>

<main class="section">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="page-shell card">
                    <header class="page-header">
                        <h1 class="section-title page-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-content page-content">
                        <?php
                        if (function_exists('the_content')) {
                            call_user_func('the_content');
                        }
                        ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <article class="card">
                <h2>Nenhum conteúdo encontrado</h2>
                <p>Esta página não possui conteúdo.</p>
            </article>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();

<?php
get_header();
?>
<main class="section">
	<div class="container">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="card" style="margin-bottom:16px;">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div><?php the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<article class="card">
				<h2>Nenhum conteúdo encontrado</h2>
				<p>Publique uma página ou post para começar.</p>
			</article>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();

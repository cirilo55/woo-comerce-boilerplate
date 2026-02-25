<?php get_header(); ?>

<main class="section">
	<div class="container">
		<article class="card" style="text-align:center; padding:36px;">
			<h1>Página não encontrada</h1>
			<p>A página que você tentou acessar não existe ou foi movida.</p>
			<p>
				<a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>">Voltar para a home</a>
			</p>
		</article>
	</div>
</main>

<?php get_footer(); ?>

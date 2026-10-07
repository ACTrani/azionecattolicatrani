<?php
/**
 * Title: Home page
 * Slug: ac-trani/home
 * Categories: ac-trani
 * Description: La home del sito, sulla struttura di acaversa.it: il prossimo appuntamento in grande, le tessere dei settori, il calendario, le notizie in evidenza, documenti e cammino dell'anno.
 * Keywords: home, apertura, eventi, settori
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"align":"full","className":"ac-apertura","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull ac-apertura">
	<!-- wp:group {"align":"wide","className":"ac-apertura__griglia","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide ac-apertura__griglia">
		<!-- wp:ac-trani/prossimo-appuntamento /-->

		<!-- wp:group {"className":"ac-anno","layout":{"type":"default"}} -->
		<div class="wp-block-group ac-anno">
			<!-- wp:heading {"level":1} -->
			<h1 class="wp-block-heading">Vino nuovo in otri nuovi</h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>Mc 2,18-22 · l'icona biblica dell'anno associativo 2026/2027</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p><a href="/programmazione/">Il cammino dell'anno →</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:ac-trani/tessere-settori {"align":"wide","className":"ac-sovrapposte","colonne":6,"descrizioni":false} /-->

<!-- wp:group {"tagName":"section","align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"default"}} -->
<section class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:ac-trani/elenco-eventi {"numero":5,"salta":1,"titolo":"Poi, in calendario","linkArchivio":true} /-->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","align":"full","className":"ac-fascia","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull ac-fascia" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:ac-trani/ultime-notizie {"align":"wide","numero":3,"primaGrande":true,"titolo":"Notizie in evidenza","linkArchivio":true} /-->
</section>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","className":"ac-doppia","style":{"spacing":{"padding":{"top":"var:preset|spacing|80"}}}} -->
<div class="wp-block-columns alignwide ac-doppia" style="padding-top:var(--wp--preset--spacing--80)">
	<!-- wp:column {"width":"62%"} -->
	<div class="wp-block-column" style="flex-basis:62%">
		<!-- wp:ac-trani/elenco-documenti {"numero":6,"compatta":true,"titolo":"Documenti e moduli","linkArchivio":true} /-->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"38%"} -->
	<div class="wp-block-column" style="flex-basis:38%">
		<!-- wp:group {"tagName":"aside","className":"ac-cammino","layout":{"type":"default"}} -->
		<aside class="wp-block-group ac-cammino">
			<!-- wp:heading -->
			<h2 class="wp-block-heading">Il cammino 2026/2027</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"className":"ac-cammino__voce"} -->
			<p class="ac-cammino__voce"><strong>Il verbo</strong><span>generare</span></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"ac-cammino__voce"} -->
			<p class="ac-cammino__voce"><strong>L’ambiente</strong><span>la piazza</span></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"ac-cammino__voce"} -->
			<p class="ac-cammino__voce"><strong>Il triennio</strong><span>costruttori della storia</span></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"className":"ac-cammino__voce"} -->
			<p class="ac-cammino__voce"><strong>Il filo rosso</strong><span>la corresponsabilità</span></p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-chiaro"} -->
				<div class="wp-block-button is-style-chiaro"><a class="wp-block-button__link wp-element-button" href="/programmazione/">Leggi la programmazione</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</aside>
		<!-- /wp:group -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

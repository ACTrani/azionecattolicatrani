<?php
/**
 * Title: Home page
 * Slug: ac-trani/home
 * Categories: ac-trani
 * Description: La home page del sito: apertura con l'icona biblica dell'anno, prossimi appuntamenti, notizie, settori, documenti.
 * Keywords: home, apertura, eventi
 * Viewport Width: 1400
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"blu","textColor":"carta","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-carta-color has-blu-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.18em","fontWeight":"700","fontSize":"0.75rem"}},"textColor":"ocra-chiara"} -->
	<p class="has-ocra-chiara-color has-text-color" style="font-size:0.75rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase">Anno associativo 2026/2027</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":1,"fontSize":"monumentale","style":{"typography":{"fontStyle":"italic","fontWeight":"600"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|40"}}},"textColor":"carta"} -->
	<h1 class="wp-block-heading has-carta-color has-text-color has-monumentale-font-size" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--40);font-style:italic;font-weight:600">Vino nuovo in otri nuovi</h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"grande","style":{"color":{"text":"#cfd8e3"}}} -->
	<p class="has-text-color has-grande-font-size" style="color:#cfd8e3">Laici che scelgono di stare, insieme, dentro la vita della Chiesa e della città. L'Azione Cattolica dell'Arcidiocesi di Trani – Barletta – Bisceglie.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)">
		<!-- wp:button {"backgroundColor":"ocra","textColor":"inchiostro"} -->
		<div class="wp-block-button"><a class="wp-block-button__link has-inchiostro-color has-ocra-background-color has-text-color has-background wp-element-button" href="/eventi/">Prossimi appuntamenti</a></div>
		<!-- /wp:button -->
		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/aderisci/">Aderisci</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:ac-trani/elenco-eventi {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|80"}}},"quando":"futuri","numero":4,"titolo":"Prossimi appuntamenti","layout":"griglia","linkArchivio":true} /-->

<!-- wp:ac-trani/ultime-notizie {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|80"}}},"numero":3,"titolo":"Notizie e comunicati","linkArchivio":true} /-->

<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"var:preset|spacing|80"},"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"pietra-scura","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-pietra-scura-background-color has-background" style="margin-top:var(--wp--preset--spacing--80);padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:ac-trani/tessere-settori {"align":"wide","titolo":"L'associazione, settore per settore","colonne":3,"descrizioni":true} /-->
</div>
<!-- /wp:group -->

<!-- wp:ac-trani/elenco-documenti {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|80"}}},"numero":5,"titolo":"Documenti e modulistica"} /-->

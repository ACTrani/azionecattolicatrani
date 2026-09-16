<?php
/**
 * Semina dell'ambiente locale: termini, contenuti dimostrativi, pagine, menu.
 *
 * Si lancia con WP-CLI (`wp eval-file`), non dal browser. È idempotente: si può
 * rilanciare quante volte si vuole, riconosce quello che esiste già dallo slug
 * e lo aggiorna invece di duplicarlo.
 *
 * I contenuti arrivano da `contenuti-demo/contenuti.json`, che è l'esportazione
 * del prototipo Astro: i due ambienti mostrano esattamente le stesse cose, ed è
 * questo che rende il confronto onesto.
 *
 * ATTENZIONE: gli eventi sono reali (programmazione diocesana 2026/2027), ma
 * notizie e documenti sono INVENTATI. In produzione non si semina: i contenuti
 * si scrivono a mano.
 */

if ( ! defined( 'WP_CLI' ) ) {
	exit( "Da lanciare con WP-CLI.\n" );
}

$percorso = WP_CONTENT_DIR . '/contenuti-demo/contenuti.json';
if ( ! file_exists( $percorso ) ) {
	WP_CLI::error( "Non trovo $percorso" );
}

$dati = json_decode( (string) file_get_contents( $percorso ), true );
if ( ! is_array( $dati ) ) {
	WP_CLI::error( 'contenuti.json illeggibile' );
}

/* ---------------------------------------------------------------- *
 * 1. Tassonomie
 * ---------------------------------------------------------------- */

ac_trani_semina_termini();
WP_CLI::log( '✓ settori, tipi di documento, anni associativi, categoria «Comunicati ufficiali»' );

/** Slug dell'anno associativo: «2026/2027» → «2026-2027». */
$anno_slug = fn( string $anno ): string => str_replace( '/', '-', $anno );

/** Trova un contenuto dal suo slug, o restituisce 0. */
$trova = function ( string $slug, string $tipo ): int {
	$trovati = get_posts(
		array(
			'name'           => $slug,
			'post_type'      => $tipo,
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);
	return $trovati ? (int) $trovati[0] : 0;
};

/* ---------------------------------------------------------------- *
 * 2. Eventi
 * ---------------------------------------------------------------- */

$nuovi = 0;
foreach ( $dati['eventi'] as $e ) {
	$id = $trova( $e['slug'], 'evento' );

	$id = wp_insert_post(
		array(
			'ID'           => $id ?: 0,
			'post_type'    => 'evento',
			'post_status'  => 'publish',
			'post_name'    => $e['slug'],
			'post_title'   => $e['titolo'],
			'post_excerpt' => $e['sommario'],
			'post_content' => ac_trani_markdown_in_blocchi( $e['corpo'] ),
			// La data di pubblicazione non c'entra con la data dell'evento:
			// gli eventi futuri sono pubblicati oggi.
			'post_date'    => current_time( 'mysql' ),
		),
		true
	);

	if ( is_wp_error( $id ) ) {
		WP_CLI::warning( 'evento ' . $e['slug'] . ': ' . $id->get_error_message() );
		continue;
	}

	update_post_meta( $id, 'ac_data_inizio', $e['dataInizio'] );
	update_post_meta( $id, 'ac_data_fine', $e['dataFine'] );
	update_post_meta( $id, 'ac_orario', $e['orario'] );
	update_post_meta( $id, 'ac_luogo_nome', $e['luogoNome'] );
	update_post_meta( $id, 'ac_luogo_indirizzo', $e['luogoIndirizzo'] );
	update_post_meta( $id, 'ac_luogo_comune', $e['luogoComune'] );
	update_post_meta( $id, 'ac_mappa_url', $e['mappaUrl'] );
	update_post_meta( $id, 'ac_link_iscrizione', $e['linkIscrizione'] );
	update_post_meta( $id, 'ac_annullato', $e['annullato'] );
	update_post_meta( $id, 'ac_in_evidenza', $e['inEvidenza'] );

	wp_set_object_terms( $id, $e['settore'], 'settore' );
	wp_set_object_terms( $id, $anno_slug( $e['annoAssociativo'] ), 'anno-associativo' );
	$nuovi++;
}
WP_CLI::log( "✓ $nuovi eventi (programmazione diocesana 2026/2027, dati reali)" );

/* ---------------------------------------------------------------- *
 * 3. Notizie
 * ---------------------------------------------------------------- */

$date_notizie = ac_trani_date_pubblicabili( $dati['notizie'], 'data' );

$nuovi = 0;
foreach ( $dati['notizie'] as $n ) {
	$id = $trova( $n['slug'], 'post' );

	$id = wp_insert_post(
		array(
			'ID'           => $id ?: 0,
			'post_type'    => 'post',
			'post_status'  => 'publish',
			'post_name'    => $n['slug'],
			'post_title'   => $n['titolo'],
			'post_excerpt' => $n['sommario'],
			'post_content' => ac_trani_markdown_in_blocchi( $n['corpo'] ),
			'post_date'    => $date_notizie[ $n['slug'] ],
		),
		true
	);

	if ( is_wp_error( $id ) ) {
		WP_CLI::warning( 'notizia ' . $n['slug'] . ': ' . $id->get_error_message() );
		continue;
	}

	wp_set_object_terms( $id, $n['settore'], 'settore' );
	wp_set_object_terms( $id, $n['comunicato'] ? array( 'comunicati-ufficiali' ) : array(), 'category' );
	$nuovi++;
}
WP_CLI::log( "✓ $nuovi notizie (INVENTATE, da sostituire)" );

/* ---------------------------------------------------------------- *
 * 4. Documenti
 * ---------------------------------------------------------------- */

$date_documenti = ac_trani_date_pubblicabili( $dati['documenti'], 'data' );

$nuovi = 0;
foreach ( $dati['documenti'] as $d ) {
	$id = $trova( $d['slug'], 'documento' );

	$id = wp_insert_post(
		array(
			'ID'           => $id ?: 0,
			'post_type'    => 'documento',
			'post_status'  => 'publish',
			'post_name'    => $d['slug'],
			'post_title'   => $d['titolo'],
			'post_excerpt' => $d['descrizione'],
			'post_content' => ac_trani_markdown_in_blocchi( $d['corpo'] ),
			'post_date'    => $date_documenti[ $d['slug'] ],
		),
		true
	);

	if ( is_wp_error( $id ) ) {
		WP_CLI::warning( 'documento ' . $d['slug'] . ': ' . $id->get_error_message() );
		continue;
	}

	update_post_meta( $id, 'ac_data', $d['data'] );
	// Il file vero non c'è: nel prototipo era un percorso finto. Si carica dalla
	// Libreria media quando arriveranno i PDF veri.
	update_post_meta( $id, 'ac_formato', $d['formato'] );
	update_post_meta( $id, 'ac_dimensione', $d['dimensione'] );

	wp_set_object_terms( $id, $d['settore'], 'settore' );
	wp_set_object_terms( $id, $d['tipo'], 'tipo-documento' );
	wp_set_object_terms( $id, $anno_slug( $d['annoAssociativo'] ), 'anno-associativo' );
	$nuovi++;
}
WP_CLI::log( "✓ $nuovi documenti (INVENTATI, senza file allegato)" );

/* ---------------------------------------------------------------- *
 * 5. Pagine istituzionali
 * ---------------------------------------------------------------- */

$pagine = array(
	'home'        => array( 'Home', '' ),
	'chi-siamo'   => array( 'Chi siamo', "<!-- wp:pattern {\"slug\":\"ac-trani/intestazione-sezione\"} /-->\n\n<!-- wp:paragraph -->\n<p>Mezza pagina di presentazione dell'associazione diocesana: dove è presente, cosa propone, come si aderisce. Da scrivere — è nel gruppo A dei contenuti da raccogliere.</p>\n<!-- /wp:paragraph -->" ),
	'presidenza'  => array( 'Presidenza diocesana', "<!-- wp:pattern {\"slug\":\"ac-trani/presidenza\"} /-->" ),
	'aderisci'    => array( 'Aderisci', "<!-- wp:heading {\"level\":1} -->\n<h1 class=\"wp-block-heading\">Aderisci all'Azione Cattolica</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Come si aderisce, quando, con quali quote e a chi rivolgersi in parrocchia. Da scrivere.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:ac-trani/elenco-documenti {\"numero\":3,\"tipo\":\"modulo\",\"titolo\":\"Moduli\"} /-->" ),
	'contatti'    => array( 'Contatti', "<!-- wp:heading {\"level\":1} -->\n<h1 class=\"wp-block-heading\">Contatti</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Palazzo Arcivescovile, Via Beltrani 9 — 76125 Trani (BT)<br>Telefono 0883 494202<br><a href=\"mailto:info@azionecattolicatrani.it\">info@azionecattolicatrani.it</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><em>Recapiti presi dal portale nazionale: da confermare.</em></p>\n<!-- /wp:paragraph -->" ),
	'notizie'     => array( 'Notizie e comunicati', '' ),
);

$id_pagine = array();
foreach ( $pagine as $slug => [$titolo, $contenuto] ) {
	$id = $trova( $slug, 'page' );
	$id = wp_insert_post(
		array(
			'ID'           => $id ?: 0,
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_name'    => $slug,
			'post_title'   => $titolo,
			'post_content' => $contenuto,
		),
		true
	);
	if ( ! is_wp_error( $id ) ) {
		$id_pagine[ $slug ] = (int) $id;
	}
}

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $id_pagine['home'] ?? 0 );
update_option( 'page_for_posts', $id_pagine['notizie'] ?? 0 );
WP_CLI::log( '✓ pagine istituzionali, home statica, pagina delle notizie' );

/* ---------------------------------------------------------------- *
 * 6. Menu di navigazione
 * ---------------------------------------------------------------- */

$voci = array(
	array( 'L’associazione', get_permalink( $id_pagine['chi-siamo'] ?? 0 ) ),
	array( 'Eventi', get_post_type_archive_link( 'evento' ) ),
	array( 'Notizie e comunicati', get_permalink( $id_pagine['notizie'] ?? 0 ) ),
	array( 'Documenti', get_post_type_archive_link( 'documento' ) ),
	array( 'Aderisci', get_permalink( $id_pagine['aderisci'] ?? 0 ) ),
);

$blocchi_menu = '';
foreach ( $voci as [$etichetta, $url] ) {
	if ( ! $url ) {
		continue;
	}
	$blocchi_menu .= sprintf(
		"<!-- wp:navigation-link {\"label\":%s,\"url\":%s,\"kind\":\"custom\"} /-->\n",
		wp_json_encode( $etichetta ),
		wp_json_encode( wp_make_link_relative( $url ) )
	);
}

$menu_esistente = get_posts( array( 'post_type' => 'wp_navigation', 'posts_per_page' => 1, 'post_status' => 'any', 'fields' => 'ids' ) );
wp_insert_post(
	array(
		'ID'           => $menu_esistente ? (int) $menu_esistente[0] : 0,
		'post_type'    => 'wp_navigation',
		'post_status'  => 'publish',
		'post_title'   => 'Navigazione principale',
		// wp_insert_post toglie le barre rovesce: senza wp_slash, «L\u2019associazione»
		// nel JSON del blocco diventerebbe «Lu2019associazione» a schermo.
		'post_content' => wp_slash( $blocchi_menu ),
	)
);
WP_CLI::log( '✓ menu principale' );

/* ---------------------------------------------------------------- *
 * 7. Logo e icona del sito
 * ---------------------------------------------------------------- */

$logo = get_theme_file_path( 'assets/logo-ac-trani.png' );
if ( file_exists( $logo ) && ! get_theme_mod( 'custom_logo' ) ) {
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	$temporaneo = wp_tempnam( 'logo-ac-trani.png' );
	copy( $logo, $temporaneo );
	$allegato = media_handle_sideload(
		array( 'name' => 'logo-ac-trani.png', 'tmp_name' => $temporaneo ),
		0,
		'Logo dell’Azione Cattolica'
	);
	if ( ! is_wp_error( $allegato ) ) {
		set_theme_mod( 'custom_logo', $allegato );
		update_option( 'site_icon', $allegato );
		WP_CLI::log( '✓ logo e icona del sito' );
	}
}

flush_rewrite_rules();
WP_CLI::success( 'Ambiente pronto: http://localhost:8081' );

/* ---------------------------------------------------------------- *
 * Utilità
 * ---------------------------------------------------------------- */

/**
 * WordPress programma i contenuti con data futura invece di pubblicarli, e i
 * contenuti dimostrativi del prototipo hanno date sparse nell'anno associativo:
 * senza questa correzione metà archivio resterebbe invisibile.
 *
 * Le date passate restano come sono. Quelle future vengono riportate a oggi e
 * ai giorni precedenti, mantenendo l'ordine cronologico fra loro.
 *
 * Riguarda solo la semina dimostrativa: in produzione una data futura significa
 * davvero «pubblica più tardi», ed è giusto che si comporti così.
 *
 * @return array<string,string> slug => data «Y-m-d H:i:s»
 */
function ac_trani_date_pubblicabili( array $elementi, string $campo ): array {
	$oggi = current_time( 'Y-m-d' );

	$futuri = array_values(
		array_filter( $elementi, fn( $e ) => $e[ $campo ] > $oggi )
	);
	usort( $futuri, fn( $a, $b ) => strcmp( $b[ $campo ], $a[ $campo ] ) );

	$date = array();
	foreach ( $elementi as $e ) {
		$date[ $e['slug'] ] = $e[ $campo ] . ' 09:00:00';
	}
	foreach ( $futuri as $i => $e ) {
		$date[ $e['slug'] ] = gmdate( 'Y-m-d', strtotime( "$oggi -$i day" ) ) . ' 09:00:00';
	}

	return $date;
}

/**
 * Converte il markdown minimo usato nel prototipo (paragrafi, citazioni,
 * grassetto, corsivo) in blocchi Gutenberg. Non è un parser markdown: copre
 * solo quello che c'è davvero in `contenuti.json`.
 */
function ac_trani_markdown_in_blocchi( string $testo ): string {
	$testo = trim( $testo );
	if ( '' === $testo ) {
		return '';
	}

	$blocchi = array();
	foreach ( preg_split( '/\n\s*\n/', $testo ) as $paragrafo ) {
		$paragrafo = trim( $paragrafo );
		if ( '' === $paragrafo ) {
			continue;
		}

		$citazione = str_starts_with( $paragrafo, '>' );
		if ( $citazione ) {
			$paragrafo = trim( preg_replace( '/^>\s?/m', '', $paragrafo ) );
		}

		$html = esc_html( $paragrafo );
		$html = preg_replace( '/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $html );
		$html = preg_replace( '/(?<!\*)\*([^*]+)\*(?!\*)/s', '<em>$1</em>', $html );
		$html = str_replace( "\n", '<br>', $html );

		if ( $citazione ) {
			$blocchi[] = "<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><!-- wp:paragraph -->\n<p>$html</p>\n<!-- /wp:paragraph --></blockquote>\n<!-- /wp:quote -->";
		} else {
			$blocchi[] = "<!-- wp:paragraph -->\n<p>$html</p>\n<!-- /wp:paragraph -->";
		}
	}

	return implode( "\n\n", $blocchi );
}

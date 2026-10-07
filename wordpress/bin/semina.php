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
	update_post_meta( $id, 'ac_data_indicativa', $e['dataIndicativa'] ?? '' );
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
	'chi-siamo'   => array( 'Chi siamo', "<!-- wp:paragraph {\"fontSize\":\"grande\",\"textColor\":\"tenue\"} -->\n<p class=\"has-tenue-color has-text-color has-grande-font-size\">Mezza pagina di presentazione dell'associazione diocesana: dove è presente, cosa propone, come si aderisce. Da scrivere — è nel gruppo A dei contenuti da raccogliere.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Quest'anno il cammino è guidato dall'icona biblica «Vino nuovo in otri nuovi» (Mc 2,18-22): <a href=\"/programmazione/\">leggi la programmazione 2026/2027</a>.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:pattern {\"slug\":\"ac-trani/centro-studi\"} /-->" ),
	'programmazione' => array( 'Programmazione 2026/2027', "<!-- wp:pattern {\"slug\":\"ac-trani/programmazione-anno\"} /-->" ),
	'presidenza'  => array( 'Presidenza diocesana', "<!-- wp:pattern {\"slug\":\"ac-trani/presidenza\"} /-->" ),
	'assemblea'   => array( 'Assemblea diocesana elettiva', "<!-- wp:pattern {\"slug\":\"ac-trani/assemblea\"} /-->" ),
	'aderisci'    => array( 'Aderisci all’Azione Cattolica', "<!-- wp:paragraph {\"fontSize\":\"grande\",\"textColor\":\"tenue\"} -->\n<p class=\"has-tenue-color has-text-color has-grande-font-size\">Come si aderisce, quando, con quali quote e a chi rivolgersi in parrocchia. Da scrivere.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p>Ispirata dalla chiamata a essere «vino nuovo in otri nuovi», l'associazione offre a ciascuno la possibilità di uscire da schemi rigidi e consuetudini stanche, custodendo una fede viva, duttile e generativa. Scegliere l'AC significa scegliere di camminare insieme per far fiorire spazi di pace, ascolto e continua novità.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Promozione associativa</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>L'Area promozione associativa diocesana mette a disposizione materiali e strumenti per la promozione nelle parrocchie. Si può chiedere la presenza dell'incaricata, Ottavia Palladino, per approfondimenti o eventi nella propria comunità: basta scrivere alla <a href=\"/contatti/\">segreteria diocesana</a>.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">Sostieni l'associazione</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>«Un futuro di valori»: si può sostenere l'Azione Cattolica dell'Arcidiocesi di Trani – Barletta – Bisceglie anche con la <a href=\"https://gofund.me/977ca3487\" target=\"_blank\" rel=\"noreferrer noopener\">raccolta fondi online</a>.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:ac-trani/elenco-documenti {\"numero\":3,\"tipo\":\"modulo\",\"titolo\":\"Moduli\"} /-->" ),
	'contatti'    => array( 'Contatti', "<!-- wp:paragraph -->\n<p>Palazzo Arcivescovile, Via Beltrani 9 — 76125 Trani (BT)<br>Telefono 0883 494202<br><a href=\"mailto:info@azionecattolicatrani.it\">info@azionecattolicatrani.it</a></p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><em>Recapiti presi dal portale nazionale: da confermare.</em></p>\n<!-- /wp:paragraph -->" ),
	'notizie'     => array( 'Notizie', '' ),
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

// La struttura di acaversa.it, scelta dalla Presidenza come riferimento:
// Home · Notizie · Eventi · Settori ▾ · Assemblea ▾ · Informazioni ▾.
// «Aderisci» è un pulsante in testata; nel menu compare solo sul telefono.
$link = function ( string $etichetta, string $url, int $pagina = 0, string $classe = '' ): string {
	$attributi = array( 'label' => $etichetta, 'url' => wp_make_link_relative( $url ) );
	if ( $pagina ) {
		$attributi += array( 'type' => 'page', 'id' => $pagina, 'kind' => 'post-type' );
	} else {
		$attributi['kind'] = 'custom';
	}
	if ( $classe ) {
		$attributi['className'] = $classe;
	}
	return '<!-- wp:navigation-link ' . wp_json_encode( $attributi, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . " /-->\n";
};
$sottomenu = function ( string $etichetta, string $voci ): string {
	return '<!-- wp:navigation-submenu ' . wp_json_encode( array( 'label' => $etichetta, 'url' => '', 'kind' => 'custom' ), JSON_UNESCAPED_UNICODE ) . " -->\n" . $voci . "<!-- /wp:navigation-submenu -->\n";
};
$pagina = fn( string $slug ): int => $id_pagine[ $slug ] ?? 0;
$url    = fn( string $slug ): string => (string) get_permalink( $pagina( $slug ) );

$settori_menu = array(
	'acr'      => 'Ragazzi (ACR)',
	'msac'     => 'Studenti (MSAC)',
	'giovani'  => 'Giovani',
	'adulti'   => 'Adulti',
	'mlac'     => 'Lavoratori (MLAC)',
	'unitario' => 'Unitario',
);
$voci_settori = '';
foreach ( $settori_menu as $slug => $etichetta ) {
	$termine = get_term_by( 'slug', $slug, 'settore' );
	if ( $termine ) {
		$voci_settori .= $link( $etichetta, (string) get_term_link( $termine ), 0, 'ac-tinta-' . $slug );
	}
}

$blocchi_menu =
	$link( 'Home', home_url( '/' ) ) .
	$link( 'Notizie', $url( 'notizie' ), $pagina( 'notizie' ) ) .
	$link( 'Eventi', (string) get_post_type_archive_link( 'evento' ) ) .
	$sottomenu( 'Settori', $voci_settori ) .
	$sottomenu(
		'Assemblea',
		$link( 'Assemblea diocesana 2027', $url( 'assemblea' ), $pagina( 'assemblea' ) ) .
		$link( 'Assemblee parrocchiali', $url( 'assemblea' ) . '#parrocchiali' )
	) .
	$sottomenu(
		'Informazioni',
		$link( 'Programmazione 2026/2027', $url( 'programmazione' ), $pagina( 'programmazione' ) ) .
		$link( 'Documenti e moduli', (string) get_post_type_archive_link( 'documento' ) ) .
		$link( 'Chi siamo', $url( 'chi-siamo' ), $pagina( 'chi-siamo' ) ) .
		$link( 'Presidenza', $url( 'presidenza' ), $pagina( 'presidenza' ) ) .
		$link( 'Consiglio diocesano', $url( 'presidenza' ) . '#consiglio' ) .
		$link( 'Contatti', $url( 'contatti' ), $pagina( 'contatti' ) )
	) .
	$link( 'Aderisci', $url( 'aderisci' ), $pagina( 'aderisci' ), 'ac-solo-mobile' );

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

		// Titoletti «## …» e «### …».
		if ( preg_match( '/^(#{2,3})\s+(.+)$/', $paragrafo, $t ) ) {
			$livello   = strlen( $t[1] );
			$attributi = 2 === $livello ? '' : ' {"level":3}';
			$blocchi[] = "<!-- wp:heading$attributi -->\n<h$livello class=\"wp-block-heading\">" . esc_html( $t[2] ) . "</h$livello>\n<!-- /wp:heading -->";
			continue;
		}

		$righe = preg_split( '/\n/', $paragrafo );
		$voci  = array_filter( $righe, fn( $r ) => (bool) preg_match( '/^\s*[-–*]\s+/', $r ) );

		$citazione = str_starts_with( $paragrafo, '>' );
		if ( $citazione ) {
			$paragrafo = trim( preg_replace( '/^>\s?/m', '', $paragrafo ) );
		}

		$html = esc_html( $paragrafo );
		$html = preg_replace( '/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $html );
		$html = preg_replace( '/(?<!\*)\*([^*]+)\*(?!\*)/s', '<em>$1</em>', $html );
		$html = str_replace( "\n", '<br>', $html );

		if ( count( $voci ) === count( $righe ) ) {
			$elementi = '';
			foreach ( $righe as $riga ) {
				$voce      = esc_html( (string) preg_replace( '/^\s*[-–*]\s+/', '', $riga ) );
				$voce      = preg_replace( '/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $voce );
				$voce      = preg_replace( '/(?<!\*)\*([^*]+)\*(?!\*)/s', '<em>$1</em>', $voce );
				$elementi .= "<!-- wp:list-item -->\n<li>$voce</li>\n<!-- /wp:list-item -->\n";
			}
			$blocchi[] = "<!-- wp:list -->\n<ul class=\"wp-block-list\">$elementi</ul>\n<!-- /wp:list -->";
		} elseif ( $citazione ) {
			$blocchi[] = "<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><!-- wp:paragraph -->\n<p>$html</p>\n<!-- /wp:paragraph --></blockquote>\n<!-- /wp:quote -->";
		} else {
			$blocchi[] = "<!-- wp:paragraph -->\n<p>$html</p>\n<!-- /wp:paragraph -->";
		}
	}

	return implode( "\n\n", $blocchi );
}

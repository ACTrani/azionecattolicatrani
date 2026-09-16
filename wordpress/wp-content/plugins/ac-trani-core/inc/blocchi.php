<?php
/**
 * Blocchi dinamici.
 *
 * Sono il punto di contatto fra plugin e tema: i grafici li inseriscono
 * dall'editor come qualsiasi altro blocco e li regolano dalla barra laterale,
 * senza sapere nulla di query o di meta.
 *
 * Nessun passaggio di compilazione: `blocchi.js` è JavaScript normale che gira
 * così com'è nel browser. Vuol dire che il plugin si può caricare per FTP e che
 * fra due anni funzionerà ancora, senza rieseguire una build.
 */

defined( 'ABSPATH' ) || exit;

/** I blocchi registrati, nell'ordine in cui compaiono nell'inseritore. */
function ac_trani_elenco_blocchi(): array {
	return array( 'elenco-eventi', 'tessere-settori', 'elenco-documenti', 'ultime-notizie', 'scheda-evento' );
}

add_action( 'init', 'ac_trani_registra_blocchi', 20 );

function ac_trani_registra_blocchi(): void {

	wp_register_script(
		'ac-trani-blocchi',
		AC_TRANI_URL . 'assets/blocchi.js',
		array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-server-side-render', 'wp-i18n' ),
		AC_TRANI_VERSIONE,
		true
	);

	// L'editor ha bisogno dei settori e degli anni per popolare i menu a tendina.
	wp_add_inline_script(
		'ac-trani-blocchi',
		'window.acTrani = ' . wp_json_encode(
			array(
				'settori' => ac_trani_opzioni_termini( 'settore' ),
				'anni'    => ac_trani_opzioni_termini( 'anno-associativo' ),
				'tipi'    => ac_trani_opzioni_termini( 'tipo-documento' ),
			)
		) . ';',
		'before'
	);

	foreach ( ac_trani_elenco_blocchi() as $nome ) {
		register_block_type( AC_TRANI_DIR . 'blocchi/' . $nome );
	}
}

/** Termini di una tassonomia nel formato che i controlli dell'editor si aspettano. */
function ac_trani_opzioni_termini( string $tassonomia ): array {
	$opzioni = array( array( 'label' => 'Tutti', 'value' => '' ) );
	$termini = get_terms( array( 'taxonomy' => $tassonomia, 'hide_empty' => false ) );

	if ( is_wp_error( $termini ) ) {
		return $opzioni;
	}
	foreach ( $termini as $t ) {
		$opzioni[] = array( 'label' => $t->name, 'value' => $t->slug );
	}
	return $opzioni;
}

/**
 * Involucro comune dei blocchi: applica le classi che l'editor a blocchi
 * genera (allineamento, margini, classi personalizzate) senza che ogni
 * render.php se ne debba ricordare.
 */
function ac_trani_involucro( string $classe, string $contenuto, array $extra = array() ): string {
	$attributi = get_block_wrapper_attributes( array_merge( array( 'class' => $classe ), $extra ) );
	return sprintf( '<div %s>%s</div>', $attributi, $contenuto );
}

/** Messaggio mostrato quando una selezione non restituisce nulla. */
function ac_trani_vuoto( string $testo ): string {
	return '<p class="ac-vuoto">' . esc_html( $testo ) . '</p>';
}

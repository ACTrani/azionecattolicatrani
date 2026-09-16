<?php
/**
 * Interrogazioni e formattazioni condivise.
 *
 * Questo file è il gemello di `poc-astro/src/lib/contenuti.ts`: è l'unico punto
 * da cui blocchi e template prendono i dati. Se cambia il modo di leggerli,
 * cambia qui e basta.
 */

defined( 'ABSPATH' ) || exit;

/** Oggi in formato Y-m-d, nel fuso del sito (non in UTC: un evento è locale). */
function ac_trani_oggi(): string {
	return current_time( 'Y-m-d' );
}

/**
 * Eventi.
 *
 * @param array $opzioni quando: futuri|passati|tutti · numero · settore (slug o
 *                       elenco) · anno (slug) · evidenza (bool).
 * @return WP_Post[]
 */
function ac_trani_eventi( array $opzioni = array() ): array {
	$o = wp_parse_args(
		$opzioni,
		array(
			'quando'   => 'futuri',
			'numero'   => 4,
			'settore'  => '',
			'anno'     => '',
			'evidenza' => false,
		)
	);

	$args = array(
		'post_type'      => 'evento',
		'post_status'    => 'publish',
		'posts_per_page' => (int) $o['numero'],
		'meta_key'       => 'ac_data_inizio',
		'orderby'        => 'meta_value',
		'order'          => 'passati' === $o['quando'] ? 'DESC' : 'ASC',
		'no_found_rows'  => true,
	);

	if ( 'passati' === $o['quando'] ) {
		$args['meta_query'] = array(
			array( 'key' => 'ac_data_inizio', 'value' => ac_trani_oggi(), 'compare' => '<', 'type' => 'DATE' ),
		);
	} elseif ( 'futuri' === $o['quando'] ) {
		// Un appuntamento di più giorni resta «prossimo» finché non è finito.
		$args['meta_query'] = array(
			'relation' => 'OR',
			array( 'key' => 'ac_data_inizio', 'value' => ac_trani_oggi(), 'compare' => '>=', 'type' => 'DATE' ),
			array( 'key' => 'ac_data_fine', 'value' => ac_trani_oggi(), 'compare' => '>=', 'type' => 'DATE' ),
		);
	}

	$tax = array();
	if ( $o['settore'] ) {
		$tax[] = array(
			'taxonomy' => 'settore',
			'field'    => 'slug',
			'terms'    => (array) $o['settore'],
		);
	}
	if ( $o['anno'] ) {
		$tax[] = array(
			'taxonomy' => 'anno-associativo',
			'field'    => 'slug',
			'terms'    => (array) $o['anno'],
		);
	}
	if ( $tax ) {
		$args['tax_query'] = $tax;
	}

	if ( $o['evidenza'] ) {
		$evidenza = array( 'key' => 'ac_in_evidenza', 'value' => '1' );
		$args['meta_query'] = isset( $args['meta_query'] )
			? array( 'relation' => 'AND', $args['meta_query'], $evidenza )
			: array( $evidenza );
	}

	return get_posts( $args );
}

/**
 * Documenti.
 *
 * @param array $opzioni numero · settore · anno · tipo (slug di tipo-documento).
 * @return WP_Post[]
 */
function ac_trani_documenti( array $opzioni = array() ): array {
	$o = wp_parse_args(
		$opzioni,
		array( 'numero' => 10, 'settore' => '', 'anno' => '', 'tipo' => '' )
	);

	$args = array(
		'post_type'      => 'documento',
		'post_status'    => 'publish',
		'posts_per_page' => (int) $o['numero'],
		'meta_key'       => 'ac_data',
		'orderby'        => 'meta_value',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	);

	$tax = array();
	foreach ( array( 'settore' => 'settore', 'anno' => 'anno-associativo', 'tipo' => 'tipo-documento' ) as $chiave => $tassonomia ) {
		if ( $o[ $chiave ] ) {
			$tax[] = array( 'taxonomy' => $tassonomia, 'field' => 'slug', 'terms' => (array) $o[ $chiave ] );
		}
	}
	if ( $tax ) {
		$args['tax_query'] = $tax;
	}

	return get_posts( $args );
}

/**
 * Notizie (articoli standard).
 *
 * @param array $opzioni numero · settore · solo_comunicati (bool).
 * @return WP_Post[]
 */
function ac_trani_notizie( array $opzioni = array() ): array {
	$o = wp_parse_args( $opzioni, array( 'numero' => 3, 'settore' => '', 'solo_comunicati' => false ) );

	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => (int) $o['numero'],
		'no_found_rows'  => true,
	);

	$tax = array();
	if ( $o['settore'] ) {
		$tax[] = array( 'taxonomy' => 'settore', 'field' => 'slug', 'terms' => (array) $o['settore'] );
	}
	if ( $o['solo_comunicati'] ) {
		$tax[] = array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => array( 'comunicati-ufficiali' ) );
	}
	if ( $tax ) {
		$args['tax_query'] = $tax;
	}

	return get_posts( $args );
}

/* ------------------------------------------------------------------ *
 * Formattazione
 * ------------------------------------------------------------------ */

/** Il settore di un contenuto, come termine, oppure null. */
function ac_trani_settore( int $post_id ): ?WP_Term {
	$termini = get_the_terms( $post_id, 'settore' );
	return ( $termini && ! is_wp_error( $termini ) ) ? $termini[0] : null;
}

/** Lo slug del settore, per l'attributo `data-settore` che il tema colora. */
function ac_trani_settore_slug( int $post_id ): string {
	$termine = ac_trani_settore( $post_id );
	return $termine ? $termine->slug : 'unitario';
}

/**
 * «12 ottobre 2026», oppure «12 – 14 ottobre 2026» quando l'intervallo lo
 * consente: il mese e l'anno si ripetono solo se cambiano davvero.
 */
function ac_trani_intervallo_leggibile( int $post_id ): string {
	$inizio = (string) get_post_meta( $post_id, 'ac_data_inizio', true );
	$fine   = (string) get_post_meta( $post_id, 'ac_data_fine', true );

	if ( ! $inizio ) {
		return '';
	}

	$d1 = date_create( $inizio );
	if ( ! $d1 ) {
		return '';
	}
	$d2 = $fine ? date_create( $fine ) : null;

	if ( ! $d2 || $d2 <= $d1 ) {
		return ac_trani_data_italiana( $d1->getTimestamp() );
	}

	if ( $d1->format( 'Y-m' ) === $d2->format( 'Y-m' ) ) {
		return $d1->format( 'j' ) . ' – ' . ac_trani_data_italiana( $d2->getTimestamp() );
	}
	if ( $d1->format( 'Y' ) === $d2->format( 'Y' ) ) {
		return ac_trani_data_italiana( $d1->getTimestamp(), 'j F' ) . ' – ' . ac_trani_data_italiana( $d2->getTimestamp() );
	}
	return ac_trani_data_italiana( $d1->getTimestamp() ) . ' – ' . ac_trani_data_italiana( $d2->getTimestamp() );
}

/** «Centro Pastorale, Trani» senza doppioni né virgole pendenti. */
function ac_trani_luogo_leggibile( int $post_id ): string {
	$nome   = trim( (string) get_post_meta( $post_id, 'ac_luogo_nome', true ) );
	$comune = trim( (string) get_post_meta( $post_id, 'ac_luogo_comune', true ) );

	if ( $nome && $comune && stripos( $nome, $comune ) === false ) {
		return $nome . ', ' . $comune;
	}
	return $nome ?: $comune;
}

/** L'URL del file di un documento: allegato se c'è, altrimenti link esterno. */
function ac_trani_file_url( int $post_id ): string {
	$id = (int) get_post_meta( $post_id, 'ac_file_id', true );
	if ( $id ) {
		return (string) wp_get_attachment_url( $id );
	}
	return (string) get_post_meta( $post_id, 'ac_file_url', true );
}

/** Formato e peso del file, già pronti da stampare: «PDF · 1,2 MB». */
function ac_trani_file_etichetta( int $post_id ): string {
	$formato = (string) get_post_meta( $post_id, 'ac_formato', true );
	$peso    = (string) get_post_meta( $post_id, 'ac_dimensione', true );
	$id      = (int) get_post_meta( $post_id, 'ac_file_id', true );

	if ( ! $formato && $id ) {
		$formato = strtoupper( (string) pathinfo( (string) get_attached_file( $id ), PATHINFO_EXTENSION ) );
	}
	if ( ! $peso && $id ) {
		$percorso = (string) get_attached_file( $id );
		if ( $percorso && file_exists( $percorso ) ) {
			$peso = size_format( (int) filesize( $percorso ), 1 );
		}
	}

	return trim( implode( ' · ', array_filter( array( $formato, $peso ) ) ) );
}

/**
 * Data in italiano: «7 febbraio 2027».
 *
 * `wp_date()` con la traduzione it_IT restituisce «Febbraio» maiuscolo, che in
 * italiano è sbagliato in mezzo a una frase. Qui si abbassa solo il nome del
 * mese, lasciando intatto tutto il resto.
 */
function ac_trani_data_italiana( int $quando, string $formato = 'j F Y' ): string {
	$testo = (string) wp_date( $formato, $quando );
	$mese  = (string) wp_date( 'F', $quando );

	return $mese ? str_replace( $mese, mb_strtolower( $mese, 'UTF-8' ), $testo ) : $testo;
}

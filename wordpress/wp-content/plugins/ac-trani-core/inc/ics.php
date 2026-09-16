<?php
/**
 * Export .ics.
 *
 * Due indirizzi:
 *   /calendario.ics                   tutti gli eventi, sottoscrivibile da
 *                                     Google Calendar, Apple Calendario, Outlook
 *   /eventi/<slug>/?ac_ics=1          il singolo appuntamento, da scaricare
 *
 * Gli eventi diocesani sono appuntamenti di giornata: senza orario si scrive
 * un evento «tutto il giorno» (VALUE=DATE), che è quello che i calendari
 * mostrano correttamente. Se c'è l'orario lo si usa come ora di inizio.
 */

defined( 'ABSPATH' ) || exit;

add_filter(
	'query_vars',
	function ( $vars ) {
		$vars[] = 'ac_ics';
		return $vars;
	}
);

add_action(
	'init',
	function () {
		add_rewrite_rule( '^calendario\.ics$', 'index.php?ac_ics=tutti', 'top' );
	}
);

add_action( 'template_redirect', 'ac_trani_forse_ics' );

function ac_trani_forse_ics(): void {
	$richiesta = get_query_var( 'ac_ics' );
	if ( ! $richiesta ) {
		return;
	}

	if ( 'tutti' === $richiesta ) {
		$eventi = ac_trani_eventi( array( 'quando' => 'tutti', 'numero' => 500 ) );
		$nome   = 'calendario-ac-trani.ics';
	} else {
		$post = get_post();
		if ( ! $post || 'evento' !== $post->post_type ) {
			return;
		}
		$eventi = array( $post );
		$nome   = $post->post_name . '.ics';
	}

	nocache_headers();
	header( 'Content-Type: text/calendar; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename="' . $nome . '"' );
	echo ac_trani_componi_ics( $eventi ); // phpcs:ignore WordPress.Security.EscapeOutput
	exit;
}

/**
 * @param WP_Post[] $eventi
 */
function ac_trani_componi_ics( array $eventi ): string {
	$righe = array(
		'BEGIN:VCALENDAR',
		'VERSION:2.0',
		'PRODID:-//Azione Cattolica Trani-Barletta-Bisceglie//Sito diocesano//IT',
		'CALSCALE:GREGORIAN',
		'METHOD:PUBLISH',
		'X-WR-CALNAME:Azione Cattolica — Trani, Barletta, Bisceglie',
		'X-WR-TIMEZONE:Europe/Rome',
	);

	foreach ( $eventi as $evento ) {
		$id     = $evento->ID;
		$inizio = (string) get_post_meta( $id, 'ac_data_inizio', true );
		if ( ! $inizio ) {
			continue;
		}
		$fine = (string) get_post_meta( $id, 'ac_data_fine', true );

		// DTEND è esclusivo: un evento del 12 finisce il 13.
		$ultimo   = $fine ?: $inizio;
		$fine_ics = gmdate( 'Ymd', strtotime( $ultimo . ' +1 day' ) );

		$descrizione = trim( wp_strip_all_tags( (string) get_the_excerpt( $id ) ) );
		$orario      = trim( (string) get_post_meta( $id, 'ac_orario', true ) );
		if ( $orario ) {
			$descrizione = trim( $orario . "\n" . $descrizione );
		}
		if ( get_post_meta( $id, 'ac_annullato', true ) ) {
			$descrizione = trim( "APPUNTAMENTO ANNULLATO O RINVIATO\n" . $descrizione );
		}

		$righe[] = 'BEGIN:VEVENT';
		$righe[] = 'UID:evento-' . $id . '@' . wp_parse_url( home_url(), PHP_URL_HOST );
		$righe[] = 'DTSTAMP:' . gmdate( 'Ymd\THis\Z', (int) get_post_time( 'U', true, $id ) );
		$righe[] = 'DTSTART;VALUE=DATE:' . gmdate( 'Ymd', strtotime( $inizio ) );
		$righe[] = 'DTEND;VALUE=DATE:' . $fine_ics;
		$righe[] = 'SUMMARY:' . ac_trani_ics_testo( get_the_title( $id ) );
		if ( $descrizione ) {
			$righe[] = 'DESCRIPTION:' . ac_trani_ics_testo( $descrizione );
		}
		$luogo = ac_trani_luogo_leggibile( $id );
		if ( $luogo ) {
			$righe[] = 'LOCATION:' . ac_trani_ics_testo( $luogo );
		}
		$righe[] = 'URL:' . ac_trani_ics_testo( (string) get_permalink( $id ) );
		if ( get_post_meta( $id, 'ac_annullato', true ) ) {
			$righe[] = 'STATUS:CANCELLED';
		}
		$righe[] = 'END:VEVENT';
	}

	$righe[] = 'END:VCALENDAR';

	// RFC 5545: righe terminate da CRLF e ripiegate a 75 ottetti.
	return implode( "\r\n", array_map( 'ac_trani_ics_piega', $righe ) ) . "\r\n";
}

/** Caratteri speciali secondo RFC 5545. */
function ac_trani_ics_testo( string $testo ): string {
	$testo = str_replace( array( "\\", "\r\n", "\n", ',', ';' ), array( '\\\\', '\n', '\n', '\,', '\;' ), $testo );
	return html_entity_decode( $testo, ENT_QUOTES, 'UTF-8' );
}

/** Ripiegatura: dalla seconda riga in poi, uno spazio iniziale. */
function ac_trani_ics_piega( string $riga ): string {
	if ( strlen( $riga ) <= 75 ) {
		return $riga;
	}
	$pezzi = str_split( $riga, 73 );
	return array_shift( $pezzi ) . "\r\n " . implode( "\r\n ", $pezzi );
}

/** Il link al calendario, pronto da mettere in un pulsante del tema. */
function ac_trani_url_calendario(): string {
	return home_url( '/calendario.ics' );
}

/**
 * Senza questo, WordPress «corregge» /calendario.ics in /calendario.ics/ con un
 * 301: un indirizzo che finisce con una barra dopo l'estensione, che alcuni
 * calendari si rifiutano di sottoscrivere.
 */
add_filter(
	'redirect_canonical',
	function ( $destinazione ) {
		return get_query_var( 'ac_ics' ) ? false : $destinazione;
	}
);

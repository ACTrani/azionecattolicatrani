<?php
/**
 * Pezzi di markup condivisi dai blocchi.
 *
 * Qui si decide la STRUTTURA (quali elementi, in che ordine, con quali classi),
 * mai l'aspetto: colori, misure e il taglio a zigzag della data stanno nel
 * `style.css` del tema. Le classi sono elencate in CONTRATTO.md.
 *
 * È il gemello dei componenti `DataRitaglio.astro`, `Icona.astro` e della
 * `.testa-sezione` del prototipo Astro.
 */

defined( 'ABSPATH' ) || exit;

/**
 * I settori in ordine d'età, dai ragazzi agli adulti, poi l'unitario: è
 * l'ordine delle tessere in home e del menu «Settori».
 */
function ac_trani_ordine_settori(): array {
	return array( 'acr', 'msac', 'giovani', 'adulti', 'mlac', 'unitario' );
}

/**
 * L'evento «prossimo»: il primo appuntamento non ancora concluso.
 * È l'unico che il tema colora di lime.
 */
function ac_trani_prossimo_id(): int {
	static $id = null;
	if ( null === $id ) {
		$primo = ac_trani_eventi( array( 'numero' => 1 ) );
		$id    = $primo ? (int) $primo[0]->ID : 0;
	}
	return $id;
}

/**
 * Risolve il valore speciale «corrente» dell'attributo settore: il settore
 * della pagina che si sta guardando (l'archivio di un settore, oppure il
 * settore dell'evento o della notizia aperti). Così lo stesso blocco messo
 * in un template mostra «gli altri appuntamenti di questo settore».
 */
function ac_trani_risolvi_settore( string $settore ): string {
	if ( 'corrente' !== $settore ) {
		return $settore;
	}
	if ( is_tax( 'settore' ) ) {
		$termine = get_queried_object();
		return $termine instanceof WP_Term ? $termine->slug : '';
	}
	if ( is_singular() ) {
		$termine = ac_trani_settore( (int) get_queried_object_id() );
		return $termine ? $termine->slug : '';
	}
	return '';
}

/** Nel titolo di una sezione, «{settore}» diventa il nome del settore risolto. */
function ac_trani_titolo_con_settore( string $titolo, string $slug ): string {
	if ( false === strpos( $titolo, '{settore}' ) ) {
		return $titolo;
	}
	$termine = $slug ? get_term_by( 'slug', $slug, 'settore' ) : null;
	return trim( str_replace( '{settore}', $termine ? $termine->name : '', $titolo ) );
}

/**
 * La testata di una sezione: titolo grande a sinistra, «vedi tutto» a destra.
 */
function ac_trani_testa_sezione( string $titolo, string $link = '', string $testo_link = '' ): string {
	if ( '' === $titolo && '' === $link ) {
		return '';
	}
	$html = '<div class="ac-sezione__testa">';
	if ( '' !== $titolo ) {
		$html .= '<h2 class="ac-sezione__titolo">' . esc_html( $titolo ) . '</h2>';
	}
	if ( '' !== $link ) {
		$html .= sprintf(
			'<a class="ac-link-avanti" href="%s">%s %s</a>',
			esc_url( $link ),
			esc_html( $testo_link ),
			ac_trani_icona( 'freccia', 18 )
		);
	}
	return $html . '</div>';
}

/**
 * Icone a tratto, sullo stile di Lucide (licenza ISC): le stesse del prototipo.
 */
function ac_trani_icona( string $nome, int $dimensione = 20 ): string {
	$tracciati = array(
		'freccia'    => '<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>',
		'giu'        => '<path d="m6 9 6 6 6-6"/>',
		'calendario' => '<rect x="3" y="4.5" width="18" height="16.5" rx="2.5"/><path d="M8 2.5v4M16 2.5v4M3 10h18"/><path d="M12 13.5v5M9.5 16h5"/>',
		'luogo'      => '<path d="M20 10c0 5-5.5 10.2-7.4 11.8a1 1 0 0 1-1.2 0C9.5 20.2 4 15 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>',
		'orario'     => '<circle cx="12" cy="12" r="9.5"/><path d="M12 7v5l3 2"/>',
		'scarica'    => '<path d="M12 3v12"/><path d="m7 10 5 5 5-5"/><path d="M5 21h14"/>',
		'cerca'      => '<circle cx="11" cy="11" r="7"/><path d="m20.5 20.5-4.5-4.5"/>',
		'esterno'    => '<path d="M14 4h6v6"/><path d="M20 4 11 13"/><path d="M18 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h5"/>',
	);
	if ( ! isset( $tracciati[ $nome ] ) ) {
		return '';
	}
	return sprintf(
		'<svg class="ac-icona" width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%2$s</svg>',
		$dimensione,
		$tracciati[ $nome ]
	);
}

/**
 * LA DATA RITAGLIATA — l'elemento firma del sito.
 *
 * Un numero ritagliato a zigzag dal cartoncino del settore. Il tema dà il
 * colore (per `data-settore`) e il taglio; qui si decide solo cosa c'è scritto:
 * in alto il giorno della settimana, al centro il numero, sotto il mese.
 * Se il giorno non è ancora fissato si ritaglia il mese, non un numero
 * inventato; se l'evento dura più giorni nello stesso mese, «16–18».
 *
 * @param array $o misura: piccola|media|grande · prossimo (bool) ·
 *                 dicitura (testo in alto, es. «Il prossimo») · inclinazione (gradi).
 */
function ac_trani_ritaglio( int $post_id, array $o = array() ): string {
	$o = wp_parse_args( $o, array( 'misura' => 'media', 'prossimo' => false, 'dicitura' => '', 'inclinazione' => -1.5 ) );

	$inizio = (string) get_post_meta( $post_id, 'ac_data_inizio', true );
	$d1     = $inizio ? date_create( $inizio ) : null;
	if ( ! $d1 ) {
		return '';
	}
	$fine       = (string) get_post_meta( $post_id, 'ac_data_fine', true );
	$d2         = $fine ? date_create( $fine ) : null;
	$d2         = ( $d2 && $d2 > $d1 ) ? $d2 : null;
	$indicativa = (bool) trim( (string) get_post_meta( $post_id, 'ac_data_indicativa', true ) );

	$mesi      = array( 'gen', 'feb', 'mar', 'apr', 'mag', 'giu', 'lug', 'ago', 'set', 'ott', 'nov', 'dic' );
	$settimana = array( 'dom', 'lun', 'mar', 'mer', 'gio', 'ven', 'sab' );
	$mese      = fn( DateTime $d ): string => $mesi[ (int) $d->format( 'n' ) - 1 ];
	$stesso    = $d2 && $d1->format( 'Y-m' ) === $d2->format( 'Y-m' );

	if ( $indicativa ) {
		$numero = $mese( $d1 );
		$sotto  = 'da fissare';
	} elseif ( $d2 && $stesso ) {
		$numero = $d1->format( 'j' ) . '–' . $d2->format( 'j' );
		$sotto  = $mese( $d1 );
	} elseif ( $d2 ) {
		$numero = $d1->format( 'd' );
		$sotto  = $mese( $d1 ) . ' – ' . $d2->format( 'd' ) . ' ' . $mese( $d2 );
	} else {
		$numero = $d1->format( 'd' );
		$sotto  = $mese( $d1 );
	}
	$sopra = $o['dicitura'] ?: ( ( $indicativa || $d2 ) ? '' : $settimana[ (int) $d1->format( 'w' ) ] );

	$classi = array( 'ac-ritaglio', 'ac-ritaglio--' . sanitize_html_class( $o['misura'] ) );
	if ( $o['prossimo'] ) {
		$classi[] = 'ac-ritaglio--prossimo';
	}
	if ( $indicativa ) {
		$classi[] = 'ac-ritaglio--parola';
	}
	if ( mb_strlen( $numero ) > 3 ) {
		$classi[] = 'ac-ritaglio--lungo';
	}

	return sprintf(
		'<span class="%s" data-settore="%s" style="--ac-inclinazione:%sdeg" aria-hidden="true"><span class="ac-ritaglio__foglio">%s<span class="ac-ritaglio__numero">%s</span><span class="ac-ritaglio__sotto">%s</span></span></span>',
		esc_attr( implode( ' ', $classi ) ),
		esc_attr( ac_trani_settore_slug( $post_id ) ),
		esc_attr( (string) (float) $o['inclinazione'] ),
		$sopra ? '<span class="ac-ritaglio__sopra">' . esc_html( $sopra ) . '</span>' : '',
		esc_html( $numero ),
		esc_html( $sotto )
	);
}

/** «sabato 17 ottobre»: la data per esteso col giorno della settimana, in minuscolo. */
function ac_trani_data_con_giorno( int $post_id ): string {
	$inizio = (string) get_post_meta( $post_id, 'ac_data_inizio', true );
	if ( ! $inizio ) {
		return '';
	}
	$quando = strtotime( $inizio );
	return mb_strtolower( (string) wp_date( 'l', $quando ), 'UTF-8' ) . ' ' . ac_trani_data_italiana( $quando, 'j F' );
}

/**
 * Quando, già pronto: la data indicativa o l'intervallo se ci sono, altrimenti
 * la data col giorno della settimana; poi l'orario.
 */
function ac_trani_quando_completo( int $post_id ): string {
	$semplice = ! get_post_meta( $post_id, 'ac_data_indicativa', true ) && ! get_post_meta( $post_id, 'ac_data_fine', true );
	$quando   = $semplice ? ac_trani_data_con_giorno( $post_id ) : ac_trani_intervallo_leggibile( $post_id );
	$orario   = trim( (string) get_post_meta( $post_id, 'ac_orario', true ) );
	return $quando . ( $orario ? ', ' . $orario : '' );
}

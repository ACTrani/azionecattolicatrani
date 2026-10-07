<?php
/**
 * Blocco «Scheda dell'evento».
 *
 * Si mette nel template dell'evento singolo: prende i dati dall'evento in
 * corso di visualizzazione, così i grafici non devono toccare nessun campo.
 * In cima la data ritagliata, lime se è il prossimo appuntamento.
 *
 * @var array    $attributes
 * @var WP_Block $block
 */

defined( 'ABSPATH' ) || exit;

$id = (int) ( $block->context['postId'] ?? get_the_ID() );
if ( ! $id || 'evento' !== get_post_type( $id ) ) {
	return;
}

$indirizzo  = trim( (string) get_post_meta( $id, 'ac_luogo_indirizzo', true ) );
$comune     = trim( (string) get_post_meta( $id, 'ac_luogo_comune', true ) );
$mappa      = (string) get_post_meta( $id, 'ac_mappa_url', true );
$iscrizione = (string) get_post_meta( $id, 'ac_link_iscrizione', true );
$annullato  = (bool) get_post_meta( $id, 'ac_annullato', true );
$indicativa = (bool) get_post_meta( $id, 'ac_data_indicativa', true );
$passato    = ( get_post_meta( $id, 'ac_data_fine', true ) ?: get_post_meta( $id, 'ac_data_inizio', true ) ) < ac_trani_oggi();
$prossimo   = ! $passato && ac_trani_prossimo_id() === $id;
$luogo      = ac_trani_luogo_leggibile( $id );
$nome_noto  = ! preg_match( '/da definire/i', (string) get_post_meta( $id, 'ac_luogo_nome', true ) );

ob_start();

if ( $annullato ) {
	echo '<p class="ac-avviso ac-avviso--annullato">Questo appuntamento è stato annullato o rinviato.</p>';
} elseif ( $passato ) {
	echo '<p class="ac-avviso">Appuntamento già svolto.</p>';
}

echo ac_trani_ritaglio( // phpcs:ignore WordPress.Security.EscapeOutput
	$id,
	array(
		'misura'       => 'media',
		'prossimo'     => $prossimo,
		'dicitura'     => $prossimo ? 'Il prossimo' : '',
		'inclinazione' => -3,
	)
);

echo '<dl class="ac-scheda__dati">';

printf(
	'<div><dt>%sQuando</dt><dd><time datetime="%s">%s</time></dd></div>',
	ac_trani_icona( 'orario', 18 ), // phpcs:ignore WordPress.Security.EscapeOutput
	esc_attr( (string) get_post_meta( $id, 'ac_data_inizio', true ) ),
	esc_html( ac_trani_quando_completo( $id ) )
);

echo '<div><dt>' . ac_trani_icona( 'luogo', 18 ) . 'Dove</dt><dd>'; // phpcs:ignore WordPress.Security.EscapeOutput
if ( $luogo && $nome_noto ) {
	echo esc_html( $luogo );
	if ( $indirizzo ) {
		echo '<br><span class="ac-scheda__indirizzo">' . esc_html( $indirizzo ) . '</span>';
	}
	if ( ! empty( $attributes['mappa'] ) ) {
		$url = $mappa ?: 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( implode( ', ', array_filter( array( $luogo, $indirizzo ) ) ) );
		printf( '<br><a href="%s" rel="noopener noreferrer" target="_blank">Apri la mappa</a>', esc_url( $url ) );
	}
} else {
	$comune_noto = $comune && ! preg_match( '/da definire/i', $comune );
	echo esc_html( $comune_noto ? $comune . ' — sede da definire' : 'Sede da definire' );
}
echo '</dd></div>';

$settore = ac_trani_settore( $id );
$anni    = get_the_terms( $id, 'anno-associativo' );
if ( $settore ) {
	$esteso = (string) get_term_meta( $settore->term_id, 'ac_nome_esteso', true );
	printf(
		'<div><dt>Per chi</dt><dd><a href="%s">%s</a>%s</dd></div>',
		esc_url( (string) get_term_link( $settore ) ),
		esc_html( $esteso ?: $settore->name ),
		( $anni && ! is_wp_error( $anni ) ) ? ' · anno ' . esc_html( $anni[0]->name ) : ''
	);
}

echo '</dl>';

echo '<div class="ac-scheda__azioni">';
if ( $indicativa && ! $passato ) {
	echo '<p class="ac-scheda__nota">La data non è ancora fissata: l’evento entrerà nel calendario appena sarà decisa.</p>';
} elseif ( ! empty( $attributes['calendario'] ) && ! $passato && ! $annullato ) {
	printf(
		'<a class="ac-bottone" href="%s">%s Aggiungi al calendario</a>',
		esc_url( add_query_arg( 'ac_ics', '1', (string) get_permalink( $id ) ) ),
		ac_trani_icona( 'calendario', 18 ) // phpcs:ignore WordPress.Security.EscapeOutput
	);
}
if ( $iscrizione && ! $annullato && ! $passato ) {
	printf(
		'<a class="ac-bottone ac-bottone--vuoto" href="%s" rel="noopener noreferrer" target="_blank">Iscriviti %s</a>',
		esc_url( $iscrizione ),
		ac_trani_icona( 'esterno', 16 ) // phpcs:ignore WordPress.Security.EscapeOutput
	);
}
echo '</div>';

echo ac_trani_involucro( 'ac-scheda', (string) ob_get_clean(), array( 'data-settore' => ac_trani_settore_slug( $id ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput

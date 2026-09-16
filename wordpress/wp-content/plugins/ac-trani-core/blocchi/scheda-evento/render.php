<?php
/**
 * Blocco «Scheda dell'evento».
 *
 * Si mette nel template dell'evento singolo: prende i dati dall'evento in
 * corso di visualizzazione, così i grafici non devono toccare nessun campo.
 *
 * @var array    $attributes
 * @var WP_Block $block
 */

defined( 'ABSPATH' ) || exit;

$id = (int) ( $block->context['postId'] ?? get_the_ID() );
if ( ! $id || 'evento' !== get_post_type( $id ) ) {
	return;
}

$quando     = ac_trani_intervallo_leggibile( $id );
$orario     = trim( (string) get_post_meta( $id, 'ac_orario', true ) );
$luogo      = trim( (string) get_post_meta( $id, 'ac_luogo_nome', true ) );
$indirizzo  = trim( (string) get_post_meta( $id, 'ac_luogo_indirizzo', true ) );
$comune     = trim( (string) get_post_meta( $id, 'ac_luogo_comune', true ) );
$mappa      = (string) get_post_meta( $id, 'ac_mappa_url', true );
$iscrizione = (string) get_post_meta( $id, 'ac_link_iscrizione', true );
$annullato  = (bool) get_post_meta( $id, 'ac_annullato', true );
$passato    = ( get_post_meta( $id, 'ac_data_fine', true ) ?: get_post_meta( $id, 'ac_data_inizio', true ) ) < ac_trani_oggi();

ob_start();

if ( $annullato ) {
	echo '<p class="ac-avviso ac-avviso--annullato">Questo appuntamento è stato annullato o rinviato.</p>';
} elseif ( $passato ) {
	echo '<p class="ac-avviso">Appuntamento già svolto.</p>';
}

echo '<dl class="ac-scheda__dati">';

if ( $quando ) {
	echo '<dt>Quando</dt><dd>' . esc_html( trim( $quando . ( $orario ? ' · ' . $orario : '' ) ) ) . '</dd>';
}

if ( $luogo || $comune ) {
	echo '<dt>Dove</dt><dd>';
	echo esc_html( ac_trani_luogo_leggibile( $id ) );
	if ( $indirizzo ) {
		echo '<br><span class="ac-scheda__indirizzo">' . esc_html( $indirizzo ) . '</span>';
	}
	if ( $mappa && ! empty( $attributes['mappa'] ) ) {
		printf( '<br><a href="%s" rel="noopener noreferrer" target="_blank">Apri la mappa</a>', esc_url( $mappa ) );
	}
	echo '</dd>';
}

$settore = ac_trani_settore( $id );
if ( $settore ) {
	printf( '<dt>Settore</dt><dd><a href="%s">%s</a></dd>', esc_url( (string) get_term_link( $settore ) ), esc_html( $settore->name ) );
}

$anni = get_the_terms( $id, 'anno-associativo' );
if ( $anni && ! is_wp_error( $anni ) ) {
	printf( '<dt>Anno associativo</dt><dd>%s</dd>', esc_html( $anni[0]->name ) );
}

echo '</dl>';

echo '<p class="ac-scheda__azioni">';
if ( $iscrizione && ! $annullato && ! $passato ) {
	printf( '<a class="ac-bottone" href="%s" rel="noopener noreferrer" target="_blank">Iscriviti</a>', esc_url( $iscrizione ) );
}
if ( ! empty( $attributes['calendario'] ) && ! $passato ) {
	printf(
		'<a class="ac-bottone ac-bottone--tenue" href="%s">Aggiungi al calendario</a>',
		esc_url( add_query_arg( 'ac_ics', '1', (string) get_permalink( $id ) ) )
	);
}
echo '</p>';

echo ac_trani_involucro( 'ac-scheda', (string) ob_get_clean(), array( 'data-settore' => ac_trani_settore_slug( $id ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput

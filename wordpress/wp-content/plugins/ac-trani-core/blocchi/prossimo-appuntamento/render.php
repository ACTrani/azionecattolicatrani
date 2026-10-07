<?php
/**
 * Blocco «Il prossimo appuntamento».
 *
 * La prima cosa che un responsabile parrocchiale cerca aprendo il sito: cosa
 * c'è, quando e dove. La data ritagliata è grande e lime — il lime del logo
 * vuol dire sempre e solo «il prossimo».
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$settore = ac_trani_risolvi_settore( (string) ( $attributes['settore'] ?? '' ) );
$primo   = ac_trani_eventi( array( 'numero' => 1, 'settore' => $settore ) );

if ( ! $primo ) {
	echo ac_trani_involucro( 'ac-prossimo', ac_trani_vuoto( 'Nessun appuntamento in programma al momento.' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
	return;
}

$id      = $primo[0]->ID;
$termine = ac_trani_settore( $id );
$esteso  = $termine ? ( (string) get_term_meta( $termine->term_id, 'ac_nome_esteso', true ) ?: $termine->name ) : '';
$luogo   = ac_trani_luogo_leggibile( $id ) ?: 'Sede da definire';
$titolo  = wp_unique_id( 'ac-prossimo-' );

ob_start();
?>
<div class="ac-prossimo__ritaglio">
	<?php
	echo ac_trani_ritaglio( // phpcs:ignore WordPress.Security.EscapeOutput
		$id,
		array( 'misura' => 'grande', 'prossimo' => true, 'dicitura' => 'Il prossimo', 'inclinazione' => -3 )
	);
	?>
</div>
<div class="ac-prossimo__testo">
	<h2 class="ac-prossimo__titolo" id="<?php echo esc_attr( $titolo ); ?>"><?php echo esc_html( get_the_title( $id ) ); ?></h2>
	<ul class="ac-prossimo__dati">
		<li class="ac-prossimo__quando"><?php echo ac_trani_icona( 'orario' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><time datetime="<?php echo esc_attr( (string) get_post_meta( $id, 'ac_data_inizio', true ) ); ?>"><?php echo esc_html( ac_trani_quando_completo( $id ) ); ?></time></li>
		<li class="ac-prossimo__luogo"><?php echo ac_trani_icona( 'luogo' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $luogo ); ?></li>
		<?php if ( $esteso ) : ?>
			<li class="ac-prossimo__settore"><span class="ac-etichetta ac-etichetta--settore" data-settore="<?php echo esc_attr( $termine->slug ); ?>"><?php echo esc_html( $esteso ); ?></span></li>
		<?php endif; ?>
	</ul>
	<div class="ac-prossimo__azioni">
		<a class="ac-bottone ac-bottone--prossimo" href="<?php echo esc_url( get_permalink( $id ) ); ?>">Dettagli dell'appuntamento <?php echo ac_trani_icona( 'freccia', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
		<?php if ( ! get_post_meta( $id, 'ac_data_indicativa', true ) ) : ?>
			<a class="ac-bottone ac-bottone--filo" href="<?php echo esc_url( add_query_arg( 'ac_ics', '1', (string) get_permalink( $id ) ) ); ?>"><?php echo ac_trani_icona( 'calendario', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> Aggiungi al calendario</a>
		<?php endif; ?>
	</div>
</div>
<?php

echo ac_trani_involucro( 'ac-prossimo', (string) ob_get_clean(), array( 'aria-labelledby' => $titolo ) ); // phpcs:ignore WordPress.Security.EscapeOutput

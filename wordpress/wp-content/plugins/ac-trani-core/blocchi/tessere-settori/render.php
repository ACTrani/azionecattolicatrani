<?php
/**
 * Blocco «Tessere dei settori».
 *
 * Il colore di ogni tessera arriva dal meta `ac_colore` del termine: si cambia
 * dalla schermata dei Settori, senza toccare né tema né codice.
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$termini = get_terms( array( 'taxonomy' => 'settore', 'hide_empty' => false ) );
$ordine  = array_keys( ac_trani_settori() );

if ( is_wp_error( $termini ) || ! $termini ) {
	echo ac_trani_involucro( 'ac-settori', ac_trani_vuoto( 'Nessun settore definito.' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
	return;
}

usort(
	$termini,
	function ( $a, $b ) use ( $ordine ) {
		$ia = array_search( $a->slug, $ordine, true );
		$ib = array_search( $b->slug, $ordine, true );
		return ( false === $ia ? 99 : $ia ) <=> ( false === $ib ? 99 : $ib );
	}
);

$colonne = max( 1, min( 6, (int) ( $attributes['colonne'] ?? 3 ) ) );

ob_start();

if ( ! empty( $attributes['titolo'] ) ) {
	printf( '<h2 class="ac-sezione__titolo">%s</h2>', esc_html( $attributes['titolo'] ) );
}

printf( '<ul class="ac-settori__elenco" style="--ac-colonne:%d">', $colonne );

foreach ( $termini as $termine ) {
	$colore = (string) get_term_meta( $termine->term_id, 'ac_colore', true );
	$esteso = (string) get_term_meta( $termine->term_id, 'ac_nome_esteso', true );
	?>
	<li class="ac-settore" data-settore="<?php echo esc_attr( $termine->slug ); ?>"
		style="--ac-colore-settore:<?php echo esc_attr( $colore ?: '#1f3f6b' ); ?>">
		<a class="ac-settore__collegamento" href="<?php echo esc_url( (string) get_term_link( $termine ) ); ?>">
			<h3 class="ac-settore__nome"><?php echo esc_html( $termine->name ); ?></h3>
			<?php if ( $esteso ) : ?>
				<p class="ac-settore__esteso"><?php echo esc_html( $esteso ); ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $attributes['descrizioni'] ) && $termine->description ) : ?>
				<p class="ac-settore__descrizione"><?php echo esc_html( $termine->description ); ?></p>
			<?php endif; ?>
		</a>
	</li>
	<?php
}

echo '</ul>';

echo ac_trani_involucro( 'ac-settori', (string) ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput

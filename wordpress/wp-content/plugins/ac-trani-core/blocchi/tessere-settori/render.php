<?php
/**
 * Blocco «Tessere dei settori».
 *
 * Il colore di ogni tessera arriva dal meta `ac_colore` del termine: si cambia
 * dalla schermata dei Settori, senza toccare né tema né codice. Il colore del
 * testo sopra invece lo decide il tema per `data-settore` (bianco o notte):
 * se si cambia il cartoncino, va controllato che il testo si legga ancora.
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$termini = get_terms( array( 'taxonomy' => 'settore', 'hide_empty' => false ) );
$ordine  = ac_trani_ordine_settori();

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

echo ac_trani_testa_sezione( (string) ( $attributes['titolo'] ?? '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput

printf( '<ul class="ac-settori__elenco" style="--ac-colonne:%d">', $colonne );

foreach ( $termini as $termine ) {
	$colore = (string) get_term_meta( $termine->term_id, 'ac_colore', true );
	$eta    = (string) get_term_meta( $termine->term_id, 'ac_eta', true );
	?>
	<li class="ac-settore" data-settore="<?php echo esc_attr( $termine->slug ); ?>"
		<?php echo $colore ? 'style="--ac-colore-settore:' . esc_attr( $colore ) . '"' : ''; ?>>
		<a class="ac-settore__collegamento" href="<?php echo esc_url( (string) get_term_link( $termine ) ); ?>">
			<span class="ac-settore__nome"><?php echo esc_html( $termine->name ); ?></span>
			<?php if ( $eta ) : ?>
				<span class="ac-settore__eta"><?php echo esc_html( $eta ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $attributes['descrizioni'] ) && $termine->description ) : ?>
				<span class="ac-settore__descrizione"><?php echo esc_html( $termine->description ); ?></span>
			<?php endif; ?>
			<?php echo ac_trani_icona( 'freccia' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</a>
	</li>
	<?php
}

echo '</ul>';

echo ac_trani_involucro( 'ac-settori', (string) ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput

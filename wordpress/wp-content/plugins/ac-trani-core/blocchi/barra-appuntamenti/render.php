<?php
/**
 * Blocco «Barra dei prossimi appuntamenti».
 *
 * L'elenco è stampato due volte: la seconda copia (nascosta ai lettori di
 * schermo e fuori dal giro del tabulatore) serve solo a far scorrere il nastro
 * senza salti. Movimento, pausa e versione ferma li decide il tema.
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$eventi = ac_trani_eventi( array( 'numero' => max( 1, (int) ( $attributes['numero'] ?? 8 ) ) ) );
if ( ! $eventi ) {
	return;
}

$mesi  = array( 'gen', 'feb', 'mar', 'apr', 'mag', 'giu', 'lug', 'ago', 'set', 'ott', 'nov', 'dic' );
$breve = function ( int $id ) use ( $mesi ): string {
	$indicativa = trim( (string) get_post_meta( $id, 'ac_data_indicativa', true ) );
	if ( $indicativa ) {
		return $indicativa;
	}
	$quando = strtotime( (string) get_post_meta( $id, 'ac_data_inizio', true ) );
	return $quando ? wp_date( 'j', $quando ) . ' ' . $mesi[ (int) wp_date( 'n', $quando ) - 1 ] : '';
};

ob_start();
?>
<a class="ac-barra__titolo" href="<?php echo esc_url( (string) get_post_type_archive_link( 'evento' ) ); ?>">Prossimi appuntamenti</a>
<div class="ac-barra__finestra">
	<div class="ac-barra__nastro">
		<?php foreach ( array( 0, 1 ) as $copia ) : ?>
			<ul class="ac-barra__elenco"<?php echo $copia ? ' aria-hidden="true"' : ''; ?>>
				<?php foreach ( $eventi as $evento ) : ?>
					<li data-settore="<?php echo esc_attr( ac_trani_settore_slug( $evento->ID ) ); ?>">
						<a href="<?php echo esc_url( get_permalink( $evento->ID ) ); ?>"<?php echo $copia ? ' tabindex="-1"' : ''; ?>>
							<span class="ac-barra__data"><?php echo esc_html( $breve( $evento->ID ) ); ?></span>
							<span class="ac-barra__evento"><?php echo esc_html( get_the_title( $evento->ID ) ); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endforeach; ?>
	</div>
</div>
<?php

$attributi = get_block_wrapper_attributes( array( 'class' => 'ac-barra', 'aria-label' => 'Prossimi appuntamenti' ) );
printf( '<aside %s>%s</aside>', $attributi, (string) ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput

<?php
/**
 * Blocco «Elenco eventi».
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$eventi = ac_trani_eventi(
	array(
		'quando'   => $attributes['quando'] ?? 'futuri',
		'numero'   => $attributes['numero'] ?? 4,
		'settore'  => $attributes['settore'] ?? '',
		'anno'     => $attributes['anno'] ?? '',
		'evidenza' => ! empty( $attributes['evidenza'] ),
	)
);

$layout = $attributes['layout'] ?? 'griglia';
$classe = 'ac-eventi ac-eventi--' . sanitize_html_class( $layout );

ob_start();

if ( ! empty( $attributes['titolo'] ) ) {
	printf( '<h2 class="ac-sezione__titolo">%s</h2>', esc_html( $attributes['titolo'] ) );
}

if ( ! $eventi ) {
	echo ac_trani_vuoto( 'passati' === ( $attributes['quando'] ?? '' ) ? 'Nessun evento in archivio.' : 'Nessun appuntamento in programma al momento.' ); // phpcs:ignore WordPress.Security.EscapeOutput
} else {
	echo '<ul class="ac-eventi__elenco">';
	foreach ( $eventi as $evento ) {
		$id         = $evento->ID;
		$annullato  = (bool) get_post_meta( $id, 'ac_annullato', true );
		$settore    = ac_trani_settore( $id );
		$data       = (string) get_post_meta( $id, 'ac_data_inizio', true );
		$orario     = (string) get_post_meta( $id, 'ac_orario', true );
		$luogo      = ac_trani_luogo_leggibile( $id );
		$giorno     = $data ? wp_date( 'j', strtotime( $data ) ) : '';
		$mese       = $data ? wp_date( 'M', strtotime( $data ) ) : '';
		?>
		<li class="ac-evento<?php echo $annullato ? ' ac-evento--annullato' : ''; ?>" data-settore="<?php echo esc_attr( ac_trani_settore_slug( $id ) ); ?>">
			<?php if ( $data ) : ?>
				<time class="ac-evento__data" datetime="<?php echo esc_attr( $data ); ?>">
					<span class="ac-evento__giorno"><?php echo esc_html( $giorno ); ?></span>
					<span class="ac-evento__mese"><?php echo esc_html( $mese ); ?></span>
				</time>
			<?php endif; ?>

			<div class="ac-evento__corpo">
				<?php if ( $settore ) : ?>
					<span class="ac-etichetta ac-etichetta--settore"><?php echo esc_html( $settore->name ); ?></span>
				<?php endif; ?>
				<?php if ( $annullato ) : ?>
					<span class="ac-etichetta ac-etichetta--annullato">Annullato o rinviato</span>
				<?php endif; ?>

				<h3 class="ac-evento__titolo">
					<a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_html( get_the_title( $id ) ); ?></a>
				</h3>

				<p class="ac-evento__quando"><?php echo esc_html( trim( ac_trani_intervallo_leggibile( $id ) . ( $orario ? ' · ' . $orario : '' ) ) ); ?></p>
				<?php if ( $luogo ) : ?>
					<p class="ac-evento__luogo"><?php echo esc_html( $luogo ); ?></p>
				<?php endif; ?>

				<?php $sommario = get_the_excerpt( $id ); ?>
				<?php if ( $sommario && 'elenco' !== $layout ) : ?>
					<p class="ac-evento__sommario"><?php echo esc_html( $sommario ); ?></p>
				<?php endif; ?>
			</div>
		</li>
		<?php
	}
	echo '</ul>';

	if ( ! empty( $attributes['linkArchivio'] ) ) {
		printf(
			'<p class="ac-sezione__coda"><a class="ac-link-avanti" href="%s">%s</a></p>',
			esc_url( (string) get_post_type_archive_link( 'evento' ) ),
			'passati' === ( $attributes['quando'] ?? '' ) ? 'Tutti gli eventi' : 'Tutti gli appuntamenti'
		);
	}
}

echo ac_trani_involucro( $classe, (string) ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput

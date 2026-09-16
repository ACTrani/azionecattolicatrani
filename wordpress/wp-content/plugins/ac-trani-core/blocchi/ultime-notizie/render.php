<?php
/**
 * Blocco «Notizie e comunicati».
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$notizie = ac_trani_notizie(
	array(
		'numero'          => $attributes['numero'] ?? 3,
		'settore'         => $attributes['settore'] ?? '',
		'solo_comunicati' => ! empty( $attributes['soloComunicati'] ),
	)
);

ob_start();

if ( ! empty( $attributes['titolo'] ) ) {
	printf( '<h2 class="ac-sezione__titolo">%s</h2>', esc_html( $attributes['titolo'] ) );
}

if ( ! $notizie ) {
	echo ac_trani_vuoto( 'Non ci sono ancora notizie pubblicate.' ); // phpcs:ignore WordPress.Security.EscapeOutput
} else {
	echo '<ul class="ac-notizie__elenco">';
	foreach ( $notizie as $notizia ) {
		$id         = $notizia->ID;
		$settore    = ac_trani_settore( $id );
		$comunicato = has_term( 'comunicati-ufficiali', 'category', $id );
		?>
		<li class="ac-notizia<?php echo $comunicato ? ' ac-notizia--comunicato' : ''; ?>"
			data-settore="<?php echo esc_attr( ac_trani_settore_slug( $id ) ); ?>">
			<p class="ac-notizia__dati">
				<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d', $id ) ); ?>"><?php echo esc_html( ac_trani_data_italiana( (int) get_post_timestamp( $id ) ) ); ?></time>
				<?php if ( $comunicato ) : ?>
					<span class="ac-etichetta ac-etichetta--comunicato">Comunicato ufficiale</span>
				<?php elseif ( $settore ) : ?>
					<span class="ac-etichetta ac-etichetta--settore"><?php echo esc_html( $settore->name ); ?></span>
				<?php endif; ?>
			</p>
			<h3 class="ac-notizia__titolo">
				<a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_html( get_the_title( $id ) ); ?></a>
			</h3>
			<?php if ( get_the_excerpt( $id ) ) : ?>
				<p class="ac-notizia__sommario"><?php echo esc_html( get_the_excerpt( $id ) ); ?></p>
			<?php endif; ?>
		</li>
		<?php
	}
	echo '</ul>';

	if ( ! empty( $attributes['linkArchivio'] ) ) {
		$pagina = get_option( 'page_for_posts' );
		if ( $pagina ) {
			printf(
				'<p class="ac-sezione__coda"><a class="ac-link-avanti" href="%s">Tutte le notizie</a></p>',
				esc_url( (string) get_permalink( (int) $pagina ) )
			);
		}
	}
}

echo ac_trani_involucro( 'ac-notizie', (string) ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput

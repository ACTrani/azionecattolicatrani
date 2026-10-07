<?php
/**
 * Blocco «Notizie e comunicati».
 *
 * Ogni notizia è un piccolo cartellone: il titolo scritto grande sul
 * cartoncino del settore, sotto il sommario e la data. Funziona senza foto;
 * è il gemello di `CartaNotizia.astro`. Con «prima grande» la prima notizia
 * occupa due colonne.
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$settore = ac_trani_risolvi_settore( (string) ( $attributes['settore'] ?? '' ) );

$notizie = ( 'corrente' === ( $attributes['settore'] ?? '' ) && ! $settore ) ? array() : ac_trani_notizie(
	array(
		'numero'          => $attributes['numero'] ?? 3,
		'settore'         => $settore,
		'solo_comunicati' => ! empty( $attributes['soloComunicati'] ),
		'escludi'         => is_singular( 'post' ) ? array( get_queried_object_id() ) : array(),
	)
);

$classe = 'ac-notizie' . ( ! empty( $attributes['primaGrande'] ) ? ' ac-notizie--prima-grande' : '' );
$pagina = (int) get_option( 'page_for_posts' );
$link   = ! empty( $attributes['linkArchivio'] ) && $notizie && $pagina ? (string) get_permalink( $pagina ) : '';

ob_start();

echo ac_trani_testa_sezione( ac_trani_titolo_con_settore( (string) ( $attributes['titolo'] ?? '' ), $settore ), $link, 'Tutte le notizie' ); // phpcs:ignore WordPress.Security.EscapeOutput

if ( ! $notizie ) {
	echo ac_trani_vuoto( 'Non ci sono ancora notizie pubblicate.' ); // phpcs:ignore WordPress.Security.EscapeOutput
} else {
	echo '<ul class="ac-notizie__elenco">';
	foreach ( $notizie as $notizia ) {
		$id         = $notizia->ID;
		$termine    = ac_trani_settore( $id );
		$comunicato = has_term( 'comunicati-ufficiali', 'category', $id );
		?>
		<li class="ac-notizia<?php echo $comunicato ? ' ac-notizia--comunicato' : ''; ?>"
			data-settore="<?php echo esc_attr( ac_trani_settore_slug( $id ) ); ?>">
			<div class="ac-notizia__cartellone">
				<h3 class="ac-notizia__titolo">
					<a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_html( get_the_title( $id ) ); ?></a>
				</h3>
			</div>
			<div class="ac-notizia__corpo">
				<p class="ac-notizia__dati">
					<?php if ( $termine ) : ?>
						<span class="ac-etichetta ac-etichetta--settore"><?php echo esc_html( $termine->name ); ?></span>
					<?php endif; ?>
					<?php if ( $comunicato ) : ?>
						<span class="ac-etichetta ac-etichetta--comunicato">Comunicato</span>
					<?php endif; ?>
				</p>
				<?php if ( get_the_excerpt( $id ) ) : ?>
					<p class="ac-notizia__sommario"><?php echo esc_html( get_the_excerpt( $id ) ); ?></p>
				<?php endif; ?>
				<p class="ac-notizia__data">
					<time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d', $id ) ); ?>"><?php echo esc_html( ac_trani_data_italiana( (int) get_post_timestamp( $id ) ) ); ?></time>
				</p>
			</div>
		</li>
		<?php
	}
	echo '</ul>';
}

echo ac_trani_involucro( $classe, (string) ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput

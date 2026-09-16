<?php
/**
 * Blocco «Elenco documenti».
 *
 * Con i filtri attivi la selezione avviene nel browser sulle righe già
 * presenti: nessuna ricarica, nessuna chiamata al server. Va bene finché i
 * documenti sono qualche decina; oltre, conviene passare a una query lato
 * server con paginazione.
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$documenti = ac_trani_documenti(
	array(
		'numero'  => $attributes['numero'] ?? 10,
		'settore' => $attributes['settore'] ?? '',
		'anno'    => $attributes['anno'] ?? '',
		'tipo'    => $attributes['tipo'] ?? '',
	)
);

ob_start();

if ( ! empty( $attributes['titolo'] ) ) {
	printf( '<h2 class="ac-sezione__titolo">%s</h2>', esc_html( $attributes['titolo'] ) );
}

if ( ! $documenti ) {
	echo ac_trani_vuoto( 'Nessun documento disponibile.' ); // phpcs:ignore WordPress.Security.EscapeOutput
} else {
	if ( ! empty( $attributes['filtri'] ) ) {
		?>
		<form class="ac-filtri" role="search" data-ac-filtri>
			<p class="ac-filtri__campo">
				<label for="ac-cerca-doc">Cerca</label>
				<input type="search" id="ac-cerca-doc" data-ac-cerca placeholder="Titolo o descrizione…">
			</p>
			<p class="ac-filtri__campo">
				<label for="ac-settore-doc">Settore</label>
				<select id="ac-settore-doc" data-ac-filtro="settore">
					<?php foreach ( ac_trani_opzioni_termini( 'settore' ) as $o ) : ?>
						<option value="<?php echo esc_attr( $o['value'] ); ?>"><?php echo esc_html( $o['label'] ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p class="ac-filtri__campo">
				<label for="ac-tipo-doc">Tipo</label>
				<select id="ac-tipo-doc" data-ac-filtro="tipo">
					<?php foreach ( ac_trani_opzioni_termini( 'tipo-documento' ) as $o ) : ?>
						<option value="<?php echo esc_attr( $o['value'] ); ?>"><?php echo esc_html( $o['label'] ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p class="ac-filtri__esito" data-ac-esito aria-live="polite"></p>
		</form>
		<?php
	}

	echo '<ul class="ac-documenti__elenco">';
	foreach ( $documenti as $documento ) {
		$id      = $documento->ID;
		$url     = ac_trani_file_url( $id );
		$tipi    = get_the_terms( $id, 'tipo-documento' );
		$tipo    = ( $tipi && ! is_wp_error( $tipi ) ) ? $tipi[0] : null;
		$settore = ac_trani_settore( $id );
		?>
		<li class="ac-documento"
			data-settore="<?php echo esc_attr( $settore ? $settore->slug : '' ); ?>"
			data-tipo="<?php echo esc_attr( $tipo ? $tipo->slug : '' ); ?>"
			data-testo="<?php echo esc_attr( mb_strtolower( get_the_title( $id ) . ' ' . get_the_excerpt( $id ) ) ); ?>">
			<div class="ac-documento__corpo">
				<h3 class="ac-documento__titolo"><?php echo esc_html( get_the_title( $id ) ); ?></h3>
				<?php if ( get_the_excerpt( $id ) ) : ?>
					<p class="ac-documento__descrizione"><?php echo esc_html( get_the_excerpt( $id ) ); ?></p>
				<?php endif; ?>
				<p class="ac-documento__dati">
					<?php if ( $tipo ) : ?><span class="ac-etichetta"><?php echo esc_html( $tipo->name ); ?></span><?php endif; ?>
					<?php if ( $settore ) : ?><span class="ac-etichetta ac-etichetta--settore" data-settore="<?php echo esc_attr( $settore->slug ); ?>"><?php echo esc_html( $settore->name ); ?></span><?php endif; ?>
					<span class="ac-documento__file"><?php echo esc_html( ac_trani_file_etichetta( $id ) ); ?></span>
				</p>
			</div>
			<?php if ( $url ) : ?>
				<a class="ac-documento__scarica" href="<?php echo esc_url( $url ); ?>" download>
					Scarica<span class="ac-solo-lettori-schermo"> <?php echo esc_html( get_the_title( $id ) ); ?></span>
				</a>
			<?php endif; ?>
		</li>
		<?php
	}
	echo '</ul>';
}

echo ac_trani_involucro( 'ac-documenti', (string) ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput

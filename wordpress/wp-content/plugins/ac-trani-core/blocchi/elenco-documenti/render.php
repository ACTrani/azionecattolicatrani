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

$settore   = ac_trani_risolvi_settore( (string) ( $attributes['settore'] ?? '' ) );
$documenti = ( 'corrente' === ( $attributes['settore'] ?? '' ) && ! $settore ) ? array() : ac_trani_documenti(
	array(
		'numero'  => $attributes['numero'] ?? 10,
		'settore' => $settore,
		'anno'    => $attributes['anno'] ?? '',
		'tipo'    => $attributes['tipo'] ?? '',
	)
);
$compatta = ! empty( $attributes['compatta'] );
$link     = ! empty( $attributes['linkArchivio'] ) && $documenti ? (string) get_post_type_archive_link( 'documento' ) : '';

ob_start();

echo ac_trani_testa_sezione( ac_trani_titolo_con_settore( (string) ( $attributes['titolo'] ?? '' ), $settore ), $link, 'Archivio completo' ); // phpcs:ignore WordPress.Security.EscapeOutput

if ( ! $documenti ) {
	echo ac_trani_vuoto( 'Nessun documento disponibile.' ); // phpcs:ignore WordPress.Security.EscapeOutput
} else {
	if ( ! empty( $attributes['filtri'] ) ) {
		?>
		<form class="ac-filtri" role="search" data-ac-filtri>
			<p class="ac-filtri__campo ac-filtri__campo--cerca">
				<label for="ac-cerca-doc">Cerca</label>
				<?php echo ac_trani_icona( 'cerca' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
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
		$anni    = get_the_terms( $id, 'anno-associativo' );
		$anno    = ( $anni && ! is_wp_error( $anni ) ) ? $anni[0] : null;
		$termine = ac_trani_settore( $id );
		$formato = strtoupper( (string) get_post_meta( $id, 'ac_formato', true ) );
		if ( ! $formato && (int) get_post_meta( $id, 'ac_file_id', true ) ) {
			$formato = strtoupper( (string) pathinfo( (string) get_attached_file( (int) get_post_meta( $id, 'ac_file_id', true ) ), PATHINFO_EXTENSION ) );
		}
		$peso = (string) get_post_meta( $id, 'ac_dimensione', true );
		$data = (string) get_post_meta( $id, 'ac_data', true );
		?>
		<li class="ac-documento<?php echo $compatta ? ' ac-documento--compatta' : ''; ?>"
			data-settore="<?php echo esc_attr( ac_trani_settore_slug( $id ) ); ?>"
			data-tipo="<?php echo esc_attr( $tipo ? $tipo->slug : '' ); ?>"
			data-testo="<?php echo esc_attr( mb_strtolower( get_the_title( $id ) . ' ' . get_the_excerpt( $id ) ) ); ?>">
			<span class="ac-documento__formato" aria-hidden="true"><?php echo esc_html( $formato ?: 'DOC' ); ?></span>
			<div class="ac-documento__corpo">
				<h3 class="ac-documento__titolo"><a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_html( get_the_title( $id ) ); ?></a></h3>
				<?php if ( ! $compatta && get_the_excerpt( $id ) ) : ?>
					<p class="ac-documento__descrizione"><?php echo esc_html( get_the_excerpt( $id ) ); ?></p>
				<?php endif; ?>
				<p class="ac-documento__dati">
					<?php if ( $termine ) : ?><span class="ac-etichetta ac-etichetta--settore"><?php echo esc_html( $termine->name ); ?></span><?php endif; ?>
					<?php if ( $tipo ) : ?><span><?php echo esc_html( $tipo->name ); ?></span><?php endif; ?>
					<?php if ( $anno ) : ?><span class="ac-cifre"><?php echo esc_html( $anno->name ); ?></span><?php endif; ?>
					<?php if ( ! $compatta && $data ) : ?><span>Pubblicato il <?php echo esc_html( ac_trani_data_italiana( (int) strtotime( $data ) ) ); ?></span><?php endif; ?>
				</p>
			</div>
			<?php if ( $url ) : ?>
				<a class="ac-documento__scarica" href="<?php echo esc_url( $url ); ?>" download>
					<?php echo ac_trani_icona( 'scarica', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<span>Scarica<?php if ( $peso ) : ?><span class="ac-documento__peso"> · <?php echo esc_html( $peso ); ?></span><?php endif; ?></span>
					<span class="ac-solo-lettori-schermo"> <?php echo esc_html( get_the_title( $id ) ); ?></span>
				</a>
			<?php else : ?>
				<span class="ac-documento__mancante">File in arrivo</span>
			<?php endif; ?>
		</li>
		<?php
	}
	echo '</ul>';
}

echo ac_trani_involucro( 'ac-documenti', (string) ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput

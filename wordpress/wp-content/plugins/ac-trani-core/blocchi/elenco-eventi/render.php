<?php
/**
 * Blocco «Elenco eventi».
 *
 * Ogni evento è una riga di calendario: la data ritagliata a sinistra, il
 * titolo e il settore al centro, quando e dove allineati a destra. È il
 * gemello di `RigaEvento.astro`.
 *
 * Disposizioni: «righe» (data media, con sommario) e «compatto» (data
 * piccola). I vecchi valori «griglia» ed «elenco» valgono come i nuovi.
 *
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$quando  = $attributes['quando'] ?? 'futuri';
$settore = ac_trani_risolvi_settore( (string) ( $attributes['settore'] ?? '' ) );

// «Gli altri appuntamenti di questo settore» non deve ripetere l'evento aperto.
$escludi = ( 'corrente' === ( $attributes['settore'] ?? '' ) && is_singular( 'evento' ) ) ? array( get_queried_object_id() ) : array();

$eventi = ( 'corrente' === ( $attributes['settore'] ?? '' ) && ! $settore ) ? array() : ac_trani_eventi(
	array(
		'quando'   => $quando,
		'numero'   => $attributes['numero'] ?? 4,
		'salta'    => $attributes['salta'] ?? 0,
		'settore'  => $settore,
		'anno'     => $attributes['anno'] ?? '',
		'evidenza' => ! empty( $attributes['evidenza'] ),
		'escludi'  => $escludi,
	)
);

$layout   = in_array( $attributes['layout'] ?? 'righe', array( 'compatto', 'elenco' ), true ) ? 'compatto' : 'righe';
$misura   = 'compatto' === $layout ? 'piccola' : 'media';
$sommario = 'righe' === $layout && ! empty( $attributes['sommario'] );
$per_mese = ! empty( $attributes['perMese'] );
$filtri   = ! empty( $attributes['filtri'] ) && $eventi;
$passati  = 'passati' === $quando;
$prossimo = ac_trani_prossimo_id();
$titolo   = ac_trani_titolo_con_settore( (string) ( $attributes['titolo'] ?? '' ), $settore );

$classe = 'ac-eventi ac-eventi--' . $layout . ( $passati ? ' ac-eventi--passati' : '' );

/** Una riga di calendario. */
$riga = function ( WP_Post $evento, int $i ) use ( $misura, $sommario, $passati, $prossimo ): string {
	$id        = $evento->ID;
	$annullato = (bool) get_post_meta( $id, 'ac_annullato', true );
	$settore   = ac_trani_settore( $id );
	$luogo     = ac_trani_luogo_leggibile( $id ) ?: 'Sede da definire';
	$testo     = get_the_excerpt( $id );
	$cerca     = mb_strtolower( get_the_title( $id ) . ' ' . $testo . ' ' . $luogo, 'UTF-8' );

	ob_start();
	?>
	<li class="ac-evento ac-evento--<?php echo esc_attr( $misura ); ?><?php echo $annullato ? ' ac-evento--annullato' : ''; ?>"
		data-settore="<?php echo esc_attr( ac_trani_settore_slug( $id ) ); ?>"
		data-filtro-testo="<?php echo esc_attr( $cerca ); ?>">
		<?php
		echo ac_trani_ritaglio( // phpcs:ignore WordPress.Security.EscapeOutput
			$id,
			array(
				'misura'       => $misura,
				'prossimo'     => ! $passati && $id === $prossimo,
				'inclinazione' => $passati ? 0 : ( $i % 2 ? 1.5 : -1.5 ),
			)
		);
		?>
		<div class="ac-evento__corpo">
			<h3 class="ac-evento__titolo">
				<a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_html( get_the_title( $id ) ); ?></a>
			</h3>
			<?php if ( $sommario && $testo ) : ?>
				<p class="ac-evento__sommario"><?php echo esc_html( $testo ); ?></p>
			<?php endif; ?>
			<p class="ac-evento__settore">
				<?php if ( $settore ) : ?>
					<span class="ac-etichetta ac-etichetta--settore"><?php echo esc_html( $settore->name ); ?></span>
				<?php endif; ?>
				<?php if ( $annullato ) : ?>
					<span class="ac-etichetta ac-etichetta--annullato">Annullato</span>
				<?php endif; ?>
			</p>
		</div>
		<dl class="ac-evento__meta">
			<dt class="ac-solo-lettori-schermo">Quando</dt>
			<dd class="ac-evento__quando">
				<?php echo ac_trani_icona( 'orario', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<time datetime="<?php echo esc_attr( (string) get_post_meta( $id, 'ac_data_inizio', true ) ); ?>"><?php echo esc_html( ac_trani_quando_completo( $id ) ); ?></time>
			</dd>
			<?php if ( $luogo ) : ?>
				<dt class="ac-solo-lettori-schermo">Dove</dt>
				<dd class="ac-evento__luogo"><?php echo ac_trani_icona( 'luogo', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( $luogo ); ?></dd>
			<?php endif; ?>
		</dl>
	</li>
	<?php
	return (string) ob_get_clean();
};

ob_start();

$link = ! empty( $attributes['linkArchivio'] ) && $eventi ? (string) get_post_type_archive_link( 'evento' ) : '';
echo ac_trani_testa_sezione( $titolo, $link, $passati ? 'Tutti gli eventi' : 'Tutti gli appuntamenti' ); // phpcs:ignore WordPress.Security.EscapeOutput

if ( ! $eventi ) {
	echo ac_trani_vuoto( $passati ? 'Nessun evento in archivio.' : 'Nessun appuntamento in programma al momento.' ); // phpcs:ignore WordPress.Security.EscapeOutput
} else {
	if ( $filtri ) {
		$campo = wp_unique_id( 'ac-cerca-eventi-' );
		?>
		<div class="ac-strumenti" data-ac-filtri-eventi>
			<div class="ac-ricerca">
				<label class="ac-solo-lettori-schermo" for="<?php echo esc_attr( $campo ); ?>">Cerca negli eventi</label>
				<?php echo ac_trani_icona( 'cerca' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<input type="search" id="<?php echo esc_attr( $campo ); ?>" data-ac-cerca placeholder="Cerca: ritiro, Barletta, campo…" autocomplete="off">
			</div>
			<div class="ac-filtri-settore" role="group" aria-label="Filtra per settore">
				<button class="ac-filtro" type="button" data-filtro="tutti" aria-pressed="true">Tutti</button>
				<?php
				foreach ( ac_trani_ordine_settori() as $slug ) {
					$t = get_term_by( 'slug', $slug, 'settore' );
					if ( $t ) {
						printf( '<button class="ac-filtro" type="button" data-filtro="%1$s" data-settore="%1$s" aria-pressed="false">%2$s</button>', esc_attr( $slug ), esc_html( $t->name ) );
					}
				}
				?>
			</div>
		</div>
		<p class="ac-conteggio" aria-live="polite" data-ac-conteggio><?php echo esc_html( count( $eventi ) . ' appuntamenti in programma' ); ?></p>
		<?php
	}

	if ( $per_mese ) {
		$gruppi = array();
		foreach ( $eventi as $evento ) {
			$data = (string) get_post_meta( $evento->ID, 'ac_data_inizio', true );
			$mese = $data ? (string) wp_date( 'F Y', strtotime( $data ) ) : 'Senza data';
			$gruppi[ mb_convert_case( mb_substr( $mese, 0, 1 ), MB_CASE_UPPER, 'UTF-8' ) . mb_substr( $mese, 1 ) ][] = $evento;
		}
		$livello = $titolo ? 'h3' : 'h2';
		foreach ( $gruppi as $mese => $voci ) {
			printf( '<section class="ac-mese" aria-label="%s"><%s class="ac-mese__nome">%s</%s><ul class="ac-eventi__elenco">', esc_attr( $mese ), $livello, esc_html( $mese ), $livello ); // phpcs:ignore WordPress.Security.EscapeOutput
			foreach ( $voci as $i => $evento ) {
				echo $riga( $evento, $i ); // phpcs:ignore WordPress.Security.EscapeOutput
			}
			echo '</ul></section>';
		}
	} else {
		echo '<ul class="ac-eventi__elenco">';
		foreach ( $eventi as $i => $evento ) {
			echo $riga( $evento, $i ); // phpcs:ignore WordPress.Security.EscapeOutput
		}
		echo '</ul>';
	}

	if ( $filtri ) {
		?>
		<div class="ac-nessun-risultato" data-ac-nessuno hidden>
			<p><strong>Nessun appuntamento corrisponde alla ricerca.</strong> Prova un'altra parola o scegli «Tutti».</p>
			<button class="ac-bottone ac-bottone--vuoto" type="button" data-ac-azzera>Mostra tutti gli eventi</button>
		</div>
		<?php
	}
}

echo ac_trani_involucro( $classe, (string) ob_get_clean() ); // phpcs:ignore WordPress.Security.EscapeOutput

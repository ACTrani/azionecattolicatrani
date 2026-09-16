<?php
/**
 * Campi degli eventi e dei documenti.
 *
 * Perché non Secure Custom Fields (il fork di ACF)? Perché qui servono solo
 * campi semplici, e registrarli in codice ha tre vantaggi che contano per
 * questo progetto: il modello dati resta su Git invece che nel database,
 * il sito non dipende da un plugin in più da aggiornare, e i campi escono
 * già nella REST API — cioè sono leggibili da un frontend Astro.
 * Se un giorno servisse un'interfaccia più ricca (ripetitori, gallerie),
 * SCF si può aggiungere sopra: le chiave dei meta non cambiano.
 */

defined( 'ABSPATH' ) || exit;

/**
 * I campi dell'evento. La chiave è il nome del meta, così come esce dalla REST.
 * `tipo` guida sia la validazione sia il campo mostrato in bacheca.
 */
function ac_trani_campi_evento(): array {
	return array(
		'ac_data_inizio'     => array( 'tipo' => 'date',    'etichetta' => 'Data di inizio',      'aiuto' => 'Obbligatoria: è il campo su cui il sito ordina gli eventi.' ),
		'ac_data_fine'       => array( 'tipo' => 'date',    'etichetta' => 'Data di fine',        'aiuto' => 'Solo per gli appuntamenti di più giorni.' ),
		'ac_orario'          => array( 'tipo' => 'text',    'etichetta' => 'Orario',              'aiuto' => 'Testo libero, es. «ore 18:30» oppure «18:30 – 20:30».' ),
		'ac_luogo_nome'      => array( 'tipo' => 'text',    'etichetta' => 'Luogo' ),
		'ac_luogo_indirizzo' => array( 'tipo' => 'text',    'etichetta' => 'Indirizzo' ),
		'ac_luogo_comune'    => array( 'tipo' => 'text',    'etichetta' => 'Comune' ),
		'ac_mappa_url'       => array( 'tipo' => 'url',     'etichetta' => 'Link alla mappa' ),
		'ac_link_iscrizione' => array( 'tipo' => 'url',     'etichetta' => 'Link per iscriversi' ),
		'ac_annullato'       => array( 'tipo' => 'boolean', 'etichetta' => 'Annullato o rinviato' ),
		'ac_in_evidenza'     => array( 'tipo' => 'boolean', 'etichetta' => 'In evidenza in home page' ),
	);
}

/** I campi del documento. */
function ac_trani_campi_documento(): array {
	return array(
		'ac_data'       => array( 'tipo' => 'date',    'etichetta' => 'Data del documento' ),
		'ac_file_id'    => array( 'tipo' => 'integer', 'etichetta' => 'File nella Libreria media', 'aiuto' => 'ID dell’allegato. Si sceglie col pulsante qui sotto.' ),
		'ac_file_url'   => array( 'tipo' => 'url',     'etichetta' => 'Oppure link esterno',       'aiuto' => 'Usato solo se il file non sta nella Libreria media.' ),
		'ac_formato'    => array( 'tipo' => 'text',    'etichetta' => 'Formato',                    'aiuto' => 'PDF, DOC, XLS, ZIP. Se vuoto viene dedotto dal file.' ),
		'ac_dimensione' => array( 'tipo' => 'text',    'etichetta' => 'Dimensione',                 'aiuto' => 'Se vuota viene calcolata dal file.' ),
		'ac_download'   => array( 'tipo' => 'integer', 'etichetta' => 'Download', 'sola_lettura' => true ),
	);
}

add_action( 'init', 'ac_trani_registra_campi' );

function ac_trani_registra_campi(): void {
	$mappa = array(
		'evento'    => ac_trani_campi_evento(),
		'documento' => ac_trani_campi_documento(),
	);

	foreach ( $mappa as $tipo => $campi ) {
		foreach ( $campi as $chiave => $campo ) {
			register_post_meta(
				$tipo,
				$chiave,
				array(
					'type'          => in_array( $campo['tipo'], array( 'boolean', 'integer' ), true ) ? $campo['tipo'] : 'string',
					'single'        => true,
					'show_in_rest'  => true,
					'description'   => $campo['etichetta'],
					'default'       => 'boolean' === $campo['tipo'] ? false : ( 'integer' === $campo['tipo'] ? 0 : '' ),
					'auth_callback' => fn() => current_user_can( 'edit_posts' ),
				)
			);
		}
	}
}

/* ------------------------------------------------------------------ *
 * Riquadri in bacheca
 * ------------------------------------------------------------------ */

add_action(
	'add_meta_boxes',
	function () {
		add_meta_box( 'ac-evento', 'Quando e dove', 'ac_trani_riquadro_evento', 'evento', 'normal', 'high' );
		add_meta_box( 'ac-documento', 'Il file', 'ac_trani_riquadro_documento', 'documento', 'normal', 'high' );
	}
);

function ac_trani_riquadro_evento( WP_Post $post ): void {
	ac_trani_disegna_riquadro( $post, ac_trani_campi_evento() );
}

function ac_trani_riquadro_documento( WP_Post $post ): void {
	ac_trani_disegna_riquadro( $post, ac_trani_campi_documento() );
}

function ac_trani_disegna_riquadro( WP_Post $post, array $campi ): void {
	wp_nonce_field( 'ac_trani_salva_campi', 'ac_trani_nonce' );
	echo '<table class="form-table ac-campi" role="presentation"><tbody>';

	foreach ( $campi as $chiave => $campo ) {
		$valore = get_post_meta( $post->ID, $chiave, true );
		$id     = esc_attr( $chiave );
		echo '<tr><th scope="row"><label for="' . $id . '">' . esc_html( $campo['etichetta'] ) . '</label></th><td>';

		if ( ! empty( $campo['sola_lettura'] ) ) {
			echo '<code>' . esc_html( (string) (int) $valore ) . '</code>';
		} elseif ( 'boolean' === $campo['tipo'] ) {
			printf(
				'<label><input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s> sì</label>',
				$id,
				checked( (bool) $valore, true, false )
			);
		} else {
			$html_type = match ( $campo['tipo'] ) {
				'date'    => 'date',
				'url'     => 'url',
				'integer' => 'number',
				default   => 'text',
			};
			printf(
				'<input type="%1$s" id="%2$s" name="%2$s" value="%3$s" class="regular-text">',
				esc_attr( $html_type ),
				$id,
				esc_attr( (string) $valore )
			);
			if ( 'ac_file_id' === $chiave ) {
				echo ' <button type="button" class="button ac-scegli-file">Scegli dalla Libreria media</button>';
				echo ' <span class="ac-file-nome">' . esc_html( $valore ? (string) get_the_title( (int) $valore ) : '' ) . '</span>';
			}
		}

		if ( ! empty( $campo['aiuto'] ) ) {
			echo '<p class="description">' . esc_html( $campo['aiuto'] ) . '</p>';
		}
		echo '</td></tr>';
	}

	echo '</tbody></table>';
}

add_action( 'save_post_evento', 'ac_trani_salva_campi', 10, 2 );
add_action( 'save_post_documento', 'ac_trani_salva_campi', 10, 2 );

function ac_trani_salva_campi( int $post_id, WP_Post $post ): void {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! isset( $_POST['ac_trani_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['ac_trani_nonce'] ) ), 'ac_trani_salva_campi' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$campi = 'evento' === $post->post_type ? ac_trani_campi_evento() : ac_trani_campi_documento();

	foreach ( $campi as $chiave => $campo ) {
		if ( ! empty( $campo['sola_lettura'] ) ) {
			continue;
		}
		if ( 'boolean' === $campo['tipo'] ) {
			update_post_meta( $post_id, $chiave, isset( $_POST[ $chiave ] ) );
			continue;
		}
		$grezzo = isset( $_POST[ $chiave ] ) ? wp_unslash( $_POST[ $chiave ] ) : '';
		$pulito = match ( $campo['tipo'] ) {
			'url'     => esc_url_raw( $grezzo ),
			'integer' => (int) $grezzo,
			'date'    => preg_match( '/^\d{4}-\d{2}-\d{2}$/', (string) $grezzo ) ? $grezzo : '',
			default   => sanitize_text_field( $grezzo ),
		};
		update_post_meta( $post_id, $chiave, $pulito );
	}
}

/** Il selettore di file usa la Libreria media: va caricata sulle schermate documento. */
add_action(
	'admin_enqueue_scripts',
	function ( $schermata ) {
		$corrente = get_current_screen();
		if ( ! $corrente || 'documento' !== $corrente->post_type ) {
			return;
		}
		wp_enqueue_media();
		wp_add_inline_script(
			'media-editor',
			<<<'JS'
			document.addEventListener('click', function (e) {
				var bottone = e.target.closest('.ac-scegli-file');
				if (!bottone) return;
				e.preventDefault();
				var cornice = wp.media({ title: 'Scegli il documento', button: { text: 'Usa questo file' }, multiple: false });
				cornice.on('select', function () {
					var file = cornice.state().get('selection').first().toJSON();
					document.getElementById('ac_file_id').value = file.id;
					var nome = bottone.parentNode.querySelector('.ac-file-nome');
					if (nome) nome.textContent = file.filename || file.title;
					var formato = document.getElementById('ac_formato');
					if (formato && !formato.value && file.subtype) formato.value = file.subtype.toUpperCase();
				});
				cornice.open();
			});
			JS
		);
	}
);

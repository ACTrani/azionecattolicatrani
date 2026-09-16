<?php
/**
 * Tipi di contenuto e tassonomie.
 *
 * È la traduzione in WordPress di `poc-astro/src/content.config.ts`: stessi
 * contenuti, stessi nomi di campo. Chi lavora sul prototipo Astro e chi lavora
 * qui stanno descrivendo le stesse cose.
 */

defined( 'ABSPATH' ) || exit;

/** I sei settori, nell'ordine in cui vanno mostrati. Colore incluso: lo legge il tema. */
function ac_trani_settori(): array {
	return array(
		'unitario' => array(
			'nome'        => 'Unitario',
			'esteso'      => 'Vita associativa unitaria',
			'colore'      => '#1f3f6b',
			'descrizione' => 'Gli appuntamenti che riuniscono l’intera associazione diocesana: assemblee, campi unitari, esercizi spirituali, formazione dei responsabili.',
		),
		'adulti' => array(
			'nome'        => 'Adulti',
			'esteso'      => 'Settore Adulti',
			'colore'      => '#2c6e63',
			'descrizione' => 'Adulti e famiglie che vivono la corresponsabilità nella parrocchia e l’impegno nella città: formazione permanente, coppie, terza età.',
		),
		'giovani' => array(
			'nome'        => 'Giovani',
			'esteso'      => 'Settore Giovani',
			'colore'      => '#b5651d',
			'descrizione' => 'Giovanissimi e giovani in cammino: ritiri, scuola di formazione, servizio, campi estivi e discernimento vocazionale.',
		),
		'acr' => array(
			'nome'        => 'ACR',
			'esteso'      => 'Azione Cattolica dei Ragazzi',
			'colore'      => '#c0392b',
			'descrizione' => 'I ragazzi come protagonisti, non destinatari: Mese del Ciao, Mese della Pace, Festa degli Incontri, campi scuola.',
		),
		'msac' => array(
			'nome'        => 'MSAC',
			'esteso'      => 'Movimento Studenti di Azione Cattolica',
			'colore'      => '#5b4b8a',
			'descrizione' => 'Studenti che si prendono cura della scuola: rappresentanza, cittadinanza attiva, formazione politica.',
		),
		'mlac' => array(
			'nome'        => 'MLAC',
			'esteso'      => 'Movimento Lavoratori di Azione Cattolica',
			'colore'      => '#6b7a3a',
			'descrizione' => 'Il lavoro come luogo di vocazione e di giustizia: Progetto Policoro, dottrina sociale, precarietà e dignità.',
		),
	);
}

/** I tipi di documento previsti dall'archivio. */
function ac_trani_tipi_documento(): array {
	return array(
		'programmazione' => 'Programmazione',
		'sussidio'       => 'Sussidio',
		'modulo'         => 'Modulo',
		'verbale'        => 'Verbale',
		'statuto'        => 'Statuto e atti normativi',
		'comunicato'     => 'Comunicato',
	);
}

add_action( 'init', 'ac_trani_registra_tipi' );
add_action( 'init', 'ac_trani_registra_tassonomie' );

function ac_trani_registra_tipi(): void {

	register_post_type(
		'evento',
		array(
			'labels'          => array(
				'name'               => 'Eventi',
				'singular_name'      => 'Evento',
				'add_new_item'       => 'Aggiungi evento',
				'edit_item'          => 'Modifica evento',
				'search_items'       => 'Cerca eventi',
				'not_found'          => 'Nessun evento',
				'all_items'          => 'Tutti gli eventi',
				'menu_name'          => 'Eventi',
			),
			'public'          => true,
			'has_archive'     => 'eventi',
			'rewrite'         => array( 'slug' => 'eventi', 'with_front' => false ),
			'menu_icon'       => 'dashicons-calendar-alt',
			'menu_position'   => 5,
			'supports'        => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
			'taxonomies'      => array( 'settore', 'anno-associativo' ),
			// Indispensabile sia per l'editor a blocchi sia per la traccia B (headless).
			'show_in_rest'    => true,
			'rest_base'       => 'eventi',
			'template'        => array( array( 'core/paragraph', array( 'placeholder' => 'Racconta l’appuntamento in poche righe…' ) ) ),
		)
	);

	register_post_type(
		'documento',
		array(
			'labels'          => array(
				'name'          => 'Documenti',
				'singular_name' => 'Documento',
				'add_new_item'  => 'Aggiungi documento',
				'edit_item'     => 'Modifica documento',
				'search_items'  => 'Cerca documenti',
				'not_found'     => 'Nessun documento',
				'all_items'     => 'Tutti i documenti',
				'menu_name'     => 'Documenti',
			),
			'public'          => true,
			'has_archive'     => 'documenti',
			'rewrite'         => array( 'slug' => 'documenti', 'with_front' => false ),
			'menu_icon'       => 'dashicons-media-document',
			'menu_position'   => 6,
			'supports'        => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
			'taxonomies'      => array( 'settore', 'anno-associativo', 'tipo-documento' ),
			'show_in_rest'    => true,
			'rest_base'       => 'documenti',
		)
	);
}

function ac_trani_registra_tassonomie(): void {

	// Settore: la chiave che attraversa tutto il sito, articoli compresi.
	register_taxonomy(
		'settore',
		array( 'evento', 'documento', 'post', 'page' ),
		array(
			'labels'            => array(
				'name'          => 'Settori',
				'singular_name' => 'Settore',
				'menu_name'     => 'Settori',
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'settore', 'with_front' => false ),
		)
	);

	register_taxonomy(
		'anno-associativo',
		array( 'evento', 'documento', 'post' ),
		array(
			'labels'            => array(
				'name'          => 'Anni associativi',
				'singular_name' => 'Anno associativo',
				'menu_name'     => 'Anni associativi',
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'anno', 'with_front' => false ),
		)
	);

	register_taxonomy(
		'tipo-documento',
		array( 'documento' ),
		array(
			'labels'            => array(
				'name'          => 'Tipi di documento',
				'singular_name' => 'Tipo di documento',
				'menu_name'     => 'Tipi',
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'tipo', 'with_front' => false ),
		)
	);

	// Il colore del settore viaggia nella REST insieme al termine: serve al tema
	// e servirebbe anche a un frontend Astro.
	register_term_meta(
		'settore',
		'ac_colore',
		array(
			'type'         => 'string',
			'single'       => true,
			'show_in_rest' => true,
			'default'      => '#1f3f6b',
			'auth_callback' => fn() => current_user_can( 'manage_categories' ),
		)
	);
	register_term_meta(
		'settore',
		'ac_nome_esteso',
		array(
			'type'         => 'string',
			'single'       => true,
			'show_in_rest' => true,
			'auth_callback' => fn() => current_user_can( 'manage_categories' ),
		)
	);
}

/**
 * Crea i termini fissi (i sei settori, i tipi di documento, l'anno in corso) e
 * la categoria «Comunicati ufficiali». Idempotente: si può rilanciare.
 */
function ac_trani_semina_termini(): void {
	ac_trani_registra_tassonomie();

	foreach ( ac_trani_settori() as $slug => $s ) {
		$termine = term_exists( $slug, 'settore' );
		if ( ! $termine ) {
			$termine = wp_insert_term( $s['nome'], 'settore', array( 'slug' => $slug ) );
		}
		if ( ! is_wp_error( $termine ) ) {
			update_term_meta( (int) $termine['term_id'], 'ac_colore', $s['colore'] );
			update_term_meta( (int) $termine['term_id'], 'ac_nome_esteso', $s['esteso'] );
			// La descrizione è un testo redazionale: si semina una volta e poi
			// resta modificabile dalla bacheca senza che una riesecuzione la
			// sovrascriva.
			$attuale = get_term_field( 'description', (int) $termine['term_id'], 'settore', 'raw' );
			if ( ! $attuale && ! empty( $s['descrizione'] ) ) {
				wp_update_term( (int) $termine['term_id'], 'settore', array( 'description' => $s['descrizione'] ) );
			}
		}
	}

	foreach ( ac_trani_tipi_documento() as $slug => $nome ) {
		if ( ! term_exists( $slug, 'tipo-documento' ) ) {
			wp_insert_term( $nome, 'tipo-documento', array( 'slug' => $slug ) );
		}
	}

	foreach ( array( '2026-2027' => '2026/2027', '2025-2026' => '2025/2026' ) as $slug => $nome ) {
		if ( ! term_exists( $slug, 'anno-associativo' ) ) {
			wp_insert_term( $nome, 'anno-associativo', array( 'slug' => $slug ) );
		}
	}

	// Le notizie restano articoli standard: i comunicati sono una categoria.
	if ( ! term_exists( 'comunicati-ufficiali', 'category' ) ) {
		wp_insert_term( 'Comunicati ufficiali', 'category', array( 'slug' => 'comunicati-ufficiali' ) );
	}
}

/** Gli eventi si ordinano per data dell'evento, non per data di pubblicazione. */
add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}
		if ( $query->is_post_type_archive( 'evento' ) || $query->is_tax( array( 'settore', 'anno-associativo' ) ) ) {
			if ( 'evento' === $query->get( 'post_type' ) || $query->is_post_type_archive( 'evento' ) ) {
				$query->set( 'meta_key', 'ac_data_inizio' );
				$query->set( 'orderby', 'meta_value' );
				$query->set( 'order', 'ASC' );
			}
		}
	}
);

/** In bacheca la colonna «Data» di un evento deve mostrare la data dell'evento. */
add_filter(
	'manage_evento_posts_columns',
	function ( $colonne ) {
		$nuove = array();
		foreach ( $colonne as $chiave => $etichetta ) {
			if ( 'date' === $chiave ) {
				$nuove['ac_quando'] = 'Quando';
			}
			$nuove[ $chiave ] = $etichetta;
		}
		return $nuove;
	}
);

add_action(
	'manage_evento_posts_custom_column',
	function ( $colonna, $post_id ) {
		if ( 'ac_quando' === $colonna ) {
			echo esc_html( ac_trani_intervallo_leggibile( $post_id ) );
		}
	},
	10,
	2
);

add_filter(
	'manage_edit-evento_sortable_columns',
	function ( $colonne ) {
		$colonne['ac_quando'] = 'ac_data_inizio';
		return $colonne;
	}
);

<?php
/**
 * Tema AC Trani.
 *
 * Qui c'è il minimo indispensabile. Un tema a blocchi vive di `theme.json`,
 * dei template in `templates/` e dei pattern in `patterns/`: tutto il resto —
 * colori, caratteri, spaziature, layout delle pagine — si cambia dall'Editor
 * del sito e si riesporta in file con *Crea tema a blocchi*.
 *
 * Regola: in questo file non deve finire logica sui dati. Eventi, documenti e
 * notizie li fornisce il plugin `ac-trani-core`.
 */

defined( 'ABSPATH' ) || exit;

define( 'AC_TRANI_TEMA_VERSIONE', '0.2.0' );

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'html5', array( 'style', 'script', 'caption', 'gallery' ) );
		add_theme_support( 'custom-logo', array( 'height' => 200, 'width' => 200, 'flex-height' => true, 'flex-width' => true ) );
		load_theme_textdomain( 'ac-trani', get_template_directory() . '/languages' );
	}
);

/** Il foglio di stile del tema: veste i blocchi `ac-*` del plugin. */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'ac-trani',
			get_stylesheet_uri(),
			array(),
			// La data del file come versione: ogni modifica scavalca la cache del browser.
			(string) filemtime( get_stylesheet_directory() . '/style.css' )
		);
	}
);

/**
 * La data di oggi in testata, come su acaversa.it. Si scrive nel browser:
 * con una cache di pagina davanti, una data stampata da PHP resterebbe ferma
 * al giorno in cui la pagina è stata salvata.
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_script(
			'ac-trani-testata',
			get_theme_file_uri( 'assets/testata.js' ),
			array(),
			AC_TRANI_TEMA_VERSIONE,
			array( 'strategy' => 'defer', 'in_footer' => true )
		);
	}
);

/**
 * La tinta del settore sul <body>: «ac-tinta-acr» nell'archivio di un settore
 * e nelle pagine di un evento, una notizia o un documento che vi appartiene.
 * Così le testate dei template prendono il cartoncino giusto senza che i
 * grafici debbano preparare un template per ogni settore.
 */
add_filter(
	'body_class',
	function ( array $classi ) {
		$slug = '';
		if ( is_tax( 'settore' ) ) {
			$termine = get_queried_object();
			$slug    = $termine instanceof WP_Term ? $termine->slug : '';
		} elseif ( is_singular( array( 'evento', 'post', 'documento' ) ) ) {
			$termini = get_the_terms( get_queried_object_id(), 'settore' );
			$slug    = ( $termini && ! is_wp_error( $termini ) ) ? $termini[0]->slug : '';
		}
		if ( $slug ) {
			$classi[] = 'ac-tinta-' . sanitize_html_class( $slug );
		}
		return $classi;
	}
);

/**
 * Due varianti del blocco Pulsante per i fondi blu: «Chiaro» (pieno bianco) e
 * «Filo» (contorno bianco). Il lime non è fra le varianti di proposito: vuol
 * dire «il prossimo appuntamento», e lo usa solo il blocco omonimo.
 */
add_action(
	'init',
	function () {
		register_block_style( 'core/button', array( 'name' => 'chiaro', 'label' => 'Chiaro (su blu)' ) );
		register_block_style( 'core/button', array( 'name' => 'filo', 'label' => 'Filo (su blu)' ) );
	}
);

/** Lo stesso foglio nell'editor, così l'anteprima corrisponde al sito. */
add_action(
	'after_setup_theme',
	function () {
		add_editor_style( 'style.css' );
	}
);

/** Una categoria dedicata, così i pattern del sito non si perdono fra quelli di WordPress. */
add_action(
	'init',
	function () {
		register_block_pattern_category(
			'ac-trani',
			array(
				'label'       => 'Azione Cattolica Trani',
				'description' => 'Composizioni pronte per le pagine del sito diocesano.',
			)
		);
	}
);

/**
 * Gli eventi già svolti restano leggibili ma non vanno indicizzati come se
 * fossero prossimi appuntamenti: è la differenza fra un archivio e un annuncio.
 */
add_filter(
	'wp_robots',
	function ( array $robots ) {
		if ( ! is_singular( 'evento' ) ) {
			return $robots;
		}
		$fine = get_post_meta( get_the_ID(), 'ac_data_fine', true )
			?: get_post_meta( get_the_ID(), 'ac_data_inizio', true );
		if ( $fine && $fine < current_time( 'Y-m-d' ) ) {
			$robots['noindex'] = true;
		}
		return $robots;
	}
);

/**
 * In italiano i nomi dei mesi vanno minuscoli: «16 settembre 2026».
 * La traduzione it_IT di WordPress li restituisce maiuscoli, che va bene a
 * inizio frase e male dappertutto altrove — e sulle date è quasi sempre
 * «altrove». È una scelta tipografica, quindi sta nel tema.
 */
add_filter(
	'get_the_date',
	function ( $data ) {
		if ( ! is_string( $data ) ) {
			return $data;
		}
		$mese = wp_date( 'F', get_post_timestamp() ?: null );
		return $mese ? str_replace( $mese, mb_strtolower( $mese, 'UTF-8' ), $data ) : $data;
	}
);

/**
 * Nel titolo della pagina il nome del sito è breve, perché in testata deve
 * stare su una riga sola; nella scheda del browser e nei risultati di ricerca
 * serve invece per esteso, altrimenti «Azione Cattolica» da solo non dice di
 * quale diocesi si tratti.
 */
add_filter(
	'document_title_parts',
	function ( array $parti ) {
		$diocesi = str_replace( 'Arcidiocesi di ', '', (string) get_bloginfo( 'description', 'display' ) );
		if ( '' === $diocesi ) {
			return $parti;
		}

		// In home non c'è la voce «site»: il nome sta in «title».
		$chiave = isset( $parti['site'] ) ? 'site' : 'title';
		$parti[ $chiave ] .= ' — ' . $diocesi;
		unset( $parti['tagline'] );
		return $parti;
	}
);

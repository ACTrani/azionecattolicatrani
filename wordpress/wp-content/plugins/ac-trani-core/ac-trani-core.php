<?php
/**
 * Plugin Name:       AC Trani — nucleo
 * Plugin URI:        https://github.com/ACTrani/azionecattolicatrani
 * Description:       Modello dati del sito diocesano: tipi di contenuto (eventi, documenti), tassonomie condivise (settore, anno associativo, tipo di documento), blocchi dinamici per l'editor ed export .ics. Non contiene grafica: quella sta nel tema.
 * Version:           0.1.0
 * Requires at least: 6.5
 * Requires PHP:      8.1
 * Author:            Azione Cattolica — Arcidiocesi di Trani-Barletta-Bisceglie
 * License:           GPL-2.0-or-later
 * Text Domain:       ac-trani
 *
 * ---------------------------------------------------------------------------
 * CONTRATTO CON IL TEMA (vedi piano di lavoro, §2)
 *
 *   Il plugin espone DATI e BLOCCHI, il tema li veste.
 *   - qui dentro non c'è CSS di layout né scelte di colore;
 *   - i blocchi emettono markup semantico con classi `ac-*` documentate
 *     in CONTRATTO.md: è il tema a stilarle.
 *
 * Così i grafici possono rifare il tema da capo, o sostituirlo con un frontend
 * Astro (traccia B), senza toccare il modello dati.
 * ---------------------------------------------------------------------------
 */

defined( 'ABSPATH' ) || exit;

define( 'AC_TRANI_VERSIONE', '0.1.0' );
define( 'AC_TRANI_FILE', __FILE__ );
define( 'AC_TRANI_DIR', plugin_dir_path( __FILE__ ) );
define( 'AC_TRANI_URL', plugin_dir_url( __FILE__ ) );

require_once AC_TRANI_DIR . 'inc/tipi-di-contenuto.php';
require_once AC_TRANI_DIR . 'inc/campi.php';
require_once AC_TRANI_DIR . 'inc/interrogazioni.php';
require_once AC_TRANI_DIR . 'inc/blocchi.php';
require_once AC_TRANI_DIR . 'inc/ics.php';

/**
 * All'attivazione: registra tutto e rigenera i permalink, altrimenti gli
 * archivi /eventi e /documenti rispondono 404 finché non si salva l'opzione.
 */
register_activation_hook(
	__FILE__,
	function () {
		ac_trani_registra_tipi();
		ac_trani_registra_tassonomie();
		ac_trani_semina_termini();
		flush_rewrite_rules();
	}
);

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

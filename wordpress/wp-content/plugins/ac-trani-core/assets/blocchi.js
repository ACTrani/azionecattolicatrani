/**
 * Lato editor dei blocchi di AC Trani.
 *
 * JavaScript semplice, senza JSX e senza build: `wp.element.createElement` fa
 * quello che farebbe JSX, e l'anteprima nell'editor la disegna il server
 * (ServerSideRender), così non esistono due versioni dello stesso markup da
 * tenere allineate.
 *
 * Gli attributi non sono dichiarati qui: arrivano dai block.json già
 * registrati da PHP.
 */
(function (blocchi, elemento, editor, componenti, ssr) {
	'use strict';

	var el = elemento.createElement;
	var Fragment = elemento.Fragment;
	var InspectorControls = editor.InspectorControls;
	var PanelBody = componenti.PanelBody;
	var SelectControl = componenti.SelectControl;
	var RangeControl = componenti.RangeControl;
	var ToggleControl = componenti.ToggleControl;
	var TextControl = componenti.TextControl;
	var ServerSideRender = ssr;

	var dati = window.acTrani || { settori: [], anni: [], tipi: [] };

	/** Scorciatoia: un controllo che scrive su un attributo. */
	function campo(Controllo, props, chiave, opzioni) {
		return el(
			Controllo,
			Object.assign(
				{
					value: props.attributes[chiave],
					onChange: function (valore) {
						var patch = {};
						patch[chiave] = valore;
						props.setAttributes(patch);
					},
					__nextHasNoMarginBottom: true,
				},
				opzioni
			)
		);
	}

	/** Costruisce l'`edit` di un blocco a partire dai suoi controlli. */
	function costruisci(nome, controlli) {
		return function (props) {
			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(PanelBody, { title: 'Contenuto', initialOpen: true }, controlli(props))
				),
				el('div', useBloccoProps(props), el(ServerSideRender, { block: nome, attributes: props.attributes }))
			);
		};
	}

	function useBloccoProps(props) {
		return editor.useBlockProps ? editor.useBlockProps() : {};
	}

	blocchi.registerBlockType('ac-trani/elenco-eventi', {
		edit: costruisci('ac-trani/elenco-eventi', function (props) {
			return [
				campo(TextControl, props, 'titolo', { key: 't', label: 'Titolo della sezione', help: 'Lascia vuoto per non mostrarlo.' }),
				campo(SelectControl, props, 'quando', {
					key: 'q',
					label: 'Quali eventi',
					options: [
						{ label: 'Prossimi appuntamenti', value: 'futuri' },
						{ label: 'Eventi già svolti', value: 'passati' },
						{ label: 'Tutti', value: 'tutti' },
					],
				}),
				campo(RangeControl, props, 'numero', { key: 'n', label: 'Quanti mostrarne', min: 1, max: 24 }),
				campo(SelectControl, props, 'settore', { key: 's', label: 'Settore', options: dati.settori }),
				campo(SelectControl, props, 'anno', { key: 'a', label: 'Anno associativo', options: dati.anni }),
				campo(SelectControl, props, 'layout', {
					key: 'l',
					label: 'Disposizione',
					options: [
						{ label: 'Griglia di schede', value: 'griglia' },
						{ label: 'Elenco compatto', value: 'elenco' },
					],
				}),
				campo(ToggleControl, props, 'evidenza', { key: 'e', label: 'Solo quelli in evidenza' }),
				campo(ToggleControl, props, 'linkArchivio', { key: 'r', label: 'Mostra il link all’archivio' }),
			];
		}),
		save: function () {
			return null;
		},
	});

	blocchi.registerBlockType('ac-trani/tessere-settori', {
		edit: costruisci('ac-trani/tessere-settori', function (props) {
			return [
				campo(TextControl, props, 'titolo', { key: 't', label: 'Titolo della sezione' }),
				campo(RangeControl, props, 'colonne', { key: 'c', label: 'Colonne', min: 1, max: 6 }),
				campo(ToggleControl, props, 'descrizioni', { key: 'd', label: 'Mostra le descrizioni' }),
			];
		}),
		save: function () {
			return null;
		},
	});

	blocchi.registerBlockType('ac-trani/elenco-documenti', {
		edit: costruisci('ac-trani/elenco-documenti', function (props) {
			return [
				campo(TextControl, props, 'titolo', { key: 't', label: 'Titolo della sezione' }),
				campo(RangeControl, props, 'numero', { key: 'n', label: 'Quanti mostrarne', min: 1, max: 100 }),
				campo(SelectControl, props, 'settore', { key: 's', label: 'Settore', options: dati.settori }),
				campo(SelectControl, props, 'tipo', { key: 'p', label: 'Tipo di documento', options: dati.tipi }),
				campo(SelectControl, props, 'anno', { key: 'a', label: 'Anno associativo', options: dati.anni }),
				campo(ToggleControl, props, 'filtri', { key: 'f', label: 'Mostra ricerca e filtri', help: 'Da attivare nella pagina dell’archivio.' }),
			];
		}),
		save: function () {
			return null;
		},
	});

	blocchi.registerBlockType('ac-trani/ultime-notizie', {
		edit: costruisci('ac-trani/ultime-notizie', function (props) {
			return [
				campo(TextControl, props, 'titolo', { key: 't', label: 'Titolo della sezione' }),
				campo(RangeControl, props, 'numero', { key: 'n', label: 'Quante mostrarne', min: 1, max: 12 }),
				campo(SelectControl, props, 'settore', { key: 's', label: 'Settore', options: dati.settori }),
				campo(ToggleControl, props, 'soloComunicati', { key: 'c', label: 'Solo comunicati ufficiali' }),
				campo(ToggleControl, props, 'linkArchivio', { key: 'r', label: 'Mostra il link all’archivio' }),
			];
		}),
		save: function () {
			return null;
		},
	});
	blocchi.registerBlockType('ac-trani/scheda-evento', {
		// Questo blocco vive dentro il template dell'evento: nell'editor non c'è
		// nessun evento da cui leggere, quindi si mostra un segnaposto invece di
		// un'anteprima vuota che farebbe pensare a un guasto.
		edit: function (props) {
			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: 'Contenuto', initialOpen: true },
						campo(ToggleControl, props, 'calendario', { key: 'c', label: 'Pulsante «Aggiungi al calendario»' }),
						campo(ToggleControl, props, 'mappa', { key: 'm', label: 'Link alla mappa' })
					)
				),
				el(
					'div',
					Object.assign({}, useBloccoProps(props), { style: { border: '1px dashed #8c8f94', padding: '1rem' } }),
					el('strong', null, 'Scheda dell’evento'),
					el('p', { style: { margin: '0.4rem 0 0' } }, 'Quando, dove, settore e pulsanti: si riempie con i dati dell’evento visualizzato.')
				)
			);
		},
		save: function () {
			return null;
		},
	});

})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components, window.wp.serverSideRender);

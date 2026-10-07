/**
 * Ricerca e filtro per settore del calendario: nascondono le righe già in
 * pagina, senza ricariche. Il filtro scelto finisce nell'indirizzo
 * (?settore=acr), così il link si può girare su WhatsApp.
 */
(function () {
	document.querySelectorAll('[data-ac-filtri-eventi]').forEach(function (strumenti) {
		var blocco = strumenti.closest('.ac-eventi');
		var cerca = strumenti.querySelector('[data-ac-cerca]');
		var bottoni = Array.prototype.slice.call(strumenti.querySelectorAll('[data-filtro]'));
		var righe = Array.prototype.slice.call(blocco.querySelectorAll('.ac-evento'));
		var mesi = Array.prototype.slice.call(blocco.querySelectorAll('.ac-mese'));
		var conteggio = blocco.querySelector('[data-ac-conteggio]');
		var nessuno = blocco.querySelector('[data-ac-nessuno]');
		var settore = 'tutti';

		function applica() {
			var parola = (cerca.value || '').trim().toLowerCase();
			var visibili = 0;

			righe.forEach(function (riga) {
				var ok = (settore === 'tutti' || riga.dataset.settore === settore) &&
					(!parola || (riga.dataset.filtroTesto || '').indexOf(parola) !== -1);
				riga.hidden = !ok;
				if (ok) visibili++;
			});
			mesi.forEach(function (mese) { mese.hidden = !mese.querySelector('.ac-evento:not([hidden])'); });
			bottoni.forEach(function (b) { b.setAttribute('aria-pressed', String(b.dataset.filtro === settore)); });

			if (conteggio) conteggio.textContent = visibili === 1 ? '1 appuntamento in programma' : visibili + ' appuntamenti in programma';
			if (nessuno) nessuno.hidden = visibili > 0;

			var indirizzo = new URL(window.location.href);
			if (settore === 'tutti') indirizzo.searchParams.delete('settore');
			else indirizzo.searchParams.set('settore', settore);
			history.replaceState(null, '', indirizzo);
		}

		bottoni.forEach(function (b) {
			b.addEventListener('click', function () { settore = b.dataset.filtro; applica(); });
		});
		cerca.addEventListener('input', applica);

		var azzera = blocco.querySelector('[data-ac-azzera]');
		if (azzera) azzera.addEventListener('click', function () {
			settore = 'tutti';
			cerca.value = '';
			applica();
			cerca.focus();
		});

		var iniziale = new URL(window.location.href).searchParams.get('settore');
		if (iniziale && bottoni.some(function (b) { return b.dataset.filtro === iniziale; })) {
			settore = iniziale;
			applica();
		}
	});
})();

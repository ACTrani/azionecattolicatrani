/**
 * Filtri dell'archivio documenti: nascondono le righe già in pagina.
 * Niente dipendenze, niente ricariche.
 */
(function () {
	document.querySelectorAll('.ac-documenti').forEach(function (blocco) {
		var modulo = blocco.querySelector('[data-ac-filtri]');
		if (!modulo) return;

		var righe = Array.prototype.slice.call(blocco.querySelectorAll('.ac-documento'));
		var cerca = modulo.querySelector('[data-ac-cerca]');
		var filtri = Array.prototype.slice.call(modulo.querySelectorAll('[data-ac-filtro]'));
		var esito = modulo.querySelector('[data-ac-esito]');

		function applica() {
			var testo = (cerca && cerca.value || '').trim().toLowerCase();
			var visibili = 0;

			righe.forEach(function (riga) {
				var ok = !testo || (riga.dataset.testo || '').indexOf(testo) !== -1;
				filtri.forEach(function (campo) {
					if (ok && campo.value) ok = riga.dataset[campo.dataset.acFiltro] === campo.value;
				});
				riga.hidden = !ok;
				if (ok) visibili++;
			});

			if (esito) {
				esito.textContent = visibili === righe.length
					? ''
					: visibili + ' document' + (visibili === 1 ? 'o' : 'i') + ' su ' + righe.length;
			}
		}

		modulo.addEventListener('submit', function (e) { e.preventDefault(); });
		if (cerca) cerca.addEventListener('input', applica);
		filtri.forEach(function (campo) { campo.addEventListener('change', applica); });
	});
})();

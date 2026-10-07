/**
 * La data di oggi in testata («Mercoledì 7 ottobre»), sottolineata in lime:
 * il lime vuol dire «oggi / il prossimo».
 */
(function () {
	var oggi = document.querySelector('.ac-oggi');
	if (!oggi) return;
	var testo = new Intl.DateTimeFormat('it-IT', { weekday: 'long', day: 'numeric', month: 'long' }).format(new Date());
	oggi.textContent = testo.charAt(0).toUpperCase() + testo.slice(1);
})();

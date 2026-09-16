import type { Evento } from './contenuti';
import { icsData } from './date';

const esc = (s: string) => s.replace(/\\/g, '\\\\').replace(/;/g, '\;').replace(/,/g, '\\,').replace(/\n/g, '\\n');

/** Un evento di un solo giorno senza orario dura tutta la giornata. */
function periodo(e: Evento) {
  const inizio = new Date(e.data.dataInizio);
  const fine = new Date(e.data.dataFine ?? e.data.dataInizio);
  fine.setDate(fine.getDate() + 1); // DTEND è esclusivo
  const soloData = (d: Date) => d.toISOString().slice(0, 10).replace(/-/g, '');
  return [`DTSTART;VALUE=DATE:${soloData(inizio)}`, `DTEND;VALUE=DATE:${soloData(fine)}`];
}

export function vevento(e: Evento): string[] {
  const d = e.data;
  const luogo = [d.luogo.nome, d.luogo.indirizzo, d.luogo.comune].filter(Boolean).join(', ');
  return [
    'BEGIN:VEVENT',
    `UID:${e.id}@azionecattolicatrani.it`,
    `DTSTAMP:${icsData(new Date())}`,
    ...periodo(e),
    `SUMMARY:${esc(d.annullato ? `[ANNULLATO] ${d.titolo}` : d.titolo)}`,
    `DESCRIPTION:${esc(d.sommario)}`,
    `LOCATION:${esc(luogo)}`,
    `CATEGORIES:${esc(d.settore.toUpperCase())}`,
    d.annullato ? 'STATUS:CANCELLED' : 'STATUS:CONFIRMED',
    'END:VEVENT',
  ];
}

export function calendario(eventi: Evento[], nome: string): string {
  return [
    'BEGIN:VCALENDAR',
    'VERSION:2.0',
    'PRODID:-//Azione Cattolica Trani-Barletta-Bisceglie//PoC//IT',
    'CALSCALE:GREGORIAN',
    'METHOD:PUBLISH',
    `X-WR-CALNAME:${esc(nome)}`,
    'X-WR-TIMEZONE:Europe/Rome',
    ...eventi.flatMap(vevento),
    'END:VCALENDAR',
  ].join('\r\n');
}

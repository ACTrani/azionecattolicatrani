# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users
Primary: **responsabili ed educatori delle associazioni parrocchiali** dell'Arcidiocesi di
Trani – Barletta – Bisceglie (presidenti parrocchiali, educatori ACR, animatori Giovani,
referenti Adulti, segretari MSAC). Vengono per un compito preciso, spesso dal telefono e
poco prima di un incontro: sapere **quando e dove** c'è il prossimo appuntamento
diocesano, scaricare un **sussidio o un modulo**, leggere un **comunicato**.

Secondari (non confermati come priorità): soci e famiglie, persone che non conoscono l'AC.

## Product Purpose
Sito pubblico dell'Azione Cattolica diocesana. Sostituisce `azionecattolicatrani.it`,
morto per mancato rinnovo dell'hosting e perdita del database. Successo = il calendario
diocesano, i documenti e i comunicati sono in un solo posto affidabile, aggiornato dalla
redazione senza dipendere da uno sviluppatore.

## Positioning
È la voce ufficiale della Presidenza diocesana: l'unico posto dove la programmazione
annuale (48 appuntamenti 2026/2027, cammini dei settori, Presidenza e Consiglio) è
pubblicata per intero e sottoscrivibile come calendario `.ics`.

Riferimento strutturale esplicito del committente: **www.acaversa.it** (AC Aversa) —
barra "prossimi appuntamenti", hero, tessere dei settori, griglia notizie, eventi per mese,
pagine settore con sotto-menu, Presidenza a schede. Si riprende **struttura e menu**, non
l'aspetto né gli asset.

## Operating Context
- Due tracce con gli stessi contenuti: **Astro** (`poc-astro/`, prototipo pubblicato su
  GitHub Pages, si itera qui per primo) e **WordPress block theme** (`wordpress/`, traccia
  di produzione; il design si porta lì dopo).
- I contenuti si scrivono in produzione; due grafici lavoreranno sul tema WP.
- Menu (deciso): Home · Notizie · Eventi · Settori ▾ · Assemblea ▾ · Informazioni ▾.

## Capabilities and Constraints
- Settori/articolazioni: Unitario, Adulti, Giovani, ACR, MSAC, MLAC (tassonomia condivisa).
- Eventi con data indicativa (testo al posto della data, esclusi dal `.ics`), feed `/calendario.ics`.
- Documenti filtrabili per tipo, settore, anno associativo.
- Fuori perimetro v1: area soci, iscrizioni online, newsletter, forum.
- Budget < 100 €/anno, hosting Aruba. Font ospitati in locale (nessuna chiamata a Google dal browser).

## Brand Commitments
- Logo AC Trani (marchio a colori blu + verde lime, versione bianca): `poc-astro/src/assets/`.
  La palette del sito **deriva dai colori del logo**, più le tinte dei settori.
- Anno associativo 2026/2027, icona biblica «Vino nuovo in otri nuovi» (Mc 2,18-22).
- Linee guida del Centro nazionale sull'uso del marchio: ancora da chiedere.

## Evidence on Hand
- Reali: 48 eventi, Presidenza e Consiglio (triennio 2024–2027), programmazione annuale
  (`materiali/programmazione-annuale-2026-2027.pdf`), descrizioni dei settori.
- **Inventati** (da sostituire, non presentare come veri): notizie, documenti, testi istituzionali.
- **Nessuna foto** dell'associazione utilizzabile per ora: il sito deve funzionare senza
  foto e avere spazi pronti ad accoglierle. Foto di minori solo con liberatoria.
- Recapiti personali del PDF: non si pubblicano.

## Product Principles
1. Il prossimo appuntamento è la cosa più importante della pagina.
2. Da telefono, in trenta secondi: data, luogo, documento.
3. Ogni contenuto appartiene a un settore, e il settore si riconosce a colpo d'occhio.
4. Mantenibile da volontari per anni: niente che richieda uno sviluppatore per pubblicare.

## Accessibility & Inclusion
Pubblico ampio per età (dai giovani ai 70enni): contrasti WCAG AA, testo leggibile, target
tattili generosi, navigazione da tastiera, nessuna informazione affidata al solo colore.

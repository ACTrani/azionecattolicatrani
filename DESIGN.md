---
name: Azione Cattolica – Diocesi di Trani
description: Il calendario, i documenti e i comunicati dell'AC diocesana, su fogli di cartoncino colorato.
colors:
  col-blu: "#2f5d8a"
  col-blu-chiaro: "#c9daec"
  col-notte: "#12263d"
  col-lime: "#9bc53d"
  col-carta: "#f7f7f2"
  col-foglio: "#ffffff"
  col-tenue: "#4a5a6e"
  col-filo: "#dcdfd6"
  col-filo-forte: "#b9beb2"
  col-errore: "#b3261e"
  settore-unitario: "#2f5d8a"
  settore-unitario-testo: "#ffffff"
  settore-unitario-su-carta: "#2f5d8a"
  settore-adulti: "#f2b705"
  settore-adulti-testo: "#12263d"
  settore-adulti-su-carta: "#7a5900"
  settore-giovani: "#f07a3c"
  settore-giovani-testo: "#12263d"
  settore-giovani-su-carta: "#b33a17"
  settore-acr: "#2ba3de"
  settore-acr-testo: "#12263d"
  settore-acr-su-carta: "#13668f"
  settore-msac: "#7a4fb5"
  settore-msac-testo: "#ffffff"
  settore-msac-su-carta: "#6a3fa5"
  settore-mlac: "#2e7d5b"
  settore-mlac-testo: "#ffffff"
  settore-mlac-su-carta: "#276b4e"
typography:
  display:
    fontFamily: "Rubik, 'Arial Rounded MT Bold', Arial, sans-serif"
    fontSize: "clamp(3rem, 2rem + 5vw, 6rem)"
    fontWeight: 900
    lineHeight: 1.05
    letterSpacing: "-0.035em"
  headline:
    fontFamily: "Rubik, 'Arial Rounded MT Bold', Arial, sans-serif"
    fontSize: "clamp(2.4rem, 1.8rem + 3vw, 4.25rem)"
    fontWeight: 800
    lineHeight: 1.05
    letterSpacing: "-0.02em"
  headline-sezione:
    fontFamily: "Rubik, 'Arial Rounded MT Bold', Arial, sans-serif"
    fontSize: "clamp(1.68rem, 1.42rem + 1.3vw, 2.45rem)"
    fontWeight: 800
    lineHeight: 1.05
    letterSpacing: "-0.02em"
  title:
    fontFamily: "Rubik, 'Arial Rounded MT Bold', Arial, sans-serif"
    fontSize: "clamp(1.18rem, 1.1rem + 0.4vw, 1.42rem)"
    fontWeight: 700
    lineHeight: 1.05
    letterSpacing: "-0.01em"
  body:
    fontFamily: "'Atkinson Hyperlegible Next', 'Helvetica Neue', Arial, sans-serif"
    fontSize: "clamp(1rem, 0.96rem + 0.2vw, 1.125rem)"
    fontWeight: 400
    lineHeight: 1.6
  body-piccolo:
    fontFamily: "'Atkinson Hyperlegible Next', 'Helvetica Neue', Arial, sans-serif"
    fontSize: "clamp(0.86rem, 0.83rem + 0.14vw, 0.94rem)"
    fontWeight: 400
    lineHeight: 1.6
  label:
    fontFamily: "Rubik, 'Arial Rounded MT Bold', Arial, sans-serif"
    fontSize: "clamp(0.75rem, 0.73rem + 0.08vw, 0.8rem)"
    fontWeight: 700
    lineHeight: 1.2
    letterSpacing: "0.04em"
  cifra-ritaglio:
    fontFamily: "Rubik, 'Arial Rounded MT Bold', Arial, sans-serif"
    fontSize: "clamp(4rem, 3rem + 4vw, 6.25rem)"
    fontWeight: 900
    lineHeight: 1
    letterSpacing: "-0.04em"
    fontFeature: "tnum"
rounded:
  raggio: "14px"
  raggio-piccolo: "8px"
  pillola: "999px"
spacing:
  spazio-3xs: "0.25rem"
  spazio-2xs: "0.5rem"
  spazio-xs: "0.75rem"
  spazio-s: "1rem"
  spazio-m: "1.5rem"
  spazio-l: "2.25rem"
  spazio-xl: "3.5rem"
  spazio-2xl: "5rem"
  spazio-3xl: "7rem"
components:
  bottone:
    backgroundColor: "{colors.col-blu}"
    textColor: "{colors.col-foglio}"
    typography: "{typography.label}"
    rounded: "{rounded.pillola}"
    padding: "0.65em 1.25em"
    height: "2.9rem"
  bottone-hover:
    backgroundColor: "{colors.col-notte}"
    textColor: "{colors.col-foglio}"
  bottone-vuoto:
    backgroundColor: "transparent"
    textColor: "{colors.col-blu}"
    rounded: "{rounded.pillola}"
  bottone-chiaro:
    backgroundColor: "{colors.col-foglio}"
    textColor: "{colors.col-blu}"
    rounded: "{rounded.pillola}"
  bottone-filo:
    backgroundColor: "transparent"
    textColor: "{colors.col-foglio}"
    rounded: "{rounded.pillola}"
  bottone-prossimo:
    backgroundColor: "{colors.col-lime}"
    textColor: "{colors.col-notte}"
    rounded: "{rounded.pillola}"
    padding: "0.65em 1.25em"
    height: "2.9rem"
  bottone-prossimo-hover:
    backgroundColor: "{colors.col-foglio}"
    textColor: "{colors.col-notte}"
  etichetta:
    backgroundColor: "{colors.settore-unitario}"
    textColor: "{colors.settore-unitario-testo}"
    typography: "{typography.label}"
    rounded: "{rounded.pillola}"
    padding: "0.2em 0.6em 0.22em"
  ritaglio-piccola:
    backgroundColor: "{colors.settore-acr}"
    textColor: "{colors.settore-acr-testo}"
    width: "3.4rem"
  ritaglio-media:
    backgroundColor: "{colors.settore-acr}"
    textColor: "{colors.settore-acr-testo}"
    width: "4.6rem"
  ritaglio-grande-prossimo:
    backgroundColor: "{colors.col-lime}"
    textColor: "{colors.col-notte}"
    typography: "{typography.cifra-ritaglio}"
    width: "9rem"
  carta-notizia:
    backgroundColor: "{colors.col-foglio}"
    textColor: "{colors.col-notte}"
    rounded: "{rounded.raggio}"
  tessera-settore:
    backgroundColor: "{colors.settore-giovani}"
    textColor: "{colors.settore-giovani-testo}"
    rounded: "{rounded.raggio}"
    padding: "{spacing.spazio-s}"
    height: "8.5rem"
  scheda-persona:
    backgroundColor: "{colors.col-foglio}"
    textColor: "{colors.col-notte}"
    rounded: "{rounded.raggio}"
    padding: "{spacing.spazio-s}"
  campo-ricerca:
    backgroundColor: "{colors.col-foglio}"
    textColor: "{colors.col-notte}"
    rounded: "{rounded.pillola}"
    padding: "0.6rem 1rem 0.6rem 2.8rem"
    height: "2.9rem"
  testa-pagina:
    backgroundColor: "{colors.col-blu}"
    textColor: "{colors.col-foglio}"
    typography: "{typography.display}"
  barra-appuntamenti:
    backgroundColor: "{colors.col-notte}"
    textColor: "{colors.col-foglio}"
    height: "2.6rem"
---

# Design System: Azione Cattolica – Diocesi di Trani

## Overview

**Creative North Star: "Cartoncino"**

Il sito è un cartellone dei campi ACR e dell'oratorio. Ogni settore è un foglio di cartoncino del suo colore, pieno e senza sfumature; ogni data è un numero ritagliato con le forbici a zigzag da quel foglio e appoggiato sulla pagina, leggermente storto. Il fondo è carta da disegno chiara (non crema), l'inchiostro è blu notte, il blu del logo fa da campo per testata, apertura e azioni. Il verde lime del logo è un segnale, non un colore: vuol dire solo «il prossimo / oggi».

La densità è quella di uno strumento di lavoro: il visitatore (responsabile o educatore parrocchiale, spesso dal telefono) deve trovare data, luogo e documento in trenta secondi. Per questo la gerarchia è affidata a una rampa d'importanza fissa (prossimo evento enorme, seguenti medi, elenchi piccoli), a titoli grotteschi pesanti e a un corpo testo ad alta leggibilità. Non ci sono foto: il sito regge su colore e tipografia, e ogni cartellone colorato è uno spazio pronto ad accogliere un'immagine quando arriverà (con liberatoria).

Struttura e menu sono ripresi da acaversa.it per scelta del committente (barra prossimi appuntamenti, testata, apertura, tessere dei settori, notizie in evidenza, eventi per mese, pagine settore con sotto-menu, Presidenza a schede; menu Home · Notizie · Eventi · Settori ▾ · Assemblea ▾ · Informazioni ▾). Si riprende l'impianto, non l'aspetto né gli asset. Rifiuti confermati: il sito parrocchiale crema + serif + oro, e il template Elementor con ombre pesanti e gradienti.

Questo prototipo Astro (`poc-astro/`) è la fonte di verità; il design va portato nel block theme WordPress (`wordpress/`). Ogni token in `poc-astro/src/styles/tokens.css` ha una voce corrispondente in `theme.json` (vedi la tabella in **Layout → Mappatura su theme.json**).

**Key Characteristics:**
- Campi di colore pieni, nessun gradiente di colore.
- La data-ritaglio con il bordo a zigzag è l'elemento firma, ed è l'unico bordo tagliato del sito.
- Lime = «prossimo / oggi», e niente altro.
- Sei tinte di settore, ognuna in tripletta (riempimento / testo sul riempimento / testo su carta).
- Ombre corte e morbide di un foglio appoggiato su un altro; mai ombre a blocco.
- Angoli arrotondati come un cartoncino tagliato a mano; pillole per bottoni ed etichette.
- Grottesco rotondo pesante (Rubik) per titoli e numeri, Atkinson Hyperlegible Next per il testo; cifre tabulari ovunque ci siano date e orari.

## Colors

Una palette derivata dal logo (blu + lime) su carta chiara, più sei tinte piene di settore che fanno da sistema di riconoscimento.

### Primary
- **Blu del logo** (`col-blu`): il campo dell'apertura in home, della testata delle pagine interne, del riquadro «Il cammino», della fascia calendario nel piè di pagina; colore dei link, del bottone principale, dell'anello di focus e del trattino sotto la voce di menu attiva.
- **Azzurro sul blu** (`col-blu-chiaro`): testo secondario sopra il blu (luogo nell'apertura, intro delle testate, definizioni nel cammino) e colore della selezione del testo.

### Secondary
- **Lime del logo** (`col-lime`): il segnale «il prossimo / oggi». Riempie la data-ritaglio del prossimo evento, il bottone «Dettagli dell'appuntamento», l'etichetta «Prossimi appuntamenti» della barra in cima, le icone dei dati del prossimo evento, il sottolineato della data di oggi in testata. Sempre con inchiostro `col-notte`, mai con testo bianco. In `tokens.css` esiste anche `--col-lime-inchiostro` (#4f7a12), il lime scurito per quando deve fare da testo su carta: è definito ma oggi non è usato.

### Tertiary — le tinte di settore
Ogni settore ha una tripletta, applicata con l'attributo `data-settore` che ridefinisce tre variabili: `--col-settore` (riempimento), `--col-settore-testo` (testo sul riempimento), `--col-settore-su-carta` (il colore del settore quando deve essere testo o icona su carta, scurito per stare sopra 4.5:1).

- **Unitario** (`settore-unitario`): il blu del logo, testo bianco.
- **Adulti** (`settore-adulti`): giallo pieno, testo notte; su carta diventa un ocra scuro (`settore-adulti-su-carta`).
- **Giovani** (`settore-giovani`): arancio-rosso, testo notte; su carta un mattone (`settore-giovani-su-carta`).
- **ACR** (`settore-acr`): azzurro, testo notte; su carta un blu petrolio (`settore-acr-su-carta`).
- **MSAC** (`settore-msac`): viola, testo bianco.
- **MLAC** (`settore-mlac`): verde scuro, testo bianco.

Le tinte riempiono: data-ritaglio, etichette, tessere dei settori, cartelloni delle notizie, testate delle pagine settore, iniziali delle schede persona, foglio con angolo piegato dei documenti, quadratini nei menu e nel piè di pagina. In versione «su carta» colorano icone dei metadati evento, ruoli delle persone, sottotitoli e puntini degli elenchi nel testo lungo.

### Neutral
- **Carta** (`col-carta`): il fondo della pagina, carta da disegno, non crema. Anche il fondo hover di voci di menu e sottomenu.
- **Foglio** (`col-foglio`): i fogli bianchi appoggiati sopra la carta (testata, card, schede, fascia notizie, campo di ricerca).
- **Notte** (`col-notte`): l'inchiostro di tutto il testo, la barra appuntamenti, il piè di pagina, l'hover del bottone principale, i fili spessi (2px) che separano mesi e sezioni.
- **Tenue** (`col-tenue`): testo secondario su carta (sommari, metadati, conteggi), 6.5:1.
- **Filo** (`col-filo`) e **Filo forte** (`col-filo-forte`): linee sottili tra righe, bordi delle card nella fascia notizie, contorno del bottone «Scarica», tratteggio delle note di prototipo.
- **Errore** (`col-errore`): solo il bollino «Annullato» sugli eventi.

### Named Rules
**The Lime Rule.** Il lime significa «il prossimo / oggi» e niente altro. Mai decorazione, mai sfondo di sezione, mai un secondo bottone lime nella stessa vista. Test: se togli il lime, si perde l'informazione su cosa viene dopo? Se no, non è lime.

**The Triplet Rule.** Un colore di settore non si usa mai da solo: si usa la tripletta. Riempimento con il suo testo-sul-riempimento; su carta si usa la variante `-su-carta`. Il giallo Adulti o l'azzurro ACR come testo su carta sono vietati.

**The Not-Only-Color Rule.** Il settore si riconosce dal colore, ma il suo nome è sempre scritto (etichetta, tessera, nome nel menu). Nessuna informazione affidata al solo colore.

## Typography

**Display Font:** Rubik 500–900 (con Arial Rounded MT Bold, Helvetica Neue, Arial)
**Body Font:** Atkinson Hyperlegible Next 400–800, anche corsivo (con Helvetica Neue, Arial)

**Character:** Rubik è il grotesco rotondo e pesante delle lettere ritagliate dei cartelloni; Atkinson Hyperlegible è disegnato per chi legge con fatica, e regge un pubblico dai giovani ai settantenni. Entrambi i font sono serviti dal nostro dominio, mai da Google a runtime.

La scala è fluida su nove gradini (`--step--2` … `--step-6`), da 320px a 1280px di viewport.

### Hierarchy
- **Display** (900, `--step-6`, 1.05, -0.035em): il titolo `h1` delle testate di pagina interne, massimo 18ch.
- **Headline** (800, `--step-5`, 1.05, -0.02em): `h1` generico; il titolo del prossimo evento in apertura (900, -0.03em, massimo 16ch; `--step-4` sotto 40rem). Il tema dell'anno nel foglio bianco usa `--step-4` 900.
- **Headline di sezione** (800, `--step-3`; `--step-4` nelle testate di sezione della home): «Poi, in calendario», «Notizie in evidenza», titoli dei blocchi.
- **Title** (700, `--step-1`, -0.01em): `h3`, titoli di riga evento, documento, notizia; nomi delle persone (800).
- **Body** (400, `--step-0`, 1.6): il testo corrente; nel testo lungo massimo `--larghezza-testo` (40rem).
- **Body piccolo** (`--step--1`): sommari, metadati, voci di menu (Rubik 700), bottoni.
- **Label** (Rubik 700, `--step--2`, 0.04em, MAIUSCOLO): etichette di settore, bollo «Comunicato», data della barra appuntamenti, «sopra» e «sotto» della data-ritaglio.

### Named Rules
**The Tabular Rule.** Date, orari e conteggi sono sempre in cifre tabulari (`time`, `.cifre`, il numero del ritaglio).

**The No-Kicker Rule.** Nessun sovrattitolo (eyebrow/kicker) sopra i titoli. L'appartenenza a un settore si dichiara con l'etichetta-pillola **sotto** il titolo (riga evento, notizia, documento, prossimo evento). L'unico testo stampato sopra un numero è la dicitura dentro la data-ritaglio (giorno della settimana o «Il prossimo»), che fa parte del ritaglio stesso.

## Layout

- **Contenitore:** `min(100% - 2rem, --larghezza-max)` con `--larghezza-max` 78rem; quindi 16px di margine laterale sul telefono. Testo lungo a 40rem (`--larghezza-testo`).
- **Ritmo verticale:** le sezioni respirano con `spazio-2xl` sopra e sotto; il piè di pagina si stacca di `spazio-3xl`. Dentro le card e le righe si lavora tra `spazio-s` e `spazio-l`.
- **Testata di sezione:** titolo grande a sinistra, link «vedi tutto» con freccia a destra, sulla stessa linea di base.
- **Apertura della home:** campo blu a tutta larghezza, griglia 1.7fr / 1fr: a sinistra il prossimo evento (ritaglio grande + titolo + dati + azioni), a destra il foglio bianco del tema dell'anno. Le sei tessere-cartoncino dei settori si sovrappongono al bordo inferiore del campo blu (-3.5rem): 6 colonne, 3 sotto 72rem, 2 sotto 40rem.
- **Righe evento:** colonna data / corpo / quando-e-dove. Orari e luoghi **allineati a destra**, stretti al margine come i tempi di una scaletta; sotto 52rem passano sotto il corpo, allineati a sinistra.
- **Eventi per mese:** nome del mese in una colonna di 11rem, appiccicoso durante lo scorrimento, mesi separati da un filo `col-notte` di 2px.
- **Notizie:** griglia a 4 colonne con la prima notizia su 2; 2 colonne sotto 72rem, 1 sotto 40rem.
- **Griglie di persone dimensionate dal numero:** `colonnePer(n)` sceglie le colonne perché le righe siano piene: fino a 4 persone una riga sola, poi 3 se il numero è multiplo di 3, 4 se multiplo di 4, altrimenti 3; mai più di 4, mai una scheda sola in fondo quando si può evitare. Sotto 62rem 2 colonne, sotto 40rem 1.
- **Pagine settore:** testata del colore del settore con sotto-menu di pillole in una fascia schiarita; blocchi testo 1fr / 1.4fr.
- **Breakpoint usati:** 26rem, 30rem, 40rem, 52rem, 60rem, 62rem, 64rem (barra animata), 66rem (menu a scomparsa), 72rem.

### Mappatura su theme.json
Il tema `wordpress/wp-content/themes/ac-trani` applica questa mappatura (ottobre 2026). In `style.css` del tema le variabili brevi (`--col-blu`, `--step-3`, `--spazio-m`, …) sono alias dei preset, così il CSS si legge come quello del prototipo.

| Token (tokens.css) | theme.json |
|---|---|
| `--col-*` | `settings.color.palette` (slug senza prefisso: `blu`, `blu-chiaro`, `notte`, `lime`, `carta`, `foglio`, `tenue`, `filo`, `filo-forte`, `errore`) |
| tinte di settore (`[data-settore]`) | `settings.color.palette` (`settore-unitario` … `settore-mlac`, il cartoncino) + in `style.css` le tre variabili `--col-settore*` su `[data-settore]`, `.ac-tinta-<slug>` (classe aggiuntiva di qualsiasi blocco; il tema la mette anche sul `<body>` delle pagine di un settore) e `.settore-<slug>` (messa da WordPress sugli articoli dei Query Loop) |
| `--font-display`, `--font-body` | `settings.typography.fontFamilies` `display` e `corpo`, con `fontFace` locali in `assets/caratteri/` |
| `--step--2` … `--step-6` | `settings.typography.fontSizes` `minimo`, `piccolo`, `medio`, `grande`, `titolo-3`, `titolo-2`, `titolo-1`, `monumentale`, `manifesto` (stessi `clamp()`, `fluid: false`) |
| `--spazio-3xs` … `--spazio-3xl` | `settings.spacing.spacingSizes` `10` … `90` |
| `--ombra-foglio`, `--ombra-foglio-alta` | `settings.shadow.presets` `foglio`, `foglio-alto` |
| `--raggio`, `--raggio-piccolo` | `settings.custom.raggio`, `settings.custom.raggioPiccolo` |
| `--larghezza-max`, `--larghezza-testo` | `settings.layout.wideSize`, `settings.layout.contentSize` |
| `--curva`, `--transizione` | `settings.custom.curva`, `settings.custom.transizione` |

## Elevation & Depth

Il sistema è piatto per colore e stratificato per fogli: la profondità si dà appoggiando fogli bianchi o colorati sulla carta, con un'ombra corta e morbida che parte da sotto. Mai ombre dure sfalsate, mai alone diffuso tutto intorno.

### Shadow Vocabulary
- **Foglio** (`box-shadow: 0 1px 1px rgb(18 38 61 / 0.08), 0 8px 18px -10px rgb(18 38 61 / 0.35)`): card a riposo, tessere, schede persona, hover delle righe evento.
- **Foglio alto** (`box-shadow: 0 2px 2px rgb(18 38 61 / 0.08), 0 18px 32px -14px rgb(18 38 61 / 0.45)`): foglio sollevato in hover (card, tessere), sottomenu, foglio del tema dell'anno.
- **Ritaglio** (`filter: drop-shadow(0 1px 1px rgb(18 38 61 / 0.18)) drop-shadow(0 6px 8px rgb(18 38 61 / 0.18))`): solo la data-ritaglio; è un filtro perché la maschera a zigzag taglierebbe un `box-shadow`.

### Named Rules
**The Sheet Rule.** Un'ombra c'è solo dove un foglio è appoggiato su un altro. In hover il foglio si alza (−3/−5px e ombra alta), non si illumina.

## Shapes

- **Cartoncino tagliato a mano:** angoli `raggio` (14px) su card, tessere, schede, riquadri; `raggio-piccolo` (8px) su voci di menu.
- **Pillole:** bottoni, etichette di settore, filtri, campo di ricerca, sotto-menu dei settori (`pillola`).
- **Leggere inclinazioni:** la data-ritaglio è ruotata (−1.5° di base, alternata ±1.5° negli elenchi, −3° nell'apertura); il riquadro delle iniziali −3°; i quadratini di settore nei menu −6°. In hover la riga evento raddrizza il suo ritaglio.
- **Il foglio con l'angolo piegato:** il formato del documento (PDF, DOC) è un foglio del colore del settore con l'angolo in alto a destra piegato (un taglio netto a 225°, non una sfumatura).
- **Il bordo a zigzag:** esiste solo sul lato inferiore della data-ritaglio (denti di 5/7/10px secondo la misura).

### Named Rules
**The Scissor Rule.** Il bordo tagliato a forbice esiste solo sulle date-ritaglio. Nessun altro elemento (card, testate, fasce) ha bordi a zigzag, strappati o seghettati.

## Components

### Data-ritaglio (componente firma)
Un numero ritagliato dal cartoncino del settore. Tre righe: dicitura sopra (giorno della settimana, o «Il prossimo»), il numero in Rubik 900 con cifre tabulari, il mese sotto. Gli intervalli diventano «16–18»; una data indicativa ritaglia il mese («NOV») e sotto scrive «da fissare», mai un numero inventato.
- **Rampa d'importanza:** tre misure fisse, nient'altro. **Piccola** (3.4rem, numero 1.55rem, denti 5px) negli elenchi fitti; **media** (4.6rem, numero 2.35rem, denti 7px) nelle righe evento; **grande** (9rem, numero fino a 6.25rem, denti 10px) solo per il prossimo evento.
- **Colore:** tinta del settore; lime con inchiostro notte quando è il prossimo.
- **Movimento:** in apertura si posa sulla pagina (900ms, da −11° e 112%); rispetta `prefers-reduced-motion`.

### Bottoni
- **Shape:** pillola, altezza minima 2.9rem, bordo 2px, Rubik 700 `--step--1`.
- **Primario:** campo `col-blu`, testo bianco; hover `col-notte`; pressione −1px.
- **Vuoto:** contorno blu su carta; hover si riempie di blu.
- **Chiaro / Filo:** le due varianti per i campi blu (pieno bianco, oppure contorno bianco 60%).
- **Prossimo:** l'unico bottone lime, testo notte; hover bianco. Uno per vista.
- **Focus:** anello `col-blu` 3px a 3px di distanza.

### Etichette (chips)
- **Etichetta di settore:** piccolo ritaglio pieno a pillola, Rubik 700 maiuscolo `--step--2`, colori della tripletta. Sta sempre sotto il titolo. Sul campo blu si stacca con un filo bianco di 2px.
- **Bollo «Comunicato»:** stessa forma, solo contorno 1.5px `col-notte`.
- **Filtri (pagina eventi):** pillole a contorno bianco sul campo blu; attive si riempiono di bianco, o della tinta del settore con filo bianco.

### Cards / Containers
- **Carta notizia:** foglio bianco con un cartellone superiore pieno del colore del settore (min 10.5rem, 15rem nella notizia grande) dove il titolo è scritto grande; sotto etichetta, sommario, data. Il cartellone è il posto dove andrà la foto.
- **Tessera settore:** cartoncino pieno del settore, nome in Rubik 900 `--step-2`, fascia d'età sotto, freccia in alto a destra.
- **Scheda persona:** foglio bianco con le iniziali ritagliate sul cartoncino del settore (4.25rem, −3°), nome e ruolo (ruolo in `-su-carta`). I ritratti prenderanno il posto delle iniziali.
- **Riquadri blu (Il cammino):** campo `col-blu`, `raggio`, ombra foglio, voci separate da fili bianchi al 20%.
- **Padding interno:** da `spazio-s` a `spazio-l`.

### Righe
- **Riga evento:** data-ritaglio / titolo + sommario + etichetta / quando e dove a destra con icone nel colore `-su-carta`. Tutta la riga è cliccabile; in hover diventa un foglio bianco con ombra. Gli annullati: titolo barrato e bollino `col-errore`.
- **Riga documento:** foglio con angolo piegato, titolo, metadati (etichetta, tipo, anno), bottone «Scarica» a contorno `col-filo-forte` che in hover diventa blu.

### Inputs / Fields
- **Campo di ricerca:** pillola bianca senza bordo sul campo blu, icona lente a sinistra, altezza 2.9rem.
- **Focus:** anello di 3px a 2px di distanza, chiaramente visibile sul campo blu (bianco `col-foglio`, non lime).

### Navigation
- **Barra appuntamenti:** striscia `col-notte` in cima a ogni pagina; a sinistra l'etichetta lime «Prossimi appuntamenti»; a destra un nastro che scorre lento (70s), si ferma con il puntatore o il focus, e diventa fermo e scorribile a mano sul telefono e per chi chiede meno movimento. Ogni data è una piccola targhetta nel colore del settore.
- **Testata:** foglio bianco appiccicoso, logo + «Azione Cattolica / Trani · Barletta · Bisceglie», data di oggi in alto a destra sottolineata di lime, menu in Rubik 700 con trattino blu di 3px sotto la voce attiva, bottone «Aderisci». Sottomenu: foglio bianco con ombra alta, quadratino di settore inclinato davanti alle voci.
- **Mobile (sotto 66rem):** bottone tondo menu/chiudi 3rem, pannello a tutta larghezza con voci a 0.95rem di padding separate da filo, sottomenu a fisarmonica, «Aderisci» a tutta larghezza.
- **Piè di pagina:** fascia blu «Tutto il calendario diocesano nel tuo telefono» con bottone chiaro; poi campo `col-notte` a cinque colonne (identità, segreteria, settori, informazioni, social).

### Testa pagina
Campo pieno blu (o del colore del settore nelle pagine settore) con briciole, titolo Display e introduzione in `--step-1`; slot inferiore per il sotto-menu del settore in una fascia schiarita.

## Do's and Don'ts

### Do:
- **Do** usare campi di colore pieni: blu del logo per testate e apertura, tinte di settore per tutto ciò che appartiene a un settore.
- **Do** applicare sempre la tripletta di settore (`--col-settore`, `--col-settore-testo`, `--col-settore-su-carta`) via `data-settore` o la classe equivalente nel tema WP.
- **Do** mettere l'etichetta di settore sotto il titolo, mai sopra.
- **Do** usare la data-ritaglio in una delle tre misure (piccola / media / grande), con la grande riservata al prossimo evento.
- **Do** allineare orari e luoghi a destra nelle righe evento su desktop.
- **Do** dimensionare le griglie di persone con `colonnePer(n)`, perché le righe siano piene.
- **Do** usare ombre corte e morbide (`--ombra-foglio`, `--ombra-foglio-alta`) solo per fogli appoggiati.
- **Do** usare cifre tabulari per date, orari, anni e conteggi.
- **Do** usare le icone a tratto 2px con estremità arrotondate (un solo set, stile Lucide), inline in SVG.

### Don't:
- **Don't** usare il lime per decorare: solo «prossimo / oggi».
- **Don't** usare gradienti di colore, sfondi sfumati o vetri smerigliati.
- **Don't** usare il bordo a zigzag fuori dalle date-ritaglio.
- **Don't** mettere sovrattitoli (eyebrow/kicker) sopra i titoli.
- **Don't** usare ombre dure sfalsate o ombre lunghe a blocco.
- **Don't** usare il giallo Adulti o l'azzurro ACR come testo su carta: si usa la variante `-su-carta`.
- **Don't** tornare al registro parrocchiale crema + serif + oro.
- **Don't** inventare una data: se il giorno non è fissato si ritaglia il mese e si scrive «da fissare».

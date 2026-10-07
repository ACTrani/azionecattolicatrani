# Contratto fra il plugin e il tema

Questo plugin **non contiene grafica**. Produce markup semantico con classi
`ac-*` e nessun foglio di stile: l'aspetto lo decide il tema, in `style.css`.

È una regola, non una pigrizia. Serve perché i grafici possano rifare il tema da
capo — o sostituirlo del tutto con un frontend Astro — senza che il modello dati
si muova di un millimetro. Chi lavora da una parte non rompe l'altra.

Se un giorno servisse un colore o una spaziatura dentro il plugin, **è il segnale
che qualcosa va spostato nel tema**, non che la regola vada aggirata.

---

## I blocchi

Si inseriscono dall'editor come qualsiasi altro blocco; le opzioni sono nella
barra laterale. Dove c'è l'opzione **Settore**, il valore «Quello della pagina»
(`corrente`) prende il settore dell'archivio o del contenuto aperto: serve nei
template. Nei titoli, `{settore}` diventa il nome del settore.

| Blocco | Cosa mostra | Opzioni |
|---|---|---|
| **Il prossimo appuntamento** | il primo evento in calendario, in grande, con la data lime | settore. Pensato per l'apertura blu della home |
| **Elenco eventi** | righe di calendario con la data ritagliata | futuri / passati / tutti · quanti · salta i primi · settore · anno · righe o compatte · sommario · raggruppa per mese · ricerca e filtro per settore · titolo · link all'archivio |
| **Scheda dell'evento** | data ritagliata, quando, dove, per chi, pulsanti | pulsante calendario · link mappa. Va **dentro il template dell'evento singolo** |
| **Tessere dei settori** | le sei articolazioni, in ordine d'età | colonne · descrizioni · titolo |
| **Elenco documenti** | documenti scaricabili | quanti · settore · tipo · anno · righe compatte · ricerca e filtri · titolo · link all'archivio |
| **Notizie e comunicati** | notizie come cartelloni del settore | quante · settore · solo comunicati · prima in grande · titolo · link all'archivio |
| **Barra dei prossimi appuntamenti** | la striscia in cima al sito | quanti |

## Le classi da vestire

Involucro di ogni blocco: `.ac-prossimo`, `.ac-eventi` (`--righe`,
`--compatto`, `--passati`), `.ac-settori`, `.ac-documenti`, `.ac-notizie`
(`--prima-grande`), `.ac-scheda`, `.ac-barra`.

```
.ac-sezione__testa           riga del titolo: titolo a sinistra, link a destra
  .ac-sezione__titolo        titolo opzionale della sezione
  .ac-link-avanti            il link «Tutti gli appuntamenti →»
.ac-vuoto                    messaggio quando non c'è nulla da mostrare
.ac-etichetta                pillola (--settore --comunicato --annullato)
.ac-icona                    icona a tratto (svg)
.ac-bottone                  pulsante (--vuoto --chiaro --filo --prossimo)

.ac-ritaglio                 LA DATA RITAGLIATA (--piccola --media --grande,
  __foglio __sopra             --prossimo --parola --lungo; inclinazione in
  __numero __sotto             --ac-inclinazione)

.ac-prossimo                 __ritaglio __testo __titolo __dati __quando
                             __luogo __settore __azioni
.ac-evento                   una riga (--piccola --media --annullato)
  __corpo __titolo __sommario __settore __meta __quando __luogo
.ac-mese  __nome             un mese del calendario raggruppato
.ac-strumenti .ac-ricerca .ac-filtri-settore .ac-filtro .ac-conteggio
.ac-nessun-risultato         ricerca e filtri del calendario

.ac-settore                  una tessera
  __collegamento __nome __eta __descrizione
.ac-documento                una riga (--compatta)
  __formato __corpo __titolo __descrizione __dati __scarica __peso __mancante
.ac-filtri __campo __esito   ricerca e filtri dei documenti
.ac-notizia                  una notizia (--comunicato)
  __cartellone __titolo __corpo __dati __sommario __data
.ac-scheda                   __dati __indirizzo __azioni __nota
.ac-avviso                   avviso in cima alla scheda (--annullato)
.ac-barra                    __titolo __finestra __nastro __elenco __data __evento
```

**`data-settore`** sta sull'elemento di ogni contenuto e vale `unitario`,
`adulti`, `giovani`, `acr`, `msac` o `mlac`. È l'aggancio con cui il tema
assegna la tinta del settore — tre colori: il cartoncino, il testo sopra il
cartoncino, il testo del settore sulla carta:

```css
[data-settore='acr'] { --col-settore: #2ba3de; --col-settore-testo: #12263d; --col-settore-su-carta: #13668f; }
```

Le tessere dei settori portano anche `--ac-colore-settore` in linea, preso dal
campo *colore* del termine: cambiandolo dalla bacheca cambia il cartoncino della
tessera. Il colore del testo sopra resta quello del tema: se si cambia il
cartoncino, va controllato che il testo si legga ancora.

Il plugin decide anche *cosa* c'è scritto nella data ritagliata (giorno della
settimana, numero, mese; «16–18» per più giorni nello stesso mese; il mese e «da
fissare» se il giorno non è deciso). Il taglio a zigzag, i colori e le misure
sono del tema.

---

## Il modello dati

| | CPT | Tassonomie | Campi |
|---|---|---|---|
| Eventi | `evento` | settore, anno-associativo | `ac_data_inizio` `ac_data_fine` `ac_data_indicativa` `ac_orario` `ac_luogo_nome` `ac_luogo_indirizzo` `ac_luogo_comune` `ac_mappa_url` `ac_link_iscrizione` `ac_annullato` `ac_in_evidenza` |
| Documenti | `documento` | settore, anno-associativo, tipo-documento | `ac_data` `ac_file_id` `ac_file_url` `ac_formato` `ac_dimensione` `ac_download` |
| Notizie | `post` | settore, categoria *Comunicati ufficiali* | — |

Tutto è esposto nella REST API (`/wp-json/wp/v2/eventi`, `/documenti`, `/posts`),
meta compresi: è la porta d'ingresso della traccia B.

Gli stessi nomi si ritrovano in `poc-astro/src/content.config.ts`. Se il modello
cambia, vanno cambiati **tutti e due**.

---

## Altro

- `/calendario.ics` — tutti gli eventi, sottoscrivibile da Google Calendar,
  Apple Calendario e Outlook.
- `/eventi/<slug>/?ac_ics=1` — il singolo appuntamento, da scaricare.

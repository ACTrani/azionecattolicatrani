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
barra laterale.

| Blocco | Cosa mostra | Opzioni |
|---|---|---|
| **Elenco eventi** | appuntamenti | futuri / passati / tutti · quanti · settore · anno · griglia o elenco · solo in evidenza · titolo · link all'archivio |
| **Scheda dell'evento** | quando, dove, settore, pulsanti | pulsante calendario · link mappa. Va **dentro il template dell'evento singolo** |
| **Tessere dei settori** | le sei articolazioni | colonne · descrizioni · titolo |
| **Elenco documenti** | documenti scaricabili | quanti · settore · tipo · anno · ricerca e filtri · titolo |
| **Notizie e comunicati** | articoli | quanti · settore · solo comunicati · titolo · link all'archivio |

## Le classi da vestire

Involucro di ogni blocco: `.ac-eventi`, `.ac-settori`, `.ac-documenti`,
`.ac-notizie`, `.ac-scheda`.

```
.ac-sezione__titolo          titolo opzionale della sezione
.ac-sezione__coda            riga finale con il link all'archivio
.ac-link-avanti              il link «Tutti gli appuntamenti →»
.ac-vuoto                    messaggio quando non c'è nulla da mostrare
.ac-etichetta                etichetta generica
  --settore --comunicato --annullato

.ac-evento                   una scheda evento (--annullato se lo è)
  __data __giorno __mese __corpo __titolo __quando __luogo __sommario

.ac-settore                  una tessera
  __collegamento __nome __esteso __descrizione

.ac-documento                una riga dell'archivio
  __corpo __titolo __descrizione __dati __file __scarica

.ac-notizia                  una notizia (--comunicato se lo è)
  __dati __titolo __sommario

.ac-scheda                   la scheda dell'evento singolo
  __dati __indirizzo __azioni
.ac-bottone                  pulsante (--tenue per la versione in negativo)
.ac-avviso                   avviso in cima alla scheda (--annullato)
```

**`data-settore`** sta sull'elemento di ogni contenuto e vale `unitario`,
`adulti`, `giovani`, `acr`, `msac` o `mlac`. È l'aggancio con cui il tema
assegna la tinta del settore:

```css
[data-settore='acr'] { --ac-colore-settore: #c0392b; }
```

Le tessere dei settori portano anche `--ac-colore-settore` in linea, preso dal
campo *colore* del termine: cambiandolo dalla bacheca cambia il sito, senza
toccare il CSS.

---

## Il modello dati

| | CPT | Tassonomie | Campi |
|---|---|---|---|
| Eventi | `evento` | settore, anno-associativo | `ac_data_inizio` `ac_data_fine` `ac_orario` `ac_luogo_nome` `ac_luogo_indirizzo` `ac_luogo_comune` `ac_mappa_url` `ac_link_iscrizione` `ac_annullato` `ac_in_evidenza` |
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

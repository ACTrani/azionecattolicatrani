# Piano di lavoro — nuovo sito Azione Cattolica diocesana

**Arcidiocesi di Trani – Barletta – Bisceglie** · dominio `azionecattolicatrani.it`
Riferimento: [analisi-tecnologie-sito-ac-diocesana.md](analisi-tecnologie-sito-ac-diocesana.md)

---

## 1. Decisioni prese

| Ambito | Scelta |
|---|---|
| Architettura | **WordPress monolitico** (traccia A, quella che va in produzione) + **PoC WordPress headless + Astro** (traccia B, da valutare insieme al team) |
| Hosting | **Aruba**, stesso account che già gestisce dominio e casella `info@` — web e mail insieme, nessun intervento DNS |
| Ambienti | **Staging condiviso + produzione** |
| Strumento grafico | **Blocchi nativi Gutenberg + block theme** (nessuna licenza, niente Elementor) |
| Archivio vecchio sito | **Tutto l'archivio statico** ripubblicato, con redirect dai vecchi percorsi |
| Funzioni al lancio | Eventi con filtri e calendario · Archivio documenti con ricerca · Cookie banner + Analytics + SEO |
| Ruoli redazionali | Da definire con la Presidenza: il sistema si progetta per settore, si parte con pochi account |
| Identità visiva | Linee guida del nazionale + declinazione diocesana |
| Tempi | Lancio entro **1–2 mesi** |
| Budget | **< 100 €/anno** |

**Fuori perimetro (v1):** forum, registrazione e area riservata soci, iscrizioni online agli eventi, newsletter, e-commerce. Il modello dati è progettato per non ostacolarli in futuro.

---

## 2. Il problema vero da risolvere

Il requisito che guida tutto il piano non è tecnologico: **i due grafici devono poter lavorare liberamente su WordPress senza dipendere da me, e senza che il loro lavoro venga sovrascritto dal mio (o viceversa)**.

Con un block theme c'è un tranello da conoscere subito: le modifiche fatte dall'Editor del sito (template, stili, palette) **non finiscono in file, ma nel database**. Se lasciamo così, l'unico modo di portare la grafica da staging a produzione è copiare il database — che però contiene anche i contenuti, e quindi li sovrascrive. È la principale causa di pasticci in questo tipo di progetti.

**La soluzione: separare "design" da "contenuti" e da "logica dati" su tre canali distinti.**

| Canale | Cosa contiene | Chi lo possiede | Come viaggia da staging a produzione |
|---|---|---|---|
| `wp-content/themes/ac-trani/` | Template, parti, pattern, `theme.json` (colori, font, spaziature) | **Grafici** | Esportati in file col plugin *Create Block Theme* → commit su Git → deploy automatico |
| `wp-content/plugins/ac-trani-core/` | Custom post type, tassonomie, campi, blocchi dinamici, REST | **Andrea (backend)** | Commit su Git → deploy automatico |
| Database | Contenuti, media, utenti | **Redazione** | Non viaggia mai: **i contenuti si scrivono direttamente in produzione** |

Regola d'oro da scrivere sul muro:

> **Lo staging serve per il design e la struttura. I contenuti si scrivono in produzione.**
> Non si copia mai il database da staging a produzione.

Corollario del contratto di interfaccia:
- il **plugin** non contiene CSS di layout: espone dati, blocchi e pattern;
- il **tema** non contiene query o logica dati: consuma i blocchi del plugin;
- i blocchi dinamici (`block.json` + render lato server) sono l'unico punto di contatto fra i due mondi.

Questa disciplina è anche ciò che rende possibile la traccia B: se i dati vivono nel plugin e la grafica nel tema, sostituire il tema con un frontend Astro non richiede di rifare il modello dati.

---

## 3. Struttura del sito

Ispirata a `azionecattolica.it`, ridotta alla scala diocesana.

**Menu principale (4 voci + call to action)**

1. **L'associazione** — Chi siamo · Presidenza diocesana · I settori e le articolazioni (Adulti, Giovani, ACR, MSAC, MLAC) · Le associazioni parrocchiali · Contatti
2. **Eventi** — Prossimi appuntamenti (default) · Archivio eventi · filtri per settore e anno associativo
3. **Notizie e comunicati** — Notizie · Comunicati ufficiali (categoria evidenziata) · filtro per settore
4. **Documenti e modulistica** — Programmazioni · Sussidi · Moduli e adesioni · Verbali · Archivio storico
5. *(pulsante)* **Aderisci** — pagina informativa sull'adesione, senza form nella v1

**Homepage (ordine dei blocchi)**

1. Hero: identità diocesana + slogan dell'anno associativo
2. **Prossimi eventi** (3–4 card con data, luogo, settore) — la sezione centrale del sito
3. Ultime notizie e comunicati (3–4 card)
4. I settori (5 tessere colorate → pagine settore)
5. Documenti recenti / modulistica più richiesta
6. Contatti e social

**Footer:** contatti della sede, orari, mail e telefono, link rapidi, dati legali, privacy e cookie policy, credits.

---

## 4. Modello dati

Tutto registrato nel plugin `ac-trani-core`, con `show_in_rest` attivo (necessario sia per l'editor a blocchi sia per la traccia B).

**Tassonomia condivisa** — è la chiave dell'intero sito, applicata a tutti i tipi di contenuto:
- `settore`: Unitario · Adulti · Giovani · ACR · MSAC · MLAC (con colore e icona per settore, letti dal tema)
- `anno-associativo`: 2026/2027, 2025/2026, … (usato per filtrare eventi e documenti)

**CPT `evento`**
- titolo, descrizione, immagine/locandina, estratto
- meta: data e ora inizio, data e ora fine, luogo (nome + indirizzo), link mappa, locandina PDF, link esterno iscrizione, flag "annullato/rinviato"
- tassonomie: settore, anno associativo
- archivio ordinato per data crescente sui futuri, decrescente sui passati; export `.ics` per singolo evento e feed `.ics` complessivo (sottoscrivibile da Google Calendar)

**CPT `documento`**
- titolo, descrizione breve, file allegato (PDF/DOC), copertina opzionale
- tassonomie: settore, anno associativo, `tipo-documento` (programmazione, sussidio, modulo, verbale, statuto, altro)
- archivio con ricerca testuale e filtri combinabili; contatore download

**Articoli standard (`post`) = Notizie**
- categoria dedicata **Comunicati ufficiali** per distinguerli dalle notizie ordinarie
- tassonomia settore

**Pagine** per i contenuti istituzionali (chi siamo, presidenza, settori, adesione, contatti, privacy).

**Campi custom:** *Secure Custom Fields* (il fork ufficiale di ACF su wordpress.org, gratuito), con le definizioni salvate come JSON dentro il plugin (`acf-json/`) — così il modello dati resta versionato su Git e non vive solo nel database.

**Blocchi dinamici forniti ai grafici** (si inseriscono dall'editor come qualsiasi altro blocco, con opzioni nella barra laterale):
- *Elenco eventi* — filtri per settore/numero/layout, modalità "solo futuri"
- *Prossimo evento in evidenza*
- *Elenco documenti filtrabile*
- *Ultime notizie / comunicati*
- *Tessere settori*

---

## 5. Divisione del lavoro

| | **Andrea (backend/infrastruttura)** | **I due grafici** |
|---|---|---|
| Fa | Hosting, ambienti, DNS, backup, sicurezza, aggiornamenti, deploy automatico, plugin `ac-trani-core` (CPT, tassonomie, campi, blocchi, `.ics`, filtri), redirect archivio storico, performance, SEO tecnica, cookie/analytics | Identità visiva, `theme.json` (palette, tipografia, spaziature), template e parti (header, footer, archivi, single), pattern riutilizzabili, homepage, pagine istituzionali, immagini e icone, resa mobile |
| Non fa | Scelte estetiche, layout, copy | Codice PHP, query, plugin, configurazioni server |
| Consegna | Blocchi e pattern documentati + staging funzionante | Tema esportato in file e committato |

**Punti di sincronizzazione:** un allineamento a settimana (30 min) — io mostro i nuovi blocchi disponibili, loro mostrano il design; si aggiusta il contratto se serve.

---

## 6. Ambienti e flusso di lavoro

```
   Grafici ──► staging.azionecattolicatrani.it ──(Create Block Theme: export)──► Git
                                                                                 │
   Andrea  ──────────── plugin ac-trani-core ────────────────────────────────────┤
                                                                                 ▼
                                                              GitHub Actions (deploy SFTP)
                                                                                 │
                                                                                 ▼
   Redazione ──────────────────────────────────────────►  azionecattolicatrani.it
                                                              (contenuti reali)
```

- **Repository Git**: `wp-content/themes/ac-trani/` + `wp-content/plugins/ac-trani-core/`. Il core di WordPress, i plugin di terze parti e `wp-content/uploads/` restano fuori dal repository.
- **Deploy**: GitHub Actions con deploy SFTP/FTP sulle sole due cartelle. Nessun build step complicato: quello che si committa è quello che va online.
- **Staging**: sottodominio `staging.azionecattolicatrani.it`, protetto da password HTTP e `noindex`.
- **Backup**: UpdraftPlus (gratuito) → Google Drive dell'associazione, database giornaliero + file settimanale, con restore provato almeno una volta prima del lancio.

---

## 7. Fasi e calendario (6–7 settimane)

### Fase 0 — Abilitanti *(settimana 1, in parte bloccante)*
- [ ] Recuperare e verificare gli accessi al pannello Aruba (`dominio sito diocesi/`)
- [ ] **Verificare sul piano Aruba**: possibilità di creare un **sottodominio con installazione WordPress separata** (staging), accesso **SFTP/FTP** per il deploy automatico, versione **PHP 8.2+**, spazio disco disponibile, eventuale cache lato server
- [ ] Attivare l'hosting WordPress mantenendo invariati i record MX (la casella `info@` non deve mai interrompersi)
- [ ] Creare il repository Git e la struttura tema + plugin vuoti
- [ ] Chiedere alla Presidenza: logo in vettoriale, eventuali linee guida del Centro nazionale sull'uso del marchio, elenco dei responsabili di settore, testi istituzionali
- [ ] Concordare chi pubblica (punto ancora aperto) e aprire gli account

> Se il piano Aruba non consente un secondo WordPress su sottodominio, ripiego nell'ordine: (1) un secondo hosting Aruba minimo dedicato allo staging; (2) staging temporaneo su InstaWP/free tier; (3) staging locale in Docker, che però taglia fuori i grafici non tecnici — da evitare.

### Fase 1 — Scheletro tecnico *(settimana 2)*
- Produzione e staging installati, in `noindex`, con pagina "sito in costruzione"
- Plugin `ac-trani-core`: CPT `evento` e `documento`, tassonomie `settore`, `anno-associativo`, `tipo-documento`, campi custom
- Block theme figlio con `theme.json` di partenza (palette e font AC), header e footer minimi
- Struttura di menu e pagine vuote creata, così i grafici hanno subito su cosa lavorare
- Pipeline di deploy funzionante end-to-end
- **Grafici**: moodboard, adattamento delle linee guida nazionali, wireframe della homepage

### Fase 2 — Funzioni *(settimane 3–4)*
- Blocchi dinamici: elenco eventi, prossimo evento, elenco documenti filtrabile, ultime notizie, tessere settori
- Filtri combinati (settore + anno + testo) su eventi e documenti, con URL condivisibili
- Export `.ics` singolo e feed calendario sottoscrivibile
- Contatore download documenti
- **Grafici**: homepage, template archivi e pagina singola, pattern riutilizzabili, resa mobile

### Fase 3 — Contenuti e archivio storico *(settimana 5)*
- Caricamento contenuti reali forniti dalla Presidenza (questo è il vero collo di bottiglia — va avviato già in fase 1)
- Migrazione dell'archivio statico e attivazione dei redirect (§8)
- Guida operativa di 2 pagine per chi pubblicherà

### Fase 4 — Rifinitura e messa in sicurezza *(settimana 6)*
- SEO: permalink, sitemap, Open Graph (anteprime su WhatsApp e Facebook), dati strutturati `Event`
- Cookie banner + analytics privacy-friendly (Matomo o GA4 configurato in modo conforme) + privacy e cookie policy
- Sicurezza: `DISALLOW_FILE_EDIT`, limitazione tentativi di login, 2FA sugli account amministratore, blocco XML-RPC, utenze nominali (nessun account condiviso), rimozione dei plugin non usati
- Performance: cache, immagini in WebP, lazy loading, test su rete mobile
- Accessibilità di base: contrasti, testi alternativi, navigazione da tastiera, gerarchia dei titoli
- Backup verificato con un restore di prova

### Fase 5 — Lancio *(settimana 7)*
- Rimozione `noindex`, pubblicazione sul dominio principale
- **Verifica che la posta `info@` funzioni ancora** (test invio/ricezione prima e dopo)
- Google Search Console, invio sitemap
- Monitoraggio uptime gratuito (UptimeRobot) e primo giro di controllo link

### Traccia B — PoC headless *(3 giorni, in parallelo, non bloccante)*
Su un branch separato: frontend **Astro** che legge la REST API dello stesso WordPress e renderizza homepage, elenco eventi e pagina evento, pubblicato su Cloudflare Pages (piano gratuito).
Serve a far toccare con mano al team la differenza. **Criteri di valutazione da decidere prima di guardare il risultato:** autonomia reale dei grafici, velocità percepita, complessità di manutenzione, numero di persone in grado di intervenire fra due anni. Da fare **dopo** la fase 2, per non rallentare il lancio.

---

## 8. Archivio storico: cosa si può salvare davvero

Verifica sui file presenti nel repository:

| | |
|---|---|
| Totale archivio | 671 MB |
| Escluso `mkportal/` + `acforum/` | ~547 MB |
| PDF | 406 |
| Documenti Office | 65+ |
| Immagini | ~580 |
| **Pagine HTML** | **solo 22** |

Due conseguenze importanti:

1. **Non ci sono pagine da ripubblicare.** Il vecchio sito era dinamico (MkPortal + SMF) e il database di produzione è andato perso: gli URL del tipo `index.php?ind=news&id=...` **non sono recuperabili in alcun modo**. Quello che si conserva sono i **file**: PDF, moduli, foto, ancora raggiungibili al loro percorso.
2. **`mkportal/` e `acforum/` non vanno ripubblicati.** Sono applicazioni PHP del 2004–2006, non aggiornabili e vulnerabili: rimetterle online significherebbe riaprire esattamente il tipo di falla che ha riempito di link spam il sito dell'Arcidiocesi.

**Come procedo:**
- Carico l'albero statico sotto `/storico/` anziché alla radice, per evitare collisioni con le pagine del nuovo sito (la vecchia cartella `ACR/` confliggerebbe con la futura pagina `/acr/`)
- Attivo **redirect 301** dai vecchi percorsi ai nuovi (`/ACR/...` → `/storico/ACR/...`), così i link esterni e i risultati Google esistenti continuano a funzionare
- Le regole di riscrittura standard di WordPress escludono già i file e le cartelle fisicamente esistenti, quindi l'archivio convive con WordPress senza interferenze
- Normalizzo gli spazi nei nomi delle cartelle (es. `Materiale da scaricare/`) mantenendo un redirect dalla forma vecchia
- I documenti **ancora attuali** non restano sepolti nello storico: vengono ricaricati come CPT `documento`, con titolo, settore e anno, e quindi ricercabili

**Da decidere:** 4 file pesano da soli ~290 MB (un video `.wmv` da 161 MB, un `.mp3` da 58 MB, un video da 53 MB, un `.rar` da 20 MB). Su un hosting economico incidono su spazio e banda. Proposta: **caricare i video su YouTube** (canale dell'associazione) e sostituire i file con il link; tenere gli archivi `.rar` solo se qualcuno li usa ancora.

---

## 9. Costi (target < 100 €/anno)

| Voce | Costo |
|---|---|
| Dominio `azionecattolicatrani.it` (rinnovo) | già sostenuto |
| Hosting WordPress Aruba | **da verificare a listino** — è la voce che assorbe quasi tutto il budget |
| Tema a blocchi, plugin, CDN Cloudflare, backup su Drive, monitoraggio | 0 € |
| Staging | 0 € **se incluso nel piano**, altrimenti costo aggiuntivo |

**Rischio numero uno del budget:** lo staging. Se Aruba non lo include e non consente un secondo WordPress, le alternative sono un piccolo costo aggiuntivo oppure un compromesso sul flusso di lavoro. Da chiarire in fase 0, prima di qualunque altra cosa.

---

## 10. Rischi e punti aperti

| Rischio | Impatto | Come lo gestiamo |
|---|---|---|
| **I contenuti dalla Presidenza arrivano tardi** | Alto — è il vero rischio per la scadenza di 1–2 mesi | Richiesta formale già in fase 0, con elenco puntuale e scadenza; si lancia con un set minimo e si completa dopo |
| Staging non disponibile sul piano Aruba | Alto | Verifica bloccante in fase 0, tre ripieghi già individuati |
| Aruba gestito limita plugin, SFTP o PHP | Medio | Verifica in fase 0; se il piano è troppo chiuso si valuta un hosting Linux standard, sempre Aruba, sempre dentro budget |
| **Nessuno mantiene il sito fra due anni** | Alto — è ciò che ha ucciso il sito precedente | Aggiornamenti automatici minori, backup automatici, documentazione, e almeno un secondo referente tecnico formato |
| **Foto e dati di minori (ACR)** | Alto, anche legale | Liberatorie verificate prima di pubblicare; nell'archivio storico le foto di minori vanno riviste prima della ripubblicazione, non caricate in blocco |
| Uso del marchio e del font AC | Medio | Chiedere conferma al Centro nazionale prima che i grafici costruiscano l'identità |
| Due grafici che lavorano sullo stesso staging si sovrascrivono | Medio | Divisione per aree (uno sui template, uno sui pattern/pagine), export e commit frequenti |
| Il PoC headless rallenta il lancio | Medio | Timebox rigido di 3 giorni, dopo la fase 2, su branch separato |

**Punti aperti da chiudere con la Presidenza:**
1. Chi pubblica i contenuti e con quale flusso di approvazione
2. Chi è il secondo referente tecnico oltre a me
3. Autorizzazione all'uso di logo, font e materiali del Centro nazionale
4. Liberatorie per le foto, in particolare dell'ACR
5. Titolare del trattamento dati e testo dell'informativa privacy
6. Account Google (Drive per i backup, Analytics, YouTube) intestati all'associazione e non a una persona

---

## 11. Prossime tre azioni

1. **Verificare il piano Aruba** (staging, SFTP, PHP, spazio) — è ciò che sblocca tutto il resto
2. **Creare il repository** con lo scheletro di tema e plugin e la pipeline di deploy
3. **Consegnare alla Presidenza l'elenco dei contenuti richiesti**, con scadenza, perché arrivino mentre costruiamo

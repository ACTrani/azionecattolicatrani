# azionecattolicatrani.it

Sito pubblico dell'**Azione Cattolica – Diocesi di Trani-Barletta-Bisceglie**.

Questo repository conserva il **sito storico** (PHP legacy, ~2004–2018) e l'ambiente
per farlo girare in locale. Serve da archivio e da riferimento per la **riscrittura
da zero** del sito.

> ⚠️ Il sito non è più online: l'hosting Aruba è decaduto per mancato rinnovo e
> **il database di produzione è andato perso** senza backup. Quello che resta è il
> codice e i file statici che vedi qui.

---

## Il nuovo sito

La riscrittura è in corso, in questo stesso repository. Il piano è in
**[`piano-di-lavoro-nuovo-sito.md`](piano-di-lavoro-nuovo-sito.md)**; i contenuti
che servono e che ancora mancano sono elencati in
**[`CONTENUTI-DA-RACCOGLIERE.md`](CONTENUTI-DA-RACCOGLIERE.md)**.

Sono state costruite **due tracce**, con gli stessi contenuti, perché il team
scelga guardando due cose vere invece che due descrizioni:

| | Traccia A — WordPress | Traccia B — WordPress headless + Astro |
|---|---|---|
| Dove | [`wordpress/`](wordpress/README.md) | [`poc-astro/`](poc-astro/) |
| Avvio | `cd wordpress && ./bin/avvia.sh` → http://localhost:8081 | `cd poc-astro && npm run dev` → http://localhost:4321 |
| In rete | — | https://actrani.github.io/azionecattolicatrani/ |
| Per i grafici | Editor del sito di WordPress, esportazione in file con *Crea tema a blocchi* | File CSS e componenti Astro |
| Nota | è la traccia destinata alla produzione | serve a valutare, non a lanciare |

I 29 eventi presenti in entrambe le tracce sono **reali**: vengono da
`materiali/programmazione-diocesana-2026-2027.xlsx`. Notizie, documenti e testi
istituzionali sono invece **inventati**, e vanno sostituiti.

---

## Cosa c'è dentro

| Percorso | Cosa è |
|---|---|
| `www.azionecattolicatrani.it/` | La document root del sito storico: codice + contenuti statici |
| `docker/`, `docker-compose.yml` | Ambiente locale per eseguire il sito legacy (PHP 5.6 + MariaDB) |
| `CLAUDE.md` | Documentazione tecnica dettagliata dell'architettura legacy |
| `ARCHIVIO-ESCLUSI.md` | Elenco dei file **non** presenti in git (troppo grandi o riservati) |
| `wordpress/` | Il nuovo sito, traccia A: ambiente locale, tema a blocchi, plugin |
| `poc-astro/` | Il nuovo sito, traccia B: prototipo Astro |
| `materiali/` | Materiali forniti dall'associazione (loghi, programmazione) |

## Avvio del sito storico in locale

Richiede un daemon Docker in funzione (su questa macchina: Docker Desktop).

```bash
docker compose up -d --build     # sito su http://localhost:8080 — forum su /acforum/
docker compose down              # stop
docker compose down -v && docker compose up -d   # azzera il DB e ri-esegue il seed
```

Login amministratore locale (SMF + pannello MkPortal): `admin` / `admin123`.

Le credenziali DB in `docker-compose.yml` e `acforum/Settings.php` sono **fittizie e
valide solo in locale** (`mkportal`/`mkportal`). Quelle di produzione sono state
rimosse e non stanno in questo repository.

---

## L'architettura storica in due righe

Due applicazioni PHP che condividono un solo database MySQL:

- **MkPortal** (CMS del 2004–2006) → homepage e contenuti, in `mkportal/`
- **SMF 1.1** (Simple Machines Forum) → utenti, sessioni, forum, in `acforum/`

MkPortal non ha utenti né connessione DB propri: a ogni richiesta carica SMF tramite
un *board driver* e ne riusa membri, sessione e connessione MySQL. Il dettaglio
completo (flusso di richiesta, moduli, blocchi, configurazione) è in **`CLAUDE.md`**.

Il codice usa le funzioni `mysql_*` deprecate: **non gira su PHP 7+/8+** senza
modifiche. È per questo che l'ambiente locale è fissato a PHP 5.6.

---

## Il database è stato ricostruito

Non esistendo dump, lo schema in `docker/initdb/` è stato **ricostruito da zero**:
ha la struttura completa ma **nessun contenuto storico**. In dettaglio:

- `01_smf_schema.sql` — schema SMF 1.1.21 dall'installer ufficiale, con i
  `{$placeholder}` risolti
- `02_mkportal_schema.sql` — le 26 tabelle `mkp_*` + dati iniziali, estratte dallo
  `step4()` dell'installer MkPortal (`github.com/lupomeo/mkportal`)
- `03_mkportal_stat_rss.sql` — `mkp_stat` e `mkp_rss`, ricostruite dalle query del codice
- `04_schema_fixes.sql` — colonne che il codice 1.2 usa ma l'installer 1.1 non crea
- `05_admin.sql` — l'utente amministratore locale

Se emergono altri errori "Unknown column" navigando il sito, la correzione va aggiunta
in `04_schema_fixes.sql`.

---

## Note per la riscrittura

Cosa questo repository ti dà per rifare il sito:

1. **I contenuti editoriali superstiti.** Le cartelle statiche dentro
   `www.azionecattolicatrani.it/` (anni `2011-2012`…`2016-2017`, eventi come
   `fiera2007`, `fieradiesserci2011`, `campiscuola_2012`, sezioni `ACR`, `adulti`,
   `giovani`, `adesione`, `unitario`, più `immagini/`, `loghi/`, `files/`,
   `Materiale da scaricare/`) sono HTML, PDF e foto. Persa la base dati, **sono
   l'unica copia rimasta** di buona parte dei contenuti: vanno trattati come materiale
   d'archivio da recuperare, non come codice.

2. **La mappa delle funzionalità.** I moduli MkPortal in `mkportal/modules/`
   (`contents`, `news`, `blog`, `downloads`, `gallery`, `reviews`, `quote`, `search`,
   `chat`, `topsite`, `urlobox`) e i blocchi in `mkportal/blocks/` dicono cosa il sito
   faceva. Utile per decidere cosa vale la pena riportare e cosa no.

3. **Gli URL storici.** Il sito indirizzava le pagine con `index.php?ind=<modulo>`.
   Se conta preservare i link esistenti, serviranno dei redirect nel nuovo sito.

Il nuovo sito **non** deve ereditare il codice legacy: PHP 5.6, `mysql_*` e MkPortal
sono fuori supporto da anni. Qui c'è il *cosa*, non il *come*.

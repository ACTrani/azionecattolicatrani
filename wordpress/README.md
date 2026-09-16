# WordPress in locale — traccia A

Questa è la **traccia A**: il WordPress monolitico, quello destinato ad andare in
produzione su Aruba. Nella cartella `poc-astro/` c'è la traccia B, lo stesso sito
fatto con WordPress headless + Astro.

I due ambienti mostrano **gli stessi contenuti**: gli eventi vengono entrambi
dalla programmazione diocesana 2026/2027. Il confronto si fa su come si lavora,
non su cosa si vede.

---

## Come si avvia

Serve Docker in funzione (su questo Mac: aprire Docker Desktop).

```sh
cd wordpress
./bin/avvia.sh          # alza i container e allestisce il sito
```

La prima volta ci mette qualche minuto: scarica WordPress, la lingua italiana e
il plugin *Crea tema a blocchi*. Alla fine stampa gli indirizzi.

| | |
|---|---|
| Sito | http://localhost:8081 |
| Bacheca | http://localhost:8081/wp-admin/ |
| Accesso | `admin` / `admin123` — **solo in locale** |

Le porte sono 8081 e 3308, diverse da quelle del vecchio sito (8080 e 3307):
i due ambienti possono girare insieme.

```sh
docker compose down     # ferma tutto, i dati restano
./bin/azzera.sh         # cancella database e media e riparte da zero
./bin/allestisci.sh     # rilancia solo l'allestimento (idempotente)
```

---

## Cosa c'è dentro

```
wordpress/
├── docker-compose.yml        WordPress 6.8 + PHP 8.3 + MariaDB 11.4 + WP-CLI
├── bin/                      avvio, allestimento, semina dei contenuti
├── contenuti-demo/           i contenuti del prototipo Astro, in JSON
└── wp-content/
    ├── themes/ac-trani/      IL TEMA — dei grafici
    └── plugins/ac-trani-core/ IL PLUGIN — del backend
```

Su Git stanno **solo tema e plugin**. Il nucleo di WordPress, i media e il
database vivono nei volumi Docker: non si versionano e non si copiano.

---

## I tre canali

È la regola su cui è costruito tutto il piano di lavoro. Vale qui come in
produzione.

| Canale | Contiene | Di chi è | Come viaggia |
|---|---|---|---|
| `wp-content/themes/ac-trani/` | template, parti, pattern, `theme.json` | **grafici** | *Crea tema a blocchi* → file → Git |
| `wp-content/plugins/ac-trani-core/` | tipi di contenuto, campi, blocchi | **backend** | Git |
| database | contenuti, media, utenti | **redazione** | non viaggia mai |

> **Lo staging serve per il design e la struttura. I contenuti si scrivono in
> produzione.** Il database non si copia mai da staging a produzione.

---

## Per chi si occupa della grafica

Tutto passa da **Aspetto → Editor**. Non serve toccare un file.

- **Stili** → colori, caratteri, spaziature. Sono le voci di `theme.json`:
  cambiarle qui cambia tutto il sito in modo coerente.
- **Template** → la struttura delle pagine: home, evento singolo, archivio
  eventi, archivio documenti, pagina, articolo, 404.
- **Parti** → testata e piede.
- **Pattern** → composizioni pronte, nella categoria *Azione Cattolica Trani*.

Quando il lavoro è a posto: **Aspetto → Crea tema a blocchi → Esporta**. Scarica
uno zip con il tema aggiornato; il contenuto va in
`wp-content/themes/ac-trani/` e si committa. Da lì il deploy è automatico.

Finché non si esporta, **il lavoro vive solo nel database locale**: nessun altro
lo vede e un `./bin/azzera.sh` lo cancella.

I cinque blocchi che il plugin mette a disposizione (elenco eventi, scheda
evento, tessere settori, elenco documenti, notizie) si inseriscono come
qualsiasi altro blocco e si regolano dalla barra laterale: sono elencati in
[`wp-content/plugins/ac-trani-core/CONTRATTO.md`](wp-content/plugins/ac-trani-core/CONTRATTO.md).

---

## Per chi si occupa del backend

Il plugin `ac-trani-core` registra tipi di contenuto, tassonomie, campi, blocchi
dinamici ed export `.ics`. Non contiene CSS: il contratto con il tema è scritto
in `CONTRATTO.md`.

```sh
# WP-CLI
docker compose run --rm cli plugin list
docker compose run --rm cli post list --post_type=evento
docker compose run --rm cli db export - > /tmp/backup.sql

# API REST (è la porta della traccia B)
curl 'http://localhost:8081/wp-json/wp/v2/eventi?per_page=3' | jq '.[].meta'
```

---

## Cosa è vero e cosa no

- **Veri**: i 29 eventi, presi da `materiali/programmazione-diocesana-2026-2027.xlsx`.
- **Inventati**: notizie, documenti, testi delle pagine istituzionali, recapiti.
  Servono a far vedere il sito pieno — vanno tutti sostituiti. L'elenco di ciò
  che manca è in [`CONTENUTI-DA-RACCOGLIERE.md`](../CONTENUTI-DA-RACCOGLIERE.md).
- I documenti **non hanno il file allegato**: nel prototipo Astro il percorso era
  finto. Si caricano dalla Libreria media quando arriveranno i PDF veri.
- Le date di notizie e documenti che cadevano nel futuro sono state riportate a
  oggi: WordPress programma i contenuti con data futura invece di pubblicarli, e
  metà archivio sarebbe rimasto invisibile.

---

## Differenze rispetto alla produzione

Questo ambiente **non è** una copia della produzione. In particolare:

- l'utente `admin` con password breve qui va bene e là no: in produzione servono
  account nominali, password lunghe e nessun utente chiamato «admin»;
- `WP_DEBUG` è acceso e i motori di ricerca sono tenuti fuori (`blog_public 0`);
- le credenziali del database sono usa e getta e stanno nel `docker-compose.yml`,
  cosa che in produzione non si fa mai;
- manca tutto ciò che riguarda il vero hosting: certificato, backup, cache,
  cookie banner, analytics.

# Prototipo del nuovo sito AC Trani – Barletta – Bisceglie

Prototipo navigabile del sito diocesano, costruito con [Astro](https://astro.build).
Serve a due cose:

1. **Far vedere e discutere il sito** con la Presidenza e con il team grafico, su un
   link reale invece che su una descrizione a parole.
2. Essere la **traccia B** del piano di lavoro (frontend statico che legge da un CMS),
   da confrontare con la traccia A (WordPress monolitico).

> **Sui contenuti:** gli **eventi sono veri**, presi dalla programmazione diocesana
> 2026/2027 (`../materiali/programmazione-diocesana-2026-2027.xlsx`). ⚠️ Tutto il resto — notizie,
> documenti, nomi della Presidenza, testi di presentazione — è ancora **inventato**.
> Cosa serve per completarlo: `../CONTENUTI-DA-RACCOGLIERE.md`.

---

## Farlo girare in locale

Serve Node 20 o superiore (qui sviluppato con Node 25).

```bash
cd poc-astro
npm install
npm run dev      # http://localhost:4321
```

Altri comandi: `npm run build` (genera `dist/`), `npm run preview` (serve la build),
`npm run check` (controllo dei tipi).

## Pubblicarlo su GitHub Pages

C'è già il workflow `.github/workflows/poc-pages.yml`: pubblica a ogni push su `main`
che tocchi `poc-astro/`. Prima che funzioni serve **un passaggio manuale, una volta sola**:

> **Settings → Pages → Build and deployment → Source: «GitHub Actions»**

Poi il sito compare su https://actrani.github.io/azionecattolicatrani/ — il workflow
ricava il percorso dal nome del repository, quindi un'eventuale rinomina non richiede
modifiche al codice.

Il repository è pubblico: su GitHub Pages questo basta, non serve alcun piano a pagamento.
Se in futuro tornasse privato, Pages richiederebbe un piano a pagamento; le alternative
gratuite, entrambe da collegare allo stesso repository, sono **Cloudflare Pages** e
**Netlify** (comando di build `npm run build`, cartella `poc-astro/dist`).

## Come è fatto

```
src/
  content.config.ts     ← IL MODELLO DATI: rispecchia i CPT WordPress
  content/
    eventi/*.md         ← un file = un evento
    notizie/*.md        ← notizie e comunicati ufficiali
    documenti/*.md      ← schede dei documenti scaricabili
  data/
    sito.ts             ← recapiti, presidenza, anno associativo
    settori.ts          ← i sei settori, con la loro tinta
  lib/
    contenuti.ts        ← UNICO punto di accesso ai contenuti
    date.ts             ← formattazione date in italiano
    ics.ts              ← generazione dei file calendario
  styles/
    tokens.css          ← ⭐ colori, font e spaziature: si parte da qui
    global.css
  components/           ← intestazione, piè di pagina, carte
  layouts/Base.astro
  pages/                ← una pagina per file
```

### Due file che contano più degli altri

- **`src/styles/tokens.css`** — colori, tipografia e spaziature del sito. Cambiando qui
  cambia tutto, in modo coerente. Ogni token corrisponde a una voce del futuro
  `theme.json` di WordPress.
- **`src/lib/contenuti.ts`** — l'unico punto in cui il sito legge i contenuti. Per farlo
  leggere dalla REST API di WordPress si riscrive **solo questo file**: pagine e
  componenti restano identici.

## Aggiungere un evento

Un nuovo file in `src/content/eventi/`, per esempio `campo-unitario.md`:

```markdown
---
titolo: "Campo unitario diocesano"
sommario: "Tre giorni di campo per tutta l'associazione."
dataInizio: 2027-08-20
dataFine: 2027-08-22
orario: "dalle 17:00 del venerdì"
luogo:
  nome: "Casa per ferie"
  comune: "Monte Sant'Angelo"
settore: unitario
annoAssociativo: "2026/2027"
inEvidenza: false
---

Il testo lungo dell'evento, in Markdown.
```

`settore` accetta: `unitario`, `adulti`, `giovani`, `acr`, `msac`, `mlac`.
Gli eventi si ordinano da soli per data e passano da soli da «prossimi» a «passati».

## Cosa c'è già e cosa no

**Fatto**
- Home con prossimo appuntamento in evidenza, eventi, settori, notizie, documenti
- Eventi: elenco filtrabile per settore (il filtro finisce nell'URL, quindi è
  condivisibile), pagina di dettaglio, export `.ics` per singolo evento e calendario
  completo sottoscrivibile
- Documenti: ricerca testuale e filtri per settore, tipo e anno associativo
- Notizie, con distinzione fra comunicati ufficiali e notizie ordinarie
- Pagine associazione, adesione, contatti
- Responsive, navigabile da tastiera, font serviti dal nostro dominio (nessuna
  chiamata a Google dal browser del visitatore)

**Non fatto, e perché**
- **Nessuna fotografia.** Non abbiamo immagini di cui siano chiari i diritti, e le foto
  dell'ACR richiedono le liberatorie dei minori. Il design regge senza, ma va rivisto
  quando arrivano le foto vere.
- **Nessun modulo di contatto**: previsto dopo il primo lancio.
- **Cookie banner e analytics**: non servono in un prototipo senza tracciamento.
- Il sito è pubblicato con `noindex`: non deve finire su Google prima di essere ufficiale.

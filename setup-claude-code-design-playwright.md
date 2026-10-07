# Setup Claude Code: skill di design + Playwright MCP

Istruzioni per Claude Code. Esegui i passi nell'ordine, verifica ogni installazione e riportami l'esito alla fine.

## Obiettivo

Installare:

1. Tre skill di design: `emil-design-eng` (Emil Kowalski), `impeccable` (Paul Bakaus), `design-taste-frontend` (Leonxlnx, "Taste Skill")
2. Il server MCP Playwright ufficiale Microsoft (`@playwright/mcp`)
3. La skill `just-scrape` (ScrapeGraph AI) per scraping e ricerca web da riga di comando

Il connettore Figma MCP è già collegato lato Claude.ai e non richiede passi qui.

## Prima di iniziare

- Controlla la versione di Node.js: serve Node 20 o successivo.

```bash
node -v
```

- Sono skill di terze parti. Dopo l'installazione, apri il `SKILL.md` di ciascuna e dammi un riassunto di cosa fa prima di usarla.
- Usa i repository ufficiali indicati sotto. In giro ci sono fork e copie (ad esempio di Taste Skill): ignorali.

## 1. Skill di design

### 1.1 Emil Kowalski, `emil-design-eng`

Repo: `emilkowalski/skill`. Rivede il codice UI con tabelle prima/dopo, segnala errori comuni nelle animazioni (es. ease-in, animazioni su azioni ad alta frequenza) e applica il metodo di Emil per decidere cosa animare e a che velocità.

```bash
npx -y skills add emilkowalski/skill --skill emil-design-eng --agent claude-code
```

Installazione manuale alternativa: copiare `SKILL.md` in `~/.claude/skills/emil-design-eng/SKILL.md` (su Windows `%USERPROFILE%\.claude\skills\emil-design-eng\SKILL.md`).

### 1.2 Impeccable, `impeccable`

Repo: `pbakaus/impeccable`. Una skill unica con molti sub-comandi (init, craft, shape, critique, audit, polish, animate, typeset, layout e altri) e regole contro i pattern tipici del design generato dall'AI (font abusati, gradienti viola, card annidate, easing "bounce").

Opzione A, dalla root del progetto:

```bash
npx impeccable install
```

Opzione B, via skills CLI:

```bash
npx skills add pbakaus/impeccable --skill impeccable
```

Opzione C, plugin dentro Claude Code:

```
/plugin marketplace add pbakaus/impeccable
```

Poi apri `/plugin` e installa Impeccable dall'elenco.

Dopo l'installazione, nel progetto lancia:

```
/impeccable init
```

### 1.3 Taste Skill, `design-taste-frontend`

Repo ufficiale: `Leonxlnx/taste-skill`. Con `--skill` va usato il nome del campo `name:` nel frontmatter (`design-taste-frontend`), non il nome della cartella.

```bash
npx skills add https://github.com/Leonxlnx/taste-skill --skill "design-taste-frontend"
```

Note:

- La versione attuale è la v2 (sperimentale). Il comportamento originale è disponibile come `design-taste-frontend-v1`.
- In cima al file della skill ci sono tre impostazioni regolabili: `DESIGN_VARIANCE`, `MOTION_INTENSITY`, `VISUAL_DENSITY`.

### 1.4 Ordine d'uso consigliato

1. **Taste** per costruire la base dell'interfaccia
2. **Impeccable** per mantenere coerenza di brand e rifinire
3. **emil-design-eng** come passaggio finale su micro-interazioni e transizioni

## 2. Playwright MCP

Server ufficiale Microsoft, pacchetto npm `@playwright/mcp`. Permette all'agente di aprire URL, cliccare, compilare form, leggere l'albero di accessibilità, la console e le richieste di rete, e fare screenshot. Il browser viene scaricato automaticamente alla prima esecuzione.

### 2.1 Registrazione

Per tutti i progetti (scope utente):

```bash
claude mcp add --scope user playwright -- npx -y @playwright/mcp@latest
```

Solo per il progetto corrente (scrive `.mcp.json` nella root):

```bash
claude mcp add --scope project playwright -- npx -y @playwright/mcp@latest
```

### 2.2 Alternativa: `.mcp.json` a mano

```json
{
  "mcpServers": {
    "playwright": {
      "command": "npx",
      "args": ["-y", "@playwright/mcp@latest"]
    }
  }
}
```

### 2.3 Alternativa: plugin

```
/plugin install playwright@claude-plugins-official
```

### 2.4 Riavvio e verifica

I server MCP vengono caricati solo all'avvio di Claude Code. Dopo la registrazione:

1. Riavvia Claude Code
2. Lancia `/mcp` e controlla che `playwright` sia connesso
3. Test: *"Usa Playwright per aprire https://example.com, fai uno snapshot di accessibilità e dimmi il titolo principale"*

Se non nomini Playwright, Claude Code a volte ripiega su comandi bash.

### 2.5 Risoluzione problemi

- Il browser non parte: `npx playwright install chromium`
- Linux, librerie di sistema mancanti: `npx playwright install-deps`
- Per installare solo alcuni browser: `npx playwright install chromium` (oppure `firefox`, `webkit`)
- Il server risulta avviato ma i tool non compaiono: riavvia la sessione e controlla di nuovo `/mcp`

## 3. just-scrape (ScrapeGraph AI)

Repo: `ScrapeGraphAI/just-scrape`. Skill per agenti di coding che permette di fare scraping di un sito, convertire pagine di documentazione in markdown, cercare sul web ed estrarre risultati strutturati, controllare il saldo crediti e consultare lo storico delle richieste, tutto tramite la CLI `just-scrape`.

### 3.1 Installa la CLI

```bash
npm install -g just-scrape
```

### 3.2 Installa la skill

```bash
npx skills add https://github.com/ScrapeGraphAI/just-scrape --skill just-scrape --agent claude-code
```

La documentazione ufficiale riporta anche la variante con bun, equivalente:

```bash
bunx skills add https://github.com/ScrapeGraphAI/just-scrape
```

Pagina della skill: https://skills.sh/scrapegraphai/just-scrape/just-scrape

### 3.3 Chiave API

Serve un account ScrapeGraph AI con una chiave API. **Non scrivere la chiave in questo file, nei file del progetto o nei commit.** Chiedimi di impostarla io nel profilo della shell:

```bash
export SGAI_API_KEY="..."
```

Con la variabile impostata, la skill la legge in automatico.

### 3.4 Uso e comandi

Gli agenti usano `just-scrape` con `--json`, per avere output pulito e leggero in token (niente spinner o banner). Comandi principali indicati nella documentazione:

```bash
just-scrape extract <url> -p "<prompt>" --json     # estrazione strutturata con AI
just-scrape search "<query>" --json                # ricerca web ed estrazione dai risultati
just-scrape scrape <url> --json                    # pagina in markdown (o html, screenshot, links, ...)
just-scrape crawl <url> --json                     # crawling di più pagine
just-scrape credits --json                         # saldo crediti
just-scrape validate --json                        # stato della chiave
```

La documentazione ha avuto nomi di comando diversi nel tempo (ad esempio `smart-scraper` e `search-scraper` nelle versioni precedenti). Prima di usarli controlla quelli della versione installata:

```bash
just-scrape --help
```

Per ottenere output tipizzato si può passare `--schema` con un JSON schema.

### 3.5 Facoltativo: promemoria in `CLAUDE.md`

Se ti dico di farlo, aggiungi al `CLAUDE.md` del progetto una sezione che spiega che il progetto usa `just-scrape` per lo scraping, con i comandi sopra, così Claude Code lo sceglie da solo.

### 3.6 Attenzione

- Lo scraping consuma crediti ScrapeGraph AI: controlla il saldo con `just-scrape credits --json` prima di crawl grandi.
- Rispetta i termini di servizio e il `robots.txt` dei siti. Chiedimi conferma prima di fare scraping massivo o su siti che non conosco.
- Alternativa: ScrapeGraph AI offre anche un server MCP, utile per un'integrazione più profonda (ad esempio in Claude Desktop). Per ora non serve.

## 4. Verifica finale

Al termine, riportami:

- [ ] Versione di Node.js
- [ ] Le tre skill di design e `just-scrape` presenti in `~/.claude/skills/` (o `.claude/skills/` del progetto), con una riga su cosa fa ciascuna
- [ ] `/mcp` che mostra `playwright` connesso
- [ ] Esito del test su example.com
- [ ] `just-scrape --help` funzionante e se `SGAI_API_KEY` è impostata (solo sì/no, senza mostrare il valore)
- [ ] Eventuali errori o passaggi saltati

## Fonti

- Emil Kowalski skill: https://claudemarketplaces.com/skills/emilkowalski/skill/emil-design-eng
- Impeccable: https://github.com/pbakaus/impeccable (documentazione: https://impeccable.style)
- Taste Skill: https://github.com/Leonxlnx/taste-skill
- Playwright MCP: repo `microsoft/playwright-mcp`, pacchetto npm `@playwright/mcp`
- just-scrape: https://docs.scrapegraphai.com/services/cli/ai-agent-skill e https://github.com/ScrapeGraphAI/just-scrape

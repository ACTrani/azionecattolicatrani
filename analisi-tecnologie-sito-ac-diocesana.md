# Sito web Azione Cattolica diocesana: analisi delle tecnologie

**Arcidiocesi di Trani – Barletta – Bisceglie**
*Documento di supporto per l'incontro di progettazione. Ruolo: backend (Andrea)*

---

## 1. Obiettivo del sito

Il sito deve soprattutto:

- pubblicare **notizie** e comunicati dei settori (Adulti, Giovani, ACR, MSAC, MLAC);
- pubblicare e gestire gli **eventi** diocesani;
- archiviare e rendere scaricabili i **documenti** (programmazioni, sussidi, verbali, moduli).

Si tratta quindi di un **sito di contenuti**. Il requisito chiave è che i contenuti possano essere gestiti da **volontari non tecnici**.

---

## 2. Situazione attuale

- Oggi l'AC diocesana **non ha un sito proprio**. Sul portale nazionale c'è solo una scheda con i contatti della Presidenza diocesana: [azionecattolica.it/diocesi/trani-barletta-bisceglie](https://azionecattolica.it/diocesi/trani-barletta-bisceglie/).
- Esiste già il dominio **azionecattolicatrani.it**, usato per l'email `info@azionecattolicatrani.it`.
- Il **portale nazionale AC** è realizzato in **WordPress + Elementor**.
- **Attenzione:** alcune pagine del sito dell'Arcidiocesi contengono **link spam** (scommesse e slot) inseriti da terzi. È il segno tipico di un WordPress compromesso o non aggiornato. Per un progetto gestito da volontari **la manutenzione conta più della tecnologia scelta**.

---

## 3. Raccomandazione principale

> **Non sviluppare un backend da zero.**

Un backend su misura (ad esempio Spring Boot) obbligherebbe a ricostruire funzioni che un CMS offre già pronte: login, ruoli e permessi, editor di testo, upload di file e immagini, pannello di amministrazione.

---

## 4. Opzioni

### Opzione A: Headless CMS + frontend statico *(consigliata)*

| Livello | Tecnologia | Note |
|---|---|---|
| Backend / CMS | **Strapi** (o Directus) | Node.js, quasi solo configurazione; pannello admin, ruoli, API REST, gestione media inclusi |
| Database | **PostgreSQL** | |
| Frontend | **Astro** | Pagine statiche, molto veloci, ottime per la SEO |
| Hosting frontend | Netlify / Cloudflare Pages | Piani gratuiti adeguati per un sito di questo tipo |
| Hosting CMS | VPS piccolo oppure Cloud Run (GCP) | Da valutare in base al budget |
| File / documenti | Media library del CMS, eventualmente storage a oggetti (GCS, R2, S3) | |

**Flusso:** l'editor pubblica nel CMS → un webhook avvia la rigenerazione del sito → il sito statico viene aggiornato.

**Vantaggi**
- Sicurezza maggiore: il sito pubblico è statico, il CMS può restare non esposto o protetto.
- Prestazioni e SEO eccellenti.
- Ruoli per settore (es. un editor per ACR, uno per Giovani).
- Codice versionato su Git, pipeline CI/CD.

**Svantaggi**
- Serve almeno una persona tecnica per la manutenzione.
- Ci sono due componenti da gestire (CMS + frontend).

### Opzione B: WordPress classico

**Vantaggi**
- Nessuno sviluppo; molti volontari lo conoscono già.
- Stessa tecnologia del portale nazionale AC.

**Svantaggi**
- Richiede aggiornamenti costanti di core, temi e plugin, oltre a backup regolari.
- Senza manutenzione è esposto a compromissioni (vedi caso citato sopra).

**Criterio di scelta:** se nessuno di tecnico potrà seguire il sito nel tempo, conviene **WordPress gestito**. Se c'è un referente tecnico, conviene l'**Opzione A**.

---

## 5. Strapi o Directus

| | Strapi | Directus |
|---|---|---|
| Linguaggio | Node.js | Node.js |
| Definizione modelli | **Code-first**: file nel repository | Principalmente da interfaccia grafica (schema esportabile) |
| Versionamento su Git | Naturale | Possibile, meno immediato |
| Sviluppo assistito da AI | **Più adatto**: i modelli sono generabili come codice | Meno naturale |

Con uno sviluppo supportato da Claude, **Strapi** è preferibile, perché i modelli dati vivono nel codice.

**Nota:** Strapi ha cambiato in modo significativo le API tra v4 e v5. Verificare sempre la versione installata e la relativa documentazione.

---

## 6. E Java?

Java/Spring Boot va considerato **solo per funzioni realmente custom**, ad esempio:

- iscrizioni a campi ed eventi con logiche particolari;
- area riservata soci;
- integrazioni specifiche.

In quel caso il servizio Java si affianca al CMS come microservizio, **senza sostituirlo**.

---

## 7. Frontend: Angular / React?

Per un sito di contenuti **Angular e React sono eccessivi**: aggiungono complessità e, senza SSR, peggiorano la SEO.

**Astro** è la scelta più semplice ed efficace. Se servono parti interattive (es. calendario eventi filtrabile), si possono inserire **componenti React solo dove servono**. In alternativa, se il team preferisce React, si può usare **Next.js**.

---

## 8. Modello dati iniziale (bozza)

- **Notizia**: titolo, slug, data, immagine, testo, settore, tag, allegati
- **Evento**: titolo, data/ora inizio e fine, luogo, descrizione, settore, locandina, link iscrizione
- **Documento**: titolo, file, categoria, settore, anno associativo
- **Settore**: nome (Adulti, Giovani, ACR, MSAC, MLAC, Unitario), descrizione, referenti
- **Tag / Categoria**

---

## 9. Sviluppo con Claude come supporto

Claude può supportare:

- progettazione del modello dati;
- setup con `docker-compose` (CMS + PostgreSQL), ruoli e permessi;
- sviluppo del frontend Astro (layout, pagine, chiamate API, SEO);
- deploy e CI/CD (Cloud Build, Cloud Run, webhook di rebuild);
- debug a partire da errori e log.

**Accorgimenti**
- Comunicare sempre le **versioni** delle librerie installate.
- In caso di comportamenti inattesi, fornire la **pagina di documentazione** aggiornata.
- Per lavorare direttamente sul repository è consigliato **Claude Code**.

---

## 10. Domande da porre all'incontro

1. **Chi pubblica** i contenuti e con che frequenza? Ci sarà un editor per settore?
2. **Chi manterrà** il sito nei prossimi anni, considerando il ricambio dei volontari?
3. Che **budget** c'è per hosting e dominio?
4. Serve un'**area riservata** o servono **moduli di iscrizione**?
5. Come gestire **foto e dati dei minori** dell'ACR (consensi GDPR)?
6. Serve un collegamento con i **social** o con **Google Calendar** per gli eventi?
7. Chi si occupa del **frontend** e della **grafica**?
8. Il dominio **azionecattolicatrani.it** è disponibile per il sito? Chi lo gestisce?

---

## 11. Prossimi passi

1. Scegliere tra Opzione A e Opzione B in base alle risposte sulla manutenzione.
2. Definire il modello dati definitivo.
3. Preparare un prototipo (CMS + home page + elenco notizie).
4. Definire hosting, dominio e pipeline di deploy.

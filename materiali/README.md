# Materiali di partenza

Documenti forniti dall'associazione da cui nascono i contenuti del sito. **Non fanno
parte del sito pubblicato**: sono le fonti da cui i contenuti vengono estratti.

| File | Cosa contiene | Dove è finito |
|---|---|---|
| `programmazione-diocesana-2026-2027.xlsx` | Il calendario diocesano 2026/2027: 29 appuntamenti da settembre 2026 ad agosto 2027, con data, città, parrocchia e stato di conferma | Trasformato negli eventi del prototipo, in `poc-astro/src/content/eventi/` |
| `logo ac trani.png` | Il marchio a colori, 696×696 px, su fondo bianco pieno | Scontornato e ottimizzato in `poc-astro/src/assets/logo-ac-trani.png` |
| `logo ac trani bianco.png` | Il marchio in bianco su fondo trasparente, 244×179 px | Ottimizzato in `poc-astro/src/assets/logo-ac-trani-bianco.png` |

## Note sulla programmazione 2026/2027

Verificata riga per riga (giorno della settimana contro data: tornano tutte). Rilievi
aperti, con il dettaglio in [`../CONTENUTI-DA-RACCOGLIERE.md`](../CONTENUTI-DA-RACCOGLIERE.md):

- il blocco di luglio è intitolato «GIUGNO 2027» per la seconda volta (il *Sentiero
  Frassati* del «5 LUNEDI'» cade a luglio, non a giugno);
- quattro righe incomplete: due appuntamenti senza nome, uno senza data, uno senza nome;
- la colorazione che dovrebbe indicare il settore non è coerente, quindi i settori nel
  prototipo sono dedotti dal nome dell'evento e vanno confermati;
- refusi: «SIRITUALITà», «GIORNATA DELLA PAMIGLIA».

Il foglio resta qui **come ricevuto**: le correzioni si fanno sui contenuti del sito,
non su questo file, così resta chiaro cosa è arrivato e cosa abbiamo interpretato.

## Note sui loghi

Vale la stessa regola: gli originali restano qui intatti, le versioni pronte per il web
stanno in `poc-astro/src/assets/`.

**Cosa è stato fatto.** Il logo a colori arriva su un **quadrato bianco pieno**, non
trasparente: appoggiato sul fondo color pietra del sito si vedeva il riquadro. Il bianco
esterno è stato reso trasparente partendo dai bordi dell'immagine, così i bianchi
*interni* — la «a», la croce, la scritta — restano intatti perché il riempimento non li
raggiunge. Il contorno è stato ricostruito (opacità graduale e colore ripreso dal pixel
pieno più vicino), altrimenti sul blu scuro del piede pagina restava un alone chiaro.
Poi ritaglio ai margini del segno e ricompressione: da 304 kB a 93 kB, senza perdita.
Il logo bianco era già trasparente: solo rifilato e ricompresso, da 40 kB a 16 kB.

**Formato.** Restano PNG. Astro genera da solo il WebP e le dimensioni che servono
(il marchio in testata pesa 4 kB), quindi non serve convertirli a mano. Non sono stati
vettorializzati: una ricalcatura automatica di un PNG con artefatti di compressione
peggiora il disegno invece di migliorarlo.

**Cosa manca ancora.** L'originale **vettoriale** (`.ai`, `.eps`, `.svg`, `.pdf`): oggi
il limite è il file a colori, 696 px, che regge fino a circa 700 px di larghezza e non
oltre. Serve per le stampe e per un eventuale uso grande sul sito. Inoltre nessuno dei
due file porta la dicitura diocesana: in testata il marchio è accostato alla scritta
«Trani · Barletta · Bisceglie» composta in tipografia. Se esiste una declinazione
diocesana ufficiale, va chiesta.

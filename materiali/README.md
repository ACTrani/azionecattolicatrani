# Materiali di partenza

Documenti forniti dall'associazione da cui nascono i contenuti del sito. **Non fanno
parte del sito pubblicato**: sono le fonti da cui i contenuti vengono estratti.

| File | Cosa contiene | Dove è finito |
|---|---|---|
| `programmazione-annuale-2026-2027.pdf` | La **programmazione annuale 2026/2027** della Presidenza diocesana (24 pagine, 12 settembre 2026): lettera della Presidente, Laboratorio diocesano della formazione, Centro studi, cammini e calendari di Adulti, Giovani e MSAC, ACR e MLAC, promozione associativa, Presidenza e Consiglio | **È la fonte attuale.** Eventi in `poc-astro/src/content/eventi/` e `wordpress/contenuti-demo/contenuti.json`; testi in `poc-astro/src/data/programmazione.ts`, `sito.ts`, `settori.ts` e nei pattern del tema WordPress |
| `programmazione-diocesana-2026-2027.xlsx` | Il primo calendario diocesano 2026/2027: 29 appuntamenti, con data, città, parrocchia e stato di conferma | **Superato dal PDF**: resta come riferimento di cosa era arrivato prima |
| `logo ac trani.png` | Il marchio a colori, 696×696 px, su fondo bianco pieno | Scontornato e ottimizzato in `poc-astro/src/assets/logo-ac-trani.png` |
| `logo ac trani bianco.png` | Il marchio in bianco su fondo trasparente, 244×179 px | Ottimizzato in `poc-astro/src/assets/logo-ac-trani-bianco.png` |

## Note sulla programmazione annuale (PDF)

Il PDF ha sostituito il foglio Excel e ne chiude quasi tutti i buchi: i nomi mancanti,
il LDF Giovani (aprile, Bisceglie), il mese del *Sentiero Frassati* (è il «Momento di
preghiera in onore di San Pier Giorgio Frassati», 5 luglio), i settori (ogni tabella
di settore segna con `*` e `**` gli appuntamenti unitari e della Pastorale giovanile,
e in celeste quelli MSAC). I giorni della settimana indicati tornano con le date.

Come è stato trasformato:
- un appuntamento presente in più tabelle è **un solo evento**, assegnato al settore
  *unitario* se la programmazione lo segna come tale;
- gli appuntamenti senza giorno preciso («nel mese di aprile», «6 o 13 novembre»)
  hanno una **data indicativa**: il sito mostra quel testo e non li mette nel `.ics`;
- i telefoni e le mail personali del documento **non sono pubblicati**;
- la lettera della Presidente è riportata per **estratti letterali**, non parafrasata.

I dubbi rimasti sono in [`../CONTENUTI-DA-RACCOGLIERE.md`](../CONTENUTI-DA-RACCOGLIERE.md).

## Note sul primo foglio Excel (superato)

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

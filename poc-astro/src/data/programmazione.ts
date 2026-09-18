/**
 * La programmazione diocesana dell'anno associativo 2026/2027.
 *
 * Fonte: «Programmazione annuale 2026/2027» della Presidenza diocesana
 * (`materiali/programmazione-annuale-2026-2027.pdf`). I testi sono ripresi dal
 * documento, accorciati dove serviva per il web; il calendario completo sta
 * negli eventi (`src/content/eventi/`), non qui.
 *
 * Nel tema WordPress lo stesso contenuto è il pattern
 * `ac-trani/programmazione-anno`: se cambia qui, va cambiato anche là.
 */
import type { SettoreSlug } from './settori';

export const icona = {
  titolo: 'Vino nuovo in otri nuovi',
  riferimento: 'Mc 2,18-22',
  citazione: '«Nessuno versa vino nuovo in otri vecchi, altrimenti il vino nuovo spaccherà gli otri… Ma vino nuovo in otri nuovi.»',
  citazioneRiferimento: 'Mc 2,22',
  testo: [
    'Nel nuovo anno associativo l’Azione Cattolica a livello nazionale riflette sul verbo «generare». Tra le pagine del Vangelo in cui Gesù ribalta la prospettiva dei discepoli c’è quella in cui alcuni si scandalizzano perché i suoi discepoli non digiunano: la tavola diventa il luogo della nuova alleanza, e questo rischia di disorientare i più osservanti.',
    'Gesù ci consegna una nuova immagine di discepolo: non più uomini e donne incastrati nel ritualismo, ma persone capaci di assaporare con gioia la presenza del Maestro e di guardare lontano senza paura del passato. La Gioia e la Bellezza — il vino e il vestito — vanno custodite in una continua novità.',
  ],
};

export const lettera = {
  firma: 'Maria Lanotte',
  ruolo: 'Presidente diocesana',
  /** Estratti letterali: il testo è firmato, quindi non si parafrasa. */
  paragrafi: [
    'Ogni nuovo anno è un invito ad accogliere il vino nuovo del Vangelo in otri nuovi, lasciandoci rinnovare dal Signore attraverso il cammino dell’Azione Cattolica. Con questo spirito, la Presidenza diocesana è lieta di affidarvi la Programmazione associativa annuale, con l’augurio che possa diventare uno strumento di accompagnamento per la formazione integrale di ogni aderente, dalla più tenera età a quella adultissima.',
    'È una proposta rivolta a tutti coloro che hanno a cuore il Vangelo: ragazzi, giovani, adulti, aderenti, simpatizzanti e quanti desiderano condividere un percorso di crescita umana e cristiana.',
    'Per questo la proposta che avete tra le mani non è un semplice calendario di appuntamenti. È un insieme di porte aperte, accessibili a tutti, attraverso le quali ciascuno può lasciarsi incontrare dal Signore, cambiare la propria vita e contribuire a rinnovare quella degli altri, diventando davvero vino nuovo in otri nuovi.',
    'Questa proposta non è conclusa. Ha bisogno della partecipazione di tutti per diventare vita vissuta, testimonianza concreta, Parola che continua a farsi carne nella storia.',
    'AppassioniAmoCI a questo cammino. Camminando insieme scopriremo che il Signore rinnoverà il nostro cuore, il nostro stile e il nostro modo di essere discepoli nella Chiesa e nel mondo.',
    'Buon anno associativo!',
  ],
};

export const paroleAnno = [
  {
    nome: 'Il verbo: generare',
    testo: 'Promuovere relazioni, processi e percorsi capaci di dare vita a nuove esperienze, aprendosi anche a realtà non ecclesiali e a persone di diverso credo, nella ricerca condivisa di nuovi orizzonti di senso.',
  },
  {
    nome: 'L’ambiente: la piazza',
    testo: 'Luogo dell’incontro, del dialogo e dell’impegno civile, dove contribuire a una cultura inclusiva capace di farsi carico delle sfide della democrazia e della partecipazione.',
  },
  {
    nome: 'Il triennio: costruttori della storia',
    testo: 'Il terzo anno del Laboratorio diocesano della formazione 2024–2027 ha per titolo «Costruttori della storia degli uomini».',
  },
  {
    nome: 'Il filo rosso: la corresponsabilità',
    testo: 'Generare corresponsabilità per costruire la storia degli uomini: uno stile che nasce dalla formazione, matura nella vita associativa e si esprime nella Chiesa e nella società.',
  },
];

/** Laboratorio diocesano della formazione «M. Fani e G. Acquaderni». */
export const laboratorio = {
  referente: 'Rosa Palumbo',
  passaggi: [
    {
      titolo: 'Formarsi per costruire',
      domanda: 'Quale laico l’Azione Cattolica è chiamata a formare oggi?',
      testo: 'Laboratorio unitario sulla formazione delle figure di responsabilità, a partire dal capitolo VIII del Progetto formativo e dal documento sinodale «Radicati e costruiti in Cristo».',
      quando: 'Giovedì 5 novembre 2026 — Barletta, parrocchia Cuore Immacolato di Maria',
      evento: 'ldf-unitario-apertura',
    },
    {
      titolo: 'Incontrare le piazze',
      domanda: 'Quali realtà ci interrogano oggi?',
      testo: 'Laboratori di settore e di articolazione: ogni realtà associativa dialoga con un’esperienza significativa del territorio — migrazioni, scuola, lavoro, povertà educativa, ambiente, fragilità sociali.',
      quando: 'Nelle date dei singoli settori, fra marzo e aprile 2027',
    },
    {
      titolo: 'Costruire il bene comune',
      domanda: 'Come trasformiamo la formazione in partecipazione?',
      testo: 'Laboratorio unitario su cittadinanza attiva, responsabilità sociale e impegno politico e culturale: le piazze come luogo concreto della presenza dei laici.',
      quando: 'Venerdì 28 maggio 2027 — Trani, parrocchia Spirito Santo',
      evento: 'ldf-unitario',
    },
  ],
};

export interface Cammino {
  settore: SettoreSlug;
  titolo: string;
  sottotitolo: string;
  paragrafi: string[];
  punti?: string[];
}

export const cammini: Cammino[] = [
  {
    settore: 'adulti',
    titolo: '«Di Parola»',
    sottotitolo: 'Il percorso formativo per i gruppi adulti',
    paragrafi: [
      'Il filo rosso dell’anno chiede di essere credenti e credibili, «di parola» appunto, allenandosi in piccoli e grandi esercizi di laicità personali, di famiglia e di comunità. Accanto al sussidio ci sono il testo per la preghiera personale quotidiana e il sussidio per gli animatori dei gruppi.',
      'Il cammino si sviluppa in moduli ispirati alle caratteristiche dell’otre, ciascuno con un focus di approfondimento:',
    ],
    punti: [
      'Flessibilità — la vita nuova e l’amore gratuito di Dio; focus «La giusta misura di sé» (don Michele Gianola).',
      'Adattività — una fede che sa trasformarsi; focus «Corpi di pace» (Roberta Osculati).',
      'Permeabilità — lasciarsi attraversare dalla Parola; focus «Fragile e prezioso» (Donatella Pagliacci).',
      'Plasticità — fede e responsabilità nei luoghi della vita; focus «Il potere, uno spazio inquieto» (don Rocco D’Ambrosio).',
      'Modulo intergenerazionale — in sintonia con il Settore Giovani.',
    ],
  },
  {
    settore: 'giovani',
    titolo: '«Tutto di nuovo!» e «Piazza grande»',
    sottotitolo: 'I percorsi per giovanissimi e giovani',
    paragrafi: [
      '«Tutto di nuovo!» è la proposta per i gruppi Giovanissimi (15–18 anni): la ricerca della novità come riscoperta di qualcosa che non si consuma, che non rompe con il passato ma lo attraversa per aprire al presente e al futuro.',
      '«Piazza grande» è la proposta per i gruppi Giovani (19–30 anni): cinque piazze — elasticità, dono, manifestazione, fermento, ecclesialità — per sperimentare l’attualità di Cristo nel qui e ora di ciascuno. Il cammino si vive nei gruppi parrocchiali e negli appuntamenti diocesani.',
    ],
  },
  {
    settore: 'msac',
    titolo: 'Dieci anni di MSAC in diocesi',
    sottotitolo: 'Il Movimento Studenti di Azione Cattolica',
    paragrafi: [
      'Il MSAC è la proposta missionaria per i giovanissimi che vivono tra i banchi di scuola e i locali delle parrocchie. Quest’anno festeggia i 10 anni di presenza in diocesi, e l’équipe resta disponibile per attività e testimonianze nei gruppi parrocchiali.',
      'Il progetto «Semi di legalità» continua con incontri insieme ad altre realtà del territorio: la programmazione sarà presentata più avanti.',
    ],
  },
  {
    settore: 'acr',
    titolo: '«Wow, che tratto!»',
    sottotitolo: 'Il cammino dell’Azione Cattolica dei Ragazzi',
    paragrafi: [
      '«Wow» è lo stupore davanti alla chiamata del Signore; il «tratto» è il segno unico e irripetibile che ogni ragazzo è chiamato a lasciare sulla pagina della propria vita e del mondo. Dai Piccolissimi ai 14 anni, il cammino usa la metafora dell’Accademia del Fumetto: tra storie, colori e bozzetti si scopre di avere uno stile unico.',
      'L’équipe diocesana ha messo al centro la formazione degli educatori, l’Equipe diocesana dei ragazzi (EDR) e i momenti di vita democratica, in vista delle elezioni di quest’anno.',
    ],
  },
  {
    settore: 'mlac',
    titolo: 'Il lavoro come luogo di testimonianza',
    sottotitolo: 'Il Movimento Lavoratori di Azione Cattolica',
    paragrafi: [
      'Il MLAC legge i cambiamenti del lavoro alla luce del Vangelo e della Dottrina sociale della Chiesa: sicurezza, sostenibilità ambientale, inclusione sociale, tutela dei diritti, partecipazione democratica e imprenditorialità giovanile.',
      'Quest’anno lavora in stretta collaborazione con l’Ufficio diocesano per la Pastorale sociale e del lavoro, con proposte di formazione, spiritualità e impegno sul territorio.',
    ],
  },
];

export const appuntamentiNazionali = [
  'Centenario della nascita di Vittorio Bachelet: un percorso sui tratti della sua figura — mitezza, ascolto, amore per la libertà — attraverso un dialogo fra i suoi scritti e quelli del figlio Giovanni.',
  'Convegno nazionale del Settore Adulti, dal 20 al 22 novembre 2026 a Sacrofano.',
  'Festa per i 160 anni dell’Azione Cattolica, a Roma, nella primavera 2027.',
  'Il cammino verso la XIX Assemblea nazionale, con la traccia «E vi fu grande gioia in quella città».',
];

/** Centro studi «Pier Giorgio Frassati» per la storia dell'Azione Cattolica diocesana. */
export const centroStudi = {
  nome: 'Centro studi «Pier Giorgio Frassati»',
  sottotitolo: 'Per la storia dell’Azione Cattolica diocesana',
  introduzione: 'Nell’anno del centenario della nascita di Vittorio Bachelet, il Centro studi propone alle associazioni parrocchiali momenti formativi e laboratoriali per conoscere la storia dell’Azione Cattolica nazionale e locale, in particolare per l’avvio dell’anno e per la Festa dell’adesione.',
  proposte: [
    '«Conosciamo Vittorio Bachelet»: un incontro di formazione sulla sua figura.',
    'La presentazione del libro «L’arte dell’educare» o di altre pubblicazioni, con anticipazioni sul terzo volume della collana sulla storia, «Open space».',
    'La mostra sulla storia dell’AC, con foto, documenti e attività interattive per ragazzi, giovani e adulti.',
    'La ricerca di materiali storici nell’Archivio diocesano dell’associazione.',
    'Progetti di ricerca storica per giovani e adulti, anche in rete con scuole, biblioteche e associazioni del territorio, con la possibilità di visitare il Centro nazionale AC e l’archivio dell’Isacem (Istituto Paolo VI).',
  ],
  referente: 'Luigi Lanotte',
  email: 'centrostudipgfrassatitrani@gmail.com',
  collegamenti: [
    { nome: 'Il volantino del Centro studi', url: 'https://drive.google.com/file/d/1BDrJQmkD-qdWZjvk-bNvYllUNF53nI9a/view?usp=sharing' },
    { nome: 'Pagina Facebook', url: 'https://www.facebook.com/StoriaAzioneCattolicaDiocesiTraniBarlettaBisceglie' },
    { nome: 'Canale YouTube', url: 'https://www.youtube.com/@centrostudip.g.frassati-ac2316' },
  ],
};

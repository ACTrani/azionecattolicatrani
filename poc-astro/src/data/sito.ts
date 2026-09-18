/**
 * Dati istituzionali del sito.
 * ⚠️ I recapiti provengono dalla scheda diocesana sul portale nazionale AC:
 *    https://azionecattolica.it/diocesi/trani-barletta-bisceglie/
 *    Il CAP/provincia va verificato (Trani è passata alla provincia BT, CAP 76125).
 * Presidenza e Consiglio: dalla «Programmazione annuale 2026/2027»
 *    (`materiali/programmazione-annuale-2026-2027.pdf`). I telefoni personali
 *    riportati nel documento non si pubblicano.
 */
export const sito = {
  nome: 'Azione Cattolica Italiana',
  diocesi: 'Arcidiocesi di Trani – Barletta – Bisceglie',
  claim: 'Laici che scelgono di stare, insieme, dentro la vita della Chiesa e della città.',
  annoAssociativo: '2026/2027',
  /** Icona biblica dell'anno associativo 2026/2027 */
  temaAnno: 'Vino nuovo in otri nuovi',
  temaAnnoRiferimento: 'Mc 2,18-22',
  contatti: {
    sede: 'Palazzo Arcivescovile, Via Beltrani 9',
    comune: '76125 Trani (BT)',
    telefono: '0883 494202',
    telefonoHref: '+390883494202',
    email: 'info@azionecattolicatrani.it',
    orari: 'Segreteria aperta il giovedì, 18:30 – 20:00',
  },
  social: [
    { nome: 'Facebook', url: 'https://www.facebook.com/azionecattolicaita' },
    { nome: 'Instagram', url: 'https://www.instagram.com/azionecattolica' },
    { nome: 'YouTube', url: 'https://www.youtube.com/@azionecattolicaita' },
  ],
  /** L'anno 2026/2027 è l'ultimo del triennio: l'assemblea elettiva è a febbraio 2027. */
  triennio: '2024–2027',
  /** Presidenza e Consiglio diocesano, raggruppati per settore e articolazione. */
  consiglio: [
    {
      gruppo: 'Presidenza',
      persone: [
        { nome: 'Maria Lanotte', ruolo: 'Presidente diocesana' },
        { nome: 'Luna Anzelmo', ruolo: 'Segretaria' },
        { nome: 'Leonardo Troilo', ruolo: 'Amministratore' },
        { nome: 'don Giuseppe Pavone', ruolo: 'Assistente unitario e del Settore Adulti' },
      ],
    },
    {
      gruppo: 'Settore Adulti',
      persone: [
        { nome: 'Giuseppe Cacamo', ruolo: 'Vicepresidente' },
        { nome: 'Angela Macchia', ruolo: 'Vicepresidente' },
        { nome: 'Domenico Doronzo', ruolo: 'Consigliera' },
        { nome: 'Leonarda Todisco', ruolo: 'Consigliera' },
      ],
    },
    {
      gruppo: 'Settore Giovani e MSAC',
      persone: [
        { nome: 'don Francesco Lattanzio', ruolo: 'Assistente del Settore Giovani e del MSAC' },
        { nome: 'Carlo Petrignani', ruolo: 'Vicepresidente' },
        { nome: 'Lucia Maddalena Ceto', ruolo: 'Vicepresidente' },
        { nome: 'Michele Cafagna', ruolo: 'Consigliere' },
        { nome: 'Giulia Fumagalli', ruolo: 'Segretaria MSAC' },
        { nome: 'Alessandra Tolone', ruolo: 'Segretaria MSAC' },
      ],
    },
    {
      gruppo: 'Azione Cattolica dei Ragazzi',
      persone: [
        { nome: 'don Michele Piazzolla', ruolo: 'Assistente ACR' },
        { nome: 'Federica Todisco', ruolo: 'Responsabile' },
        { nome: 'Erica Prudente', ruolo: 'Viceresponsabile' },
        { nome: 'Antonio Adamantino', ruolo: 'Consigliere' },
        { nome: 'Angela Pia Scaringi', ruolo: 'Consigliera' },
        { nome: 'Grazia Gaudino', ruolo: 'Consigliera' },
      ],
    },
    {
      gruppo: 'Coordinatori cittadini',
      persone: [
        { nome: 'Marinetta Di Gravina', ruolo: 'Trani' },
        { nome: 'Sterpeta Dipasquale', ruolo: 'Barletta' },
        { nome: 'Grazia Cassanelli', ruolo: 'Bisceglie' },
        { nome: 'Anna Di Gennaro', ruolo: 'Corato' },
        { nome: 'Michele Distasi', ruolo: 'Forania' },
      ],
    },
    {
      gruppo: 'Altri servizi associativi',
      persone: [
        { nome: 'Ottavia Palladino', ruolo: 'Promozione associativa' },
        { nome: 'Rosa Palumbo', ruolo: 'Laboratorio diocesano della formazione' },
        { nome: 'Luigi Lanotte', ruolo: 'Storia associativa' },
        { nome: 'Anna Parisi', ruolo: 'Banco AVE' },
      ],
    },
  ],
  /** Raccolta fondi indicata nella programmazione 2026/2027. */
  raccoltaFondi: {
    titolo: 'Un futuro di valori',
    url: 'https://gofund.me/977ca3487',
  },
};

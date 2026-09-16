/**
 * Dati istituzionali del sito.
 * ⚠️ I recapiti provengono dalla scheda diocesana sul portale nazionale AC:
 *    https://azionecattolica.it/diocesi/trani-barletta-bisceglie/
 *    Il CAP/provincia va verificato (Trani è passata alla provincia BT, CAP 76125).
 * ⚠️ I nomi della Presidenza sono SEGNAPOSTO: vanno forniti dall'associazione.
 */
export const sito = {
  nome: 'Azione Cattolica Italiana',
  diocesi: 'Arcidiocesi di Trani – Barletta – Bisceglie',
  claim: 'Laici che scelgono di stare, insieme, dentro la vita della Chiesa e della città.',
  annoAssociativo: '2026/2027',
  /** Icona biblica dell'anno associativo 2026/2027 (cfr. Mt 9,17) */
  temaAnno: 'Vino nuovo in otri nuovi',
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
  /** ⚠️ SEGNAPOSTO — da sostituire con i nomi reali */
  presidenza: [
    { ruolo: 'Presidente diocesano', nome: '— da inserire —' },
    { ruolo: 'Vicepresidente Settore Adulti', nome: '— da inserire —' },
    { ruolo: 'Vicepresidente Settore Giovani', nome: '— da inserire —' },
    { ruolo: 'Responsabile ACR', nome: '— da inserire —' },
    { ruolo: 'Assistente unitario', nome: '— da inserire —' },
    { ruolo: 'Segretario / Amministratore', nome: '— da inserire —' },
  ],
};

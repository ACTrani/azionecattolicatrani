/**
 * Quante colonne per una griglia di persone: righe sempre piene quando si può
 * (4 → 4, 6 → 3), al massimo 4, mai una scheda sola in fondo.
 */
export const colonnePer = (n: number) => (n <= 4 ? n : n % 3 === 0 ? 3 : n % 4 === 0 ? 4 : 3);

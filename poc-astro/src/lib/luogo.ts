/** Compone «Parrocchia — Comune» saltando le parti non ancora note. */
export function luogoLeggibile(luogo: { nome: string; comune: string }): string {
  const parti = [luogo.nome, luogo.comune].filter((p) => p && !/^(sede )?da definire$/i.test(p));
  return parti.length ? parti.join(' — ') : 'Sede da definire';
}

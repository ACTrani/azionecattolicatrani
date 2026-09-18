import type { APIRoute } from 'astro';
import { tuttiGliEventi } from '../lib/contenuti';
import { calendario } from '../lib/ics';

export const GET: APIRoute = async () => {
  // Un appuntamento senza giorno fissato finirebbe in agenda in una data sbagliata.
  const eventi = (await tuttiGliEventi()).filter((e) => !e.data.dataIndicativa);
  return new Response(calendario(eventi, 'Azione Cattolica — Trani, Barletta, Bisceglie'), {
    headers: { 'Content-Type': 'text/calendar; charset=utf-8' },
  });
};

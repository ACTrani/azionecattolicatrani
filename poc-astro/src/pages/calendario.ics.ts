import type { APIRoute } from 'astro';
import { tuttiGliEventi } from '../lib/contenuti';
import { calendario } from '../lib/ics';

export const GET: APIRoute = async () => {
  const eventi = await tuttiGliEventi();
  return new Response(calendario(eventi, 'Azione Cattolica — Trani, Barletta, Bisceglie'), {
    headers: { 'Content-Type': 'text/calendar; charset=utf-8' },
  });
};

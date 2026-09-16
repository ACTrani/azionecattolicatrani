import type { APIRoute, GetStaticPaths } from 'astro';
import { tuttiGliEventi } from '../../lib/contenuti';
import { calendario } from '../../lib/ics';

export const getStaticPaths: GetStaticPaths = async () => {
  const eventi = await tuttiGliEventi();
  return eventi.map((evento) => ({ params: { id: evento.id }, props: { evento } }));
};

export const GET: APIRoute = async ({ props }) => {
  const evento = props.evento;
  return new Response(calendario([evento], evento.data.titolo), {
    headers: { 'Content-Type': 'text/calendar; charset=utf-8' },
  });
};

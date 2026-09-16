import { defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';
// zod v4: da importare da 'astro/zod', non più da 'astro:content'
import { z } from 'astro/zod';

/**
 * Questo file È il modello dati del sito.
 *
 * Rispecchia uno a uno i custom post type che verranno registrati nel plugin
 * WordPress `ac-trani-core` (vedi piano di lavoro, §4). Chi lavora sul PoC e chi
 * lavorerà su WordPress descrivono gli stessi contenuti con gli stessi nomi di
 * campo: è questo che rende possibile passare da una traccia all'altra senza
 * rifare i contenuti.
 */

const SETTORI = ['unitario', 'adulti', 'giovani', 'acr', 'msac', 'mlac'] as const;

/** CPT `evento` */
const eventi = defineCollection({
  loader: glob({ base: './src/content/eventi', pattern: '**/*.md' }),
  schema: z.object({
    titolo: z.string(),
    sommario: z.string(),
    dataInizio: z.coerce.date(),
    dataFine: z.coerce.date().optional(),
    orario: z.string().optional(),
    luogo: z.object({
      nome: z.string(),
      indirizzo: z.string().optional(),
      comune: z.string(),
      mappaUrl: z.url().optional(),
    }),
    settore: z.enum(SETTORI),
    annoAssociativo: z.string(),
    locandina: z.string().optional(),
    linkIscrizione: z.url().optional(),
    annullato: z.boolean().default(false),
    inEvidenza: z.boolean().default(false),
  }),
});

/** Articoli standard = Notizie, con la categoria "Comunicati ufficiali" */
const notizie = defineCollection({
  loader: glob({ base: './src/content/notizie', pattern: '**/*.md' }),
  schema: z.object({
    titolo: z.string(),
    sommario: z.string(),
    data: z.coerce.date(),
    settore: z.enum(SETTORI),
    comunicato: z.boolean().default(false),
    autore: z.string().optional(),
    inEvidenza: z.boolean().default(false),
  }),
});

/** CPT `documento` */
const documenti = defineCollection({
  loader: glob({ base: './src/content/documenti', pattern: '**/*.md' }),
  schema: z.object({
    titolo: z.string(),
    descrizione: z.string(),
    data: z.coerce.date(),
    tipo: z.enum(['programmazione', 'sussidio', 'modulo', 'verbale', 'statuto', 'comunicato']),
    settore: z.enum(SETTORI),
    annoAssociativo: z.string(),
    file: z.string(),
    formato: z.enum(['PDF', 'DOC', 'XLS', 'ZIP']).default('PDF'),
    dimensione: z.string().optional(),
  }),
});

export const collections = { eventi, notizie, documenti };
export { SETTORI };

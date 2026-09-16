#!/usr/bin/env bash
#
# Allestisce il sito: installazione, lingua, tema, plugin, contenuti.
# È idempotente: rilanciarlo aggiorna invece di duplicare.
#
set -euo pipefail

cd "$(dirname "$0")/.."

URL="http://localhost:8081"
TITOLO="Azione Cattolica"
# Credenziali locali usa e getta. In produzione non si usano né queste né
# l'utente «admin»: si crea un account nominale con password lunga.
UTENTE="admin"
PAROLA="admin123"
POSTA="admin@example.test"

# Docker annuncia lo stato dei container a ogni chiamata: sono righe che
# coprono l'output vero, e vanno tolte senza nascondere gli errori.
wp() { docker compose run --rm -T cli "$@" 2> >(grep -v " Container " >&2); }

if wp core is-installed >/dev/null 2>&1; then
	echo "→ WordPress è già installato: aggiorno."
else
	echo "→ installazione di WordPress…"
	wp core install \
		--url="$URL" \
		--title="$TITOLO" \
		--admin_user="$UTENTE" \
		--admin_password="$PAROLA" \
		--admin_email="$POSTA" \
		--skip-email
fi

echo "→ lingua italiana…"
wp language core install it_IT --activate || echo "  (lingua non scaricata: serve la rete, si può fare dopo)"

echo "→ impostazioni di base…"
wp option update blogdescription "Arcidiocesi di Trani – Barletta – Bisceglie"
wp option update timezone_string "Europe/Rome"
wp option update date_format "j F Y"
wp option update time_format "H:i"
wp option update start_of_week 1
wp option update blog_public 0        # ambiente locale: fuori dai motori di ricerca
wp rewrite structure '/%postname%/'

echo "→ plugin e tema…"
wp plugin activate ac-trani-core
wp theme activate ac-trani

# «Crea tema a blocchi» è lo strumento con cui i grafici esportano in file il
# lavoro fatto nell'Editor del sito. Senza, il loro lavoro resterebbe nel
# database e non arriverebbe mai su Git.
wp plugin is-installed create-block-theme >/dev/null 2>&1 \
	|| wp plugin install create-block-theme || echo "  (create-block-theme non scaricato: serve la rete)"
wp plugin activate create-block-theme || true

# I plugin di serie di WordPress qui non servono.
wp plugin deactivate akismet hello 2>/dev/null || true

# I contenuti di esempio di WordPress («Hello world!», la pagina campione)
# confondono e basta.
wp post delete 1 2 3 --force 2>/dev/null || true

echo "→ contenuti…"
wp eval-file /allestimento/semina.php

echo "→ permalink…"
wp rewrite flush

cat <<FINE

  ─────────────────────────────────────────────────────────────
  Sito      $URL
  Bacheca   $URL/wp-admin/
  Accesso   $UTENTE / $PAROLA   (solo in locale)

  Editor del sito:  Aspetto → Editor
  Esportare il tema: Aspetto → Crea tema a blocchi → Esporta
  ─────────────────────────────────────────────────────────────

FINE

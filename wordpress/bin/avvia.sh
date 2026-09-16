#!/usr/bin/env bash
#
# Avvia l'ambiente WordPress locale e, se è la prima volta, lo allestisce.
# Si può rilanciare senza paura: se il sito è già installato non tocca nulla.
#
#   ./bin/avvia.sh
#
set -euo pipefail

cd "$(dirname "$0")/.."

if ! docker info >/dev/null 2>&1; then
	echo "Il demone Docker non risponde. Su questo Mac: apri Docker Desktop e riprova."
	exit 1
fi

echo "→ avvio dei container…"
docker compose up -d

echo "→ attendo il database…"
for _ in $(seq 1 60); do
	if docker compose exec -T db healthcheck.sh --connect >/dev/null 2>&1; then break; fi
	sleep 2
done

echo "→ attendo WordPress…"
for _ in $(seq 1 60); do
	if curl -sf -o /dev/null "http://localhost:8081/wp-admin/install.php"; then break; fi
	sleep 2
done

exec ./bin/allestisci.sh

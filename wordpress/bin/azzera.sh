#!/usr/bin/env bash
#
# Cancella database e file di WordPress e riparte da zero.
# Tema e plugin non si toccano: stanno su Git, non nei volumi.
#
set -euo pipefail

cd "$(dirname "$0")/.."

read -r -p "Cancello il database e i media dell'ambiente locale. Procedo? [s/N] " risposta
case "$risposta" in
	s|S|si|SI|sì|Sì) ;;
	*) echo "Annullato."; exit 0 ;;
esac

docker compose down -v
exec ./bin/avvia.sh

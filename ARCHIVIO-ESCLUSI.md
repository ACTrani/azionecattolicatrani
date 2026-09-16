# File esclusi dal repository

Questo repository **non** contiene tutto quello che sta nella cartella di lavoro
originale. Ecco cosa manca, perché, e cosa farne.

## 1. Credenziali — da non mettere mai in git

| Percorso | Contenuto |
|---|---|
| `dominio sito diocesi/` | Pannello Aruba, elenco database, password del sito (4 file) |
| `FileZillaPortable/` | Client FTP portable, 81MB; `Data/settings/sitemanager.xml` contiene le credenziali FTP salvate |
| `www.azionecattolicatrani.it/acforum/Settings_bak.php` | Configurazione SMF di produzione, con password DB reale |
| `www.azionecattolicatrani.it/acforum/Settings.php.orig` | Come sopra |

Da conservare in un gestore di password (1Password, Bitwarden) o su supporto offline.
`Settings_bak.php` e `Settings.php.orig` sono le uniche copie dei valori di produzione
(host `62.149.150.42`, DB `Sql79543_4`): se servono a qualcosa in futuro, salvale
fuori da qui prima di cancellare la cartella di lavoro.

Il `Settings.php` presente in repo è la versione **locale**, con credenziali fittizie.

## 2. File troppo grandi per GitHub

GitHub rifiuta i file oltre 100MB e segnala warning oltre i 50MB. Questi quattro
sono esclusi dal `.gitignore`:

| File | Peso |
|---|---|
| `ACR/Mese della Pace/PACE - video diocesano.wmv` | 147 MB |
| `ACR/EDR/EDR - Radio Centro - Bisceglie.mp3` | 58 MB |
| `ACR/Iniziativa annuale e Mese del Ciao/cedipiu video.wmv` | 53 MB |
| `ACR/Mese della Pace/CARICALAPACE-PROMO2010.rar` | 20 MB |

Totale ~278MB. Sono materiale d'archivio (video e audio di iniziative diocesane) e,
come il resto dei contenuti, **non esistono altrove**: il database di produzione è
perso. Vanno trasferiti a parte su disco esterno o cloud.

Se in futuro servisse averli versionati, l'opzione è Git LFS:

```bash
git lfs install
git lfs track "*.wmv" "*.mp3" "*.rar"
```

Tenendo però presente che il piano gratuito GitHub offre 1GB di storage LFS e 1GB di
traffico al mese.

## 3. Roba locale

`.idea/` (configurazione IntelliJ), `.DS_Store`, `.claude/settings.local.json` e la
cache runtime di MkPortal: rigenerabili, nessun valore da conservare.

# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

The public website of **Azione Cattolica – Diocesi di Trani** (`www.azionecattolicatrani.it`). It is a legacy PHP site, not a modern application: there is **no build system, no package manager, no test suite, and no git repository**. Editing means changing PHP/HTML/CSS in place and deploying by FTP.

The repository root holds three things:
- `www.azionecattolicatrani.it/` — the actual site document root (everything that ships).
- `FileZillaPortable/` — the FTP client used to deploy files to the Aruba host. Deployment is a manual FTP upload of changed files; there is no CI/CD.
- `dominio sito diocesi/` — hosting/domain credentials and notes (Aruba admin, DB list, site passwords). Sensitive; not part of the deployed site.

## Architecture

The site is **two integrated PHP applications sharing one MySQL database**:

1. **MkPortal** (a CMS/portal from ~2004–2006) — drives the homepage and all portal content. Lives in `www.azionecattolicatrani.it/mkportal/`.
2. **SMF 1.1** (Simple Machines Forum) — provides user accounts, sessions, and the forum. Lives in `www.azionecattolicatrani.it/acforum/`.

MkPortal does not manage its own users or DB connection. At every request it loads the SMF forum (`Settings.php`, `Sources/*`) through a *board driver* and reuses SMF's member data, session, and MySQL connection. `$MK_BOARD` in `mkportal/conf_mk.php` selects the driver (set to `SMF`); the matching driver lives in `mkportal/include/SMF/`. Other board drivers (IPB, PHPBB, VB, MYBB) ship but are unused.

### Request flow
1. `www.azionecattolicatrani.it/index.php` is the entry point. It defines `IN_MKP`, loads `mkportal/conf_mk.php`, picks the board driver from `$MK_BOARD`, and requires the driver + `mkportal/include/functions.php` + the template.
2. The SMF driver (`mkportal/include/SMF/smf_driverf.php`) reads `acforum/Settings.php`, opens the MySQL connection (via legacy `mysql_*` calls), and boots SMF (session, member load, security).
3. The active **module** is chosen by the `ind` query-string parameter (e.g. `index.php?ind=news`), mapped through a whitelist in `index.php` to `mkportal/modules/<name>/index.php`. Unknown/missing `ind` defaults to `contents`.
4. Modules render into the template; homepage **blocks** (widgets) are composed around them.

### Key directories under `mkportal/`
- `modules/` — page features, one folder each: `contents`, `news`, `blog`, `downloads`, `gallery`, `reviews`, `quote`, `search`, `chat`, `topsite`, `urlobox`. Each has an `index.php` defining a class instantiated on load.
- `blocks/` — homepage/sidebar widgets (`login.php`, `news.php`, `calendar.php`, `last_forum_post.php`, `random_pic.php`, etc.).
- `admin/` — the CMS admin panels, one `ad_*.php` per manageable area (`ad_news.php`, `ad_contents.php`, `ad_download.php`, `ad_blocks.php`, `ad_menu.php`, ...). Reached via `mkportal/admin.php`.
- `include/` — core: `class_mkportals.php` (the `$mklib` object used everywhere), `functions.php`, `mk_mySQL.php`, board-driver subfolders, i18n helpers.
- `templates/` — skins (`default`, `giallino`, `softgreen`, `Forum`); `default` holds `tpl_main.php`, `style.css`, `mkp.js`. Active template set by `$MK_TEMPLATE` in `conf_mk.php`.
- `lang/` — translations (`Italiano` is active, per `$MK_LANG`); also `English`, `Francais`.
- `cache/` — writable runtime cache.

### Static content
Most of the top-level folders inside `www.azionecattolicatrani.it/` are **static archives**, not application code: year folders (`2011-2012` … `2016-2017`), event folders (`fiera2007`, `fieradiesserci2011`, `assemblea`, `meeting`, `campiscuola_2012`, …), and section folders (`ACR`, `adulti`, `giovani`, `adesione`, `unitario`). They contain plain HTML, PDFs, and images. `immagini/`, `loghi/`, `files/`, and `Materiale da scaricare/` are shared asset/download stores. Changes to these are usually content edits, not logic.

## Configuration

- `mkportal/conf_mk.php` — portal settings: site name/URL, active template, language, `$MK_BOARD=SMF`, `$FORUM_PATH=acforum`, layout widths, offline flag. No DB credentials here.
- `acforum/Settings.php` — the source of truth for **database credentials** (`$db_server`, `$db_name`, `$db_user`, `$db_passwd`, `$db_prefix`) and forum URL. MkPortal inherits all of these. Treat as secret; do not commit or expose.

## Working in this codebase

- **PHP era**: code uses deprecated `mysql_*` functions and `E_ALL ^ E_NOTICE`, so it targets old PHP (5.x). It will not run unmodified on PHP 7+/8+. Keep new code consistent with the existing procedural + class style unless a deliberate migration is intended.
- **Running locally**: a Docker setup is provided (see below). It runs the original code unmodified on PHP 5.6 + Apache against a local MariaDB.
- **Direct-access guard**: module/include files begin with `if (!defined("IN_MKP")) die(...)`. New files loaded through the portal must preserve this pattern.
- **Deploy**: upload changed files to the host over FTP (FileZilla). There is no build or bundling step — what you edit is what ships.

## Local development environment (Docker)

The production database was lost (hosting non-payment) and no dump survived, so the
local DB schema was **reconstructed from scratch** — it has the full structure but
**no historical content**. See `docker/initdb/` for the seed scripts.

### Run it
```
docker compose up -d --build       # web: http://localhost:8080  (forum: /acforum/)
docker compose down                # stop
docker compose down -v && docker compose up -d   # wipe DB and re-seed from scratch
```
Requires a running Docker daemon. This machine has Docker Desktop (open the app);
Colima is not installed here.

- **web**: `docker/Dockerfile` — `php:5.6-apache` + the legacy `mysql`/`mysqli`
  extensions. `display_errors` is Off (the app forces `E_ALL ^ E_NOTICE` at runtime,
  which otherwise floods the page); errors go to the Apache log.
- **db**: `mariadb:10.6`, started with an empty `sql_mode` (permissive, as SMF 1.1
  expects). On first init of an empty volume it auto-runs `docker/initdb/*.sql`.
- **Local admin login** (SMF + MKPortal admin panel): `admin` / `admin123`.

### How the schema was rebuilt (`docker/initdb/`)
- `01_smf_schema.sql` — SMF 1.1.21 `install_1-1.sql` with its `{$placeholders}`
  resolved (from the official install package + `Install.english.php` defaults).
- `02_mkportal_schema.sql` — the 26 `mkp_*` tables + seed (blocks, config, groups),
  extracted from the MKPortal installer's `step4()` in the author's repo
  `github.com/lupomeo/mkportal` (only the actually-executed queries; PHP title vars
  resolved to their Italian values). Made idempotent (`INSERT IGNORE`, `IF NOT EXISTS`).
- `03_mkportal_stat_rss.sql` — `mkp_stat`, `mkp_rss` (used by the site's 1.2 code but
  absent from the 1.1 installer), reconstructed from the code's queries.
- `04_schema_fixes.sql` — columns the 1.2 code needs that the 1.1 installer lacks
  (`mkp_news.totalcomm`, `mkp_mainlinks.position`/`target`). Add here if more
  version-mismatch "Unknown column" errors surface in deeper module pages.
- `05_admin.sql` — the local admin member.

### Local-only config edits (do NOT deploy)
- `acforum/Settings.php`: `$db_server` → `db`, `$boardurl` → `http://localhost:8080/acforum`.
  Original preserved as `acforum/Settings.php.orig`.
- `mkportal/conf_mk.php`: `$SITE_URL` → `http://localhost:8080`.

<?php
// Version: 1.1.1; Install

// These should be the same as those in index.language.php.
$txt['lang_character_set'] = 'ISO-8859-1';
$txt['lang_rtl'] = false;

$txt['smf_installer'] = 'SMF Installer';
$txt['installer_language'] = 'Lingua';
$txt['installer_language_set'] = 'Set';
$txt['congratulations'] = 'Congratulazioni, il processo di installazione &egrave; completo!';
$txt['congratulations_help'] = 'In ogni caso se necessiti di aiuto, o SMF non funziona nella maniera adeguata, per favore ricordati che <a href="http://www.simplemachines.org/community/index.php" target"_blank">un aiuto &egrave; disponibile</a>.';
$txt['still_writable'] = 'La tua directory di installazione &egrave; ancora scrivibile.  Sarebbe una buona idea cambiarne i permessi rendendola non scrivibile per ragioni di sicurezza.';
$txt['delete_installer'] = 'Clicca qui per cancellare adesso il file install.php.';
$txt['delete_installer_maybe'] = '<i>(non funziona su tutti i server.)</i>';
$txt['go_to_your_forum'] = 'Adesso puoi andare sul tuo <a href="%s">forum appena installato</a> e iniziare ad usarlo.  Dovrai assicurarti di essere loggato, dopodich&egrave; potrai accedere al centro di amministrazione.';
$txt['good_luck'] = 'Buona Fortuna!<br />Simple Machines';

$txt['user_refresh_install'] = 'Aggiornamento Forum';
$txt['user_refresh_install_desc'] = 'Durante l\'installazione, l\'installer ha trovato che (con i dati che tu hai fornito) una o pi&ugrave; tabelle che questo installer dobrebbe creare esistono gi&agrave; nel database.<br />Le tabelle mancanti nella tua installazione sono state ricreate con i dati di default, mentre non verr&agrave; cancellato nessun dato dalle tabelle esistenti.';

$txt['default_topic_subject'] = 'Benvenuto in SMF!';
$txt['default_topic_message'] = 'Benvenuto in Simple Machines Forum!<br /><br />Speriamo che il nostro forum vi piaccia.&nbsp; Se avete qualche problema, sentitevi liberi di [url=http://www.simplemachines.org/community/index.php]chiederci assistenza[/url].<br /><br />Grazie!<br />Simple Machines';
$txt['default_board_name'] = 'Discussioni Generali';
$txt['default_board_description'] = 'Sentitevi liberi di discutere di qualsiasi cosa in questa board.';
$txt['default_category_name'] = 'Categoria Generale';
$txt['default_time_format'] = '%B %d, %Y, %I:%M:%S %p';
$txt['default_news'] = 'SMF - Appena Installato!';
$txt['default_karmaLabel'] = 'Karma:';
$txt['default_karmaSmiteLabel'] = '[smite]';
$txt['default_karmaApplaudLabel'] = '[applaud]';
$txt['default_reserved_names'] = 'Admin\nWebmaster\nGuest\nroot';
$txt['default_smileyset_name'] = 'Default';
$txt['default_classic_smileyset_name'] = 'Classic';
$txt['default_theme_name'] = 'SMF Default Theme - Core';
$txt['default_classic_theme_name'] = 'Classic YaBB SE Theme';
$txt['default_babylon_theme_name'] = 'Babylon Theme';

$txt['default_administrator_group'] = 'Amministratore';
$txt['default_global_moderator_group'] = 'Moderatore Globale';
$txt['default_moderator_group'] = 'Moderatore';
$txt['default_newbie_group'] = 'Newbie';
$txt['default_junior_group'] = 'Jr. Member';
$txt['default_full_group'] = 'Full Member';
$txt['default_senior_group'] = 'Sr. Member';
$txt['default_hero_group'] = 'Hero Member';

$txt['default_smiley_smiley'] = 'Smiley';
$txt['default_wink_smiley'] = 'Wink';
$txt['default_cheesy_smiley'] = 'Cheesy';
$txt['default_grin_smiley'] = 'Grin';
$txt['default_angry_smiley'] = 'Angry';
$txt['default_sad_smiley'] = 'Sad';
$txt['default_shocked_smiley'] = 'Shocked';
$txt['default_cool_smiley'] = 'Cool';
$txt['default_huh_smiley'] = 'Huh?';
$txt['default_roll_eyes_smiley'] = 'Roll Eyes';
$txt['default_tongue_smiley'] = 'Tongue';
$txt['default_embarrassed_smiley'] = 'Embarrassed';
$txt['default_lips_sealed_smiley'] = 'Lips Sealed';
$txt['default_undecided_smiley'] = 'Undecided';
$txt['default_kiss_smiley'] = 'Kiss';
$txt['default_cry_smiley'] = 'Cry';
$txt['default_evil_smiley'] = 'Evil';
$txt['default_azn_smiley'] = 'Azn';
$txt['default_afro_smiley'] = 'Afro';

$txt['error_message_click'] = 'Clicca qui';
$txt['error_message_try_again'] = 'per ritentare questo passo.';
$txt['error_message_bad_try_again'] = 'per continuare comunque l\'installazione, ma nota che &egrave; <i>fortemente</i> sconsigliato.';

$txt['install_settings'] = 'Impostazioni di Base';
$txt['install_settings_info'] = 'Giusto poche cose da settare ;).';
$txt['install_settings_name'] = 'Nome del forum';
$txt['install_settings_name_info'] = 'Questo &egrave; il nome del tuo forum, es. &quot;Forum di Test&quot;.';
$txt['install_settings_name_default'] = 'Il mio Forum';
$txt['install_settings_url'] = 'URL del Forum ';
$txt['install_settings_url_info'] = 'Questo &egrave; l\'URL del tuo forum <b>senza i simboli \'/\'!</b>.<br />In molti casi, puoi lasciare il contenuto di default del box - &egrave; generalmente corretto.';
$txt['install_settings_compress'] = 'Output Compresso Gzip ';
$txt['install_settings_compress_title'] = 'Comprimi l\'output per salvare larghezza di banda.';
// In this string, you can translate the word "PASS" to change what it says when the test passes.
$txt['install_settings_compress_info'] = 'Questa funzione non agisce correttamente su tutti i servers, ma cos&igrave; puoi slavare parecchia banda.<br />Clicca <a href="install.php?obgz=1&amp;pass_string=FUNZIONANTE" onclick="return reqWin(this.href, 200, 60);" target="_blank">qui</a> per testarlo. (dovrebbe solo dire "FUNZIONANTE".)';
$txt['install_settings_dbsession'] = 'Sessioni del Database';
$txt['install_settings_dbsession_title'] = 'Usa il database per le sessioni, invece dei files.';
$txt['install_settings_dbsession_info1'] = 'Questa opzione &egrave; quasi sempre la migliore, siccome rende le sessioni pi&ugrave; affidabili.';
$txt['install_settings_dbsession_info2'] = 'Questa opzione &egrave; generalmente una buona idea, ma potrebbe non funzionare su tutti i Servers.';
$txt['install_settings_utf8'] = 'Set di caratteri UTF-8';
$txt['install_settings_utf8_title'] = 'Usa l\'UTF-8 come set di caratteri di default';
$txt['install_settings_utf8_info'] = 'Questa opzione permette al database e al forum di utilizzare un set di caratteri internazionale, UTF-8. Questo pu&ograve; essere utile quando si ha a che fare con linguaggi multipli che utilizzano differenti set di caratteri.';
$txt['install_settings_stats'] = 'Permetti la Raccolta delle Statistiche';
$txt['install_settings_stats_title'] = 'Permetti a Simple Machines di raccogliere Mensimente le Statistiche Principali';
$txt['install_settings_stats_info'] = 'Se abilitato, ci&ograve; permetter&agrave; a Simple Machines di visitare il tuo sito una volta al mese per raccogliere le statictiche principali. Questo ci aiuter&agrave; nello scegliere per quali configurazioni ottimizzare il software. Per maggiori informazioni la preghiamo di visitare la nostra <a href="http://www.simplemachines.org/about/stats.php" target="_blank">pagina informazioni</a>.';
$txt['install_settings_proceed'] = 'Procedi';

$txt['mysql_settings'] = 'Impostazioni del server MySQL';
$txt['mysql_settings_info'] = 'Queste sono le impostazioni per il tuo server MySQL.  Se non conosci i valori, dovresti chiedere al tuo host quali sono.';
$txt['mysql_settings_server'] = 'Nome del server MySQL';
$txt['mysql_settings_server_info'] = 'Questo &egrave; quasi sempre localhost - quindi se non lo conosci, prova localhost.';
$txt['mysql_settings_username'] = 'MySQL username';
$txt['mysql_settings_username_info'] = 'Inserisci lo username necessario per connetterti al tuo database MySQL.<br />Se non sai quale sia, prova con lo username del tuo account ftp, in molti casi &egrave; lo stesso.';
$txt['mysql_settings_password'] = 'MySQL password';
$txt['mysql_settings_password_info'] = 'Inserisci la password necessaria per connetterti al tuo database MySQL.<br />Se non sai quale sia, dovresti provare con la password del tuo account ftp.';
$txt['mysql_settings_database'] = 'Nome del database MySQL';
$txt['mysql_settings_database_info'] = 'Inserisci il nome del database che vuoi utilizzare per salvare i dati di SMF.<br />Se il database non esiste, questo installer cercher&agrave; di crearlo.';
$txt['mysql_settings_prefix'] = 'Prefisso delle tabelle MySQL';
$txt['mysql_settings_prefix_info'] = 'Il prefisso per ogni tabella nel database.  <b>Non installare due forum con lo stesso prefisso!</b><br />Questo valore permette di installare molteplici forum nello stesso database.';

$txt['user_settings'] = 'Crea il tuo Account';
$txt['user_settings_info'] = 'L\'installer creer&agrave; un nuovo account da amministratore per te.';
$txt['user_settings_username'] = 'Il tuo username';
$txt['user_settings_username_info'] = 'Scegli il nome con cui vuoi effettuare il login.<br />Non potrai cambiarlo in seguito, ma potrai cambiare il tuo nome visualizzato.';
$txt['user_settings_password'] = 'Password';
$txt['user_settings_password_info'] = 'Inserisci la tua password, e ricordala bene!';
$txt['user_settings_again'] = 'Password';
$txt['user_settings_again_info'] = '(solo per verifica.)';
$txt['user_settings_email'] = 'Indirizzo Email';
$txt['user_settings_email_info'] = 'Inserisci il tuo indirizzo email. <b>Questo deve essere un valido indirizzo email.</b>';
$txt['user_settings_database'] = 'Password del Database MySQL';
$txt['user_settings_database_info'] = 'L\'installer richiede la password del database per poter creare un account da amministratore, per ragioni di sicurezza.';
$txt['user_settings_proceed'] = 'Fine';

$txt['ftp_setup'] = 'Informazioni sulla connessione FTP';
$txt['ftp_setup_info'] = 'Questo installer pu&ograve; connettersi via FTP per impostare i permessi dei files che necessitano di essere scrivibili e non.  Se non funziona, dovrai impostare manualmente i permessi di scrittura.  Nota che non esiste ancora un supporto SSL.';
$txt['ftp_server'] = 'Server';
$txt['ftp_server_info'] = 'Questi devono essere il nome dell\'FTP server e della porta di connessione.';
$txt['ftp_port'] = 'Port';
$txt['ftp_username'] = 'Username';
$txt['ftp_username_info'] = 'Lo Username con cui effettuare il login. <i>Non verr&agrave; salvato in alcun modo.</i>';
$txt['ftp_password'] = 'Password';
$txt['ftp_password_info'] = 'La Password con cui effettuare il login. <i>Non verr&agrave; salvato in alcun modo.</i>';
$txt['ftp_path'] = 'Percorso di Installazione';
$txt['ftp_path_info'] = 'Questa &egrave; il percorso <i>relativo</i> che usi sul tuo server FTP.';
$txt['ftp_path_found_info'] = 'Il percorso nel box sopra &egrave; stato trovato automaticamente.';
$txt['ftp_connect'] = 'Connetti';
$txt['ftp_setup_why'] = 'A cosa serve questo step?';
$txt['ftp_setup_why_info'] = 'Alcuni Files devono avere i permessi in scrittura per far s&igrave; che SMF funzioni correttamente.  Questo step permette all\'installer di impostare i permessi al vostro posto.  Tuttavia, in alcuni casi non funzioner&agrave; - in questi casi, per favore impostate a 777 (scrivibile, 755 su alcuni hosts) i seguenti files:';
$txt['ftp_setup_again'] = 'per verificare se questi file sono scrivibili.';

$txt['error_php_too_low'] = 'Attenzione!  Sembra tu non abbia una versione installata di PHP sul tuo webserver che soddisfa i <b>requisiti minimi di installazione</b> di SMF.<br />Se non sei tu stesso l\'host, dovrai chiedere a chi te lo fornisce un upgrade, o usare un hosting differente - altrimenti aggiorna il PHP a una versione pi&ugrave; recente.<br /><br />Se invece sei sicuro che la tua versione di PHP sia sufficiente puoi continuare, anche se &egrave; fortemente sconsigliabile.';
$txt['error_missing_files'] = 'Impossibile trovare alcuni importanti file per l\'installazione nella directory dello script!<br /><br />Per favore verifica di avere uploadato l\'intero contenuto del package di SMF, incluso il file sql, e riprova.';
$txt['error_session_save_path'] = 'Per favore informa il tuo host che la <b>session.save_path specificata nel file php.ini</b> non &egrave; valida!  Deve essere modificata in una directory che <b>esista</b>, e che sia <b>scrivibile</b> dall\'utente che utilizza il PHP.<br />';
$txt['error_windows_chmod'] = 'Sei su un server Windows, ed alcuni importanti files non sono scrivibili.  Per favore, chiedi al tuo host di dare <b>permessi di scrittura</b> all\'utente per cui sta funzionando il PHP per i files di installazione di SMF.  I seguenti file o directory devono essere scrivibili.';
$txt['error_ftp_no_connect'] = 'Impossibile connettersi al server FTP con questi dettagli.';
$txt['error_mysql_connect'] = 'Impossibile connettersi al database MySql con i dati forniti.<br /><br />Se non sei sicuro di quanto inserisci, per favore contatta il tuo host.';
$txt['error_mysql_too_low'] = 'La versione di MySQL del tuo host &egrave; veramente vecchia, e non soddisfa i requisiti minimi per utilizzare SMF.<br /><br />Chiedi al tuo host di sostituirlo o aggiornarlo, e se non vogliono, prova a cambiare servizio di hosting.';
$txt['error_mysql_database'] = 'L\'installer non &egrave; stato in grado di accedere al database &quot;<i>%s</i>&quot; .  Con alcuni hosts, devi creare il database dal pannello di amministrazione prima di potere usare SMF.  Alcuni aggiungono dei prefissi - come il tuo username - al nomi del tuo database.';
$txt['error_mysql_queries'] = 'Alcune queries non sono state eseguite correttamente. Questo pu&ograve; essere causato da una vecchia (o non supportata) versione di MySQL.<br /><br />Informazioni tecniche riguardo alle queries:';
$txt['error_mysql_queries_line'] = 'Linea #';
$txt['error_mysql_missing'] = 'L\'installer non &egrave; riuscito a rilevare il supporto MySQL in PHP.  Per favore chiedi al tuo host se ha correttamente compilato il PHP con il supporto per MySQL o che le relative estensioni siano correttamente caricate.';
$txt['error_session_missing'] = 'L\'installer non &egrave; riuscito a rilevare il supporto alle sessioni nell\'installazione del PHP sul tuo server.  Per favore chiedi al tuo host se ha correttamente compilato il PHP con il supporto alle sessioni (infatti, &egrave; stato chiaramente compilato senza.)';
$txt['error_user_settings_again_match'] = 'Hai inserito due passwords diverse!';
$txt['error_user_settings_taken'] = 'Spiacente, un utente &egrave; gi&agrave; registrato con questo nome e/o password.<br /><br />Un nuovo account non &egrave; stato creato.';
$txt['error_user_settings_query'] = 'E\'accaduto un errore nel database durante la creazione dell\'account di amministrazione.  L\'errore era:';
$txt['error_subs_missing'] = 'Impossibile trovare il file Sources/Subs.php.  Per favore verifica che sia stato caricato sul server, e riprova.';
$txt['error_mysql_alter_priv'] = 'L\'account MySQL che hai specificato non ha i permessi per MODIFICARE, CREARE, e/o ELIMINARE le tabelle nel database; questo &egrave; necessario affinch&eacute; SMF funzioni correttamente.';
$txt['error_versions_do_not_match'] = 'L\'installer ha trovato un\'altra versione di SMF gi&agrave; installata con le stesse impostazioni.  Se stai cercando di upgradarla, dovresti usare l\'upgrader, non l\'installer.<br /><br />Altrimenti, dovresti utilizzare diverse impostazioni, o creare un backup e poi cancellare i dati attualmente salvati nel database.';
$txt['error_mod_security'] = 'L\'installer ha trovato che il modulo mod_security &egrave; installato sul tuo web server. Il Mod_security bloccher&agrave; i moduli compilati prima che SMF riesca a ricevere qualcosa. SMF ha iniserito un security scanner che funzioner&agrave; pi&ugrave; efficentemente del mod_security e che non bloccher&agrave; i moduli compilati.<br /><br /><a href="http://www.simplemachines.org/redirect/mod_security">Maggiori informazioni sul disabilitare il mod_security</a>';
$txt['error_utf8_mysql_version'] = 'La corrente versione del tuo database non supporta l\'utilizzo del set di caratteri UTF-8. Puoi continuare ad installare SMF senza alcun problema, ma solo con il supporto UTF-8 deselezionato. Se desidererai passare all\'UTF-8 in futuro (ad esempio dopo che il server MySQL del tuo forum sar&agrave; stato aggiornato ad una versione >= 4.1), potrai convertire il tuo forum in UTF-8 mediante il pannello di amministrazione.';

?>
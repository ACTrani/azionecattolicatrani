<?php
// Version: 1.1.5; ModSettings

$txt['smf3'] = 'Questa pagina ti permette di variare le impostazioni delle funzioni, delle mods installate, e delle opzioni di base del vostro forum.  Per Favore guarda le <a href="' . $scripturl . '?action=theme;sa=settings;th=' . $settings['theme_id'] . ';sesc=' . $context['session_id'] . '">impostazioni dei temi grafici</a> per ulteriori opzioni di configurazione.  Clicca le icone di help per maggiori informazioni sulle impostazioni.';

$txt['mods_cat_features'] = 'Funzionalit&agrave; di Base';
$txt['pollMode'] = 'Modalit&agrave; sondaggi';
$txt['smf34'] = 'Disabilita i sondaggi';
$txt['smf32'] = 'Abilita i sondaggi';
$txt['smf33'] = 'Mostra i sondaggi esistenti come topics';
$txt['allow_guestAccess'] = 'Autorizza i visitatori a consultare il forum';
$txt['userLanguage'] = 'Abilita la selezione della lingua per gli utenti';
$txt['allow_editDisplayName'] = 'Abilita gli utenti a modificare il loro nome visualizzato?';
$txt['allow_hideOnline'] = 'Permetti ai non amministratori di nascondere il proprio status online?';
$txt['allow_hideEmail'] = 'Permetti agli utenti di nascondere la propria email, tranne che agli amministratori?';
$txt['guest_hideContacts'] = 'Non rivelare i dettagli dei contatti degli utenti ai visitatori';
$txt['titlesEnable'] = 'Abilita i titoli personali';
$txt['enable_buddylist'] = 'Abilita l\'elenco degli amici';
$txt['default_personalText'] = 'Titolo personale di default';
$txt['max_signatureLength'] = 'Numero massimo di caratteri concesso nella firma<div class="smalltext">(0 per nessun limite.)</div>';
$txt['number_format'] = 'Formato dei numeri di default';
$txt['time_format'] = 'Formato orario di default';
$txt['time_offset'] = 'Fuso orario generale<div class="smalltext">(aggiunta anche ai singoli utenti la specifica opzione.)</div>';
$txt['failed_login_threshold'] = 'Intervallo per il login errato';
$txt['lastActive'] = 'Intervallo per segnalare la presenza online';
$txt['trackStats'] = 'Registra le statistiche giornaliere';
$txt['hitStats'] = 'Registra le visite giornaliere (devi aver abilitato le statistiche)';
$txt['enableCompressedOutput'] = 'Abilita l\'output compresso';
$txt['databaseSession_enable'] = 'Usa il database per memorizzare le sessioni';
$txt['databaseSession_loose'] = 'Abilita il browser a tornare alla pagina precedente, usando la cache.';
$txt['databaseSession_lifetime'] = 'Secondi di inattivit&agrave; per terminare la sessione';
$txt['enableErrorLogging'] = 'Abilita la registrazione degli errori';
$txt['cookieTime'] = 'Durata di default dei cookies (in minuti)';
$txt['localCookies'] = 'Abilita il salvataggio locale dei cookies<div class="smalltext">(SSI non funzioner&agrave; bene con questo attivo.)</div>';
$txt['globalCookies'] = 'Utilizza i cookies di sub-dominio<div class="smalltext">(disabilita i cookies locali prima!)</div>';
$txt['securityDisable'] = 'Disabilita il sistema di sicurezza dell\'amministrazione';
$txt['send_validation_onChange'] = 'Richiedi una riattivazione dell\'account dopo il cambio di email';
$txt['approveAccountDeletion'] = 'Richiedi l\'approvazione di un amministratore quando un utente si cancella';
$txt['autoOptDatabase'] = 'Ogni quanti giorni ottimizzi le tabelle?<div class="smalltext">(0 per disabilitare.)</div>';
$txt['autoOptMaxOnline'] = 'Numero massimo di utenti online durante l\'ottimizzazione<div class="smalltext">(0 per nessun limite.)</div>';
$txt['autoFixDatabase'] = 'Correggi automaticamente le tabelle danneggiate';
$txt['allow_disableAnnounce'] = 'Autorizza gli utenti a disabilitare gli annunci';
$txt['disallow_sendBody'] = 'Non permettere di inserire il testo dei post nelle notifiche?';
$txt['modlog_enabled'] = 'Registra le azioni di moderazione';
$txt['queryless_urls'] = 'Mostra gli URL adatte ai motori di ricerca<div class="smalltext"><b>solo per Apache!</b></div>';
$txt['max_image_width'] = 'Larghezza massima delle immagini postate (0 = disabilita)';
$txt['max_image_height'] = 'Altezza massima delle immagini postate (0 = disabilita)';
$txt['mail_type'] = 'Tipo di Mail';
$txt['mail_type_default'] = '(PHP default)';
$txt['smtp_host'] = 'Server SMTP';
$txt['smtp_port'] = 'Porta SMTP';
$txt['smtp_username'] = 'Username SMTP';
$txt['smtp_password'] = 'Password SMTP';
$txt['enableReportPM'] = 'Abilita la segnalazione dei messaggi personali';
$txt['max_pm_recipients'] = 'Numero massimo consentito di destinatari in un messaggio personale.<div class="smalltext">(0 per nessun limite, gli amministratori sono esenti)</div>';
$txt['pm_posts_verification'] = 'Numero di post al di sotto dei quali gli utenti devono inserire un codice di verifica per inviare messaggi peronali.<div class="smalltext">(0 per nessun limite, gli amministratori sono esenti)</div>';
$txt['pm_posts_per_hour'] = 'Numero massimo di messaggi personali che un utente pu&ograve; inviare in un\'ora.<div class="smalltext">(0 per nessun limite, i moderatori sono esenti)</div>';

$txt['mods_cat_layout'] = 'Visualizzazione e Opzioni';
$txt['compactTopicPagesEnable'] = 'Limita il numero dei links di pagina visualizzati';
$txt['smf235'] = 'Pagine contigue da visualizzare:';
$txt['smf236'] = 'da visualizzare';
$txt['todayMod'] = 'Abilita la funzione &quot;Oggi&quot;';
$txt['smf290'] = 'Disabilita';
$txt['smf291'] = 'Solo Oggi';
$txt['smf292'] = 'Oggi &amp; Ieri';
$txt['topbottomEnable'] = 'Abilita i pulsanti Su/Gi&ugrave;';
$txt['onlineEnable'] = 'Mostra online/offline nei posts e nei PM';
$txt['enableVBStyleLogin'] = 'Visualizza il login veloce in tutte le pagine';
$txt['defaultMaxMembers'] = 'Utenti per pagina nella lista degli utenti';
$txt['timeLoadPageEnable'] = 'Mostra il tempo impiegato per la creazione di ogni pagina';
$txt['disableHostnameLookup'] = 'Disabilita la ricerca dell\'hostname?';
$txt['who_enabled'] = 'Abilita l\'elenco chi &egrave; online';

$txt['smf293'] = 'Karma';
$txt['karmaMode'] = 'Modalit&agrave; Karma';
$txt['smf64'] = 'Disabilita karma|Abilita karma generale|Abilita karma positivo/negativo';
$txt['karmaMinPosts'] = 'Imposta il numero minimo di posts necessari per modificare il karma';
$txt['karmaWaitTime'] = 'Tempo di attesa in ore';
$txt['karmaTimeRestrictAdmins'] = 'Anche gli amministratori devono attendere';
$txt['karmaLabel'] = 'Etichetta usata per il Karma';
$txt['karmaApplaudLabel'] = 'Etichetta per aumentare il Karma';
$txt['karmaSmiteLabel'] = 'Etichetta per diminuire il Karma';

$txt['caching_information'] = '<div align="center"><b><u>Importante! Da leggere attentamente prima di abilitare queste opzioni.</b></u></div><br />
	SMF supporta il caching attraverso l\'uso di acceleratori. Gli acceleratori attualmente supportati sono:<br />
	<ul>
		<li>APC</li>
		<li>eAccelerator</li>
		<li>Turck MMCache</li>
		<li>Memcached</li>
		<li>Zend Platform/Performance Suite (Non "Zend Optimizer")</li>
	</ul>
	Il Caching funzioner&agrave; solo se il tuo server ha il PHP compilato con uno degli ottimizzatori qua sopra, o se ha Memcache
	disponibile. <br /><br />
	SMF pu&ograve; impostare il caching in svariati livelli. Pi&ugrave; &egrave; alto il livello abilitato, maggiore sar&agrave; il tempo che la CPU dovr&agrave; impiegare
	per recuperare le informazioni cached. Se &egrave; disponibile sul tuo server, &egrave; preferibile testare inizialmente il caching al primo livello.
	<br /><br />
	Nota : Se usi il Memcached dovrai fornire i dettagli del server nelle impostazioni. Queste devranno essere inserite come un elenco separato da virgole,
	cos&igrave; come mostrato nell\' esempio qua sotto:<br />
	&quot;server1,server2,server3:port,server4&quot;<br /><br />
	Nota : Se nessuna porta verr&agrave; specificata, SMF user&agrave; la 11211 come default. SMF cercher&agrave; di eseguire un bilanciamento di risorse tra i vari Servers.
	<br /><br />
	%s
	<hr />';

$txt['detected_no_caching'] = '<b style="color: red;">SMF non &egrave; stato in grado di trovare un acceleratore compatibile sul tuo server.</b>';
$txt['detected_APC'] = '<b style="color: green">SMF ha identificato APC come gestore caching del tuo server.';
$txt['detected_eAccelerator'] = '<b style="color: green">SMF ha identificato eAccelerator come gestore caching del tuo server.';
$txt['detected_MMCache'] = '<b style="color: green">SMF ha identificato MMCache come gestore caching del tuo server.';
$txt['detected_Zend'] = '<b style="color: green">SMF ha identificato Zend come gestore caching del tuo server.';
$txt['detected_Memcached'] = '<b style="color: green">SMF ha ha trovato Memcached installato nel tuo server.';

$txt['cache_enable'] = 'Livello di Caching';
$txt['cache_off'] = 'Nessuna Caching';
$txt['cache_level1'] = 'Livello 1 di Caching';
$txt['cache_level2'] = 'Livello 2 di Caching (Non Raccomandato)';
$txt['cache_level3'] = 'Livello 3 di Caching (Non Raccomandato)';
$txt['cache_memcached'] = 'Impostazioni della Memcache';

?>
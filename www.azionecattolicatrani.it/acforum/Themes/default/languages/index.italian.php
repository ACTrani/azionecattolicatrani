<?php
// Version: 1.1.5; index

global $forum_copyright, $forum_version, $webmaster_email;

// Locale (strftime, pspell_new) and spelling. (pspell_new, can be left as '' normally.)
// For more information see:
//   - http://www.php.net/function.pspell-new
//   - http://www.php.net/function.setlocale
// Again, SPELLING SHOULD BE '' 99% OF THE TIME!!  Please read this!
$txt['lang_locale'] = 'it_IT.utf8';
$txt['lang_dictionary'] = 'it';
$txt['lang_spelling'] = 'italian';

// Character set and right to left?
$txt['lang_character_set'] = 'UTF-8';
$txt['lang_rtl'] = false;

$txt['days'] = array('Domenica', 'Luned&igrave;', 'Marted&igrave;', 'Mercoled&igrave;', 'Gioved&igrave;', 'Venerd&igrave;', 'Sabato');
$txt['days_short'] = array('Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab');
// Months must start with 1 => 'January'. (or translated, of course.)
$txt['months'] = array(1 => 'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre');
$txt['months_titles'] = array(1 => 'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre');
$txt['months_short'] = array(1 => 'Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic');

$txt['newmessages0'] = '&egrave; nuovo';
$txt['newmessages1'] = 'sono nuovi';
$txt['newmessages3'] = 'Nuovi';
$txt['newmessages4'] = ',';

$txt[2] = 'Amministra';

$txt[10] = 'Salva';

$txt[17] = 'Modifica';
$txt[18] = $context['forum_name'] . ' - Indice';
$txt[19] = 'Utenti';
$txt[20] = 'Nome della Categoria';
$txt[21] = 'Posts';
$txt[22] = 'Ultimo post';

$txt[24] = '(Nessun oggetto)';
$txt[26] = 'Posts';
$txt[27] = 'Guarda Profilo';
$txt[28] = 'Visitatore';
$txt[29] = 'Autore';
$txt[30] = 'il';
$txt[31] = 'Rimuovi';
$txt[33] = 'Inizia un Nuovo Topic';

$txt[34] = 'Login';
// Use numeric entities in the below string.
$txt[35] = 'Username';
$txt[36] = 'Password';

$txt[40] = 'Questo Username non esiste.';

$txt[62] = 'Moderatore della Board';
$txt[63] = 'Rimuovi Topic';
$txt[64] = 'Topics';
$txt[66] = 'Modifica il Post';
$txt[68] = 'Nome';
$txt[69] = 'Email';
$txt[70] = 'Oggetto';
$txt[72] = 'Contenuto';

$txt[79] = 'Profilo';

$txt[81] = 'Scegli la password';
$txt[82] = 'Verifica la password';
$txt[87] = 'Posizione';

$txt[92] = 'Guarda il profilo di';
$txt[94] = 'Totale';
$txt[95] = 'Posts';
$txt[96] = 'Sito Web';
$txt[97] = 'Registrati';

$txt[101] = 'Indice dei Posts';
$txt[102] = 'News';
$txt[103] = 'Home';

$txt[104] = 'Blocca/Sblocca Topic';
$txt[105] = 'Post';
$txt[106] = 'E\'accaduto un errore!';
$txt[107] = 'a';
$txt[108] = 'Logout';
$txt[109] = 'Iniziato da';
$txt[110] = 'Risposte';
$txt[111] = 'Ultimo Post';
$txt[114] = 'Login Amministrazione';
// Use numeric entities in the below string.
$txt[118] = 'Topic';
$txt[119] = 'Help';
$txt[121] = 'Rimuovi Post';
$txt[125] = 'Notifica';
$txt[126] = 'Vuoi una email di notifica se qualcuno risponde a questo topic?';
// Use numeric entities in the below string.
$txt[130] = "Saluti,\nLo Staff di " . $context['forum_name'] . '.';
$txt[131] = 'Notifica di Risposta';
$txt[132] = 'Sposta Topic';
$txt[133] = 'Sposta in';
$txt[139] = 'Pagine';
$txt[140] = 'Utenti attivi negli ultimi ' . $modSettings['lastActive'] . ' minuti';
$txt[144] = 'Messaggi Personali';
$txt[145] = 'Rispondi con citazione';
$txt[146] = 'Risposta';

$txt[151] = 'Nessun messaggio...';
$txt[152] = 'hai';
$txt[153] = 'messaggi';
$txt[154] = 'Rimuovi questo messaggio';

$txt[158] = 'Utenti Online';
$txt[159] = 'Messaggi Personali';
$txt[160] = 'Salta a';
$txt[161] = 'vai';
$txt[162] = 'Sei sicuro di voler rimuovere questo topic?';
$txt[163] = 'Si';
$txt[164] = 'No';

$txt[166] = 'Risultati della ricerca';
$txt[167] = 'Fine dei risultati';
$txt[170] = 'Spiacente, non sono state trovati risultati';
$txt[176] = '-';

$txt[182] = 'Ricerca';
$txt[190] = 'Tutte';

$txt[193] = 'Indietro';
$txt[194] = 'Recupero Password';
$txt[195] = 'Topic iniziato da';
$txt[196] = 'Titolo';
$txt[197] = 'Post di';
$txt[200] = 'Elenco di tutti gli utenti registrati.';
$txt[201] = 'Prego benvenuto';
$txt[208] = 'Centro Amministrazione';
$txt[211] = 'Ultima modifica';
$txt[212] = 'Vuoi disattivare le notifiche su questo topic?';

$txt[214] = 'Posts Recenti';

$txt[227] = 'Residenza';
$txt[231] = 'Sesso';
$txt[233] = 'Data di Registrazione';

$txt[234] = 'Guarda i post pi&ugrave; recenti di questo forum.';
$txt[235] = '&egrave; il topic aggiornato pi&ugrave; di recente';

$txt[238] = 'Maschile';
$txt[239] = 'Femminile';

$txt[240] = 'Caratteri non validi usati nello Username.';

$txt['welcome_guest'] = 'Benvenuto, <b>' . $txt[28] . '</b>. Per favore, effettua il <a href="' . $scripturl . '?action=login">login</a> o <a href="' . $scripturl . '?action=register">registrati</a>.';
$txt['welcome_guest_activate'] = '<br />Hai perso la tua <a href="' . $scripturl . '?action=activate">email di attivazione?</a>';
$txt['hello_member'] = 'Ciao,';
// Use numeric entities in the below string.
$txt['hello_guest'] = 'Benvenuto,';
$txt[247] = 'Ciao,';
$txt[248] = 'Benvenuto,';
$txt[249] = 'Per favore';
$txt[250] = 'Indietro';
$txt[251] = 'Seleziona una destinazione';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt[279] = 'Postato da';

$txt[287] = 'Sorriso';
$txt[288] = 'Arrabbiato';
$txt[289] = 'Wow';
$txt[290] = 'Risata';
$txt[291] = 'Triste';
$txt[292] = 'Occhiolino';
$txt[293] = 'Grossa risata';
$txt[294] = 'Scioccato';
$txt[295] = 'Figo';
$txt[296] = 'Huh';
$txt[450] = 'Pazienza';
$txt[451] = 'Linguaccia';
$txt[526] = 'Imbarazzato';
$txt[527] = 'Bocca cucita';
$txt[528] = 'Indeciso';
$txt[529] = 'Bacio';
$txt[530] = 'Pianto';

$txt[298] = 'Moderatore';
$txt[299] = 'Moderatori';

$txt[300] = 'Segna i Topics come gi&agrave; Letti in questa Board';
$txt[301] = 'Visto';
$txt[302] = 'Nuovo';

$txt[303] = 'Visualizza tutti gli Utenti';
$txt[305] = 'Guarda';
$txt[307] = 'Email';

$txt[308] = 'Visualizzazione Utenti da';
$txt[309] = 'di';
$txt[310] = 'utenti totali';
$txt[311] = 'a';
$txt[315] = 'Hai dimenticato la tua password?';

$txt[317] = 'Data';
// Use numeric entities in the below string.
$txt[318] = 'Da';
$txt[319] = 'Oggetto';
$txt[322] = 'Controlla nuovi messaggi';
$txt[324] = 'A';

$txt[330] = 'Topics';
$txt[331] = 'Utenti';
$txt[332] = 'Elenco Utenti';
$txt[333] = 'Nuovi Posts';
$txt[334] = 'Nessun Nuovo Post';

$txt['sendtopic_send'] = 'Invia';

$txt[371] = 'Fuso Orario';
$txt[377] = 'o';

$txt[398] = 'Spiacente, nessuna corrispondenza trovata';

$txt[418] = 'Notifica';

$txt[430] = 'Spiacente %s, sei escluso dall\'utilizzo di questo forum!';

$txt[452] = 'Segna TUTTI i messaggi come gi&agrave; letti';

$txt[454] = 'Hot Topic (Pi&ugrave; di ' . $modSettings['hotTopicPosts'] . ' risposte)';
$txt[455] = 'Very Hot Topic (Pi&ugrave; di ' . $modSettings['hotTopicVeryPosts'] . ' risposte)';
$txt[456] = 'Topic Bloccato';
$txt[457] = 'Topic Normale';
$txt['participation_caption'] = 'Topic in cui hai postato';

$txt[462] = 'VAI';

$txt[465] = 'Stampa';
$txt[467] = 'Profilo';
$txt[468] = 'Indice dei Topic';
$txt[470] = 'N/A';
$txt[471] = 'messaggio';
$txt[473] = 'Questo nome &egrave; gi&agrave; usato da un altro utente.';

$txt[488] = 'Utenti Totali';
$txt[489] = 'Posts Totali';
$txt[490] = 'Topics Totali';

$txt[497] = 'Durata del Login in minuti';

$txt[507] = 'Anteprima';
$txt[508] = 'Rimani sempre Loggato';

$txt[511] = 'Loggato';
// Use numeric entities in the below string.
$txt[512] = 'IP';

$txt[513] = 'ICQ';
$txt[515] = 'WWW';

$txt[525] = 'da';

$txt[578] = 'ore';
$txt[579] = 'giorni';

$txt[581] = ', il nostro ultimo utente.';

$txt[582] = 'Cerca per';

$txt[603] = 'AIM';
// In this string, please use +'s for spaces.
$txt['aim_default_message'] = 'Ciao.+Ci+sei?';
$txt[604] = 'YIM';

$txt[616] = 'Ricorda, questo forum &egrave; in \'Modalit&agrave; Manutenzione\'.';

$txt[641] = 'Letto';
$txt[642] = 'volte';

$txt[645] = 'Statistiche del Forum';
$txt[656] = 'Ultimo Utente';
$txt[658] = 'Categorie Totali';
$txt[659] = 'Ultimo Post';

$txt[660] = 'Devi';
$txt[661] = 'Cliccare';
$txt[662] = 'qui';
$txt[663] = 'per vederli.';

$txt[665] = 'Boards Totali';

$txt[668] = 'Stampa la Pagina';

$txt[679] = 'Devi inserire un indirizzo email valido.';

$txt[683] = 'Sono un geek!!';
$txt[685] = $context['forum_name'] . ' - Centro Informazioni';

$txt[707] = 'Invia questo topic';

$txt['sendtopic_title'] = 'Invia il topic &quot;%s&quot; a un amico.';
// Use numeric entities in the below three strings.
$txt['sendtopic_dear'] = 'Caro %s,';
$txt['sendtopic_this_topic'] = 'Voglio consigliarti di dare un\'occhiata a "%s" su ' . $context['forum_name'] . '.  Per leggerlo, basta cliccare sul link';
$txt['sendtopic_thanks'] = 'Grazie';
$txt['sendtopic_sender_name'] = 'Il tuo nome';
$txt['sendtopic_sender_email'] = 'Il tuo indirizzo email';
$txt['sendtopic_receiver_name'] = 'Nome del Destinatario';
$txt['sendtopic_receiver_email'] = 'Indirizzo email del destinatario';
$txt['sendtopic_comment'] = 'Aggiungi un commento';
// Use numeric entities in the below string.
$txt['sendtopic2'] = 'E\'stato aggiunto un commento a questo topic';

$txt[721] = 'Nascondi l\'indirizzo email al pubblico?';

$txt[737] = 'Seleziona tutto';

// Use numeric entities in the below string.
$txt[1001] = 'Errore del Database ';
$txt[1002] = 'Per favore ritenta.  Se ottieni ancora questo messaggio di errore, segnala l\'errore all\'amministratore.';
$txt[1003] = 'File';
$txt[1004] = 'Linea';
// Use numeric entities in the below string.
$txt[1005] = 'SMF ha trovato e ha provato a riparare automaticamente un errore nel tuo database.  Se continui ad avere problemi, o continui a ricevere quests emails, per favore contatta il tuo host.';
$txt['database_error_versions'] = '<b>Nota:</b> Sembrerebbe che il tuo database <em>debba</em> richiedere un aggiornamento. I files del tuo forum corrispondono alla versione ' . $forum_version . ', mentre il Database &egrave; della versione di SMF ' . $modSettings['smfVersion'] . '. Dovresti eseguire l\'ultima versione del file upgrade.php per allineare le versioni.';
$txt['template_parse_error'] = 'Errore nel Template Parse!';
$txt['template_parse_error_message'] = 'Ci sono Problemi nella Visualizzazione del Template.  Pu&ograve; essere un problema Temporaneo, per favore riprova.  Se continui a visualizzare quest\'errore, contatta l\'Amministratore del Forum.<br /><br />Se vuoi, prova ad effettuare il <a href="javascript:location.reload();">refresh della pagina</a>.';
$txt['template_parse_error_details'] = 'Ci sono Problemi a Caricare il Template o il File di Linguaggio di <tt><b>%1$s</b></tt>.  Per Favore controlla le Sintassi e Riprova - ricordati, l\'apice (<tt>\'</tt>) &egrave; sempre preceduto dallo slash (<tt>\\</tt>).  Per maggiori informazioni sulle sintassi PHP, prova ad <a href="' . $boardurl . '%1$s">accedere direttamente al file</a>.<br /><br />Se vuoi, puoi provare ad effettuare un <a href="javascript:location.reload();">refresh della pagina</a> o <a href="' . $scripturl . '?theme=1">impostare il Tema di Default</a>.';

$txt['smf10'] = '<b>Oggi</b> alle ';
$txt['smf10b'] = '<b>Ieri</b> alle ';
$txt['smf20'] = 'Aggiungi un nuovo sondaggio';
$txt['smf21'] = 'Domanda';
$txt['smf23'] = 'Invia Voto';
$txt['smf24'] = 'Totale Votanti';
$txt['smf25'] = 'scorciatoie: clicca alt+s per inviare/postare o alt+p per l\'anteprima';
$txt['smf29'] = 'Guarda i risultati.';
$txt['smf30'] = 'Blocca votazione';
$txt['smf30b'] = 'Sblocca Votazione';
$txt['smf39'] = 'Modifica Sondaggio';
$txt['smf43'] = 'Sondaggio';
$txt['smf47'] = '1 Giorno';
$txt['smf48'] = '1 Settimana';
$txt['smf49'] = '1 Mese';
$txt['smf50'] = 'Per Sempre';
$txt['smf52'] = 'Login con username, password e lunghezza della sessione';
$txt['smf53'] = '1 Ora';
$txt['smf56'] = 'SPOSTATO';
$txt['smf57'] = 'Per favore inserisci una breve descrizione sul perch&eacute;<br />questo topic &egrave; stato spostato.';
$txt['smf60'] = 'Spiacente, non hai posts sufficienti per modificare il karma - te ne occorrono almeno ';
$txt['smf62'] = 'Spiacente, non puoi ripetere l\' azione per un breve lasso di tempo. Devi attendere ';
$txt['smf82'] = 'Board';
$txt['smf88'] = 'in';
$txt['smf96'] = 'Topic Importante';

$txt['smf138'] = 'Cancella';

$txt['smf199'] = 'I tuoi Messaggi Personali';

$txt['smf211'] = 'KB';

$txt['smf223'] = '[Altre Statistiche]';

// Use numeric entities in the below three strings.
$txt['smf238'] = 'Codice';
$txt['smf239'] = 'Citato da';
$txt['smf240'] = 'Citazione';

$txt['smf251'] = 'Dividi il Topic';
$txt['smf252'] = 'Unisci i Topics';
$txt['smf254'] = 'Oggetto del nuovo Topic';
$txt['smf255'] = 'Dividi solo questo post.';
$txt['smf256'] = 'Dividi il topic da qui in poi includendo questo post.';
$txt['smf257'] = 'Seleziona i posts da dividere.';
$txt['smf258'] = 'Nuovo Topic';
$txt['smf259'] = 'Topic diviso con successo in due topics.';
$txt['smf260'] = 'Topic di Origine';
$txt['smf261'] = 'Per favore seleziona i posts che vuoi dividere.';
$txt['smf264'] = 'Topics uniti con successo.';
$txt['smf265'] = 'Topic appena Unito';
$txt['smf266'] = 'Topic da unire';
$txt['smf267'] = 'Board di destinazione';
$txt['smf269'] = 'Topic di destinazione';
$txt['smf274'] = 'Sei sicuro di voler unire';
$txt['smf275'] = 'con';
$txt['smf276'] = 'Questa funzione unir&agrave; i posts di due topics in un topic solo. I posts verranno inseriti in base alla data di scrittura. Per cui, il post pi&ugrave; vecchio, sar&agrave; il primo del topic unito.';
 
$txt['smf277'] = 'Rendi il topic importante';
$txt['smf278'] = 'Rendi il topic non-importante';
$txt['smf279'] = 'Blocca il topic';
$txt['smf280'] = 'Sblocca il topic';

$txt['smf298'] = 'Ricerca Avanzata';

$txt['smf299'] = 'GRAVE RISCHIO DI SICUREZZA:';
$txt['smf300'] = 'Non hai rimosso ';

$txt['smf301'] = 'Pagina creata in ';
$txt['smf302'] = ' secondi con ';
$txt['smf302b'] = ' queries.';

$txt['smf315'] = 'Usa questa funzione per informare i moderatori o gli amministratori di un abuso o di un messaggio postato erroneamente.<br /><i>Nota che il tuo indirizzo email cos&igrave; facendo sar&agrave; noto al moderatore.</i>';

$txt['online2'] = 'Online';
$txt['online3'] = 'Offline';
$txt['online4'] = 'Messaggi Personali (Online)';
$txt['online5'] = 'Messaggi Personali (Offline)';
$txt['online8'] = 'Status';

$txt['topbottom4'] = 'Vai Su';
$txt['topbottom5'] = 'Vai Gi&ugrave;';

$forum_copyright = '<a href="http://www.simplemachines.org/" title="Simple Machines Forum" target="_blank">Powered by ' . $forum_version . '</a> | 
<a href="http://www.simplemachines.org/about/copyright.php" title="Free Forum Software" target="_blank">SMF &copy; 2006-2008, Simple Machines LLC</a><br />Traduzione Italiana a cura di <a href="http://www.smitalia.net/" target="_blank">SMItalia</a>';

$txt['calendar3'] = 'Compleanni:';
$txt['calendar4'] = 'Eventi:';
$txt['calendar3b'] = 'Prossimi Compleanni:';
$txt['calendar4b'] = 'Prossimi Eventi:';
// Prompt for holidays in the calendar, leave blank to just display the holiday's name.
$txt['calendar5'] = '';
$txt['calendar9'] = 'Mese:';
$txt['calendar10'] = 'Anno:';
$txt['calendar11'] = 'Giorno:';
$txt['calendar12'] = 'Titolo dell\'Evento :';
$txt['calendar13'] = 'Post In:';
$txt['calendar20'] = 'Modifica Evento';
$txt['calendar21'] = 'Cancelli questo Evento?';
$txt['calendar22'] = 'Cancella Evento';
$txt['calendar23'] = 'Posta Evento';
$txt['calendar24'] = 'Calendario';
$txt['calendar37'] = 'Link al Calendario';
$txt['calendar43'] = 'Link all\'Evento';
$txt['calendar47'] = 'Calendario a venire';
$txt['calendar47b'] = 'Calendario odierno';
$txt['calendar51'] = 'Settimana';
$txt['calendar54'] = 'Numero di Giorni:';
$txt['calendar_how_edit'] = 'come modifichi questi eventi?';
$txt['calendar_link_event'] = 'Collega un Evento al Post:';
$txt['calendar_confirm_delete'] = 'Sei sicuro di voler cancellare questo evento?';
$txt['calendar_linked_events'] = 'Eventi Collegati';

$txt['moveTopic1'] = 'Posta un topic di redirezione';
$txt['moveTopic2'] = 'Cambia l\'oggetto del topic';
$txt['moveTopic3'] = 'Nuovo Oggetto';
$txt['moveTopic4'] = 'Cambia l\'oggetto di tutti i messaggi';

$txt['theme_template_error'] = 'Impossibile caricare il template \'%s\' .';
$txt['theme_language_error'] = 'Impossibile caricare il file di linguaggio \'%s\' .';

$txt['parent_boards'] = 'Boards Secondarie';

$txt['smtp_no_connect'] = 'Impossibile connettersi all\'host SMTP';
$txt['smtp_port_ssl'] = 'Impostazioni della porta SMTP errate; dovrebbe essere 465 per i servers SSL.';
$txt['smtp_bad_response'] = 'Impossibile ricevere i codici di risposta dal mail server';
$txt['smtp_error'] = 'Sono accaduti degli errori durante la spedizione delle Mail. Errore: ';
$txt['mail_send_unable'] = 'Impossibile mandare l\'email all\'indirizzo email \'%s\'';

$txt['mlist_search'] = 'Ricerca per utente';
$txt['mlist_search2'] = 'Ricerca ancora';
$txt['mlist_search_email'] = 'Ricerca per indirizzo email';
$txt['mlist_search_messenger'] = 'Ricerca per il nickname del messenger';
$txt['mlist_search_group'] = 'Ricerca per posizione';
$txt['mlist_search_name'] = 'Ricerca per nome';
$txt['mlist_search_website'] = 'Ricerca per sito web';
$txt['mlist_search_results'] = 'Risultati ricerca per';

$txt['attach_downloaded'] = 'scaricato';
$txt['attach_viewed'] = 'visto';
$txt['attach_times'] = 'volte';

$txt['MSN'] = 'MSN';

$txt['settings'] = 'Impostazioni';
$txt['never'] = 'Mai';
$txt['more'] = 'altri';

$txt['hostname'] = 'Hostname';
$txt['you_are_post_banned'] = 'Spiacente %s, sei stato escluso dall\'invio di post e messaggi personali su questo forum.';
$txt['ban_reason'] = 'Motivo';

$txt['tables_optimized'] = 'Tabelle del database ottimizzate';

$txt['add_poll'] = 'Aggiungi Sondaggio';
$txt['poll_options6'] = 'Puoi selezionare al massimo %s opzioni.';
$txt['poll_remove'] = 'Rimuovi Sondaggio';
$txt['poll_remove_warn'] = 'Sei sicuro di voler rimuovere questo sondaggio dal topic?';
$txt['poll_results_expire'] = 'I risultati saranno mostrati quando la votazione sar&agrave; chiusa';
$txt['poll_expires_on'] = 'La votazione chiude il';
$txt['poll_expired_on'] = 'Votazione chiusa';
$txt['poll_change_vote'] = 'Elimina Voto';
$txt['poll_return_vote'] = 'Opzioni di voto';

$txt['quick_mod_remove'] = 'Rimuovi il selezionato';
$txt['quick_mod_lock'] = 'Blocca il selezionato';
$txt['quick_mod_sticky'] = 'Evidenzia il selezionato';
$txt['quick_mod_move'] = 'Muovi il selezionato in';
$txt['quick_mod_merge'] = 'Unisci i selezionati';
$txt['quick_mod_markread'] = 'Segna i selezionati come gi&agrave; letti';
$txt['quick_mod_go'] = 'Vai!';
$txt['quickmod_confirm'] = 'Sei sicuro di volerlo fare?';

$txt['spell_check'] = 'Verifica ortografica';

$txt['quick_reply_1'] = 'Risposta Veloce';
$txt['quick_reply_2'] = 'Con una <i>Risposta Veloce</i> puoi usare il bulletin board code o gli smileys come in un normale post, ma pi&ugrave; praticamente.';
$txt['quick_reply_warning'] = 'Attenzione: questo topic &egrave; bloccato!<br />Solo gli amministratori e i moderatori possono rispondere.';

$txt['notification_enable_board'] = 'Sei sicuro di voler abilitare le notifiche dei nuovi topics per questa board?';
$txt['notification_disable_board'] = 'Sei sicuro di voler disabilitare le notifiche dei nuovi topics per questa board?';
$txt['notification_enable_topic'] = 'Sei sicuro di voler abilitare le notifiche delle nuove risposte a questo topic?';
$txt['notification_disable_topic'] = 'Sei sicuro di voler disabilitare le notifiche delle nuove risposte a questo topic?';

$txt['rtm1'] = 'Segnala al moderatore';

$txt['unread_topics_visit'] = 'Topics Recenti non Letti';
$txt['unread_topics_visit_none'] = 'Non ci sono topics non letti dalla tua ultima visita.  <a href="' . $scripturl . '?action=unread;all">Clicca qui per visualizzare tutti i topics non letti</a>.';
$txt['unread_topics_all'] = 'Tutti i Topics Non Letti';
$txt['unread_replies'] = 'Topics Aggiornati';

$txt['who_title'] = 'Chi &egrave; Online';
$txt['who_and'] = ' e ';
$txt['who_viewing_topic'] = ' stanno guardando questo topic.';
$txt['who_viewing_board'] = ' stanno guardando questa board.';
$txt['who_member'] = 'Utente';

$txt['powered_by_php'] = 'Powered by PHP';
$txt['powered_by_mysql'] = 'Powered by MySQL';
$txt['valid_html'] = 'HTML 4.01 Valido!';
$txt['valid_xhtml'] = 'XHTML 1.0 Valido!';
$txt['valid_css'] = 'CSS Valido!';

$txt['guest'] = 'Visitatore';
$txt['guests'] = 'Visitatori';
$txt['user'] = 'Utente';
$txt['users'] = 'Utenti';
$txt['hidden'] = 'Nascosti';
$txt['buddy'] = 'Amico';
$txt['buddies'] = 'Amici';
$txt['most_online_ever'] = 'Record Presenze Online';
$txt['most_online_today'] = 'Presenze Online Oggi';

$txt['merge_select_target_board'] = 'Seleziona la board di destinazione del topic unito';
$txt['merge_select_poll'] = 'Seleziona quale sondaggio dovr&agrave; essere associato al topic unito';
$txt['merge_topic_list'] = 'Seleziona i topics da unire';
$txt['merge_select_subject'] = 'Seleziona l\'oggetto dei topic uniti';
$txt['merge_custom_subject'] = 'Oggetto Custom';
$txt['merge_enforce_subject'] = 'Cambia l\'oggetto di tutti i messaggi';
$txt['merge_include_notifications'] = 'Includi notifiche?';
$txt['merge_check'] = 'Unisci?';
$txt['merge_no_poll'] = 'Nessun Sondaggio';

$txt['response_prefix'] = 'Re: ';
$txt['current_icon'] = 'Icona Corrente';

$txt['smileys_current'] = 'Smiley Set Corrente';
$txt['smileys_none'] = 'Nessun Smileys';
$txt['smileys_forum_board_default'] = 'Forum/Board Default';

$txt['search_results'] = 'Risultati della Ricerca';
$txt['search_no_results'] = 'Nessun risultato trovato';

$txt['totalTimeLogged1'] = 'Tempo totale trascorso sul forum: ';
$txt['totalTimeLogged2'] = ' giorni, ';
$txt['totalTimeLogged3'] = ' ore e ';
$txt['totalTimeLogged4'] = ' minuti.';
$txt['totalTimeLogged5'] = 'd ';
$txt['totalTimeLogged6'] = 'h ';
$txt['totalTimeLogged7'] = 'm';

$txt['approve_thereis'] = 'C\'&egrave;';
$txt['approve_thereare'] = 'Ci sono';
$txt['approve_member'] = 'un utente';
$txt['approve_members'] = 'utenti';
$txt['approve_members_waiting'] = 'in attesa di approvazione.';

$txt['notifyboard_turnon'] = 'Vuoi ricevere una email di notifica se qualcuno posta un nuovo topic in questa board?';
$txt['notifyboard_turnoff'] = 'Sei sicuro di non voler ricevere notifiche di nuovi topic su questa board?';

$txt['activate_code'] = 'Il tuo codice di attivazione &egrave;';

$txt['find_members'] = 'Trova Utente';
$txt['find_username'] = 'Nome, username, o indirizzo email';
$txt['find_buddies'] = 'Mostra Solo gli Amici?';
$txt['find_wildcards'] = 'Caratteri Speciali permessi: *, ?';
$txt['find_no_results'] = 'Nessun risultato trovato';
$txt['find_results'] = 'Risultati';
$txt['find_close'] = 'Chiudi';

$txt['unread_since_visit'] = 'Mostra i nuovi posts dalla tua ultima visita.';
$txt['show_unread_replies'] = 'Mostra le nuove risposte ai tuoi posts.';

$txt['change_color'] = 'Modifica Colore';

$txt['quickmod_delete_selected'] = 'Cancella i Selezionati';

// In this string, don't use entities. (&amp;, etc.)
$txt['show_personal_messages'] = 'Hai ricevuto uno o pi&ugrave; messaggi personali.\\nVuoi vederli subito (in una nuova finestra)?';

$txt['previous_next_back'] = '&laquo; precedente';
$txt['previous_next_forward'] = 'successivo &raquo;';

$txt['movetopic_auto_board'] = '[BOARD]';
$txt['movetopic_auto_topic'] = '[TOPIC LINK]';
$txt['movetopic_default'] = 'Questo messaggio &egrave; stato spostato in ' . $txt['movetopic_auto_board'] . ".\n\n" . $txt['movetopic_auto_topic'];

$txt['upshrink_description'] = 'Restringi o espandi l\'intestazione.';

$txt['mark_unread'] = 'Segna come da leggere';

$txt['ssi_not_direct'] = 'Non accedere al file SSI.php direttamente da URL; Puoi usare questa path (%s) o aggiungere una funzione ?ssi_function=quella che vuoi.';
$txt['ssi_session_broken'] = 'SSI.php non &egrave; riuscito a caricare una sessione!  Questo pu&ograve; causare problemi con il logout e altre funzioni - per favore assicuratevi che SSI.php sia incluso prima di *qualsiasi altra cosa* in tutti i vostri scripts!';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['preview_title'] = 'Anteprima del post';
$txt['preview_fetch'] = 'Ottenendo l\'anteprima...';
$txt['preview_new'] = 'Nuovo messaggio';
$txt['error_while_submitting'] = 'I seguenti errori sono occorsi mentre postavi questo messaggio:';

$txt['split_selected_posts'] = 'Posts selezionati';
$txt['split_selected_posts_desc'] = 'I posts sottostanti formeranno un nuovo topic dopo la divisione.';
$txt['split_reset_selection'] = 'azzera la selezione';

$txt['modify_cancel'] = 'Annulla';
$txt['mark_read_short'] = 'Segna Letti';

$txt['pm_short'] = 'Messaggi';
$txt['hello_member_ndt'] = 'Ciao';

$txt['ajax_in_progress'] = 'Caricando...';

?>
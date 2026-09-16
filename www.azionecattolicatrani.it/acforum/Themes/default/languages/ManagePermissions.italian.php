<?php
// Version: 1.1.1; ManagePermissions

$txt['permissions_title'] = 'Gestione dei Permessi';
$txt['permissions_modify'] = 'Modifica';
$txt['permissions_access'] = 'Accesso';
$txt['permissions_allowed'] = 'Concessi';
$txt['permissions_denied'] = 'Negati';

$txt['permissions_switch'] = 'Cambia In';
$txt['permissions_global'] = 'Globale';
$txt['permissions_local'] = 'Locale';

$txt['permissions_groups'] = 'Permessi per Gruppi di Utenti';
$txt['permissions_all'] = 'tutti';
$txt['permissions_none'] = 'nessuno';
$txt['permissions_set_permissions'] = 'Imposta permessi';

$txt['permissions_with_selection'] = 'Con selezione';
$txt['permissions_apply_pre_defined'] = 'Applica un profilo predefinito per i permessi';
$txt['permissions_select_pre_defined'] = 'Seleziona un profilo predefinito';
$txt['permissions_copy_from_board'] = 'Copia i permessi da questa board';
$txt['permissions_select_board'] = 'Seleziona una board';
$txt['permissions_like_group'] = 'Imposta i permessi come per questo gruppo';
$txt['permissions_select_membergroup'] = 'Seleziona un gruppo di utenti';
$txt['permissions_add'] = 'Aggiungi permesso';
$txt['permissions_remove'] = 'Cancella permesso';
$txt['permissions_deny'] = 'Nega permesso';
$txt['permissions_select_permission'] = 'Seleziona un permesso';

// All of the following block of strings should not use entities, instead use \\" for &quot; etc.
$txt['permissions_only_one_option'] = 'Puoi selelzionare una sola azione per modificare i permessi';
$txt['permissions_no_action'] = 'Nessuna azione selezionata';
$txt['permissions_deny_dangerous'] = 'Stai per negare uno o pi&ugrave; permessi.\\nQuesta &egrave; un\'azione pericolosa e pu&ograve; causare risultati inaspettati se non sei sicuro che non ci sia qualcuno \\"per sbaglio\\" nel gruppo o nei gruppi a cui stai negando i permessi.\\n\\nSei sicuro di voler continuare?';

$txt['permissions_boards'] = 'Permessi per ogni Board';

$txt['permissions_modify_group'] = 'Modifica Gruppo';
$txt['permissions_general'] = 'Permessi Generali';
$txt['permissions_board'] = 'Permessi Globali della Board';
$txt['permissions_commit'] = 'Salva modifiche';
$txt['permissions_modify_local'] = 'Modifica i Permessi Locali';
$txt['permissions_on'] = 'nella board';
$txt['permissions_local_for'] = 'Permessi Locali per il Gruppo';
$txt['permissions_option_on'] = 'S';
$txt['permissions_option_off'] = 'X';
$txt['permissions_option_deny'] = 'N';
$txt['permissions_option_desc'] = 'Per ogni permesso potete selezionare \'Abilita\' (S), \'Disabilita\' (X), o <span style="color: red;">\'Nega\' (N)</span>.<br /><br />Ricordati che se neghi un permesso, ogni utente - moderatori compresi - appartenenti a quel gruppo non saranno autorizzati ad utilizzare quella funzionalit&agrave;.<br />Per questo motivo, nega, andrebbe usato esclusivamente quando &egrave; davvero <b>necessario</b>. Disabilita, d\'altronde, f&agrave; la stessa cosa, a meno che non trovi altrove un permesso contrario.';

$txt['permissiongroup_general'] = 'Generale';
$txt['permissionname_view_stats'] = 'Visualizza le statistiche del forum';
$txt['permissionhelp_view_stats'] = 'Le statistiche del forum visulizzano alcuni dati del forum, come il numero di utenti, il numero di posts giornalieri e alcune statistiche Top 10. Abilitare questo permesso significa aggiungere un link in fondo all\'indice del forum: (\'[altre statistiche]\').';
$txt['permissionname_view_mlist'] = 'Visualizza l\'elenco utenti';
$txt['permissionhelp_view_mlist'] = 'L\'elenco utenti mostra tutti gli utenti registrati sul forum. La lista pu&ograve; essere ordinata e analizzata secondo diversi criteri. L\'elenco utenti &egrave; raggiungibile sia dall\'indice del forum che dalle statistiche, cliccando sul numero degli utenti.';
$txt['permissionname_who_view'] = 'Visualizza chi &egrave; On-line';
$txt['permissionhelp_who_view'] = 'Chi &egrave; On-line mostra tutti gli utenti che sono online e cosa stanno facendo in quel momento. Questo permesso funziona solo se hai abilitato l\'opzione in \'Preferenze e Opzioni\'. Puoi accedere alla funzione \'Chi &egrave; On-line\' cliccando sul link nella sezione \'Utenti Online\' dell\'indice del forum. Se &egrave; disabilitato gli utenti continueranno a vedere chi &egrave; online, ma non cosa stanno facendo.';
$txt['permissionname_search_posts'] = 'Ricerca posts e topics';
$txt['permissionhelp_search_posts'] = 'Il permesso per la Ricerca autorizza un utente a cercare in tutte le boards in cui ha accesso. Quando il permesso &egrave; abilitato, un pulsante \'Cerca\' &egrave; aggiunto alla barra dei pulsanti del forum.';
$txt['permissionname_karma_edit'] = 'Cambia il karma degli altri utenti';
$txt['permissionhelp_karma_edit'] = 'Il Karma mostra la popolarit&agrave; di un utente. Per poter usare questa opzione, devi averla abilitata in \'Preferenze e Opzioni\'. Questo permesso autorizza un gruppo a votare. Questo permesso non ha effetto sui visitatori.';

$txt['permissiongroup_pm'] = 'Messaggi Personali';
$txt['permissionname_pm_read'] = 'Lettura dei messaggi personali';
$txt['permissionhelp_pm_read'] = 'Questo permesso permette agli utenti di accedere alla sezione dei Messaggi Personali. Senza questo permesso non si possono inviare Messaggi Personali.';
$txt['permissionname_pm_send'] = 'Invio dei messaggi personali';
$txt['permissionhelp_pm_send'] = 'Invio dei Messaggi Personali agli altri utenti registrati. Richiede il permesso \'Lettura dei Messaggi Personali\'.';

$txt['permissiongroup_calendar'] = 'Calendario';
$txt['permissionname_calendar_view'] = 'Visualizza il calendario';
$txt['permissionhelp_calendar_view'] = 'Il calendario mostra per ogni mese i compleanni, gli eventi e le festivit&agrave;. Questo permesso autorizza gli utenti ad accedere al calendario. Quando il permesso &egrave; abilitato, un pulsante viene aggiunto alla barra dei pulsanti del forum e un elenco (contenente i prossimi e gli attuali compleanni, eventi e festivit&agrave;) viene mostrato in fondo all\'indice del forum. Il calendario necessita di essere abilitato in \'Modifica Preferenze e Opzioni\'.';
$txt['permissionname_calendar_post'] = 'Creazione di eventi nel calendario';
$txt['permissionhelp_calendar_post'] = 'Un Evento &egrave; un topic collegato a una data o a un periodo. La creazione degli eventi pu&ograve; essere fatta tramite il calendario. Un evento pu&ograve; essere creato solo se l\'utente ha il permesso di iniziare nuovi topics.';
$txt['permissionname_calendar_edit'] = 'Modifica degli eventi del calendario';
$txt['permissionhelp_calendar_edit'] = 'Un Evento &egrave; un topic collegato a una data o a un periodo. Un evento pu&ograve; essere modificato cliccando sull\'asterisco rosso (*) a fianco degli eventi nel calendario. Per poter modificare un evento, un utente deve avere i permessi sufficienti per modificare il primo messaggio del topic che &egrave; linkato all\'evento.';
$txt['permissionname_calendar_edit_own'] = 'I propri eventi';
$txt['permissionname_calendar_edit_any'] = 'Qualsiasi evento';

$txt['permissiongroup_maintenance'] = 'Amministrazione del Forum';
$txt['permissionname_admin_forum'] = 'Amministrazione del forum e del database';
$txt['permissionhelp_admin_forum'] = 'Questo permesso abilita un utente a:<ul><li>cambiamenti al forum, database e impostazioni dei temi</li><li>gestione dei packages</li><li>usare le funzioni di manutenzione del forum e del database</li><li>visualizzare i log degli Errori e delle azioni di moderazione</li></ul> Usa questo permesso con cautela, in quanto pu&ograve; essere molto pericoloso.';
$txt['permissionname_manage_boards'] = 'Gestisci le boards e le categorie';
$txt['permissionhelp_manage_boards'] = 'Questo permesso abilita a creare, modificare e rimuovere le boards e le categorie.';
$txt['permissionname_manage_attachments'] = 'Gestione allegati e avatars';
$txt['permissionhelp_manage_attachments'] = 'Questo permesso abilita l\'accesso alla gestione allegati, dove sono elencati, ed &egrave; possibile cancellare, tutti gli allegati e gli avatars del forum.';
$txt['permissionname_manage_smileys'] = 'Gestione smileys';
$txt['permissionhelp_manage_smileys'] = 'Questo permesso abilita l\'accesso alla gestione degli smileys. Si potranno aggiungere, modificare e cancellare gli smileys ed i vari set di smileys.';
$txt['permissionname_edit_news'] = 'Modifica news';
$txt['permissionhelp_edit_news'] = 'Questa funzione fa apparire una riga di news casuali in ogni pagina. Per poter utilizzare questa funzione, abilitala nelle impostazioni del forum.';

$txt['permissiongroup_member_admin'] = 'Amministrazione Utenti';
$txt['permissionname_moderate_forum'] = 'Gestione degli utenti del forum';
$txt['permissionhelp_moderate_forum'] = 'Questo permesso include tutte le pi&ugrave; importanti funzioni per la gestione utenti:<ul><li>accesso alla gestione registrazioni</li><li>accesso alla schermata di visualizzazione/cancellazione degli utenti</li><li>informazioni estese del profilo utente, incluso il tracciamento dell\'IP e dell\'utente e lo status online (nascosto)</li><li>attivazione degli accounts</li><li>ricezione delle notifiche per l\'approvazione e l\'approvazione stessa delle nuove registrazioni</li><li>immunit&agrave; all\'ignorazione dei PM</li><li>ed altre piccole cose</li></ul>';
$txt['permissionname_manage_membergroups'] = 'Gestione e assegnazione dei gruppi di utenti';
$txt['permissionhelp_manage_membergroups'] = 'Questo permesso abilita un utente a modificare i gruppi di utenti e ad assegnare un dato gruppo agli altri utenti.';
$txt['permissionname_manage_permissions'] = 'Gestione dei permessi';
$txt['permissionhelp_manage_permissions'] = 'Questo permesso abilita un utente a modificare tutti i permessi attivi ai gruppi di utenti e a modificare i permessi globali e locali delle boards.';
$txt['permissionname_manage_bans'] = 'Gestione della lista dei Ban';
$txt['permissionhelp_manage_bans'] = 'Questo permesso abilita un utente ad aggiungere o rimuovere gli username, gli IP, gli hostname e gli indirizzi email dalla lista degli utenti bannati. Abilita anche la visualizzazione e la cancellazione dei log relativi ai tentati login degli utenti bannati.';
$txt['permissionname_send_mail'] = 'Invio di email del forum agli utenti';
$txt['permissionhelp_send_mail'] = 'Comunicazione a tutti gli utenti del forum, o solamente ad alcuni gruppi di utenti via email o messaggi personali (l\'ultimo richiede il permesso \'Invio dei Messaggi Personali\').';

$txt['permissiongroup_profile'] = 'Profili degli Utenti';
$txt['permissionname_profile_view'] = 'Visualizza il sommario dei profili e le statistiche';
$txt['permissionhelp_profile_view'] = 'Questo permesso permette ad un utente che clicca su uno username di vedere il sommario del profilo, alcune statistiche e tutti i post dell\'utente selezionato.';
$txt['permissionname_profile_view_own'] = 'Il proprio';
$txt['permissionname_profile_view_any'] = 'Qualsiasi';
$txt['permissionname_profile_identity'] = 'Modifica delle impostazioni dell\'account';
$txt['permissionhelp_profile_identity'] = 'Le impostazioni dell\'account sono le impostazioni di base di un profilo, come la password, l\'indirizzo email, il gruppo e la lingua utilizzata.';
$txt['permissionname_profile_identity_own'] = 'Il proprio';
$txt['permissionname_profile_identity_any'] = 'Qualsiasi';
$txt['permissionname_profile_extra'] = 'Modifica delle impostazioni addizionali del profilo';
$txt['permissionhelp_profile_extra'] = 'Le impostazioni addizionali del profilo includono la scelte dell\'avatar, del tema, delle notifiche e dei messaggi personali.';
$txt['permissionname_profile_extra_own'] = 'Il proprio';
$txt['permissionname_profile_extra_any'] = 'Qualsiasi';
$txt['permissionname_profile_title'] = 'Modifica titolo personale custom';
$txt['permissionhelp_profile_title'] = 'Il titolo personale custom &egrave; visualizzato nei post, sotto il profilo degli utenti che ne hanno uno.';
$txt['permissionname_profile_title_own'] = 'Il proprio';
$txt['permissionname_profile_title_any'] = 'Qualsiasi';
$txt['permissionname_profile_remove'] = 'Cancellazione account';
$txt['permissionhelp_profile_remove'] = 'Questo permesso permette ad un utente di cancellare il proprio account, quando impostato su \'Il proprio\'.';
$txt['permissionname_profile_remove_own'] = 'Il proprio';
$txt['permissionname_profile_remove_any'] = 'Qualsiasi';
$txt['permissionname_profile_server_avatar'] = 'Scegliere un avatar dal server';
$txt['permissionhelp_profile_server_avatar'] = 'Se &egrave; abilitata permetter&agrave; ad un utente di scegliere un avatar dalla collezione di avatar installata sul server.';
$txt['permissionname_profile_upload_avatar'] = 'Caricare un avatar sul server';
$txt['permissionhelp_profile_upload_avatar'] = 'Questo permetter&agrave; ad un utente di caricare il proprio avatar sul server.';
$txt['permissionname_profile_remote_avatar'] = 'Scegliere un avatar su un server remoto';
$txt['permissionhelp_profile_remote_avatar'] = 'Poich&eacute; gli avatar possono influenzare negativamente il tempo di creazione di una pagina, &egrave; possibile negare a certi gruppi di utenti di scegliere un avatar su un server esterno.';

$txt['permissiongroup_general_board'] = 'Generali';
$txt['permissionname_moderate_board'] = 'Moderazione di una board';
$txt['permissionhelp_moderate_board'] = 'Il permesso di moderazione di una board aggiunge delle piccole cose che fanno di un moderatore un Vero Moderatore. Questi permessi includono il rispondere ai topics bloccati, cambiare la scadenza delle votazioni e vedere i risultati delle votazioni in anticipo.';

$txt['permissiongroup_topic'] = 'Topics';
$txt['permissionname_post_new'] = 'Iniziare un topic';
$txt['permissionhelp_post_new'] = 'Questo permesso permette ad un utente di iniziare nuovi topics. Non permette di postare risposte ai topics.';
$txt['permissionname_merge_any'] = 'Unire i topics';
$txt['permissionhelp_merge_any'] = 'Unione di due o pi&ugrave; topics in uno solo. L\'ordine dei posts all\'interno del topic sar&agrave; basato sulla data di creazione dei posts. Un utente pu&ograve; unire i topics solamente nelle boards in cui che &egrave; autorizzato ad unire. Per poter unire pi&ugrave; topics in una volta sola, l\'utente deve abilitare la moderazione veloce nel proprio profilo.';
$txt['permissionname_split_any'] = 'Dividere un topic';
$txt['permissionhelp_split_any'] = 'Divisione di un topic in due topics separati.';
$txt['permissionname_send_topic'] = 'Inviare topics ad amici';
$txt['permissionhelp_send_topic'] = 'Questo permesso permette ad un utente di inviare via mail un topic ad un amico, inserendo l\'indirizzo del destinatario e aggiungendo un commento opzionale.';
$txt['permissionname_make_sticky'] = 'Evidenziare i topics';
$txt['permissionhelp_make_sticky'] = 'I topics evidenziati rimangono sempre in cima all\'elenco dei topics di una board. Sono utili per gli annunci e altri messaggi importanti.';
$txt['permissionname_move'] = 'Spostare un topic';
$txt['permissionhelp_move'] = 'Spostare un topic da una board ad un\'altra. Gli utenti possono scegliere come board di destinazione solamente board a cui possono accedere.';
$txt['permissionname_move_own'] = 'Propri topic';
$txt['permissionname_move_any'] = 'Qualsiasi topic';
$txt['permissionname_lock'] = 'Bloccare i topics';
$txt['permissionhelp_lock'] = 'Questo permesso permette ad un utente di bloccare un topic. Questa decisione pu&ograve; essere presa per impedire che si risponda ulteriormente nel topic. Solo se viene concesso il permesso \'Moderazione di una board\' si pu&ograve; postare in un topics bloccato.';
$txt['permissionname_lock_own'] = 'Propri topic';
$txt['permissionname_lock_any'] = 'Qualsiasi topic';
$txt['permissionname_remove'] = 'Rimuovere i topics';
$txt['permissionhelp_remove'] = 'Cancellazione di un intero topic. Nota che questo permesso non permette di cancellare posts specifici in un topic!';
$txt['permissionname_remove_own'] = 'Propri topic';
$txt['permissionname_remove_any'] = 'Qualsiasi topic';
$txt['permissionname_post_reply'] = 'Rispondere nei topics';
$txt['permissionhelp_post_reply'] = 'Questo permesso permette di rispondere nei topics.';
$txt['permissionname_post_reply_own'] = 'Propri topic';
$txt['permissionname_post_reply_any'] = 'Qualsiasi topic';
$txt['permissionname_modify_replies'] = 'Modifica delle risposte nei propri topics';
$txt['permissionhelp_modify_replies'] = 'Questo permesso permette ad un utente che ha iniziato un topic di modificare tutte le risposte al suo topic.';
$txt['permissionname_delete_replies'] = 'Rimozione delle risposte dai propri topics';
$txt['permissionhelp_delete_replies'] = 'Questo permesso permette ad un utente che ha iniziato un topic di rimuovere le risposte al suo topic.';
$txt['permissionname_announce_topic'] = 'Topic di Annuncio';
$txt['permissionhelp_announce_topic'] = 'Permette ad un utente di inviare una email di notifica riguardante un topic a tutti gli iscritti o solo ad alcuni gruppi utenti.';

$txt['permissiongroup_post'] = 'Posts';
$txt['permissionname_delete'] = 'Cancellare i posts';
$txt['permissionhelp_delete'] = 'Rimozione dei posts. Questo non autorizza un utente a cancellare il primo post di un topic.';
$txt['permissionname_delete_own'] = 'Propri post';
$txt['permissionname_delete_any'] = 'Qualsiasi post';
$txt['permissionname_modify'] = 'Modificare i posts';
$txt['permissionhelp_modify'] = 'Modifica i posts';
$txt['permissionname_modify_own'] = 'Propri post';
$txt['permissionname_modify_any'] = 'Qualsiasi post';
$txt['permissionname_report_any'] = 'Segnalare i posts ai moderatori';
$txt['permissionhelp_report_any'] = 'Questo permesso aggiunge un link ad ogni messaggio, permettendo ad un utente di segnalarlo ai moderatori. Con la segnalazione tutti i moderatori ricevono una mail che linka il messaggio segnalato e una descrizione del problema (data dall\'utente che effettua la segnalazione).';

$txt['permissiongroup_poll'] = 'Sondaggi';
$txt['permissionname_poll_view'] = 'Visualizzare i sondaggi';
$txt['permissionhelp_poll_view'] = 'Questo permesso permette ad un utente di vedere i sondaggi. Senza questo permesso, l\'utente potr&agrave; vedere solo il topic.';
$txt['permissionname_poll_vote'] = 'Votare nei sondaggi';
$txt['permissionhelp_poll_vote'] = 'Questo permesso permette ad un utente (registrato) di dare un voto. Non si applica ai visitatori.';
$txt['permissionname_poll_post'] = 'Creare sondaggi';
$txt['permissionhelp_poll_post'] = 'Questo permesso permette ad un utente di dare il via a una votazione.';
$txt['permissionname_poll_add'] = 'Aggiungere un sondaggio ai topics';
$txt['permissionhelp_poll_add'] = 'Questo permesso permette ad un utente di aggiungere una votazione ad un topic gi&agrave; esistente. Questo permesso richiede i permessi sufficienti per modificare il primo post di un topic.';
$txt['permissionname_poll_add_own'] = 'Propri topics';
$txt['permissionname_poll_add_any'] = 'Qualsiasi topic';
$txt['permissionname_poll_edit'] = 'Modificare sondaggi';
$txt['permissionhelp_poll_edit'] = 'Questo permesso permette ad un utente di modificare le opzioni di voto e di resettare il sondaggio. Per poter modificare il massimo numero di voti e la data di scadenza, l\'utente deve essere in possesso del permesso \'Moderazione di una board\'.';
$txt['permissionname_poll_edit_own'] = 'Propri sondaggi';
$txt['permissionname_poll_edit_any'] = 'Qualsiasi sondaggio';
$txt['permissionname_poll_lock'] = 'Bloccare i sondaggi';
$txt['permissionhelp_poll_lock'] = 'Il blocco della votazione esclude il conteggio di altri voti.';
$txt['permissionname_poll_lock_own'] = 'Propri sondaggi';
$txt['permissionname_poll_lock_any'] = 'Qualsiasi sondaggio';
$txt['permissionname_poll_remove'] = 'Rimuovere i sondaggi';
$txt['permissionhelp_poll_remove'] = 'Questo permesso permette la rimozione delle votazioni.';
$txt['permissionname_poll_remove_own'] = 'Propri sondaggi';
$txt['permissionname_poll_remove_any'] = 'Qualsiasi sondaggio';

$txt['permissiongroup_notification'] = 'Notifiche';
$txt['permissionname_mark_any_notify'] = 'Richiesta di notifica delle risposte';
$txt['permissionhelp_mark_any_notify'] = 'Questa opzione permette ad un utente di poter ricevere una notifica ogni volta che qualcuno risponde ad un determinato topic.';
$txt['permissionname_mark_notify'] = 'Richiesta di notifica per nuovi topics';
$txt['permissionhelp_mark_notify'] = 'La notifica per nuovi topics permette ad un utente di ricevere una email ogni volta che viene creato un topic nella board d\'interesse.';

$txt['permissiongroup_attachment'] = 'Allegati';
$txt['permissionname_view_attachments'] = 'Visualizzazione allegati';
$txt['permissionhelp_view_attachments'] = 'Gli allegati sono file inclusi nei posts. Questa opzione pu&ograve; essere abilitata e gestita in \'Modifica Impostazioni e Opzioni\'. Siccome gli allegati non sono accessibili direttamente, puoi proteggerli dal download da parte degli utenti se non hanno questo permesso.';
$txt['permissionname_post_attachment'] = 'Inserimento allegati';
$txt['permissionhelp_post_attachment'] = 'Gli allegati sono file inclusi nei posts. Un post pu&ograve; contenere pi&ugrave; allegati.';

$txt['permissionicon'] = '';

$txt['permission_settings_title'] = 'Impostazione dei Permessi';
$txt['groups_manage_permissions'] = 'Gruppi di utenti a cui &egrave; permesso gestire i permessi';
$txt['permission_settings_submit'] = 'Salva';
$txt['permission_settings_enable_deny'] = 'Abilita l\'opzione per negare i permessi';
// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['permission_disable_deny_warning'] = 'Togliendo questa opzione verranno aggiornati i permessi \\\'Nega\\\' in \\\'Disabilita\\\'.';
$txt['permission_by_membergroup_desc'] = 'Qui puoi impostare tutti i permessi globali per ciascun gruppo di utenti. Questi permessi valgono in tutte le boards che non sono state cambiate manualmente a permessi locali nella schermata \'Permessi per ogni Board\'.';
$txt['permission_by_board_desc'] = 'Qui puoi impostare se una board usa i permessi globali o se ha dei suoi specifici permessi. Usare i permessi locali per una board significa, che puoi impostare ciascun permesso per ogni gruppo di utenti.';
$txt['permission_settings_desc'] = 'Qui puoi impostare chi ha il permesso di cambiare i permessi, cos&igrave; come quanto sofisticato dovr&agrave; essere il sistema dei permessi.';
$txt['permission_settings_enable_postgroups'] = 'Abilita i permessi per i gruppi basati sul numero di post';
// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['permission_disable_postgroups_warning'] = 'Disablitando questa impostazione rimuoverai i permessi correntemente impostati per i gruppi di utenti basati sul numero dei post.';
$txt['permission_settings_enable_by_board'] = 'Abilita i permessi avanzati per ogni board';
// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['permission_disable_by_board_warning'] = 'Disablitando questa impostazione rimuoverai i permessi impostati a livello di board.';

?>
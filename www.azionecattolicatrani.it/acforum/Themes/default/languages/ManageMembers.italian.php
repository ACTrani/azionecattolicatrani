<?php
// Version: 1.1.1; ManageMembers

$txt['membergroups_title'] = 'Gestisci i Gruppi di Utenti';
$txt['membergroups_description'] = 'I gruppi di utenti raggruppano gli utenti per impostazioni, visualizzazione, o diritti di accesso. Alcuni gruppi sono basati sul numero di posts che un utente invia. Puoi assegnare chiunque a un gruppo selezionando il suo profilo e cambiando le sue impostazioni di account.';
$txt['membergroups_modify'] = 'Modifica';

$txt['membergroups_add_group'] = 'Aggiungi un gruppo';
$txt['membergroups_regular'] = 'Gruppi regolari';
$txt['membergroups_post'] = 'Gruppi basati sul conteggio dei posts';

$txt['membergroups_new_group'] = 'Aggiungi un Gruppo di Utenti';
$txt['membergroups_group_name'] = 'Nome del gruppo di utenti';
$txt['membergroups_new_board'] = 'Boards Visibili';
$txt['membergroups_new_board_desc'] = 'Boards che il gruppo di utenti pu&ograve; vedere.';
$txt['membergroups_new_board_post_groups'] = '<em>Nota: normalmente, i gruppi basati sul numero dei post non hanno bisogno d\'avere l\'accesso selezionato perch&eacute; &egrave; il gruppo in cui &egrave; situato l\'utente che gli fornir&agrave; l\'accesso.</em>';
$txt['membergroups_new_as_type'] = 'per tipo';
$txt['membergroups_new_as_copy'] = 'basati su';
$txt['membergroups_new_copy_none'] = '(nessuno)';
$txt['membergroups_can_edit_later'] = 'Puoi modificarli in seguito.';

$txt['membergroups_edit_group'] = 'Modifica Gruppo di Utenti';
$txt['membergroups_edit_name'] = 'Nome del gruppo';
$txt['membergroups_edit_post_group'] = 'Questo gruppo &egrave; basato sul numero dei posts.';
$txt['membergroups_min_posts'] = 'Posts richiesti';
$txt['membergroups_online_color'] = 'Colore nella lista degli online';
$txt['membergroups_star_count'] = 'Numero di immagini a stelle';
$txt['membergroups_star_image'] = 'Nome del file dell\'immagine a stella';
$txt['membergroups_star_image_note'] = 'puoi usare $language per il linguaggio dell\'utente.)';
$txt['membergroups_max_messages'] = 'Numero massimo di messaggi personali';
$txt['membergroups_max_messages_note'] = '0 = senza limite';
$txt['membergroups_edit_save'] = 'Salva';
$txt['membergroups_delete'] = 'Elimina';
$txt['membergroups_confirm_delete'] = 'Sei sicuro di voler eliminare questo gruppo?!';

$txt['membergroups_members_title'] = 'Elenco di tutti gli utenti che appartengono al gruppo';
$txt['membergroups_members_no_members'] = 'Questo gruppo &egrave; attualmente vuoto';
$txt['membergroups_members_add_title'] = 'Aggiungi un utente a questo gruppo';
$txt['membergroups_members_add_desc'] = 'Lista di utenti da aggiungere';
$txt['membergroups_members_add'] = 'Aggiungi Utenti';
$txt['membergroups_members_remove'] = 'Rimuovi dal Gruppo';

$txt['membergroups_postgroups'] = 'Gruppi basati sui numero dei post';

$txt['membergroups_edit_groups'] = 'Modifica Gruppi di Utenti';
$txt['membergroups_settings'] = 'Impostazioni dei Gruppi di Utenti';
$txt['groups_manage_membergroups'] = 'Gruppi a cui &egrave; permesso modificare i gruppi di utenti';
$txt['membergroups_settings_submit'] = 'Salva';
$txt['membergroups_select_permission_type'] = 'Seleziona il profilo dei permessi';
$txt['membergroups_images_url'] = '{URL del tema}/images/';
$txt['membergroups_select_visible_boards'] = 'Mostra boards';

$txt['admin_browse_approve'] = 'Utenti i cui account stanno aspettando di essere approvati';
$txt['admin_browse_approve_desc'] = 'Da qui puoi gestire tutti gli utenti che stanno aspettando di avere i propri account approvati.';
$txt['admin_browse_activate'] = 'Utenti i cui account stanno aspettando di essere attivati';
$txt['admin_browse_activate_desc'] = 'Questa schermata elenca tutti gli utenti che non hanno ancora attivato il proprio account sul tuo forum.';
$txt['admin_browse_awaiting_approval'] = 'In Attesa di Approvazione <span style="font-weight: normal">(%d)</span>';
$txt['admin_browse_awaiting_activate'] = 'In Attesa di Attivazione <span style="font-weight: normal">(%d)</span>';

$txt['admin_browse_username'] = 'Username';
$txt['admin_browse_email'] = 'Indirizzo Email';
$txt['admin_browse_ip'] = 'Indirizzo IP';
$txt['admin_browse_registered'] = 'Registrato';
$txt['admin_browse_id'] = 'ID';
$txt['admin_browse_with_selected'] = 'Con Selezionato';
$txt['admin_browse_no_members_approval'] = 'Attualmente non ci sono utenti in attesa di approvazione.';
$txt['admin_browse_no_members_activate'] = 'Attualmente non ci sono utenti che non hanno attivato il proprio account.';

// Don't use entities in the below strings, except the main ones. (lt, gt, quot.)
$txt['admin_browse_warn'] = 'tutti gli utenti selezionati?';
$txt['admin_browse_outstanding_warn'] = 'tutti gli utenti interessati?';
$txt['admin_browse_w_approve'] = 'Approva';
$txt['admin_browse_w_activate'] = 'Attiva';
$txt['admin_browse_w_delete'] = 'Cancella';
$txt['admin_browse_w_reject'] = 'Rifiuta';
$txt['admin_browse_w_remind'] = 'Ricorda';
$txt['admin_browse_w_approve_deletion'] = 'Approva (Cancella Accounts)';
$txt['admin_browse_w_email'] = 'e invia un\'email';
$txt['admin_browse_w_approve_require_activate'] = 'Approva e Richiedi Attivazione';

$txt['admin_browse_filter_by'] = 'Filtrato Da';
$txt['admin_browse_filter_show'] = 'Mostrando';
$txt['admin_browse_filter_type_0'] = 'Nuovi Accounts Non Attivati';
$txt['admin_browse_filter_type_2'] = 'Cambiamenti d\'Email Non Attivati';
$txt['admin_browse_filter_type_3'] = 'Nuovi Accounts Non Approvati';
$txt['admin_browse_filter_type_4'] = 'Cancellazioni di Account Non Approvate';
$txt['admin_browse_filter_type_5'] = 'Account "Under Age" Non Approvati';

$txt['admin_browse_outstanding'] = 'Utenti in Sospeso';
$txt['admin_browse_outstanding_days_1'] = 'Con tutti gli utenti che si sono registrati da pi&ugrave; di';
$txt['admin_browse_outstanding_days_2'] = 'giorni fa';
$txt['admin_browse_outstanding_perform'] = 'Esegui i seguenti provvedimenti';
$txt['admin_browse_outstanding_go'] = 'Provvedimenti da Eseguire';

// Use numeric entities in the below nine strings.
$txt['admin_approve_reject'] = 'Registrazione Rifiutata';
$txt['admin_approve_reject_desc'] = 'Purtroppo, la tua domanda di iscrizione ' . $context['forum_name'] . ' &egrave; stata rifiutata.';
$txt['admin_approve_delete'] = 'Account Cancellato';
$txt['admin_approve_delete_desc'] = 'Il tuo account su ' . $context['forum_name'] . ' &egrave; stato cancellato.  Potrebbe essere successo perch&eacute; non hai mai attivato il tuo account, in questo caso dovresti poterti registrare nuovamente.';
$txt['admin_approve_remind'] = 'Promemoria di Registrazione';
$txt['admin_approve_remind_desc'] = 'Non hai ancora attivato il tuo account su';
$txt['admin_approve_remind_desc2'] = 'Per favore clicca il link qua sotto per attivare il tuo account:';
$txt['admin_approve_accept_desc'] = 'Il tuo account &egrave; stato attivato manualmente dall\'amministratore, ora puoi loggarti e postare.';
$txt['admin_approve_require_activation'] = 'Il tuo account su ' . $context['forum_name'] . ' &egrave; stato approvato dall\'amministratore del forum, ora devi attivarti prima di poter iniziare a postare.';

?>
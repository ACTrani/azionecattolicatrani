<?php
// Version: 1.1.1; PersonalMessage

$txt[143] = 'Indice dei Messaggi Personali';
$txt[148] = 'Invia Messaggio';
$txt[150] = 'A';
$txt[1502] = 'Bcc';
$txt[316] = 'Ricevuti';
$txt[320] = 'Inviati';
$txt[321] = 'Nuovo Messaggio';
$txt[411] = 'Cancella Messaggi';
// Don't translate "PMBOX" in this string.
$txt[412] = 'Cancella tutti i messaggi dalla tua cartella PMBOX';
$txt[413] = 'Sei sicuro di voler cancellare tutti i messaggi?';
$txt[535] = 'Destinatario';
// Don't translate the word "SUBJECT" here, as it is used to format the message.
$txt[561] = 'Nuovo Messaggio Personale: SUBJECT';
// Don't translate SENDER or MESSAGE in this language string; they are replaced with the corresponding text.
$txt[562] = 'Hai ricevuto un messaggio personale da SENDER su ' . $context['forum_name'] . '.' . "\n\n" . 'IMPORTANTE: Ricorda, questa &egrave; solo una notifica. Per favore non rispondere a questa email.' . "\n\n" . 'Il messaggio che hai ricevuto &egrave; il seguente:' . "\n\n" . 'MESSAGE';
$txt[748] = '(per destinatari multipli: \'nome1, nome2\')';
// Use numeric entities in the below string.
$txt['instant_reply'] = 'Rispondi a questo Messaggio Personale:';

$txt['smf249'] = 'Sei sicuro di voler cancellare tutti i messaggi personali selezionati?';

$txt['sent_to'] = 'Invia a';
$txt['reply_to_all'] = 'Rispondi a Tutti';

$txt['pm_capacity'] = 'Capacit&agrave;';
$txt['pm_currently_using'] = '%s messaggi, %s%% pieno.';

$txt['pm_error_user_not_found'] = 'Impossibile trovare l\'utente \'%s\'.';
$txt['pm_error_ignored_by_user'] = 'L\'utente \'%s\' ha bloccato i tuoi messaggi personali.';
$txt['pm_error_data_limit_reached'] = 'Il messaggio personale non pu&ograve; essere spedito a \'%s\' siccome la sua casella &egrave; piena.';
$txt['pm_successfully_sent'] = 'PM inviato con successo a \'%s\'.';
$txt['pm_too_many_recipients'] = 'Non puoi inviare un messaggio personale a pi&ugrave; di %d destinatario(i) alla volta.';
$txt['pm_too_many_per_hour'] = 'Hai superato il limite massimo di %d messaggi personali all\'ora.';
$txt['pm_send_report'] = 'Invia report';
$txt['pm_save_outbox'] = 'Salva una copia nella cartella dei messaggi inviati';
$txt['pm_undisclosed_recipients'] = 'Destinatari nascosti';

$txt['pm_read'] = 'Letto';
$txt['pm_replied'] = 'Risposto A';

// Message Pruning.
$txt['pm_prune'] = 'Riduci Messaggi';
$txt['pm_prune_desc1'] = 'Cancella tutti i messaggi personali pi&ugrave; vecchi di';
$txt['pm_prune_desc2'] = 'giorni.';
$txt['pm_prune_warning'] = 'Sei sicuro di voler ridurre i tuoi messaggi personali?';

// Actions Drop Down.
$txt['pm_actions_title'] = 'Azione Successiva';
$txt['pm_actions_delete_selected'] = 'Cancella Selezionati';
$txt['pm_actions_filter_by_label'] = 'Filtra Per Etichetta';
$txt['pm_actions_go'] = 'Vai';

// Manage Labels Screen.
$txt['pm_apply'] = 'Applica';
$txt['pm_manage_labels'] = 'Gestisci Cartelle';
$txt['pm_labels_delete'] = 'Sei sicuro di voler cancellare le cartelle selezionate?';
$txt['pm_labels_desc'] = 'Da qui puoi aggiungere, modificare e cancellare le cartelle usate nel tuo centro messaggi personali.';
$txt['pm_label_add_new'] = 'Aggiungi Nuova Cartella';
$txt['pm_label_name'] = 'Nome Cartella';
$txt['pm_labels_no_exist'] = 'Attualmente non hai impostato nessuna cartella!';

// Labeling Drop Down.
$txt['pm_current_label'] = 'Etichetta';
$txt['pm_msg_label_title'] = 'Etichetta il Messaggio';
$txt['pm_msg_label_apply'] = 'Aggiungi alla Cartella';
$txt['pm_msg_label_remove'] = 'Rimuovi dalla Cartella';
$txt['pm_msg_label_inbox'] = 'Ricevuti';
$txt['pm_sel_label_title'] = 'Seleziona Cartella';
$txt['labels_too_many'] = 'Spiacente, %s messaggi sono nel massimo numero di cartelle consentito!';

// Sidebar Headings.
$txt['pm_labels'] = 'Cartelle';
$txt['pm_messages'] = 'Messaggi';
$txt['pm_preferences'] = 'Preferenze';

$txt['pm_is_replied_to'] = 'Hai gi&agrave; risposto o inoltrato questo messaggio.';

// Reporting messages.
$txt['pm_report_to_admin'] = 'Segnala all\'Amministratore';
$txt['pm_report_title'] = 'Segnala Messaggio Personale';
$txt['pm_report_desc'] = 'Da questa pagina puoi segnalare un messaggio personale che hai ricevuto al team di amministrazione del forum. Per favore accertati di includere una descrizione del perch&eacute; stai segnalando questo messaggio, cos&igrave; verr&agrave; inviata assieme al contenuto del messaggio originale.';
$txt['pm_report_admins'] = 'Amministratore a cui inviare la segnalazione';
$txt['pm_report_all_admins'] = 'Invia a tutti gli amministratori del forum';
$txt['pm_report_reason'] = 'Ragione per cui stai segnalando questo messaggio';
$txt['pm_report_message'] = 'Segnala Messaggio';

// Important - The following strings should use numeric entities.
$txt['pm_report_pm_subject'] = '[REPORT] ';
// In the below string, do not translate "{REPORTER}" or "{SENDER}".
$txt['pm_report_pm_user_sent'] = '{REPORTER} ha segnalato il sottostante messaggio personale, inviato da {SENDER}, per le seguenti ragioni:';
$txt['pm_report_pm_other_recipients'] = 'Altri destinatari del messaggio:';
$txt['pm_report_pm_hidden'] = '%d destinatari nascosti';
$txt['pm_report_pm_unedited_below'] = 'Sotto &egrave; riportato il contenuto originale del messaggio personale:';
$txt['pm_report_pm_sent'] = 'Inviato:';

$txt['pm_report_done'] = 'Grazie per aver inviato questa segnalazione. Dovresti essere presto contattato dal team di amministrazione';
$txt['pm_report_return'] = 'Ritorna ai messaggi ricevuti';

$txt['pm_search_title'] = 'Cerca Messaggi Personali';
$txt['pm_search_bar_title'] = 'Cerca Messaggi';
$txt['pm_search_text'] = 'Cerca per';
$txt['pm_search_go'] = 'Cerca';
$txt['pm_search_advanced'] = 'Ricerca avanzata';
$txt['pm_search_user'] = 'per utente';
$txt['pm_search_match_all'] = 'Cerca tutte le parole';
$txt['pm_search_match_any'] = 'Cerca ogni parola';
$txt['pm_search_options'] = 'Opzioni';
$txt['pm_search_post_age'] = 'Et&agrave;';
$txt['pm_search_show_complete'] = 'Mostra nei risultati il messaggio intero.';
$txt['pm_search_subject_only'] = 'Cerca solo per soggetto e autore.';
$txt['pm_search_between'] = 'Tra';
$txt['pm_search_between_and'] = 'e';
$txt['pm_search_between_days'] = 'giorni';
$txt['pm_search_order'] = 'Ordina i risultati per';
$txt['pm_search_choose_label'] = 'Scegli la cartella in cui cercare, o cerca in tutte';

$txt['pm_search_results'] = 'Risultati della Ricerca';
$txt['pm_search_none_found'] = 'Nessun Messaggio Trovato';

$txt['pm_search_orderby_relevant_first'] = 'Pi&ugrave; rilevanti prima';
$txt['pm_search_orderby_recent_first'] = 'Pi&ugrave; nuovi prima';
$txt['pm_search_orderby_old_first'] = 'Pi&ugrave; vecchi prima';

$txt['pm_visual_verification_label'] = 'Verifica';
$txt['pm_visual_verification_desc'] = 'Inserisci il codice visualizzato qui sopra per inviare il PM.';
$txt['pm_visual_verification_listen'] = 'Ascolta il codice';

?>
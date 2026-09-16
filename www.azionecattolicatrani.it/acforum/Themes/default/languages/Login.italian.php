<?php
// Version: 1.1.2; Login

$txt[37] = 'Devi inserire uno username.';
$txt[38] = 'Non hai inserito la tua password.';
$txt[39] = 'Password non corretta';
$txt[98] = 'Scegli uno username';
$txt[155] = 'Modalit&agrave; Manutenzione';
$txt[245] = 'Registrazione effettuata con successo';
$txt[431] = 'Congratulazioni! Adesso sei un membro del Forum.';
// Use numeric entities in the below string.
$txt[492] = 'e la tua password &egrave;';
$txt[500] = 'Per favore inserisci un indirizzo email valido, %s.';
$txt[517] = 'Informazioni Richieste';
$txt[520] = 'Usato solo per l\'identificazione da parte di SMF.';
$txt[585] = 'Sono d\'Accordo';
$txt[586] = 'Non sono d\'Accordo';
$txt[633] = 'Attenzione!';
$txt[634] = 'Solo gli utenti registrati possono accedere a questa sezione.';
$txt[635] = 'Per favore effettua il login o';
$txt[636] = 'registra un account';
$txt[637] = 'con ' . $context['forum_name'] . '.';
// Use numeric entities in the below two strings.
$txt[701] = 'Puoi cambiarlo, dopo esserti loggato, nella pagina del tuo profilo, o visitando questa pagina dopo che ti sei loggato:';
$txt[719] = 'Il tuo username &egrave;: ';
$txt[730] = 'Questo indirizzo email (%s) &egrave; gi&agrave; in uso da un utente registrato. Se ritieni ci sia un errore, vai nella pagina di login, seleziona \'Ricordami la Password\' inserendo quest\'indirizzo email.';

$txt['login_hash_error'] = 'Password security has recently been upgraded.  Per favore inserisci la tua password un\'altra volta.';

$txt['register_age_confirmation'] = 'Ho almeno %d anni';

// Use numeric entities in the below six strings.
$txt['register_subject'] = 'Benvenuto in ' . $context['forum_name'];

// For the below three messages, %1$s is the display name, %2$s is the username, %3$s is the password, %4$s is the activation code, and %5$s is the activation link (the last two are only for activation.)
$txt['register_immediate_message'] = 'Ora hai registrato un account su ' . $context['forum_name'] . ', %1$s!' . "\n\n" . 'Lo username del tuo account &egrave; %2$s e la sua password &egrave; %3$s.' . "\n\n" . 'Puoi cambiare la tua password dopo aver effettuato il login andando nel tuo profilo, o visitando questa pagina dopo esserti loggato:' . "\n\n" . $scripturl . '?action=profile' . "\n\n" . $txt[130];
$txt['register_activate_message'] = 'Ora hai registrato un account su ' . $context['forum_name'] . ', %1$s!' . "\n\n" . 'Lo username del tuo account &egrave; %2$s e la sua password &egrave; %3$s (pu&ograve; essere cambiata in seguito.)' . "\n\n" . 'Prima di poterti loggare, devi attivare il tuo account. Per far questo, per favore segui questo link:' . "\n\n" . '%5$s' . "\n\n" . 'Se dovessi avere qualche problema con l\'attivazione, per favore usa il codice "%4$s".' . "\n\n" . $txt[130];
$txt['register_pending_message'] = 'La tua richiesta di registrazione su ' . $context['forum_name'] . ' &egrave; stata ricevuta, %1$s.' . "\n\n" . 'Lo username con cui ti sei registrato &egrave; %2$s e la password &egrave; %3$s.' . "\n\n" . 'Prima di poterti loggare e iniziare ad usare i forum, la tua richiesta dovr&agrave; essere esaminata e approvata.  Quando accadr&agrave;, riceverai un\'altra email da questo indirizzo.' . "\n\n" . $txt[130];

// For the below two messages, %1$s is the user's display name, %2$s is their username, %3$s is the activation code, and %4$s is the activation link (the last two are only for activation.)
$txt['resend_activate_message'] = 'Ora hai registrato un account su ' . $context['forum_name'] . ', %1$s!' . "\n\n" . 'Lo username &egrave; "%2$s".' . "\n\n" . 'Prima di poterti loggare, devi attivare il tuo account. Per far questo, per favore segui questo link:' . "\n\n" . '%4$s' . "\n\n" . 'Se dovessi avere qualche problema con l\'attivazione, per favore usa il codice "%3$s".' . "\n\n" . $txt[130];
$txt['resend_pending_message'] = 'La tua richiesta di registrazione su ' . $context['forum_name'] . ' &egrave; stata ricevuta, %1$s.' . "\n\n" . 'Lo username con cui ti sei registrato &egrave; %2$s.' . "\n\n" . 'Prima di poterti loggare e iniziare ad usare i forum, la tua richiesta dovr&agrave; essere esaminata e approvata.  Quando accadr&agrave;, riceverai un\'altra email da questo indirizzo.' . "\n\n" . $txt[130];

$txt['ban_register_prohibited'] = 'Spiacente, non ti &egrave; permesso iscriverti a questo forum';
$txt['under_age_registration_prohibited'] = 'Spiacente, ma agli utenti minori di %d anni non &egrave; permesso registrarsi su questo forum.';

$txt['activate_account'] = 'Attivazione account';
$txt['activate_success'] = 'Il tuo account &egrave; stato attivato con successo. Puoi procedere con il login.';
$txt['activate_not_completed1'] = 'Il tuo indirizzo email deve essere convalidato prima che tu possa loggarti.';
$txt['activate_not_completed2'] = 'Hai bisogno di una nuova email di attivazione?';
$txt['activate_after_registration'] = 'Grazie per esserti registrato. Presto riceverai una email con il link per l\'attivazione del tuo account.  Se dopo un p&ograve; di tempo non hai ancora ricevuto nessuna email, controlla nella tua cartella di spam.';
$txt['invalid_userid'] = 'L\'utente non esiste';
$txt['invalid_activation_code'] = 'Codice di attivazione non valido';
$txt['invalid_activation_username'] = 'Username o email';
$txt['invalid_activation_new'] = 'Se ti sei registrato con un indirizzo email errato, inserisci qui un nuovo indirizzo e la tua password.';
$txt['invalid_activation_new_email'] = 'Nuovo indirizzo email';
$txt['invalid_activation_password'] = 'Vecchia password';
$txt['invalid_activation_resend'] = 'Reinvia il codice di attivazione';
$txt['invalid_activation_known'] = 'Se conosci gi&agrave; il tuo codice di attivazione, per favore inseriscilo qui.';
$txt['invalid_activation_retry'] = 'Codice di Attivazione';
$txt['invalid_activation_submit'] = 'Attiva';

$txt['coppa_not_completed1'] = 'L\'amministratore non ha ancora ricevuto il consenso di un genitore/tutore per il tuo account.';
$txt['coppa_not_completed2'] = 'Hai bisogno di pi&ugrave; dettagli?';

$txt['awaiting_delete_account'] = 'Il tuo account &egrave; stato selezionato per l\'eliminazione!<br />Se desideri ripristinare il tuo account, per favore seleziona il box &quot;Riattiva il mio account&quot;, e loggati nuovamente.';
$txt['undelete_account'] = 'Riattiva il mio account';

$txt['change_email_success'] = 'Hai cambiato la tua casella email, e ti sar&agrave; spedita una nuova email di attivazione.';
$txt['resend_email_success'] = 'La email per la nuova attivazione &egrave; stata correttamente inviata.';
// Use numeric entities in the below three strings.
$txt['change_password'] = 'Dettagli Nuova Password';
$txt['change_password_1'] = 'Le impostazioni per il tuo login a';
$txt['change_password_2'] = 'sono stati cambiati e la tua password resettata. Qui sotto le nuove impostazioni per il login.';

$txt['maintenance3'] = 'Questa board &egrave; in Modalit&agrave; Manutenzione.';

// These two are used as a javascript alert; please use international characters directly, not as entities.
$txt['register_agree'] = 'Per favore leggi e accetta i termini prima di registrarti.';
$txt['register_passwords_differ_js'] = 'Le due password che hai inserito non coincidono!';

$txt['approval_after_registration'] = 'Grazie per esserti registrato. L\'amministratore deve approvare la tua registrazione prima che tu possa usare il tuo account, riceverai tra breve una email contenente la decisione dell\'amministratore.';

$txt['admin_settings_desc'] = 'Qui puoi cambiare una serie di impostazioni relative alla registrazione dei nuovi utenti.';

$txt['admin_setting_registration_method'] = 'Metodo di registrazione utilizzato per i nuovi utenti';
$txt['admin_setting_registration_disabled'] = 'Registrazioni Disabilitate';
$txt['admin_setting_registration_standard'] = 'Registrazione Immediata';
$txt['admin_setting_registration_activate'] = 'Attivazione Utenti';
$txt['admin_setting_registration_approval'] = 'Utenti da Approvare';
$txt['admin_setting_notify_new_registration'] = 'Avvisa gli amministratori quando si iscrive un nuovo utente';
$txt['admin_setting_send_welcomeEmail'] = 'Invia una email di benvenuto ai nuovi utenti';

$txt['admin_setting_password_strength'] = 'Resistenza richiesta per le password degli utenti';
$txt['admin_setting_password_strength_low'] = 'Bassa - almeno 4 caratteri';
$txt['admin_setting_password_strength_medium'] = 'Media - non pu&ograve; contenere lo username';
$txt['admin_setting_password_strength_high'] = 'Alta - password alfanumerica';

$txt['admin_setting_image_verification_type'] = 'Complessit&agrave; dell\'immagine visiva di verifica';
$txt['admin_setting_image_verification_type_desc'] = 'Pi&ugrave; l\'immagine &egrave; complessa pi&ugrave; difficilmente verr&agrave; bypassata dai bot';
$txt['admin_setting_image_verification_off'] = 'Disabilita';
$txt['admin_setting_image_verification_vsimple'] = 'Molto semplice - Normale testo sull\'immagine';
$txt['admin_setting_image_verification_simple'] = 'Semplice - lettere colorate sovrapposte, nessun disturbo immagine';
$txt['admin_setting_image_verification_medium'] = 'Medio - lettere colorate sovrapposte, con disturbo immagine ';
$txt['admin_setting_image_verification_high'] = 'Alto - lettere ad angolo, disturbo considerevole';
$txt['admin_setting_image_verification_sample'] = 'Esempio';
$txt['admin_setting_image_verification_nogd'] = '<b>Nota:</b> poich&egrave; questo server non ha la libreria GD installata le differenti regolazioni di complessit&agrave; non avranno effetto.';

$txt['admin_setting_disable_visual_verification'] = 'Disabilita l\'utilizzo della verifica visiva durante la registrazione';

$txt['admin_setting_coppaAge'] = 'Et&agrave; sotto cui applicare le restrizioni di registrazione';
$txt['admin_setting_coppaAge_desc'] = '(Imposta 0 per disabilitare)';
$txt['admin_setting_coppaType'] = 'Azione da intraprendere quando un utente sotto l\'et&agrave; minima si registra';
$txt['admin_setting_coppaType_reject'] = 'Rifiuta la loro registrazione';
$txt['admin_setting_coppaType_approval'] = 'Richiedi l\'autorizzazione di un genitore/tutore';
$txt['admin_setting_coppaPost'] = 'Indirizzo postale a cui i moduli di autorizzazione devono essere spediti';
$txt['admin_setting_coppaPost_desc'] = 'Applica solo se la restrizione d\'et&agrave; &egrave; attivata';
$txt['admin_setting_coppaFax'] = 'Numero di fax a cui i moduli di autorizzazione devono essere faxati';
$txt['admin_setting_coppaPhone'] = 'Numero di telefono per genitori da contattare per domande riguardanti i limiti d\'et&agrave;';
$txt['admin_setting_coppa_require_contact'] = 'Devi inserire un indirizzo postale o un numero di fax se &egrave; richiesta l\'autorizzazione di un genitore/tutore.';

$txt['admin_register'] = 'Registrazione di un nuovo utente';
$txt['admin_register_desc'] = 'Da qui puoi registrare nuovi utenti del forum, e se desideri, inviargli i loro dettagli via email.';
$txt['admin_register_username'] = 'Nuovo Username';
$txt['admin_register_email'] = 'Indirizzo Email';
$txt['admin_register_password'] = 'Password';
$txt['admin_register_username_desc'] = 'Username del nuovo utente';
$txt['admin_register_email_desc'] = 'Indirizzo email dell\'utente';
$txt['admin_register_password_desc'] = 'Password per l\'utente';
$txt['admin_register_email_detail'] = 'Invia una email con la nuova password all\'utente';
$txt['admin_register_email_detail_desc'] = 'Casella email richiesta, ma non verificata';
$txt['admin_register_email_activate'] = 'Richiedi agli utenti di attivare l\'account';
$txt['admin_register_group'] = 'Gruppo Primario';
$txt['admin_register_group_desc'] = 'Gruppo primario a cui apparterranno i nuovi utenti';
$txt['admin_register_group_none'] = '(nessun gruppo primario)';
$txt['admin_register_done'] = 'L\'utente %s si &egrave; registrato con successo!';

$txt['admin_browse_register_new'] = 'Registra un nuovo utente';

// Use numeric entities in the below three strings.
$txt['admin_notify_subject'] = 'Si &egrave; iscritto un nuovo utente';
$txt['admin_notify_profile'] = '%s si &egrave; iscritto come nuovo membro del tuo forum. Clicca sul Link in basso per visualizzare il suo profilo.';
$txt['admin_notify_approval'] = 'Prima che questo utente possa iniziare a postare, il suo account deve essere approvato. Clicca sul link qui sotto per accedere alla pagina delle approvazioni';

$txt['coppa_title'] = 'Forum con Restrizioni d\'Et&agrave;';
$txt['coppa_after_registration'] = 'Grazie per esserti registrato su ' . $context['forum_name'] . '.<br /><br />Siccome hai meno di {MINIMUM_AGE} anni, &egrave; richiesto dalla legge che
	tu ottenga il permesso dei tuoi genitori o tutori prima di poter iniziare ad usare il tuo account.  Per completare l\'attivazione del tuo account per favore stampa il modulo sottostante:';
$txt['coppa_form_link_popup'] = 'Carica il Modulo in una Finestra Nuova';
$txt['coppa_form_link_download'] = 'Scarica il Modulo come File di Testo';
$txt['coppa_send_to_one_option'] = 'Quindi fai si che un tuo genitore/tutore spedisca il modulo compilato:';
$txt['coppa_send_to_two_options'] = 'Quindi fai si che un tuo genitore/tutore spedisca il modulo compilato da entrambi:';
$txt['coppa_send_by_post'] = 'Spedisci, al seguente indirizzo:';
$txt['coppa_send_by_fax'] = 'Invia un fax, al seguente numero:';
$txt['coppa_send_by_phone'] = 'In alternativa, fai si che chiamino l\'amministratore a questo numero {PHONE_NUMBER}.';

$txt['coppa_form_title'] = 'Modulo di autorizzazione per la registrazione al ' . $context['forum_name'];
$txt['coppa_form_address'] = 'Indirizzo';
$txt['coppa_form_date'] = 'Data';
$txt['coppa_form_body'] = 'Io {PARENT_NAME},<br /><br />Do il permesso a {CHILD_NAME} (child name) di diventare un utente registrato del forum: ' . $context['forum_name'] . ', con lo username: {USER_NAME}.<br /><br />Sono a conoscenza che alcune informazioni personali inserite da {USER_NAME} possono essere mostrate ad altri utenti del forum.<br /><br />Firma:<br />{PARENT_NAME} (Genitore/Tutore).';

$txt['visual_verification_label'] = 'Verifica visiva';
$txt['visual_verification_description'] = 'Scrivi le lettere mostrate nell\'immagine';
$txt['visual_verification_sound'] = 'Ascolta le lettere';
$txt['visual_verification_sound_again'] = 'Ascolta nuovamente';
$txt['visual_verification_sound_close'] = 'Chiudi finestra';
$txt['visual_verification_request_new'] = 'Richiedi un\'altra immagine';
$txt['visual_verification_sound_direct'] = 'Hai problemi nell\'ascoltarlo?  Ritenta con un link diretto.';

?>
<?php

global $at, $reverseLockout, $use_lockout_rules, $obey_x_forwarded_headers,
       $max_login_attempts, $lockout_notification_addresses,
       $max_login_attempts_per_IP, $activate_CAPTCHA_after_failed_attempts,
       $log_violated_lockout_rules, $log_violated_max_user_logins,
       $log_violated_max_IP_logins, $log_CAPTCHA_enabled, $lockout_useSendmail,
       $lockout_smtpServerAddress, $lockout_smtpPort, $lockout_sendmail_path,
       $lockout_sendmail_args, $lockout_pop_before_smtp,
       $lockout_encode_header_key, $lockout_smtp_auth_mech,
       $lockout_smtp_sitewide_user, $lockout_smtp_sitewide_pass;



// Turn this on if you want to restrict login access according
// to the rules you have configured in the lockout_table.php
// file
//
// 1 = yes, enable this functionality
// 0 = no, do not use the lockout table
//
//$use_lockout_rules = 0;

// Custom
$use_lockout_rules = 1;


// You can reverse the logic of this plugin by using this
// setting.  That is, you can lock out everyone *except* those 
// users and domains listed in the lockout file (lockout_table.php)
//
// If you use this functionality, you should set this variable
// to the location of the file to be displayed when a user is 
// locked out, or use the "##BAD_LOGIN_PAGE##" constant, that
// indicates that the standard SquirrelMail "bad username or 
// password" page (with simulated bad login delay) is to be 
// displayed.
//
// Set this to an empty string to use standard functionality.
//
$reverseLockout = '';
// $reverseLockout = '##BAD_LOGIN_PAGE##';
// $reverseLockout = 'locked_out.php';



// You may change this if your usernames are in the form of
// regular email addresses, but the "at" symbol is different
//
$at = '@';



// If you run SquirrelMail behind a proxy server, where the
// client domain information is in X_FORWARDED_* headers,
// enable this setting (set it to 1), otherwise, leave this
// off (zero) to reduce the chance that someone at a locked-out
// domain can try to forge the hostname in their request
// headers.
//    
// $obey_x_forwarded_headers = 1;
$obey_x_forwarded_headers = 0;



// To restrict the number of failed login attempts before a
// user is permanently disallowed access to SquirrelMail,
// set this to the desired number of allowable attempts,
// the time within which the failures must occur and how
// long the account should be disabled.  
//
// This setting consists of three values separated by colons.
// The first is the number of allowable login attempts, the
// the second is the number of minutes within which the login 
// failures must occur to result in the account being 
// disabled, and the third is the number of minutes that the 
// account should be disabled.
//
// For example, with a setting of 3:5:10, if a user tries to 
// log in with the wrong password 3 times within a 5 minute 
// time span, the user will be disallowed the ability to log 
// in again for 10 minutes.
//
// You may set the middle number to zero to indicate that
// time between failed attempts should not be considered, 
// and only the number of successive login failures - no 
// matter when they happen - should be considered.  Likewise,
// if the third number is set to zero, the account will be 
// permanently blocked (see below).  For example, 3:0:0 would 
// mean that any three successive login failures will result 
// in the account being permanently disabled.
//
// When a user's account is disabled (NOTE: it is ONLY disabled
// from SquirrelMail access -- this has NO EFFECT on any other
// methods that the user may have for accessing the mail server),
// a preferences setting is added to a special preference set
// for this plugin under the username:
//
//    lockout_plugin_login_failure_information
//
// The preference setting that is added to indicate that an 
// account is locked out is the username, followed with:
//
//    _TOO_MANY_FAILED_LOGIN_ATTEMPTS 
//
// So if the user account being locked out is "jose@example.org",
// then the preference that is added looks like:
//
//    jose@example.org_TOO_MANY_FAILED_LOGIN_ATTEMPTS=1176601134
//
// If the account is permanently disabled (because the third 
// number in this setting is zero) and should be re-enabled, 
// or the account should be unlocked again before the lockout 
// window is over, the administrator will need to manually 
// remove this preference.  This will allow the username to 
// be used through SquirrelMail again.
//
// Set as an empty value to disable this functionality.
//
// $max_login_attempts = '3:5:0';
// $max_login_attempts = '3:0:10';
//$max_login_attempts = '';

// Custom
$max_login_attempts = '10:12:0';


// You may also choose to block multiple failed login attempts
// from any one IP address in the same manner as with
// $max_login_attempts.
//
// The values for this setting carry the same meaning as
// those for $max_login_attempts, except lockout is done
// per-client IP address instead of per-username.
//
// If you need to manually re-enable an IP address, go to
// the same preference set:
//
//    lockout_plugin_login_failure_information
//
// The preference setting therein for locked-out IP addresses
// looks like:
//
//    999.999.99.99_TOO_MANY_FAILED_LOGIN_ATTEMPTS=1176601134
//
// Of course, "999.999.99.99" will be an actual IP address.
//
// Set as an empty value to disable this functionality.
//
// $max_login_attempts_per_IP = '10:15:30';
// $max_login_attempts_per_IP = '25:0:15';
// $max_login_attempts_per_IP = '20:60:0';
$max_login_attempts_per_IP = '';



// If you also download the CAPTCHA plugin, you can choose to
// have it activated after a certain number of failed login
// attempts from a certain IP address, and before the IP
// address is possibly locked out permanently.
//
// The values for this setting carry mostly the same meaning as
// those for $max_login_attempts.  The first number is the number
// of allowable login attempts without requiring a CAPTCHA,
// the second number is how many minutes within which the login
// failures must occur to activate the CAPTCHA plugin.  The
// third number is the number of minutes that the CAPTCHA plugin
// will remain activated for the IP address.
//
// Just as with $max_login_attempts, if the second number is
// zero, there is no time restriction on when the successive
// failed logins may occur, and if the third number is zero,
// the CAPTCHA plugin will remain permanently enabled for this
// IP address.
//
// There is an optional fourth number, which, when set to 1,
// indicates that if a successful account login originates
// from an IP address that is currently subject to CAPTCHA
// validation, the CAPTCHA should immediately be deactivated
// for that IP address (no matter what the third number is).
// When set to 0 or not given, this feature is not activated
// (the third number determines how long CAPTCHAs are required).
//
// If you are also using $max_login_attempts_per_IP, then you
// need to make the CAPTCHA values here lower, otherwise the
// IP address will be locked out before the CAPTCHA plugin can
// be activated.
//
// You do should NOT activate the CAPTCHA plugin yourself, as
// this plugin will do so based on the rules defined here.
//
//$activate_CAPTCHA_after_failed_attempts = '15:30:0:0';
//$activate_CAPTCHA_after_failed_attempts = '15:0:30:1';
//$activate_CAPTCHA_after_failed_attempts = '5:10:30:0';
$activate_CAPTCHA_after_failed_attempts = '';



// If you want administrative notifications of users being locked
// out per the $max_login_attempts setting above, set this value
// to the target email address(es) for the notifications to be sent.
// It can consist of one or more comma-separated email addresses.
//
// This setting may only be desirable when the third number in 
// $max_login_attempts is zero.
// 
// Set as an empty value if no notifications are desired.
//
// $lockout_notification_addresses = 'postmaster';
$lockout_notification_addresses = '';



// If you'd like to log when users trip any of the limitations
// defined above for $use_lockout_rules, $max_login_attempts,
// $activate_CAPTCHA_after_failed_attempts, or 
// $max_login_attempts_per_IP, then turn on the corresponding
// setting below.  $log_violated_lockout_rules will log an
// event when the rules in lockout_table.php cause a login
// failure.  Note that logging is accomplished by using the
// Squirrel Logger plugin, so you'll need to have that
// installed and configured with an additional event type
// called "LOCKOUT".
//
$log_violated_lockout_rules = 0;
$log_violated_max_user_logins = 0;
$log_violated_max_IP_logins = 0;
$log_CAPTCHA_enabled = 0;



// When sending administrative notifications, you may want to send
// them using different SMTP authentication credentials or change
// any of the other Sendmail or SMTP settings used normally in
// SquirrelMail's normal use for sending mail.  If so, change the
// appropriate setting here.  These values MUST be set to "NULL"
// to indicate that the normal SquirrelMail configuration values
// are to be used.
//
$lockout_useSendmail = NULL;
$lockout_smtpServerAddress = NULL;
$lockout_smtpPort = NULL;
$lockout_sendmail_path = NULL;
$lockout_sendmail_args = NULL;
$lockout_pop_before_smtp = NULL;
$lockout_encode_header_key = NULL;
$lockout_smtp_auth_mech = NULL;
$lockout_smtp_sitewide_user = NULL;
$lockout_smtp_sitewide_pass = NULL;




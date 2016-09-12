<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'myve_header_before_html', 'myve_loggedincheck' );

if( ! function_exists( 'myve_loggedincheck' ) ) {
	function myve_loggedincheck() {

		require_once('/var/www/my.vanderbilt.edu/offline/sessions.php');
		$session = new Session();

		// is this site behind vunetid
		$vunetidprotect = get_option('vubrand_vunetidprotect');
		if ($vunetidprotect == 'yes') {
			myve_loggedin();
		} else {
			myve_loggedout();
		}
	}
}

if( ! function_exists( 'myve_loggedin' ) ) {
	function myve_loggedin() {

		$request = get_permalink();
		$sitename = urlencode(get_bloginfo('name')." - " .get_the_title());

		if ($_SESSION['myvuwebrequested'] = '') {
			$_SESSION['myvuwebrequested'] = $request;
		}

		$_SESSION['myvuwebsitename'] = $sitename;

		if (isset($_SESSION['myvuweblogin'])) {
			require_once('/var/www/my.vanderbilt.edu/offline/phpaes/index.php');
			// LDAP variables
			$basedn = "ou=people,dc=vanderbilt,dc=edu";
			$ldaprdn  = "uid=" . $_SESSION['myvuweblogin'] . ",ou=people,dc=vanderbilt,dc=edu";
			$ldappass = $aescbc->decrypt($_SESSION['keymyvuweblogin']);
			$ldaphost = "ldaps://ldap.vunetid.vanderbilt.edu";
			// Connecting to LDAP
			$ldapconn = ldap_connect($ldaphost);
			if ($ldapconn) {
				$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
				if ($ldapbind) {
					$filter = "(uid=" . $_SESSION['myvuweblogin'] . "*)";
					$limit = array("cn", "mail");
					$getbca = @ldap_search($ldapconn, $basedn, $filter, $limit);
					$entry = @ldap_first_entry($ldapconn, $getbca);
					$attrs = @ldap_get_attributes($ldapconn, $entry);
				}
			}
			// user has logged in successfully
			if ($ldapconn && $ldapbind) {
				@ldap_unbind($ldapconn);
				@ldap_close($ldapconn);
				// show logged in content

				$vunetidloggedin = 'true';

			} // end if login session variable exists
		} // login session variable does not exist - to send back to login page
		else {
			#echo "<p>USER SESSION - myvelogin : ".$_SESSION['myvelogin']."</p>";
			header("Location: /login/?request=$request");
		}
	}
}

if( ! function_exists( 'myve_loggedout' ) ) {
	function myve_loggedout() {
		$siteurl = home_url();
		$sitetitle = get_bloginfo('name');
		$_SESSION['myvuwebrequested'] = $siteurl;
		$_SESSION['myvuwebsitename'] = $sitetitle;
	}
}
<?php /*

#
#   Sample lockout table
#
#   One user or domain per line - usernames will be matched against
#   actual IMAP logins, domain will be matched against both the 
#   domain of the URL used to access the login page and the domain
#   portion of usernames that consist of a full email address
#
#   A user is indicated by "user:", while a domain is indicated by
#   "domain:" (without quotes).  The user name or domain name should
#   follow, after which should be the location that will be displayed
#   to the locked out user(s).  This location should be separated 
#   from the user name or domain name by whitespace and can be one of 
#   three things:
#
#      - A URI to any web page, which must start with "http"
#      - A file name of a custom page, which should be located 
#        in the lockout plugin directory
#      - The text "##BAD_LOGIN_PAGE##" (without the quotes),
#        which indicates that the user will be shown the
#        standard error page that is also shown when the user
#        or password is incorrect.
#
#   For example:
#   
#      user: jose@domain.com   locked_out.php
#
#   Also note that user names or domain names can contain the wildcards * 
#   and ? which indicate "any number of (or zero) characters" and "one 
#   alphanumeric character" respectively.  
#
#   For example, the username "jose_r*@domain.com" would match the 
#   username "jose_rodriguez@domain.com" as well as "jose_riviera@domain.com".  
#   "jose?@domain.com" would match "jose5@domain.com", but not 
#   "jose@domain.com", although the pattern "jose*@domain.com" would 
#   match both "jose5@domain.com" and "jose@domain.com".  
#
#   "domain.*" would match "domain.com", "domain.ca" as well as "domain.net", 
#   while "domain.??" would match "domain.ca" but not "domain.com" nor 
#   "domain.net".
#


user:    jose@mydomain.com    ##BAD_LOGIN_PAGE##
domain:  somedomain.net       locked_out.php


# wildcard examples
#
user:    mary*                locked_out.php
domain:  corporatedomain.*    http://www.google.com



*/

// Custom
user:   admin                 locked_out.php
user:   root                  locked_out.php

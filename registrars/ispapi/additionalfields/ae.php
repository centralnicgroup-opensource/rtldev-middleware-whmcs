<?php
## .AE DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Agreement",
    "Type" => "tickbox",
    "Description" => "Tick to confirm that you agree to the <a href='https://www.nic.ae/content.jsp?action=termcond_ae' target='_blank'>Registry Terms and Conditions of Registration</a> upon new registration of .AE domain names.",
    "Required" => true,
    "Ispapi-Name" => "X-AE-ACCEPT-REGISTRATION-TAC"
);

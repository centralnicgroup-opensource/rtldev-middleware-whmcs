<?php
## .ABOGADO DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = array();
$additionaldomainfields[$tld][] = array(
    "Name" => "Highly Regulated TLD",
    "Type" => "dropdown",
    "Description" => "<div><b>Safeguards for Highly-regulated TLDs</b><br/>
                      <p>You understand and agree that you will abide by and be compliant with these additional terms:</p>
                      <ol><li>Administrative Contact Information. You agree to provide administrative contact information, which must be kept up-to-date, for the notification of complaints or reports of registration abuse, as well as the contact details of the relevant regulatory, or industry selfregulatory, bodies in their main place of business.</li>
                      <li>Representation. You confirm and represent that you possesses any necessary authorizations, charters, licenses and/or other related credentials for participation in the sector associated with such Highly-Regulated TLD.</li>
                      <li>Report of Changes of Authorization, Charters, Licenses, Credentials. You agree to report any material changes to the validity of your authorizations, charters, licenses and/or other related credentials for participation in the sector associated with the Highly-Regulated TLD to ensure you continue to conform to the appropriate regulations and licensing requirements and generally conduct you activities in the interests of the consumers you serve..</li>
                      </ol></div>",
    "Options" => ",I accept",
    "Required" => true,
    "Ispapi-Name" => "X-ATTORNEY-ACCEPT-HIGHLY-REGULATED-TAC",
    "Ispapi-Options" => ",1"
);

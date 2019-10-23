<?php
## .IE DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant Class",
    "Type" => "dropdown",
    "Options" => ",Company,Business Owner,Club/Band/Local Group,School/College,State Agency,Charity,Blogger/Other",
    "Description" => "",
    "Required" => true,
    "Ispapi-Name" => "X-IE-REGISTRANT-CLASS",
    "Ispapi-Options" => ",Company,Business Owner,Club/Band/Local Group,School/College,State Agency,Charity,Blogger/Other",
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Proof of connection to Ireland",
    "Type" => "text",
    "Description" => "Provide any information supporting your registration request, such as proof of eligibility (e.g. VAT, RBN, CRO, CHY, NIC, or Trademark number; school roll number; link to social media page) or a brief explanation of why you want this domain and what you will use it for.",
    "Required" => true,
    "Ispapi-Name" => "X-IE-REGISTRANT-REMARKS",
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant VAT ID",
    "Type" => "text",
    "Required" => false,
    "Description" => "(Only for Organization)",
    "Ispapi-Name" => "X-REGISTRANT-VATID"
);
$additionaldomainfields[$tld][] = array(
    "Name" => "Registrant ID number",
    "Type" => "text",
    "Required" => false,
    "Ispapi-Name" => "X-REGISTRANT-IDNUMBER"
);

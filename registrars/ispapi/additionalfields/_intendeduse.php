<?php
$additionaldomainfields[$tld][] = [
    "Name" => isset($fieldname) ? $fieldname : "Intended Use",
    "Type" => "text",
    "Required" => true,
    "Ispapi-Name" => "X-CORE-INTENDED-USE"
];

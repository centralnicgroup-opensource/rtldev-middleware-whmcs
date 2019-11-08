<?php
## .MELBOURNE DOMAIN REQUIREMENTS ##
$additionaldomainfields[$tld] = [];
$additionaldomainfields[$tld][] = [
    "Name" => "Nexus Category",
    "Type" => "dropdown",
    "Required" => true,
    "Options" => implode(",", [
        "A|Criteria A - Victorian Entities",
        "B|Criteria B - Victorian Residents",
        "C|Criteria C - Associated Entities"
    ]),
    "Default" => "A|Criteria A - Victorian Entities",
    "Description" => "<div style='padding:10px 0px;text-align:justify'><b>Registration Eligibility</b><br/>In order to register or renew a domain name the Applicant or Registrant must satisfy one of the following Criteria A, B or C below:<br/><br/>
                        <b>Criteria A – Victorian Entities</b><br/>The Applicant must be an entity registered with the Australian Securities and Investments Commission or the Australian Business Register that:
                        <ul><li>has an address in the State of Victoria associated with its ABN, ACN, RBN or ARBN; or</li><li>has a valid corporate address in the State of Victoria.</li></ul><br/>
                        <b>Criteria B – Victorian Residents</b><br/>The Applicant must be an Australian citizen or resident with a valid address in the State of Victoria.<br/><br/>
                        <b>Criteria C – Associated Entities</b><br/>The Applicant must be an Associated Entity. The Applicant may only apply for a domain name that is an Exact Match or Partial Match to, or an Abbreviation, or an Acronym of:
                        <ul><li>the business name of the Applicant, or name by which the Applicant is commonly known ( i.e. a nickname) and the business name must be registered with the appropriate authority in the jurisdiction in which that business is domiciled; or</li>
                        <li>a product that the Associated Entity manufactures or sells to entities or individuals residing in the State of Victoria;</li>
                        <li>a service that the Associated Entity provides to residents of the State of Victoria;</li>
                        <li>an event that the Associated Entity organises or sponsors in the State of Victoria;</li>
                        <li>an activity that the Associated Entity facilitates in the State of Victoria; or</li>
                        <li>a course or training program that the Associated Entity provides to residents of the State of Victoria.</li></div>",
    "Ispapi-Name" => "X-MELBOURNE-NEXUS-CATEGORY"
];

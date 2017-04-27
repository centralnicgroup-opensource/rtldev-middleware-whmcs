{if file_exists("templates/$template/$registrar/whoisprivacy_ca.tpl")}
    {include file="$template/$registrar/whoisprivacy_ca.tpl"}
{else}

    <h3>WHOIS Privacy - {$domain}</h3>

    {if $error}
        <div class="alert alert-danger text-center">
            <p>There was an error while setting the WHOIS Privacy: {$error}</p>
        </div>
    {/if}
    <br>

    <p>
    <h4>.CA Registrant WHOIS Privacy</h4>
    The Canadian Internet Registration Authority (“CIRA”), is committed to protecting the privacy of personal information in the course of its operation and administration of the Canadian country code top-level domain name (the “Registry”).
    </p>

    <p>Registrants with the following Canadian Presence Requirement (CPR) categories are considered to be individuals:</p>
    <ul>
        <li><strong>CCT</strong> - Canadian citizens</li>
        <li><strong>RES</strong> - permanent residents</li>
        <li><strong>LGR</strong> - legal representatives</li>
        <li><strong>ABO</strong> - aboriginal peoples</li>
    </ul>
    <p>All other CPR categories are considered to be non-individual Registrants. A non-individual is not permitted to change their WHOIS privacy settings.</p>
    {if $protectable}
        <p style="color:green;">The current registrant CPR is <strong>{$legaltype}</strong>, therefore a change of the WHOIS privacy setting is permitted.</p>
    {else}
        <p style="color:red;">The current registrant CPR is <strong>{$legaltype}</strong>, therefore a change of the WHOIS privacy setting is <strong>NOT</strong> permitted.</p>
    {/if}

    <div style="text-align:center;">
        <br>
        <h4>WHOIS Privacy Status:</h4>

    	{if $protectable}
            {if $protected}
                <div class="alert alert-success">
                    <p>Your WHOIS information is currently protected!</p>
                </div>
                <form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails&modop=custom&a={$smarty.request.a|htmlspecialchars}">
                    <input type="hidden" name="id" value="{$domainid}" />
                    <input type='hidden' name="idprotection" value='disable' />
                    <p><input type="submit" class="btn btn-danger btn-large" value="Disable WHOIS Privacy" /></p>
                </form>
            {else}
                <div class="alert alert-danger">
                    <p>Your WHOIS information is currently unprotected!</p>
                </div>
                <form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails&modop=custom&a={$smarty.request.a|htmlspecialchars}">
                    <input type="hidden" name="id" value="{$domainid}" />
                    <input type='hidden' name="idprotection" value='enable' />
                    <p><input type="submit" class="btn btn-success btn-large" value="Enable WHOIS Privacy" /></p>
                </form>
            {/if}
    	{/if}

    </div>

{/if}

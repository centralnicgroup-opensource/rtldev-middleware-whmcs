{if file_exists("templates/$template/$registrar/whoisprivacy_ca.tpl")}
{include file="$template/$registrar/whoisprivacy_ca.tpl"}
{else}
{include file="$template/pageheader.tpl" title="WHOIS Privacy - $domain"}

{if $error}
<div class="alert alert-error textcenter">
    <p>There was an error while setting the WHOIS Privacy: {$error}</p>
</div>
{elseif $protectable}
    {if $protected}
    <div class="alert alert-info">
        <p>Your WHOIS information is currently protected!</p>
    </div>
    {else}
    <div class="alert alert-error">
        <p><strong>Your WHOIS information is currently unprotected!</strong></p>
    </div>
    {/if}
{/if}

<p><strong>.CA Registrant WHOIS Privacy: </strong>
The Canadian Internet Registration Authority (“CIRA”), is committed to protecting the privacy of personal information in the course of its operation and administration of the Canadian country code top-level domain name (the “Registry”).
</p>

<br />

<div class='row'>
    <div class='col70'>
<p>Registrants with the following Canadian Presence Requirement (CPR) categories are considered to be individuals:</p>
<ul>
<li><strong>CCT</strong> - Canadian citizens</li>
<li><strong>RES</strong> - permanent residents</li>
<li><strong>LGR</strong> - legal representatives</li>
<li><strong>ABO</strong> - aboriginal peoples</li>
</ul>
<p>All other CPR categories are considered to be non-individual Registrants. A non-individual is not permitted to change their WHOIS privacy settings.</p>
{if $protectable}
<p>The current registrant CPR is <strong>{$legaltype}</strong>, therefore a change of the WHOIS privacy setting is permitted.</p>
{else}
<p>The current registrant CPR is <strong>{$legaltype}</strong>, therefore a change of the WHOIS privacy setting is <strong>NOT</strong> permitted.</p>
{/if}

    </div>
    <div class='col30'>
	{if $protectable}
        {if $protected}
            <div class="internalpadding">
                <p><h4><strong>WHOIS Privacy Status:</strong></h4></p>
                <p><strong>Enabled - WHOIS is protected</strong></p>

                <form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails&modop=custom&a={$smarty.request.a|htmlspecialchars}">
                    <input type="hidden" name="id" value="{$domainid}" />
                    <input type='hidden' name="idprotection" value='disable' />
                    <p><input type="submit" class="btn btn-danger btn-large" value="Disable WHOIS Privacy" /></p>
                </form>
            </div>
        {else}
            <div class="internalpadding">
                <p><h4><strong>WHOIS Privacy Status:</strong></h4></p>
                <p><strong>Disabled - WHOIS is unprotected</strong></p>

                <form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails&modop=custom&a={$smarty.request.a|htmlspecialchars}">
                    <input type="hidden" name="id" value="{$domainid}" />
                    <input type='hidden' name="idprotection" value='enable' />
                    <p><input type="submit" class="btn btn-success btn-large" value="Enable WHOIS Privacy" /></p>
                </form>
            </div>
        {/if}
	{else}
		&nbsp;
	{/if}
    </div>
</div>

<form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails">
<input type="hidden" name="id" value="{$domainid}" />
<p><input type="submit" value="{$LANG.clientareabacklink}" class="btn" /></p>
</form>
{/if}


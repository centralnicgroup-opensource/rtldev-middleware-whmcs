{if file_exists("templates/$template/$registrar/whoisprivacy.tpl")}
{include file="$template/$registrar/whoisprivacy.tpl"}
{else}
{assign var="img_logo" value="modules/registrars/$registrar/images/whoistrustee_logo.gif"}
{assign var="img_example" value="modules/registrars/$registrar/images/whoistrustee_full.png"}
{if file_exists($img_logo)}
<div class='row'>
    <div class='col40'>
        <img src='{$img_logo}' />
    </div>
    <div class='col60'>
        <h1>{$domain}</h1>
    </div>
</div>
{else}
{include file="$template/pageheader.tpl" title="WHOIS Privacy - $domain"}
{/if}

{if $error}
<div class="alert alert-error textcenter">
    <p>There was an error while setting the WHOIS Privacy: {$error}</p>
</div>
{else}
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

<p><strong>Why WHOIS Privacy is important:</strong>
Domain name registrations requires contact information be provided for storage and display in the public WHOIS database. This means that anyone in the world can view the name, address, phone number and email without restriction. Publicly making this information available puts domain owners at a risk for spam and potential identity theft. Our WHOIS Privacy service securely replaces all of this information, and completely shields all WHOIS data from the outside world.
</p>

<br />

<div class='row'>
    <div class='col70'>
		{if file_exists($img_example)}<img src='{$img_example}' />{else}&nbsp;{/if}
    </div>
    <div class='col30'>
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
    </div>
</div>

<form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails">
<input type="hidden" name="id" value="{$domainid}" />
<p><input type="submit" value="{$LANG.clientareabacklink}" class="btn" /></p>
</form>
{/if}


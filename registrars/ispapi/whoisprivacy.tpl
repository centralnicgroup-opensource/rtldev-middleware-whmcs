{literal}
<style>
	#ispapiownerchange a {
		text-decoration: underline;
	}
</style>
{/literal}

<h3>WHOIS Privacy - {$domain}</h3>

{if $successful}
    <div class="alert alert-success text-center">
        <p>WHOIS Privacy Service changes applied successfully.</p>
    </div><br/>
{/if}

{if $error}
    <div class="alert alert-danger text-center">
        <p>There was an error while setting the WHOIS Privacy: {$error}</p>
        {if $missingfields}
            <p>{", "|implode:$missingfields}</p>
        {/if}
    </div><br/>
{/if}

<h4>Why WHOIS Privacy is important</h4>
<p>Domain name registration requires personal contact information be provided for permanent storage managed by third party servers for WHOIS. This means that your name, address, phone number and email is recorded and held by third parties without restriction. Our WHOIS Privacy service securely replaces all of this information and completely shields all WHOIS data from all third parties.</p>
<br/>

<div class="text-center">
    <h4>WHOIS Privacy Status:</h4>
    {if $protected}
            <div class="alert alert-success">
                <p>Your WHOIS information is currently protected!</p>
            </div>
            <form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails&id={$domainid}&modop=custom&a={$smarty.request.a|htmlspecialchars}">
                <input type="hidden" name="id" value="{$domainid}" />
                <input type='hidden' name="idprotection" value='disable' />
                <p><input type="submit" class="btn btn-danger btn-large" value="Disable WHOIS Privacy" /></p>
            </form>
    {else}
            <div class="alert alert-danger">
                <p>Your WHOIS information is currently unprotected!</p>
            </div>
            <form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails&id={$domainid}&modop=custom&a={$smarty.request.a|htmlspecialchars}">
                <input type="hidden" name="id" value="{$domainid}" />
                <input type='hidden' name="idprotection" value='enable' />
                <p><input type="submit" class="btn btn-success btn-large" value="Enable WHOIS Privacy" /></p>
            </form>
    {/if}
</div>

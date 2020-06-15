{if file_exists("templates/$template/$registrar/whoisprivacy.tpl")}
    {include file="$template/$registrar/whoisprivacy.tpl"}
{else}
    {assign var="img_logo" value="modules/registrars/$registrar/images/whoistrustee_logo.gif"}
    {if file_exists($img_logo)}
        <img src='{$img_logo}' />
        <!--<h3>{$domain}</h3>-->
    {else}
        <h3>WHOIS Privacy - {$domain}</h3>
    {/if}

    {if $error}
        <div class="alert alert-danger textcenter">
            <p>There was an error while setting the WHOIS Privacy: {$error}</p>
        </div>
    {/if}

    <p><br>
    <h4>Why WHOIS Privacy is important</h4>
    Domain name registration requires personal contact information be provided for permanent storage managed by third party servers for WHOIS. This means that your name, address, phone number and email is recorded and held by third parties without restriction. Our WHOIS Privacy service securely replaces all of this information and completely shields all WHOIS data from all third parties.
    </p><br>

    <div style="text-align:center;">
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

{/if}

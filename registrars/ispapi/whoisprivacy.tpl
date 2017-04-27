{if file_exists("templates/$template/$registrar/whoisprivacy.tpl")}
    {include file="$template/$registrar/whoisprivacy.tpl"}
{else}
    {assign var="img_logo" value="modules/registrars/$registrar/images/whoistrustee_logo.gif"}
    {assign var="img_example" value="modules/registrars/$registrar/images/whoistrustee_full.png"}
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
    Domain name registrations requires contact information be provided for storage and display in the public WHOIS database. This means that anyone in the world can view the name, address, phone number and email without restriction. Publicly making this information available puts domain owners at a risk for spam and potential identity theft. Our WHOIS Privacy service securely replaces all of this information, and completely shields all WHOIS data from the outside world.
    </p><br>

    <div style="text-align:center;">
        {if file_exists($img_example)}<img src='{$img_example}' />{else}&nbsp;{/if}
        <br><br>
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

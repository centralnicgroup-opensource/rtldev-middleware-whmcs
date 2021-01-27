<h2>Web Apps</h2>
{if !$connectedApps.success}
    <p>An error occured while loading your Web Apps configuration: <span class="label label-danger">{$connectedApps.error}</span></p>
{else}
    {assign "unconnectedApps" array_diff($availableApps, $connectedApps.webapps) nocache }
    {if empty($connectedApps.webapps)}
        <p>No Web Apps are currently connected to your domain. See below a list of available ones:</p>
        {foreach from=$unconnectedApps item=app}
            {if isset($allApps[$app])}
                <a href="?action=domaindetails&id={$id}&modop=custom&a=webapps&webapp={$app}&subaction=connect">
                    <img class="webappthumb" src="{$assetspath}{$allApps[$app].logo}" alt="{$allApps[$app].alt}"/>
                </a>
            {/if}
        {/foreach}
    {else}
        <p>The following Web Apps are already connected to your domain:</p>
        {foreach from=$connectedApps["webapps"] item=app}
            {if isset($allApps[$app])}
                <a href="?action=domaindetails&id={$id}&modop=custom&a=webapps&webapp={$app}&subaction=disconnect">
                    <img class="webappthumb" src="{$assetspath}{$allApps[$app].logo}" alt="{$allApps[$app].alt}"/>
                </a>
            {/if}
        {/foreach}
        {if !empty($unconnectedApps)}
            <a href="#void" onclick="$('#showavailableapps').toggle();">View further available Web Apps</a>
            <div id="showavailableapps" style="display:none">
            {foreach from=$unconnectedApps item=app}
                {if isset($allApps[$app])}
                    <a class="togglewebapp" href="?action=domaindetails&id={$id}&modop=custom&a=webapps&webapp={$app}&subaction=connect">
                        <img class="webappthumb" src="{$assetspath}{$allApps[$app].logo}" alt="{$allApps[$app].alt}"/>
                    </a>
                {/if}
            {/foreach}
            </div>
        {/if}
    {/if}
{/if}
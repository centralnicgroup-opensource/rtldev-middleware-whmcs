<h2>Web Apps</h2>
<h3>Connect To</h3>

{if !$conflictingApps.success}
    {include file="tpl_ca_webapps_error.tpl" error="$conflictingApps.error"}
{elseif !empty($conflictingApps.webapps)}
    <div class="alert alert-warning" role="alert"><b>CAUTION</b>: By connecting <b>{$allApps[$webapp].alt}</b> the following already connected Web Apps will be disconnected: <b>
        {foreach from=$conflictingApps.webapps item=app name=row}
            {$allApps[$app].alt}{if not $smarty.foreach.row.last}, {/if}
        {/foreach}
    </b>.</div>
{/if}

<form id="waform" action="" method="get">
    <input type="hidden" name="action" value="domaindetails"/>
    <input type="hidden" name="id" value="{$id}"/>
    <input type="hidden" name="modop" value="custom"/>
    <input type="hidden" name="a" value="webapps"/>
    <input type="hidden" name="webapp" value="{$webapp}"/>
    <input type="hidden" name="subaction" value="doconnect"/>
    {include file="$path$webapp.tpl"}
    <input class="btn btn-success" type="submit" value="Connect"/>
    <a href="?action=domaindetails&id={$id}&modop=custom&a=webapps" class="btn btn-default" role="button">Cancel</a>
</form>
<script type="text/javascript" src="{$WEB_ROOT}/modules/registrars/ispapi/lib/assets/js/webapps.js"></script>
<h2>Web Apps</h2>
<h3>Disconnect {$allApps[$webapp].alt}</h3>

<form id="waform" action="" method="get">
    <input type="hidden" name="action" value="domaindetails"/>
    <input type="hidden" name="id" value="{$id}"/>
    <input type="hidden" name="modop" value="custom"/>
    <input type="hidden" name="a" value="webapps"/>
    <input type="hidden" name="webapp" value="{$webapp}"/>
    <input type="hidden" name="subaction" value="dodisconnect"/>
    <div class="row form-group">
        <div class="col-sm-12">Do you really want to disconnect {$allApps[$webapp].alt} Web App? Find below the current configuration settings:</div>
    </div>
    <div class="row form-group">
        <div class="col-sm-12"><ul style="list-style-type:none;">
            {foreach key=k item=v from=$cfg}
            <li class="webapps-configuration-steps">
                <b>{$k}:</b> {$v|htmlentities}
            </li>
            {/foreach}
        </ol></div>
    </div>
    <input class="btn btn-danger" type="submit" value="Disconnect"/>
    <a href="?action=domaindetails&id={$id}&modop=custom&a=webapps" class="btn btn-default" role="button">Cancel</a>
</form>
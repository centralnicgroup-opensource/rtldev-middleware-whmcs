{literal}
<style>
	#ispapiwhoisprivacy a {
		text-decoration: underline;
	}
</style>
{/literal}

<div id="ispapiwhoisprivacy">
    <h3>{$LANG.hxwhoisprivacy} - {$domain}</h3>

	{if $successful}
		<div class="alert alert-success text-center">
			{if type == "trade"}
				<p>{$LANG.hxtraderequestedsuccessfully}</p>
			{else}
				<p>{$LANG.hxchangessavedsuccessfully}</p>
			{/if}
		</div><br/>
	{/if}

	{if $error}
		<div class="alert alert-danger text-center">
			<p>{$error}</p>
		</div><br/>
	{/if}

    <h4>{$LANG.hxwhoisprivacywhy}</h4>
    <p>{$LANG.hxwhoisprivacyreason}</p>
    <br>

    <div style="text-align:center;">
        <h4>{$LANG.hxwhoisprivacystatus}:</h4>

        {if $protected}
                <div class="alert alert-success">
                    <p>{$LANG.hxwhoisprivacystatus1}!</p>
                </div>
                <form method="post" action="">
                    <input type="hidden" name="action" value="domaindetails" />
                    <input type="hidden" name="modop" value="custom" />
                    <input type="hidden" name="a" value="{$smarty.request.a|htmlspecialchars}" />
                    <input type="hidden" name="id" value="{$domainid}" />
                    <input type='hidden' name="idprotection" value='disable' />
                    <p><input type="submit" class="btn btn-danger btn-large" value="{$LANG.hxwhoisprivacybttndisable}" /></p>
                </form>
        {else}
            {if $protectable}
                <div class="alert alert-danger">
                    <p>{$LANG.hxwhoisprivacystatus0}!</p>
                </div>
                <form method="post" action="">
                    <input type="hidden" name="action" value="domaindetails" />
                    <input type="hidden" name="modop" value="custom" />
                    <input type="hidden" name="a" value="{$smarty.request.a|htmlspecialchars}" />                    
                    <input type="hidden" name="id" value="{$domainid}" />
                    <input type='hidden' name="idprotection" value='enable' />
                    <p><input type="submit" class="btn btn-success btn-large" value="{$LANG.hxwhoisprivacybttnenable}" /></p>
                </form>
            {else}
                <div class="alert alert-info">
                    <p>{$LANG.hxwhoisprivacystatusnp}.</p>
                </div>
            {/if}
        {/if}
    </div>
</div>

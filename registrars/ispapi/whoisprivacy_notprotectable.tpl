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

        <div class="alert alert-info">
            <p>{$LANG.hxwhoisprivacystatusnp}.</p>
        </div>
    </div>
</div>
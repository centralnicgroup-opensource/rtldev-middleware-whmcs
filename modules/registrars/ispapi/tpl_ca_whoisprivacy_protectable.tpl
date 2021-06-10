{literal}
<style>
	#ispapiwhoisprivacy a {
		text-decoration: underline;
	}
</style>
{/literal}

<div id="ispapiwhoisprivacy">
    <h3>{$L::trans("hxwhoisprivacy")} - {$domain}</h3>

	{if $successful}
		<div class="alert alert-success text-center">
			{if type === "trade"}
				<p>{$L::trans("hxtraderequestedsuccessfully")}</p>
			{else}
				<p>{$L::trans("hxchangessavedsuccessfully")}</p>
			{/if}
		</div><br/>
	{/if}

	{if $error}
		<div class="alert alert-danger text-center">
			<p>{$error}</p>
		</div><br/>
	{/if}

    <h4>{$L::trans("hxwhoisprivacywhy")}</h4>
    <p>{$L::trans("hxwhoisprivacyreason")}</p>
    <br>

    <div style="text-align:center;">
        <h4>{$L::trans("hxwhoisprivacystatus")}:</h4>

        {if $protected}
            <div class="alert alert-success">
                <p>{$L::trans("hxwhoisprivacystatus1")}!</p>
            </div>
            <form method="post" action="">
                <input type="hidden" name="idprotection" value="0" />
                <p><input type="submit" class="btn btn-danger btn-large" value="{$L::trans('hxwhoisprivacybttndisable')}" /></p>
            </form>
        {else}
            <div class="alert alert-danger">
                <p>{$L::trans("hxwhoisprivacystatus0")}!</p>
            </div>
            <form method="post" action="">
                <input type="hidden" name="idprotection" value="1" />
                <p><input type="submit" class="btn btn-success btn-large" value="{$L::trans('hxwhoisprivacybttnenable')}" /></p>
            </form>
        {/if}
    </div>
</div>
{literal}
<style>
	#ispapiownerchange a {
		text-decoration: underline;
	}
</style>
{/literal}

<div id="ispapiownerchange">
	<h3>{$LANG.ownerchange} - {$domain}</h3>
	{if $type == "trade"}
		{if $needsAdminC}
			<p>{$LANG.ownerchangeproceduresimple}</p>
		{else}
			<p>{$LANG.ownerchangeprocedureextended}</p>
		{/if}
		<br/>
	{/if}

	{if $successful}
		<div class="alert alert-success text-center">
			{if type == "trade"}
				<p>{$LANG.traderequestedsuccessfully}</p>
			{else}
				<p>{$LANG.changessavedsuccessfully}</p>
			{/if}
		</div><br/>
	{/if}

	{if $error}
		<div class="alert alert-danger text-center">
			<p>{$error}</p>
			{if $missingfields}
				<p>{", "|implode:$missingfields}</p>
			{/if}
		</div><br/>
	{/if}

	<form method="POST" action="">
		<input type="hidden" name="action" value="domaindetails">
		<input type="hidden" name="id" value="{$domainid}">
		<input type="hidden" name="modop" value="custom">
		<input type="hidden" name="a" value="registrantmodification{$type}">
		<input type="hidden" name="submit" value="1">

		{foreach key=name item=value from=$values.Registrant}
			<div class="form-group">
				<label for="contactdetails[Registrant][{$name}]">{$name}</label>
				<input class="form-control Technicalcustomwhois" type="text" name="contactdetails[Registrant][{$name}]" id="contactdetails[Registrant][{$name}]" value="{$value}" style="width:400px"  />
			</div>
		{/foreach}

		{foreach key=fieldLabel item=inputHTML from=$additionalfields->getFieldsForOutput()}
			<div class="form-group">
				<label>{$fieldLabel}</label><br/> {$inputHTML}
			</div>
		{/foreach}

		<p class="text-center">
			<input class="btn btn-large btn-primary" type="submit" value="{if $type == 'trade'}{$LANG.bttnsendtrade}{else}{$LANG.clientareasavechanges}{/if}"/>
		</p>
	</form>
</div>
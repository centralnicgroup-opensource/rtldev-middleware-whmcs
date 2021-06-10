{literal}
<style>
	#ispapiownerchange a {
		text-decoration: underline;
	}
</style>
{/literal}

<div id="ispapiownerchange">
	<h3>{$L::trans("hxownerchange")} - {$domain}</h3>
	{if $type === "trade" && $subtype !== "ICANN-TRADE"}
		{if $needsAdminC}
			<p>{$L::trans("hxownerchangeproceduresimple")}</p>
		{else}
			<p>{$L::trans("hxownerchangeprocedureextended")}</p>
		{/if}
		<br/>
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

		<h4>Registrant Contact</h4>
		{foreach key=name item=value from=$values.Registrant}
			<div class="form-group">
				<label for="contactdetails[Registrant][{$name}]">{$name}</label>
				<input class="form-control Technicalcustomwhois" type="text" name="contactdetails[Registrant][{$name}]" id="contactdetails[Registrant][{$name}]" value="{$value}" style="width:400px"  />
			</div>
		{/foreach}

		{if $needsAdminC}
			<h4>Admin Contact</h4>
			{foreach key=name item=value from=$values.Admin}
				<div class="form-group">
					<label for="contactdetails[Admin][{$name}]">{$name}</label>
					<input class="form-control Technicalcustomwhois" type="text" name="contactdetails[Admin][{$name}]" id="contactdetails[Admin][{$name}]" value="{$value}" style="width:400px"  />
				</div>
			{/foreach}
		{/if}

		{if $needsTechC}
			<h4>Tech Contact</h4>
			{foreach key=name item=value from=$values.Tech}
				<div class="form-group">
					<label for="contactdetails[Tech][{$name}]">{$name}</label>
					<input class="form-control Technicalcustomwhois" type="text" name="contactdetails[Tech][{$name}]" id="contactdetails[Tech][{$name}]" value="{$value}" style="width:400px"  />
				</div>
			{/foreach}
		{/if}

		{if $needsBillingC}
			<h4>Billing Contact</h4>
			{foreach key=name item=value from=$values.Billing}
				<div class="form-group">
					<label for="contactdetails[Billing][{$name}]">{$name}</label>
					<input class="form-control Technicalcustomwhois" type="text" name="contactdetails[Billing][{$name}]" id="contactdetails[Billing][{$name}]" value="{$value}" style="width:400px"  />
				</div>
			{/foreach}
		{/if}

		{foreach key=fieldLabel item=inputHTML from=$additionalfields->getFieldsForOutput()}
			<div class="form-group">
				<label>{$fieldLabel}</label><br/> {$inputHTML}
			</div>
		{/foreach}

		<p class="text-center">
			<input class="btn btn-large btn-primary" type="submit" value="{if $type === 'trade' && $subtype !== 'ICANN-TRADE'}{$L::trans('hxbttnsendtrade')}{else}{$L::trans('clientareasavechanges')}{/if}"/>
		</p>
	</form>
</div>
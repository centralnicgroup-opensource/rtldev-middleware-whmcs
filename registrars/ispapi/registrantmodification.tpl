{literal}
<style>
	.controls blockquote {
		margin-left:20px;
		margin-top:10px;
	}
</style>
{/literal}

<h3>Change of Registrant - {$domain}</h3>
<br/>
{if $type == "trade"}
.{$tld|strtoupper} Change of Registrant requires a special procedure called TRADE. Registrant{if $needsAdminC} and Admin{/if} contact will be overwritten.
<br/><br/>
{/if}

{if $successful}
	<div class="alert alert-success text-center">
		{if type == "trade"}
			<p>The TRADE has been sended successfully.</p>
		{else}
        	<p>{$LANG.changessavedsuccessfully}</p>
    	{/if}
	</div>
{/if}

{if $error}
	<div class="alert alert-danger text-center">
		<p>{$error}</p>
		{if $missingfields}
			<p>{", "|implode:$missingfields}</p>
		{/if}
	</div>
{/if}

<br/>
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

    {if type=="trade" && $furtherDocsURL}
	<div class="alert alert-info">
  		<strong>NOTE!</strong> After submitting, you'll need to send the following form back to complete the process: <a target="_blank" href="{$furtherDocsURL}">Ownerchange Form</a>.
	</div>
    {/if}

	<p class="text-center">
		<input class="btn btn-large btn-primary" type="submit" value="{if $type == 'trade'}Send Trade{else}{$LANG.clientareasavechanges}{/if}"/>
	</p>
</form>
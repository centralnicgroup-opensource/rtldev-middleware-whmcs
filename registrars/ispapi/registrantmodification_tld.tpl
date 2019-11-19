
<h3>Change of Registrant - {$domain}</h3>

{if $successful}
	<div class="alert alert-success text-center">
    	<p>The TRADE has been sended successfully.</p>
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

{literal}
<style>
	.controls blockquote {
		margin-left:20px;
		margin-top:10px;
	}
</style>
{/literal}
<BR>
<form method="POST" action="">
<input type="hidden" name="action" value="domaindetails">
<input type="hidden" name="id" value="{$domainid}">
<input type="hidden" name="modop" value="custom">
<input type="hidden" name="a" value="registrantmodification_tld">
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

  {if preg_match('/\.se$/i', $domain)}
  <input type="checkbox" name="se-checkbox"/>After the Trade request has been submitted, I confirm I will send the following form back to complete the process: <a target="_blank" href='http://www.domainform.net/form/se/search?view=ownerchange'>http://www.domainform.net/form/se/search?view=ownerchange</a>
  {/if}

	<p class="text-center" style="margin-top:15px;">
		<input class="btn btn-large btn-primary" type="submit" value="Send TRADE">
	</p>

</form>

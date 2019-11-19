{assign var=legaltyp value="Legal Type"}

{literal}
<script>
	$( document ).ready(function() {
		$(".LegalType").val({/literal}"{$values[$legaltyp]}"{literal});
	});
</script>
{/literal}

<h3>Change of Registrant - {$domain}</h3>

<br>
{if $successful}
	<div class="alert alert-success text-center">
    	<p>{$LANG.changessavedsuccessfully}</p>
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

<form method="POST" action="">
<input type="hidden" name="action" value="domaindetails">
<input type="hidden" name="id" value="{$domainid}">
<input type="hidden" name="modop" value="custom">
<input type="hidden" name="a" value="registrantmodification_ca">
<input type="hidden" name="submit" value="1">

	{foreach key=name item=value from=$values.Registrant}
        <div class="form-group">
	          <label for="contactdetails[Registrant][{$name}]">{$name}</label>
              <input class="form-control Technicalcustomwhois" type="text" name="contactdetails[Registrant][{$name}]" id="contactdetails[Registrant][{$name}]" value="{$value}" style="width:400px" />
        </div>
	{/foreach}

	{foreach key=fieldLabel item=inputHTML from=$additionalfields->getFieldsForOutput()}
		<div class="form-group">
			<label>{$fieldLabel}</label><br/> {$inputHTML}
		</div>
	{/foreach}


    <p class="text-center">
        <input class="btn btn-large btn-primary" type="submit" value="{$LANG.clientareasavechanges}">
    </p>

</form>

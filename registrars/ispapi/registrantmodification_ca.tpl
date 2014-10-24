{assign var=legaltyp value="Legal Type"} 

{literal}
<script>
	$( document ).ready(function() {
		$(".LegalType").val({/literal}"{$values[$legaltyp]}"{literal});
	});
</script>
{/literal}

{include file="$template/pageheader.tpl" title="Change of Registrant - $domain"}
<br>
{if $successful}
	<div class="alert alert-success textcenter">
    	<p>{$LANG.changessavedsuccessfully}</p>
	</div>
{/if}

{if $error}
	<div class="alert alert-error textcenter">
    	<p>{$error}</p>
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
<form method="POST" action="{$smarty.server.PHP_SELF}">
<input type="hidden" name="action" value="domaindetails">
<input type="hidden" name="id" value="{$domainid}">
<input type="hidden" name="modop" value="custom">
<input type="hidden" name="a" value="registrantmodification_ca">
<input type="hidden" name="submit" value="1">
<fieldset id="Registrantmodification" class="onecol">
	{foreach key=name item=value from=$values.Registrant}
	    <div class="control-group">
		    <label class="control-label" for="contactdetails[Registrant][{$name}]">{$name}</label>
			<div class="controls">
			    <input type="text" name="contactdetails[Registrant][{$name}]" id="contactdetails[Registrant][{$name}]" value="{$value}" size="30" />
			</div>
		</div>
	{/foreach}

	{foreach item=field from=$additionalfields}
		{if $field.Type == "dropdown"}
			{assign var="options" value=","|explode:$field.Options}
			<div class="control-group">
	 			<label class="control-label" for="additionalfields[{$field.Name}]">{$field.Name}</label>
	 			<div class="controls">
					<select name="additionalfields[{$field.Name}]" id="additionalfields[{$field.Name}]" class="{$field.Name|replace:' ':''}">
						{foreach item=option from=$options}
			        		<option value="{$option}">{$option}</option>
			        	{/foreach}
			    	</select>
			    	{$field.Description}
		    	</div>
		    </div>
	    {/if}
		{if $field.Type == "tickbox"}
			<div class="control-group">
				<label class="control-label" for="additionalfields[{$field.Name}]">{$field.Name}</label>
				
				<div class="controls">
					<input style="float:left;margin-top:2px;margin-right:10px;" name="additionalfields[{$field.Name}]" id="additionalfields[{$field.Name}]" type="checkbox" class="{$field.Name|replace:' ':''}">
					{$field.Description}
				</div>
			</div>
		{/if}
	{/foreach}

	<div class="control-group">
		<label class="control-label" for=""></label>
		
		<div class="controls">
			<input class="btn btn-large btn-primary" type="submit" value="{$LANG.clientareasavechanges}">
		</div>
	</div>
</fieldset>
</form>

<form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails">
	<input type="hidden" name="id" value="{$domainid}" />
	<p><input type="submit" value="{$LANG.clientareabacklink}" class="btn" /></p>
</form>
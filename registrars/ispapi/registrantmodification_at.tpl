{include file="$template/pageheader.tpl" title="Change of Registrant - $domain"}
<br>
.AT Change of Registrant requires a special procedure called TRADE. A fax form is also required by the registry to process the TRADE. <br>The fax form can be generated with our formgenerator <b>AFTER the TRADE</b> at: <a href="http://www.domainform.net/form/at/search?view=ownerchange">http://www.domainform.net/form/at/search?view=ownerchange</a>.
<br><br>

{if $successful}
	<div class="alert alert-success textcenter">
    	<p><b>The TRADE has been sended successfully.</b><br>The fax form is still required to complete the process.<br>Generate it now with our formgenerator at: <a style="color:green;" href="http://www.domainform.net/form/at/search?view=ownerchange">http://www.domainform.net/form/at/search?view=ownerchange</a>.</p>
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
<BR>
<form method="POST" action="{$smarty.server.PHP_SELF}">
<input type="hidden" name="action" value="domaindetails">
<input type="hidden" name="id" value="{$domainid}">
<input type="hidden" name="modop" value="custom">
<input type="hidden" name="a" value="registrantmodification_at">
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

	<div class="control-group">
		<label class="control-label" for=""></label>
		
		<div class="controls">
			<input class="btn btn-large btn-primary" type="submit" value="Send TRADE">
		</div>
	</div>
</fieldset>
</form>

<form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails">
	<input type="hidden" name="id" value="{$domainid}" />
	<p><input type="submit" value="{$LANG.clientareabacklink}" class="btn" /></p>
</form>
{assign var=ispapinamelabel value="Ispapi-Name"}

{assign var=localpresence value="Local Presence"}
{assign var=sec3agreement value="Section 3 Agreement"}
{assign var=sec5agreement value="Section 5 Agreement"}
{assign var=sec6agreement value="Section 6 Agreement"}
{assign var=sec7agreement value="Section 7 Agreement"}

{literal}
<script>
	$( document ).ready(function() {
		$(".X-IT-ACCEPT-TRUSTEE-TAC").val({/literal}{$smarty.post.additionalfields.$localpresence}{literal});
		$(".X-IT-PIN").val({/literal}{$smarty.post.additionalfields.PIN}{literal});
		$(".X-IT-ACCEPT-LIABILITY-TAC").val({/literal}{$smarty.post.additionalfields.$sec3agreement}{literal});
		$(".X-IT-ACCEPT-REGISTRATION-TAC").val({/literal}{$smarty.post.additionalfields.$sec5agreement}{literal});
		$(".X-IT-ACCEPT-DIFFUSION-AND-ACCESSIBILITY-TAC").val({/literal}{$smarty.post.additionalfields.$sec6agreement}{literal});
		$(".X-IT-ACCEPT-EXPLICIT-TAC").val({/literal}{$smarty.post.additionalfields.$sec7agreement}{literal});
	});
</script>
{/literal}

<h3>Change of Registrant - {$domain}</h3>

<br>
.IT Change of Registrant requires a special procedure called TRADE. Registrant and Admin contact will be overwritten.
<br><br>

{if $successful}
	<div class="alert alert-success text-center">
    	<p>The TRADE has been sended successfully.</p>
		<pre style="text-align:left">{$successful}</pre>
		<pre style="text-align:left">{$smarty.request|print_r:true}</pre>
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
<br/>
<form method="POST" action="">
<input type="hidden" name="action" value="domaindetails">
<input type="hidden" name="id" value="{$domainid}">
<input type="hidden" name="modop" value="custom">
<input type="hidden" name="a" value="registrantmodification_it">
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
		<input class="btn btn-large btn-primary" type="submit" value="Send TRADE">
	</p>

</form>

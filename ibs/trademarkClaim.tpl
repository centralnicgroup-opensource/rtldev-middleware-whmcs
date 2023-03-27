<div id="tmch">
{if $error}
	<h2>{$error}</h2>
{else}
	<form class="form-horizontal" role="form" method="post" action="{$smarty.server.PHP_SELF}?action=acceptTM">
		<h2>{$domain} - Trademark Claims Notice</h2> 
	<div class="ib-box" style="border:1px solid #dfdfdf;margin:20px;border-radius:10px;">
		<h4 style="padding:10px 10px 0px 10px;">{$domain} - Trademark Claims Notice</h3> 
		<hr style="margin:10px 0px;">
		<div style="padding:10px;">
			<b>You have received this Trademark Notice because you have applied for a domain name which match at least one trademark record submitted to the Trademark Clearinghouse.</b><br/><br/>
<b>You may or may not be entitled to register the domain name depending on your intended use and whether it is the same or significantly overlaps with the trademark listed below. Your rights to register this domain name may or may not be protected as noncommercial use or "fair use" by the laws of your country.</b>
<br/><br/>

			<p>Please read the trademark information below carefully, including the trademarks, jurisdictions, and goods and service for which the trademarks are registered. Please be aware that not all jurisdictions review trademark applications closely, so some of the trademark information below may exist in a national or regional registry which does not conduct a thorough or subtantive review of trademark rights prior to registration.</p><br/>

			<p>If you have questions, you may want to consult and attorney or legal expert on trademarks and intellectual property or guidance.</p><br/>

			<p>If you continue with this registration, you represent that, you have received and you understand this notice and to the best of your knowledge, your registration and use of the requested domain name will not infringe on the trademark right listed below.</p><br/><br/>

			<h3>The following Trademark is listed in the Trademark Clearinghouse</h3><br/>
		{section name=marks loop=$markDetails}

			<h3><b>Trade Mark - {$markDetails[marks].markName}</b></h3>
			<hr>
			<div> Jurisdiction: {$markDetails[marks].markJurisdiction}</div>
			<div> Goods: {$markDetails[marks].goodsAndService}</div><br/>
			
			<div><b>Holder Information:</b><br/>
				<div style="margin-left:50px;">{$markDetails[marks].markHolder}</div>
				<div style="margin-left:50px;">{$markDetails[marks].holderStreet}</div>
				<div style="margin-left:50px;">{$markDetails[marks].holderPc} {$markDetails[marks].holderCity}, {$markDetails[marks].holderState}</div>
				<div style="margin-left:50px;">{$markDetails[marks].holderCountry}</div>
			</div>
	
			{if $markDetails[marks].contactOrg}
			<br/><div><b>Contact Information:</b><br/>
				<div style="margin-left:50px;">{$markDetails[marks].contactOrg}</div>
				<div style="margin-left:50px;">{$markDetails[marks].contactName}</div>
				<div style="margin-left:50px;">{$markDetails[marks].contactStreet}</div>
				<div style="margin-left:50px;">{$markDetails[marks].contactPc} {$markDetails[marks].contactCity}, {$markDetails[marks].contactState}</div>
				<div style="margin-left:50px;">{$markDetails[marks].contactCountry}</div>
				<div style="margin-left:50px;">{$markDetails[marks].contactInfo}</div>
				<div style="margin-left:50px;">{$markDetails[marks].contactEmail}</div>
			</div><br/>
			{/if}
			<br/>
		{/section}
		<div class="text-center" style="text-align:center">
				<p>Please accept or decline the trademark claim notice for <b>{$domain}</b></p>
				<br/>
	       			<input type="submit" name="accepttm" value="Accept" class="btn btn-primary" />
				<div class="btn btn-default" style="margin-left:50px;" onclick="consentClaim({$domainKey}, 0)">Decline</div>
			</div>
			<br/>
		</div>
		</div>
	</form>
	{/if}
</div>

<script type="application/javascript">
	function consentClaim(domainKey, accpetance){
		if(accpetance == 0){
			window.location = "cart.php?a=remove&r=d&i="+domainKey;
		}
	}
</script>

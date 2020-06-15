<h1>Premium domain</h1>
<br>
<b style="color:#46A546;">Your domain is a PREMIUM domain and cannot be renewed like a normal domain.<br>
The renewal will take place automatically with the product renew.</b>
<br><br>
If you don't want to renew this domain, you have to cancel the respective product in the product area.<br><br>
{if $statusdomain}
<h4><strong>Expiration Date: </strong></h4> {$statusdomain.EXPIRATIONDATE.0}
{/if}
{literal}
<script>
	$(document).ready(function() {
		$(".btn-mini").remove();
		$("#tab2nav").remove();
	});
</script>
{/literal}
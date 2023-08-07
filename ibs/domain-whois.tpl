<div id="domain-whois">
	{if $error}
		<div class="alert alert-error alert-danger" style="display:block;">{$error}</div>
	{/if}
	
	{if $domain}
		<h1><small>WHOIS: {$domain}</small></h1>
	{/if}
	{if !$domain || $error}
		<form class="form-horizontal" role="form" method="post" action="{$smarty.server.PHP_SELF}?action=domain-whois">
			<div class="form-group">
				<label class="col-sm-3 control-label">Domain Name</label>
				<div class="col-sm-7">
					<input type="text" name="domainname" value="{$domain}" class="form-control" />
				</div>
			</div>
		
			<div class="form-group">
				<div class="text-center">
				   	<input type="submit" name="domain-whois" value="Search" class="btn btn-primary" />
				</div>
		</form>
	{/if}

	{if $whois}
		<div class="whois-results well well-lg">
			<pre>{$whois}</pre>
		</div>
	{/if}

	{if $status}
		<div class="whois-results well well-lg">
			<pre>{$status}</pre>
		</div>
	{/if}

</div>

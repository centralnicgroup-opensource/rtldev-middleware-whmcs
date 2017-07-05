<h3>DNSSec Management - {$domain}</h3>

<br>
{if $successful}
	<div class="alert alert-success text-center">
    	<p>{$LANG.changessavedsuccessfully}</p>
	</div>
{/if}

{if $error}
	<div class="alert alert-danger text-center">
    	<p>{$error}</p>
	</div>
{/if}

<form method="POST" action="{$smarty.server.PHP_SELF}">
<input type="hidden" name="action" value="domaindetails">
<input type="hidden" name="id" value="{$domainid}">
<input type="hidden" name="modop" value="custom">
<input type="hidden" name="a" value="dnssec">
<input type="hidden" name="submit" value="1">

<table class="table table-striped">
	<thead>
	    <tr>
	        <th style="width:30px;">#</th>
	        <th>DS Records <span style="font-weight:normal;">(&lt;keyTag&gt &lt;alg&gt &lt;digestType&gt &lt;digest&gt)</span></th>
		</tr>
	</thead>
	<tbody>
		{foreach item=ds from=$secdnsds name=secdnsds}
		<tr>
			<td>{$smarty.foreach.secdnsds.index}</td>
			<td><input class="form-control" style="width:100%" type="text" name="SECDNS-DS[]" value="{$ds}"></td>
		</tr>
		{/foreach}
		<tr>
			<td>{$smarty.foreach.secdnsds.index + 1}</td>
			<td><input class="form-control" style="width:100%" type="text" name="SECDNS-DS[]" value=""></td>
		</tr>
	</tbody>
</table>

<table class="table table-striped">
	<thead>
	    <tr>
	        <th style="width:30px;">#</th>
	        <th>KEY Records <span style="font-weight:normal;">(&lt;flags&gt &lt;protocol&gt &lt;alg&gt &lt;pubKey&gt)</span</th>
		</tr>
	</thead>
	<tbody>
		{foreach item=key from=$secdnskey name=secdnskey}
		<tr>
			<td>{$smarty.foreach.secdnskey.index}</td>
			<td><input class="form-control" style="width:100%" type="text" name="SECDNS-KEY[]" value="{$key}"></td>
		</tr>
		{/foreach}
		<tr>
			<td>{$smarty.foreach.secdnskey.index + 1}</td>
			<td><input class="form-control" style="width:100%" type="text" name="SECDNS-KEY[]" value=""></td>
		</tr>
	</tbody>
</table>

<p class="text-center">
    <input class="btn btn-large btn-primary" type="submit" value="{$LANG.clientareasavechanges}">
</p>

</form>

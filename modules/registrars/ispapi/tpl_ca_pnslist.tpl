<h2>List of Private Nameservers</h2>
{if $error}
    <div class="alert alert-danger"><i class="fas fa-times fa-fw"></i> {$error}</div>
{else}
    <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Private Nameserver</th>
            <th>IP Address</th>
        </tr>
    </thead>
    <tbody>
        {foreach $data.HOST as $host}
        <tr>
            <td>{preg_replace("/ .+$/", "", $host)}</li></td>
            <td>{preg_replace("/^[^ ]+ /", "", $host)}</td>
        </tr> 
        {/foreach}
    </tbody>
    </table>
{/if}
<h2>{$L::trans("hxpnslist")}</h2>
{if $error}
    <div class="alert alert-danger"><i class="fas fa-times fa-fw"></i> {$error}</div>
{else}
    {if empty($data.HOST)}
        <p>{$L::trans("hxpnsempty")}</p>
    {else}
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{$L::trans("hxpnscolpns")}</th>
                <th>{$L::trans("hxpnscolip")}</th>
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
{/if}
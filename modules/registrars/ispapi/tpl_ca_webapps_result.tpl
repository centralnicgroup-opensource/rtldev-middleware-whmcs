<h2>Web Apps</h2>
{if $success}
<div class="alert alert-success" role="alert">Thanks, operation succeeded!</div>
{else}
<div class="alert alert-danger" role="alert">{$error}</div>
{/if}
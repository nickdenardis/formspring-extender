{include file="_header.tpl"}
<div class="box">
	<header>
		<h1>Manage Multiple Formspring Accounts!</h1>
	</header>
	<div class="box-content">
			<p>Use this to connect multiple people to one formspring account.</p>
			
			{*}
			<h2>Search Profiles</h2>
			<form action="/" method="get">
			<fieldset>
				<label for="query">Search: </label>
				<input name="query" id="query" type="text" value="<?php echo trim($_GET['query']); ?>" />
			</fieldset>
			<input type="submit" value="Search" />
			</form>
			
			<?php
				if ($list->status == 'ok'){
					echo '<h3>Results</h3><pre>';
					foreach ($list->response->profiles as $profile){
						print_r($profile);
					}
					echo '</pre>';
				}
			?>
			{*}
		</div>
</div>
{include file="_footer.tpl"}
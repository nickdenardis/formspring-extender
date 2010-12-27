{include file="_header.tpl"}
<div class="box">
	<header>
		<h1>Your Accounts</h1>
	</header>
	<div class="box-content">
		<div class="account">
			<p class="image"><a href="http://www.formspring.me/{$myUser->GetValue('username')}">
				<img src="{$myAccountInfo->GetValue('photo_url')}" width="75" height="75" alt="Profile Image"></a>
			</p>
			<h2>{$myAccountInfo->GetValue('name')}</h2>
			<p>
				{$myUser->GetValue('username')}<br />
				{$myAccountInfo->GetValue('location')}<br />
				<a href="{$myAccountInfo->GetValue('website')}">{$myAccountInfo->GetValue('website')}</a>
			</p>
			<p><a href="/redirect?delegate={$myUser->GetPrimary()}">Add Delegate</a></p>
		</div>
	</div>
</div>
{include file="_footer.tpl"}
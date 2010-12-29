{config_load file='main.conf' section='edit'}
{include file="_header.tpl"}

<form action="{$smarty.server.REQUEST_URI}" method="post" name="edit" enctype="multipart/form-data">
	{$myObject->Form($display, $hidden, $options)}
	
	<fieldset class="submit_button">
		<label for="submit_button">&nbsp;</label>
		<div class="buttons">
    		<button type="submit" name="submit" class="positive" value="save"><img src="/{$smarty.const.DIR_ROOT}images/icons/tick.gif" alt=""/>Save</button>
			<a href="{if $smarty.server.HTTP_REFERER != ''}{$smarty.server.HTTP_REFERER}{else}{#path#}{/if}"><img src="/{$smarty.const.DIR_ROOT}images/icons/stop.gif" alt=""/>Cancel</a>
			{if $myObject->GetPrimary() != ''}
				<button type="submit" name="submit" class="negative" value="delete" onclick="return confirm('This will Totally Delete any existance of this Item.  Continue?')"><img src="/{$smarty.const.DIR_ROOT}images/icons/delete.gif" alt=""/>Delete</button>
			{/if}
			{if is_array($buttons)}
				{foreach from=$buttons key=button_id item=button name=buttons}
					 <button name="submit" type="submit" value="{$button.name}"{if $button.onclick != ''} onclick="{$button.onclick}"{/if}>{$button.label|sslash}</button>
				{/foreach}
			{/if}
		</div>
	</fieldset>
</form>

{include file="_footer.tpl"}
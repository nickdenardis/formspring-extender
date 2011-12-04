{config_load file='main.conf'}
{include file="_header.tpl"}

<form action="{$smarty.server.REQUEST_URI}" method="post" name="edit" enctype="multipart/form-data">
	{$myObject->Form($display, $hidden, $options)}
	
	<fieldset class="submit_button">
		<label for="submit_button">&nbsp;</label>
		<div class="buttons">
    		<input type="submit" name="submit" class="positive" value="Save" />
			<a href="{if $smarty.server.HTTP_REFERER != ''}{$smarty.server.HTTP_REFERER}{else}{#path#}{/if}">Cancel</a>
			{if $myObject->GetPrimary() != ''}
				<input type="submit" name="submit" class="negative" value="Delete" onclick="return confirm('This will Totally Delete any existance of this Item.  Continue?')" />
			{/if}
			{if is_array($buttons)}
				{foreach from=$buttons key=button_id item=button name=buttons}
					 <input name="submit" type="submit" name="{$button.name}" value="{$button.label|stripslashes}"{if $button.onclick != ''} onclick="{$button.onclick}"{/if}>
				{/foreach}
			{/if}
		</div>
	</fieldset>
</form>

{include file="_footer.tpl"}
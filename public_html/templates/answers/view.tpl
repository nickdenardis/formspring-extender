{config_load file='main.conf' section='view'}
{include file="_header.tpl"}

<div class="box">
	<header>
		<h1>{$myObject->GetValue('question')|stripslashes}</h1>
	</header>
	<div class="box-content">
		<p>{$myObject->GetValue('answer')|stripslashes}</p>
		<p>Asked by: {if $myObject->GetValue('asked_by') != ''}{$myObject->GetValue('asked_by')}{else}Anonymous{/if} on {$myObject->GetValue('date_asked')}</p>
	
		<h2>Categories</h2>
		{if is_array($all_categories)}
		<form action="/answer/edit/{$myObject->GetValue('answer_id')}" method="post" name="categories">
		<ul>
		{foreach from=$all_categories item="category"}
			<li><input type="checkbox"  name="category[]" value="{$category.category_id}"{if in_array($category.category_id, $in_categories)} checked="checked"{/if} /> {$category.category|stripslashes}</li>
		{/foreach}
		</ul>
		<input type="submit" name="submit" value="Save Categories" />
		</form>
		{/if}
	</div>
</div>

{include file="_footer.tpl"}
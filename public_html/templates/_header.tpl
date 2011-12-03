<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Formspring Extender</title>
	<link href="/assets/main.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
	<header id="top">
		<div class="wrap"><div class="wrap-inner">
			<h1><a href="/">Formspring Extender</a></h1>
		
		<div id="subbar">
          <nav id="primary">
            <ul>
              <li class="home selected"><a href="/">Home</a></li>
              {if $myUser->GetPrimary() != ''}
	              <li class="inbox"><a href="/inbox">Inbox</a></li>
	              <li class="answers"><a href="/answers">Answers</a></li>
	              <li class="categories"><a href="/categories">Categories</a></li>
	              <li class="accounts"><a href="/accounts">Accounts</a></li>
	              <li class="logout"><a href="/logout">Logout</a></li>
              {else}
	              <li class="signin"><a href="/redirect">Signin</a></li>
              {/if}
            </ul>
          </nav>
        </div>
        
        </div></div>
   	</header>
	<section id="content">
		<div class="wrap"><div class="wrap-inner">
		
		<div id="notifications">
			{*}{alert info=$error}
			{alert info=$success type='success'}{/*}
		</div>
		
		{if isset($actions) && is_array($actions)}
			<div id="options">
				<ul>
					{foreach from=$actions key=action_id item=action name=actions}
						<li class="{$action.class}"><a href="{$action.link}">{$action.title|stripslashes}</a></li>
					{/foreach}
				</ul>
			</div>
		{/if}
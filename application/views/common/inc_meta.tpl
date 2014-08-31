<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="Shortcut Icon" href="{$base_url}images/favicon.ico" type="image/x-icon"/>
<meta name="keywords" content="{$page->key}" />
<meta name="description" content="{$page->desc}" />
{if $page->noindex || $smarty.const.ENVIRONMENT == "development"}
    <meta name="robots" content="noindex, nofollow" />
{/if}
{if $pagination_helper AND isset($page_no)}
    {if $page_no==1 && $page_no!=$last_page}
        <link rel="next" href="{$page_url}/2" />
    {elseif $page_no==$last_page && $page_no!=1}
        <link rel="prev" href="{$page_url}/{$last_page-1}" />
    {else}
        <link rel="next" href="{$page_url}/{$page_no+1}" />
        <link rel="prev" href="{$page_url}/{$page_no-1}" />
    {/if}
{/if}
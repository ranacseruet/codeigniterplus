<!-- Blueprint Framework CSS Files Starts -->
<link type="text/css" rel="stylesheet" href="{$base_url}styles/blueprint/screen.css" media="screen, projection" />
<link type="text/css" rel="stylesheet" href="{$base_url}styles/blueprint/print.css" media="print" />
<!--[if lt IE 8]><link rel="stylesheet" href="{$base_url}styles/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
<!-- Blueprint Framework CSS Files Ends -->

<!-- Jquery UI CSS Files Starts -->
<link type="text/css" rel="stylesheet" href="{$base_url}styles/jquery-ui/ui-lightness/jquery-ui-1.8.11.custom.css" />
<!-- Jquery UI CSS Files Ends -->

<!-- Main site layout and styles Starts -->
<link type="text/css" rel="stylesheet" href="{$base_url}styles/main/layout.css" />
<link type="text/css" rel="stylesheet" href="{$base_url}styles/main/styles.css" />
<!-- Main site layout and styles Ends -->

{assign var="style_file" value="styles/"|cat:$content|cat:".css"}

{if file_exists($style_file)}
    
    <link type="text/css" rel="stylesheet" href="{$base_url}{$style_file}" />
{/if}
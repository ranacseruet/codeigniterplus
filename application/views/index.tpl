<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>{$page->title}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />   
    <meta name="keywords" content="{$page->key}" />
    <meta name="description" content="{$page->desc}" />
    {include $common_dir|cat:"inc_styles.tpl"}
  </head>
  <body>
      <div class="container" id="container">
      	<div class="span-24 last header">          
          {include $common_dir|cat:"header.tpl"}
        </div> 
        <div class="span-24 last content clear">
            <div class="span-24 last status">
                {include $common_dir|cat:"status.tpl"}
            </div>
            <div class="span-24 last">
                {include $content|cat:".tpl"}
            </div>
        </div>
        <div class="span-24 last footer clear">   
          {include $common_dir|cat:"footer.tpl"}
        </div>  
      </div>
      {include $common_dir|cat:"inc_scripts.tpl"}  
  </body>
</html>

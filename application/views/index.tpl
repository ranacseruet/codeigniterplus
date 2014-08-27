<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>{$page->title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />  
    {include $common_dir|cat:"inc_meta.tpl"}
    {include $common_dir|cat:"inc_styles.tpl"}
  </head>
  <body>  
      
    <div class="navbar navbar-default  navbar-fixed-top">          
      {include $common_dir|cat:"header.tpl"}
      <a href="https://github.com/ranacseruet/codeigniterplus"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/e7bbb0521b397edbd5fe43e7f760759336b5e05f/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677265656e5f3030373230302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_green_007200.png"></a>
    </div> 
    <div class="container content">
        <div class="row status">
            {include $common_dir|cat:"status.tpl"}
        </div>
        <div class="row">
            {include $content|cat:".tpl"}
        </div>
        <div class="row">
            <hr>
            <footer>   
              {include $common_dir|cat:"footer.tpl"}
            </footer>   
        </div>
    </div>    
            
    {include $common_dir|cat:"inc_scripts.tpl"}  
  </body>
</html>

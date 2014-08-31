<!-- Javascript libraries Starts -->
<script type="text/javascript" language="javascript">
    var base_url = "{$cdn_url}";
    var script_base_url = "{$cdn_url}scripts/";
</script>
<script async type="text/javascript" language="javascript" src="{$cdn_url}scripts/libraries/javascriptmvc/steal.production.js"></script>
<script async type="text/javascript" src="https://www.google.com/jsapi"></script>
<!-- Javascript libraries Ends -->

<!-- Main script -->
<script  async type="text/javascript" language="javascript" src="{$cdn_url}scripts/index.js"></script>

{assign var="script_file" value="scripts/"|cat:$content|cat:".js"}

{if file_exists($script_file)}
    <script async type="text/javascript" language="javascript" src="{$cdn_url}{$script_file}" ></script>
{/if}
<!-- Javascript libraries Starts -->
<script type="text/javascript" language="javascript">
    var base_url = "{$base_url}";
    var script_base_url = "{$base_url}scripts/";
</script>
<script type="text/javascript" language="javascript" src="{$base_url}scripts/libraries/javascriptmvc/steal.production.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!-- Javascript libraries Ends -->

<!-- Main script -->
<script type="text/javascript" language="javascript" src="{$base_url}scripts/index.js"></script>

{assign var="script_file" value="scripts/"|cat:$content|cat:".js"}

{if file_exists($script_file)}
    <script type="text/javascript" language="javascript" src="{$base_url}{$script_file}" ></script>
{/if}
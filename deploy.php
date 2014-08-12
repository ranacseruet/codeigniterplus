<?php
echo shell_exec("make >application/logs/deploy.log 2>&1 </dev/null &");


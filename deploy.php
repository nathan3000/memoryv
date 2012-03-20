<?php
    /**
     *      * GitHub.php
     *           *
     *                * Used for automatically deploying websites via github, more deets here:
     *                     *
     *                          *      https://gist.github.com/1809044
     *                               */

    echo shell_exec('echo $PWD');
    echo '<br />';
    echo shell_exec('whoami');
    echo '<br />';
    echo shell_exec('git pull');
    echo '<br />';
    echo shell_exec('git status');
?>

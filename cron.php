<?php
require('alice.php');
foreach (glob(PATH.'recipes/*.php') as $recipes) require_once($recipes);

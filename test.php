<?php
$data = '{"id":1,"jsonrpc":"2.0","result":{"item":{"artist":"Nick Cave & The Bad Seeds","id":542,"label":"17. Nick Cave & The Bad Seeds - O Children","title":"O Children","type":"song"}}}';
$xbmc = json_decode($data)->result->item;
//echo $xbmc->result[0]->item->artist;
print_r($xbmc);

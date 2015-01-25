<?php $title = 'save_file'; //todo это вообще не шаблон
$text = combine_jokes_to_string();
$text = file_download($text);

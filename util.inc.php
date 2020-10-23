<?php

function h($string)
{
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

//ランダムなハッシュの作成
function random()
{
    return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, 8);
}






?>
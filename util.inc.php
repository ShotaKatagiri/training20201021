<?php

function h($string)
{
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

//ランダムなハッシュの作成
function randomToken()
{
    return (uniqid(mt_rand(), true));
}



?>
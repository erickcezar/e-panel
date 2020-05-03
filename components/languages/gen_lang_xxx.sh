#!/bin/bash

cat default_lang.php | sed -E "

s/ => '[^%$<>]+'/ => 'xx'/g;
s/(['>])[a-zA-Z0-9 áéíóúãõç.ê;:,\".-]+([<%{(?]|',)/\1 xx \2/g;
s/(%[sd])[ ,.:][^%<{']+/\1 xx /g;
s/([}]) [^<{']+/\1 xx /g;
s/ detalhes/ xx/g;
 
" > lang_xxx.php 

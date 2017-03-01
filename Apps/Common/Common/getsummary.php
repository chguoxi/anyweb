<?php
function get_summary($content,$lenght=100){
	$partner[0] = '/&lt;\w{1,}&gt;/i';
	$partner[1] = '/&lt;\/\w{1,}&gt;/i';
	$partner[2] = '/&lt;\w{1,}\s*\/&gt;/i';
	$partner[3] = '/\<script\s*>.*?<\/script>/i';
	$partner[4] = '/\<hr\/\s*>/';
	$partner[5] = '/\<br\/\s*>/';
	$partner[6] = '/\n/';
	$partner[7] = '/\r/';
	$partner[7] = '/\s{2,}/';
	$replace[0] = '';
	$replace[1] = '';
	$replace[2] = '';
	$replace[3] = '';
	$replace[4] = '';
	$replace[5] = '';
	$replace[6] = '';
	$replace[7] = '';
	$replace[8] = ' ';
	$content = preg_replace($partner, '', $content);
	$content = strip_tags($content);
	$content = msubstr($content, 0, $lenght);
	return $content;
}
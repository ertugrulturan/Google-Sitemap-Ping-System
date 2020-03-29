<?php
set_time_limit(900);

if($_POST)
{

$domains = explode("\n", $_POST['domains']);

foreach($domains as $domain)
{

$domain = explode('|', $domain);

$keyword = $domain[1];
$domain = $domain[0];

echo $keyword." - ".$domain;


$ch = curl_init();
	$userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';
    curl_setopt ($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt ($ch, CURLOPT_HEADER, 1);
    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_REFERER, 'http://www.google.com/');

    curl_setopt ($ch, CURLOPT_URL, 'http://pingomatic.com/ping/?title=' . urlencode($keyword) . '&blogurl=' . urlencode($domain) . '&rssurl=http%3A%2F%2F&chk_weblogscom=on&chk_blogs=on&chk_technorati=on&chk_feedburner=on&chk_syndic8=on&chk_newsgator=on&chk_myyahoo=on&chk_pubsubcom=on&chk_blogdigger=on&chk_blogrolling=on&chk_blogstreet=on&chk_moreover=on&chk_weblogalot=on&chk_icerocket=on&chk_newsisfree=on&chk_topicexchange=on&chk_google=on&chk_tailrank=on&chk_bloglines=on&chk_postrank=on&chk_skygrid=on&chk_bitacoras=on&chk_collecta=on');
    $AskApache_result = curl_exec ($ch);


    if(preg_match('/Pinging complete!/', $AskApache_result))
    {
        echo $url . ' - Pinglendi<br>';
		$data = file_get_contents("https://www.google.com/webmasters/tools/ping?sitemap=".$url."/sitemap.xml");
        $status = ( strpos($data,"Sitemap Notification Received") !== false ) ? "OK" : "ERROR";
    }
    else
    {
        echo $url . ' - <b>Zaten pinglenmis!</b><br>';
    }
    
    flush();
    ob_flush();

}
echo "";
}
?>
<form method="post">
<textarea name="domains" cols=100 rows=30></textarea><br>
<br>
<input type="submit">
</table>
</form>

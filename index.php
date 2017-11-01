<?php
$access_token = 'r4RxGKfhv01GPAAq6YXMOZte/cJsiLF3nAmWoXFbhmbODyuVPnp1AC01soF3dBQ6x88MGijebWpDJv/nJE4rK86vbCimPjK1/F1KsdkiH9ws1kbwBlkgfn6Xr/m//GxMjOD9ZZdr67vrwQv51JUz6QdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	$says = array("บอท", "หรอย", "เมีย", "จีบ");
	
	$answers = array("เรียกหนูทำไมค่ะ", "เมียไม่อยู่สินะ ถึงเรียกนู๋มาเนี่ย", "เห้ออออ อย่านินทานู๋สิค่ะ", "ค่ะที่รัก");
    $answers2 = array("หนูก็ว่างั้นแหละค่ะ", "ชอบๆๆๆ", "อิอิ", "บางครั้งก็พูดมีสาระกันบ้างนะค่ะพี่ๆ");
	$answers3 = array("นินทาเมียไม่ดีนะค่ะพี่", "ไหนว่าไม่กลัวเมียค่ะ", "เก่งจริงงงงง ลับหลังเมียนี่", "เดี๋ยวนู๋จะฟ้องเมียพี่ คอยดู");
	$answers4 = array("ดูหนังหน้าตัวเองก่อนค่ะ", "ตื่นๆๆ ค่ะ", "นู๋มีผัวแล้วค่ะ", "นู๋ไม่ชอบคนเจ้าชู้ค่ะ");
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			$ans = null;
			if (strpos($text, $says[0]) !== false) {
				$ans = $answers[rand(0,3)];
			}
			elseif (strpos($text, $says[1]) !== false) {
				$ans = $answers2[rand(0,3)];
			}
			elseif (strpos($text, $says[2]) !== false) {
				$ans = $answers3[rand(0,3)];
			}
			elseif (strpos($text, $says[3]) !== false) {
				$ans = $answers4[rand(0,3)];
			}			
			if($ans !=null){
				// Get replyToken
				$replyToken = $event['replyToken'];

				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $ans
				];

				// Make a POST Request to Messaging API to reply to sender
				$url = 'https://api.line.me/v2/bot/message/reply';
				$data = [
					'replyToken' => $replyToken,
					'messages' => [$messages],
				];
				$post = json_encode($data);
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);

				echo $result . "\r\n";
			}
		}
	}
}
echo "OK";
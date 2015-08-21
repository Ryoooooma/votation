<?php

session_start();

require_once('config.php');
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] != "POST") {
	// 投稿前

	// CSRF対策（sessionのtokenに乱数を入れている（tokenをセットしている）
	if (!isset($_SESSION['token'])) {
		$_SESSION['token'] = sha1(uniqid(mt_rand(), true));
	}
} else {
	// 投稿後のsessionのtokenとpostされたtokenの中身が正しいかどうかのチェック
	if (empty($_POST['token']) || $_POST['token'] !== h($_SESSION['token'])) {
		echo "不正な処理です！";
		// var_dump($_SESSION['token']);
		// var_dump($_POST['token']);
		exit;
	}
	// 投稿後の写真選択がされていない時のエラーチェック
	if (!in_array($_POST['answer'], array(1, 2, 3, 4, 5, 6))) {
		$err = "写真を選択してください";
	}


}

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>投票システム</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	</head>
	<body>
		<?php if (!empty($err)) : ?>
		<p style="color:red"><?php echo h($err); ?></p>
		<?php endif; ?>
		<h1>お料理コンテスト</h1>
		<form action="" method="POST">
			<img src="pictures/yuko_1.jpg" class="candidate" data-id="1">
			<img src="pictures/yuko_2.jpg" class="candidate" data-id="2">
			<img src="pictures/yuko_3.jpg" class="candidate" data-id="3">
			<img src="pictures/yuko_4.jpg" class="candidate" data-id="4">
			<img src="pictures/yuko_5.jpg" class="candidate" data-id="5">
			<img src="pictures/yuko_6.jpg" class="candidate" data-id="6">
			<p><input type="submit" value="投票する！"></p>
			<input type="hidden" id="answer" name="answer" value="">
			<input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
		</form>
		<script>
		$(function() {
			$('.candidate').click(function() {
				$('.candidate').removeClass('selected');
				$(this).addClass('selected');
				$('#answer').val($(this).data('id'));
			});
		});
		</script>
	</body>
</html>
<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

// --------- 入力データの取得とエスケープ ---------
$name       = htmlspecialchars($_POST["name"]);
$furigana   = htmlspecialchars($_POST["furigana"]);
$dob        = htmlspecialchars($_POST["dob"]);
$tel        = htmlspecialchars($_POST["tel"]);
$email      = htmlspecialchars($_POST["email"]);
$job_status = htmlspecialchars($_POST["job_status"]);
$address    = htmlspecialchars($_POST["address"]);

// --------- 管理者宛のメール ---------
$to_admin = "saiyou@h-around.jp"; // ← 管理者のメールアドレス
$subject_admin = "【転職相談・お問い合わせ】フォームからのご連絡";

$body_admin = <<<EOM
以下の内容でお問い合わせがありました。

━━━━━━━━━━━━━━━━━━━━━━━
【氏名】　　　{$name}
【フリガナ】　{$furigana}
【生年月日】　{$dob}
【電話番号】　{$tel}
【メール】　　{$email}
【就業情報】　{$job_status}
【住所】　　　{$address}
━━━━━━━━━━━━━━━━━━━━━━━

ご対応のほどよろしくお願いいたします。
EOM;

$header_admin = "From: " . mb_encode_mimeheader("転職相談フォーム") . " <form@test-pagesite.site>";

$admin_mail_sent = mb_send_mail($to_admin, $subject_admin, $body_admin, $header_admin);

// --------- ユーザー宛 自動返信メール ---------
$subject_user = "お問い合わせ頂きありがとうございます";

$body_user = <<<EOM
{$name} 様

このたびは、転職相談・お問い合わせフォームよりご連絡いただき誠にありがとうございます。
以下の内容でお問い合わせを受け付けました。

━━━━━━━━━━━━━━━━━━━━━━━
【氏名】　　　{$name}
【フリガナ】　{$furigana}
【生年月日】　{$dob}
【電話番号】　{$tel}
【メール】　　{$email}
【就業情報】　{$job_status}
【住所】　　　{$address}
━━━━━━━━━━━━━━━━━━━━━━━

内容を確認のうえ、担当者よりご連絡させていただきます。
今しばらくお待ちくださいませ。

※本メールは自動送信です。返信はご遠慮ください。

-------------------------------
転職サポートセンター（仮）
URL：https://example.com
MAIL：support@example.com
-------------------------------

EOM;

$header_user = "From: " . mb_encode_mimeheader("転職相談フォーム") . " <form@test-pagesite.site>";

$user_mail_sent = mb_send_mail($email, $subject_user, $body_user, $header_user);

// --------- 結果表示 ---------
if ($admin_mail_sent && $user_mail_sent) {
    echo "お問い合わせを受け付けました。<br>自動返信メールを送信しました。";
} else {
    echo "送信に失敗しました。大変お手数ですが、再度お試しください。";
}
?>
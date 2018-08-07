<?php
global $USER, $DB;
$serverProtocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')?'https':'http';
$http_referer = parse_url($_SERVER["HTTP_REFERER"]);
$arg_poll = htmlspecialchars($_REQUEST["arg_poll"]);
$argPollCode = htmlspecialchars($_REQUEST["arg_pollcode"]);
$argPollID = htmlspecialchars($_REQUEST["arg_pollid"]);
$arg_poll = htmlspecialchars($_REQUEST["arg_poll"]);
use \app\models\Poll;
use \app\models\Member;

if (isset($arg_poll) && isset($argPollCode) && $argPollID>0) {
    $arg_user = htmlspecialchars($_REQUEST["arg_user"]);

    $user_id = 1;

    $poll = Poll::findOne(['code' => $argPollCode]);

    if ($poll) {
        $poll->users_finished = $poll->users_finished == '' ? 1 : $poll->users_finished + 1;
        $poll->save();

        $memberLast = Member::find()->orderBy(['id'=> SORT_DESC])->one();


        if ($memberLast->id == '') {
            $lastNumber = 1;
        } else {
            $lastNumber = $memberLast->id;
        }

        $number = $poll->id . '_' . $lastNumber;
        $member = new Member();
        $member->user_id = 1;
        $member->poll_id = $poll->id;
        $member->date_create = date('Y-m-d h:i:s');
        $member->number = $number;
        $member->save();
    }
}
?>
<script>
    top.location.href = "/poll/";
</script>


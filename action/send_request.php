<?php include '../core/init.php'; ?>
<?php if(!$session->is_signed_in()) {redirect("index.php");} ?>

<?php

$id = $_GET['id'];
if(empty($id))
{
    redirect("../index.php");
}

if(Friends::check_friends_realtion($session->user_id, $id, $session->user_id) == false)
{
$new_friend = new Friends();
$new_friend->friend_request($session->user_id, $id);
redirect($_SERVER['HTTP_REFERER']);
}
else
{
    redirect("../index.php");
}
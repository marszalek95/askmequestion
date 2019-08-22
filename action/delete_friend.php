<?php include '../core/init.php'; ?>
<?php if(!$session->is_signed_in()) {redirect("index.php");} ?>

<?php

$id = $_GET['id'];

$friends = Friends::find_by_id($id);

print_r($friends);

if(($friends->user_one_id == $session->user_id) || ($friends->user_two_id == $session->user_id))
{
    $friends->delete();

    redirect($_SERVER['HTTP_REFERER']);
}
else
{
    redirect("../index.php");
}
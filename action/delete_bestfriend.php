<?php include '../core/init.php'; ?>
<?php if(!$session->is_signed_in()) {redirect("index.php");} ?>

<?php

$id = $_GET['id'];

$friend = Friends::find_by_id($id);

if($friend->user_one_id == $session->user_id)
{
    if($friend->status_user_two == 4)
    {
        $friend->update_status('status_user_two', 1);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
elseif($friend->user_two_id == $session->user_id)
{
    if($friend->status_user_one == 4)
    {
        $friend->update_status('status_user_one', 1);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
else
{
    redirect('../friends.php');
}

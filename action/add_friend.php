<?php include '../core/init.php'; ?>
<?php if(!$session->is_signed_in()) {redirect("index.php");} ?>

<?php

$id = $_GET['id'];

$friend = Friends::find_by_id($id);

if(!empty($friend))
{
    $friend->update_status('status_user_two', 2);
    $friend->update_status('status_user_one', 2);
    redirect("../friends.php");
}
else
{
    redirect("index.php");
}

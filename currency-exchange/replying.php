<?php
include('php/connection.php');
$toReply=$row['email'];
// Replace with the ID of the email you want to reply to
$query =mysqli_query($connection,"SELECT * from defoultreply");
$email = mysqli_fetch_assoc($query);
// Generate the "Reply" button hyperlink
$recipient = $toReply ; // Replace with the email address of the person you're replying to
$subject = "Re: " . $email['subject'];
$body = $email['message'];
$reply_link = "mailto:$recipient?subject=" .$subject . "&body=" . $body;


?>
<?php
if (isset($_POST['feedback'])) {
                        $feedname=$_POST['name'];
                        $feedEmail=$_POST['email'];
                        $feedphone_no=$_POST['phone_no'];
                        $feedmessage=$_POST['message'];

                        $query=mysqli_query($connection,"INSERT INTO feedbacks VALUES ('','$feedname','$feedEmail','$feedphone_no','$feedmessage')");
                        if ($query) {
                            echo"<script> alert ('feedback Submitted'); </script>";
                            
                        }
                    }
?>
<?php  
  $serverdatetime = date("l jS \of F Y h:i:s A");

  // Multiple Recipients
  $to  = "romitmaity@live.com" . ", "; // note the comma
  $to .= "romitmaity@yahoo.com";

  // Subject
  $subject = "Newsletter Subscription: Successful";

  // Message
  $message = "
    <html>
    <head>
      <title>Subscription Mail</title>
    </head>
    <body>
      <p>Thank You! The Subscription request is as follows:</p>
      <table>
        <tr>
          <th>Item</th>
          <th>Status</th>
          <th>Date</th>
        </tr>
        <tr>
          <td>Video & Timelapse Subscription</td>
          <td>Active</td>
          <td>" . $serverdatetime . "</td>
        </tr>
        <tr>
          <td>HDR Photography and Weekly digest</td>
          <td>Active</td>
          <td>" . $serverdatetime . "</td>
        </tr>
        <tr>
          <td>Special Promotions to Workshops & Tutorials</td>
          <td>Active</td>
          <td>" . $serverdatetime . "</td>
        </tr>
      </table>
    </body>
    </html>
  ";

  // To send HTML mail, the Content-type header must be set
  $headers  = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

  // Additional headers
  //$headers .= "To: Romit Live <romitmaity@live.com>, Romit Yahoo <romitmaity@yahoo.com>" . "\r\n";
  $headers .= "From: Newsletter Subscription <newsletter@vista.com>" . "\r\n";
  //$headers .= "Cc: ccemail1@example.com" . "\r\n";
  //$headers .= "Bcc: bccemail1@example.com" . "\r\n";

  // Mail It
  //mail($to, $subject, $message, $headers);
?>
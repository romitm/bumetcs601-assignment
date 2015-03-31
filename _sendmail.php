
<?php
  // Multiple Recipients
  $to  = "rmaity@demandware.com" . ", "; // note the comma
  $to .= "romitmaity@yahoo.com";

  // Subject
  $subject = "Newsletter Subscription: Successful";

  // Message
  $message = "
    <html>
    <head>
      <title>Birthday Reminders for August</title>
    </head>
    <body>
      <p>Here are the birthdays upcoming in August!</p>
      <table>
        <tr>
          <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
        </tr>
        <tr>
          <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
        </tr>
        <tr>
          <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
        </tr>
      </table>
    </body>
    </html>
  ";

  // To send HTML mail, the Content-type header must be set
  $headers  = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

  // Additional headers
  $headers .= "To: Romit <rmaity@demandware.com>, Romit <romitmaity@yahoo.com>" . "\r\n";
  $headers .= "From: Newsletter Subscription <newsletter@vista.com>" . "\r\n";
  //$headers .= "Cc: birthdayarchive@example.com" . "\r\n";
  //$headers .= "Bcc: birthdaycheck@example.com" . "\r\n";

  // Mail It
  mail($to, $subject, $message, $headers);
?>
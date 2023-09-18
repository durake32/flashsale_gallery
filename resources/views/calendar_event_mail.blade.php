<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Event </title>
</head>

<body>
    <p>Dear {{$event->user->name}},</p>
    <p>Your program {{$event->program_name}} is on {{ date('M d,Y',strtotime($event->event_date)) }}.</p>
    <p>We wish you all the best for your upcoming {{$event->program_name}}.</p>
    <p>
        <strong>
        Regards <br>
        <i>Nepal’s first online stationery store</i><br>
        Dailomaa<br>
        01-5314021, 9801255841<br>
        www.dailomaa.com<br>
    </strong>
    </p>
    <img src="https://dailomaa.com/Asset/Uploads/Static/playstore.png" width="60" height="30">
    <img src="https://dailomaa.com/Asset/Uploads/Static/appstore.png" width="60" height="30">
</body>

</html>

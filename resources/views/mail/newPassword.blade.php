<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .title {
            text-align:center;
            font-size: 24px;
        }
        .content {
            direction: rtl;

        }
    </style>
</head>
<body>
    <div class="title">
        به نام خدا
    </div>
    <div class="content">
        <p>{{$firstName}} {{$lastName}}</p>
        <p>رمز عبور جدید برای شما ایجاد شد.</p>
        <p>{{$password}}</p>
        <p>لطفا نسبت به تغییر آن و استفاده از یک رمز عبور مطمئن اقدام کنید</p>
        <p>با تشکر</p>
        <p>از طرف دانشگاه علوم پزشکی</p>
    </div>
</body>
</html>
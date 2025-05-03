<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #007bff;
            color: #ffffff;
        }

        .header img {
            width: 100px;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
        }

        .content h2 {
            text-align: center;
            font-size: 28px;
            color: #007bff;
            margin: 20px 0;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin: 15px 0;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #777;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
        }

        .footer strong {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- <img src="{{ asset('images/logo/Logo 1.jpg') }}" alt="The Prince Fashion Logo"> --}}
            <h1>The Friday blog</h1>
        </div>
        <div class="content">
            <p>Hi {{$name}},</p>
            <p>Thank you for applying for the job with the email address <strong>{{$email}}</strong> at The Friday blog. We will review your application and get back to you shortly!</p>
            <p>If you did not apply, please ignore this message.</p>
        </div>
        <div class="footer">
            <p>Warm regards,</p>
            <p><strong>The Friday blog Team</strong></p>
        </div>
    </div>
</body>
</html>

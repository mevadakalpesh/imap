<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }
        .success-icon {
            color: #1abc9c;
            font-size: 48px;
            margin-bottom: 10px;
        }
        h1 {
            margin: 0;
        }
        p {
            font-size: 18px;
        }
        .back-link {
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">&#10004;</div>
        @if($type == 'reset_password')
        <h1>Password Reset Successful</h1>
        <p>Your password has been successfully reset. Go to App and enjoy our service</p>
        @elseif($type == 'verify_email')
        <h1>Email Verification Successful</h1>
        <p>Your email has been successfully verified. Thank you!</p>
        @endif 
        
    </div>
</body>
</html>

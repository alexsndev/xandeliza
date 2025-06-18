<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nova mensagem do formulário de contato</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nova mensagem do formulário de contato</h2>
        </div>
        
        <div class="content">
            <p><strong>Nome:</strong> {{ $data['name'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Mensagem:</strong></p>
            <p>{{ $data['message'] }}</p>
        </div>
        
        <div class="footer">
            <p>Este email foi enviado através do formulário de contato do site.</p>
        </div>
    </div>
</body>
</html> 
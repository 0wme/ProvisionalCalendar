<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            width: 100%;
            min-height: 100vh;
            
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            margin-bottom: 40px;
            overflow: hidden;
        }
        .header {
            background-color: #72C489;
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        .logo {
            width: 80px;
            height: auto;
            margin-bottom: 15px;
            filter: brightness(0) invert(1);
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 24px;
            font-weight: 500;
        }
        .header p {
            margin: 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .welcome-text {
            text-align: center;
            color: #374151;
            font-size: 16px;
            margin-bottom: 30px;
            padding: 30px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }
        .fields-section {
            padding: 20px;
            background-color: #f8fafc;
        }
        .field-container {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
        }
        .field-label {
            color: #374151;
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: 500;
        }
        .field-value {
            background: #f8fafc;
            padding: 12px;
            border-radius: 8px;
            font-family: monospace;
            font-size: 16px;
            border: 1px solid #e5e7eb;
        }
        .security-notice {
            margin: 20px;
            padding: 20px;
            background-color: #f5f3ff;
            border-radius: 12px;
            border-left: 4px solid #7c3aed;
        }
        .security-notice p {
            margin: 0;
            color: #7c3aed;
            font-size: 15px;
        }
        .button-container {
            text-align: center;
            padding: 30px 20px;
            background-color: #ffffff;
        }
        .button {
            display: inline-block;
            background-color: #72C489;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.2s;
        }
        .button:hover {
            background-color: #5da670;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 14px;
            background-color: #f8fafc;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ config('app.url') }}/img/logo.png" alt="Logo" class="logo">
            <h1>Vos identifiants de connexion</h1>
            <p>Application de gestion des calendriers prévisionnels</p>
        </div>

        <div class="welcome-text">
            Bienvenue dans votre espace de gestion des calendriers prévisionnels. 
            Voici vos identifiants de connexion :
        </div>

        <div class="fields-section">
            <div class="field-container">
                <div class="field-label">Nom d'utilisateur</div>
                <div class="field-value">{{ $username }}</div>
            </div>

            <div class="field-container">
                <div class="field-label">Mot de passe temporaire</div>
                <div class="field-value">{{ $password }}</div>
            </div>
        </div>

        <div class="security-notice">
            <p>Pour des raisons de sécurité, nous vous recommandons de créer votre mot de passe personnel lors de votre première connexion.</p>
        </div>

        <div class="button-container">
            <a href="{{ config('app.url') }}" class="button">Accéder à l'application</a>
        </div>

        <div class="footer">
            IUT du Limousin - Université de Limoges
        </div>
    </div>
</body>
</html>

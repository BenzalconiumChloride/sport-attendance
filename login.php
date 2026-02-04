<?php
require_once 'global-library/database.php';
require_once 'include/functions.php';

$data = ["emailAddress" => null, "message" => null]; // Default structure

if (isset($_POST['txtEmailAddress'])) {
    $result = doLogin();
    if (!empty($result) && is_array($result)) {
        $data = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $webRoot . '/include/global-css.php'); ?>

    <title>Login</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        width: 100%;
        height: 100dvh;
        background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        overflow: hidden;
        position: relative;
    }

    /* Animated sports background pattern */
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.03) 35px, rgba(255,255,255,.03) 70px);
        animation: slidePattern 20s linear infinite;
    }

    @keyframes slidePattern {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(70px) translateY(70px); }
    }

    /* Floating sports icons decoration */
    .sports-decoration {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
        z-index: 0;
    }

    .sports-icon {
        position: absolute;
        opacity: 0.05;
        font-size: 4rem;
        animation: float 15s infinite ease-in-out;
    }

    .sports-icon:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
    .sports-icon:nth-child(2) { top: 60%; right: 15%; animation-delay: 3s; }
    .sports-icon:nth-child(3) { bottom: 15%; left: 20%; animation-delay: 6s; }
    .sports-icon:nth-child(4) { top: 30%; right: 25%; animation-delay: 9s; }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(10deg); }
    }

    .login-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        position: relative;
        z-index: 1;
    }

    .login-container-header {
        text-align: center;
        margin-bottom: 2rem;
        animation: fadeInDown 0.8s ease-out;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-logo {
        width: 80px;
        height: auto;
        filter: drop-shadow(0 8px 16px rgba(0,0,0,0.3));
        transition: transform 0.3s ease;
    }

    .login-logo:hover {
        transform: scale(1.05);
    }

    .product-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #ffffff;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .product-subtitle {
        font-size: 14px;
        font-weight: 300;
        color: rgba(255,255,255,0.8);
        letter-spacing: 0.5px;
    }

    .login-container-content {
        width: 100%;
        max-width: 420px;
        padding: 2.5rem;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 
            0 20px 60px rgba(0,0,0,0.3),
            0 0 0 1px rgba(255,255,255,0.1),
            inset 0 1px 0 rgba(255,255,255,0.8);
        animation: fadeInUp 0.8s ease-out;
        position: relative;
        overflow: hidden;
    }

    .login-container-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, 
            transparent, 
            #28a745, 
            transparent);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-group-neu {
        margin-bottom: 1.5rem;
    }

    .form-group-neu label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-group-neu input {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8f9fa;
        color: #2c3e50;
    }

    .form-group-neu input:focus {
        outline: none;
        border-color: #28a745;
        background: #ffffff;
        box-shadow: 
            0 0 0 4px rgba(40, 167, 69, 0.1),
            0 4px 12px rgba(40, 167, 69, 0.15);
        transform: translateY(-2px);
    }

    .form-group-neu input::placeholder {
        color: #95a5a6;
    }

    .product-message-error {
        text-align: center;
        font-size: 14px;
        font-weight: 500;
        padding: 12px;
        border-radius: 10px;
        background: rgba(220, 53, 69, 0.1);
        border-left: 4px solid #dc3545;
        animation: shake 0.5s;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .btn {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    }

    .btn-success::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-success:hover::before {
        width: 400px;
        height: 400px;
    }

    .btn-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.5);
    }

    .btn-success:active {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    }

    .w-100 {
        width: 100%;
    }

    .text-danger {
        color: #dc3545;
    }

    /* Responsive design */
    @media (max-width: 480px) {
        .login-container-content {
            max-width: 90%;
            padding: 2rem 1.5rem;
        }

        .login-logo {
            width: 100px;
        }

        .product-title {
            font-size: 20px;
        }

        .sports-icon {
            font-size: 3rem;
        }
    }

    /* Additional polish */
    ::selection {
        background: #28a745;
        color: white;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0px 1000px #f8f9fa inset;
        transition: background-color 5000s ease-in-out 0s;
    }
</style>

<body>
    <!-- Sports decoration elements -->
    <div class="sports-decoration">
        <div class="sports-icon">⚽</div>
        <div class="sports-icon">🏀</div>
        <div class="sports-icon">⚾</div>
        <div class="sports-icon">🏈</div>
    </div>

    <div class="login-container">
        
        <div class="login-container-header">
            <img class="login-logo" src="<?php echo WEB_ROOT; ?>assets/images/login/favicon.png" alt="Logo">
        </div>

        <div class="login-container-content">
            <form id="loginform" name="frmLogin" method="post">

                <?php if (!empty($data["message"])): ?>
                <div class="product-message-error text-danger mb-3">
                    <?php echo htmlspecialchars($data["message"]); ?>
                </div>
                <?php endif; ?>

                <div class="form-group-neu">
                    <label for="email">Email address</label>
                    <input type="email" name="txtEmailAddress" id="email"
                        value="<?php echo htmlspecialchars($data["emailAddress"]); ?>"
                        placeholder="Enter email" required>
                </div>

                <div class="form-group-neu">
                    <label for="password">Password</label>
                    <input type="password" name="txtPassword" id="password" placeholder="Enter password" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success w-100">Login</button>
                </div>

            </form>
        </div>
    </div>
</body>

<?php include($_SERVER["DOCUMENT_ROOT"] . '/' . $webRoot . '/include/global-js.php'); ?>

</html>
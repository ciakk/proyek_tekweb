<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <?php
        require("../includes/koneksi.php");
        require("../functions/insert_users.php");
        // require("session.php");
    ?>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #2c3564;
            overflow: auto;
            background-image: url('assets/pasarBG.jpg'); /* Gambar sebagai background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }

        /* Lingkaran biru tua sebagai elemen referensi */
        .circle {
            position: relative;
            width: 150px;
            height: 150px;
            background-color: rgb(61, 71, 133); /* Biru tua */
            border-radius: 50%;
            margin: 50px auto 0;
        }

        /* Logo Skibidi */
        .floating-logo {
            position: absolute;
            top: 30px; /* Atur jarak dari atas lingkaran */
            left: 70%; /* Pusatkan secara horizontal */
            transform: translateX(-50%); /* Koreksi agar tepat di tengah */
            width: 500px;
            height: 200px;
            background-image: url('assets/Logo_Sikibdi_mart-removebg-preview.png'); /* Gambar logo */
            background-size: cover;
            background-position: center;
            animation: float 3s ease-in-out infinite;
        }

        /* Animasi floating */
        @keyframes float {
            0% {
                transform: translate(-50%, 0);
            }
            50% {
                transform: translate(-50%, -20px);
            }
            100% {
                transform: translate(-50%, 0);
            }
        }

        /* Form dan tombol */
        .email, .password {
            margin: 20px auto;
            text-align: left;
            width: 300px;
        }
        .email label, .password label {
            display: block;
            color: aliceblue;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .sec-2 {
            display: flex;
            align-items: center;
            border-radius: 5px;
            padding: 10px;
        }
        .sec-2 input {
            border: none;
            flex: 1;
            font-size: 16px;
        }
        .sec-2:hover {
            color: #2c3564;
            background-color: white;
        }
        ion-icon {
            margin-right: 10px;
            color: gray;
        }
        ion-icon.show-hide {
            cursor: pointer;
        }
        button.login {
            display: block;
            width: 300px;
            padding: 10px;
            margin: 20px auto;
            background-color: lightgrey;
            color: #2c3564;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button.login:hover {
            color: bisque;
            background-color: darkgreen;
        }
    </style>
</head>
<body>
    <!-- Lingkaran Biru dengan Logo Skibidi -->
    <div class="circle">
        <div class="floating-logo"></div>
    </div>

    <!-- Form Sign In -->
     <form action="" method="POST">
     <div class="email">
        <label for="email">Username</label>
        <div class="sec-2">
            <ion-icon name="username-outline"></ion-icon>
            <input type="text" name="username" placeholder="LontongLovers01" required/>
        </div>
    </div>
    <div class="password">
        <label for="password">Password</label>
        <div class="sec-2">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input class="pas" type="password" name="password" placeholder="akusukalontong123" required/>
            <ion-icon class="show-hide" name="eye-outline"></ion-icon>
        </div>
    </div>
    <button class="login" type="submit" name="signin">Sign In</button>
     </form>
    
</body>
</html>
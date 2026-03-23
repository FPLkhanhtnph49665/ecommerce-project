<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coming Soon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 60px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .time-box {
            background: rgba(255,255,255,0.15);
            padding: 20px;
            border-radius: 10px;
            min-width: 80px;
        }

        .time-box h2 {
            font-size: 32px;
        }

        .time-box span {
            font-size: 14px;
        }

        .email-box {
            margin-top: 30px;
        }

        input[type="email"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 250px;
        }

        button {
            padding: 10px 15px;
            border: none;
            background: #ff7a18;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #ff5200;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Coming Soon 🚀</h1>
    <p>Website đang được phát triển. Sắp ra mắt!</p>

    <!-- Countdown -->
    <div class="countdown">
        <div class="time-box">
            <h2 id="days">0</h2>
            <span>Days</span>
        </div>
        <div class="time-box">
            <h2 id="hours">0</h2>
            <span>Hours</span>
        </div>
        <div class="time-box">
            <h2 id="minutes">0</h2>
            <span>Minutes</span>
        </div>
        <div class="time-box">
            <h2 id="seconds">0</h2>
            <span>Seconds</span>
        </div>
    </div>

    <!-- Email -->
    <div class="email-box">
        <input type="email" placeholder="Nhập email của bạn">
        <button>Notify Me</button>
    </div>
</div>

<script>
    const launchDate = new Date("2026-06-01").getTime();

    setInterval(() => {
        const now = new Date().getTime();
        const distance = launchDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((distance / (1000 * 60)) % 60);
        const seconds = Math.floor((distance / 1000) % 60);

        document.getElementById("days").innerText = days;
        document.getElementById("hours").innerText = hours;
        document.getElementById("minutes").innerText = minutes;
        document.getElementById("seconds").innerText = seconds;
    }, 1000);
</script>

</body>
</html>

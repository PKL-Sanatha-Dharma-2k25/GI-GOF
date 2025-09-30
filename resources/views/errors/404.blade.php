<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>404 - Halaman Tidak Ditemukan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.2/lottie.min.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .btn {
            padding: 12px 24px;
            background-color: #fff;
            color: #2a5298;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #e0e0e0;
        }

        .click-here {
            margin-top: 8px;
            font-size: 0.9rem;
            color: #ccc;
        }

        #lottie404 {
            width: 300px;
            height: 300px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div id="lottie404"></div>
    <h1>404 - Not Found</h1>
    <p>{{ session('msgOut', 'Oops! The page you looking for is unavailable or you dont have access.') }}</p>
    <a href="{{ url('/') }}" class="btn">Back to go home</a>
    <div class="click-here">click here if you get lost</div>

    <script>
        lottie.loadAnimation({
            container: document.getElementById('lottie404'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: "{{ asset('public/assets/NotFound.json') }}"
        });
    </script>
</body>

</html>
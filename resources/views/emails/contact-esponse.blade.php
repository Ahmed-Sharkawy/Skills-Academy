<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            margin: 0;
        }

        td,
        p {
            font-size: 13px;
            color: #878787;
        }

        ul {
            margin: 0 0 10px 25px;
            padding: 0;
        }

        li {
            margin: 0 0 3px 0;
        }

        h1,
        h2 {
            color: black;
        }

        h1 {
            font-size: 25px;
        }

        h2 {
            font-size: 20px;
        }

        a {
            color: #2F82DE;
            font-weight: bold;
            text-decoration: none;
        }

        .entire-page {
            background: #C7C7C7;
            width: 100%;
            padding: 20px 0;
            font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif;
            line-height: 1.5;
        }

        .email-body {
            max-width: 600px;
            min-width: 320px;
            margin: 0 auto;
            background: white;
            border-collapse: collapse;

            img {
                max-width: 100%;
            }
        }

        .email-header {
            background: black;
            padding: 30px;
        }

        .news-section {
            padding: 20px 30px;
        }

        .footer {
            background: #eee;
            padding: 10px;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>{{ $name }}</h1>
    <table class="entire-page">
        <tr>
            <td>
                <table class="email-body">
                    <tr>
                        <td class="news-section">
                            <h1> {{ $title }}</h1>
                            <a href="https://blog.codepen.io/documentation/pro-features/pro-teams/"><img
                                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-1/codepen-team.130433.png"></a>
                            <p>{{ $body }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

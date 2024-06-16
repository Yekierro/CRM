<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <style>
        body {
            background: #121212;
            color: #fff;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .neomorphism {
            background: #1c1c1c;
            border-radius: 15px;
            box-shadow: 10px 10px 30px #0e0e0e, -10px -10px 30px #2a2a2a;
            padding: 20px;
            margin: 10px 0;
            width: 80%;
            max-width: 600px;
        }

        .neomorphism h1, .neomorphism p {
            color: #ffffff;
        }

        .neomorphism button, .neomorphism a {
            background: #1c1c1c;
            border: none;
            border-radius: 12px;
            box-shadow: 5px 5px 15px #0e0e0e, -5px -5px 15px #2a2a2a;
            color: #ffffff;
            font-size: 16px;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }

        .neomorphism button:hover, .neomorphism a:hover {
            background: #2a2a2a;
        }

        .neomorphism input[type="text"], .neomorphism textarea {
            width: calc(100% - 24px);
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 12px;
            box-shadow: inset 5px 5px 15px #0e0e0e, inset -5px -5px 15px #2a2a2a;
            background: #1c1c1c;
            color: #ffffff;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="neomorphism">
    <h1>Edit post</h1>
    <form action="/edit-post/{{$post->id}}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{$post->title}}" required>
        <textarea name="body" required>{{$post->body}}</textarea>
        <button>Save changes</button>
    </form>
</div>
</body>
</html>

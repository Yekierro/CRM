<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
            box-shadow: 10px 10px 30px #0e0e0e, -5px -5px 10px #2a2a2a;
            padding: 20px;
            margin: 10px 0;
            width: 80%;
            max-width: 600px;
        }

        .neomorphism-post {
            background: #1c1c1c;
            border-radius: 15px;
            border: 2px dashed #9ca3af;
            padding: 10px 20px;
            margin: 20px 0;
            width: 80%;
            max-width: 600px;
        }

        .neomorphism h2, .neomorphism p, .neomorphism h3, .neomorphism h4 {
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

        .neomorphism input[type="text"], .neomorphism input[type="email"], .neomorphism input[type="password"], .neomorphism textarea {
            width: calc(100% - 24px);
            max-width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 12px;
            box-shadow: inset 5px 5px 15px #0e0e0e, inset -5px -5px 15px #2a2a2a;
            background: #1c1c1c;
            color: #ffffff;
            font-size: 16px;
        }

        .auth-block {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            margin-top: 30px;
            width: 100%;
            max-width: 600px;
        }

        .greeting-s {
            flex: 1;
            text-align: left;
            margin-right: 20px;

        }

        .user-info {
            flex: 1;
            text-align: right;
        }
    </style>
</head>
<body>
@auth()
    <div class="neomorphism auth-block">
        <div class="greeting-s">
            <h1>Hello, {{ Auth::user()->name }}</h1>
            <h5>Welcome to your blog!
            <br>
            Here, you can create, remove, update and delete your posts, explore your content.<br>
            Enjoy your stay and feel free to express yourself! </h5>
        </div>
        <div class="user-info">
            <h5>
            <p>Your email: {{ Auth::user()->email }}</p></h5>
            <form action="/logout" method="post">
                @csrf
                <button>Log out</button>
            </form>
        </div>
    </div>
    <div class="neomorphism">
        <h2>Create a course</h2>
        <form action="/create-post" method="post">
            @csrf
            <input type="text" name="title" placeholder="post title" required>
            <br>
            <br>
            <textarea name="body" placeholder="body content..." required></textarea>
            <br>
            <br>
            <button>Save post</button>
        </form>
    </div>
    <div class="neomorphism">
        <h2>Courses</h2>
        @foreach($posts as $post)
            <div class="neomorphism-post">
                <h3>{{$post['title']}}  (by  {{$post->user->name}})</h3>
                <p>{{$post['body']}}</p>
                <a href="/edit-post/{{$post->id}}">Edit</a>
                <form action="/delete-post/{{$post->id}}" method="post" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@else
    <div class="neomorphism auth-block">
        <div class="greeting-s">
            <h2>Hello user!</h2>
                <h5>Join our community to share your thoughts and connect with others.
                <br>If you already have an account, please log in to continue.
                <br>New here?
                Register now to get started!</h5>

        </div>
    </div>
    <div class="neomorphism">
        <h2>Register</h2>
        <form action="/register" method="post">
            @csrf
            <input name="name" type="text" placeholder="name" required>
            <input name="email" type="email" placeholder="email" required>
            <input name="password" type="password" placeholder="password" required>
            <br>
            <br>
            <button>Register</button>
        </form>
    </div>
    <div class="neomorphism">
        <h2>Login</h2>
        <form action="/login" method="post">
            @csrf
            <input name="loginName" type="text" placeholder="name" required>
            <input name="loginPassword" type="password" placeholder="password" required>
            <br>
            <br>
            <button>Log in</button>
        </form>
    </div>
@endauth
</body>
</html>

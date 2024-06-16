<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @auth()
    <p>You are logged in as {{ Auth::user()->name }}</p>
    <p>With email: {{ Auth::user()->email }}</p>
    <form action="/logout" method="post">
        @csrf
        <button>Log out</button>
    </form>
    <div style="border: 3px solid black">
        <h2>Create a post</h2>
        <form action="/create-post" method="post">
            @csrf
            <input type="text" name="title" placeholder="post title">
            <textarea name="body" placeholder="body content..."></textarea>
            <button>Save post</button>
        </form>
    </div>

    <div style="border: 3px solid black">
        <h2>All Posts</h2>
        @foreach($posts as $post)
            <div style="background-color: lightskyblue; padding: 10px; margin: 10px;">
                <h3>{{$post['title']}} --- (post made by {{$post->user->name}})</h3>
                {{$post['body']}}
                <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                <form action="/delete-post/{{$post->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </div>
        @endforeach
    </div>

    @else
    <div style="border: 3px solid black">
        <h2>Register</h2>
        <form action="/register" method="post">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>
    <div style="border: 3px solid black">
        <h2>Login</h2>
        <form action="/login" method="post">
            @csrf
            <input name="loginName" type="text" placeholder="name">
            <input name="loginPassword" type="password" placeholder="password">
            <button>Log in</button>
        </form>
    </div>
    @endauth


</body>
</html>

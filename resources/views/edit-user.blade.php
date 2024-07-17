<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #121212;
            color: #f0f0f3;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #f0f0f3;
            text-align: center;
        }

        form {
            background: #1c1c1c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 10px 10px 20px #141415, -10px -10px 20px #141415;
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
        }

        label {
            margin-top: 10px;
            color: #f0f0f3;
        }

        input {
            background: #2c2c2e;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            box-shadow: inset 5px 5px 10px #141415, inset -5px -5px 10px #343435;
            margin-top: 5px;
            width: 100%;
        }

        button {
            background-color: #2c2c2e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            box-shadow: 5px 5px 10px #141415, -5px -5px 10px #141415;
            cursor: pointer;
            transition: box-shadow 0.2s ease;
            font-family: inherit;
            margin-top: 20px;
            align-self: center;
        }

        button:hover {
            box-shadow: 3px 3px 6px #141415, -3px -3px 6px #343435;
        }

        a {
            color: #0a84ff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            background-color: #2c2c2e;
            box-shadow: 5px 5px 10px #141415, -5px -5px 10px #141415;
            transition: box-shadow 0.2s ease;
            margin-top: 20px;
            align-self: center;
        }

        a:hover {
            box-shadow: 3px 3px 6px #141415, -3px -3px 6px #343435;
        }
    </style>
</head>
<body>
<h1>Edit User</h1>
<form action="{{ route('admin.update', $user->id) }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $user->name }}" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ $user->email }}" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="{{ $user->password }}" required>
    <br>
    <button type="submit">Save</button>
</form>
<a href="{{ route('admin.page') }}">Back to Admin Page</a>
</body>
</html>

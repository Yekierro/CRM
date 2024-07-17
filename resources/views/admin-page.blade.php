<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
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
            overflow-x: auto;
            overflow-y: auto;
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

        h1, h2 {
            color: #f0f0f3;
            text-align: center;
        }

        .table-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            overflow-x: auto;
        }

        .table-container {
            width: 100%;
            max-width: 1200px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #1c1c1c;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 10px 10px 20px #141415, -10px -10px 20px #141415;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            white-space: pre-line;
        }

        th {
            background-color: #3a3a3c;
            color: #f0f0f3;
            white-space: pre-line;
        }

        tr {
            border-bottom: 1px solid #3a3a3c;
        }

        tr:last-child {
            border-bottom: none;
        }

        .dropdown-content form, .dropdown-content a {
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            display: block;
            background: none;
            border: none;
            text-align: left;
            width: 100%;
        }

        .dropdown-content a:hover, .dropdown-content button:hover {
            background-color: #3a3a3c;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        form {
            display: inline;
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
        }

        a:hover {
            box-shadow: 3px 3px 6px #141415, -3px -3px 6px #343435;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons form button, .action-buttons a {
            padding: 5px 10px;
        }

        /* New Styles */
        td {
            max-width: 300px;
            min-width: 50px;
            overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;
            position: relative;
            white-space: pre-line;
        }

        .body-cell {
            white-space: pre-wrap; /* Handle spaces and line breaks */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Number of lines to show */
            -webkit-box-orient: vertical;
        }

        .body-cell:hover {
            white-space: normal;
            -webkit-line-clamp: unset;
        }

        /* Media Queries for Responsive Design */
        @media (max-width: 600px) {
            th, td {
                padding: 8px 10px;
            }

            .body-cell {
                -webkit-line-clamp: 2;
            }
        }

        /* Fixed Logout Button */
        .logout-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #d9534f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            box-shadow: 5px 5px 10px #141415, -5px -5px 10px #141415;
            cursor: pointer;
            transition: box-shadow 0.2s ease;
            font-family: inherit;
            z-index: 1000;
        }

        .logout-button:hover {
            box-shadow: 3px 3px 6px #141415, -3px -3px 6px #343435;
        }

        .greeting-s {
            flex: 1;
            text-align: center;
            margin-right: 20px;
        }
    </style>
</head>
<body>
@if (auth()->user()->role === 'admin')
    <h1>Welcome, Admin</h1>

    <!-- Ваш текущий код для админ-панели -->

    <div class="table-wrapper">
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->password }}</td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('admin.delete', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                                <a href="{{ route('admin.edit', $user->id) }}">Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <h2>User Posts</h2>
    <div class="table-wrapper">
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Body</th>
                    <th>User ID</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td class="body-cell">{{ $post->body }}</td>
                        <td>{{ $post->user_id }}</td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('post.delete', $post->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                                <a href="{{ route('post.edit', $post->id) }}" style="display:inline-block;">Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="/logout" method="post">
        @csrf
        <button type="submit" class="logout-button">Log out</button>
    </form>
@else

    <div class="neomorphism">
        <div class="greeting-s">
            <h2>Access Denied</h2>
            <h5>You do not have permission to access this page.</h5>
        </div>
    </div>
@endif
</body>

</html>

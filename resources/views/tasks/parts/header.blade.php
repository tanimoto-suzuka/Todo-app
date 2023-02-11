<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=yes" />
    <link rel="stylesheet" href="{{ asset('/css/header.css')  }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
</head>


<header>
    <div class="headerList">
        <div class="userName"><a href="{{ route('users.edit') }}">{{ $user->name}}さん</a></div>

        <div class=" home"><a href="/">Home</a></div>
        <div class="home"><a href="{{  route('class.edit') }}">Group Config</a></div>
    </div>

    <div class="logout">
        <form action="{{ route('logout') }}" method="POST" name="logout" id="logout">
            <input type="hidden" name="_token" form="logout" value="{{ csrf_token() }}" />
            <button type="submit" form="logout">ログアウト</button>

        </form>
    </div>



</header>
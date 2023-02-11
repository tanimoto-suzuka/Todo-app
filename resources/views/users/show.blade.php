<style>
    table div {
        width: 50%;
        text-align: center;
    }

    h2 {
        margin: auto;
        text-align: center;
        margin-bottom: 10px;

    }

    h3 {
        margin: auto;
        margin-top: 0;
        margin-bottom: 20px;
        padding-bottom: 10px;
        text-align: center;

        border-bottom: 1px solid #aaa;
        border-bottom-style: dashed;
    }

    .list {
        display: flex;
        border-top: 1px solid #aaa;
        border-top-style: dashed;
    }

    .list1 {
        display: flex;
        width: 100%;
    }

    .list1 div {
        width: 100%;
        color: #7A89B7;
    }

    .list a div {
        width: 100%;
    }

    .list a {
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    .list_task {
        text-align: center;
    }

    .list_name {
        font-weight: bold;
        text-align: center;
    }

    .list:hover {
        color: #E4B3BF;
    }

    .list_state {
        text-align: center;
        width: 100px;
    }
</style>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=yes" />
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
</head>
@include('tasks.parts.header')
<style>
    footer {
        padding: 0;
    }
</style>
<div class="main">
    <h1>{{$classname}} Users</h1>
    <div class="main_body">

        <div class="container">
            <div class="list1">
                <div class="list_name">Name</div>
                <div class="list_task">Task</div>
                <div class="list_state">State</div>
            </div>
            @foreach ($othertasks as $task)
            @if($task !== NULL)


            <div class="list">
                <a href="{{ route('users.date',['id' => $task->user_id]) }}">
                    <div class="list_name">{{ $task->user_name }}</div>
                    <div class="list_task">{{ $task->name }}</div>
                    <div class="list_state">
                        @if ($task->state === 0)
                        <div class="td3 list_state">未対応</div>
                        @elseif($task->state === 1)
                        <div class="td3 list_state">対応中</div>
                        @elseif($task->state === 2)
                        <div class="td3 list_state">対応済</div>
                        @endif
                    </div>
                </a>


            </div>
            @else
            @foreach($class_user as $c_user)
            <div class="list">
                <div class="list_name"><a href="{{ route('users.date',['id' => $c_user->id]) }}">{{ $c_user->name }}</a></div>
            </div>
            @endforeach
            @endif
            @endforeach

        </div>
    </div>

    @include('tasks.parts.footer')
</div>
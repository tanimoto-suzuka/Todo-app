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
        justify-content: space-between;
        width: 100%;
        margin: auto;
    }

    .list1 div {

        color: #7A89B7;
    }

    .list_name {
        width: 50%;

    }

    .list {
        display: flex;
        width: 100%;
        margin: auto;
        justify-content: space-between;
    }

    .list_task {

        text-align: center;
    }

    .list_dateline {
        width: 120px;
        text-align: center;
    }

    .list_state {
        text-align: center;
        width: 120px;
    }

    .box a {
        display: flex;
        width: 100%;
        justify-content: space-between;
        margin: auto;
    }

    .box {
        display: flex;
        width: 100%;
        justify-content: space-between;
        margin: auto;
    }

    .box1 {
        display: flex;
        width: 100%;
        justify-content: space-between;
        margin: auto;
    }

    .link_back {
        margin-top: 20px;
    }



    .list2 {

        margin: auto;

        padding-bottom: 10px;
        margin-bottom: 20px;
        border-bottom: 1px solid #aaa;
        border-bottom-style: dashed;

    }

    .list_box {
        display: flex;

        padding: 2px;
        font-weight: bold;
    }



    .name,
    .column {
        width: 50%;
        text-align: center;
    }
</style>
@include('tasks.parts.header')
<style>
    footer {
        padding: 0;
    }
</style>
<div class="main">
    <h1 style="color:#93C2D1">Profile</h1>
    <div class="main_body">

        <div class="container">
            <h2>{{$user_table->name}}</h2>

            <div class="list2">
                <div class="list_box">
                    <div class="name">Email</div>
                    <div class="column">{{ $user_table->email }}</div>
                </div>
                <div class="list_box">
                    <div class="name">UserID</div>
                    <div class="column">{{ $user_table->id }}</div>
                </div>

            </div>
            <div class="task__add">
                <a href="{{ route('tasks.add', ['id' => $user_table->id]) }}">＋このユーザーのタスクを追加</a>
            </div>
            <div class="list1">
                <div class="list_dateline">期限</div>
                <div class="list_task">Task</div>
                <div class="list_state">State</div>


            </div>
            @foreach ($tasks as $task)

            <div class="list">

                <div class="box">
                    <a href="{{ route('tasks.show', ['id' => $task->id]) }}">
                        <div class="list_dateline">{{ $task->dateline }}</div>
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

            </div>

            @endforeach
            <div class="link_back">
                <a href="{{$retern}}">戻る</a>
            </div>
        </div>
    </div>

    @include('tasks.parts.footer')
</div>
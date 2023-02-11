<style>
    h2 {
        color: #003265;
        padding-top: 30px;
        text-align: center;
    }

    .table::-webkit-scrollbar-track {
        background: #ffff;
        border-radius: 5px;
    }

    .list2 {
        display: flex;
        justify-content: space-between;
        margin: 0 auto;
        padding: 10px 0 10px 0px;
        text-align: center;
        border-bottom: 1px solid #aaa;
        border-bottom-style: dashed;
    }

    th {

        margin: 0 auto;
        padding: 10px 0 10px 0px;
        text-align: center;
    }

    td {

        padding: 10px 0 10px 0px;
        text-align: center;
        margin: auto;
    }

    tr {

        border-bottom: 1px solid #aaa;
        border-bottom-style: dashed;
    }

    a {
        margin-right: 20px;
    }



    .list {
        display: flex;
        justify-content: space-between;
        margin: 0 auto;

        align-items: center;
    }

    .list div {
        color: #7A89B7;
        margin: auto;
    }

    .list_dateline {
        width: 100px;
        text-align: center;
    }

    .list_task {
        width: 30%;
        text-align: center;
    }

    .list_task2 {
        width: 40%;
        text-align: center;
    }

    .list_state {
        width: 80px;
        text-align: center;
    }

    .list_action {
        width: 130px;
        text-align: center;
        justify-content: space-between;
    }

    .list_name {
        width: 100px;
        text-align: center;
    }

    .list a {
        margin: 0;
    }
</style>

<body>
    @include('tasks.parts.header')

    <div class="main1">
        <h1>{{$classname}} TASK</h1>
        <div class="main_body1">
            <div class="container1">
                <h2>My Task</h2>
                <div class="task__add">
                    <a href="{{ route('tasks.add', ['id' => $user->id]) }}">＋タスクを追加</a>
                </div>
                <div class="table">
                    <table>
                        <div class="list">
                            <div class="list_dateline">期限</div>
                            <div class="list_task">Task</div>
                            <div class="list_state">State</div>
                            <div class="list_action">Action</div>

                        </div>

                        @foreach ($tasks as $task)
                        <tr class="tr2 list">
                            <td class="list_dateline">{{ $task->dateline }}</td>
                            <td class="list_task">{{ $task->name }}</td>
                            @if ($task->state === 0)
                            <td class="td3 list_state">未対応</td>
                            @elseif($task->state === 1)
                            <td class="td3 list_state">対応中</td>
                            @elseif($task->state === 2)
                            <td class="td3 list_state">対応済</td>
                            @endif
                            <td class="btn_action list_action">
                                <a href="{{ route('tasks.show', ['id' => $task->id]) }}">詳細</a>
                                <a href="{{ route('tasks.edit', ['id' => $task->id]) }}">編集</a>
                                <form action="{{ route('tasks.delete', ['id' => $task->id]) }}" method="POST" name="deleteForm">
                                    @csrf
                                    <button class="delete" type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="container2">
                <h2>Other Task</h2>
                <div class="task__add">

                    <a href="{{ route('users.show') }}">User一覧</a>


                </div>
                <div class="table">
                    <table>
                        <div class="list">
                            <div class="list_name">Name</div>
                            <div class="list_task2">Task</div>
                            <div class="list_state">State</div>


                        </div>
                        @foreach ($othertasks as $othertask)

                        <a href="{{ route('tasks.show', ['id' => $othertask->id]) }}">
                            <div>
                                <div class="tr2 list2">
                                    <div class="list_name">{{ $othertask->user_name }}</div>

                                    <div class="list_task2">{{ $othertask->name }}</div>
                                    @if ($othertask->state === 0)
                                    <div class="td3 list_state">未対応</div>
                                    @elseif($othertask->state === 1)
                                    <div class="td3 list_state">対応中</div>
                                    @elseif($othertask->state === 2)
                                    <div class="td3 list_state">対応済</div>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </table>
                    <div>
                    </div>
                </div>
            </div>

        </div>
        @include('tasks.parts.footer')
    </div>

</body>
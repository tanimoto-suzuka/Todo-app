<style>
    .link {
        margin-top: 30px;
        text-align: center;
        display: flex;
        justify-content: space-between;
    }



    table th {
        width: 50%;

    }

    table td {
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



    tr:nth-child(3) {
        border-top: 1px solid #aaa;
        border-top-style: dashed;
    }

    .link_show {
        border-bottom: 1px solid #D78DA0;
        border-bottom-style: dashed;
    }
</style>
@include('tasks.parts.header')
<style>
    footer {
        padding: 0;
    }
</style>
<div class="main">
    <h1 style="color:#C1B7E0">Task詳細</h1>
    <div class="main_body">
        <div class="container">
            <h2>{{ $task->name }}</h2>
            <h3>{{ $task->content }}</h3>
            <table>
                <div>
                    <tr>
                        <th>ユーザー</th>
                        <td><a href="{{ route('users.date',['id' => $task->user_id]) }}">{{ $task->user_name }}</a></td>
                    </tr>
                    <tr>
                        <th>期限</th>
                        <td>{{ $task->dateline }}</td>
                    </tr>
                    <tr>
                        <th>状況</th>
                        @if ($task->state === 0)
                        <td class="td3 list_state">未対応</td>
                        @elseif($task->state === 1)
                        <td class="td3 list_state">対応中</td>
                        @elseif($task->state === 2)
                        <td class="td3 list_state">対応済</td>
                        @endif
                    </tr>
                </div>
                <div>

                    <tr>
                        <th>作成日時</th>
                        <td>{{ $task->created_at->format('Y年m月d日 H:i') }}</td>
                    </tr>
                    <tr>
                        <th>更新日時</th>
                        <td>{{ $task->updated_at->format('Y年m月d日 H:i') }}</td>
                    </tr>
                    <tr>
                        <th>作成者</th>
                        <td>{{ $task->created_user }}</td>
                    </tr>
                </div>

            </table>
            <div class="link">
                <div class="link__back">
                    <a href="{{$retern}}">戻る</a>
                </div>
                @if ($user->id == $task->user_id)
                <div class="link__edit">
                    <a href="{{ route('tasks.edit', ['id' => $task->id]) }}">編集</a>
                </div>
                <div class="link__delete">
                    <form action="{{ route('tasks.delete', ['id' => $task->id]) }}" method="POST" name="deleteForm">
                        @csrf
                        <button class="delete" type="submit">削除</button>
                    </form>

                </div>
                @elseif(($user->id !== $task->user_id))
                <div class="link_show">
                    <a href="{{ route('users.date',['id' => $task->user_id]) }}">このユーザのプロフィール</a>
                </div>
                @endif

            </div>
        </div>

    </div>
    @include('tasks.parts.footer')
</div>
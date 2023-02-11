@include('tasks.parts.header')
<style>
    footer {
        padding: 0;
    }
</style>
<div class="main">
    <h1 style="color:#E0E0B7">Task編集</h1>
    <div class="main_body">

        <div class="error">
            @foreach ($errors->all() as $error)
            <p class="error__message">{{$error}}</p>
            @endforeach
        </div>
        <form action="{{ route('tasks.update', ['id' => $task->id]) }}" method="POST" class="form">
            @csrf

            <div class="form-group">
                <label for="name">タスク<span>(必須)</span></label><br>
                <input type="text" name="name" maxlength="30" placeholder="タスクは30文字で書きましょう。" value="{{ old('name', $task->name) }}">
            </div>
            <div class="form-group">
                <label for="dateline">期限<span>(必須)</span></label><br>
                <input name="dateline" type="date" value="{{ old('name', $task->dateline) }}">
            </div>
            <div class="form-group">
                <label for="state">状況<span>(必須)</span></label><br>
                <select name="state">
                    <option value="{{$task->state}}">
                        @if ($task->state === 0)
                        <td class="td3 list_state">未対応</td>
                        @elseif($task->state === 1)
                        <td class="td3 list_state">対応中</td>
                        @elseif($task->state === 2)
                        <td class="td3 list_state">対応済</td>
                        @endif
                    </option>
                    @if($task->state ==0)
                    <option value=1>対応中</option>
                    <option value=2>対応済</option>
                    @elseif($task->state ==1)
                    <option value=0>未対応</option>
                    <option value=2>対応済</option>
                    @elseif($task->state ==2)
                    <option value=0>未対応</option>
                    <option value=1>対応中</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="content">タスク内容<span>(必須)</span></label><br>
                <textarea rows="5" name="content" placeholder="タスク内容を具体的に書きましょう">{{ old('content', $task->content) }}</textarea>
            </div>
            <button type="submit">更新する</button>
        </form>
    </div>
    @include('tasks.parts.footer')
</div>
<style>
    textarea {
        width: 60%;
    }


    .link_back {
        display: flex;

        margin-top: 20px;
    }

    .link_back button {
        margin: auto;

    }

    h2 {
        text-align: center;
        margin: 20px auto;

    }
</style>
@include('tasks.parts.header')
<style>
    footer {
        padding: 0;
    }
</style>
<div class="main">
    <h1 style="color:#E0B7C1">@if($users->name != $user->name)
        {{$users->name}}
        @endif
        Task追加
    </h1>
    <div class="main_body">
        <h2>{{$users->name}}Task</h2>
        <div class="error">
            @foreach ($errors->all() as $error)
            <p class="error__message">{{$error}}</p>
            @endforeach
        </div>


        <form action="{{ route('tasks.store') }}" method="POST" class="form">
            @csrf
            <input hidden name="id" type="text" value="{{$user_id}}">
            <div class="form-group">
                <label for="name">Task<span>(必須)</span></label><br>
                <input type="text" name="name" maxlength="30" placeholder="タスクは30文字で書きましょう。">
            </div>
            <div class="form-group">
                <label for="dateline">期限<span>(必須)</span></label><br>
                <input name="dateline" type="date" />
            </div>
            <div class="form-group">
                <label for="content">内容<span>(必須)</span></label><br>
                <textarea rows="5" name="content" placeholder="タスク内容を具体的に書きましょう"></textarea>
            </div>

            <div class="link_back">
                <a href="{{$retern}}">戻る</a>
                <button type="submit">追加</button>

            </div>
        </form>
    </div>
    @include('tasks.parts.footer')
</div>
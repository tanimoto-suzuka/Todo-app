<style>
    textarea {
        width: 60%;
    }

    h3 {
        text-align: center;
        color: red;
    }
</style>
<script>
    function Check() {
        var checked = confirm("一度部署を作ると削除ができません。\nそれでも作成しますか?");
        if (checked == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

@include('tasks.parts.header')
<style>
    footer {
        padding: 0;
    }

    .margin {
        margin-top: 10px;
    }
</style>
<div class="main">
    <h1 style="color:#E0E0B7">New Group</h1>
    <div class="main_body">
        <h3>新しい部署に配属しますか？</h3>
        <div class="error">
            @foreach ($errors->all() as $error)
            <p class="error__message">{{$error}}</p>
            @endforeach
        </div>

        <form action="{{ route('class.store') }}" method="POST" class="form">
            @csrf
            <div class="form-group">
                <label for="num">部署番号<span>(重複不可)</span></label><br>
                <select name="num">
                    @foreach($num as $number => $key)
                    <option value="{{$key}}">{{$key}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">部署名<span>(必須)</span></label><br>
                <input type="text" name="name" maxlength="30" placeholder="部署名は30文字で書きましょう。" value="{{ old('name') }}">

            </div>
            <button type="submit" onClick="return Check()">作成</button>

        </form>
    </div>

    @include('tasks.parts.footer')
</div>
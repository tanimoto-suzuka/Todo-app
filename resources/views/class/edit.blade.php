<style>
    textarea {
        width: 60%;
    }
</style>
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
    <h1 style="color:#E0E0B7">{{$classname}} Config</h1>
    <div class="main_body">

        <div class="error">
            @foreach ($errors->all() as $error)
            <p class="error__message">{{$error}}</p>
            @endforeach
        </div>


        <form action="{{ route('class.update') }}" method="POST" class="form">
            @csrf
            <div class="form-group">
                <label for="num">部署番号<span>(変更不可)</span></label><br>
                <div>{{$class_table->class_number}}</div>
            </div>
            <div class="form-group">
                <label for="name">部署名<span>(必須)</span></label><br>
                <input type="text" name="name" maxlength="30" placeholder="部署名は30文字で書きましょう。" value="{{ old('name', $classname) }}">
                <div class="margin"><label for="num">Last Update User/</label>{{$class_table->update_user}}</div>
            </div>
            <button type="submit">更新</button>
        </form>
    </div>
    @include('tasks.parts.footer')
</div>
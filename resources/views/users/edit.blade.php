<script>
    function Check() {
        var checked = confirm("個人情報を変更しますか?\nNew Groupを選択した場合、部署以外の情報が変更されます。");
        if (checked == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

<body>
    @include('tasks.parts.header')

    <div class="main">
        <h1 style="color:#E0E0B7">User Config</h1>
        <div class="main_body">

            <div class="error">
                @foreach ($errors->all() as $error)
                <p class="error__message">{{$error}}</p>
                @endforeach
            </div>


            <form action="{{ route('users.update') }}" method="POST" class="form">
                @csrf
                <div class="form-group">
                    <label for="name">名前<span>(必須)</span></label><br>
                    <input type="text" name="name" maxlength="30" placeholder="名前は30文字で書きましょう。" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="email">Email<span>(必須)</span></label><br>
                    <input type="text" name="email" maxlength="30" placeholder="部署名は30文字で書きましょう。" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="class">部署の変更</label><br>
                    <select name="class">
                        <option value="{{$class_table->class_number}}">{{$classname}}</option>
                        @foreach($class as $cla)
                        @if($class_table->class_number !== $cla->class_number){
                        <option value="{{$cla->class_number}}">{{$cla->name}}</option>
                        }
                        @endif
                        @endforeach
                        <option value="0">New Group</option>
                    </select>
                </div>

                <button type="submit" onClick="return Check()">変更</button>

            </form>
        </div>
        @include('tasks.parts.footer')
    </div>
</body>
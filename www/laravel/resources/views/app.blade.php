<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Vue TODO</title>

        <link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <script>
            window.Laravel = {};
            window.Laravel.csrfToken = "{{ csrf_token() }}";
        </script>
    </head>
    <body>
        <div id="app">
          {{-- <example></example> --}}
          @{{ message }}
        </div>
        <div id="app-2">
            <span v-bind:title="message">
                Hover
            </span>
        </div>
        <div id="app-3">
            <span v-if="seen">
                show message
            </span>
        </div>
        <div id="app-4">
            <ol>
                <li v-for="todo in todos">
                    @{{ todo.text }}
                </li>
            </ol>
        </div>
        <div id="app-5">
            <p>@{{ message }}</p>
            <button v-on:click="reverseMessage">Reverse Message</button>
        </div>
        <div id="app-6">
            <p>@{{ message }}</p>
            <input v-model="message">
        </div>
        <div id="app-7">
            <ol>
                <todo-item v-for="item in groceryList" v-bind:todo="item"></todo-item>
            </ol>
        <el-color-picker></el-color-picker>
        <div>
  <el-button>Default</el-button>
  <el-button type="primary">Primary</el-button>
  <el-button type="success">Success</el-button>
  <el-button type="info">Info</el-button>
  <el-button type="warning">Warning</el-button>
  <el-button type="danger">Danger</el-button>
</div>
        </div>

    <script src=" {{ mix('js/app.js') }} "></script>
</html>

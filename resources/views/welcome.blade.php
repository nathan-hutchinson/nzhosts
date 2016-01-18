@<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-family: 'Lato';
        }
    </style>

</head>
<body>
<div class="container">
    <div class="content" id="app">
        @{{ showAlert }}
        <div class="title">Laravel 5</div>

        <alert type="success">Your account has been updated!</alert>
        <div v-show="showAlert">
            Hello!
            <alert v-show="showAlert">Your account has been updated!</alert>

        </div>

        <alert type="error">Your account has not been updated!</alert>
    </div>
</div>

<script src="/js/main.js"></script>
</body>
</html>




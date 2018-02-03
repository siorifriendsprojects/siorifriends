<!doctype html>
<html lang="ja">
<head>
    <title>Redirect...</title>
    <script>
        localStorage.setItem("token","{{Auth::user()->localToken()->token}}");
        location.href = "/";
    </script>
</head>
<body>

</body>
</html>

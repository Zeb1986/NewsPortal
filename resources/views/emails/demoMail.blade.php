<!DOCTYPE html>
<html>
<head>
    <title>Viache News</title>
</head>
<body>
<h1>{{ $mailData['title'] }}</h1>
<p>{{ $mailData['body'] }}</p>
<a href="http://127.0.0.1:8000/posts/{{$mailData['slug']}}">Read More</a>

<p>Thank you</p>
</body>
</html>

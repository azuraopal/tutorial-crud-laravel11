<!-- resources/views/certificate/preview.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Preview</title>
</head>

<body>
    <p>File URL: {{ $fileUrl }}</p> <!-- Debug URL -->
    <div style="width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center;">
        <iframe src="{{ $fileUrl }}" width="100%" height="100%" frameborder="0"></iframe>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title><?php
            echo isset($this->viewBag['title']) ? $this->viewBag['title'] : "Title";
            ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <style>
        <?php include './css/style.css'; ?>
    </style>
</head>

<body>
    <?php include 'application/views/' . $content_view; ?>
</body>

</html>
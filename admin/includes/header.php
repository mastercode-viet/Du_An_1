<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Quản trị viên</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* CSS chung cho tất cả các trang */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }
        .container-fluid {
            margin-top: 30px;
        }
        .row {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h2 {
            color: #fff;
            font-size: 22px;
            margin-bottom: 30px;
            text-align: center;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
          margin-left: 250px; /* Đảm bảo không bị che khuất bởi sidebar */
    padding: 20px;
    flex-grow: 1; /* Làm cho nội dung chính chiếm phần còn lại */
    overflow-y: auto; /* Cho phép cuộn nếu nội dung vượt quá chiều cao */
    min-height: 100vh; /* Đảm bảo phần nội dung chiếm ít nhất 100% chiều cao */
    box-sizing: border-box; 
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

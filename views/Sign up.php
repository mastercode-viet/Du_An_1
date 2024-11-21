<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Class for Multiple Buttons</title>
    <style>
        .btn-selected {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>

    <button class="myButton">Button 1</button>
    <button class="myButton">Button 2</button>
    <button class="myButton">Button 3</button>

    <script>
        // Lấy tất cả các phần tử button với class là 'myButton'
        const buttons = document.querySelectorAll('.myButton');

        // Lặp qua tất cả các button và thêm sự kiện click
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Toggle class btn-selected khi nhấn vào button
                button.classList.toggle('btn-selected');
            });
        });
    </script>

</body>

</html>
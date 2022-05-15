<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Custom Radio Buttons | CodingNepal</title>
    <link rel="stylesheet" href="include/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
   
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>
    <!-- You need focus-trap.js to make the modal accessible -->
    <script src="./assets/js/focus-trap.js" defer></script>

</head>

<body>
    <div class="wrapper">
        <div class="box">
            <input type="radio" name="select" id="option-1">
            <label for="option-1" class="option-1">
                <div class="dot"></div>
                <div class="text">Gamer</div>
            </label>
        </div>
        <div class="flex justify-center mt-6">
            <button type="submit" class="px-4 py-2 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                Send Message
            </button>
        </div>
</br>

    </div>

</body>

</html>
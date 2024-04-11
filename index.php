<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Калькулятор вклада</title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link href="styles.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="script.js"></script>
  </style>
</head>

<body class="flex flex-col min-h-screen bg-white text-white width-1024 align-center">
  <header class="bg-white text-orange py-4 mx-2 flex justify-between items-center">
    <div>
      <img src="images/layer_2.png" alt="Logo" class="h-20">
    </div>
    <div class="font-family-europe">
      <p>
        <a class="text-xl" href="tel:+78001005005">8-800-100-5005</a>
      </p>
      <p>
        <a class="text-xl" href="tel:+73452522000">+7 (3452) 522-000</a>
      </p>
    </div>
  </header>
  <nav class="bg-black text-center text-white flex justify-center mx-2">
    <!-- <li class="border-right border-orange"><a href="#" class="hover:text-orange-500 border-right border-orange">Кредитные карты</a></li> -->
    <div class="border-right border-orange py-4 px-8 hover-orange">
      <a href="#">Кредитные карты</a>
    </div>
    <div class="border-right border-orange py-4 px-8 bg-orange">
      <a href="#">Вклады</a>
    </div>
    <div class="border-right border-orange py-4 px-8 hover-orange">
      <a href="#">Дебетовая карта</a>
    </div>
    <div class="border-right border-orange py-4 px-8 hover-orange">
      <a href="#">Страхование</a>
    </div>
    <div class="border-right border-orange py-4 px-8 hover-orange">
      <a href="#">Друзья</a>
    </div>
    <div class="py-4 px-6 hover-orange">
      <a href="#">Интернет-банк</a>
    </div>
  </nav>
  <div class="py-4 mx-2 text-black">
    <a href="#" class="text-black underline">Главная</a> - <a href="#" class="text-black underline">Вклады</a> - <span class="text-black underline">Калькулятор</span>
  </div>
  <main class="flex-grow container mx-auto py-8 px-2">
    <div class="bg-gray px-6 py-6">
      <h1 class="text-orange mx-24 mb-8">Калькулятор</h1>
      <form id="calc" action="calc.php" class="form">
        <div class="mb-2 form-control">
          <label for="depoDate" class="text-black mr-6 form-label">Дата оформления вклада</label>
          <input type="text" id="depoDate" name="depoDate" class="text-black p-1 form-field" required>
        </div>
        <div class="mb-2 form-control">
          <label for="depoSum" class="text-black mr-6 form-label">Сумма вклада</label>
          <input type="number" min="10000" name="depoSum" id="depoSum" step="500" class="text-black p-1 form-field"
            value="10000" onchange="depoChanged()" />
          <div class="slider" id="depoSumSlider"></div>
          <div class="text-black depoMin">1 тыс. руб.</div>
          <div class="text-black depoMax">3 000 000</div>
        </div>
        <div class="mb-2 form-control">
          <label for="depoTerm" class="text-black mr-6 form-label">Срок вклада</label>
          <select type="number" name="depoTerm" id="depoTerm" class="text-black p-1 form-field">
            <option value="1">1 год</option>
            <option value="2">2 год</option>
            <option value="3">3 год</option>
            <option value="4">4 год</option>
            <option value="5">5 год</option>
          </select>
        </div>
        <div class="mb-2 form-control">
          <label for="depoAddition" class="text-black mr-6 form-label">Пополнение вклада</label>
          <fieldset class="form-field" name="depoAddition">
            <span class="mr-4" style="float: left;">
              <input type="radio" name="depoAddition" class="text-black p-1" value="no" checked>
              <label for="depoAdditionNo" class="text-black">Нет</label>
            </span>
            <span style="float: left;">
              <input type="radio" name="depoAddition" class="text-black p-1" value="yes">
              <label for="depoAdditionYes" class="text-black">Да</label>
            </span>
          </fieldset>
        </div>
        <div class="mb-2 form-control">
          <label for="depoAdditionSum" class="text-black mr-6 form-label">Сумма пополнения вклада</label>
          <input type="number" min="10000" name="depoAdditionSum" id="depoAdditionSum" step="500"
            class="text-black p-1 form-field" value="10000" onchange="depoChanged()" />
          <div class="slider" id="depoAdditionSumSlider"></div>
          <div class="text-black depoMin">1 тыс. руб.</div>
          <div class="text-black depoMax">3 000 000</div>
        </div>
        <div id="cool-block">
          <input type="submit" value="Рассчитать" id="cool-button" class="mr-6">
          <span class="text-green text-bold mr-2">Результат: </span>
          <span class="text-black" id="calcResult">0 руб</span>
        </div>
        <script>
          $("#calc").submit(function (event) {
            event.preventDefault();
            console.log($('#depoTerm').val());
            $.post('calc.php', {
                'depoDate': $('#depoDate').datepicker("getDate"),
                'depoTerm': $('#depoTerm').val(),
                'depoSum': $('#depoSum').val(),
                'depoAddition': $("input[type='radio'][name='depoAddition']:checked").val(),
                'depoAdditionSum': $('#depoAdditionSum').val()
              },
              function (data) {
                console.log(data);
                document.getElementById('calcResult').innerHTML = data + " руб";
              }
            );
          });
        </script>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="mx-2 bg-black text-white pb-8 pt-5 px-6">
    <ul class="flex justify-center">
      <li><a href="#" class="mr-6 underline">Кредитные карты</a></li>
      <li><a href="#" class="mr-6 underline">Вклады</a></li>
      <li><a href="#" class="mr-6 underline">Дебетовая карта</a></li>
      <li><a href="#" class="mr-6 underline">Страхование</a></li>
      <li><a href="#" class="mr-6 underline">Друзья</a></li>
      <li><a href="#" class="mr-6 underline">Интернет-банк</a></li>
    </ul>
  </footer>
</body>

</html>
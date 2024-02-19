<?php 
include_once("../components/head.php");
?>
<div class="w-full min-h-screen bg-gray-50 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
  <div class="w-full sm:max-w-md p-5 mx-auto">
    <h2 class="mb-12 text-center text-5xl font-extrabold">Приветствуем.</h2>
    <form id="register">
      <div class="mb-4">
        <label class="block mb-1" for="text">Логин</label>
        <input id="text" type="text" name="login" class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
      </div>
      <div class="mb-4">
        <label class="block mb-1" for="text">Имя</label>
        <input id="text" type="text" name="name" class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
      </div>
      <div class="mb-4">
        <label class="block mb-1" for="text">Фамилия</label>
        <input id="text" type="text" name="surname" class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
      </div>
      <div class="mb-4">
        <label class="block mb-1" for="email">Почта</label>
        <input id="email" type="text" name="email" class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
      </div>
      <div class="mb-4">
        <label class="block mb-1" for="password">Пароль</label>
        <input id="password" type="password" name="password" class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
      </div>
      <div class="mb-4">
        <label class="block mb-1" for="password">Подтвердите пароль</label>
        <input id="password" type="password" name="confirm_password" class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
      </div>
      <div class="mt-6 flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember_me" type="checkbox" class="border border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" />
          <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900"> Соглашаюсь с политикой конфиденциальности </label>
        </div>
      </div>
      <div class="mt-6">
        <button class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold capitalize text-white hover:bg-red-700 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 transition">Зарегистрироваться</button>
      </div>
      <p class="sign-up-successful d-none" id="successfulBlock"></p>
      <p class="sign-up-error d-none" id="errorBlock"></p>
      <div class="mt-6 text-center">
        <a href="login.php" class="underline">У вас есть аккаунт?</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
<script>
register.onsubmit = async (e) => {
      //отменяю перезагрузку страницы при отправке
      e.preventDefault();

      //отравляю запрос в signupUser.php в папке contollers
      let response = await fetch('../controller/register.php',{
          method: 'POST',
          body: new FormData(register)
      });

      let result = await response.text();

      if (response.status === 200) {
          errorBlock.classList.add('d-none');
          successfulBlock.classList.remove('d-none');
          successfulBlock.innerHTML = result;
      }
      if(response.status === 400) {
          successfulBlock.classList.add('d-none');
          errorBlock.classList.remove('d-none');
          errorBlock.innerHTML = result;
      }
  }
</script>
<script>
$(document).ready(function(){
    // Обработка клика на ссылке "У вас нет аккаунта?" на странице входа
    $("a[href='register.php']").click(function(e){
        e.preventDefault(); // Предотвращаем переход по ссылке по умолчанию
        $.ajax({
            url: $(this).attr("href"),
            success: function(response){
                $("body").html(response); // Заменяем содержимое текущей страницы содержимым страницы регистрации
                document.title = "Регистрация"; // Обновляем заголовок страницы
            }
        });
    });

    // Обработка клика на ссылке "У вас есть аккаунт?" на странице регистрации
    $("a[href='login.php']").click(function(e){
        e.preventDefault(); // Предотвращаем переход по ссылке по умолчанию
        $.ajax({
            url: $(this).attr("href"),
            success: function(response){
                $("body").html(response); // Заменяем содержимое текущей страницы содержимым страницы входа
                document.title = "Вход"; // Обновляем заголовок страницы
            }
        });
    });
});
</script>



<?php 
include_once("../components/head.php");
include_once("../components/header.php");
?>
<div class="w-full min-h-screen bg-gray-50 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
  <div class="w-full sm:max-w-md p-5 mx-auto">
    <h2 class="mb-12 text-center text-5xl font-extrabold">Работодателю.</h2>
    <form id="employerRegister">
      <div class="mb-4">
        <label class="block mb-1" for="email">Логин</label>
        <input id="email" type="text" name="login" class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
      </div>
      <div class="mb-4">
        <label class="block mb-1" for="email">Почта</label>
        <input id="email" type="text" name="email" class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
      </div>
      <div class="mb-4">
        <label class="block mb-1" for="email">Название организации</label>
        <input id="email" type="text" name="name" class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
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
        <a href="#" class="text-sm"> Забыли пароль? </a>
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
<script>
employerRegister.onsubmit = async (e) => {
      //отменяю перезагрузку страницы при отправке
      e.preventDefault();

      //отравляю запрос в signupUser.php в папке contollers
      let response = await fetch('../controller/employerRegister.php',{
          method: 'POST',
          body: new FormData(employerRegister)
      });

      let result = await response.text();

      if (response.status === 200) {
          errorBlock.classList.add('d-none');
          successfulBlock.classList.remove('d-none');
          successfulBlock.innerHTML = result;
          window.location.href = "login.php";
      }
      if(response.status === 400) {
          successfulBlock.classList.add('d-none');
          errorBlock.classList.remove('d-none');
          errorBlock.innerHTML = result;
      }
  }
</script>
<?php 
include_once("../components/head.php");
include_once("../components/header.php");
?>
 <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-8">Добавить вакансию</h1>
        <form id="addVacancy" class="mx-auto grid grid-cols-2 gap-4">
        <input type="hidden" name="id_employer" value="<?= $emprofile['id'] ?>">
            <div>
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Название вакансии</label>
                    <input type="text" id="title" name="name" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-500" placeholder="Введите название вакансии">
                </div>
                <div class="mb-4">
                    <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">Зарплата</label>
                    <input type="text" id="salary" name="price" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-500" placeholder="Введите зарплату">
                </div>
                <div class="mb-4">
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Компания</label>
                    <input type="text" id="company" name="company" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-500" placeholder="<?= $emprofile['name'] ?>" disabled>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Город</label>
                    <input type="text" id="city" name="city" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-500" placeholder="Введите город">
                </div>
                <div class="mb-4">
                    <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Требуемый опыт работы</label>
                    <select id="experience" name="stage" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:border-blue-500">
                        <option value="Нет опыта">Нет опыта</option>
                        <option value="От 1 до 3 лет">От 1 до 3 лет</option>
                        <option value="От 3 до 6 лет">От 3 до 6 лет</option>
                        <option value="От 6 лет и больше">От 6 лет и больше</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Текст о вакансии</label>
                    <textarea id="description" name="info" class="border border-gray-300 rounded-md py-2 px-3 w-full h-32 focus:outline-none focus:border-blue-500" placeholder="Введите текст о вакансии"></textarea>
                </div>
            </div>
            <button type="submit" class="col-span-2 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Добавить вакансию</button>
            <p class="sign-up-successful d-none" id="successfulBlock"></p>
            <p class="sign-up-error d-none" id="errorBlock"></p>
        </form>
    </div>
<script>
addVacancy.onsubmit = async (e) => {
      //отменяю перезагрузку страницы при отправке
      e.preventDefault();

      //отравляю запрос в signupUser.php в папке contollers
      let response = await fetch('../controller/addVacancy.php',{
          method: 'POST',
          body: new FormData(addVacancy)
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
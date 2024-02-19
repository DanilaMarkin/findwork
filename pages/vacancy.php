<?php 
include_once("../components/head.php");
include_once("../components/header.php");
include_once("../models/guest.php");

$vacancy = getVacancy();
?>
 <div class="container mx-auto px-4 py-8">
 <div class="mb-4">
            <input type="text" class="w-full py-2 px-4 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Поиск по вакансиям...">
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <!-- Боковая панель -->
            <div class="col-span-1">
                <div class="bg-white rounded-md p-4 shadow-md">
                    <h2 class="text-lg font-semibold mb-4">Фильтры</h2>
                    <!-- Ваши фильтры здесь -->
                    <form>
                        <!-- Пример фильтра по городу -->
                        <div class="mb-4">
                            <label class="block mb-2" for="city">Город</label>
                            <select id="city" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                                <option value="">Все города</option>
                                <option value="moscow">Москва</option>
                                <option value="stpetersburg">Санкт-Петербург</option>
                                <!-- Добавьте остальные города по мере необходимости -->
                            </select>
                        </div>
                        <!-- Добавьте другие фильтры по аналогии -->
                        <button class="bg-blue-500 text-white py-2 px-4 rounded-md w-full">Применить фильтры</button>
                    </form>
                </div>
            </div>
            <!-- Карточки с вакансиями -->
            <div class="col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Пример карточки с вакансией -->
                    <div class="bg-white rounded-md p-4 shadow-md relative">
                        <h3 class="text-lg font-semibold mb-2">Название вакансии</h3>
                        <p class="text-gray-600 mb-2">Зарплата: $3000-$4000</p>
                        <p class="text-gray-600 mb-2">Компания: ООО "Название компании"</p>
                        <p class="text-gray-600 mb-2">Город: Москва</p>
                        <p class="text-gray-600 mb-4">Требуемый опыт работы: от 2 до 5 лет</p>
                        <a href="#" class="bg-green-500 text-white py-2 px-4 rounded-md inline-block">Откликнуться</a>
                        <button class="absolute top-2 right-2 text-gray-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18l-2-2m0 0l-2-2m2 2l2-2m0 0l2-2m-2 2l-2 2m0 0l-2 2"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Повторите блок выше для каждой вакансии -->
                </div>
            </div>
        </div>
    </div>
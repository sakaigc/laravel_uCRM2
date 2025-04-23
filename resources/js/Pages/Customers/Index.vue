<!-- resources/js/Pages/Customers/Index.vue -->
<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({ customers: Object });
const page = usePage();

const search = ref('');
const searchCustomers = () => {
  Inertia.get(route('customers.index'), { search: search.value }, { preserveState: true });
};
</script>

<template>
  <Head title="顧客一覧" />

  <!-- ヘッダー -->
  <div class="py-6 px-4 sm:px-6 lg:px-8 bg-white shadow mb-4">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">👥 顧客一覧</h2>
  </div>

  <!-- 本文 -->
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <section class="text-gray-600 body-font">
          <div class="container px-5 py-8 mx-auto">
            <FlashMessage />

            <!-- このdivに幅を指定して中央寄せ -->
            <div class="lg:w-2/3 w-full mx-auto mb-4">
            <div class="flex flex-wrap items-center gap-2">
                <!-- 検索フォーム -->
                <input
                v-model="search"
                type="text"
                placeholder="名前・電話番号で検索"
                class="border-gray-300 rounded-md shadow-sm w-72"
                />

                <!-- 検索ボタン -->
                <button
                @click="searchCustomers"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                🔍 検索
                </button>

                <!-- 顧客登録ボタン -->
                <Link
                :href="route('customers.create')"
                class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600"
                >
                ➕ 顧客登録
                </Link>
            </div>
            </div>



            <!-- 顧客テーブル -->
            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
              <table class="table-auto w-full text-left whitespace-no-wrap">
                <thead>
                  <tr>
                    <th class="px-4 py-3 bg-gray-100">ID</th>
                    <th class="px-4 py-3 bg-gray-100">名前</th>
                    <th class="px-4 py-3 bg-gray-100">カナ</th>
                    <th class="px-4 py-3 bg-gray-100">電話番号</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="customer in props.customers.data" :key="customer.id">
                    <td class="border-t px-4 py-2">{{ customer.id }}</td>
                    <td class="border-t px-4 py-2">{{ customer.name }}</td>
                    <td class="border-t px-4 py-2">{{ customer.kana }}</td>
                    <td class="border-t px-4 py-2">{{ customer.tel }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- ページネーション -->
            <div class="flex justify-center mt-6">
              <Pagination :links="props.customers.links" />
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

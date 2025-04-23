<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3'
import FlashMessage from '@/Components/FlashMessage.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({ items: Array })
const page = usePage()

// layout 指定（このままでOK）
defineOptions({
  layout: AuthenticatedLayout,
})
</script>

<template>
  <Head title="商品一覧" />

  <!-- スロットではなく、h2をページ内に普通に表示 -->
  <div class="py-6 px-4 sm:px-6 lg:px-8 bg-white shadow mb-4">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">🔒 商品一覧</h2>
  </div>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <section class="text-gray-600 body-font">
          <div class="container px-5 py-8 mx-auto">
            <FlashMessage />

            <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
              <Link
                as="button"
                :href="route('items.create')"
                class="ml-auto text-white bg-indigo-500 border-0 py-2 px-6 rounded hover:bg-indigo-600"
              >
                商品登録
              </Link>
            </div>

            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
              <table class="table-auto w-full text-left whitespace-no-wrap">
                <thead>
                  <tr>
                    <th class="px-4 py-3 bg-gray-100">ID</th>
                    <th class="px-4 py-3 bg-gray-100">商品名</th>
                    <th class="px-4 py-3 bg-gray-100">価格</th>
                    <th class="px-4 py-3 bg-gray-100">ステータス</th>
                    <th class="px-4 py-3 bg-gray-100"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in items" :key="item.id">
                    <td class="border-t-2 px-4 py-3">
                      <Link class="text-blue-500" :href="route('items.show', { item: item.id })">
                        {{ item.id }}
                      </Link>
                    </td>
                    <td class="border-t-2 px-4 py-3">{{ item.name }}</td>
                    <td class="border-t-2 px-4 py-3">¥{{ item.price.toLocaleString() }}</td>
                    <td class="border-t-2 px-4 py-3">
                      {{ item.is_selling ? '販売中' : '停止中' }}
                    </td>
                    <td class="border-t-2 px-4 py-3"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

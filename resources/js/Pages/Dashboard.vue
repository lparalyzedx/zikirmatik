<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
defineProps({
  data:Array
});
</script>

<template>
  <Head title="Anasayfa" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Anasayfa
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
          <div class="flex flex-wrap mb-2">
            <div class="w-full md:w-1/2 xl:w-1/3 pt-3 px-3 md:pr-2">
              <div class="bg-white py-6 border rounded shadow-lg p-2">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pl-1 pr-4">
                    <i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i>
                  </div>
                  <div class="flex-1 text-left">
                    <h5 class="text-black">Kategoriler</h5>
                    <h3 class="text-black text-3xl">
                      {{data.categorie}}<span class="text-green-400"
                        ><i class="fas fa-caret-down"></i
                      ></span>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 pt-3 px-3 md:pl-2">
              <div class="bg-white border py-6 rounded shadow-lg p-2">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pl-1 pr-4">
                    <i class="fas fa-users fa-2x fa-fw fa-inverse"></i>
                  </div>
                  <div class="flex-1 text-left">
                    <h5 class="text-black">Dualar</h5>
                    <h3 class="text-black text-3xl">
                     {{data.pray}}
                      <span class="text-blue-400"
                        ><i class="fas fa-caret-up"></i
                      ></span>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="w-full md:w-1/2 xl:w-1/3 pt-3 px-3 md:pr-2 xl:pr-3 xl:pl-1"
            >
              <div class="bg-white border py-6 rounded shadow-lg p-2">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pl-1 pr-4">
                    <i class="fas fa-user-plus fa-2x fa-fw fa-inverse"></i>
                  </div>
                  <div class="flex-1 text-left pr-1">
                    <h5 class="text-black">Zikirler</h5>
                    <h3 class="text-black text-3xl">
                     {{data.chant}}
                      <span class="text-orange-400"
                        ><i class="fas fa-caret-up"></i
                      ></span>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="w-full md:w-1/2 xl:w-1/3 pt-3 px-3 md:pl-2 xl:pl-3 xl:pr-2"
            >
              <div class="bg-white border py-6 rounded shadow-lg p-2">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pl-1 pr-4">
                    <i class="fas fa-server fa-2x fa-fw fa-inverse"></i>
                  </div>
                  <div class="flex-1 text-left">
                    <h5 class="text-black">Günlük d.</h5>
                    <h3 class="text-black text-3xl">{{data.daily}}</h3>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="w-full md:w-1/2 xl:w-1/3 pt-3 px-3 md:pr-2 xl:pl-2 xl:pr-3"
            >
              <div class="bg-white border py-6 rounded shadow-lg p-2">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pl-1 pr-4">
                    <i class="fas fa-tasks fa-2x fa-fw fa-inverse"></i>
                  </div>
                  <div class="flex-1 text-left">
                    <h5 class="text-black">Kullanıcılar</h5>
                    <h3 class="text-black text-3xl">{{data.user}}</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 pt-3 px-3 md:pl-2 xl:pl-1">
              <div class="bg-white border py-6 rounded shadow-lg p-2">
                <div class="flex flex-row items-center">
                  <div class="flex-shrink pl-1 pr-4">
                    <i class="fas fa-inbox fa-2x fa-fw fa-inverse"></i>
                  </div>
                  <div class="flex-1 text-left">
                    <h5 class="text-black">Destek</h5>
                    <h3 class="text-black text-3xl">
                      0
                      <span class="text-pink-400"
                        ><i class="fas fa-caret-up"></i
                      ></span>
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
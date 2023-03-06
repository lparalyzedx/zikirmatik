<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import { useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
const confirmingDeletion = ref(false);


const props = defineProps({
  dailies: Array,
  target: String
});

const form = useForm({
  id: "",
});

const search = ref(props.target);

const confirmDeletion = (event) => {
  form.id = event;
  confirmingDeletion.value = true;
};

const closeModal = () => {
  confirmingDeletion.value = false;
};

const deleteDaily = () => {
  form.delete(route("gunluk.destroy", form.id), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
  });
};


watch(search, (newVal, oldVal) => {
  router.get(
    route("gunluk.index"),
    { search: newVal },
    {
      preserveState: true,
    }
  );
});

</script>

<template>
  <Head title="Günlük Dualar" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Günlük Dualar
      </h2>
    </template>
    <Modal :show="confirmingDeletion" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
          Günlük dua'yı silmek istediğinizden emin misiniz?
        </h2>

        <p class="mt-1 text-sm text-gray-600">
          Dua silindikten sonra, sadece günlük dualardan kalıcı olarak
          silinir. Dua'yi kalıcı olarak silmek istediğinizi onaylamak için
          lütfen sil butonuna tıklayın.
        </p>
        <div class="mt-6 flex items-center justify-end">
          <SecondaryButton @click="closeModal" class="cursor-pointer"> İptal </SecondaryButton>

          <DangerButton class="ml-3" @click="deleteDaily">
            Sil
          </DangerButton>
        </div>
      </div>
    </Modal>

    <div class="py-12">
      <div class="w-full h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="flex flex-col mx-2">
            <div class="-mb-2 py-4 flex flex-wrap flex-grow justify-between">
              <div class="flex items-center py-2">
                <input
                  class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                  v-model="search"
                  id="inline-searcg"
                  type="text"
                  placeholder="Ara.."
                />
              </div>
              <div class="flex items-center py-2">
                <Link
                  :href="route('gunluk.create')"
                  class="inline-block px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline"
                >
                  Günlük dua ekle
                </Link>
              </div>
            </div>
            <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
              <div
                class="align-middle inline-block w-full shadow overflow-x-auto sm:rounded-lg border-b border-gray-200"
              >
                <table class="min-w-full">
                  <thead>
                    <tr
                      class="border-b border-gray-200 bg-white leading-4 tracking-wider text-base text-gray-900"
                    ></tr>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs leading-4 text-gray-500 uppercase tracking-wider">
                      <th class="px-6 py-3 text-left font-medium">#</th>
                      <th class="px-6 py-3 text-left font-medium">
                        Dua adı
                      </th>
                      <th class="px-6 py-3 text-left font-medium">Durum</th>
                      <th class="px-6 py-3 text-left font-medium">
                       Tarih
                      </th>
                      <th class="px-6 py-3 text-left font-medium">işlemler</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white">
                    <tr
                      v-for="(daily, index) in dailies.data"
                      :key="index"
                    >
                      <td
                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                      >
                        <div class="text-sm leading-5 text-gray-900">
                          {{ index+1 }}
                        </div>
                      </td>
                      <td
                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                      >
                        <div class="flex items-center">
                          <div class="flex-shrink-0 h-10 w-50">
                            {{ daily.pray.name.length > 20 ? daily.pray.name.substr(0,20) + '...' : daily.pray.name }}
                          </div>
                          <div class="ml-4">
                            <div
                              class="text-sm leading-5 font-medium text-gray-900"
                            ></div>
                          </div>
                        </div>
                      </td>
                      <td
                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                      >
                         <div class="flex items-center">
                      <div class="h-2.5 w-2.5 rounded-full mr-2" :class="{'bg-green-500': daily.status,'bg-red-500': !daily.status}"></div>
                      <p class=" text-sm">{{ daily.status ? 'Aktif' : 'Pasif' }}</p>
                    </div>
                      </td>
                      <td
                        class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500"
                      >
                        {{ daily.translated_at }}
                      </td>
                      <td
                        class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium"
                      >
                        <Link
                          :href="route('gunluk.edit', daily.id)"
                          class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline"
                        >
                          Düzenle
                        </Link>
                        <button
                          @click="confirmDeletion(daily.id)"
                          class="text-red-600 hover:text-red-900 focus:outline-none focus:underline ml-3"
                        >
                          Sil
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

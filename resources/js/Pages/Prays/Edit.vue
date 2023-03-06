<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
  pray: Array,
  categories: Array,
});

const form = useForm({
  id : props.pray.data.id,
  name: props.pray.data.name,
  description : props.pray.data.description,
  categorie_id : props.pray.data.categorie.id,
  status: props.pray.data.status ? 1 : 0
});

onMounted(() =>{
   $('.select').on('change', () => {
     form.categorie_id = $('.select').val();
    });
});

const submit = () => {
  form.put(route("dualar.update",form.id));
};
</script>

<template>
  <Head title="Dualar" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dualar</h2>
    </template>
    <div class="py-12">
      <div
        class="max-w-5xl mx-2 md:mx-auto sm:px-6 lg:px-8 bg-white rounded-md px-4"
      >
        <form @submit.prevent="submit" class="py-6">
          <div class="mb-3">
            <InputLabel for="name" value="Dua adı" />
            <TextInput
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
            />
            <InputError  :message="form.errors.name" />
          </div>

          <div class="mb-3">
            <InputLabel for="description" value="Dua" />
            <textarea cols="20" rows="10"
              id="description"
              type="text"
              class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
              v-model="form.description"
            ></textarea>
            <InputError :message="form.errors.description" />
          </div>

          <div class="mb-2">
            <InputLabel for="categorie_id" value="Kategori" class="mt-2 mb-1" />
            <select
              v-model="form.categorie_id"
              class="select"
              id=""
            >
              <option
                v-for="categorie in categories.data"
                :key="categorie.id"
                :value="categorie.id"
                :selected="categorie.id == form.categorie_id"
              >
                {{ categorie.name }}
              </option>
            </select>
            <InputError :message="form.errors.categorie_id" />
          </div>

          <div class="mb-2">
            <InputLabel for="name" value="Durum" class="mt-2" />
                <select v-model="form.status" class="mt-1 block w-full rounded-md border border-gray-300" id="">
                    <option value="1" :selected="form.status">Aktif</option>
                    <option value="0" :selected="!form.status">Pasif</option>
                </select>
                <InputError :message="form.errors.status" />
          </div>

          <div class="mt-4 flex justify-end">
            <Link
            :href="route('dualar.index')"
              class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-200 focus:bg-gray-200 active:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4 cursor-pointer"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Vazgeç
            </Link>
            <PrimaryButton
              class="ml-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Güncelle
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

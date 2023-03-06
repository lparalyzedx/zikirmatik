<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

defineProps({
  categories: Array,
});

const form = useForm({
  name: "",
  description : "",
  categorie_id : "",
});

onMounted(() =>{
   $('.select').on('change', () => {
     form.categorie_id = $('.select').val();
    });
});

const submit = () => {
  form.post(route("dualar.store"));
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
        v-if="categories.data.length > 0"
        class="max-w-5xl mx-2 md:mx-auto sm:px-6 lg:px-8 bg-white rounded-md px-4"
      >
        <form @submit.prevent="submit" class="py-6">
          <div>
            <InputLabel for="name" value="Dua adı" />
            <TextInput
              id="name"
              type="text"
              class="mt-1 mb-3 block w-full"
              v-model="form.name"
            />
            <InputError class="mt-2" :message="form.errors.name" />
          </div>

          <div>
            <InputLabel for="description" value="Dua" />
            <textarea
             cols="20" rows="10"
              id="description"
              type="text"
              class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 mb-3 block w-full"
              v-model="form.description"
            ></textarea>
            <InputError class="mt-2" :message="form.errors.description" />
          </div>

          <div>
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
              >
                {{ categorie.name }}
              </option>
            </select>
            <InputError class="mt-2" :message="form.errors.categorie_id" />
          </div>

          <div class="mt-4 flex justify-end">
            <PrimaryButton
              class="ml-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Ekle
            </PrimaryButton>
          </div>
        </form>
      </div>
      <div
        v-else
        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-5xl mx-auto sm:px-6 lg:px-8 my-2"
        role="alert"
      >
        <strong class="font-bold">Lütfen Kategori oluşturun!</strong>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3"> </span>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

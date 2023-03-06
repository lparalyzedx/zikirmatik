<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
const props = defineProps({
  chant:Array
});

 const form = useForm({
    id: props.chant.data.id,
    name: props.chant.data.name,
    status: props.chant.data.status ? 1 : 0,
  });


  const submit= () =>{
   form.put(route('zikirler.update',form.id));
  }
</script>

<template>
  <Head title="Zikirler" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Zikirler
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-5xl mx-2 md:mx-auto sm:px-6 lg:px-8 bg-white rounded-md px-4">
        <form
          @submit.prevent="submit"
          class="py-6"
        >
          <div>
            <InputLabel for="name" value="Zikir" />
            <TextInput
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
            />
            <InputError class="mt-2" :message="form.errors.name" />
          </div>

          <div>
            <InputLabel for="name" value="Durum" class="mt-2" />
                <select v-model="form.status" class="mt-1 block w-full rounded-md border border-gray-300" id="">
                    <option value="1" :selected="form.status">Aktif</option>
                    <option value="0" :selected="!form.status">Pasif</option>
                </select>
                <InputError class="mt-2" :message="form.errors.parent_id" />
          </div>

          <div class="mt-4 flex justify-end">
            <Link
            :href="route('zikirler.index')"
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

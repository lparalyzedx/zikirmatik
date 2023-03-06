<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const form = useForm({
  pray_id: "",
  date: "",
});

onMounted(() => {
  $(".select").on("change", () => {
    form.pray_id = $(".select").val();
  });
});

const submit = () => {
  form.post(route("gunluk.store"));
};

defineProps({
  prays: Array,
});
</script>

<template>
  <Head title="Kategoriler" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Günlük Dualar
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-5xl mx-2 md:mx-auto sm:px-6 lg:px-8 bg-white rounded-md px-4">
        <form @submit.prevent="submit" class="py-6">
          <div>
            <InputLabel for="pray" value="Dua" class="mt-2 mb-1" />
            <select v-model="form.pray_id" class="select" id="pray">
              <option
                v-for="pray in prays.data"
                :key="pray.id"
                :value="pray.id"
              >
                {{ pray.name }}
              </option>
            </select>
            <InputError class="mt-2" :message="form.errors.pray_id" />
          </div>

          <div>
            <InputLabel for="date" value="Tarih" class="mt-3" />
            <TextInput
              id="date"
              type="date"
              class="mt-1 block w-full"
              v-model="form.date"
            />
            <InputError class="mt-2" :message="form.errors.date" />
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
    </div>
  </AuthenticatedLayout>
</template>

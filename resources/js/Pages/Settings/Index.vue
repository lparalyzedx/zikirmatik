<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
  setting: Array,
});

const form = useForm({
  version: props.setting.version,
  ramadan: props.setting.ramadan,
  care: props.setting.care
});

const selectOption = (selectedOption) =>{
if (selectedOption === 1) {
        form.care = false;
      } else if (selectedOption === 2) {
        form.ramadan = false;
      }
}

const submit = () => {
  form.put(route("ayarlar.update",1));
};

</script>

<template>
  <Head title="Ayarlar" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ayarlar</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mx-2">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <section>
            <header>
              <h2 class="text-lg font-medium text-gray-900">
                Uygulama ayarları
              </h2>

              <p class="mt-1 text-sm text-gray-600">
                Uygulamanın bilgilerini ve sürümünü güncelleyin.
              </p>
            </header>

            <form @submit.prevent="submit" class="mt-6 space-y-6">
              <div>
                <InputLabel for="verison" value="Sürüm" />

                <TextInput
                  id="version"
                  v-model="form.version"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autofocus
                />
                <InputError class="mt-2" :message="form.errors.version" />
              </div>
              <div>
                <div class="divide-y">
                  <div class="flex items-start space-x-3 py-6">
                    <input
                      type="checkbox"
                      name="ramadan"
                      v-model="form.ramadan"
                      class="border-gray-300 rounded h-5 w-5"
                       @change="selectOption(1)"
                    />

                    <div class="flex flex-col">
                      <h1 class="text-gray-700 font-medium leading-none">
                        Ramazan modu
                      </h1>
                      <p class="text-xs text-gray-500 mt-2 leading-4">
                       Form öğelerinin yardımcı programlarla geçersiz kılınmasını kolaylaştıran form stilleri için temel bir sıfırlama sağlayan bir eklenti.
                      </p>
                    </div>
                  </div>

                  <div class="flex items-start space-x-3 py-6">
                    <input
                      v-model="form.care"
                      type="checkbox"
                      name="care"
                      class="border-gray-300 rounded h-5 w-5"
                      @change="selectOption(2)"
                    />

                    <div class="flex flex-col">
                      <h1 class="text-gray-700 font-medium leading-none">
                        Bakımda modu
                      </h1>
                      <p class="text-xs text-gray-500 mt-2 leading-4">
                        Uygulama bakım modu, uygulama temasının veya kurgusunun değiştirildiği özel durumlarda kullanılan ve ziyaretçiyi bakım yapıldığına dair özel bir mesajla karşılayan bir özelliktir.
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing"
                  >Kaydet</PrimaryButton
                >

                <Transition
                  enter-from-class="opacity-0"
                  leave-to-class="opacity-0"
                  class="transition ease-in-out"
                >
                  <p
                    v-if="form.recentlySuccessful"
                    class="text-sm text-gray-600"
                  >
                    Kaydedildi.
                  </p>
                </Transition>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

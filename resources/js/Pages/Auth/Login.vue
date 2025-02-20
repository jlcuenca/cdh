<template>
    <Head title="Academia de la Comisión de Derechos Humanos del Estado de Morelos" />

    <section class="min-h-screen flex items-stretch text-white ">
            <div class="lg:flex w-1/2 hidden bg-gray-200 bg-no-repeat bg-cover relative items-center" style="background-image: url(/images/background.png);">
                <div class="absolute bg-black opacity-50 inset-0 z-0"></div>
                <div class="w-full px-24 z-10">
                    <h1 class="text-5xl font-bold text-left tracking-wide uppercase">
                        Academia de la comisión de derechos humanos del estado de morelos
                    </h1>
                    <!--<p class="text-xl my-4 uppercase">PARA TODOS LOS MORELENSES</p>-->
                </div>
                <div class="bottom-0 absolute p-4 text-center right-0 left-0 flex justify-center space-x-4">
                </div>
            </div>
            <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0 text-gray-800" style="background-color: #fff;">
                <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center" style="background-image: url(/images/background.png);">
                    <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
                </div>
                <div class="w-full py-6 z-20">
                    <div class="my-6 inline-flex h-20">
                        <img src="/images/logo_default.png" class="rounded-full">
                    </div>

                    <BreezeValidationErrors class="mb-4" />

                    <div v-if="status" class="mb-4 font-medium  text-green-600">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit" class="mx-auto max-w-md sm:max-w-sm p-4">
                        <div>
                            <input type="email" v-model="form.email" class="block w-full p-4 text-lg rounded-sm bg-gray-100 rounded border border-gray-200" required autofocus autocomplete="username" placeholder="Correo electrónico">
                        </div>
                        <div >
                            <input type="password" v-model="form.password" class="block w-full p-4 text-lg rounded-sm bg-gray-100 rounded border border-gray-200"  required autocomplete="current-password" placeholder="Contraseña"/>
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <breeze-checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ml-2  text-gray-600">Mantener mi sesión activa</span>
                            </label>
                        </div>

                        <div class="px-4 pb-2 pt-4">
                            <button type="submit" class="uppercase text-white block w-full p-4 text-lg rounded-full bg-fucsia-600 hover:bg-fucsia-700 focus:outline-none focus-within:ring focus:ring-purple-200" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Ingresar
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </section>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>

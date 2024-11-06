<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    username: '',
    password: ''
});

const submit = () => {
    form.post(route('login'));
};
</script>

<template>
    <Head title="Connexion" />
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md">
            <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Identifiant
                    </label>
                    <input 
                        v-model="form.username"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username"
                        type="text"
                        placeholder="Identifiant"
                    >
                    <div v-if="form.errors.username" class="text-red-500 text-xs mt-1">
                        {{ form.errors.username }}
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Mot de passe
                    </label>
                    <input 
                        v-model="form.password"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password"
                        type="password"
                        placeholder="******************"
                    >
                </div>
                <div class="flex items-center justify-center">
                    <button 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                        :disabled="form.processing"
                    >
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
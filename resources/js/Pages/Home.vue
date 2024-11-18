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
    <Head title="Calendrier prévisionnel" />
    <div class="container">
        <h1 class="text-center">Helloo world!</h1>
    </div>
</template>

<template>
    <div class="login-container">
        <img src="@/../img/logo.png" alt="Logo" class="logo" />
        <div class="login-form">
            <h2>Créez votre mot de passe personnel</h2>
            <p class="subtitle">Pour plus de sécurité, veuillez créer votre mot de passe personnel</p>
            
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input
                        id="password"
                        v-model="form.password"
                        name="password"
                        type="password"
                        required
                        placeholder="Nouveau mot de passe"
                    />
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirmez le mot de passe</label>
                    <input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        placeholder="Confirmez le mot de passe"
                    />
                </div>

                <div v-if="form.errors" class="error-message">
                    <p v-for="(error, index) in form.errors" :key="index">{{ error }}</p>
                </div>

                <button
                    type="submit"
                    class="login-button"
                    :disabled="form.processing"
                >
                    Créer le mot de passe
                </button>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('store.personal.password'));
};
</script>

<style scoped>
.login-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    height: 100vh;
    background-color: #f9f9f9;
    padding-top: 50px;
}

.logo {
    width: 600px;
    margin-bottom: 20px;
}

.login-form {
    background-color: #fff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: center;
    margin-top: 40px;
}

h2 {
    margin-bottom: 10px;
    color: #333;
}

.subtitle {
    color: #666;
    margin-bottom: 30px;
    font-size: 0.9rem;
}

.form-group {
    margin-bottom: 30px;
    text-align: left;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

.login-button {
    width: 100%;
    padding: 10px;
    background-color: #72C489;
    color: white;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    font-size: 16px;
}

.login-button:hover {
    background-color: #45a049;
}

.error-message {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    margin-bottom: 1rem;
}

.login-button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}
</style>

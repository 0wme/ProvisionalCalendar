<template>
    <div class="login-container">
      <img src="@/../img/logo.png" alt="Logo" class="logo" />
      <div class="login-form">
        <h2>Se connecter</h2>
        <form>
          <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" placeholder="Nom d'utilisateur" />
          </div>
          <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" placeholder="Mot de passe" />
          </div>
          <button type="submit" class="login-button">Se connecter</button>
        </form>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
    // Ici pour ton backend (redirection)
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
  </style>
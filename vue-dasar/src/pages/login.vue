<template>
  <div class="container">
    <h3>Halaman login</h3>
    <form @submit.prevent="">
      <input type="text" v-model="user.name" />
      <br />
      <input type="password" v-model="user.password" />
      <button @click.prevent="doLogin">Login</button>
    </form>
    <ul v-for="users in user" v-bind:key="users.id">
      <li>{{ users }}</li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      loggedIn: localStorage.getItem("loggedIn"),
      user: [],
      token: localStorage.getItem("token"),
      validations: [],
      loginFailed: null,
    };
  },

  methods: {
    doLogin() {
      if (this.user.name && this.user.password) {
        axios
          .post("http://127.0.0.1:8000/api/auth/login", {
            name: this.user.name,
            password: this.user.password,
          })
          .then((res) => {
            console.log(res);

            if (res.data.success) {
              localStorage.setItem("loggedIn", "true");
              localStorage.setItem("token", res.data.token);
              this.loggedIn = true;
            } else {
              this.loginFailed = true;
            }
          })
          .catch((error) => {
            console.log(error);
          });
      }

      const formInput = {
        idCardNumber: this.user.name,
        password: this.user.password,
      };

      return console.log(formInput);
    },
  },
};
</script>

<style scoped>
html,
body {
  margin: 0;
  padding: 0;
}
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  min-height: 100vh;
}
</style>

<template>
  <div class="container">
    <div class="card mx-auto" style="width: 60%; margin-top: 20%">
      <h4>Login</h4>
      <form @submit.prevent>
        <div class="grom-group" style="padding: 10px">
          <input
            type="text"
            class="form-control"
            name="email"
            placeholder="Enter your email"
            v-model="email"
          />
          <span class="text-danger">{{ email_error }}</span>
        </div>
        <div class="grom-group" style="padding: 10px">
          <input
            type="text"
            class="form-control"
            name="password"
            placeholder="Enter your password"
            v-model="password"
          />
          <span class="text-danger">{{ password_error }}</span>
        </div>
        <button
          @click="admin_login"
          class="btn btn-primary"
          style="width: 98%; margin-bottom: 5px"
        >
          Login
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Login",

  data() {
    return {
      email: "",
      password: "",
      email_error: "",
      password_error: "",
    };
  },
  methods: {
    async admin_login() {
      let email = this.email;
      let password = this.password;

      //email validation
      if (email.trim() == "") {
        this.email_error = "You can not login without email";
      } else {
        let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!email.trim().match(regex)) {
          this.email_error = "Please, enter valid email";
        } else {
          this.email_error = "";
        }
      }

      //password validation
      if (password.trim() == "") {
        this.password_error = "You can not login without password";
      } else {
        this.password_error = "";
      }

      if (this.email_error == "" && this.password_error == "") {
        await axios
          .post("http://127.0.0.1:8000/api/admin/login", {
            email: this.email,
            password: this.password,
          })
          .then((response) => {
            console.log(response.data);
            if (response.data.status == 201) {
              localStorage.setItem("user-token", response.data.access_token);
              this.$router.push({ name: "Dashboard" });
              this.$notify({
                title: response.data.message,
                text: "Welcome to the Dashboard",
                type: "success",
              });
            }
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>

<style scoped></style>

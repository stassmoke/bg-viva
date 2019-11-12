<template>
  <v-row class="d-flex justify-center align-center">
    <v-col cols="12" sm="8" md="4">
      <v-card class="elevation-12">
        <v-toolbar color="primary" dark flat>
          <v-toolbar-title>Регистрация</v-toolbar-title>
          <div class="flex-grow-1"></div>
        </v-toolbar>
        <v-card-text>
          <v-form>
            <v-text-field label="ФІО" name="name" prepend-icon type="name" v-model="name" required></v-text-field>
            <v-text-field
              label="Пошта"
              name="email"
              prepend-icon
              type="email"
              v-model="email"
              required
            ></v-text-field>
            <v-text-field
              label="Посада"
              name="title"
              prepend-icon
              type="text"
              v-model="title"
              required
            ></v-text-field>
            <v-select :items="branchAddress" label="Адреса відділення"></v-select>
            <v-text-field
              label="Код відділення"
              name="codeBranch"
              prepend-icon
              type="number"
              maxlength="3"
              oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
              v-model="codeBranch"
              required
            ></v-text-field>
            <v-text-field
              id="password"
              label="Пароль"
              name="password"
              prepend-icon
              type="password"
              v-model="password"
              required
            ></v-text-field>
            <v-text-field
              id="confrim-password"
              label="Підтвердіть пароль"
              name="password"
              prepend-icon
              type="password"
              v-model="confirmPassword"
              required
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <div class="flex-grow-1"></div>
          <v-btn color="primary" @click.prevent="register" dark>Зарегистрировать</v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      name: null,
      email: null,
      password: null,
      confirmPassword: null,
      codeBranch: null,
      title: null,
      branchAddress: [
          'Черкаси',
          'Сміла',
          'Шпола',
          'Золотоноша',
          'Чорнобай',
          'Канів',
          'Суми',
          'Тальне',
          'Звенегородка',
          'Городище',
      ]
    };
  },
  methods: {
    ...mapActions(["registerUser"]),
    register() {
      const user = {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.confirmPassword
      };

      this.registerUser(user).then(() => {
        this.$router.push({ name: "clients" });
      });
    }
  }
};
</script>

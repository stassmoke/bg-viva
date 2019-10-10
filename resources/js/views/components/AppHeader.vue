<template>
  <v-app-bar app color="indigo" dark>
    <v-app-bar-nav-icon></v-app-bar-nav-icon>
    <v-toolbar-title>Viva-Capital Ba</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items>
      <v-btn 
        v-for="btn of buttons" 
        :key="btn.title"
        :to="btn.route"
         text >
          <v-icon left>
            <!-- {{btn.icon}} -->
          </v-icon>
          {{btn.title}}
      </v-btn>
    </v-toolbar-items>
  </v-app-bar>
</template>

<script>
export default {
  data: () => ({
    buttons: [
      {
        title: 'Вход',
        icon: 'lock',
        route: 'Login'
        
      },
      {
        title: 'Выход',
        icon: 'lock',
        route: 'Login'
      },
      {
        title: 'Зарегистрировать',
        icon: 'lock',
        route: 'Registration',
      }
    ]
  })
};
</script>
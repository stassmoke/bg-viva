<template>
  <div>

    <app-header></app-header>
    <p>
      <router-link :to="{ name: 'home' }">Home</router-link>|
      <router-link :to="{ name: 'hello' }">Hello World</router-link>
    </p>

    <div class="container">

      <router-view></router-view>

    </div>
  </div>
</template>



<script>
import AppHeader from '../../js/views/components/AppHeader'


    export default {
        components: {
            AppHeader
        }
    };

</script>

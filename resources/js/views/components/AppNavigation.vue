<template>
    <div>
      <v-navigation-drawer app v-model="isShowNav">
        <v-list dense>
          <v-list-item 
            v-for="link of links"
            :key="link.title"
            @click=""
          >
            <v-list-item-content>
              <v-list-item-title>
                  <router-link :to="{ name: link.url }">{{link.title}}</router-link>
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
    </div>
</template>

<script>

    export default {
        data: () => ({
            links: [
                {
                    title: '1 component',
                    url: 'home',
                    
                },
                {
                    title: '2 component',
                    url: 'hello', 
                }
            ]
        }),
        computed: {
            isShowNav: {
                get() {
                    return this.$store.getters.isShowNav;
                },
                set() {}
            }
        }
    }
</script>

<template>
  <v-menu v-model="menu" :close-on-content-click="false" offset-y>
    <template #activator="{ on }">
      <v-btn icon v-on="on">
        <v-avatar size="40">
          <img :src="user.avatar_url" :alt="user.name">
        </v-avatar>
      </v-btn>
    </template>

    <v-card>
      <v-list>
        <v-list-item>
          <v-list-item-avatar>
            <img :src="user.avatar_url" :alt="user.name">
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>{{ user.name }}</v-list-item-title>
            <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
          </v-list-item-content>

          <v-list-item-action class="flex-row">
            <v-tooltip bottom>
              <template #activator="{ on }">
                <v-btn icon :to="{ name: 'users.show', params: { id: user.id } }" @click="clickUserBtn" v-on="on">
                  <v-icon>mdi-account</v-icon>
                </v-btn>
              </template>
              <span>{{ $t('Profile') }}</span>
            </v-tooltip>
            <v-tooltip bottom>
              <template #activator="{ on }">
                <v-btn icon :to="{ name: 'user.security' }" @click="clickUserBtn" v-on="on">
                  <v-icon>mdi-shield-lock</v-icon>
                </v-btn>
              </template>
              <span>{{ $t('Security') }}</span>
            </v-tooltip>
            <v-tooltip bottom>
              <template #activator="{ on }">
                <v-btn icon :to="{ name: 'user.affiliate' }" @click="clickUserBtn" v-on="on">
                  <v-icon>mdi-link</v-icon>
                </v-btn>
              </template>
              <span>{{ $t('Affiliate program') }}</span>
            </v-tooltip>
          </v-list-item-action>
        </v-list-item>
      </v-list>

      <v-divider />

      <v-card-actions>
        <v-spacer />
        <v-btn text @click="logout">
          <v-icon>mdi-logout</v-icon>
          {{ $t('Log out') }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-menu>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import DeviceMixin from '~/mixins/Device'

export default {
  mixins: [DeviceMixin],

  data () {
    return {
      menu: false,
      userMenu: true
    }
  },

  computed: {
    ...mapState('auth', ['user', 'account', 'token'])
  },

  methods: {
    ...mapActions({
      MenuNavigationStatus: 'interface/MenuNavigationStatus'
    }),
    async logout () {
      // Log out
      await this.$store.dispatch('auth/logout')

      // Redirect to home page
      if (this.$route.name !== 'home') {
        this.$router.push({ name: 'home' })
      }
    },
    clickUserBtn() {
      this.userMenu = false;
      this.MenuNavigationStatus(!this.isMobile);
    }
  }
}
</script>

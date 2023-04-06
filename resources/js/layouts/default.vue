<template>
  <v-app :class="navbarVisible ? 'permanent-navbar' : 'temporary-navbar'" :style="style">
    <system-bar
      v-if="!(isMobile && (isGamePage || isPredictionPage || isProviderGamePage)) && systemBarEnabled && authenticated" />

    <v-navigation-drawer app :color="navBarBackground"
      :class="!isMobile ? 'navigation-drawer' : 'navigation-drawer mobile-navigation-drawer'"
      @input="onChangeMenuNavigationDrawer" :value="isMenuOpened"
      :permanent="isMobile ? isMenuOpened : isTablet ? !isMenuMiniVariant : navbarVisible"
      :temporary="!isTablet ? !navbarVisible : true" :hide-overlay="!isTablet ? true : !isMenuMiniVariant"
      :mini-variant="(isTablet || isDeskTop) ? !isMenuMiniVariant : false" ref="navigationDrawer">
      <v-list-item
        :class="!isMobile ? 'navigation-drawer__header' : 'navigation-drawer__header mobile-navigation-drawer__header'">
        <v-list-item-content>
          <v-list-item-title v-if="isMenuMiniVariant || isMobile" class="title">
            {{ $t('Navigation') }}
          </v-list-item-title>
          <v-btn v-if="!isMobile" small icon class="open-navigation-drawer-btn"
            @click.stop="MenuNavigationMiniVariantStatus(!isMenuMiniVariant)">
            <v-icon small>
              mdi-forwardburger
            </v-icon>
          </v-btn>
          <v-btn v-if="isMobile" small icon class="close-navigation-drawer-btn" @click.stop="MenuNavigationStatus(false)">
            <v-icon small>
              mdi-close
            </v-icon>
          </v-btn>
        </v-list-item-content>
      </v-list-item>
      <!-- <v-divider v-if="!isMobile" /> -->
      <div :class="!isMobile ? '' : 'mobile-navigation-drawer__content'">
        <template v-if="user && user.is_admin">
          <admin-main-menu />
          <v-divider />
        </template>
        <main-menu />
      </div>
    </v-navigation-drawer>

    <chat v-if="authenticated && chatEnabled" @message="setUnreadChatMessagesCount" />

    <template v-if="isMobile && (isGamePage || isPredictionPage || isProviderGamePage)">
      <v-speed-dial fixed top left>
        <template #activator>
          <v-btn small outlined icon @click.stop="MenuNavigationStatus(!isMenuOpened)">
            <v-icon small>
              mdi-menu
            </v-icon>
          </v-btn>
        </template>
      </v-speed-dial>
      <v-speed-dial fixed top right>
        <template #activator>
          <v-btn v-show="!isProviderGamePage" small outlined :to="{ name: 'user.account.transactions' }" exact>
            <v-icon small>
              {{ creditsIcon }}
            </v-icon>
            <animated-number v-if="account" :number="account.balance" />
          </v-btn>
        </template>
      </v-speed-dial>
    </template>
    <v-app-bar v-else app :clipped-left="!navbarVisible" :color="appBarBackground">
      <v-app-bar-nav-icon v-if="!navbarVisible && !isMobile" @click.stop="MenuNavigationStatus(false)" />

      <v-toolbar-title class="header-logo d-flex align-center" @click.stop="MenuNavigationStatus(!isMobile)">
        <router-link :to="{ name: 'home' }">
          <v-avatar size="40" tile>
            <v-img :src="appLogoUrl" :alt="appName" />
          </v-avatar>
        </router-link>
        <div class="ml-3 d-none d-sm-block text-h5">
          {{ appName }}
        </div>
      </v-toolbar-title>

      <v-spacer />

      <template v-if="!token && !authenticated">
        <!-- <v-btn :to="{ name: 'login' }" class="secondary" @click="OpenLoginModal"> -->
        <v-btn class="secondary" @click="OpenLoginModal">
          {{ $t('Log in') }}
        </v-btn>
        <v-btn :to="{ name: 'register' }" class="primary ml-2">
          {{ $t('Sign up') }}
        </v-btn>
      </template>
      <template v-else-if="authenticated">
        <account-menu />
        <settings-menu />
        <user-menu />

        <v-btn v-if="chatEnabled && !isMobile" icon @click="ChatDrawerStatus(!isChatOpened)">
          <v-badge :content="unreadChatMessagesCount" :value="unreadChatMessagesCount" overlap>
            <v-icon>{{ isChatOpened ? 'mdi-message' : 'mdi-message-outline' }}</v-icon>
          </v-badge>
        </v-btn>
      </template>
      <preloader :active="loading" />
    </v-app-bar>

    <v-main>
      <message />
      <router-view id="content" />
    </v-main>
    <v-bottom-navigation :background-color="appBarBackground" fixed v-if="isMobile">
      <v-btn v-if="!navbarVisible" @click.stop="MenuNavigationStatus(!isMenuOpened)">
        <span>Menu</span>

        <v-icon>mdi-menu</v-icon>
      </v-btn>

      <v-btn>
        <span>Search</span>

        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn v-if="chatEnabled" @click="ChatDrawerStatus(!isChatOpened)">
        <span>Chat</span>
        <v-badge :content="unreadChatMessagesCount" :value="unreadChatMessagesCount" overlap>
        </v-badge>
        <v-icon>{{ isChatOpened ? 'mdi-message' : 'mdi-message-outline' }}</v-icon>
      </v-btn>

      <v-btn>
        <span>Casino</span>

        <v-icon>mdi-slot-machine</v-icon>
      </v-btn>

    </v-bottom-navigation>

    <component :is="footerComponent" v-if="!(isMobile && (isGamePage || isPredictionPage || isProviderGamePage))"
      :inset="navbarVisible" />

    <v-dialog v-model="dialog" dark :width="!isMobile ? '460px' : '100%'">
      sss
    </v-dialog>
  </v-app>
</template>

<script>
import { config } from '~/plugins/config'
import { mapState, mapGetters, mapActions } from 'vuex'
import DeviceMixin from '~/mixins/Device'
import Message from '~/components/Message'
import Chat from '~/components/Chat'
import Preloader from '~/components/Preloader'
import SecondaryFooter from '~/components/SecondaryFooter'
import AdminFooter from '~/components/Admin/Footer'
import AnimatedNumber from '~/components/AnimatedNumber'
import SystemBar from '~/components/SystemBar'
import AdminMainMenu from '~/components/Admin/MainMenu'
import MainMenu from '~/components/MainMenu'
import AccountMenu from '~/components/AccountMenu'
import SettingsMenu from '~/components/SettingsMenu'
import UserMenu from '~/components/UserMenu'

export default {
  name: 'DefaultLayout',

  components: { UserMenu, SettingsMenu, AccountMenu, MainMenu, AdminMainMenu, SystemBar, Message, Chat, Preloader, SecondaryFooter, AdminFooter, AnimatedNumber },

  mixins: [DeviceMixin],

  data() {
    return {
      unreadChatMessagesCount: 0,
      dialog: false,
    }
  },

  computed: {
    ...mapState('auth', ['user', 'account', 'token']),
    ...mapState('progress', ['loading']),
    ...mapState('interface', ['isMenuOpened']),
    ...mapState('interface', ['isChatOpened']),
    ...mapState('interface', ['isMenuMiniVariant']),
    ...mapGetters({
      authenticated: 'auth/check'
    }),
    appName() {
      return config('app.name')
    },
    appLogoUrl() {
      return config('app.logo')
    },
    appBarBackground() {
      return config('settings.theme.backgrounds.app_bar')
    },
    navBarBackground() {
      return config('settings.theme.backgrounds.nav_bar')
    },
    creditsIcon() {
      return config('settings.interface.credits_icon')
    },
    navbarVisible() {
      return config('settings.interface.navbar.visible') && !this.isMobile
    },
    isGamePage() {
      return this.$route.name === 'game'
    },
    isProviderGamePage() {
      return this.$route.name === 'provider.game'
    },
    isPredictionPage() {
      return this.$route.name === 'prediction'
    },
    systemBarEnabled() {
      return config('settings.interface.system_bar.enabled')
    },
    chatEnabled() {
      return config('settings.interface.chat.enabled')
    },
    style() {
      return {
        background: config('settings.theme.backgrounds.page'),
        '--body-font': config('settings.theme.fonts.body.family'),
        '--heading-font': config('settings.theme.fonts.heading.family')
      }
    },
    footerComponent() {
      if (!this.$route.name || this.$route.name === 'home') {
        return false
      }

      return this.$route.name.indexOf('admin.') > -1
        ? 'AdminFooter'
        : 'SecondaryFooter'
    }
  },

  created() {
    this.$store.dispatch('package-manager/fetchOriginalGames')
    this.$store.dispatch('package-manager/fetchProviderGames')
  },

  mounted() {
    document.addEventListener('click', this.handleClickOutside);
  },

  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside);
  },

  methods: {
    ...mapActions({
      MenuNavigationStatus: 'interface/MenuNavigationStatus',
      ChatDrawerStatus: 'interface/ChatDrawerStatus',
      MenuNavigationMiniVariantStatus: 'interface/MenuNavigationMiniVariantStatus',
    }),
    config,
    setUnreadChatMessagesCount(count) {
      this.unreadChatMessagesCount = count
    },
    onChangeMenuNavigationDrawer(value) {
      console.log("onChangeMenuNavigationDrawer: ", value)
      this.MenuNavigationStatus(value);
    },
    handleClickOutside(e) {
      if (!this.$refs.navigationDrawer.$el.contains(event.target) && this.isTablet) {
        this.MenuNavigationMiniVariantStatus(false);
      }
    },
    OpenLoginModal() {
      this.dialog = true;
    }
  },
}
</script>

<style lang="scss">
@import '~/../sass/_variables.scss';

body {
  .v-application {

    &,
    & .title,
    & .subtitle-1,
    & .subtitle-2,
    & .body-1,
    & .body-2 {
      font-family: var(--body-font), sans-serif !important;
    }

    .text-h1,
    .text-h2,
    .text-h3,
    .text-h4,
    .text-h5,
    .text-h6,
    .text-headline,
    .text-title,
    .text-subtitle-1,
    .text-subtitle-2,
    .text-button,
    .text-caption,
    .text-overline,
    .v-card .headline,
    .v-card .v-toolbar__title {
      font-family: var(--heading-font), sans-serif !important;
    }

    .mobile-navigation-drawer {
      top: auto !important;
      bottom: 0;
      width: 100% !important;
      height: calc(100% - 56px) !important;

      .close-navigation-drawer-btn {
        position: absolute;
        right: 8px;
      }

      .v-navigation-drawer__content {
        overflow-y: hidden;
      }

      .mobile-navigation-drawer__content {
        overflow-x: hidden;
        overflow-y: auto;
        height: calc(100vh - 106px);

        &::-webkit-scrollbar {
          width: 10px;
        }

        &::-webkit-scrollbar-thumb {
          width: 5px;
          background: var(--v-secondary-darken1);
          border: 3px solid var(--v-secondary-lighten2);
          border-radius: 5px;
        }
      }

      .mobile-navigation-drawer__header {
        height: 48px;
      }
    }

    .navigation-drawer__header {
      box-shadow: $mobile-navigation-drawer-header-box-shadow;
      height: 64px;

      .v-list-item__content {
        overflow: visible;
      }

      .open-navigation-drawer-btn {
        position: absolute;
        right: 15px;
      }
    }
  }
}

.navigation-drawer {
  .v-navigation-drawer__content {
    overflow: hidden;
  }

  .navigation-drawer__header+div {
    height: calc(100% - 64px);
    overflow-x: hidden;
    overflow-y: auto;

    &::-webkit-scrollbar {
      width: 6px;
    }

    &::-webkit-scrollbar-thumb {
      width: 6px;
      background: #2f4553;
      // border: 3px solid var(--v-secondary-lighten2);
      border-radius: 10px;
    }
  }
}
</style>

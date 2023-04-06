<template>
  <v-navigation-drawer 
    id="chat" 
    :value="isChatOpened" 
    app 
    right 
    width="300" 
    :class="!isMobile ? 'chat-drawer' : 'chat-drawer mobile-chat-drawer'"
    @input="changeDrawerState" 
    :hide-overlay="!isMobile ? false : true" 
    :color="navBarBackground"
    :permanent="(isTablet || isDeskTop) ? isChatOpened : false"
    :temporary="(isTablet || isDeskTop) ? !isChatOpened : true"
  >

    <v-list-item :class="!isMobile ? 'chat-drawer__header' : 'chat-drawer__header mobile-chat-drawer__header'">
      <v-list-item-content>
        <div class="px-2 py-4">
          <h4 class="title">
            <div class="float-left">
              <span v-if="!rooms || rooms.length == 0">{{ $t('Chat') }}</span>
              <span v-else-if="rooms && rooms.length == 1">{{ curRoomName }}</span>
              <v-menu v-else-if="rooms.length > 1" v-model="roomMenu" :close-on-content-click="false" offset-y left>
                <template v-slot:activator="{ on }">
                  <v-btn v-on="on" class="chat-current-room-btn">
                    {{ curRoomName }}
                    <v-icon>{{ roomMenu ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                  </v-btn>
                </template>
                <v-list class="room-list">
                  <v-list-item v-for="(room, i) in rooms" :key="i" @click.stop="RoomListClick(room)">
                    <v-list-item-title>{{ room.name }}</v-list-item-title>
                  </v-list-item>
                </v-list>
              </v-menu>
            </div>
          </h4>
        </div>
        <v-btn v-if="isMobile" small icon class="close-navigation-drawer-btn" @click.stop="ChatDrawerStatus(false)">
          <v-icon small>
            mdi-close
          </v-icon>
        </v-btn>
      </v-list-item-content>
    </v-list-item>

    <div ref="messages" class="chat-messages-container overflow-y-auto"
      :class="`theme--${$vuetify.theme.isDark ? 'dark' : 'light'}`">
      <v-list two-line class="pa-0">
        <transition-group name="slide-x-transition" tag="div">
          <v-hover v-slot:default="{ hover }" v-for="(msg, index) in messages" :key="`message-${index}`">
            <!-- <v-list-item :class="{ 'grey darken-2': hover }"> -->
            <v-list-item class="v-list-item-message">
              <!-- <v-list-item-avatar size="50">
                <user-avatar :user="msg.user" />
              </v-list-item-avatar> -->
              <v-list-item-content class="v-list-item-content-message">
                <v-list-item-title class="subtitle-2">
                  <user-profile-modal :user="msg.user">
                    <template v-slot="{ on }">
                      <span class="text--primary link" v-on="on">
                        {{ `${msg.user.name}: ${msg.message}` }}
                      </span>
                    </template>
                  </user-profile-modal>
                  <v-btn v-if="user.id !== msg.user.id" v-show="hover" icon x-small class="float-right"
                    @click="addRecipient(msg.user)">
                    <v-icon small>
                      mdi-reply
                    </v-icon>
                  </v-btn>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-hover>
        </transition-group>
      </v-list>
    </div>

    <template v-slot:append>
      <v-form v-model="formIsValid" class="pa-4 chat-message-form" @submit.prevent="sendMessage">
          <v-row>
            <v-col
              cols="12"
            >
              <v-text-field
                v-model="form.message" dense flat full-width :label="$t('Type your message')"
                :readonly="form.busy || !echo" :loading="form.busy" :counter="maxLength"
                :rules="[v => validationMaxLength(v, maxLength)]" :error="form.errors.has('message')"
                :error-messages="form.errors.get('message')" class="chat-message-input"
                solo
              ></v-text-field>
              <template v-slot:prepend-inner>
                <v-chip v-for="(recipient, index) in recipients" :key="`user-${recipient.name}`" label pill small
                  :close="true" @click:close="removeRecipient(index)">
                  {{ recipient.name }}
                </v-chip>
              </template>
              <div class="d-flex justify-space-between align-center">
                <div class="chat-message-online-user-count">
                  <span :class="usersCount > 0 ? 'active' : 'disabled'"></span> {{ `${$t('Online: ')} ${usersCount}` }}
                </div>
                <div>
                  <v-btn type="submit" class="chat-message-submit-btn" :disabled="form.busy || !room || !form.message || !formIsValid">
                    Send
                  </v-btn>
                </div>
              </div>
            </v-col>
          </v-row>
      </v-form>
    </template>
  </v-navigation-drawer>
</template>
<script>
import axios from 'axios'
import Form from 'vform'
import { config } from '~/plugins/config'
import { mapState, mapActions } from 'vuex'
import FormMixin from '~/mixins/Form'
import DeviceMixin from '~/mixins/Device'
import SoundMixin from '~/mixins/Sound'
import UserProfileModal from '~/components/UserProfileModal'
import messageSound from '~/../audio/chat/message.wav'
import UserAvatar from './UserAvatar'

export default {
  components: { UserAvatar, UserProfileModal },

  mixins: [FormMixin, SoundMixin, DeviceMixin],

  data() {
    return {
      roomMenu: false,
      rooms: [],
      room: null,
      curRoomName:'',
      usersCount: 0,
      messages: [],
      recipients: [],
      unreadMessagesCount: 0,
      form: new Form({
        message: '',
        recipients: []
      })
    }
  },

  computed: {
    ...mapState('auth', ['user']),
    ...mapState('broadcasting', ['echo']),
    ...mapState('interface', ['isChatOpened']),
    maxLength() {
      return config('settings.interface.chat.message_max_length')
    },
    navBarBackground() {
      return config('settings.theme.backgrounds.nav_bar')
    },
  },

  watch: {
    value(newValue, oldValue) {
      // if chat drawer was closed and now open
      if (!oldValue && newValue) {
        // clear unread messages notification
        setTimeout(() => {
          this.setUnreadMessagesCount(0)
        }, 1000)
      }
    },
    room(newRoom, oldRoom) {
      if (oldRoom && newRoom) {
        this.leaveRoom(oldRoom)
        this.joinRoom(newRoom)
        this.fetchMessages(newRoom)
      }
    }
  },

  async created() {
    console.log("this.isMobile: ", this.isMobile)
    await this.fetchRooms()
    this.fetchMessages(this.room)
    this.joinRoom(this.room)
    this.curRoomName = this.rooms[0].name;
  },

  destroyed() {
    this.leaveRoom()
  },

  methods: {
    ...mapActions({
      ChatDrawerStatus: 'interface/ChatDrawerStatus',
    }),
    async fetchRooms() {
      const { data } = await axios.get('/api/chat/rooms')

      this.rooms = data

      if (this.rooms.length) {
        this.room = this.rooms[0].id
      }
    },

    async fetchMessages(room) {
      if (!room) {
        return false
      }

      const { data } = await axios.get(`/api/chat/${room}`)

      this.messages = data

      this.scrollToBottom()
    },

    addMessage(message) {
      this.messages.push(message)
      this.scrollToBottom()

      // check if current user is amongst recipients of the message
      if (message.recipients.length) {
        message.recipients.forEach(recipient => {
          if (recipient.id === this.user.id) {
            // play a sound to notify user
            this.sound(messageSound)

            // if the chat window is closed increase the number of unread messages
            if (!this.isChatOpened) {
              this.setUnreadMessagesCount(this.unreadMessagesCount + 1)
            }
          }
        })
      }
    },

    addRecipient(user) {
      if (this.recipients.length === 0) {
        this.recipients.push(user)
      }
    },

    removeRecipient(index) {
      this.recipients.splice(index, 1)
    },

    setUnreadMessagesCount(count) {
      this.unreadMessagesCount = count
      this.$emit('message', this.unreadMessagesCount)
    },

    changeDrawerState(isOpen) {
      // parent needs to be notified via event to update its state,
      // when the drawer is closed by clicking outside of it (on mobiles)
      // if (this.value !== isOpen) {
        // this.$emit('input', isOpen)
      // }
      this.ChatDrawerStatus(isOpen);
    },

    joinRoom(room) {
      if (!this.echo || !room) {
        return false
      }

      this.echo.join(`chat.${room}`)
        // currently joined users
        .here(users => {
          this.usersCount = users.length
        })
        // new user joined
        .joining(user => {
          this.usersCount++
        })
        // user left
        .leaving(user => {
          this.usersCount--
        })
        // new message
        .listen('ChatMessageSent', message => this.addMessage(message))
    },

    leaveRoom(room) {
      if (!this.echo || !room) {
        return false
      }

      this.echo.leave(`chat.${room}`)
    },

    async sendMessage() {
      if (this.recipients.length) {
        this.form.recipients = this.recipients.map(user => user.id)
      }

      await this.form.post(`/api/chat/${this.room}`)

      this.form.message = ''
      this.recipients = []
      this.form.recipients = []
    },

    // automatically scroll messages area to bottom
    scrollToBottom() {
      this.$nextTick(() => {
        // https://stackoverflow.com/a/270628/2767324
        this.$refs.messages.scrollTop = this.$refs.messages.scrollHeight
      })
    },

    RoomListClick(room) {
      this.curRoomName = room.name;
      this.room = room.id;
      this.roomMenu = false;
    }
  }
}
</script>
<style lang="scss" scoped>
@import '~/../sass/_variables.scss';

.chat-message {
  line-height: 1.6em;
}

.mobile-chat-drawer {
  top: auto !important;
  bottom: 0;
  width: 100% !important;
  
}

.chat-drawer {
  background-color: $chat-drawer-bg-color !important;
  .chat-drawer__header {
    background-color: $mobile-chat-drawer-header-color;
    height: 56px;
    box-shadow: $mobile-navigation-drawer-header-box-shadow;

    .close-navigation-drawer-btn {
      position: absolute;
      right: 8px;
    }
  }

  .chat-messages-container {
    padding-left: 16px;
    padding-right: 16px;
    padding-top: 20px;
    padding-bottom: 20px;
    height: calc(100vh - 190px) !important;
    max-height: none !important;
    &::-webkit-scrollbar {
      width: 6px;
    }
    &::-webkit-scrollbar-thumb {
      width: 6px;
      background: #2f4553 !important;
      border-radius: 10px;
      border: none !important;
    }
    &::-webkit-scrollbar-track {
      background: none !important;
    }
    .v-list-item-message {
      background-color: $mobile-chat-drawer-header-color;
      margin-top: 8px;
      border-radius: 4px;
      min-height: 36px;
      .v-list-item-content-message {
        padding: 0;
        .v-list-item__title {
          white-space: normal;
        }
      }
    }
  }

  .chat-current-room-btn {
    background-color: transparent;
    box-shadow: none;
  }

  ::v-deep .chat-message-form {
    background-color: $mobile-chat-drawer-header-color;
    .chat-message-input {
      .v-input__slot {
        background-color: $chat-drawer-bg-color;
        border: $chat-message-input-border-style !important;
        box-shadow: $chat-message-input-box-shadow;
        border-radius: .25rem;
        .v-label {
          color: $chat-message-input-label-color;
          font-size: 14px;
          top: 50%;
          transform: translateY(-50%);
          font-weight: 550;
        }
      }
    }

    .chat-message-submit-btn {
      background-color: var(--v-success-darken1) !important;
      color: var(--v-accent-lighten5) !important;
      font-weight: 550;
    }

    .chat-message-online-user-count {
      font-size: 12px;
      span {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
        
      }
      span.active {
        background-color: var(--v-success-base);
      }
      span.disabled {
        background-color: var(--v-primary-darken2);
      }
    }

    .v-btn--disabled {
      color: rgba($color: #000000, $alpha: 0.3) !important;
    }

  }
}

.v-list.room-list {
  background-color: var(--v-anchor-base) !important;
  .v-list-item {
    color: #1E1E1E;
    &:hover > .v-list-item__title {
      color: var(--v-accent-darken4);
    }
  }

  .v-list-item.active {
    color: var(--v-accent-darken4);
  }
}
</style>

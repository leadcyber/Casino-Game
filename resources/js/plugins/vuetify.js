import '@mdi/font/css/materialdesignicons.css'
import Vue from 'vue'
import Vuetify from 'vuetify/lib'
import theme from './theme'

Vue.use(Vuetify, {
  iconfont: 'mdi'
})

const options = {
  theme: theme,
  breakpoint: {
    thresholds: {
      xs: 400,
      sm: 768,
      md: 992,
      lg: 1200
    },
  },
}

export default new Vuetify(options)

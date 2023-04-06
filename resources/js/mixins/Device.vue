<script>
import { takeRightWhile } from 'lodash';

export default {
  computed: {
    isMobile () {
      return this.$vuetify.breakpoint.smAndDown
    },
    isTablet() {
      return this.$vuetify.breakpoint.lgAndDown && this.$vuetify.breakpoint.smAndUp
    },
    isDeskTop() {
      return this.$vuetify.breakpoint.lgAndUp;
    }
  }
}
</script>

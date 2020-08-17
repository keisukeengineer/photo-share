<template>
  <footer class="footer">
    <div class="copyright">©︎ 2020 photo share</div>
    <button v-if="isLogin" class="button button--link" @click="logout">
      Logout
    </button>
    <RouterLink v-else class="button button--link" to="/login">
      Login / Register
    </RouterLink>
  </footer>
</template>

<script>
import { mapState, mapGetters } from 'vuex'

export default {
  computed: {
    ...mapState({
      apiStatus: state => state.auth.apiStatus
    }),
    ...mapGetters({
      isLogin: 'auth/check'
    })
  },
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')

      if (this.apiStatus) {
        this.$router.push('/login')
      }
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../sass/_mixin';

.footer {
  position: fixed;
  bottom: 0%;
  width: 100%;
  height: 5rem;
  background: white;

  .button--link {
    @include button__link;

    &:hover {
      border-color: black;
    }
  }

  .copyright {
    color: #8a8a8a;
    margin-right: 2%;
  }
}
</style>
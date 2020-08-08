<template>
  <footer class="footer">
    <button v-if="isLogin" class="button button--link" @click="logout">
      Logout
    </button>
    <RouterLink v-else class="button button--link" to="/login">
      Login / Register
    </RouterLink>
    <div class="copyright">©︎ 2020 KeisukeNakama</div>
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
  .footer {
    display: flex;
    flex-flow: column;
    position: fixed;
    bottom: 0%;
    width: 100%;
    height: 5rem;
    background: white;

    .copyright {
      color: #8a8a8a;
      margin-top: 1%;
    }
  }
</style>
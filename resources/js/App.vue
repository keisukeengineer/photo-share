<template>
  <div>
    <header>
      <Navbar />
    </header>
    <main>
      <div class="container">
        <Message />
        <RouterView />
      </div>
    </main>
    <Footer />
  </div>
</template>

<script>
import Navbar from './components/Navbar'
import Footer from './components/Footer'
import Message from './components/Message.vue'
import { NOT_FOUND, UNAUTHORIZED, INTERNAL_SERVER_ERROR } from './util'

export default {
  components: {
    Message,
    Navbar,
    Footer
  },
  computed: {
    errorCode () {
      return this.$store.state.error.code
    }
  },
  watch: {
    errorCode: {
      async handler (val) {
        if (val === INTERNAL_SERVER_ERROR) {
          this.$router.push('/500')

        } else if (val === UNAUTHORIZED) {
          // トークンをリフレッシュ
          await axios.get('/api/refresh-token')

          this.$store.commit('auth/setUser', null)
          this.$router.push('/login')

        } else if (val === NOT_FOUND) {
          this.$router.push('/not-found')
        }
      },
      immediate: true
    },
    $route () {
      this.$store.commit('error/setCode', null)
    }
  }
}
</script>

<style scoped lang="scss">
  .container {
    max-width: 1100px;

    /** iPad 横向き */
    @media screen
      and (max-width: 1366px)
      and (max-height: 1024px) {
        max-width: 1370px;
    }
  }
</style>
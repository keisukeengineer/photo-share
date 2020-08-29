<template>
  <div>
    <header>
      <Navbar />
    </header>
    <main>
      <div class="container">
        <Message />
        <RouterView />
        <transition>
          <button
            type="button"
            class="button button--link"
            v-if="show"
            @click="moveToTop()"
          >
            <i class="fas fa-arrow-up" />
          </button>
        </transition>
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
  data () {
    return {
      scrollY: 0,
      show: false
    }
  },
  mounted() {
   window.addEventListener('scroll', this.calculateScrollY);
  },
  beforeDestroy() {
   window.removeEventListener('scroll', this.calculateScrollY);
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
  },
  methods: {
    calculateScrollY() {
      this.scrollY = window.scrollY;

　    if(this.scrollY > 100) {
        this.show = true
      } else if(this.scrollY === 0) {
        this.show = false
      }
    },
    moveToTop() {
      const duration = 500;  // 移動速度 : 0.5s
      const interval = 8;    // 0.08s毎に移動
      const step = -window.scrollY / Math.ceil(duration / interval); // 1回に移動する距離

      const timer = setInterval(() => {
        window.scrollBy(0, step); // 指定した位置へ移動

        if(window.scrollY <= 0) {
          clearInterval(timer);
        }
      }, interval);
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

  .button--link {
    position: fixed;
    right: .5rem;
    bottom: 7rem;
    margin: 0 .45rem;
    border: 1px solid #dedede;
    transition: border-color .3s ease-in-out;

    &:hover {
      border-color: black;
    }
  }

  .v-enter-active, .v-leave-active {
    transition: opacity .8s
  }

  .v-enter, .v-leave-to {
    opacity: 0;
  }
}
</style>
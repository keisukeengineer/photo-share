<template>
  <footer class="footer">
    <button v-if="isLogin" class="button button--link" @click="logout">
      Logout
    </button>
    <RouterLink v-else class="button button--link" to="/login">
      Login / Register
    </RouterLink>
    <div class="copyright">©︎ 2020 PhotoShare</div>
    <div class="share_wrapper">
      <div
        class="share_wrapper_sub cursor"
        @click="onShareClick('twitter')"
      >
        <i class="fa fa-twitter fa-2x share_wrapper_sub_item" />
      </div>
      <div
        class="share_wrapper_sub cursor"
        @click="onShareClick('facebook')"
      >
        <i class="fa fa-facebook fa-2x share_wrapper_sub_item" />
      </div>
    </div>
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
    },
    onShareClick(shareButton) {
      if(shareButton === 'twitter') {
        this.twitter()
      } else {
        this.facebook()
      }
    },
    twitter() {
      window.open(`https://twitter.com/intent/tweet?url=${location.href}&text=`, '_blank')
    },
    facebook() {
      window.open(`https://www.facebook.com/sharer/sharer.php?u=${location.href}`, '_blank')
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

  .copyright {
    color: #8a8a8a;
    padding: 0.5rem;
  }

  .button--link {
    @include button__link;

    &:hover {
      border-color: black;
    }
  }

  .share_wrapper {
    display: inline-block;

    &_sub {
      display: inline-block;

      &_item {
        margin: 0 0.5rem;
        color: #8a8a8a;
        transition: color 0.5s ease-in-out;

        &:hover {
          color: black;
        }
      }
    }
  }
}
</style>
<template>
  <div class="login container--small">
    <ul class="tab">
      <li
        class="tab__item"
        :class="{'tab__item--active': tab === 1 }"
        @click="tab = 1">
        Login
      </li>
      <li
        class="tab__item"
        :class="{'tab__item--active': tab === 2 }"
        @click="tab = 2">
        Register
      </li>
    </ul>

    <!-- ログイン -->
    <transition appear>
      <div class="panel" v-show="tab === 1">
        <form class="form" @submit.prevent="login">
          <transition name="form">
            <div v-if="loginErrors" class="errors">
              <ul v-if="loginErrors.email">
                <li v-for="msg in loginErrors.email" :key="msg">{{ msg }}</li>
              </ul>
              <ul v-if="loginErrors.password">
                <li v-for="msg in loginErrors.password" :key="msg">{{ msg }}</li>
              </ul>
            </div>
          </transition>
          <label for="login-email">Email</label>
          <input
            type="email"
            class="form__item"
            id="login-email"
            v-model="loginForm.email"
            v-model.trim="loginForm.email"
            @keyup.esc="clear_login_email"
          >
          <label for="login-password">Password</label>
          <input
            type="password"
            class="form__item"
            id="login-password"
            v-model="loginForm.password"
            v-model.trim="loginForm.password"
            @keyup.esc="clear_login_password"
          >
          <div class="form__button">
            <button type="submit" class="button-square-shadow cursor">
              Login
            </button>
          </div>
        </form>
      </div>
    </transition>

    <!-- 会員登録 -->
    <transition appear>
      <div class="panel" v-show="tab === 2">
        <form class="form" @submit.prevent="register">
          <transition name="form">
            <div v-if="registerErrors" class="errors">
              <ul v-if="registerErrors.name">
                <li v-for="msg in registerErrors.name" :key="msg">{{ msg }}</li>
              </ul>
              <ul v-if="registerErrors.email">
                <li v-for="msg in registerErrors.email" :key="msg">{{ msg }}</li>
              </ul>
              <ul v-if="registerErrors.password">
                <li v-for="msg in registerErrors.password" :key="msg">{{ msg }}</li>
              </ul>
            </div>
          </transition>
          <label for="username">Name</label>
          <input
            type="text"
            class="form__item"
            id="username"
            v-model="registerForm.name"
            v-model.trim="registerForm.name"
            @keyup.esc="clear_register_name"
          >
          <label for="email">Email</label>
          <input
            type="email"
            class="form__item"
            id="email"
            v-model="registerForm.email"
            v-model.trim="registerForm.email"
            @keyup.esc="clear_register_email"
          >
          <label for="password">Password</label>
          <input
            type="password"
            class="form__item"
            id="password"
            v-model="registerForm.password"
            v-model.trim="registerForm.password"
            @keyup.esc="clear_register_password"
          >
          <label for="password-confirmation">Password (confirm)</label>
          <input
            type="password"
            class="form__item"
            id="password-confirmation"
            v-model="registerForm.password_confirmation"
            v-model.trim="registerForm.password_confirmation"
            @keyup.esc="clear_register_password_confirmation"
          >
          <div class="form__button">
            <button type="submit" class="button-square-shadow cursor">
              Register
            </button>
          </div>
        </form>
      </div>
    </transition>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  data () {
    return {
      tab: 1,
      loginForm: {
        email: '',
        password: ''
      },
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  computed: {
    ...mapState({
      apiStatus: state => state.auth.apiStatus,
      loginErrors: state => state.auth.loginErrorMessages,
      registerErrors: state => state.auth.registerErrorMessages
    })
  },
  created () {
    this.clearError()
  },
  methods: {
    clear_login_email() {
      this.loginForm.email = '';
    },
    clear_login_password() {
      this.loginForm.password = '';
    },
    clear_register_name() {
      this.registerForm.name = '';
    },
    clear_register_email() {
      this.registerForm.email = '';
    },
    clear_register_password() {
      this.registerForm.password = '';
    },
    clear_register_password_confirmation() {
      this.registerForm.password_confirmation = '';
    },
    clearError () {
      this.$store.commit('auth/setLoginErrorMessages', null)
      this.$store.commit('auth/setRegisterErrorMessages', null)
    },
    async login () {
      await this.$store.dispatch('auth/login', this.loginForm)

      if(this.apiStatus) {
        this.$router.push('/')
      }
    },
    async register () {
      await this.$store.dispatch('auth/register', this.registerForm)

      if (this.apiStatus) {
        this.$router.push('/')
      }
    }
  }
}
</script>

<style scoped lang="scss">
.login {
  margin-top: 9rem;

  @media screen and (max-width: 375px) {
    margin-top: 1rem;
  }

  .v-enter-active {
    transition: opacity .7s
  }

  .form-enter-active {
    transition: opacity .5s
  }

  .v-enter, .form-enter {
    opacity: 0;
  }
}
</style>
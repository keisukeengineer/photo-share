<template>
  <div class="modal-wrapper" id="modal">
    <a href="#!" class="modal-overlay"></a>
    <div class="modal-window">
      <div class="modal-content">
        <div id="login-popup">
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
        <div id="messageRegister">
          If you have not registered, please click 
          <RouterLink
            class="register"
            :to="`/login/${2}`"
            @click="closeMenue()"
          >
            here
          </RouterLink>
        </div>
      </div>
      <a href="#!" id="modal-close">×</a>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  data () {
    return {
      loginForm: {
        email: '',
        password: ''
      }
    }
  },
  computed: {
    ...mapState({
      loginErrors: state => state.auth.loginErrorMessages
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
    clearError () {
      this.$store.commit('auth/setLoginErrorMessages', null)
    },
    async login () {
      this.clearError()
      await this.$store.dispatch('auth/login', this.loginForm)

      if(this.loginErrors) {
        return false
      }

      this.closeMenue()
    },
    closeMenue() {
      document.getElementById('modal-close').click()
    }
  }
}
</script>

<style scoped lang="scss">
.modal-wrapper {
  z-index: 999;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 40px 10px;
  text-align: center;

  &:not(:target) {
    opacity: 0;
    visibility: hidden;
    transition: opacity .3s, visibility .3s;
  }

  &:not(:target) {
    opacity: 0;
    visibility: hidden;
    transition: opacity .3s, visibility .3s;
  }

  &:target {
    opacity: 1;
    visibility: visible;
    transition: opacity .4s, visibility .4s;
  }

  &::after {
    display: inline-block;
    height: 100%;
    margin-left: -.05em;
    vertical-align: middle;
    content: ""
  }

  .modal-overlay {
    z-index: 10;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, .8)
  }

  .modal-window {
    box-sizing: border-box;
    display: inline-block;
    z-index: 20;
    position: relative;
    width: 70%;
    max-width: 600px;
    padding: 30px 30px 15px;
    border-radius: 2px;
    background: #fff;
    box-shadow: 0 0 30px rgba(0, 0, 0, .6);
    vertical-align: middle;

    .modal-content {
      max-height: 80vh;
      overflow-y: auto;
      text-align: left;

      .form-enter-active {
        transition: opacity .8s
      }

      .form-enter{
        opacity: 0;
      }

      .errors {
        padding-right: 1rem;
      }

      #messageRegister {
        padding: 1rem 0;
      }
    }

    #modal-close {
      z-index: 20;
      position: absolute;
      top: 0;
      right: 0;
      width: 35px;
      color: #95979c !important;
      font-size: 2.2rem;
      font-weight: 700;
      line-height: 35px;
      text-align: center;
      text-decoration: none;
      text-indent: 0;

      &:hover {
        color: #2b2e38 !important
      }
    }
  }
}
</style>
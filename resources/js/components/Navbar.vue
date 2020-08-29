<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/">
      Photo Share
    </RouterLink>
    <div class="navbar__menu">
      <div id="user-name" v-if="isLogin">{{ username }}</div>
      <div v-if="isLogin">
        <button class="button" @click="showForm = ! showForm">
          <i class="icon ion-md-add" />
          <i class="fas fa-image" />
        </button>
      </div>
    </div>
    <PhotoForm v-model="showForm" />
    <input type="checkbox" id="drawer-check" class="drawer-hidden" >
    <label for="drawer-check" class="drawer-open cursor">
      <span></span>
    </label>
    <nav class="drawer-content">
      <ul class="drawer-list">
        <li class="drawer-item" v-if="!isLogin" @click="closeMenue()">
          <RouterLink class="login" to="/login">
            <i class="fas fa-sign-in-alt">&nbsp;Login</i>&emsp;/&emsp;
            <i class="fas fa-user-plus">&nbsp;Register</i>
          </RouterLink>
        </li>
        <li class="drawer-item cursor" v-if="isLogin" @click="logout">
          <i class="fas fa-sign-out-alt logout">&nbsp;Logout</i>
        </li>
        <li class="drawer-item cursor" @click="closeMenue()">
          <RouterLink class="contact" to="/contact">
            <i class="fas fa-user">&nbsp;Contact Us</i>
          </RouterLink>
        </li>
        <li class="drawer-item cursor" @click="closeMenue()">
          <RouterLink class="terms_of_service" to="/terms_of_service">
            <i class="fas fa-asterisk">&nbsp;Terms of service</i>
          </RouterLink>
        </li>
      </ul>
    </nav>
  </nav>
</template>

<script>
import PhotoForm from './PhotoForm.vue'
import { mapState, mapGetters } from 'vuex'

export default {
  components: {
    PhotoForm
  },
  data () {
    return {
      showForm: false,
      nowLoginForm: false
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    username () {
      return this.$store.getters['auth/username']
    },
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

      this.closeMenue()
    },
    closeMenue() {
      document.getElementById('drawer-check').checked = false
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../sass/_mixin';

.navbar {
  height: 6rem;

  &__brand {
    margin-left: 1rem;
    transition: opacity .3s ease-in-out;

    &hover {
      opacity: .5;
    }
  }

  &__menu {
    margin-left: auto;

    &__brand {
      padding: .5rem;

      &:hover {
        transition: all .3s ease-in-out;
      }
    }

    #user-name {
      padding: 1rem;
    }
  }

  .drawer-item {
    color: white;
    transition: .5s;

    .logout {
      @include button__link__menu;
    }

    .login,
    .contact,
    .terms_of_service {
      @include button__link__menu;
      text-decoration: none;
      color: white;
    }
  }

  .drawer-open {
    display: flex;
    height: 60px;
    width: 60px;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 100;
  }

  .drawer-hidden {
    display: none;
  }

  .drawer-open span,
  .drawer-open span:before,
  .drawer-open span:after {
    content: '';
    display: block;
    height: 3px;
    width: 25px;
    border-radius: 3px;
    background: #333;
    transition: 0.5s;
    position: absolute;
  }

  /* 三本線のうち一番上の棒の位置調整 */
  .drawer-open span:before {
    bottom: 8px;
  }

  /* 三本線のうち一番下の棒の位置調整 */
  .drawer-open span:after {
    top: 8px;
  }

  /* アイコンがクリックされたら真ん中の線を透明にする */
  #drawer-check:checked ~ .drawer-open span {
    background: rgba(255, 255, 255, 0);
  }

  /* アイコンがクリックされたらアイコンが×印になように上下の線を回転 */
  #drawer-check:checked ~ .drawer-open span::before {
    bottom: 0;
    transform: rotate(45deg);
  }

  #drawer-check:checked ~ .drawer-open span::after {
    top: 0;
    transform: rotate(-45deg);
  }

  /* メニューのデザイン*/
  .drawer-content {
    width: 30%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 100%;/* メニューを画面の外に飛ばす */
    z-index: 99;
    background: rgb(155, 152, 152);
    transition: .5s;

    @media screen and (max-width: 1200px) {
      width: 40%;
    }
    @media screen and (max-width: 950px) {
      width: 50%;
    }
    @media screen and (max-width: 750px) {
      width: 60%;
    }
    @media screen and (max-width: 650px) {
      width: 70%;
    }
    @media screen and (max-width: 550px) {
      width: 100%;
    }

    .drawer-list {
      list-style: none;
      padding-top: 4rem;
      padding-left: 1.5rem;
      padding-inline-start: 0;
    }
  }

  /* アイコンがクリックされたらメニューを表示 */
  #drawer-check:checked ~ .drawer-content {
    left: 70%; /* メニューを画面に入れる */

    @media screen and (max-width: 1200px) {
      left: 60%;
    }
    @media screen and (max-width: 950px) {
      left: 50%;
    }
    @media screen and (max-width: 750px) {
      left: 40%;
    }
    @media screen and (max-width: 650px) {
      left: 30%;
    }
    @media screen and (max-width: 550px) {
      left: 0%;
    }
  }
}
</style>
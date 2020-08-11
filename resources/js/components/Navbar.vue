<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/">
      Photo Share
    </RouterLink>
    <div class="navbar__menu">
      <div v-if="isLogin" class="navbar__item">
      <button class="button" @click="showForm = ! showForm">
        <i class="icon ion-md-add" />
        Submit a photo
      </button>
    </div>
    <span v-if="isLogin" class="navbar__item">
      {{ username }}
    </span>
      <div v-else class="navbar__item">
        <RouterLink
          class="button button--link navbar__menu__auth"
          to="/login"
        >
          <i class="fas fa-sign-in-alt" />&nbsp;Login&emsp;/&emsp;
          <i class="fas fa-user" />&nbsp;Register
        </RouterLink>
      </div>
    </div>
    <PhotoForm v-model="showForm" />
  </nav>
</template>

<script>
import PhotoForm from './PhotoForm.vue'

export default {
  components: {
    PhotoForm
  },
  data () {
    return {
      showForm: false
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    username () {
      return this.$store.getters['auth/username']
    }
  }
}
</script>

<style scoped lang="scss">

/* Navbar */
.navbar {
  align-items: center;
  color: black;
  background: white;
  box-shadow: 0 3px 8px 0 rgba(0, 0, 0, .1);
  display: flex;
  height: 4rem;
  justify-content: space-between;
  left: 0;
  padding: 2%;
  position: fixed;
  right: 0;
  top: 0;
  z-index: 3;

  &__brand {
    color: inherit;
    font-family: Merriweather, serif;
    font-weight: bold;
    font-size: 1.2rem;
    text-decoration: none;

    &:visited {
      color: inherit;
    }

    &:hover {
      opacity: .6;
    }
  }

  &__menu {
    align-items: center;
    display: flex;

    &__playlist:hover {
      color: black;
    }

    &__auth {
      color: black;
      transition: all 0.3s ease;

      &:hover {
        opacity: 0.5;
      }

      .fa-sign-in-alt {
        font-size: 1.1rem;
      }
    }
  }
}
.navbar__item {
    margin-left: 2rem;
}
</style>
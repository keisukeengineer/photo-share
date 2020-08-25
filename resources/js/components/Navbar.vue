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
.navbar__brand {
  padding: .5rem;

  &:hover {
    transition: all .3s ease-in-out;
  }
}

.navbar__menu__auth {
  color: black;

  &:hover {
    color: #8a8a8a;
  }
}

.fa-sign-in-alt {
  font-size: 1.2rem;
}
</style>
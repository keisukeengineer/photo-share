<template>
  <div
    v-if="photo"
    class="photo-detail"
  >
    <a href="#modal" id="login"></a>
    <LoginPopup />
    <div class="photo-detail__photo">
      <transition appear>
        <a :href="photo.url" data-lightbox="group">
          <img :src="photo.url" alt="">
        </a>
      </transition>
      <div>by {{ photo.owner.name }}</div>
    </div>
    <div class="photo-detail__pane">
      <button
        class="button button--like"
        :class="{ 'button--liked': photo.liked_by_user }"
        title="Like photo"
        @click="onLikeClick"
      >
        <i class="icon ion-md-heart" />{{ photo.likes_count }}
      </button>
      <a
        :href="`/photos/${photo.id}/download`"
        class="button"
        title="Download photo"
      >
        <i class="icon ion-md-arrow-round-down" />Download
      </a>
      <h2 class="photo-detail__title">
        <i class="icon ion-md-chatboxes" />Comments
      </h2>
      <ul v-if="photo.comments.length > 0" class="photo-detail__comments">
        <li
          v-for="comment in photo.comments"
          :key="comment.content"
          class="photo-detail__commentItem"
        >
          <p class="photo-detail__commentBody">
            {{ comment.content }}
          </p>
          <p class="photo-detail__commentInfo">
            {{ comment.author.name }}
          </p>
        </li>
      </ul>
      <p v-else>No comments yet.</p>
      <form v-if="isLogin" @submit.prevent="addComment" class="form">
        <transition>
          <div v-if="commentErrors" class="errors">
            <ul v-if="commentErrors.content">
              <li v-for="msg in commentErrors.content" :key="msg">{{ msg }}</li>
            </ul>
          </div>
        </transition>
        <textarea class="form__item" v-model="commentContent" />
        <div class="form__button">
          <button
            type="submit"
            class="button-square-shadow cursor"
          >
            submit comment
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../util'
import LoginPopup from '../components/LoginPopup'

export default {
  props: {
    id: {
      type: String,
      required: true,
    }
  },
  components: {
    LoginPopup
  },
  data () {
    return {
      photo: null,
      commentContent: '',
      commentErrors: null,
      shareURL: '',
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    }
  },
  watch: {
    $route: {
      async handler() {
        await this.fetchPhoto()
      },
      immediate: true
    }
  },
  methods: {
    async fetchPhoto () {
      const response = await axios.get(`/api/photos/${this.id}`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.photo = response.data
    },
    async addComment () {

      const response = await axios.post(`/api/photos/${this.id}/comments`, {
        content: this.commentContent
      })

      // バリデーションエラー
      if (response.status === UNPROCESSABLE_ENTITY) {
        this.commentErrors = response.data.errors
        return false
      }

      this.commentContent = ''
      this.commentErrors = null

      // その他のエラー
      if (response.status !== CREATED) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.photo.comments = [
        response.data,
        ...this.photo.comments
      ]
    },
    onLikeClick () {
      if (! this.isLogin) {
        document.getElementById('login').click()
        return false
      }

      if (this.photo.liked_by_user) {
        this.unlike()
      } else {
        this.like()
      }
    },
    async like () {
      const response = await axios.put(`/api/photos/${this.id}/like`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.photo.likes_count = this.photo.likes_count + 1
      this.photo.liked_by_user = true
    },
    async unlike () {
      const response = await axios.delete(`/api/photos/${this.id}/like`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.photo.likes_count = this.photo.likes_count - 1
      this.photo.liked_by_user = false
    }
  }
}
</script>

<style scoped lang="scss">
.photo-detail {
  margin-top: 7.5rem;
  display: flex;
  justify-content: space-between;

  @media screen and (max-height: 414px) {
    margin-top: 6rem;
    padding-right: 1.3rem;
  }

  &__photo {
    margin-right: 1rem;

    @media screen and (min-width: 1000px) {
      width: 100%;
    }

    @media screen and (max-width: 1000px) {
      margin-right: 0rem;
      margin-bottom: 2rem;
    }
  }

  @media screen and (max-width: 1000px) {
    flex-direction: column;

    &__pane {
      width: 100%;
    }
  }

  @media screen and (max-height: 414px) {
    flex-direction: row;
    margin-top: 6rem;

    &__pane {
      width: 50rem;
      margin-left: 1rem;
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
<template>
  <div class="photo-list">
    <a href="#modal" id="login"></a>
    <LoginPopup />
    <paginate class="paginate" name="paginate-log" :list="photos" :per="6">
      <Photo
        class="grid__item"
        v-for="photo in paginated('paginate-log')"
        :key="photo.id"
        :item="photo"
        @like="onLikeClick"
      />
    </paginate>
    <paginate-links
      for="paginate-log"
      class="paginate_links"
      :class="{'paginate_hidden': photos[0] === undefined}"
      :show-step-links="true"
    />
  </div>
</template>

<script>
import { OK } from '../util'
import Photo from '../components/Photo.vue'
import LoginPopup from '../components/LoginPopup'

export default {
  components: {
    Photo, LoginPopup
  },
  data () {
    return {
      photos: [],
      paginate: ['paginate-log'],
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchPhotos()
      },
      immediate: true
    }
  },
  methods: {
    async fetchPhotos () {
      const response = await axios.get(`/api/photos`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.photos = response.data.data
    },
    onLikeClick ({ id, liked }) {
      if (! this.$store.getters['auth/check']) {
        document.getElementById('login').click()
        return false
      }

      if (liked) {
        this.unlike(id)
      } else {
        this.like(id)
      }
    },
    async like (id) {
      const response = await axios.put(`/api/photos/${id}/like`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.photos = this.photos.map(photo => {
        if (photo.id === response.data.photo_id) {
          photo.likes_count += 1
          photo.liked_by_user = true
        }
        return photo
      })
    },
    async unlike (id) {
      const response = await axios.delete(`/api/photos/${id}/like`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.photos = this.photos.map(photo => {
        if (photo.id === response.data.photo_id) {
          photo.likes_count -= 1
          photo.liked_by_user = false
        }
        return photo
      })
    }
  }
}
</script>

<style scoped lang="scss">
.photo-list {
  margin-top: 9rem;

  @media screen and (max-width: 414px) {
    margin-top: 8.5rem;
  }

  @media screen and (max-height: 414px) {
    margin-top: 5rem;
  }

  @media screen and (max-width: 375px) {
    margin-top: 1rem;
    margin-bottom: 8rem;
  }

  .paginate {
    display: flex;
    flex-wrap: wrap;
    list-style: none;
    padding-inline-start: 0;
    margin-block-start: 0;

    li {
      width: 31%;
      margin: 1%;

      /** iPad Pro 縦向き */
      @media screen
        and (max-width: 1024px)
        and (max-height: 1366px) {
        width: 48%;
      }
      /** iPad 横向き */
      @media screen
        and (max-width: 1024px)
        and (max-height: 768px) {
        width: 31.33%;
      }
      @media screen
        and (max-width: 414px) {
        width: 47.8%;
      }
      @media screen
        and (max-width: 375px) {
        width: 98%;
      }
    }
  }

  .paginate_links {
    text-align: center;
    color: #8a8a8a;
    list-style: none;
    font-size: xx-large;
    padding-inline-start: 0px;
    margin-block-start: 0em;
    user-select: none;
  }

  .paginate_hidden {
    display: none;
  }

  .topButton-enter-active,
  .topButton-leave-active {
    transition: opacity .5s
  }

  .topButton-enter,
  .topButton-leave-to {
    opacity: 0;
  }
}
</style>
<template>
  <transition appear>
    <div class="photo-list">
      <paginate class="paginate" name="paginate-log" :list="photos" :per="6">
        <Photo
          class="grid__item"
          v-for="photo in paginated('paginate-log')"
          :key="photo.id"
          :item="photo"
          @like="onLikeClick"
        />
      </paginate>
      <paginate-links for="paginate-log" class="pagination" :show-step-links="true" />
    </div>
  </transition>
</template>

<script>
import { OK } from '../util'
import Photo from '../components/Photo.vue'

export default {
  components: {
    Photo,
  },
  props: {
    page: {
      type: Number,
      required: false,
      default: 1
    }
  },
  data () {
    return {
      photos: [],
      paginate: ['paginate-log'],
      currentPage: 0,
      lastPage: 0
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
      this.currentPage = response.data.current_page
      this.lastPage = response.data.last_page
    },
    onLikeClick ({ id, liked }) {
      if (! this.$store.getters['auth/check']) {
        alert('いいね機能を使うにはログインしてください。')
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
.paginate {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding-inline-start: 0px;

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

    /** iPone6,7,8,10 縦向き */
    @media screen
      and (max-width: 375px) {
      width: 98%;
    }
  }
}

.pagination {
  text-align: center;
  color: #8a8a8a;
  list-style: none;
  font-size: xx-large;
  margin-block-start: 0.5rem;
  margin-block-end: 0.5rem;
  padding-inline-start: 0px;

  & :nth-child(1n) {
    cursor: pointer;
    display: inline-block;
    margin: 0 2%;

    &:hover {
      color: black;
    }
  }
}
.v-enter-active, .v-leave-active {
  transition: opacity .5s
}

.v-enter, .v-leave-to {
  opacity: 0;
}
</style>
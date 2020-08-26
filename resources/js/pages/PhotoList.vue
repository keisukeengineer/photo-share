<template>
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
    <paginate-links
      for="paginate-log"
      class="paginate_links"
      :class="{'paginate_hidden': photos[0] === undefined}"
      :show-step-links="true"
    />
    <transition name="topButton">
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
</template>

<script>
import { OK } from '../util'
import Photo from '../components/Photo.vue'
export default {
  components: {
    Photo,
  },
  data () {
    return {
      photos: [],
      paginate: ['paginate-log'],
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
    },
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
@import '../../sass/_mixin';

.photo-list {
  margin-top: 9rem;

  @media screen
    and (max-width: 375px) {
    height: 123rem;
    margin-top: 1rem;
  }

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

  .button--link {
    position: fixed;
    right: 1rem;
    bottom: 7rem;
    @include button__link;

    &:hover {
      border-color: black;
    }
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
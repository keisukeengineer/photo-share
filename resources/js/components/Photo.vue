<template>
  <li class="photo">
    <figure class="photo__wrapper">
      <transition appear>
        <img
          class="photo__image"
          :src="item.url"
          :alt="`Photo by ${item.owner.name}`"
        >
      </transition>
    </figure>
    <RouterLink
      class="photo__overlay"
      :to="`/photos/${item.id}`"
      :title="`View the photo by ${item.owner.name}`"
    >
      <div class="photo__controls">
        <button
          class="photo__action photo__action--like"
          :class="{ 'photo__action--liked': item.liked_by_user }"
          title="Like photo"
          @click.prevent="like"
        >
          <i class="icon ion-md-heart" />{{ item.likes_count }}
        </button>
        <a
          class="photo__action"
          title="Download photo"
          @click.stop
          :href="`/photos/${item.id}/download`"
        >
          <i class="icon ion-md-arrow-round-down"></i>
        </a>
      </div>
      <div class="photo__username">
        {{ item.owner.name }}
      </div>
    </RouterLink>
  </li>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  methods: {
    like () {
      this.$emit('like', {
        id: this.item.id,
        liked: this.item.liked_by_user
      })
    }
  }
}
</script>

<style scoped lang="scss">
.photo {
  width: 15rem;
  margin: 1%;

  .v-enter-active, .v-leave-active {
    transition: opacity .8s
  }

  .v-enter, .v-leave-to {
    opacity: 0;
  }
}
</style>
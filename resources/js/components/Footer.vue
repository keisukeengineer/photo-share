<template>
  <footer class="footer">
    <div class="share_wrapper">
      <div
        class="share_wrapper_sub cursor"
        @click="onShareClick('twitter')"
      >
        <i class="fa fa-twitter fa-2x share_wrapper_sub_item" />
      </div>
      <div
        class="share_wrapper_sub cursor"
        @click="onShareClick('facebook')"
      >
        <i class="fa fa-facebook fa-2x share_wrapper_sub_item" />
      </div>
    </div>
    <div class="copyright">©︎ 2020 PhotoShare</div>
  </footer>
</template>

<script>
export default {
  methods: {
    onShareClick(shareButton) {
      if(shareButton === 'twitter') {
        this.twitter()
      } else {
        this.facebook()
      }
    },
    twitter() {
      window.open(`https://twitter.com/intent/tweet?url=${location.href}&text=`, '_blank')
    },
    facebook() {
      window.open(`https://www.facebook.com/sharer/sharer.php?u=${location.href}`, '_blank')
    }
  }
}
</script>

<style scoped lang="scss">
@import '../../sass/_mixin';

.footer {
  position: fixed;
  flex-direction: column;
  bottom: 0%;
  width: 100%;
  height: 6rem;
  background: white;

  @media screen and (max-height: 414px) {
    height: 4rem;
    flex-direction: row;
  }

  .copyright {
    color: #8a8a8a;
    padding: .5rem 0;

    @media screen and (max-height: 414px) {
      order: -1;
    }
  }

  .share_wrapper {
    display: inline-block;
    padding: .5rem 0;

    @media screen and (max-height: 414px) {
      position: absolute;
      right: 1rem;
    }

    &_sub {
      display: inline-block;

      &_item {
        margin: 0 1rem;
        color: #8a8a8a;
        transition: color .3s ease-in-out;

        &:hover {
          color: black;
        }
      }
    }
  }
}
</style>
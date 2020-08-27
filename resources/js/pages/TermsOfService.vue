<template>
  <div class="terms_of_service">
    <h1 id="theme">Photo Share Terms of Use</h1>
    <h2 class="item">1. Purpose</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">2. Resister</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">3. Security</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">4. Login account</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">5. Privacy</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">6. About Use</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">7. Disclaimer</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">8. Right</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">9. Prohibited matter</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">10. Unsubscribed</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">11. Changes to this agreement</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">12. Contact Us</h2>
    <div class="item_contents">
      If you have any questions, please contact us using the form&nbsp;
      <RouterLink to="/contact">here</RouterLink>
    </div>
  </div>
</template>

<style scoped lang="scss">
.terms_of_service {
  color: inherit;
  padding: .5rem 2rem;
  animation: page 1s forwards;

  @keyframes page {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }

  #theme {
    padding: .5rem 0;
    margin-bottom: 2.5rem;
    border-top: 1rem solid rgb(175, 169, 169);
    border-bottom: 1rem solid rgb(175, 169, 169);

    @media screen and (max-width: 375px) {
      font-size: 1.8rem;
    }
  }
  .item {
    @media screen and (max-width: 375px) {
      font-size: 1.3rem;
    }

    &_contents {
      padding-left: 1rem;
      padding-bottom: 1rem;
    }
  }
}
</style>
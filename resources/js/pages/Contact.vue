<template>
  <div id="contact-us">
    <h1 id="theme">Contact Us</h1>
    <div id="contact-us_first_contents">
      For any inquiries such as opinions and requests, please use the form below.
    </div>
    <div class="panel">
      <form class="form" @submit.prevent="login">
        <label for="title">Title</label>
        <select
          class="form__item"
          id="title"
          v-model="contactForm.selected"
        >
          <option
            v-for="title in contactForm.titles"
            :value="title.value"
            :key="title.id"
          >
            {{ title.value }}
          </option>
        </select>
        <label for="email">Email</label>
        <input
          type="email"
          class="form__item"
          id="email"
          v-model="contactForm.email"
          v-model.trim="contactForm.email"
          @keyup.esc="clear_email"
        >
        <label for="email-confirmation">Email (confirm)</label>
        <input
          type="email"
          class="form__item"
          id="email-confirmation"
          v-model="contactForm.emailConfirmation"
          v-model.trim="contactForm.emailConfirmation"
          @keyup.esc="clear_email_confirmation"
        >
        <label for="contents">Contents of inquiry</label>
        <textarea
          class="form__item"
          id="contents"
          rows="4"
          v-model="contactForm.contents"
          v-model.trim="contactForm.contents"
          @keyup.esc="clear_contents"
        />
        <div class="form__button">
          <button type="submit" class="button-square-shadow cursor">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      contactForm: {
        selected: 'Contact us',
        titles:[
          {
            id: 1,
            value: 'Contact us'
          },
          {
            id: 2,
            value: 'Report problematic comments'
          },
          {
            id: 3, value: 'Report problematic photos'
          },
          {
            id: 4,
            value: 'Function improvement request'
          }
        ],
        email: '',
        emailConfirmation: '',
        contents: ''
      },
    }
  },
  methods: {
    clear_title() {
      this.contactForm.title = '';
    },
    clear_email() {
      this.contactForm.email = '';
    },
    clear_email_confirmation() {
      this.contactForm.emailConfirmation = '';
    },
    clear_contents() {
      this.contactForm.contents = '';
    },
  }
}
</script>

<style scoped lang="scss">
#contact-us {
  color: inherit;
  padding: .5rem 2rem;
  animation: page 1s forwards;

  @keyframes page {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }

  #theme {
    text-align: center;
    padding: .5rem 0;
    margin-bottom: 2.5rem;
    border-top: 1rem solid rgb(175, 169, 169);
    border-bottom: 1rem solid rgb(175, 169, 169);

    @media screen and (max-width: 375px) {
      font-size: 1.8rem;
    }
  }

  &_first_contents {
    text-align: center;
     margin-bottom: 2rem;
  }
}
</style>
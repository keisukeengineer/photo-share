<template>
  <div id="terms-of-service">
    <h1 id="theme">Photo Share Terms of Use</h1>
    <div id="terms-of-service_first_contents">
      Regarding the use of Photo Share, the following terms of use are established.
    </div>
    <h2 class="item">1. Purpose</h2>
    <div class="item_contents">
      Photo Share aims to inspire each other by sharing the photos posted by users.
    </div>
    <h2 class="item">2. Resister</h2>
    <div class="item_contents">
      We may differ in the services provided in Tabelog from customers who are not 
      Photo Share members or who have not completed the member registration procedures prescribed by us.
    </div>
    <h2 class="item">3. Security</h2>
    <div class="item_contents">
      Photo Share membership registration uses SSL (Secure Socket Layer), which is the most 
      reliable encryption communication technology on the Internet, and the information 
      transmitted is encrypted so that it cannot be seen by a third party.
    </div>
    <h2 class="item">4. Login account</h2>
    <div class="item_contents">
      You are responsible for the registration and management of login accounts and passwords 
      at your own risk. Insufficient management of customers, errors in use, and the use of third parties. 
      The Company shall not be liable for any damages resulting from such reasons.
    </div>
    <h2 class="item">5. Privacy</h2>
    <div class="item_contents">
      <div class="privacy-item">
        <div class="privacy-item_first_contents">Handling of personal information</div>
        <div class="privacy-item-theme">[1] purpose of use</div>
        <div class="privacy-item_contents">
          To promote the use of our services, such as creating statistical data after processing it into 
          a format that cannot identify individuals
        </div>
        <div class="privacy-item_contents">
          To contact customers as necessary regarding eating logs
        </div>
      </div>
      <div class="privacy-item">
        <div class="privacy-item-theme">[2] Third party provided</div>
        <div class="privacy-item_contents">
          When there is customer consent
        </div>
        <div class="privacy-item_contents">
          When disclosing or providing as statistical data without being able to identify the customer
        </div>
        <div class="privacy-item_contents">
          When required by law
        </div>
        <div class="privacy-item_contents">
          When it is necessary to protect human life, body or property, and it is difficult to obtain 
          the customer's consent
        </div>
        <div class="privacy-item_contents">
          When it is difficult to obtain the customer's consent when there is a particular need for 
          improving public health or promoting the healthy development of children
        </div>
      </div>
      <div class="privacy-item">
        <div class="privacy-item-theme">[3] Subcontracting</div>
        <div class="privacy-item_contents">
          The Company may entrust all or part of the handling of personal information acquired to 
          the extent necessary for the above purposes after taking necessary protective measures.
        </div>
      </div>
      <div class="privacy-item">
        <div class="privacy-item-theme">[4] Disclosure, correction/deletion, suspension of use, etc.</div>
        <div class="privacy-item_contents">
          If the customer requests, discloses, corrects/adds/deletes, suspends or deletes the purpose of 
          use of his/her personal information, he/she will receive it by the method specified in “4. 
          Regarding the handling of personal information”. I will do it.
        </div>
      </div>
      <div class="privacy-item">
        <div class="privacy-item-theme">[5] Other</div>
        <div class="privacy-item_contents">
          Please understand that if you do not fill in all the items, all or part of Photo Share services 
          may not be available.
        </div>
      </div>

    </div>
    <h2 class="item">6. About Use</h2>
    <div class="item_contents">
      <div class="use-item">
        <div class="use-item-theme">[1] Prohibition of diversion/resale</div>
        <div class="use-item_contents">
          The customer shall not use or access Photo Share services provided by the Company, in whole or in part, 
          for the purpose of business activities or other profit-promoting activities or activities equivalent 
          thereto or preparation activities therefor. I shall. In addition, we shall not use or access for 
          the purpose of religious activities or political activities.
        </div>
        <div class="use-item_contents">
          Unauthorized reproduction or unauthorized use of the reviews posted on Photo Share is prohibited. 
          However, the person who made the posting is excluded.
        </div>
      </div>
      <div class="use-item">
        <div class="use-item-theme">[2] Change / stop</div>
        <div class="use-item_contents">
          We may change the tabelog provided to our customers for our convenience. Please note that Photo Share services 
          may be stopped in the event of a disaster, accident, or other emergency. In addition, even if the customer 
          or a third party is damaged by changing or stopping the eating log without obtaining the customer's consent 
          in advance, we will not compensate at all.
        </div>
      </div>
      <div class="use-item">
        <div class="use-item-theme">[3] Equipment required for use</div>
        <div class="use-item_contents">
          In order for customers to use Photo Share services, it is necessary to access the web. Regarding access to the web, 
          the customer is required to properly prepare and operate the necessary equipment and software at 
          his own responsibility and cost. We are not involved at all.
        </div>
      </div>
    </div>
    <h2 class="item">7. Disclaimer</h2>
    <div class="item_contents">
      We do not guarantee any information about the photos posted. In addition, we will not compensate or be involved in 
      any damages caused to customers by the information on the posted photos or troubles between customers.
    </div>
    <h2 class="item">8. Right</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">9. Prohibited matter</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">10. Unsubscribed</h2>
    <div class="item_contents">nothing yet</div>
    <h2 class="item">11. Contact Us</h2>
    <div class="item_contents">
      If you have any questions, please contact us using the form&nbsp;
      <RouterLink to="/contact">here</RouterLink>
    </div>
  </div>
</template>

<style scoped lang="scss">
#terms-of-service {
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

  &_first_contents {
    margin-bottom: 2rem;
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

      .privacy-item {
        padding-bottom: 1rem;

        &-theme {
          font-weight: bold;
        }

        &_first_contents {
          padding-bottom: 1rem;
        }

        &_contents {
          padding-top: 1rem;
        }
      }

      .use-item {
        padding-bottom: 1rem;

        &-theme {
          font-weight: bold;
        }

        &_contents {
          padding-top: 1rem;
        }
      }
    }
  }
}
</style>
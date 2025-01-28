
// This is your test publishable API key.
const stripe = Stripe("pk_test_51KWcAIDbMv7unvikoFgclXkYDnZ6SavPERJDJIwKxqQR7ZE8dXlOANc4RmThwr2sPsZiNPXDA6mm9zpZKebKJ8C600l8n3UdTD");

// The items the customer wants to buy
const items = '';
let elements;

document
  .querySelector("#payment-form")
  .addEventListener("submit", handleSubmit);

var emailAddress = '';
// Fetches a payment intent and captures the client secret
async function initializeStripePayment(orderDetails) {
  await fetch("/stripe/createPaymentIntent", {
    method: "POST",
    headers: {"Content-Type": "application/json", 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
    body: JSON.stringify({ orderDetails }),
  })
  .then((r) => r.json())
  .then(function(r){
    console.log(r)
    const clientSecret = r.clientSecret;
    elements = stripe.elements( {clientSecret} );

    const linkAuthenticationElement = elements.create("linkAuthentication");
          linkAuthenticationElement.mount("#link-authentication-element");
    emailAddress = r.orderDetails.email;
    const paymentElementOptions = {
      layout: "tabs",
      defaultValues:{
        billingDetails:{
          email: r.orderDetails.email
        }
      }
      
    };

    const paymentElement = elements.create("payment", paymentElementOptions);
          paymentElement.mount("#payment-element");
          
  });

  
}

async function initializeMoneyOrder(orderDetails) {
  await fetch("/cart/initializeMoneyOrder", {
    method: "POST",
    headers: {"Content-Type": "application/json", 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
    body: JSON.stringify({ orderDetails }),
  })
  .then((r) => r.json())
  .then(function(r){
    if(r.success==true){
      setTimeout(function(){
        window.location.href = '/cos/comanda-plasata.html';
      }, 1000)
    }
  })
  .catch(error => {
    const loader = document.querySelector('.loader')
    const btn = document.getElementsByClassName('placeOrder')
    let t = gsap.timeline()
        t.to(loader, {duration:0.3, autoAlpha:0})
        t.to(btn, {duration:0.3, autoAlpha:1})
        processError('A intervenit o eroare la plasarea comenzii. Reîncarcă pagina și încearcă din nou.')
  })

  
}



async function handleSubmit(e) {
  e.preventDefault();
  setLoading(true);

  //is success, go straight to redirect, else process error
  const { error } = await stripe.confirmPayment({
    elements,
    confirmParams: {
      return_url: "http://127.0.0.1:8000/cos/comanda-plasata.html",
      receipt_email: emailAddress,
    },
  });
  
  if (error.type === "card_error") {
    processStripeCardErrors(error);
  }
  registerAPIResponse('/stripe/registerAPIResponse', error)
  setLoading(false);
}

// Fetches the payment intent status after payment submission


// Show a spinner on payment submission
function setLoading(isLoading) {
    const loader = document.querySelector('.loader.stripePayLoader')
    const btn = document.querySelector('.stripePayBtn')
    let t = gsap.timeline()
    if (isLoading) {
        document.querySelector("#submit").disabled = true;
            t.to(btn, {duration:0.3, autoAlpha:0})
            t.to(loader, {duration:0.3, autoAlpha:1})
    } else {
        document.querySelector("#submit").disabled = false;
            t.to(btn, {duration:0.3, autoAlpha:1})
            t.to(loader, {duration:0.3, autoAlpha:0})
    }
}


function processError(errorMessage){
   
  let errorField = `<p>${errorMessage}</p>`;
      let modalHold = document.querySelector('.messages-modal');
      let modalElement = document.querySelector('.messagesHold');
          modalElement.innerHTML = '';
          modalElement.classList.add('errorMessages');
          modalElement.classList.remove('successMessages')
          modalElement.insertAdjacentHTML('beforeend', errorField);

      let t = gsap.timeline();
          t.set(modalHold, {display:'block'})
          t.to(modalHold, {duration:0.3, autoAlpha:1})
}

async function registerAPIResponse(endpoint, data){
  try {
      var fetchResponse = await fetch(endpoint, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
        body: JSON.stringify(data),
      })
      const responseData = await fetchResponse.json();
      return responseData;
  }catch(error){
      console.log(error)
  }
}

function processStripeCardErrors(errorResponse){
  switch (errorResponse.code) {
    case 'card_declined':
      switch (errorResponse.decline_code) {
        case 'generic_decline':
          processError('Cardul tău a fost refuzat.');
        break;
        case 'card_not_supported':
          processError('Acest card nu este suportat in România.');
        break;
        
        case 'insufficient_funds':
          processError('Fonduri insuficiente pe card.');
        break;

        case 'lost_card':
          processError('Acest card figurează ca și pierdut. Contactează banca ta pentru mai multe detalii.');
        break;

        case 'stolen_card':
          processError('Acest card figurează ca și furat. Contactează banca ta pentru mai multe detalii.');
        break;
      
        default:
          break;
      }
    break;
  
    case 'expired_card':
      processError('Acest card a expirat.');
    break;
    
    case 'incorrect_cvc':
      processError('CVV gresit.');
    break;

    case 'processing_error':
      processError('Eroare la procesarea plății. Reîncarcă pagina și încearcă din nou.');
    break;

    case 'incorrect_number':
      processError('Numărul de card este greșit.');
    break;
    

    default:
      break;
  }
  
  
}
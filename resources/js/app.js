import { gsap, Power2 } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger.js';
        gsap.registerPlugin(ScrollTrigger)
import Swiper from 'swiper/bundle';
import { validateForms } from '../js/validators';
import { productOperations } from './addProduct';
import { getDropzoneObject } from './addProduct';
import { getSwiperObject } from './addProduct';
import * as echarts from 'echarts';

function pxToVw(px) {
    const viewport = window.innerWidth;
    const vw = px / (viewport / 100);
    return vw;
}

const smoothScrollToDiv = (divId, offset = 0) => {
    const targetDiv = document.getElementById(divId);
    if (targetDiv) {
      const targetPosition = targetDiv.offsetTop - offset;
      window.scrollTo({
        top: targetPosition,
        behavior: 'smooth',
      });
    }
};
export { smoothScrollToDiv };

//functionalitati snackbar
let newPosition = 0;
let currentPosition = 0;
let item = 1;

const showSnackbar = function(message, timeout = 600, type = 'error') {
  let snackbarElement = `<div class='snackbar-element ${type}-snackbar snack-${item}'>
                            <div class='close-snackbar'><img src="/backend/locomotif/img/close.svg"></div>
                            <div class='snackbar-message'>
                                <p>${message}</p>
                            </div>
                        </div>`;
  let snackbar = document.querySelector('.snackbar');
  snackbar.insertAdjacentHTML('beforeend', snackbarElement);
  let targetSnackbar = document.querySelector('.snack-' + item);
  gsap.fromTo(targetSnackbar, { y: '-' + newPosition + 'vw' }, { y: '-' + newPosition + 'vw', autoAlpha: 1, duration: 0.3, ease: "power1.easeOut" });
  item = item + 1;
  setTimeout(function () {
    let disappear = newPosition + 4;
    gsap.to(targetSnackbar, { y: '-' + disappear + 'vw', autoAlpha: 0, duration: 0.3, ease: "power1.easeOut", onComplete: function () {
      targetSnackbar.remove();
    } });
  }, timeout);
};

const deleteSnackbar = function (snackbarElement) {
  let height = snackbarElement.offsetHeight;
  let heightInVw = pxToVw(height);
  heightInVw = heightInVw + 0.8234987; //height in vw + margin-bottom
  newPosition = newPosition + heightInVw;
  let t = gsap.timeline();
  t.to(snackbarElement, { y: '-' + newPosition + 'vw', autoAlpha: 0, duration: 0.3, ease: "power1.easeOut" });
  currentPosition = newPosition;
};

export { showSnackbar, deleteSnackbar };
//functionalitati snackbar


async function updateDeleteCartSession(endpoint, data){
    var fetchResponse = await fetch(endpoint, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
        body: JSON.stringify(data),
    })
    const responseData = await fetchResponse.json();
    return responseData;
}

function initMobileMenu(){
    let toggle = false;
    let mainMenuLinks = gsap.utils.toArray('.main-menu-hold-column')
    let mainMenuHeight = document.querySelector('.site-menu').offsetHeight;
    let menu = gsap.timeline({paused:true})
        menu.to('.main-menu', {autoAlpha:1, top:mainMenuHeight, duration:0.6})
        menu.to(mainMenuLinks, {
            autoAlpha:1,
            duration:0.3,
            stagger:{
                each:0.05
            }
        }, '>-0.1')

    document.querySelector('.hamburger').addEventListener('click', function(e){
        e.preventDefault();
        this.classList.toggle('is-active')
        if(!toggle){
            menu.play();
        }else{
            menu.reverse();
        }
        toggle = !toggle;
    })

    let submenuList = document.querySelectorAll('.main-menu .main-menu-hold-column h2');
        submenuList.forEach(submenuElement => {
            submenuElement.addEventListener('click', function(e){
                e.preventDefault();
                let subMenu = e.target.nextElementSibling;
                const isOpen = subMenu.style.height === 'auto';
                let subMenuElements = e.target.nextElementSibling.querySelectorAll('ul li');
                let subMenuAnimation = gsap.timeline({paused:false})

                if (isOpen) {
                    subMenuAnimation.to(subMenu, {
                        height: 0,
                        marginTop:0,
                        overflow: 'hidden',
                        duration: 0.6,
                        ease: Power2.easeInOut
                    })
                    subMenuAnimation.to(subMenuElements, {
                        autoAlpha: 0,
                        duration: 0.6,
                        ease: Power2.easeInOut,
                        stagger: {
                            each: 0.1,
                        }
                    }, '>-0.6')
                }else{
                    subMenuAnimation.to(subMenu, {
                        height: 'auto',
                        overflow: 'auto',
                        marginTop: '12px',
                        duration: 0.6,
                        ease: Power2.easeInOut
                    })
                    subMenuAnimation.to(subMenuElements, {
                        autoAlpha: 1,
                        duration: 0.6,
                        ease: Power2.easeInOut,
                        stagger: {
                            each: 0.1,
                        }
                    }, '>-0.6')
                }
            })
        });
}

function initDesktopMenu(){
    let toggle = false;
    let submenuToggle = false;
    let submenuAnim;
    let mainMenuLinks = gsap.utils.toArray('.main-menu-hold-column > ul > li')
    let menu = gsap.timeline({paused:true})
        menu.to('.main-menu', {autoAlpha:1, yPercent:'130', duration:0.6})
        menu.to(mainMenuLinks, {
            autoAlpha:1,
            duration:0.3,
            stagger:{
                each:0.05
            }
        }, '>-0.1')
    document.querySelector('.hamburger').addEventListener('click', function(e){
        e.preventDefault();
        this.classList.toggle('is-active')
        if(!toggle){
            menu.play();
        }else{
            if(submenuToggle==true){
                setTimeout(function(){
                    menu.reverse();
                }, 350)
                submenuAnim.reverse()
            }else{
                menu.reverse();
            }

        }
        toggle = !toggle;

    })


    let submenuList = document.querySelectorAll('li.has-children > a');
        submenuList.forEach(submenuElement => {
            submenuElement.addEventListener('click', function(e){
                submenuToggle = true;
                e.preventDefault();
                let subMenu = e.target.nextElementSibling;
                let subMenuElements = e.target.nextElementSibling.querySelectorAll('ul li');
                let subMenuAnimation = gsap.timeline({paused:false})
                    subMenuAnimation.to('.main-menu-hold', {xPercent:'100', duration:0.6, ease: Power2.easeInOut})
                    subMenuAnimation.to(subMenu, {xPercent:'-200', duration:0.6, ease: Power2.easeInOut}, '>-0.5')
                    subMenuAnimation.to(subMenu, {autoAlpha:1, duration:0.6, ease: Power2.easeInOut}, '>-0.4')
                    subMenuAnimation.to(subMenuElements, {autoAlpha:1, xPercent:'-5', duration:0.3, ease: Power2.easeInOut,
                        stagger:{
                            each:0.1,
                        }
                    }, '>-0.6')
                submenuAnim = subMenuAnimation;
                let backSubmenus = document.querySelectorAll('.backLevel');
                    backSubmenus.forEach(backElement => {
                        backElement.addEventListener('click', function(e){
                            subMenuAnimation.reverse()
                            submenuToggle = false;
                        })
                    });
            })
        });
}
function initSiteMenu(){
    if(window.innerWidth < 1080){
        initMobileMenu();
    }else{
        initDesktopMenu();
    }
    ScrollTrigger.create({
        trigger: '#compensator',
        start: 'center top',
        markers:false,
        onEnter: (self) => {
            document.querySelector("#site-menu").classList.add("is-sticky");
            document.querySelector(".offcanvas-section").classList.add("compensateMenu");
        },
        onEnterBack:(self) => {
            document.querySelector("#site-menu").classList.remove("is-sticky");
            document.querySelector(".offcanvas-section").classList.remove("compensateMenu");
        }
    })
}

function initSearchToggle(){
    //block scope
    {
        let toggle = false;
        let input = document.getElementById('search')
        let inputHold = document.querySelector('.search-hold');
        let searchToggle = document.querySelector('.search-toggle');
        let searchBtn = document.getElementById('searchSubmit')

        let t = gsap.timeline({paused:true})
            t.addLabel('concurrent')
            t.to(inputHold, {autoAlpha:1, width:'100%', duration:0.3}, 'concurrent')
            t.to(input, {autoAlpha:1, width:'100%', duration:0.3}, 'concurrent')
            t.to(searchToggle, {autoAlpha:0, pointerEvents:'none', duration:0.3}, 'concurrent')
            t.to(searchBtn, {autoAlpha:1, pointerEvents:'all', duration:0.3}, 'concurrent')


        document.querySelector('.search-toggle').addEventListener('click', function(e){
            e.preventDefault();
            if(!toggle){
                t.play();
            }else{
                t.reverse();
            }
            toggle = !toggle;
        })
    }
}

function initHomepageProductsSlider(){
    var swiper = new Swiper('.homepage-products', {
        slidesPerView: 4,
        // spaceBetween:30,
        scrollbar: {
          el: '.swiper-scrollbar',
          hide: false,
          dragSize: 70,
          draggable: true,
          snapOnRelease:true
        },
    });
}

function initRecommendedProductsSlider(){
    var swiper = new Swiper('.product-detail-recommended-products', {
        slidesPerView: 4,
        // spaceBetween:30,
        scrollbar: {
          el: '.swiper-scrollbar',
          hide: false,
          dragSize: 70,
          draggable: true,
          snapOnRelease:true
        },
    });
}

function initTopDesignerProducts(){
    var swiper = new Swiper('.designer-top-products', {
        slidesPerView: 4,
        // spaceBetween:30,
        scrollbar: {
          el: '.swiper-scrollbar',
          hide: false,
          dragSize: 70,
          draggable: true,
          snapOnRelease:true
        },
    });
}



function initHomepageDesignersSlider(){
    var swiper = new Swiper('.homepage-designers', {
        slidesPerView: 6,
    });
}

function setFAQTabs(){
    let tabElements = document.querySelectorAll('.faq-element');
        tabElements.forEach(function(value, index){
            let t = gsap.timeline({paused: true, reversed:true})
                t.addLabel('concurrent')
                t.to(value.querySelector('.faq-content'), {height:'auto', duration: 0.6, ease: Power2.easeInOut}, 'concurrent')
                t.to(value.querySelector('span'), {rotation: 180, duration: 0.6, ease: Power2.easeInOut}, 'concurrent')
            value.addEventListener('click', function(){
                if (t.reversed()) { t.play(); } else { t.reverse(); }
            })
        })
}

function handleDeletePrompt(data){
    let errorField = `
        <p class='errorInput'>Ești sigur că vrei să ștergi acest element?</p>
        <div class='separator-space'></div>
        <div class="double-btn-hold">
            <div class="btn-hold">
                <a href="" class="general-btn handlePrompt" data-answer='true'>Da</a>
            </div>
            <div class="btn-hold">
                <a href="" class="general-btn transparent-btn handlePrompt" data-answer='false'>Nu</a>
            </div>
        </div>
    `;
    let modalHold = document.querySelector('.messages-modal');
    let modalElement = document.querySelector('.messagesHold');
        modalElement.innerHTML = '';
        modalElement.insertAdjacentHTML('beforeend', errorField);

    let t = gsap.timeline();
        t.set(modalHold, {display:'block'})
        t.to(modalHold, {duration:0.3, autoAlpha:1})

    const handlePromptBtns = document.querySelectorAll('.handlePrompt');
    handlePromptBtns.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            let answer = e.target.dataset.answer;
            if(answer=='true'){
                t.to(modalHold, {duration:0.3, autoAlpha:0,
                    onComplete:function(){
                        generalFetchRequest(e.target, '/deleteAccountAddress', 'POST', data)
                    }
                })
                t.set(modalHold, {display:'none'})
            }else{
                t.to(modalHold, {duration:0.3, autoAlpha:0})
                t.set(modalHold, {display:'non'})
            }

        });
    });
}

function setFAQTabsContent(){
    let tabsControls = document.querySelectorAll('.tags-hold ul li')
    let tabs = document.querySelectorAll('.tab-content');
    let tabHeights = [];
    let t = gsap.timeline();

    tabs.forEach(function(value, index){
        tabHeights.push(value.offsetHeight);
        if(index!=0){
            value.style.position='absolute';
        }
    })

    tabsControls.forEach(function(value, index){
        value.addEventListener('click', function(e){
            e.preventDefault();
            let tab = this.dataset.tab;
                Array.from(tabsControls).forEach(function(el) {
                    el.classList.remove('active-faq');
                });
                this.classList.add("active-faq");
            switchFAQTab(tab)
        })
    })

    function switchFAQTab(tab){
        const height = tabHeights[tab];
        const parent = document.querySelector('.faq-tabs')
        const restOfTabs = Array.from(tabs).filter(element => !element.classList.contains('tab-content-'+tab));
        const openTab = document.querySelector('.tab-content-'+tab);

        t.to(restOfTabs, {autoAlpha:0, height: 0, stagger:0})
        t.set(openTab, {position:'relative'})
        t.set(restOfTabs, {position:'absolute', stagger:0})
        t.to(parent, {height:height, duration:0.3})
        t.to(openTab, {autoAlpha:1, height:'auto', duration:0.3})
        t.set(parent, {height:'auto'})
    }
}

function setAccountTabsContent(){
    let tabsControls = document.querySelectorAll('.account-btn-switch label')
    let t = gsap.timeline();

    tabsControls.forEach(function(value, index){
        value.addEventListener('click', function(e){
            e.preventDefault();
            let tab = this.dataset.tab;
            this.nextElementSibling.checked = true
                Array.from(tabsControls).forEach(function(el) {
                    el.classList.remove('active-account-tab');
                });
                this.classList.add("active-account-tab");
            switchAccountTab(tab)
        })
    })

    function switchAccountTab(tab){
        if(tab=='fizica'){
            t.to(document.querySelector('.juridica'), {autoAlpha:0, height: 0})
        }else{
            t.to(document.querySelector('.'+tab), {autoAlpha:1, height: 'auto'})
        }

    }
}

function modalControl(){

    //Close/open modal btns
    let closeBtns = document.querySelectorAll('.close-modal');
    closeBtns.forEach(function(value, index){
        value.addEventListener('click', function(e){
            e.preventDefault();
            let modal = this.parentElement.parentElement;
            let t = gsap.timeline();
                t.to(modal, {autoAlpha:0})
                t.set(modal, {display:'none'})
        })
    });

    //Close/open modal btns

}
function accountEvents(){
    document.querySelector('.update-profile').addEventListener('click', function(e){
        e.preventDefault();
        let modal = document.querySelector('.update-profile-modal');
        let t = gsap.timeline();
            t.set(modal, {display:'block'})
            t.to(modal, {autoAlpha:1})
    })
    document.querySelector('.add-delivery-address').addEventListener('click', function(e){
        e.preventDefault();
        let modal = document.querySelector('.delivery-address-modal');
        let t = gsap.timeline();
            t.set(modal, {display:'block'})
            t.to(modal, {autoAlpha:1})
    })

    const deleteAddressesBtns = document.querySelectorAll('.stergeAdresa');
    const addressesBtns = document.querySelectorAll('.editDeliveryAddress');

    addressesBtns.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            let modal = document.querySelector('.update-delivery-address-modal');
            let address_id = e.target.dataset.addressid;
                document.querySelector('#address_id').value = address_id;
                let data = {address_id:address_id};
                generalFetchRequest(e.target, '/getAccountAddress', 'POST', data)
                .then(() => {
                    let t = gsap.timeline();
                        t.set(modal, {display:'block'})
                        t.to(modal, {autoAlpha:1})
                  })
                  .catch(error => {
                    console.log(error);
                  });

        });
    });

    deleteAddressesBtns.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            let data = {address_id:e.target.dataset.addressid};
            handleDeletePrompt(data);
        });
    });


}
function offcanvasModal(){
    var cartMenu = document.querySelector(".has-elements-in-cart");
    var offcanvasElement = document.querySelector(".offcanvas-section");
    var closeOffCanvas = document.querySelector('.offcanvas-close');

    if(document.querySelectorAll('.blockOffcanvas').length > 0){
    }else{
        cartMenu.addEventListener("click", (e)=>{
            e.preventDefault()
            gsap.to('.offcanvas-section', {autoAlpha:1, xPercent:'-120', duration:0.6, ease: Power2.easeInOut})
        }, false)

        closeOffCanvas.addEventListener('click', ()=>{
            gsap.to(offcanvasElement, {autoAlpha:0, xPercent:'120', duration:0.6, ease: Power2.easeInOut})
        }, false);

        // offcanvasElement.addEventListener('mouseleave', ()=>{
        //     gsap.to(offcanvasElement, {autoAlpha:0, xPercent:'120', duration:0.6, ease: Power2.easeInOut})
        // }, false);

        document.querySelector('.continue-shopping').addEventListener('click', function(e){
            e.preventDefault();
            gsap.to('.offcanvas-section', {autoAlpha:0, xPercent:'120', duration:0.6, ease: Power2.easeInOut})
        })
    }

}

function buildAddress(response){
    const currentBills = document.querySelectorAll('.billAddress');
    currentBills.forEach(element => {
        element.remove()
    });
    let is_billing = response.is_billing_address;
    let address = `<div class="infos-panel address-${response.id}">
                        ${is_billing==1 ? "<div class='billAddress'><p>Setat ca adresa de facturare</p></div>" : ''}
                        <p><strong>Persoana de contact:</strong> ${response.contact_person}</p>
                        <p><strong>Strada:</strong> ${response.street}</p>
                        <p><strong>Nr.:</strong> ${response.nr}</p>
                        <p><strong>Bloc:</strong> ${response.bloc}</p>
                        <p><strong>Scara:</strong> ${response.scara}</p>
                        <p><strong>Apartament:</strong> ${response.apartament}</p>
                        <p><strong>Oraș:</strong> ${response.city}</p>
                        <p><strong>Județ:</strong> ${response.county}</p>
                        <p><strong>Țara:</strong> ${response.country}</p>
                        <p><strong>Cod poștal:</strong> ${response.zip_code}</p>
                        <p><strong>Detalii adresă:</strong> ${response.comments}</p>
                        <a href="" class="editDeliveryAddress" data-addressid="${response.id}">Editează adresa de livrare</a>
                        <a href="" class="stergeAdresa" data-addressid="${response.id}">Șterge adresa</a>
                    </div>`;
    let addressControl  = document.getElementById('appendAddresses');
        addressControl.insertAdjacentHTML('beforeend', address);
}

export function processError(errors, type){

    if(typeof errors=='object'){
        if(type=='inForm'){

            Object.keys(errors).forEach(key => {
                let errorMessage = (typeof errors[key]=='object') ? errors[key][0] : errors[key];

                document.getElementById(key).classList.add('errorField');
                let inputHold  = document.getElementById(key).parentElement;
                let errorField = `<div class='errorInput'>${errorMessage}</div>`;
                    inputHold.insertAdjacentHTML('beforeend', errorField);
            });
        }else if(type=='display'){
            var errorMessage =``;
            Object.keys(errors).forEach(key => {
                errorMessage += (typeof errors[key]=='object') ? `<p>${errors[key][0]}</p>` : `<p>${errors[key]}</p>`;
            });

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
    }
    // errors.forEach(function(value, index){
    //     console.log(value)
    //     console.log(index)
    // })
}

function showSuccess(messages){
    let msg;
    if(typeof messages=='object'){
        Object.keys(messages).forEach(key => {
            msg = (typeof messages[key]=='object') ? messages[key][0] : messages[key];
            }
    )}else{
        msg = messages;
    }

    let messageField = `<p>${msg}</p>`;
    let modalHold = document.querySelector('.messages-modal');
    let modalElement = document.querySelector('.messagesHold');
        modalElement.innerHTML = '';
        modalElement.classList.add('successMessages');
        modalElement.classList.remove('errorMessages')
        modalElement.insertAdjacentHTML('beforeend', messageField);

    let t = gsap.timeline();
        t.set(modalHold, {display:'block'})
        t.to(modalHold, {duration:0.3, autoAlpha:1})
}

export function processSuccess(data, formID){
    switch (data.type) {
        case 'redirect':
            window.location.href = data.endpoint;
        break;
        case 'snackbar':
            showSnackbar(data.message, 3600, 'success')
        break;
        case 'addressUpdated':
            if(data.returnedResponse.update_is_billing_address=='true'){
                const currentBills = document.querySelectorAll('.billAddress');
                currentBills.forEach(element => {
                    element.remove()
                });
                let editedElement = document.querySelector('.address-'+data.returnedResponse.address_id);
                let billingAddress = `<div class='billAddress'><p>Setat ca adresa de facturare</p></div>`;
                    editedElement.insertAdjacentHTML('beforeend',billingAddress);
            }
            showSnackbar(data.message, 3600, 'error')
        break;
        case 'productAdded':
            showSuccess(data.message);
            document.querySelector('.dynamicParent').innerHTML='';
            let postData = {};
            productOperations(false, '/deleteAllComponentsFromSession', 'POST', postData )
            .then(response=>{
                    let btn = gsap.timeline({onComplete:function(){
                        let deselectBtns = document.querySelectorAll('.ss-deselect')
                            deselectBtns.forEach(deselectBtn => {
                                deselectBtn.click()
                            });
                            setTimeout(function(){
                                document.querySelector('.constructAttrSelectors').innerHTML = '';
                                document.querySelector('.constructValsSelectors').innerHTML = '';
                                gsap.set(document.querySelector('.addComponent'), {duration:0.6, autoAlpha:0})
                                gsap.to(document.querySelector('.addComponent'), {display:'none'})
                            }, 500)
                    }})
                        btn.set(document.querySelector('.deleteAllComponents'), {duration:0.6, autoAlpha:0})
                        btn.to(document.querySelector('.deleteAllComponents'), {display:'none'})
                        let dropzone = getDropzoneObject();
                        let productSwiper = getSwiperObject()
                            dropzone.removeAllFiles(true)
                            productSwiper.removeAllSlides();
                            document.querySelector('.main-img-upload-preview img').src = '/img/prod2.png';

            })
            .catch(error =>{
                console.log(error)
            })
        break;

        case 'addProductToCart':

            const product = data.returnedResponse;

            if(document.getElementsByClassName('cart-nr').length>0){
                document.querySelector('.cart-nr span').innerHTML = data.totalCartProducts;
            }else{
                const cartNr = `<div class='cart-nr'><span>${data.totalCartProducts}</span></div>`
                const node = document.querySelector('.has-elements-in-cart')
                      node.insertAdjacentHTML('beforeend', cartNr);
            }
            if(data.prodExists==true){
                let cartElement = document.querySelector(`div[data-id="${data.returnedResponse.id}"]`)
                    cartElement.querySelector('.quantityInput').value = data.newAmount;

            }else{
                const offcanvasElement = `<div class="cart-element" data-id="${product.id}">
                <div class="cart-product-img-hold">
                    <a href="${product.main_url}" class="cart-product-img">
                        <picture>
                            <source media="(max-width:770px)" srcset="${product.mainImg}">
                            <img src="${product.mainImg}" alt="Cart img: ${product.name}">
                        </picture>
                    </a>
                </div>
                <div class="cart-product-content">
                    <a href="${product.main_url}">${product.name}</a>

                    <div class="cart-product-price">
                        <p><span>${product.price}</span> Lei</p>
                    </div>
                </div>
                <div class="cart-product-detais" data-pid='${product.id}' data-amount='${product.amount}' data-name='${product.name}' data-main_url='${product.main_url}' data-mainimg='${product.mainImg}' data-price='${product.price}'>
                    <div class="delete-cart-element">
                        <svg viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.7559 22C18.2559 22 22.7559 17.5 22.7559 12C22.7559 6.5 18.2559 2 12.7559 2C7.25586 2 2.75586 6.5 2.75586 12C2.75586 17.5 7.25586 22 12.7559 22Z" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.92578 14.83L15.5858 9.16998" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M15.5858 14.83L9.92578 9.16998" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <div class="count-product-quantity">
                        <div class="product-quantity-hold">
                            <div class="amountHandler decrease-number" data-operation='decrease'>-</div>
                            <input type="text" name="quantity[]" class="quantityInput" value="${product.amount}">
                            <div class="amountHandler increase-number" data-operation='increase'>+</div>
                        </div>
                    </div>
                </div>
            </div>`;
            const offcanvasElementHold = document.querySelector('.offcanvas-cart-hold');
                  offcanvasElementHold.insertAdjacentHTML('beforeend', offcanvasElement);
                  if(document.getElementsByClassName('blockOffcanvas').length > 0){
                    document.querySelector('.has-elements-in-cart').classList.remove('blockOffcanvas')
                  }
            }


            offcanvasModal();
            showSnackbar(data.message, 3600, 'success');

            let d = {};
            generalFetchRequest(null, '/recalculateCartSession', 'GET', d)
            .then((resp)=>{
                updateCartFront(resp)
                cartHandlers()
            })
        break;

        case 'orderDetailAdded':
            const success = data.success;
            if(success==true){
                window.location.href = '/cos/checkout.html';
            }
        break;

        case 'standard':
            showSuccess(data.message);
        break;


        default:
            alert('no type of process')
        break;
    }

    if (typeof data.returnedResponse !== 'undefined') {
        switch (data.area) {
                case 'accountDesigner':
                    document.querySelector('.dName').innerHTML    = `<strong>Nume:</strong> ${data.returnedResponse.name}`;
                    document.querySelector('.dSurname').innerHTML = `<strong>Prenume:</strong> ${data.returnedResponse.surname}`;
                    document.querySelector('.dPhone').innerHTML   = `<strong>Telefon:</strong> ${data.returnedResponse.phone}`;
                    document.querySelector('.dDescription').innerHTML   = `<strong>Telefon:</strong> ${data.returnedResponse.description}`;
                break;
                case 'addressAdd':
                    buildAddress(data.returnedResponse)
                break;

            default:
                break;
        }

    }

    if(typeof data.resetForm !==undefined && data.resetForm !=false){
        document.getElementById(formID).reset();
    }

}

export function processForm(btn, endpoint, method, formID, customData = false, customForm = false){
    const submitBtn = btn;
          submitBtn.disabled = true

    const loader = btn.parentElement.querySelector('.loader')


    let t = gsap.timeline()
        t.to(submitBtn, {duration:0.3, autoAlpha:0})
        t.to(loader, {duration:0.3, autoAlpha:1})

    if(customForm==true){
        var formData = new FormData();
            formData = customData;
    }else{
        var form = document.querySelector('#'+formID);
        var formData = new FormData(form);
        const checkboxes = form.querySelectorAll('input[type="checkbox"]');
              checkboxes.forEach(checkbox => {
                    formData.append(checkbox.name, checkbox.checked);
                });
        const radios = form.querySelectorAll('input[type="radio"]');
              radios.forEach(radio => {
                    if(radio.checked){
                        formData.append(radio.name, radio.value);
                    }
                });
    }

    fetch(endpoint, {
        method: method,
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        setTimeout(() => {
            submitBtn.disabled = false;
                    t.to(loader, {duration:0.3, autoAlpha:0})
                    t.to(submitBtn, {duration:0.3, autoAlpha:1})
            if(data.success==true){
                processSuccess(data, formID)
            }else if(data.success==false){
                processError(data.message, data.type)
            }
        }, 1200);
    })
    .catch(error => {
        submitBtn.disabled = false;
        t.to(loader, {duration:0.3, autoAlpha:0})
        t.to(submitBtn, {duration:0.3, autoAlpha:1})
    });
}

export function processData(data){
    if(data.success==true){
        switch (data.type) {
            case 'citySelector':
                let cities = ``;
                    data.data.forEach(function(value, index){
                        cities += `<option value='${value.denumire}'>${value.denumire}</option>`;
                    })
                    let cityInputs = document.querySelectorAll('.changeCity');
                    cityInputs.forEach(function(input){
                        input.innerHTML = '';
                        input.insertAdjacentHTML('beforeend',cities);
                    })

                break;
            case 'addressDeleted':

                let addressTab = document.querySelector('.address-'+data.id)
                let t = gsap.timeline({
                    onComplete:function(){
                        showSnackbar(data.message, 3600, 'error');
                    }
                });
                    t.to(addressTab, {autoAlpha:0, duration:0.3})
                    t.set(addressTab, {display:'none'})
            break;

            case 'appendAddress':

                document.querySelector('#updateDeliveryAddressForm #update_contact_person').value = data.returnedResponse.contact_person;
                document.querySelector('#updateDeliveryAddressForm #update_street').value = data.returnedResponse.street;
                document.querySelector('#updateDeliveryAddressForm #update_nr').value = data.returnedResponse.nr;
                document.querySelector('#updateDeliveryAddressForm #bloc').value = data.returnedResponse.bloc;
                document.querySelector('#updateDeliveryAddressForm #scara').value = data.returnedResponse.scara;
                document.querySelector('#updateDeliveryAddressForm #apartament').value = data.returnedResponse.apartament;
                document.querySelector('#updateDeliveryAddressForm #zip_code').value = data.returnedResponse.zip_code;
                document.querySelector('#updateDeliveryAddressForm #update_city').insertAdjacentHTML('beforeend',`<option selected value='${data.returnedResponse.city}'>${data.returnedResponse.city}</option>`);
                document.querySelector('#updateDeliveryAddressForm #update_county').value = data.returnedResponse.county;
                document.querySelector('#updateDeliveryAddressForm #comments').value = data.returnedResponse.comments;
                document.querySelector('#updateDeliveryAddressForm #update_is_billing_address').checked = (data.returnedResponse.is_billing_address==1) ? true : false;

            break;

            case 'putComponentToSession':
                const attrInfos = data.returnedResponse;
                const metaName = attrInfos.meta_attribute.charAt(0).toUpperCase() + attrInfos.meta_attribute.slice(1);
                let parentExists = document.querySelector('.gID'+attrInfos.meta_key);
                    parentExists = (typeof parentExists === 'undefined' || parentExists === null) ? null : parentExists.parentNode;

                if (parentExists) {
                    let existingParent = document.querySelector('.gID'+attrInfos.meta_key);
                        existingParent.insertAdjacentHTML('beforeend',`
                            <div class="attr_group">
                            <p>${metaName}:</p>
                            <ul class="attr_meta">
                                <li data-id="${attrInfos.id}">${attrInfos.meta_value}<span>X</span></li>
                            </ul>
                            </div>
                        `);
                } else {
                    let newElement = document.querySelector('.dynamicParent');
                        newElement.insertAdjacentHTML('beforeend', `
                        <div class="attr_values_group gID${attrInfos.meta_key} bar">
                            <p class="displayBlock">${attrInfos.meta_name}</p>
                            <div class="attr_group">
                                <p>${metaName}:</p>
                                <ul class="attr_meta">
                                <li data-id="${attrInfos.id}">${attrInfos.meta_value}<span>X</span></li>
                                </ul>
                            </div>
                        </div>
                    `);
                }
                showSnackbar(data.message, 3600, 'success');
            break;

            case 'deleteAllComponentsFromSession':
                let existingElements = document.querySelectorAll('.attr_values_group');
                    existingElements .forEach(element => {
                        gsap.to(element, {duration:0.3, autoAlpha:0})
                    });
                    // existingElements.innerHTML = '';
                    let btn = gsap.timeline({onComplete:function(){
                        showSnackbar(data.message, 3600, 'success');
                    }})
                        btn.set(document.querySelector('.deleteAllComponents'), {duration:0.6, autoAlpha:0})
                        btn.to(document.querySelector('.deleteAllComponents'), {display:'none'})
            break;


            default:
                break;
        }
    }else if(data.success==false){
        showSnackbar(data.message, 3600, 'error');
    }else{

    }
}

async function generalFetchRequest(btn, endpoint, method, data){
    try {
        if(method=='GET'){
            var fetchResponse = await fetch(endpoint, {
                method: method,
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
            })
        }else{
            var fetchResponse = await fetch(endpoint, {
                method: method,
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
                body: JSON.stringify(data),
            })
        }

        const responseData = await fetchResponse.json();
        processData(responseData);
        return responseData;
    }catch(error){
        console.log(error)
    }
}

document.body.addEventListener('click', function(e) {
    if (e.target.matches('#creeateClientAccount, #submitLogin, #creeateDesignerAccount, #updateAccountInfos, #addAddress, #updateAddAddress, .saveCompanyInfos, .editCompanyDetail, .add-to-cart-detail, #saveOrderDetails, #sendContact, #sendNl')) {
        e.preventDefault();
        let endpoint = e.target.dataset.endpoint;
        let method   = e.target.dataset.method;
        let formID   = e.target.dataset.form;
        let valid    = validateForms(formID);
        if(valid){
            processForm(e.target, endpoint, method, formID, false, false)
        }
    }
});



document.body.addEventListener('click', (event) => {
    let closeBtn = event.target.closest('.close-snackbar');
    if (closeBtn) {
      event.preventDefault();
      let snackbarElement = closeBtn.parentElement;
      deleteSnackbar(snackbarElement);
    }
});

if(document.getElementsByClassName('closeModal').length > 0){
    const closeBtns = document.querySelectorAll('.closeModal');
    closeBtns.forEach(function(button){
        button.addEventListener('click', function(e){
            e.preventDefault();
            const closeModal = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.close-modal');
            const clickEvent = new Event('click');
                closeModal.dispatchEvent(clickEvent);
        })

    })
}
if(document.getElementsByClassName('addCompanyDetail').length > 0){
    document.querySelector('.addCompanyDetail').addEventListener('click', function(e){
        e.preventDefault();
        var t = gsap.timeline();
            t.to(document.querySelector('.juridica'), {autoAlpha:1, height: 'auto', onStart:function(){
                e.target.innerHTML = 'Salvează datele'
            }})
            t.to(e.target, {className: 'general-btn saveCompanyInfos'})

    });
}
if(document.getElementsByClassName('addCardDetails').length > 0){
    document.querySelector('.addCardDetails').addEventListener('click', function(e){
        e.preventDefault();
            const loader = document.querySelector('.loader.cardBtnLoad')
            let t = gsap.timeline()
                t.to(e.target, {duration:0.3, autoAlpha:0})
                t.to(loader, {duration:0.3, autoAlpha:1})
            let data = {};
            //old generalFetchRequest(null, '/createCustomer', 'GET', data)
            generalFetchRequest(null, '/createExpressAccount', 'GET', data)
            .then((response)=>{
                // if(response.success==true){
                //     window.location='/createCheckoutSession';
                // }else{
                //     processError(response.message, 'display')
                // }
            })
            t.to(e.target, {duration:0.3, autoAlpha:1})
            t.to(loader, {duration:0.3, autoAlpha:0})
    });
}



if(document.getElementsByClassName('placeOrder').length > 0){
    document.querySelector('.placeOrder').addEventListener('click', function(e){
        e.preventDefault();
            const loader = document.querySelector('.loader')
            let t = gsap.timeline()
                t.to(e.target, {duration:0.3, autoAlpha:0})
                t.to(loader, {duration:0.3, autoAlpha:1})
            let data = {};
            generalFetchRequest(null, '/cart/buildAndPlaceOrder', 'POST', data)
            .then((response)=>{
                if(response.success==true){
                    switch (response.type) {
                        case 'online':
                            initializeStripePayment(response);
                            let payInterface = document.querySelector('.paymentInterface');
                            t.to(loader, {duration:0.3, autoAlpha:0})
                            t.to(payInterface, {dutation:0.3, autoAlpha:1})
                            break;
                        case 'moneyOrder':
                            initializeMoneyOrder(response)
                        break;

                        default:
                            break;
                    }
                }else{
                    processError(data.message, data.type)
                    t.to(loader, {duration:0.3, autoAlpha:0})
                    t.to(e.target, {duration:0.3, autoAlpha:1})
                }

            })
            .catch(error => {
                t.to(loader, {duration:0.3, autoAlpha:0})
                t.to(e.target, {duration:0.3, autoAlpha:1})
                console.log(error);
            });
    });
}



const changeCounty = document.querySelectorAll('.changeCounty');

    changeCounty.forEach(function(button) {
        button.addEventListener('change', (event) => {
            let selectedOption = event.target.value;
            let data = {county:selectedOption};
            console.log(data)
            generalFetchRequest(event.target, '/getCityByCounty', 'POST', data)
        });
    })

if(document.getElementsByClassName('productDetailSwiper').length > 0){
    let appendNumber = 5;
    var productSwiper = new Swiper('.productDetailSwiper', {
        slidesPerView: 5,
        spaceBetween: 13,
        scrollbar: {
            el: '.swiper-scrollbar',
            hide: false,
            dragSize: 70,
            draggable: true,
            snapOnRelease:true
        },

    });
}

var zoomObject;
function initZoom(){
    let imgWidth = document.getElementById('zoomedImage').offsetWidth;
        let zoomContainer = document.getElementById('zoomContainer');
        let options = {
            width: imgWidth, // required
            scale: 0.4,
            zoomContainer: zoomContainer,
            zoomStyle: 'position: absolute;top:0;right:-1.5625vw;z-index:99;border:1px solid #262626;background-color:#F1EDE7;',
            offset: {
                vertical: 0,
                horizontal: 10
            }
            // more options here
        };
        zoomObject = new ImageZoom(document.getElementById("zoomedImage"), options);
}
if(document.getElementsByClassName('product-detail-img').length > 0){
    initZoom();
}
if(document.getElementsByClassName('productDetailSwiper').length > 0){
    let images = document.querySelectorAll('.upload-img-item img');
    images.forEach(image => {
        image.addEventListener('click', function(e){
            let imgSrc = e.target.src;
            let mainImg = document.getElementById('zoomedImage');

                mainImg.querySelectorAll('img')[0].src = imgSrc;
                zoomObject.kill()
                initZoom()
        })
    });
}


if(document.getElementsByClassName('dashboard-flex').length > 0){
    document.querySelector('.editIcon').addEventListener('click', function(e){
        e.preventDefault();
        let profileID = e.target.dataset.profileid;
        let modal = document.querySelector('.update-profile-image');
        let t = gsap.timeline();
            t.set(modal, {display:'block'})
            t.to(modal, {autoAlpha:1})

        import('./dropzone.min')
        .then((dropzone) => {
            let data = {profileID:profileID};
            productOperations(e.target, '/getProfilePictureAjax', 'POST', data)
            .then(response => {
                if(response.success==true){
                    setTimeout(function(){
                        initProfileDropzone(true, response)
                    }, 200)
                }
            })

        })
        .catch((error) => {
            console.log('dropzone load fail')
        });

    })
}


function initProfileDropzone(preloadImage = false, responseObject){

    let uploadElement  = document.getElementById('profileImageUploader');
    let img = (preloadImage==true) ? responseObject.data : '/img/noimg.png';
    let classSelector = (preloadImage==true) ? 'preloadedImage' : '';
    let dropzoneOptions  = {
        method:'POST',
        url:'/uploadProfileImage',
        headers:{'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
        uploadMultiple:false,
        maxFiles:1,
        parallelUploads:1,
        clickable:true,
        autoProcessQueue:false,
        acceptedFiles:'image/*',
        previewsContainer:'.profileImagePreview',
        previewTemplate: `<div class='mainImgPreview ${classSelector}'>
                                <div class='previewImageHold'>
                                    <img src="${img}" alt="">
                                </div>
                                <div class='img-upl-track'>
                                    <div class='tracker'>
                                        <div class='trackbar' data-dz-uploadprogress></div>
                                    </div>
                                </div>
                                <h6 data-dz-errormessage></h6>
                                <span class='delIcon' data-dz-remove>
                                    <svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.75 4.48499C13.2525 4.23749 10.74 4.10999 8.235 4.10999C6.75 4.10999 5.265 4.18499 3.78 4.33499L2.25 4.48499" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.375 3.7275L6.54 2.745C6.66 2.0325 6.75 1.5 8.0175 1.5H9.9825C11.25 1.5 11.3475 2.0625 11.46 2.7525L11.625 3.7275" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.1344 6.85498L13.6469 14.4075C13.5644 15.585 13.4969 16.5 11.4044 16.5H6.58937C4.49687 16.5 4.42938 15.585 4.34688 14.4075L3.85938 6.85498" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.74609 12.375H10.2436" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.125 9.375H10.875" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>`,
        addRemoveLinks:false,
        createImageThumbnails:true,
        dictDefaultMessage: "Adaugă imagini aici",
        dictFileTooBig: "Fisierul este prea mare ({{filesize}}MiB). Dimensiunea maxima est de: {{maxFilesize}}MiB.",
        dictInvalidFileType: "Acest tip de imagine/fisier nu este suportat.",
        dictResponseError: "A intervenit o eroare la incarcarea imaginilor: eroare {{statusCode}}.",
        dictCancelUploadConfirmation: "Ești sigur că vrei să oprești?",
        dictRemoveFile: "Șterge",
        dictRemoveFileConfirmation: false,
        dictMaxFilesExceeded: "Nu ai voie să urci mai mult de {{maxFiles}} fișier.",
    }
    var profileDropzone = new Dropzone(uploadElement, dropzoneOptions)
        if(preloadImage==true){
            var existingFile = { name: "banner2.jpg", size: 12345 };
                profileDropzone.options.addedfile.call(profileDropzone, existingFile);
                profileDropzone.options.thumbnail.call(profileDropzone, existingFile, responseObject.data);
        }

        profileDropzone.on('removedfile', function(file){
            let uploadBtn = document.querySelector('.uploadImageTrigger');
            let t = gsap.timeline();
                t.to(uploadBtn, {duration:0.2, autoAlpha:0})
                //showSnackbar('Imagine ștearsă', 3000, 'error')
                // document.querySelector('.dashboard-account-image .editProfileImage img').src = '/img/noimg.png';
        })
        profileDropzone.on('addedfile', function(file) {
            //if more than 1 file, remove it
            let uplImag = document.querySelector('.mainImgPreview.preloadedImage');
            let t = gsap.timeline();
                t.to(uplImag, {duration:0.1, autoAlpha:0})
                t.set(uplImag, {display:'none'})
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
        });
        profileDropzone.on('thumbnail', function(file){
            file.previewElement.querySelector('.mainImgPreview .previewImageHold img').src = file.dataURL;
            let uploadBtn = document.querySelector('.uploadImageTrigger');
            let t = gsap.timeline();
                t.to(uploadBtn, {autoAlpha:1})
                document.querySelector('.uploadImageTrigger').addEventListener('click', function(e){
                    e.preventDefault();
                    profileDropzone.processQueue();
                })

        })
        profileDropzone.on("sending", function(file, xhr, formData){
            let userRole = document.getElementById('userRole').value;
            let accountID = document.getElementById('accountID').value;
            formData.append("userRole", userRole);
            formData.append("accountID", accountID);
        });
        profileDropzone.on("complete", function(file) {
            if(file.status=="success"){
                document.querySelector('.editProfileImage img').src = file.dataURL;
                showSnackbar('Imaginea a fost adăugată cu succes.', 3000, 'success');
                let modal = document.querySelector('.update-profile-image');
                gsap.to(modal, {duration:0.4, autoAlpha:0})
                    .set(modal, {display:'block'})
            }else{
                showSnackbar('A intervenit o eroare.', 2000, 'success');
            }
        });

}


function cartHandlers(){
    let handlerBtns = document.querySelectorAll('.amountHandler')
    let deleteBtns  = document.querySelectorAll('.delete-cart-element')
        handlerBtns.forEach(handlerBtn => {
            handlerBtn.addEventListener('click', function(e){
                e.preventDefault()
                let parentElement  = e.target.parentElement.parentElement.parentElement;
                let operation      = e.target.dataset.operation;

                let customData = {
                    id:        parentElement.dataset.pid,
                    operation: operation,
                    name:      parentElement.dataset.name,
                    main_url:  parentElement.dataset.main_url,
                    mainImg:   parentElement.dataset.mainimg,
                    price:     parentElement.dataset.price,
                    amount:    parentElement.dataset.amount,
                }
                updateDeleteCartSession('/updateProductToCartSession', customData)
                .then(response=>{
                    let elementToChange = parentElement.querySelector('.quantityInput');
                        elementToChange.value = response.returnedResponse.amount;
                    let data = {};
                    generalFetchRequest(null, '/recalculateCartSession', 'GET', data)
                    .then((resp)=>{
                        updateCartFront(resp)
                    })
                })

            })
        });
        deleteBtns.forEach(deleteBtn=>{
            deleteBtn.addEventListener('click', function(e){
                e.preventDefault();
                let parentElement  = e.target.parentElement.parentElement.parentElement;

                let customData = {
                    id:        parentElement.dataset.pid,
                    operation: 'delete',
                    name:      parentElement.dataset.name,
                    main_url:  parentElement.dataset.main_url,
                    mainImg:   parentElement.dataset.mainimg,
                    price:     parentElement.dataset.price,
                    amount:    parentElement.dataset.amount,
                }
                updateDeleteCartSession('/deleteProductToCartSession', customData)
                .then(response=>{
                    showSnackbar(response.message, 2600, 'success')
                    if(document.querySelectorAll('.cart-nr span').length > 0){
                        document.querySelector('.cart-nr span').innerHTML = response.totalCartProducts;
                        let cartElement = document.querySelector(`div[data-id="${response.returnedResponse.id}"]`)
                        let t = gsap.timeline();
                            t.to(cartElement, {autoAlpha:0, xPercent:'120', duration:0.6})
                            t.set(cartElement, {display:'none'})
                    }

                    if(document.querySelectorAll('.cart-product-holder').length > 0){
                        let cartElementLarge = document.querySelector(`.cart-product-holder div[data-id="${response.returnedResponse.id}"]`)
                        let t2 = gsap.timeline();
                            t2.to(cartElementLarge, {autoAlpha:0, xPercent:'120', duration:0.6})
                            t2.set(cartElementLarge, {display:'none'})
                    }


                    return response;
                })
                .then(response=>{
                    let data = {};
                    generalFetchRequest(null, '/recalculateCartSession', 'GET', data)
                    .then((resp)=>{
                        updateCartFront(resp)
                    })
                })

            })
        })
}

if(document.getElementsByClassName('amountHandler').length>0){
    cartHandlers();
}



async function addCartSession(endpoint, data){
    var fetchResponse = await fetch(endpoint, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
        body: JSON.stringify(data),
    })
    const responseData = await fetchResponse.json();
    return responseData;
}


async function runProductFilter(endpoint, method, data){
    try{
        const response = await fetch(endpoint, {
            method: method,
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
            body: JSON.stringify(data),
        })
        const responseData = await response.json();
        return responseData;
    }catch(error){

    }
}

function resetFilters(){
    const fieldset = document.querySelector('#filterForm');
    const checkedInputs = fieldset.querySelectorAll('.input-hold input:checked');
          checkedInputs.forEach(input => {
            input.checked = false;
          });
    let sorter = document.getElementById('sorder');
    sorter.selectedIndex = 0;
}
function getFilterData(){
    const fieldset = document.querySelector('#filterForm');
    const checkedInputs = fieldset.querySelectorAll('input:checked');
    const filterValues = {};
    checkedInputs.forEach(input => {
      const name = input.name;
      const value = input.value;

      if (!filterValues[name]) {
        filterValues[name] = [value];
      } else {
        filterValues[name].push(value);
      }
    });
    return filterValues;
}

function populateFilteredProducts(response, t, productsHolder, paginationHold){
    let products = ``;
    let pagination = ``;
    if(response.success==true){
        pagination = response.pagination;
        if(response.products.data.length > 0){
            document.querySelector('.totalFiltered').innerHTML = response.products.total;
            response.products.data.forEach(masaraProduct => {
                products += `<div class='product-element staggerHidden' data-id='${masaraProduct.id}' data-name='${masaraProduct.name}' data-main_url='${masaraProduct.main_url}' data-mainImg='${masaraProduct.mainImg}' data-price='${masaraProduct.price}' data-amount='1'>
                <div class='product-item'>
                    <a href='${masaraProduct.main_url}' class='product-image'>
                        <picture>
                            <source media="(max-width:770px)" srcset="${masaraProduct.mainImg}">
                            <img src="${masaraProduct.mainImg}" alt="Product image: ${masaraProduct.name}">
                        </picture>
                        <span class='fav-btn'>
                            <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class='new-tag'>
                            <p>NOU!</p>
                        </span>
                    </a>
                    <div class='product-content'>
                        <div class='product-content-top'>
                            <a href="${masaraProduct.main_url}">${masaraProduct.name}</a>
                            <div class='product-list-price'>
                                <p>${masaraProduct.price} lei</p>
                            </div>
                        </div>
                        <div class='product-content-bottom'>
                            <a href="" class='quickAddToCart'>Adaugă în coș</a>
                        </div>
                    </div>
                </div>
            </div>`
            });
        }else{
            products = `<p>Nu exista produse în funcție de filtrele selectate.</p>`;
            document.querySelector('.totalFiltered').innerHTML = 0;
        }
    }else{
        products = `<p>Nu exista produse în funcție de filtrele selectate.</p>`;
        document.querySelector('.totalFiltered').innerHTML = 0;
    }
    t.to('.filter-loader', {duration:0.2, autoAlpha:0, onStart:function(){
        productsHolder.insertAdjacentHTML('afterbegin', products);
        if(paginationHold!=null){
            paginationHold.insertAdjacentHTML('afterbegin', pagination)
        }
    }}, '+=0.6')
    t.to(productsHolder, {duration:0.2, autoAlpha:1, onComplete:function(){
        let newProds = document.querySelectorAll('.product-element');
        t.to(newProds, {duration:0.2, autoAlpha:1, stagger:0.1, onStart:function(){
            quickAddToCart()
        }})
    }}, '+=0.2')
}

function quickAddToCart(){
    const quickAddBtn = document.querySelectorAll('.quickAddToCart');
    quickAddBtn.forEach(addBtn => {
        addBtn.addEventListener('click', function(e){
            e.preventDefault();
            let cartElement = e.target.parentElement.parentElement.parentElement.parentElement;
            let customData = {
                id:       cartElement.dataset.id,
                name:     cartElement.dataset.name,
                main_url: cartElement.dataset.main_url,
                mainImg:  cartElement.dataset.mainimg,
                price:    cartElement.dataset.price,
                amount:   cartElement.dataset.amount,
            }

            addCartSession('/addProductToCartSession', customData)
            .then(response=>{
                processSuccess(response, null)
                let data = {};
                generalFetchRequest(null, '/recalculateCartSession', 'GET', data)
                .then((resp)=>{
                    updateCartFront(resp)
                    cartHandlers()
                })
            })
        })
    });
}

function updateCartFront(resp){
    console.log(resp)
    let subtotal = (typeof resp.subtotal==='undefined') ? 0 : resp.subtotal;
    // let subtotalWithTVA = (typeof resp.subtotalWithTVA==='undefined') ? 0 : resp.subtotalWithTVA;
    let calculatedTva = (typeof resp.calculatedTva==='undefined') ? 0 : resp.calculatedTva;
    let totalOrder = (typeof resp.totalOrder==='undefined') ? 0 : resp.totalOrder;
    if(document.querySelectorAll('.smallSubtotal').length > 0) {
        document.querySelector('.smallSubtotal').innerHTML = subtotal;
    }
    if(document.querySelectorAll('.smallTVA').length > 0) {
        document.querySelector('.smallTVA').innerHTML = calculatedTva;
    }

    // if(document.querySelectorAll('.smallsubTotalWithTVA').length > 0) {
    //     document.querySelector('.smallsubTotalWithTVA').innerHTML = subtotalWithTVA;
    // }
    if(document.querySelectorAll('.smallTotalWithTVA').length > 0) {
        document.querySelector('.smallTotalWithTVA').innerHTML = totalOrder;
    }


    if(document.querySelectorAll('.deliveryFeeCartLarge').length > 0) {
        document.querySelector('.deliveryFeeCartLarge').innerHTML = resp.deliveryFee;
    }
    if(document.querySelectorAll('.deliveryFeeCartSmall').length > 0) {
        document.querySelector('.deliveryFeeCartSmall').innerHTML = resp.deliveryFee;
    }

    if(document.querySelectorAll('.subtotalCartLarge').length > 0) {
        document.querySelector('.subtotalCartLarge').innerHTML = subtotal;
    }
    if(document.querySelectorAll('.tvaLarge').length > 0) {
        document.querySelector('.tvaLarge').innerHTML = calculatedTva;
    }
    // if(document.querySelectorAll('.totalCartLargeTVA').length > 0) {
    //     document.querySelector('.totalCartLargeTVA').innerHTML = subtotalWithTVA;
    // }
    if(document.querySelectorAll('.totalCartLarge').length > 0) {
        document.querySelector('.totalCartLarge').innerHTML = totalOrder;
    }
}

if(document.getElementsByClassName('clearAllFilters').length > 0){
    document.querySelector('.clearAllFilters').addEventListener('click', function(e){
        e.preventDefault();
        let productsHolder = document.querySelector('.shop-list-flex');
        let paginationHold = (document.getElementsByClassName('pagination-hold').length > 0) ? document.querySelector('.pagination-hold') : null;
        let t = gsap.timeline();
            t.to(productsHolder, {duration:0.2, autoAlpha:0})
            t.to('.filter-loader', {duration:0.2, autoAlpha:1, onStart: function(){
                productsHolder.innerHTML='';
                if(paginationHold!=null){
                    paginationHold.innerHTML='';
                }
                smoothScrollToDiv('productScroll', -250)
            }}, "<")
        let data = {};
        if(document.getElementsByClassName('hiden-prefilter').length>0){
            let currentFilterValue = document.querySelector('.hiden-prefilter input').value;
            let currentFilterName  = document.querySelector('.hiden-prefilter input').name;
            data[currentFilterName] = [currentFilterValue];
        }
        runProductFilter('/clearProductFilters', 'POST', data)
        .then(function(response){
            resetFilters();
            populateFilteredProducts(response, t, productsHolder, paginationHold);
        })
    })
}

if(document.querySelectorAll('.sorder').length > 0){
    document.querySelector('#sorder').addEventListener('change', function(e){
        e.preventDefault;
        let productsHolder = document.querySelector('.shop-list-flex');
        let paginationHold = (document.getElementsByClassName('pagination-hold').length > 0) ? document.querySelector('.pagination-hold') : null;
            let t = gsap.timeline();
                t.to(productsHolder, {duration:0.2, autoAlpha:0})
                t.to('.filter-loader', {duration:0.2, autoAlpha:1, onStart: function(){
                    productsHolder.innerHTML='';
                    if(paginationHold!=null){
                        paginationHold.innerHTML='';
                    }
                    smoothScrollToDiv('productScroll', -250)
                }}, "<")
        let sorter = e.target.value;
        let data = getFilterData()
            data['sorter'] = [sorter];
        let endpoint = (Object.keys(data).length === 0) ? '/clearProductFilters' : '/getFilteredProducts';
        runProductFilter(endpoint, 'POST', data)
        .then(function(response){
            populateFilteredProducts(response, t, productsHolder, paginationHold)
        })
    });
}


const filterInputs = document.querySelectorAll('#filterForm input');
filterInputs.forEach(function(inputElement) {
    inputElement.addEventListener('change', (event) => {

        let productsHolder = document.querySelector('.shop-list-flex');
        let paginationHold = (document.getElementsByClassName('pagination-hold').length > 0) ? document.querySelector('.pagination-hold') : null;

        let t = gsap.timeline();
            t.to(productsHolder, {duration:0.2, autoAlpha:0})
            t.to('.filter-loader', {duration:0.2, autoAlpha:1, onStart: function(){
                productsHolder.innerHTML='';
                if(paginationHold!=null){
                    paginationHold.innerHTML='';
                }
                smoothScrollToDiv('productScroll', -250)
            }}, "<")

        let filterData = getFilterData()
        let sorter = document.getElementById('sorder').value;
            filterData['sorter'] = (sorter === '') ? '' : [sorter];
        runProductFilter('/getFilteredProducts', 'POST', filterData)
        .then(function(response){
            populateFilteredProducts(response, t, productsHolder, paginationHold)
        })
    });
})

if(document.getElementsByClassName('quickAddToCart').length>0){
    quickAddToCart();
}


async function checkStripeStatus() {
    const stripe = Stripe("pk_test_51KWcAIDbMv7unvikoFgclXkYDnZ6SavPERJDJIwKxqQR7ZE8dXlOANc4RmThwr2sPsZiNPXDA6mm9zpZKebKJ8C600l8n3UdTD");
    const clientSecret = new URLSearchParams(window.location.search).get(
        "payment_intent_client_secret"
    );

    if (!clientSecret) {
        return;
    }

    const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);
    generalFetchRequest(null, '/stripe/updatePayment', 'POST', paymentIntent)
}



/**chart functions**/
function initChartRaport(chartDom) {
    return echarts.init(chartDom);
}

function setChartOption(myChart, response) {
    return {
        xAxis: {
            type: 'category',
            data: response.days,
        },
        yAxis: {
            type: 'value',
        },
        series: [
            {
                data: response.sales,
                type: 'bar',
            },
        ],
        color: ['#DB4F35', '#DB4F35', '#DB4F35'],
    };
}

function fetchAndSetChartOption(myChart, dayRange) {
    const data = {
        nrOfDays: parseInt(dayRange),
    };

    generalFetchRequest(null, '/getInitialDesignerSalesNrByDay', 'POST', data)
        .then(function (response) {
            if (response.success !== false) {
                const option = setChartOption(myChart, response);
                option && myChart.setOption(option);
            } else {
                showSnackbar('Nu sunt setate zilele pentru a genera un raport');
            }
        });
}

function initDesignerRaport(dayRange) {
    const chartDom = document.getElementById('chartRaport1');
    const myChart = initChartRaport(chartDom);

    if (document.querySelectorAll('.rapportPeriod').length > 0) {
        document.querySelector('#rapportPeriod').addEventListener('change', function (e) {
            e.preventDefault();
            const dayRange = e.target.value === '1mo' ? 30 : 7;
            fetchAndSetChartOption(myChart, dayRange);
        });
    }

    fetchAndSetChartOption(myChart, dayRange);
}
/**chart functions**/


function initInvoiceUploader(){
    //const fileInput = document.getElementById('invoice');
    //const uploadForm = document.getElementById('uploadInvoice8');
    //console.log(uploadForm)
    let fileInputList = document.querySelectorAll('.invoiceElem');
    let uploadFormList = document.querySelectorAll('.invoice-upload');


    fileInputList.forEach(function(el, index){
        el.addEventListener('change', async function (e) {
            let uploadForm = e.target.parentElement.parentElement;
            const loader = uploadForm.querySelector('.loader.invoiceLoader')
            const invoiceBtn = uploadForm.querySelector('.uploadInvoice')
            let t = gsap.timeline()
                t.to(invoiceBtn, {duration:0.3, autoAlpha:0})
                t.to(loader, {duration:0.3, autoAlpha:1})
            const formData = new FormData();
                  formData.append('invoice', e.target.files[0]);
                  formData.append('reseller_invoices_id', uploadForm.querySelector('#reseller_invoices_id').value);
                  formData.append('accountID', uploadForm.querySelector('#accountID').value);

            try {
                const response = await fetch('/uploadInvoice', {
                    method: 'POST',
                    body: formData,
                    headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
                });
                const responseData = await response.json();

                setTimeout(() => {
                    if (responseData.success === false) {
                        showSnackbar(responseData.message.invoice[0], 2000, 'error');
                    } else {
                        showSnackbar(responseData.message, 2000, 'success');

                        let copy = `<p><strong>Status factură:</strong> Încărcată</p>
                                            <p><strong>Vezi aici factura:</strong> <a href='/invoices/${responseData.invoiceName}' target='_blank'>factură</a></p>`;

                        let monthElement = uploadForm.parentElement.querySelector('h4');
                            monthElement.insertAdjacentHTML('afterend', copy)
                            uploadForm.remove()
                    }
                    t.to(invoiceBtn, {duration:0.3, autoAlpha:1})
                    t.to(loader, {duration:0.3, autoAlpha:0})
                }, 1000);

            } catch (error) {
                console.error(error);
            }

        });
    })




    // uploadForm.addEventListener('submit', async function (event) {
    //     event.preventDefault();
    //     const loader = document.querySelector('.loader.invoiceLoader')
    //     const invoiceBtn = document.querySelector('.uploadInvoice')
    //
    //     let t = gsap.timeline()
    //         t.to(invoiceBtn, {duration:0.3, autoAlpha:0})
    //         t.to(loader, {duration:0.3, autoAlpha:1})
    //
    //     const formData = new FormData();
    //     formData.append('invoice', document.getElementById('invoice').files[0]);
    //     formData.append('reseller_invoices_id', document.getElementById('reseller_invoices_id').value);
    //     formData.append('accountID', document.getElementById('accountID').value);
    //
    //
    //     try {
    //         const response = await fetch('/uploadInvoice', {
    //             method: 'POST',
    //             body: formData,
    //             headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
    //         });
    //         const responseData = await response.json();
    //
    //         setTimeout(() => {
    //             if (responseData.success == false) {
    //                 showSnackbar(responseData.message.invoice[0], 2000, 'error');
    //                 //processError(responseData.message, responseData.type)
    //             } else {
    //                 showSnackbar(responseData.message, 2000, 'success');
    //
    //                 let copy = `<p><strong>Status factură:</strong> Încărcată</p>
    //                             <p><strong>Vezi aici factura:</strong> <a href='/invoices/${responseData.invoiceName}' target='_blank'>factură</a></p>`;
    //
    //                 let monthElement = event.target.parentElement.querySelector('h4');
    //                     monthElement.insertAdjacentHTML('afterend', copy)
    //                     event.target.remove()
    //             }
    //             t.to(invoiceBtn, {duration:0.3, autoAlpha:1})
    //             t.to(loader, {duration:0.3, autoAlpha:0})
    //         }, 1000);
    //
    //     } catch (error) {
    //         console.error(error);
    //     }
    // });

}

document.addEventListener("DOMContentLoaded",function(){
    //prevent main thread load
    (document.getElementsByClassName('hamburger')) ? initSiteMenu() : '';
    (document.getElementById('search')) ? initSearchToggle() : '';
    (document.getElementsByClassName('homepage-products').length > 0) ? initHomepageProductsSlider() : '';
    (document.getElementsByClassName('product-detail-recommended-products').length > 0) ? initRecommendedProductsSlider() : '';
    (document.getElementsByClassName('designer-top-products').length > 0) ? initTopDesignerProducts() : '';
    (document.getElementsByClassName('homepage-designers').length > 0) ? initHomepageDesignersSlider() : '';
    (document.getElementsByClassName('faq-element').length > 0) ? setFAQTabs() : '';
    (document.getElementsByClassName('faq-tabs').length > 0) ? setFAQTabsContent() : '';
    (document.getElementsByClassName('account-tabs').length > 0) ? setAccountTabsContent() : '';
    (document.getElementsByClassName('close-modal').length > 0) ? modalControl() : '';
    (document.getElementsByClassName('offcanvas-section').length > 0) ? offcanvasModal() : '';
    (document.getElementsByClassName('update-profile').length > 0) ? accountEvents() : '';
    (document.getElementsByClassName('order-success-container').length > 0) ? checkStripeStatus() : '';
    (document.getElementsByClassName('designer-raport').length > 0) ? initDesignerRaport(6) : '';
    (document.getElementsByClassName('invoice-upload').length > 0) ? initInvoiceUploader() : '';

});




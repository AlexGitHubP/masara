import { gsap, Power2 } from 'gsap';
import { processData } from './app';
import { validateForms } from '../js/validators';
import { processForm } from './app';
import { showSnackbar } from './app';
import Swiper from 'swiper/bundle';


export async function productOperations(btn, endpoint, method, data){
    try{
        const response = await fetch(endpoint, {
            method: method,
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
            body: JSON.stringify(data),
        })
        const responseData = await response.json();
        return responseData;
        //buildProduct(responseData);
    }catch(error){

    }
}

//dropzone uploaded images to be used in app.js after submit
let dropzoneObject, swiperObject;
function setDropzoneObject(object) {
    dropzoneObject = object;
}
function getDropzoneObject() {
  return dropzoneObject;
}

function setSwiperObject(object) {
    swiperObject = object;
}
function getSwiperObject() {
  return swiperObject;
}



export { setDropzoneObject, getDropzoneObject, setSwiperObject, getSwiperObject };


function mapCharacters(inputString){
    var mapping = {
        'ș': 's',
        'ț': 't',
        'â': 'a',
        'î': 'i',
        'ă': 'a',
        'Ș': 'S',
        'Ț': 'T',
        'Ă': 'A',
        'Î': 'I',
        'Â': 'A'
    };
    
    var returnClean = inputString.replace(/[^\x00-\x7F]/g, function(char) {
        return mapping[char] || char;
    });

    return returnClean;
}

function constructUrl(inputValue){
    // Remove empty spaces
    inputValue = inputValue.replace(/\s+/g, '-');
    // Convert to lowercase
    inputValue = inputValue.toLowerCase();
    // Replace Latin characters
    inputValue = mapCharacters(inputValue);
    // Replace all unwanted characters, numbers, and leave only alphabets and underscore
    inputValue = inputValue.replace(/[^a-zA-Z0-9-]/g, '');

    return inputValue;
}


function buildMinimumProduct(formID){
    const form = document.querySelector('#'+formID);
    const formData = new FormData(form);
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                formData.append(checkbox.name, checkbox.checked);
            });
    let subcategories = slimCategory.getSelected();
    let areas         = slimArea.getSelected();
    let url           = constructUrl(formData.get('name'))
    let images        = productDropzone.getAcceptedFiles();
    
    setDropzoneObject(productDropzone);

        subcategories.forEach(subcategory => {
            formData.append('subcategories[]', subcategory);
        });
        areas.forEach(area => {
            formData.append('areas[]', area);
        });
        
        formData.append('url', url);

        images.forEach(image => {
            let ordering = image.previewElement.dataset.order;
            formData.append('images[]', image);
        });

    return formData;
}

if(document.getElementsByClassName('addprod').length > 0){
    document.body.addEventListener('click', function(e) {
        if (e.target.matches('#addProduct')) {
            e.preventDefault();
            let endpoint = e.target.dataset.endpoint;
            let method   = e.target.dataset.method;
            let formID   = e.target.dataset.form;
            let valid    = validateForms(formID);
            if(valid){
                let customData = buildMinimumProduct(formID);
                processForm(e.target, endpoint, method, formID, customData, true)
            }
        }
    });
}


if(document.getElementsByClassName('selectCategory').length > 0){
    var slimCategory = new SlimSelect({
        select: '#category',
        settings: {
            showSearch: false,
            allowDeselect: true
        }
    })
    var slimArea = new SlimSelect({
        select: '#area',
        settings: {
            showSearch: false,
            allowDeselect: true,
            placeholderText: 'Alege zona',
        }
    })
    new SlimSelect({
        select: '#attr_type_select',
        settings: {
            showSearch: false,
            allowDeselect: true,
            placeholderText: 'Alege un element',
        }
    })
    
    
}

if(document.getElementsByClassName('attr_type_select').length > 0){
    const type = document.getElementById('attr_type_select');
        type.addEventListener('change', (event) => {
        
        let attr_id = event.target.value;
        let attr_identifier = event.target.options[event.target.selectedIndex].getAttribute('data-name');;
        let text = event.target.options[event.target.selectedIndex].innerHTML;
        
        document.getElementById('meta_name').value = text;
        document.getElementById('meta_key').value  = attr_identifier;

        let data = {attr_id:attr_id};
        
        productOperations(event.target, '/getAssocValues', 'POST', data)
        .then( response =>{
            let inputs = document.querySelectorAll('.componentBuilderHold .input-hold');
                inputs.forEach(element => {
                    // element.style.marginBottom = '1.28125VW'
                });
            
            let html =`<div class="input-element" style='margin-bottom:1.28125VW'>
                        <label for="attr_value_type">Adaugă proprietate pentru ${text}:</label>
                            <select name='meta_combined_key' id='meta_combined_key' class='attr_type_select_combined' value=''>
                                <option data-placeholder="true"></option>
                                ${Object.keys(response).map(key => (
                                    `<option value="${response[key]['attr_value_identifier']}">${response[key]['attr_value_name']}</option>`
                                )).join('')}
                            </select>
                        </div>`;
            document.querySelector('.constructAttrSelectors').innerHTML = html;
            document.querySelector('.constructValsSelectors').innerHTML = '';
            
            new SlimSelect({
                select: '#meta_combined_key',
                settings: {
                    showSearch: false,
                    allowDeselect: true,
                    placeholderText: 'Alege',
                }
            })
        })
        .then(()=>{
            const type = document.getElementById('meta_combined_key');
            type.addEventListener('change', (event) => {
                
                let attr_val_identifier = event.target.value;
                let meta_attribute = attr_val_identifier.split('_')[1] || 'N/A';
                    document.getElementById('meta_attribute').value = meta_attribute;

                let data = {attr_identifier:attr_val_identifier};
                productOperations(event.target, '/getGroupedAssocValues', 'POST', data)
                .then(response =>{
                    let html =`<div class="input-element">
                                    <label for="value_elements">Adaugă valori</label>
                                        <select name='meta_value' id='meta_value' class='meta_value' value='' multiplename="value_elements">
                                        <option data-placeholder="true"></option>
                                        ${Object.keys(response).map(key => (
                                            `<option value="${response[key]['attr_value']}">${response[key]['attr_value']}</option>`
                                        )).join('')}
                                        </select>
                                    </div>`;
                    document.querySelector('.constructValsSelectors').innerHTML = html;
                    new SlimSelect({
                        select: '#meta_value',
                        settings: {
                            showSearch: false,
                            allowDeselect: true,
                            placeholderText: 'Alege',
                        }
                    })
                })
                .then(()=>{
                    const metaVal = document.getElementById('meta_value');
                    metaVal.addEventListener('change', (event)=>{
                        let metaValSelected = event.target.value;
                        document.querySelector('.component').innerHTML = meta_attribute+' '+metaValSelected+' pentru '+attr_identifier;
                        let btn = document.querySelector('.componentBuilderHold .btn-hold .addComponent')
                        let t = gsap.timeline()
                            t.set(btn, {display:'block'})
                            t.to(btn, {duration:0.3, autoAlpha:1})
                    })
                })
            });
        })
        .catch(error =>{
            console.log(error)
        })
    });
}

if(document.getElementsByClassName('addComponent').length > 0){
    
    let addComponentBtn = document.querySelector('.addComponent');
        addComponentBtn.addEventListener('click', function(e){
            e.preventDefault()
            
            let metaVal = document.getElementById('meta_value').value;

            if(metaVal.trim().length === 0){
                showSnackbar('Trebuie să alegi o valoare.', 1500, 'error')
                return false;
            }

            let data = {
                meta_name:document.getElementById('meta_name').value,
                meta_owner:document.getElementById('meta_owner').value,
                meta_key:document.getElementById('meta_key').value,
                meta_attribute:document.getElementById('meta_attribute').value,
                meta_combined_key:document.getElementById('meta_combined_key').value,
                meta_value:document.getElementById('meta_value').value
            };

            
            productOperations(e.target, '/putComponentToSession', 'POST', data )
            .then(response=>{
                processData(response)
            })
            .catch(error =>{
                console.log(error)
            })
        })
        
    let deleteAllComponents = document.querySelector('.deleteAllComponents');
        deleteAllComponents.addEventListener('click', function(e){
            e.preventDefault()
            
            let data = {};
            productOperations(e.target, '/deleteAllComponentsFromSession', 'POST', data )
            .then(response=>{
                processData(response)
            })
            .catch(error =>{
                console.log(error)
            })

            
        })
}

if(document.getElementsByClassName('addPRoductSlide').length > 0){
    let appendNumber = 5;
    var productSwiper = new Swiper('.addPRoductSlide', {
        slidesPerView: 3,
        spaceBetween: 13,
        scrollbar: {
            el: '.swiper-scrollbar',
            hide: false,
            dragSize: 70,
            draggable: true,
            snapOnRelease:true
        },
        
    });
    setSwiperObject(productSwiper);
}


if(document.getElementsByClassName('multiple-uploader').length > 0){
    var sortableImages = document.getElementById('sortableImages');
    var sortable = Sortable.create(sortableImages, {
        animation: 150,
        dataIdAttr: 'data-order',
        easing: "cubic-bezier(1, 0, 0, 1)",
        handler: '.handler',
        onEnd: (evt) => {
            const items = Array.from(sortableImages.children);
            items.forEach((item, index) => {
                item.setAttribute('data-order', index + 1);
            });

            //reordonare daca se face drag-n-drop
            var queue = productDropzone.files;
            var newQueue = [];
            items.forEach(newFile => {
                let name = newFile.querySelector('.img-uploader-content p').innerHTML;
                queue.every(function(file, index){ 
                    if (file.name === name) {
                        newQueue.push(file);
                        return false;
                    }
                    return true;
                });
                productDropzone.files = newQueue;
            });
            
            
            let mainImage = items[0].querySelector('.img-uploader-img-hold .img-uploader-img img').src;
            document.querySelector('.main-img-upload-preview img').src = mainImage;

            productSwiper.removeAllSlides();
            items.shift()
            items.forEach((item, index) => {
                let img = item.querySelector('.img-uploader-img-hold .img-uploader-img img').src;
                
                productSwiper.appendSlide(`<div class='upload-img-hold swiper-slide'>
                                <div class='upload-img-item'>
                                    <img src="${img}" alt="">
                                </div>
                            </div>`);
            });
        }
    });

    let uploadElement  = document.getElementById('multiple-upl-img-hold');
    let dropzoneOptions  = {
        method:'POST',
        url:'/uploadProductImages',
        headers:{'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
        uploadMultiple:false,
        maxFiles:10,
        parallelUploads:1,
        clickable:true,
        autoProcessQueue:false,
        acceptedFiles:'image/*',
        previewsContainer:'.img-uploader-track',
        previewTemplate: `<div class='img-uploader-element' id='imgUploadElement' data-order='1'>
                            <div class='handler'>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 14">
                                <path id="Sort-2" data-name="Sort" d="M2.259,6.406A.794.794,0,1,0,3.329,7.58l1.878-1.71V16.206a.794.794,0,0,0,1.588,0V5.871L8.672,7.58A.794.794,0,1,0,9.741,6.406L6,3Zm15.481,7.188a.794.794,0,0,0-1.069-1.174l-1.878,1.71V3.794a.794.794,0,0,0-1.588,0V14.129l-1.877-1.71a.794.794,0,0,0-1.069,1.174L14,17Z" transform="translate(-2 -3)" fill="##262626" fill-rule="evenodd"/>
                            </svg>
                            </div>
                            <div class='img-uploader-img-hold'>
                                <div class='img-uploader-img'>
                                    <img src=''>                                                
                                </div>
                            </div>
                            <div class='img-uploader-content'>
                                <p>Leick Solid Ash Mission Console Table <span>5.7MB</span><span data-dzc-id></span></p>
                                <div class='img-upl-track'>
                                    <div class='tracker'>
                                        <div class='trackbar' data-dz-uploadprogress></div>
                                    </div>
                                </div>
                                <h6 data-dz-errormessage></h6>
                            </div>
                            <div class='img-uploader-action'>
                                <div class='delImgHold' data-dz-remove>
                                    <svg viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.75 4.48499C13.2525 4.23749 10.74 4.10999 8.235 4.10999C6.75 4.10999 5.265 4.18499 3.78 4.33499L2.25 4.48499" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.375 3.7275L6.54 2.745C6.66 2.0325 6.75 1.5 8.0175 1.5H9.9825C11.25 1.5 11.3475 2.0625 11.46 2.7525L11.625 3.7275" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14.1344 6.85498L13.6469 14.4075C13.5644 15.585 13.4969 16.5 11.4044 16.5H6.58937C4.49687 16.5 4.42938 15.585 4.34688 14.4075L3.85938 6.85498" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.74609 12.375H10.2436" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.125 9.375H10.875" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                                
                                </div>
                            </div>
                        </div>`,
        addRemoveLinks:false,
        createImageThumbnails:true,
        dictDefaultMessage: "Adaugă imagini aici",
        dictFileTooBig: "Fisierul este prea mare ({{filesize}}MiB). Dimensiunea maxima est de: {{maxFilesize}}MiB.",
        dictInvalidFileType: "Acest tip de imagine/fisier nu este suportat.",
        dictResponseError: "A intervenit o eroare la incarcarea imaginilor: eroare {{statusCode}}.",
        dictCancelUpload: "Oprește încărcarea.",
        dictUploadCanceled: "Oprește încărcarea.",
        dictCancelUploadConfirmation: "Ești sigur că vrei să oprești?",
        dictRemoveFile: "Șterge",
        dictRemoveFileConfirmation: false,
        dictMaxFilesExceeded: "Nu ai voie să urci mai mult de {{maxFiles}} fișiere.",
    }
    var productDropzone = new Dropzone(uploadElement, dropzoneOptions)
    let ordering = 0;
    let addOrdering = 0;
        productDropzone.on("addedfile", file => {
            ordering = ordering + 1;
            file.previewElement.setAttribute('data-order', ordering);
            file.previewElement.querySelector('.img-uploader-content p').innerHTML = file.name
            if(file.status=='added'){
                let progressBar = file.previewElement.querySelector('.img-uploader-content .img-upl-track .tracker .trackbar')
                setTimeout(function(){
                    gsap.to(progressBar, {duration:1.3, width:'100%'})
                }, 300)
            }
            
        });
        productDropzone.on('thumbnail', function(file){
            addOrdering = addOrdering + 1;
            let imagePreview = file.previewElement.querySelector('.img-uploader-img-hold .img-uploader-img img').src = file.dataURL;        
            if(addOrdering ==1 ){
                document.querySelector('.main-img-upload-preview img').src = imagePreview;
            }else{
                productSwiper.appendSlide(`<div class='upload-img-hold swiper-slide'>
                                <div class='upload-img-item'>
                                    <img src="${imagePreview}" alt="">
                                </div>
                            </div>`);
            }
                
        })
}

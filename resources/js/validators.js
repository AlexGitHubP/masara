import validator from 'validator';
import { processError } from '../js/app';
import { smoothScrollToDiv } from '../js/app';

export function validateForms(formID){
    const form = document.querySelector('#'+formID);
    const formData = new FormData(form);
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
    const formValues = {};
    const errors = {};
    for (const [name, value] of formData) {
        formValues[name] = value;
    }

    switch (formID) {
        case 'creeateClientAccountForm':
            if (validator.isEmpty(formValues.name, { ignore_whitespace:false })) {
                checkAndRemoveError('name')
                errors.name = "Adaugă un nume.";
            }else{ removeInputError('name') }

            if (validator.isEmpty(formValues.surname, { ignore_whitespace:false })) {
                checkAndRemoveError('surname')
                errors.surname = "Adaugă prenume.";
            }else{removeInputError('surname')}

            if (!validator.isEmail(formValues.email, { })) {
                checkAndRemoveError('email')
                errors.email = "Adaugă o adresă validă de email.";
            }else{removeInputError('email')}

            if (!validator.isMobilePhone(formValues.phone, "any")) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă un număr de telefon valid.";
            }else{removeInputError('phone')}

            if (!validator.isNumeric(formValues.phone, "any")) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă doar cifre.";
            }else{removeInputError('phone')}

            if (validator.isEmpty(formValues.password, {ignore_whitespace:false})) {
                checkAndRemoveError('password')
                errors.password = "Adaugă o parolă.";
            }else{removeInputError('password')}

            if(formValues.password != formValues.password_confirmation){
                checkAndRemoveError('password_confirmation')
                errors.password_confirmation = "Parola de confirmare nu este identică.";
            }else{removeInputError('password_confirmation')}

            if(formValues.terms !='true'){
                checkAndRemoveError('terms')
                errors.terms = "Trebuie să fii de acord cu termenii și condițiile.";
            }else{removeInputError('terms')}

        break;

        case 'creeateDesignerAccountForm':
            if (validator.isEmpty(formValues.name, { ignore_whitespace:false })) {
                checkAndRemoveError('name')
                errors.name = "Adaugă un nume.";
            }else{ removeInputError('name') }

            if (validator.isEmpty(formValues.surname, { ignore_whitespace:false })) {
                checkAndRemoveError('surname')
                errors.surname = "Adaugă prenume.";
            }else{removeInputError('surname')}

            if (!validator.isEmail(formValues.email, { })) {
                checkAndRemoveError('email')
                errors.email = "Adaugă o adresă validă de email.";
            }else{removeInputError('email')}

            if (!validator.isMobilePhone(formValues.phone, "any")) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă un număr de telefon valid.";
            }else{removeInputError('phone')}

            if (!validator.isNumeric(formValues.phone, "any")) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă doar cifre.";
            }else{removeInputError('phone')}

            if (validator.isEmpty(formValues.password, {ignore_whitespace:false})) {
                checkAndRemoveError('password')
                errors.password = "Adaugă o parolă.";
            }else{removeInputError('password')}

            if(formValues.password != formValues.password_confirmation){
                checkAndRemoveError('password_confirmation')
                errors.password_confirmation = "Parola de confirmare nu este identică.";
            }else{removeInputError('password_confirmation')}

            if(formValues.terms !='true'){
                checkAndRemoveError('terms')
                errors.terms = "Trebuie să fii de acord cu termenii și condițiile.";
            }else{removeInputError('terms')}
        break;

        case 'loginForm':
            if (validator.isEmpty(formValues.email, { ignore_whitespace:false })) {
                checkAndRemoveError('email')
                errors.email = "Adaugă un email.";
            }else{ removeInputError('email') }

            if (!validator.isEmail(formValues.email, { })) {
                checkAndRemoveError('email')
                errors.email = "Adaugă o adresă validă de email.";
            }else{removeInputError('email')}

            if (validator.isEmpty(formValues.password, {ignore_whitespace:false})) {
                checkAndRemoveError('password')
                errors.password = "Adaugă o parolă.";
            }else{removeInputError('password')}

        break;

        case 'updateAccountForm':
            if (validator.isEmpty(formValues.name, { ignore_whitespace:false })) {
                checkAndRemoveError('name')
                errors.name = "Adaugă un nume.";
            }else{ removeInputError('name') }

            if (validator.isEmpty(formValues.surname, { ignore_whitespace:false })) {
                checkAndRemoveError('surname')
                errors.surname = "Adaugă prenume.";
            }else{removeInputError('surname')}

            if (validator.isEmpty(formValues.email, { ignore_whitespace:false })) {
                checkAndRemoveError('email')
                errors.email = "Adaugă un email.";
            }else{ removeInputError('email') }

            if (!validator.isEmail(formValues.email, { })) {
                checkAndRemoveError('email')
                errors.email = "Adaugă o adresă validă de email.";
            }else{removeInputError('email')}

            if (!validator.isMobilePhone(formValues.phone, "any")) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă un număr de telefon valid.";
            }else{removeInputError('phone')}

            if (!validator.isNumeric(formValues.phone, "any")) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă doar cifre.";
            }else{removeInputError('phone')}

        break;

        case 'deliveryAddressForm':
            if (validator.isEmpty(formValues.contact_person, { ignore_whitespace:false })) {
                checkAndRemoveError('contact_person')
                errors.contact_person = "Adaugă o persoană de contact.";
            }else{ removeInputError('contact_person') }

            if (validator.isEmpty(formValues.street, { ignore_whitespace:false })) {
                checkAndRemoveError('street')
                errors.street = "Adaugă o stradă.";
            }else{removeInputError('street')}

            if (validator.isEmpty(formValues.nr, { ignore_whitespace:false })) {
                checkAndRemoveError('nr')
                errors.nr = "Adaugă un număr.";
            }else{ removeInputError('nr') }

            if (validator.isEmpty(formValues.county, { ignore_whitespace:false })) {
                checkAndRemoveError('county')
                errors.county = "Adaugă un județ.";
            }else{removeInputError('county')}

            if (validator.isEmpty(formValues.city, { ignore_whitespace:false })) {
                checkAndRemoveError('city')
                errors.city = "Adaugă un oraș.";
            }else{removeInputError('city')}

        break;

        case 'updateDeliveryAddressForm':
            if (validator.isEmpty(formValues.update_contact_person, { ignore_whitespace:false })) {
                checkAndRemoveError('update_contact_person')
                errors.update_contact_person = "Adaugă o persoană de contact.";
            }else{ removeInputError('update_contact_person') }

            if (validator.isEmpty(formValues.update_street, { ignore_whitespace:false })) {
                checkAndRemoveError('update_street')
                errors.update_street = "Adaugă o stradă.";
            }else{removeInputError('update_street')}

            if (validator.isEmpty(formValues.update_nr, { ignore_whitespace:false })) {
                checkAndRemoveError('update_nr')
                errors.update_nr = "Adaugă un număr.";
            }else{ removeInputError('update_nr') }

            if (validator.isEmpty(formValues.update_county, { ignore_whitespace:false })) {
                checkAndRemoveError('update_county')
                errors.update_county = "Adaugă un județ.";
            }else{removeInputError('update_county')}

            if (validator.isEmpty(formValues.update_city, { ignore_whitespace:false })) {
                checkAndRemoveError('update_city')
                errors.update_city = "Adaugă un oraș.";
            }else{removeInputError('update_city')}

        break;

        case 'addProductForm':
            if (validator.isEmpty(formValues.name, { ignore_whitespace:false })) {
                checkAndRemoveError('name')
                errors.name = "Adaugă un nume pentru produs.";
                smoothScrollToDiv('addProductForm', 100);
            }else{ removeInputError('name') }

            if(formValues.gdpr !='true'){
                checkAndRemoveError('gdpr')
                errors.gdpr = "Trebuie să fii de acord cu termenii și condițiile și politica GDPR.";
            }else{removeInputError('gdpr')}

        break;

        case 'addCompanyDetails':
            if (validator.isEmpty(formValues.company_name, { ignore_whitespace:false })) {
                checkAndRemoveError('company_name')
                errors.company_name = "Adaugă un nume pentru companie.";
            }else{ removeInputError('company_name') }

            if (validator.isEmpty(formValues.company_type, { ignore_whitespace:false })) {
                checkAndRemoveError('company_type')
                errors.company_type = "Alege tipul de companie.";
            }else{removeInputError('company_type')}

            if (validator.isEmpty(formValues.company_vat_type, { ignore_whitespace:false })) {
                checkAndRemoveError('company_vat_type')
                errors.company_vat_type = "Alege tipul de companie.";
            }else{removeInputError('company_vat_type')}

            if (validator.isEmpty(formValues.company_cui, { ignore_whitespace:false })) {
                checkAndRemoveError('company_cui')
                errors.company_cui = "Adaugă CUI-ul.";
            }else{removeInputError('company_cui')}

            if (validator.isEmpty(formValues.company_j, { ignore_whitespace:false })) {
                checkAndRemoveError('company_j')
                errors.company_j = "Adaugă J-ul.";
            }else{removeInputError('company_j')}

            if (validator.isEmpty(formValues.company_nr, { ignore_whitespace:false })) {
                checkAndRemoveError('company_nr')
                errors.company_nr = "Adaugă numărul companiei.";
            }else{removeInputError('company_nr')}

            if (validator.isEmpty(formValues.company_series, { ignore_whitespace:false })) {
                checkAndRemoveError('company_series')
                errors.company_series = "Adaugă seria.";
            }else{removeInputError('company_series')}

            if (validator.isEmpty(formValues.company_year, { ignore_whitespace:false })) {
                checkAndRemoveError('company_year')
                errors.company_year = "Alege anul de înființare.";
            }else{removeInputError('company_year')}



        break;

        case 'editCompanyDetail':
            if (validator.isEmpty(formValues.company_name, { ignore_whitespace:false })) {
                checkAndRemoveError('company_name')
                errors.company_name = "Adaugă un nume pentru companie.";
            }else{ removeInputError('company_name') }

            if (validator.isEmpty(formValues.company_type, { ignore_whitespace:false })) {
                checkAndRemoveError('company_type')
                errors.company_type = "Alege tipul de companie.";
            }else{removeInputError('company_type')}

            if (validator.isEmpty(formValues.company_vat_type, { ignore_whitespace:false })) {
                checkAndRemoveError('company_vat_type')
                errors.company_vat_type = "Alege tipul de companie.";
            }else{removeInputError('company_vat_type')}

            if (validator.isEmpty(formValues.company_cui, { ignore_whitespace:false })) {
                checkAndRemoveError('company_cui')
                errors.company_cui = "Adaugă CUI-ul.";
            }else{removeInputError('company_cui')}

            if (validator.isEmpty(formValues.company_j, { ignore_whitespace:false })) {
                checkAndRemoveError('company_j')
                errors.company_j = "Adaugă J-ul.";
            }else{removeInputError('company_j')}

            if (validator.isEmpty(formValues.company_nr, { ignore_whitespace:false })) {
                checkAndRemoveError('company_nr')
                errors.company_nr = "Adaugă numărul companiei.";
            }else{removeInputError('company_nr')}

            if (validator.isEmpty(formValues.company_series, { ignore_whitespace:false })) {
                checkAndRemoveError('company_series')
                errors.company_series = "Adaugă seria.";
            }else{removeInputError('company_series')}

            if (validator.isEmpty(formValues.company_year, { ignore_whitespace:false })) {
                checkAndRemoveError('company_year')
                errors.company_year = "Alege anul de înființare.";
            }else{removeInputError('company_year')}


        break;

        case 'orderDetailForm':

            if (validator.isEmpty(formValues.name, { ignore_whitespace:false })) {
                checkAndRemoveError('name')
                errors.name = "Adaugă un nume.";
            }else{ removeInputError('name') }

            if (validator.isEmpty(formValues.surname, { ignore_whitespace:false })) {
                checkAndRemoveError('surname')
                errors.surname = "Adaugă un prenume.";
            }else{ removeInputError('surname') }

            if (validator.isEmpty(formValues.email, { ignore_whitespace:false })) {
                checkAndRemoveError('email')
                errors.email = "Adaugă un email.";
            }else{ removeInputError('email') }

            if (!validator.isEmail(formValues.email, { })) {
                checkAndRemoveError('email')
                errors.email = "Adaugă o adresă validă de email.";
            }else{removeInputError('email')}



            if (!validator.isMobilePhone(formValues.phone, "any")) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă un număr de telefon valid.";
            }else{removeInputError('phone')}

            if (!validator.isNumeric(formValues.phone, "any")) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă doar cifre.";
            }else{removeInputError('phone')}

            if (validator.isEmpty(formValues.phone, { ignore_whitespace:false })) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă un numar.";
            }else{ removeInputError('phone') }

            if (validator.isEmpty(formValues.county, { ignore_whitespace:false })) {
                checkAndRemoveError('county')
                errors.county = "Adaugă un județ.";
            }else{removeInputError('county')}

            if (validator.isEmpty(formValues.city, { ignore_whitespace:false })) {
                checkAndRemoveError('city')
                errors.city = "Adaugă un oraș.";
            }else{removeInputError('city')}

            if (validator.isEmpty(formValues.country, { ignore_whitespace:false })) {
                checkAndRemoveError('country')
                errors.country = "Adaugă o țară.";
            }else{removeInputError('country')}

            if (validator.isEmpty(formValues.street, { ignore_whitespace:false })) {
                checkAndRemoveError('street')
                errors.street = "Adaugă o stradă.";
            }else{removeInputError('street')}

            if (validator.isEmpty(formValues.nr, { ignore_whitespace:false })) {
                checkAndRemoveError('nr')
                errors.nr = "Adaugă un număr.";
            }else{ removeInputError('nr') }

            if(formValues.person_type=='juridica'){

                if (validator.isEmpty(formValues.company_name, { ignore_whitespace:false })) {
                    checkAndRemoveError('company_name')
                    errors.company_name = "Adaugă un nume pentru companie.";
                }else{ removeInputError('company_name') }

                if (validator.isEmpty(formValues.company_type, { ignore_whitespace:false })) {
                    checkAndRemoveError('company_type')
                    errors.company_type = "Alege tipul de companie.";
                }else{removeInputError('company_type')}

                if (validator.isEmpty(formValues.company_vat_type, { ignore_whitespace:false })) {
                    checkAndRemoveError('company_vat_type')
                    errors.company_vat_type = "Alege tipul de companie.";
                }else{removeInputError('company_vat_type')}

                if (validator.isEmpty(formValues.company_cui, { ignore_whitespace:false })) {
                    checkAndRemoveError('company_cui')
                    errors.company_cui = "Adaugă CUI-ul.";
                }else{removeInputError('company_cui')}

                if (validator.isEmpty(formValues.company_j, { ignore_whitespace:false })) {
                    checkAndRemoveError('company_j')
                    errors.company_j = "Adaugă J-ul.";
                }else{removeInputError('company_j')}

                if (validator.isEmpty(formValues.company_nr, { ignore_whitespace:false })) {
                    checkAndRemoveError('company_nr')
                    errors.company_nr = "Adaugă numărul companiei.";
                }else{removeInputError('company_nr')}

                if (validator.isEmpty(formValues.company_series, { ignore_whitespace:false })) {
                    checkAndRemoveError('company_series')
                    errors.company_series = "Adaugă seria.";
                }else{removeInputError('company_series')}

                if (validator.isEmpty(formValues.company_year, { ignore_whitespace:false })) {
                    checkAndRemoveError('company_year')
                    errors.company_year = "Alege anul de înființare.";
                }else{removeInputError('company_year')}



            }else{
                removeInputError('company_name');
                removeInputError('company_type');
                removeInputError('company_vat_type');
                removeInputError('company_cui');
                removeInputError('company_j');
                removeInputError('company_nr');
                removeInputError('company_series');
                removeInputError('company_year');

            }

            if(formValues.gdpr !='true'){
                checkAndRemoveError('gdpr')
                errors.gdpr = "Trebuie să fii de acord cu politica GDPR.";
            }else{removeInputError('gdpr')}

            if(formValues.terms !='true'){
                checkAndRemoveError('terms')
                errors.terms = "Trebuie să fii de acord cu termenii și condițiile site-ului.";
            }else{removeInputError('terms')}


        break;

        case 'contactForm':
            if (validator.isEmpty(formValues.name, { ignore_whitespace:false })) {
                checkAndRemoveError('name')
                errors.name = "Adaugă un nume.";
            }else{ removeInputError('name') }

            if (validator.isEmpty(formValues.email, { ignore_whitespace:false })) {
                checkAndRemoveError('email')
                errors.email = "Adaugă un email.";
            }else{ removeInputError('email') }

            if (!validator.isEmail(formValues.email, { })) {
                checkAndRemoveError('email')
                errors.email = "Adaugă o adresă validă de email.";
            }else{removeInputError('email')}

            if (!validator.isMobilePhone(formValues.phone, "any")) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă un număr de telefon valid.";
            }else{removeInputError('phone')}

            if (!validator.isNumeric(formValues.phone, "any")) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă doar cifre.";
            }else{removeInputError('phone')}

            if (validator.isEmpty(formValues.phone, { ignore_whitespace:false })) {
                checkAndRemoveError('phone')
                errors.phone = "Adaugă un numar.";
            }else{ removeInputError('phone') }

            if (validator.isEmpty(formValues.county, { ignore_whitespace:false })) {
                checkAndRemoveError('county')
                errors.county = "Adaugă un județ.";
            }else{ removeInputError('county') }

            if (validator.isEmpty(formValues.city, { ignore_whitespace:false })) {
                checkAndRemoveError('city')
                errors.city = "Adaugă un oraș.";
            }else{ removeInputError('city') }

            if (validator.isEmpty(formValues.subject, { ignore_whitespace:false })) {
                checkAndRemoveError('subject')
                errors.subject = "Adaugă un subiect.";
            }else{ removeInputError('subject') }

            if (validator.isEmpty(formValues.message, { ignore_whitespace:false })) {
                checkAndRemoveError('message')
                errors.message = "Adaugă un mesaj.";
            }else{ removeInputError('message') }

            if(formValues.gdpr !='true'){
                checkAndRemoveError('gdpr')
                errors.gdpr = "Trebuie să fii de acord cu politica GDPR.";
            }else{removeInputError('gdpr')}

            if(formValues.terms !='true'){
                checkAndRemoveError('terms')
                errors.terms = "Trebuie să fii de acord cu termenii și condițiile site-ului.";
            }else{removeInputError('terms')}


        break;

        case 'nlSubscribe':
            if (validator.isEmpty(formValues.nl_email, { ignore_whitespace:false })) {
                checkAndRemoveError('nl_email')
                errors.nl_email = "Adaugă un email.";
            }else{ removeInputError('nl_email') }

            if (!validator.isEmail(formValues.nl_email, { })) {
                checkAndRemoveError('nl_email')
                errors.nl_email = "Adaugă o adresă validă de email.";
            }else{removeInputError('nl_email')}

        break;


        default:
            break;
    }


    if (Object.keys(errors).length > 0) {
        processError(errors, 'inForm')
    }else{
        return true;
    }
}

function removeInputError(input){
    document.getElementById(input).classList.remove('errorField');
    let errFields = document.getElementById(input).parentElement.querySelectorAll('.errorInput');
        errFields.forEach(element => {
            element.remove();
        });
}
function checkAndRemoveError(input){
    if(document.getElementById(input).parentElement.querySelectorAll('.errorInput').length > 0){
        let errFields = document.getElementById(input).parentElement.querySelectorAll('.errorInput');
            errFields.forEach(element => {
                element.remove();
            });
    }
}

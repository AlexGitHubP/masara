
<div class='update-profile-image'>
    <div class='modal-element'>
        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class='close-modal'>
            <path d="M18.8242 18.8198L1 1" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M18.8242 1L1 18.8198" stroke="#909090" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>            
        <h2>Adaugă/Modifcă imagine de profil</h2>
        <form action="" method='POST' id='updateAccountImage'>
            @csrf
            <input type="hidden" id='userRole' name='userRole' value='{{$userRole}}'>
            <input type="hidden" id='accountID' name='accountID' value='{{$accountID}}'>
            <div id='profileImageUploader' class='general-btn'>Încarcă imagine nouă</div>
            <div class='profileImagePreview'></div>

            <div class='double-btn-hold'>
                <div class='btn-hold'>
                    <input type="submit" value='Salvează imaginea' class='general-btn uploadImageTrigger'>
                    <div class='loader'>
                        <img src="{{url('img/loader.svg')}}" alt="">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
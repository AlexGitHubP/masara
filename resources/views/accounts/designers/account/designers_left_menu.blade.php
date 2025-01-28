<div class='dashboard-account-image'>
    <div class='editProfileImage'>
        <img src="{{url($profilePicture)}}" alt="">
    </div>
    <span class='editIcon' data-profileid='{{$accountID}}'>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
            <path id="Edit" d="M15.182,3.5a1.318,1.318,0,0,0-.932.386L13.076,5.059l1.865,1.864,1.173-1.173A1.318,1.318,0,0,0,15.182,3.5Zm-1.3,4.484L12.016,6.12l-7.5,7.5-.7,2.564,2.564-.7Zm.223-5.77a2.818,2.818,0,0,1,3.071,4.6L7.3,16.683a.75.75,0,0,1-.333.193l-4.022,1.1a.75.75,0,0,1-.921-.921l1.1-4.022a.749.749,0,0,1,.193-.333l9.872-9.872A2.819,2.819,0,0,1,14.1,2.215Z" transform="translate(-2 -2)" fill="#262626" fill-rule="evenodd"/>
        </svg>              
    </span>
</div>
<div class='dashboard-left-nav'>
    <ul>
        <li>
            <a href="{{url('designer/logout.html')}}">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 8.52V3.98C22 2.57 21.36 2 19.77 2H15.73C14.14 2 13.5 2.57 13.5 3.98V8.51C13.5 9.93 14.14 10.49 15.73 10.49H19.77C21.36 10.5 22 9.93 22 8.52Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 19.77V15.73C22 14.14 21.36 13.5 19.77 13.5H15.73C14.14 13.5 13.5 14.14 13.5 15.73V19.77C13.5 21.36 14.14 22 15.73 22H19.77C21.36 22 22 21.36 22 19.77Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.5 8.52V3.98C10.5 2.57 9.86 2 8.27 2H4.23C2.64 2 2 2.57 2 3.98V8.51C2 9.93 2.64 10.49 4.23 10.49H8.27C9.86 10.5 10.5 9.93 10.5 8.52Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.5 19.77V15.73C10.5 14.14 9.86 13.5 8.27 13.5H4.23C2.64 13.5 2 14.14 2 15.73V19.77C2 21.36 2.64 22 4.23 22H8.27C9.86 22 10.5 21.36 10.5 19.77Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            Logout</a>
        </li>
        <li>
            <a href="{{url('cont-designer/dashboard.html')}}">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 8.52V3.98C22 2.57 21.36 2 19.77 2H15.73C14.14 2 13.5 2.57 13.5 3.98V8.51C13.5 9.93 14.14 10.49 15.73 10.49H19.77C21.36 10.5 22 9.93 22 8.52Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 19.77V15.73C22 14.14 21.36 13.5 19.77 13.5H15.73C14.14 13.5 13.5 14.14 13.5 15.73V19.77C13.5 21.36 14.14 22 15.73 22H19.77C21.36 22 22 21.36 22 19.77Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.5 8.52V3.98C10.5 2.57 9.86 2 8.27 2H4.23C2.64 2 2 2.57 2 3.98V8.51C2 9.93 2.64 10.49 4.23 10.49H8.27C9.86 10.5 10.5 9.93 10.5 8.52Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.5 19.77V15.73C10.5 14.14 9.86 13.5 8.27 13.5H4.23C2.64 13.5 2 14.14 2 15.73V19.77C2 21.36 2.64 22 4.23 22H8.27C9.86 22 10.5 21.36 10.5 19.77Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            Dashboard</a>
        </li>
        <li>
            <a href="{{url('cont-designer/administrativ.html')}}">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 8V16" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 8V12" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 15V16" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 8V9" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 8V16" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 12V16" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18 8V16" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Administrativ</a>
        </li>
        <li>
            <a href="{{url('cont-designer/rapoarte.html')}}">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 22H21" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5.59998 8.38H4C3.45 8.38 3 8.83 3 9.38V18C3 18.55 3.45 19 4 19H5.59998C6.14998 19 6.59998 18.55 6.59998 18V9.38C6.59998 8.83 6.14998 8.38 5.59998 8.38Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.7992 5.19H11.1992C10.6492 5.19 10.1992 5.64 10.1992 6.19V18C10.1992 18.55 10.6492 19 11.1992 19H12.7992C13.3492 19 13.7992 18.55 13.7992 18V6.19C13.7992 5.64 13.3492 5.19 12.7992 5.19Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19.9984 2H18.3984C17.8484 2 17.3984 2.45 17.3984 3V18C17.3984 18.55 17.8484 19 18.3984 19H19.9984C20.5484 19 20.9984 18.55 20.9984 18V3C20.9984 2.45 20.5484 2 19.9984 2Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Rapoarte</a>
        </li>
        <li>
            <a href="{{url('cont-designer/produsele-mele.html')}}">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 9V7C2 4 4 2 7 2H17C20 2 22 4 22 7V9" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 15V17C2 20 4 22 7 22H17C20 22 22 20 22 17V15" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.69922 9.26001L11.9992 12.33L17.2592 9.28003" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 17.77V12.32" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.7583 6.29L7.55827 8.07003C6.83827 8.47003 6.23828 9.48002 6.23828 10.31V13.7C6.23828 14.53 6.82827 15.54 7.55827 15.94L10.7583 17.72C11.4383 18.1 12.5583 18.1 13.2483 17.72L16.4483 15.94C17.1683 15.54 17.7683 14.53 17.7683 13.7V10.31C17.7683 9.48002 17.1783 8.47003 16.4483 8.07003L13.2483 6.29C12.5583 5.9 11.4383 5.9 10.7583 6.29Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Produsele mele</a>
        </li>
        <li>
            <a href="{{url('cont-designer/editare-cont.html')}}">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19.211 15.74L15.671 19.2801C15.531 19.4201 15.401 19.68 15.371 19.87L15.181 21.22C15.111 21.71 15.451 22.05 15.941 21.98L17.291 21.79C17.481 21.76 17.751 21.63 17.881 21.49L21.421 17.95C22.031 17.34 22.321 16.63 21.421 15.73C20.531 14.84 19.821 15.13 19.211 15.74Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.6992 16.25C18.9992 17.33 19.8392 18.17 20.9192 18.47" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.41016 22C3.41016 18.13 7.26018 15 12.0002 15C13.0402 15 14.0402 15.15 14.9702 15.43" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Editează cont</a>
        </li>
    </ul>
    <div class='dashboard-btn-hold'>
        <a href="{{url('cont-designer/adauga-produs.html')}}" class='general-btn'>Adaugă produs</a>
    </div>
</div>
@include('accounts.profile_image_edit', ['accountID'=>$accountID, 'userRole'=>$userRole])
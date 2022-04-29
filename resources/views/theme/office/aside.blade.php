<div id="kt_aside" class="aside pb-5 pt-5 pt-lg-0" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'80px', '300px': '100px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo py-8" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="index.html" class="d-flex align-items-center">
            <img alt="Logo" src="{{asset('assets/media/logos/logo.svg')}}" class="h-45px logo" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid" id="kt_aside_menu">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-2 my-lg-5 pe-lg-n1" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item py-2">
                    <a class="menu-link active menu-center" href="index.html" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-house fs-2"></i>
                        </span>
                        <span class="menu-title">Home</span>
                    </a>
                </div>
                
                {{-- <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-2">
                    <span class="menu-link menu-center" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-file-earmark-lock fs-2"></i>
                        </span>
                        <span class="menu-title">Auth</span>
                    </span>
                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Authentication</span>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Basic</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/flows/basic/sign-in.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Sign-in</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/flows/basic/sign-up.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Sign-up</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/flows/basic/two-steps.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Two-steps</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/flows/basic/password-reset.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Password Reset</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/flows/basic/new-password.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">New Password</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Extended</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/extended/multi-steps-sign-up.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Multi-steps Sign-up</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/extended/free-trial-sign-up.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Free Trial Sign-up</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/extended/coming-soon.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Coming Soon</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/general/verify-email.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Verify Email</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/general/password-confirmation.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Password Confirmation</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-accordion">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">General</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-sub-lg-dropdown w-lg-225px px-lg-1 py-lg-4">
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/general/welcome.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Welcome</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/general/verify-email.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Verify Email</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/general/password-confirmation.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Password Confirmation</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/general/close-account.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Close Account</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/general/error-404.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Error 404</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/general/error-500.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Error 500</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item menu-accordion">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Email</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-sub-lg-dropdown w-lg-225px px-lg-1 py-lg-4">
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/email/verify-email.html" target="blank">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Verify Email</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/email/password-reset.html" target="blank">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Password Reset</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="authentication/email/password-change.html" target="blank">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Password Change</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-2">
                    <span class="menu-link menu-center" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-shield-check fs-2"></i>
                        </span>
                        <span class="menu-title">Account</span>
                    </span>
                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Account</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="account/overview.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Overview</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="account/settings.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Settings</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="account/security.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Security</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="account/billing.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Billing</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="account/statements.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Statements</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="account/referrals.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Referrals</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="account/api-keys.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">API Keys</span>
                            </a>
                        </div>
                    </div>
                </div> --}}
                <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-2">
                    <span class="menu-link menu-center" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-chat-square-text fs-2"></i>
                        </span>
                        <span class="menu-title">Chat</span>
                    </span>
                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Chat</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="apps/chat/private.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Private Chat</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="apps/chat/group.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Group Chat</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="apps/chat/drawer.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Drawer Chat</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-2">
                    <span class="menu-link menu-center" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-people fs-2"></i>
                        </span>
                        <span class="menu-title">Users</span>
                    </span>
                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Users</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{route('office.users')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Users Listing</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Create User</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-2">
                    <span class="menu-link menu-center" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0">
                            <i class="bi bi-file-text fs-2"></i>
                        </span>
                        <span class="menu-title">General</span>
                    </span>
                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">General</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/company/about.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">About Us</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/company/pricing.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Pricing</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/company/contact.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Contact Us</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/company/team.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Our Team</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/company/licenses.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Licenses</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pages/company/sitemap.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Sitemap</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item py-2">
                    <a class="menu-link" href="index.html" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Sign-out.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) "/>
                                    <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1"/>
                                    <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) "/>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Logout</span>
                    </a>
                </div>
            </div>
            
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->

</div>
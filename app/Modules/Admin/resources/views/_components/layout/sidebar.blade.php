<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
    <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close">
    </i>
  </button>
    <div id="m_aside_left" style="background: black" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
        <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
            m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                <li class="m-menu__item  m-menu__item @yield('dashboard-active')" aria-haspopup="true">
                    <a href="{{ route('admins.home') }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">Dashboard</span>
                            </span>
                        </span>
                    </a>
                </li>
                <!-- Start Notifications Module -->
                <li  class="m-menu__item  m-menu__item--submenu @yield('notifications-active')" aria-haspopup="true"
                    m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fa fa-bell"> </i>
                        <span class="m-menu__link-text">User Notifications </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item @yield('notifications-create-active')" aria-haspopup="true">
                                <a href="{{route('admins.notification.create')}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus">
                                  <span></span>
                              </i>
                                    <span class="m-menu__link-text"> Add New</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('notifications-view-active')" aria-haspopup="true">
                                <a href="{{route('admins.notification.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                                  <span> </span>
                              </i>
                                    <span class="m-menu__link-text">View</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End Notifications Module -->
                <li class="m-menu__section ">
                    <h4 class="m-menu__section-text">Reports
                    </h4>
                    <i class="m-menu__section-icon flaticon-more-v2"></i>
                </li>
                <!-- Start Account Reports Module -->

                <li   class="m-menu__item  m-menu__item--submenu @yield('reports-accounts-active')" aria-haspopup="true"
                      m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fa fa-file"> </i>
                        <span class="m-menu__link-text">Accounts Reports </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item @yield('reports-accounts-request-active')" aria-haspopup="true">
                                <a href="{{route('admins.accountReport.index').'?view=Pending'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-paper-plane">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text"> Requests
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="request-account_reports-request">
                                                {{$reportAccountsRequestsCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('reports-accounts-view-active')" aria-haspopup="true">
                                <a href="{{route('admins.accountReport.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                                        <span> </span>
                                    </i>
                                    <span class="m-menu__link-text">View all</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('reports-accounts-Dismissed-active')" aria-haspopup="true">
                                <a href="{{route('admins.accountReport.index').'?view=Dismissed'}}"
                                   class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-minus"><span> </span></i>
                                    <span class="m-menu__link-text">Dismissed
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-account_reports-dismissed">
                                                {{$reportAccountsDismissedCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('reports-accounts-trash-active')" aria-haspopup="true">
                                <a href="{{route('admins.accountReport.index').'?view=trash'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text"> Recycle bin
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-account_reports">
                                                {{$reportAccountsTrashesCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End Account Reports Module -->

                <!-- Start Post Reports Module -->
                <li   class="m-menu__item  m-menu__item--submenu @yield('reports-posts-active')" aria-haspopup="true"
                      m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fa fa-file"> </i>
                        <span class="m-menu__link-text">Posts Reports </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item @yield('reports-posts-request-active')" aria-haspopup="true">
                                <a href="{{route('admins.postReport.index').'?view=Pending'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-paper-plane">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text"> Requests
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="request-post_reports-request">
                                                {{$reportPostsRequestsCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('reports-posts-view-active')" aria-haspopup="true">
                                <a href="{{route('admins.postReport.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                                        <span> </span>
                                    </i>
                                    <span class="m-menu__link-text">View all</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('reports-posts-Dismissed-active')" aria-haspopup="true">
                                <a href="{{route('admins.postReport.index').'?view=Dismissed'}}"
                                   class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-minus"><span> </span></i>
                                    <span class="m-menu__link-text">Dismissed
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-post_reports-dismissed">
                                                {{$reportPostsDismissedCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('reports-posts-trash-active')" aria-haspopup="true">
                                <a href="{{route('admins.postReport.index').'?view=trash'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text"> Recycle bin
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-post_reports">
                                                {{$reportPostsTrashesCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End Post Reports Module -->

                <li class="m-menu__section ">
                    <h4 class="m-menu__section-text">Users
                    </h4>
                    <i class="m-menu__section-icon flaticon-more-v2"></i>
                </li>
                <!-- Start Admin Module -->
                <li class="m-menu__item  m-menu__item--submenu @yield('admins-active')" aria-haspopup="true"
                    m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-user-cog"> </i>
                        <span class="m-menu__link-text">Admins </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item @yield('admins-create-active')" aria-haspopup="true">
                                <a href="{{route('admins.admin.create')}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus"><span></span></i>
                                    <span class="m-menu__link-text"> Add New</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('admins-view-active')" aria-haspopup="true">
                                <a href="{{route('admins.admin.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye"><span> </span></i>
                                    <span class="m-menu__link-text">View</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('admins-trash-active')" aria-haspopup="true">
                                <a href="{{route('admins.admin.index').'?view=trash'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash"><span></span></i>
                                    <span class="m-menu__link-text"> Recycle bin
                                         <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-admins">
                                                {{$adminTrashesCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End Admin Module -->
                <!-- Start Individual Module -->
                <li class="m-menu__item  m-menu__item--submenu @yield('individuals-active')" aria-haspopup="true"
                    m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-user-minus"> </i>
                        <span class="m-menu__link-text">Individuals </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item @yield('individuals-create-active')" aria-haspopup="true">
                                <a href="{{route('admins.individual.create')}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus"><span></span></i>
                                    <span class="m-menu__link-text"> Add New</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('individuals-view-active')" aria-haspopup="true">
                                <a href="{{route('admins.individual.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye"><span> </span></i>
                                    <span class="m-menu__link-text">View All</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('individuals-verified-active')" aria-haspopup="true">
                                <a href="{{route('admins.individual.index').'?view=verified'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-check"><span> </span></i>
                                    <span class="m-menu__link-text">Verified</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('individuals-notVerified-active')" aria-haspopup="true">
                                <a href="{{route('admins.individual.index').'?view=notVerified'}}"
                                    class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-minus"><span> </span></i>
                                    <span class="m-menu__link-text">Not Verified</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('individuals-blocked-active')" aria-haspopup="true">
                                <a href="{{route('admins.individual.index').'?view=blocked'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-ban"><span></span></i>
                                    <span class="m-menu__link-text"> Blocked
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-individuals-blocked">
                                                {{$individualsBlockedCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('individuals-trash-active')" aria-haspopup="true">
                                <a href="{{route('admins.individual.index').'?view=trash'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash"><span></span></i>
                                    <span class="m-menu__link-text"> Recycle bin
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-individuals">
                                                {{$individualTrashesCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End Individual Module -->

                <!-- Start Broker Module -->
                <li class="m-menu__item  m-menu__item--submenu @yield('brokers-active')" aria-haspopup="true"
                    m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-user-circle"> </i>
                        <span class="m-menu__link-text">Brokers </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item @yield('brokers-create-active')" aria-haspopup="true">
                                <a href="{{route('admins.broker.create')}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus"> <span></span></i>
                                    <span class="m-menu__link-text"> Add New</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('brokers-view-active')" aria-haspopup="true">
                                <a href="{{route('admins.broker.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye"><span> </span></i>
                                    <span class="m-menu__link-text">View All</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('brokers-verified-active')" aria-haspopup="true">
                                <a href="{{route('admins.broker.index').'?view=verified'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-check"><span> </span></i>
                                    <span class="m-menu__link-text">Verified</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('brokers-notVerified-active')" aria-haspopup="true">
                                <a href="{{route('admins.broker.index').'?view=notVerified'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-minus"><span> </span></i>
                                    <span class="m-menu__link-text">Not Verified</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('brokers-blocked-active')" aria-haspopup="true">
                                <a href="{{route('admins.broker.index').'?view=blocked'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-ban"><span></span></i>
                                        <span class="m-menu__link-text"> Blocked<span class="m-menu__link-badge"><span class="m-badge m-badge--danger" id="module-brokers-blocked">
                                        {{$brokersBlockedCount}}</span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('brokers-trash-active')" aria-haspopup="true">
                                <a href="{{route('admins.broker.index').'?view=trash'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash"><span></span></i>
                                    <span class="m-menu__link-text"> Recycle bin
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-brokers">
                                                {{$brokerTrashesCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End Broker Module -->

                <!-- Start Developer Module -->
                <li class="m-menu__item  m-menu__item--submenu @yield('developers-active')" aria-haspopup="true"
                    m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fas fa-user-ninja"> </i>
                        <span class="m-menu__link-text">Developers </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item @yield('developers-create-active')" aria-haspopup="true">
                                <a href="{{route('admins.developer.create')}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus"><span></span></i>
                                    <span class="m-menu__link-text"> Add New</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('developers-view-active')" aria-haspopup="true">
                                <a href="{{route('admins.developer.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye"><span> </span></i>
                                    <span class="m-menu__link-text">View All</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('developers-verified-active')" aria-haspopup="true">
                                <a href="{{route('admins.developer.index').'?view=verified'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-check"><span> </span></i>
                                    <span class="m-menu__link-text">Verified</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('developers-notVerified-active')" aria-haspopup="true">
                                <a href="{{route('admins.developer.index').'?view=notVerified'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-minus"><span> </span></i>
                                    <span class="m-menu__link-text">Not Verified</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('developers-blocked-active')" aria-haspopup="true">
                                <a href="{{route('admins.developer.index').'?view=blocked'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-ban"><span></span></i>
                                    <span class="m-menu__link-text"> Blocked
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-developers-blocked">
                                                {{$developersBlockedCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('developers-trash-active')" aria-haspopup="true">
                                <a href="{{route('admins.developer.index').'?view=trash'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash"><span></span></i>
                                    <span class="m-menu__link-text"> Recycle bin
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-developers">
                                                {{$developerTrashesCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End Developer Module -->
                <!-- Start Profile Colour Module -->
                <li  class="m-menu__item  m-menu__item--submenu @yield('profile_colours-active')" aria-haspopup="true"
                    m-menu-submenu-toggle="hover">
                    <a href="{{route('admins.profile_colour.index').'?view=view'}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fa fa-paint-brush"> </i>
                        <span class="m-menu__link-text">Profile Colour </span>
                    </a>
                </li>
                <!-- End Profile Colour Module -->
                <!------------------------------------Areas------------------------------------------>
                <li class="m-menu__section ">
                    <h4 class="m-menu__section-text">Areas</h4>
                    <i class="m-menu__section-icon flaticon-more-v2"> </i>
                </li>
                <!-- Start City Module -->
                <li class="m-menu__item  m-menu__item--submenu @yield('cities-active')" aria-haspopup="true"
                    m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fa fa-building"> </i>
                        <span class="m-menu__link-text">Cities </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item @yield('cities-create-active')" aria-haspopup="true">
                                <a href="{{route('admins.city.create')}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus">
                                  <span></span>
                              </i>
                                    <span class="m-menu__link-text"> Add New</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('cities-view-active')" aria-haspopup="true">
                                <a href="{{route('admins.city.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                                  <span> </span>
                              </i>
                                    <span class="m-menu__link-text">View</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('cities-trash-active')" aria-haspopup="true">
                                <a href="{{route('admins.city.index').'?view=trash'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash">
                                  <span></span>
                              </i>
                                    <span class="m-menu__link-text"> Recycle bin
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-cities">
                                                {{$cityTrashesCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End City Module -->
                <!-- Start Area Module -->
                <li class="m-menu__item  m-menu__item--submenu @yield('areas-active')" aria-haspopup="true"
                    m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon fa fa-area-chart"> </i>
                        <span class="m-menu__link-text">Areas </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item @yield('areas-create-active')" aria-haspopup="true">
                                <a href="{{route('admins.area.create')}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-plus">
                                  <span></span>
                              </i>
                                    <span class="m-menu__link-text"> Add New</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('areas-view-active')" aria-haspopup="true">
                                <a href="{{route('admins.area.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                                  <span> </span>
                              </i>
                                    <span class="m-menu__link-text">View</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('areas-trash-active')" aria-haspopup="true">
                                <a href="{{route('admins.area.index').'?view=trash'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash">
                                  <span></span>
                              </i>
                                    <span class="m-menu__link-text"> Recycle bin
                    <span class="m-menu__link-badge">
                      <span class="m-badge m-badge--danger" id="module-areas">
                        {{$areaTrashesCount}}
                      </span>
                                    </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End Area Module -->
                <li  class="m-menu__section ">
                    <h4 class="m-menu__section-text">Communication
                    </h4>
                    <i class="m-menu__section-icon flaticon-more-v2">
                </i>
                </li>
                <!-- Start Posts Module -->
                <li   class="m-menu__item  m-menu__item--submenu @yield('posts-active')" aria-haspopup="true"
                    m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon 	far fa-file-alt"> </i>
                        <span class="m-menu__link-text">Posts </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu ">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item @yield('posts-view-active')" aria-haspopup="true">
                                <a href="{{route('admins.post.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye">
                                        <span> </span>
                                    </i>
                                    <span class="m-menu__link-text"> Individual Posts</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('posts-request-active')" aria-haspopup="true">
                                <a href="{{route('admins.post.index').'?view=request'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-paper-plane">
                                  <span></span>
                              </i>
                                    <span class="m-menu__link-text"> Individual Requests
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-requests-posts">
                                                {{$postRequestsCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('listings-view-active')" aria-haspopup="true" style="margin-bottom:10px ">
                                <a href="{{route('admins.listing.index').'?view=view'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye"><span> </span></i>
                                    <span class="m-menu__link-text"> Developer & Broker Posts</span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('listings-request-active')" aria-haspopup="true">
                                <a href="{{route('admins.listing.index').'?view=request'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-paper-plane">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">Developer & Broker Requests
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-requests-listings">
                                                {{$listingRequestsCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('posts-trash-active')" aria-haspopup="true">
                                <a href="{{route('admins.post.index').'?view=trash'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash">
                                  <span></span>
                              </i>
                                    <span class="m-menu__link-text"> Posts Recycle bin
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-posts">
                                                {{$postTrashesCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-menu__item @yield('listings-trash-active')" aria-haspopup="true">
                                <a href="{{route('admins.listing.index').'?view=trash'}}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash"><span></span></i>
                                    <span class="m-menu__link-text"> Listing Recycle bin
                                        <span class="m-menu__link-badge">
                                            <span class="m-badge m-badge--danger" id="module-listings">
                                                {{$listingTrashesCount}}
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End Posts Module -->
{{--                <!-- Start Listings Module -->--}}
{{--                <li  class="m-menu__item  m-menu__item--submenu @yield('listings-active')" aria-haspopup="true"--}}
{{--                    m-menu-submenu-toggle="hover">--}}
{{--                    <a href="javascript:;" class="m-menu__link m-menu__toggle">--}}
{{--                        <i class="m-menu__link-icon fa fa-list"> </i>--}}
{{--                        <span class="m-menu__link-text">Listings</span>--}}
{{--                        <i class="m-menu__ver-arrow la la-angle-right"></i>--}}
{{--                    </a>--}}
{{--                    <div class="m-menu__submenu ">--}}
{{--                        <span class="m-menu__arrow"></span>--}}
{{--                        <ul class="m-menu__subnav">--}}
{{--                            <li class="m-menu__item @yield('listings-request-active')" aria-haspopup="true">--}}
{{--                                <a href="{{route('admins.listing.index').'?view=request'}}" class="m-menu__link ">--}}
{{--                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-paper-plane">--}}
{{--                                  <span></span>--}}
{{--                              </i>--}}
{{--                                    <span class="m-menu__link-text">Developer & Broker Requests--}}
{{--                                        <span class="m-menu__link-badge">--}}
{{--                                            <span class="m-badge m-badge--danger" id="module-requests-listings">--}}
{{--                                                {{$listingRequestsCount}}--}}
{{--                                            </span>--}}
{{--                                        </span>--}}
{{--                                    </span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="m-menu__item @yield('listings-view-active')" aria-haspopup="true">--}}
{{--                                <a href="{{route('admins.listing.index').'?view=view'}}" class="m-menu__link ">--}}
{{--                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye"><span> </span></i>--}}
{{--                                    <span class="m-menu__link-text"> Developer & Broker Listings</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="m-menu__item @yield('listings-trash-active')" aria-haspopup="true">--}}
{{--                                <a href="{{route('admins.listing.index').'?view=trash'}}" class="m-menu__link ">--}}
{{--                                    <i class="m-menu__link-bullet m-menu__link-icon fa fa-trash"><span></span></i>--}}
{{--                                    <span class="m-menu__link-text"> listing Recycle bin--}}
{{--                                        <span class="m-menu__link-badge">--}}
{{--                                            <span class="m-badge m-badge--danger" id="module-listings">--}}
{{--                                                {{$listingTrashesCount}}--}}
{{--                                            </span>--}}
{{--                                        </span>--}}
{{--                                    </span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <!-- End Listings Module -->--}}
            </ul>
        </div>
    </div>
</div>

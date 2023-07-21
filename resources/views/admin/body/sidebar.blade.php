<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Admin<span>Side</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Real Estate</li>

            @if (Auth::user()->can('type.menu'))

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false"
                        aria-controls="emails">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">Property Type</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="emails">
                        <ul class="nav sub-menu">

                            @if (Auth::user()->can('all.type'))
                                <li class="nav-item">
                                    <a href="{{ route('all.type') }}" class="nav-link">All Type</a>
                                </li>
                            @endif

                            @if (Auth::user()->can('add.type'))
                                <li class="nav-item">
                                    <a href="{{ route('add.type') }}" class="nav-link">Add Type</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>

            @endif

            @if (Auth::user()->can('state.menu'))

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#state" role="button" aria-expanded="false"
                        aria-controls="state">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">Property State </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="state">
                        <ul class="nav sub-menu">

                            @if (Auth::user()->can('state.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.state') }}" class="nav-link">All State</a>
                                </li>
                            @endif

                            @if (Auth::user()->can('state.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.state') }}" class="nav-link">Add State</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>

            @endif

            @if (Auth::user()->can('amenities.menu'))

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#amenities" role="button" aria-expanded="false"
                        aria-controls="amenities">
                        <i class="link-icon" data-feather="package"></i>
                        <span class="link-title">Amenitites</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="amenities">
                        <ul class="nav sub-menu">

                            @if (Auth::user()->can('amenities.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.amenities') }}" class="nav-link">All Amenitites</a>
                                </li>
                            @endif

                            @if (Auth::user()->can('amenities.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.amenities') }}" class="nav-link">Add Amenitites</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>

            @endif

            @if (Auth::user()->can('property.menu'))

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="false"
                        aria-controls="property">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">Property</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="property">
                        <ul class="nav sub-menu">

                            @if (Auth::user()->can('property.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.property') }}" class="nav-link">All Property</a>
                                </li>
                            @endif

                            @if (Auth::user()->can('property.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.property') }}" class="nav-link">Add Property</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>

            @endif

            @if (Auth::user()->can('history.menu'))
                <li class="nav-item">
                    <a href="{{ route('admin.package.history') }}" class="nav-link" aria-controls="package-history">
                        <i class="link-icon" data-feather="clipboard"></i>
                        <span class="link-title">Package History</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->can('message.menu'))
                <li class="nav-item">
                    <a href="{{ route('admin.property.message') }}" class="nav-link">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Property Message</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->can('testimonials.menu'))

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#testimonials" role="button"
                        aria-expanded="false" aria-controls="testimonials">
                        <i class="link-icon" data-feather="file-text"></i>
                        <span class="link-title">Testimonials Manage </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="testimonials">
                        <ul class="nav sub-menu">

                            @if (Auth::user()->can('testimonials.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.testimonials') }}" class="nav-link">All Testimonials</a>
                                </li>
                            @endif

                            @if (Auth::user()->can('testimonials.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.testimonials') }}" class="nav-link">Add Testimonials</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>

            @endif


            @if (Auth::user()->can('agent.menu'))



                <li class="nav-item nav-category">User All Functions</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#manageAgent" role="button"
                        aria-expanded="false" aria-controls="manageAgent">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Manage Agent</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="manageAgent">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('agent.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.agent') }}" class="nav-link">All Agent</a>
                                </li>
                            @endif

                            @if (Auth::user()->can('agent.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.agent') }}" class="nav-link">Add Agent</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>

            @endif


            @if (Auth::user()->can('category.menu'))


                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#blogcategory" role="button"
                        aria-expanded="false" aria-controls="uiComponents">
                        <i class="link-icon" data-feather="file"></i>
                        <span class="link-title">Blog Category </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="blogcategory">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                @if (Auth::user()->can('category.all'))
                                    <a href="{{ route('all.blog.category') }}" class="nav-link">All Blog Category
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </li>

            @endif


            @if (Auth::user()->can('post.menu'))

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#Post" role="button"
                        aria-expanded="false" aria-controls="Post">
                        <i class="link-icon" data-feather="file-text"></i>
                        <span class="link-title">Blog Post </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="Post">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('post.all'))
                                <li class="nav-item">
                                    <a href="{{ route('all.post') }}" class="nav-link">All Post </a>
                                </li>
                            @endif

                            @if (Auth::user()->can('post.add'))
                                <li class="nav-item">
                                    <a href="{{ route('add.post') }}" class="nav-link">Add Post </a>
                                </li>
                            @endif


                        </ul>
                    </div>
                </li>

            @endif

            @if (Auth::user()->can('comment.menu'))
                <li class="nav-item">
                    <a href="{{ route('admin.blog.comment') }}" class="nav-link">
                        <i class="link-icon" data-feather="message-square"></i>
                        <span class="link-title">Blog Comment </span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->can('smtp.menu'))
                <li class="nav-item">
                    <a href="{{ route('smtp.setting') }}" class="nav-link">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">SMTP Setting </span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->can('site.menu'))
                <li class="nav-item">
                    <a href="{{ route('site.setting') }}" class="nav-link">
                        <i class="link-icon" data-feather="monitor"></i>
                        <span class="link-title">Site Setting </span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->can('role.menu'))
                <li class="nav-item nav-category">Role & Permission</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#role" role="button"
                        aria-expanded="false" aria-controls="role">
                        <i class="link-icon" data-feather="user-check"></i>
                        <span class="link-title">Role & Permission</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="role">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('all.permission') }}" class="nav-link">All Permission</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('all.roles') }}" class="nav-link">All Roles</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('add.roles.permission') }}" class="nav-link">Role in Permission
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('all.roles.permission') }}" class="nav-link">All Role in Permission
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button" aria-expanded="false"
                    aria-controls="admin">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Manage Admin User</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="admin">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.admin') }}" class="nav-link">All Admin</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('add.admin') }}" class="nav-link">Add Admin</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item nav-category">Docs</li>
            <li class="nav-item">
                <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

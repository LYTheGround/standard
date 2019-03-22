<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu m-b-30">
            <ul>
                <li class="submenu btn-mobil">
                    <a href="#">
                        <img style="padding-bottom: 3px;"
                             src="{{ asset((app()->isLocale('ar')) ? 'img/flags/ar.png':'img/flags/fr.png') }}"
                             width="20"
                             alt=""> <span> {{ (app()->isLocale('ar')) ? 'AR':'FR' }}</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;" id="lang-switcher">
                        <li><a href="#" data-lang="fr">FR</a></li>
                        <li><a href="#" data-lang="ar">AR</a></li>
                    </ul>
                </li>
                <li class="menu-title">Company</li>
                <li class="{{ (request()->is('')) ? 'active' : '' }}">
                    <a href="{{ route('home') }}">{{ __('validation.attributes.dashboard') }}</a>
                </li>
                <li class="{{ (request()->is('token') || request()->is('token/*')) ? 'active' : '' }}">
                    <a href="{{ route('token.index') }}">{{ __('token.tokens') }}</a>
                </li>
                <li class="menu-title">RH</li>
                <li class="{{ (request()->is('member') || request()->is('member/*')) ? 'active' : '' }}">
                    <a href="{{ route('member.index') }}">{{ __('rh/member.members') }}</a>
                </li>
                <li class="{{ (request()->is('position') || request()->is('position/*')) ? 'active' : '' }}">
                    <a href="{{ route('position.index') }}">{{ __('rh/position.positions') }}</a>
                </li>
                <li class="menu-title">Storage</li>
                <li class="{{ (request()->is('product') || request()->is('product/*')) ? 'active' : '' }}">
                    <a href="{{ route('product.index') }}">{{ __('storage/product.products') }}</a>
                </li>
                <li class="menu-title">Deals</li>
                <li class="{{ (request()->is('deal') || request()->is('deal/*')) ? 'active' : '' }}">
                    <a href="{{ route('deal.index') }}">{{ __('deal/deal.deals') }}</a>
                </li>
                <li class="menu-title">Trade</li>
                <li class="{{ (request()->is('buy') || request()->is('buy/*')) ? 'active' : '' }}">
                    <a href="{{ route('buy.index') }}">{{ __('buy/buy.buys') }}</a>
                </li>
                <li class="{{ (request()->is('sale') || request()->is('sale/*')) ? 'active' : '' }}">
                    <a href="{{ route('sale.index') }}">Liste des ventes</a>
                </li>
                <li class="menu-title">Money</li>
                <li class="{{ (request()->is('term') || request()->is('term/*')) ? 'active' : '' }}">
                    <a href="{{ route('term.index') }}">{{ __('terms') }}</a>
                </li>
                <li class="{{ (request()->is('unload') || request()->is('unload/*')) ? 'active' : '' }}">
                    <a href="{{ route('unload.index') }}">{{ __('unload') }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>

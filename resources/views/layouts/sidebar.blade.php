<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ active_path() }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item {{ open_segment(2, 'users') }}">
                <a href="#" class="nav-link {{ active_segment(2, 'users') }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Admin Management
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ active_path('users') }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List</p>
                    </a>

                    <li class="nav-item">
                      <a href="{{ route('users.create') }}" class="nav-link {{ active_path('users/create') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                      </a>
                    </li>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ open_segment(2, 'categories') }}">
                <a href="#" class="nav-link {{ active_segment(2, 'categories') }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>
                    Category Management
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ active_path('categories') }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List</p>
                    </a>

                    <li class="nav-item">
                      <a href="{{ route('categories.create') }}" class="nav-link {{ active_path('categories/create') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                      </a>
                    </li>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ open_segment(2, 'banks') }}">
                <a href="#" class="nav-link {{ active_segment(2, 'banks') }}">
                  <i class="nav-icon fas fa-landmark"></i>
                  <p>
                    Bank Management
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('banks.index') }}" class="nav-link {{ active_path('banks') }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List</p>
                    </a>

                    <li class="nav-item">
                      <a href="{{ route('banks.create') }}" class="nav-link {{ active_path('banks/create') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                      </a>
                    </li>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ open_segment(2, 'wallets') }}">
                <a href="#" class="nav-link {{ active_segment(2, 'wallets') }}">
                  <i class="nav-icon fas fa-wallet"></i>
                  <p>
                    Wallet Management
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('wallets.index') }}" class="nav-link {{ active_path('wallets') }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List</p>
                    </a>

                    <li class="nav-item">
                      <a href="{{ route('wallets.create') }}" class="nav-link {{ active_path('wallets/create') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                      </a>
                    </li>
                  </li>
                </ul>
              </li>

              <li class="nav-item {{ open_segment(2, 'transactions') }}">
                <a href="#" class="nav-link {{ active_segment(2, 'transactions') }}">
                  <i class="nav-icon fas fa-wallet"></i>
                  <p>
                    Expense
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('transactions.index') }}" class="nav-link {{ active_path('transactions') }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>List</p>
                    </a>

                    <li class="nav-item">
                      <a href="{{ route('transactions.create') }}" class="nav-link {{ active_path('transactions/create') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create</p>
                      </a>
                    </li>
                  </li>
                </ul>
              </li>


              <li class="nav-item">
                <a href="{{ route('exchange-transactions') }}" class="nav-link {{ active_path('exchange-transactions') }}">
                  <i class="nav-icon fa fa-exchange-alt"></i>
                  <p>
                    Exchange
                  </p>
                </a>
              </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
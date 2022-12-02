<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{  auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
 
          <li class="nav-item">
            <a href="{{ route('admin.adminPanelSetting.index') }}" class="nav-link fas fa-th-large">
              
              <p>
                الضبط العام
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.treasuries.index') }}" class="nav-link fas fa-th-large">
              
              <p>
                بيانات الخزن 
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.sales_matrial_types.index') }}" class="nav-link fas fa-th-large">
              
              <p>
                بيانات فئات الفواتير 
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.stores.index') }}" class="nav-link fas fa-th-large">
              
              <p>
                بيانات  المخازن 
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.uoms.index') }}" class="nav-link fas fa-th-large">
              
              <p>
                بيانات  الوحدات 
                
              </p>
            </a>
          </li>
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>
      
              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>
      
              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
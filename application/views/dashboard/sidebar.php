 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="<?php echo $this->config->config['base_url'] ?>" class="brand-link">
         <img src="<?php echo $this->config->config['base_url'] . 'assets/logo.png'; ?>" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">PerPus</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="info">
                 <span class="d-block text-white"><?php if (isset($admin->fullname)) echo ucfirst($admin->fullname) ?></span>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="<?php echo $this->config->config['base_url'] ?>" class="nav-link">
                         <i class="nav-icon fas fa-home"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo $this->config->config['base_url'] . 'mahasiswa' ?>" class="nav-link">
                         <i class="nav-icon fas fa-user"></i>
                         <p>
                             Mahasiswa
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo $this->config->config['base_url'] . 'buku' ?>" class="nav-link">
                         <i class="nav-icon fas fa-book"></i>
                         <p>
                             Buku
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo $this->config->config['base_url'] . 'penerbit' ?>" class="nav-link">
                         <i class="nav-icon fas fa-upload"></i>
                         <p>
                             Penerbit
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo $this->config->config['base_url'] . 'peminjaman' ?>" class="nav-link">
                         <i class="nav-icon fas fa-shopping-bag"></i>
                         <p>
                             Peminjaman
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo $this->config->config['base_url'] . 'login/signout' ?>" class="nav-link">
                         <i class="nav-icon fas fa-sign-out-alt"></i>
                         <p>
                             Logout
                         </p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
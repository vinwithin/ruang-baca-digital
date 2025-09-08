 <nav class="navbar navbar-expand-lg" id="navigasi">
     <div class="d-flex justify-content-center align-items-center gap-3">
         <a href="#" class="navbar-brand d-flex align-items-center">
             <img src="/assets/logo.png" alt="Logo" style="height: 60px;">
         </a>
         <div class="d-flex flex-column">
             <h1 class="fs-6 mb-0 fw-bold">Ruang Baca Digital</h1>
             <h1 class="fs-6 fw-bold">Fakultas Sains dan Teknologi</h1>
         </div>
     </div>


     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
         aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse " id="navbarNav">
         <ul class="navbar-nav me-auto gap-5 ">
             <li class="nav-item ">
                 <a class="nav-link text-dark" href="/">Beranda</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link text-dark " href="/program-studi">Jenis Koleksi</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link text-dark " href="/layanan">Layanan</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link text-dark " href="/berita">Berita</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link text-dark " href="/#galeri">Tentang</a>
             </li>

         </ul>

         <div class="ms-auto" id="button-login">
             @guest
                 <a href="/login" class="fw-semibold">
                     Masuk <i class="fa-solid fa-arrow-right ms-2"></i>
                 </a>
             @endguest

             @auth
                 <a href="/dashboard" class="fw-semibold">
                     Masuk <i class="fa-solid fa-arrow-right ms-2"></i>
                 </a>
             @endauth


         </div>
     </div>

 </nav>
 <hr class="navbar-line">

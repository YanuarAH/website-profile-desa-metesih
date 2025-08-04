@extends('layouts.app')

@section('content')
    <!-- Bagian Hero -->
    <section class="relative h-[500px] bg-cover bg-center flex items-center justify-center text-white"
        style="background-image: url('{{ asset('images/home/unnamed.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center space-y-4 px-4">
            <h2 class="text-3xl md:text-5xl font-bold">Selamat Datang di Desa Metesih</h2>
            <p class="text-lg md:text-xl">Sumber informasi terbaru tentang pemerintahan di Desa Metesih</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
                <a href="{{ route('profil-desa') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                    Profil Desa
                </a>
                <a href="{{ route('pemerintahan-desa') }}" 
                   class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                    Pemerintahan Desa
                </a>
            </div>
        </div>
    </section>

    <!-- Statistik Desa -->
    {{-- (Bagian Statistik Desa tidak diubah, biarkan seperti semula) --}}
    
    <!-- Bagian Berita Terkini -->
    <section class="py-12 px-4 md:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h3 class="text-blue-600 text-lg font-semibold mb-2">Informasi Terbaru</h3>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Berita Terkini Desa</h2>
            </div>
            
            {{-- Panggil partial grid berita di sini --}}
            @include('components.berita-grid', ['beritas' => $latestBeritas])
            
            @if ($latestBeritas->count() > 0)
                <div class="mt-12 text-center">
                    <a href="{{ route('berita') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition-colors inline-flex items-center">
                        Lihat Semua Berita
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

     <!-- Bagian Galeri Foto (Diperbarui) -->
    <section class="py-12 px-4 md:px-6 lg:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h3 class="text-purple-600 text-lg font-semibold mb-2">Dokumentasi Kegiatan</h3>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Galeri Foto Desa</h2>
            </div>
            
            {{-- Memanggil komponen grid galeri --}}
            @include('components.galeri-grid', ['galeris' => $latestGaleris])
            
            @if ($latestGaleris->count() > 0)
                <div class="mt-12 text-center">
                    <a href="{{ route('galeri-desa') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition-colors inline-flex items-center">
                        Lihat Semua Foto
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Quick Links / Layanan -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 md:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h3 class="text-blue-600 text-lg font-semibold mb-2">Layanan Kami</h3>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Akses Cepat Informasi</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="{{ route('profil-desa') }}" 
                   class="bg-white rounded-lg shadow-md p-8 hover:shadow-lg transition-all duration-300 group text-center">
                    <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-200 transition-colors">
                        <svg class="w-10 h-10 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd"/>
                        </svg>

                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors">Profil Desa</h3>
                    <p class="text-gray-600">Informasi lengkap tentang sejarah, visi misi, dan potensi desa Metesih</p>
                </a>
                
                <a href="{{ route('pemerintahan-desa') }}" 
                   class="bg-white rounded-lg shadow-md p-8 hover:shadow-lg transition-all duration-300 group text-center">
                    <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-green-200 transition-colors">
                        <svg class="w-10 h-10 text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3 group-hover:text-green-600 transition-colors">Pemerintahan Desa</h3>
                    <p class="text-gray-600">Struktur organisasi dan perangkat pemerintah desa yang melayani masyarakat</p>
                </a>
                
                <a href="#" 
                   class="bg-white rounded-lg shadow-md p-8 hover:shadow-lg transition-all duration-300 group text-center">
                    <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-purple-200 transition-colors">
                        <svg class="w-10 h-10 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3 group-hover:text-purple-600 transition-colors">Galeri Foto</h3>
                    <p class="text-gray-600">Kumpulan foto kegiatan dan keindahan desa Metesih</p>
                </a>
            </div>
        </div>
    </section>
@endsection

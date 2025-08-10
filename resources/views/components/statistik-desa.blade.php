{{--
    File: resources/views/components/_statistik-desa.blade.php
    Variabel yang dibutuhkan: $profil (objek ProfilDesa)
--}}
<section class="py-12 px-4 md:px-6 lg:px-8 bg-white">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-10">
            <h3 class="text-blue-600 text-lg font-semibold mb-2">Data Demografi</h3>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Statistik Desa Metesih</h2>
        </div>

        @if($profil)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                {{-- Total Penduduk --}}
                <div class="bg-blue-50 rounded-lg p-6 text-center shadow-sm border border-blue-200">
                    <div class="text-blue-600 mb-3">
                        <svg class="w-10 h-10 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4a4 4 0 100 8 4 4 0 000-8zM6 15a6 6 0 016-6h0a6 6 0 016 6v2a2 2 0 01-2 2H8a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-blue-800">Total Penduduk</h3>
                    <p class="text-3xl font-bold text-blue-900 mt-2">{{ number_format($profil->jumlah_penduduk ?? 0) }}</p>
                    <p class="text-sm text-blue-700">Jiwa</p>
                </div>

                {{-- Total Kepala Keluarga --}}
                <div class="bg-green-50 rounded-lg p-6 text-center shadow-sm border border-green-200">
                    <div class="text-green-600 mb-3">
                        <svg class="w-10 h-10 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-green-800">Total Kepala Keluarga</h3>
                    <p class="text-3xl font-bold text-green-900 mt-2">{{ number_format($profil->jumlah_kk ?? 0) }}</p>
                    <p class="text-sm text-green-700">KK</p>
                </div>

                {{-- Luas Wilayah --}}
                <div class="bg-purple-50 rounded-lg p-6 text-center shadow-sm border border-purple-200">
                    <div class="text-purple-600 mb-3">
                        <svg class="w-10 h-10 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-purple-800">Luas Wilayah</h3>
                    <p class="text-3xl font-bold text-purple-900 mt-2">{{ $profil->luas_wilayah ?? 'N/A' }}</p>
                    <p class="text-sm text-purple-700">Hektar</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Grafik Distribusi Penduduk --}}
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Distribusi Penduduk Berdasarkan Jenis Kelamin</h3>
                    <div class="relative h-64">
                        <canvas id="populationChart"></canvas>
                    </div>
                    <div class="flex justify-center gap-4 mt-4 text-sm text-gray-700">
                        <p><span class="inline-block w-3 h-3 rounded-full bg-blue-500 mr-1"></span> Laki-laki: {{ number_format($profil->penduduk_lk ?? 0) }}</p>
                        <p><span class="inline-block w-3 h-3 rounded-full bg-pink-500 mr-1"></span> Perempuan: {{ number_format($profil->penduduk_pr ?? 0) }}</p>
                    </div>
                </div>

                {{-- Grafik Distribusi Kepala Keluarga --}}
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Distribusi Kepala Keluarga Berdasarkan Jenis Kelamin</h3>
                    <div class="relative h-64">
                        <canvas id="kkChart"></canvas>
                    </div>
                    <div class="flex justify-center gap-4 mt-4 text-sm text-gray-700">
                        <p><span class="inline-block w-3 h-3 rounded-full bg-teal-500 mr-1"></span> Laki-laki: {{ number_format($profil->kk_lk ?? 0) }}</p>
                        <p><span class="inline-block w-3 h-3 rounded-full bg-orange-500 mr-1"></span> Perempuan: {{ number_format($profil->kk_pr ?? 0) }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="col-span-full text-center py-12 bg-white rounded-lg shadow-md border-2 border-dashed border-gray-300">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-600 mb-2">Data Profil Desa Belum Tersedia</h3>
                <p class="text-gray-500">Silakan tambahkan data profil desa melalui halaman admin.</p>
            </div>
        @endif
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilData = {
            penduduk_lk: {{ $profil->penduduk_lk ?? 0 }},
            penduduk_pr: {{ $profil->penduduk_pr ?? 0 }},
            kk_lk: {{ $profil->kk_lk ?? 0 }},
            kk_pr: {{ $profil->kk_pr ?? 0 }}
        };

        // Chart for Population Gender Distribution
        const populationCtx = document.getElementById('populationChart');
        if (populationCtx && (profilData.penduduk_lk > 0 || profilData.penduduk_pr > 0)) {
            new Chart(populationCtx, {
                type: 'pie',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [profilData.penduduk_lk, profilData.penduduk_pr],
                        backgroundColor: ['#3B82F6', '#EC4899'], // Blue for male, Pink for female
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Hide default legend, we have custom one
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += new Intl.NumberFormat('id-ID').format(context.parsed) + ' Jiwa';
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        } else if (populationCtx) {
            // Display a message if no data for chart
            populationCtx.closest('div').innerHTML = '<div class="text-center text-gray-500 py-8">Data penduduk belum tersedia.</div>';
        }

        // Chart for Household Head Gender Distribution
        const kkCtx = document.getElementById('kkChart');
        if (kkCtx && (profilData.kk_lk > 0 || profilData.kk_pr > 0)) {
            new Chart(kkCtx, {
                type: 'pie',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [profilData.kk_lk, profilData.kk_pr],
                        backgroundColor: ['#10B981', '#F97316'], // Teal for male, Orange for female
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Hide default legend, we have custom one
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += new Intl.NumberFormat('id-ID').format(context.parsed) + ' KK';
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        } else if (kkCtx) {
            // Display a message if no data for chart
            kkCtx.closest('div').innerHTML = '<div class="text-center text-gray-500 py-8">Data kepala keluarga belum tersedia.</div>';
        }
    });
</script>

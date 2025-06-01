@extends('layouts.app')

@section('content')
<style>
    .input-field {
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .input-field:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .file-input {
        opacity: 0;
        width: 0.1px;
        height: 0.1px;
        position: absolute;
    }

    .tab-button {
        transition: all 0.3s ease;
        position: relative;
    }

    .tab-button.active {
        color: #3b82f6;
        font-weight: 500;
    }

    .tab-button.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 2px;
        background: #3b82f6;
    }

    .verification-badge {
        background-color: #10b981;
        color: white;
    }
</style>

    <!-- Main Content -->
<main class="min-h-screen pt-24 pb-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- TITLE -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-[#1f2d4e] mb-3">Edit Profil</h1>
            <p class="text-gray-600">Kelola informasi profil dan pengaturan akun Anda</p>
        </div>

        <!-- PROFILE CARD -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
            <!--  SUBTITLE -->
            <div class="flex border-b border-gray-200 mb-6">
                <button id="profileTab" class="tab-button active px-4 py-2 text-gray-600 mr-4">
                    Profil
                </button>
                <button id="securityTab" class="tab-button px-4 py-2 text-gray-600">
                    Keamanan
                </button>
            </div>

            <!-- EDIT PROFIL -->
            <div id="profileTabContent" class="space-y-6">
                <form action="{{route('user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method ('PUT')
                    <!-- INPUT FOTO PROFIL -->
                    <div class="flex flex-col items-center mb-8">
                        <div class="relative mb-4">
                            <img id="profilePreview" src="{{ Auth::user()->foto_profil!= 'fotoprofil.jpg' ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?background=3b82f6&color=fff'}}" alt="Profil"
                                class="transition hover:scale-105 w-32 h-32 rounded-full border-1 border-white shadow-lg">
                            <div class="absolute inset-[5px] top-2 right-2 rounded-full p-2 shadow cursor-pointer">
                                <label for="foto_profil" class="cursor-pointer"><i class="fa-solid fa-camera fa-lg text-blue-500"></i>
                                    <input type="file" id="foto_profil" name="foto_profil" accept="image/*"
                                        class="file-input"/>
                                </label>
                            </div>
                        </div>
                        <label for="foto_profil"
                            class="text-sm text-blue-600 font-medium cursor-pointer hover:text-blue-700">
                            Ganti Foto Profil
                        </label>
                    </div>
                    <!-- ./INPUT FOTO PROFIL -->

                    <!-- INFO PROFIL USER -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div>
                            <x-input label="Nama Lengkap*" id="nama" name="nama" type="text" value="{{$user->nama}}" placeholder="Masukkan Nama Lengkap Anda" :autofocus="true"/>
                        </div>
    
                        <!-- Email -->
                        <div>
                            <x-input placeholder="Masukkan Email Anda" label="Email*" id="email" name="email" type="email" value="{{$user->email}}"/>
                            <div class="mt-1 flex items-center">
                                <x-badge status="verified"></x-badge>
                                <button class="ml-2 text-xs text-blue-600 hover:text-blue-800">Ganti Email</button>
                            </div>
                        </div>
    
                        <!-- Whatsapp -->
                        <div>
                            <x-input label="Nomor Whatsapp*" id="whatsapp" name="whatsapp" type="tel"  value="{{$user->whatsapp}}" placeholder="6280122002"/>
                        </div>
                    </div>
    
                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea id="bio" name="bio" rows="2" class="input-field w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm" placeholder="Ceritakan sedikit tentang diri Anda">{{$user->bio}}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Maksimal 150 karakter</p>
                    </div>
    
                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap*</label>
                        <textarea id="alamat" name="alamat" rows="3" required
                            class="input-field w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm"
                            placeholder="Alamat lengkap (termasuk asrama/kos jika ada)">{{$user->alamat }}</textarea>
                    </div>
    
                    <!-- Instagram -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="instagram"
                                class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    @
                                </span>
                                <x-input id="instagram" name="instagram" type="text" placeholder="username instagram anda" value="{{$user->instagram}}"/>
                            </div>
                        </div>
                    </div>

                <!-- Photo Upload Section -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 mt-8">
                        <x-button type="button" href="{{ route('user.dashboard') }}" color="danger">
                            Batal
                        </x-button>
                        <x-button type="submit" color="primary">
                            Simpan Perubahan
                        </x-button>
                    </div>
                </form>
            </div>

            <!-- EDIT PASSWORD -HIDDEN- -->
            <div id="securityTabContent" class="space-y-6 hidden">
                <div>
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Keamanan Akun</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                            <div>
                                <h4 class="font-medium text-gray-800">Kata Sandi</h4>
                            </div>
                            <x-button type="button" onclick="openPasswordModal()" color="secondary">Ubah</x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- MODAL EDIT PASSWORD -HIDDEN- -->
<div id="passwordModal" class="fixed inset-0 bg-black/50 items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md">
      <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Ubah Kata Sandi</h3>
            <button onclick="closePasswordModal()" class="text-gray-400 hover:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="{{ route('user.password.update', ['user' => $user->id]) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <x-input label="Kata Sandi Saat Ini" id="currentPassword" name="currentPassword" type="password" :autofocus="true"/>
            </div>
            <div>
                <x-input label="Kata Sandi Baru" id="newPassword" name="newPassword" type="password"/>
                <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter, huruf besar, kecil, dan angka</p>
            </div>
            <div>
                <x-input id="confirmNewPassword" name="confirmNewPassword" type="password" label="Konfirmasi Kata Sandi Baru"/>
            </div>
            <div class="flex justify-end space-x-3 pt-4">
                <x-button type="button" onclick="closePasswordModal()" color="secondary">
                    Batal
                </x-button>
                <x-button type="submit" color="primary">
                    Simpan
                </x-button>
            </div>
        </form>
    </div>
</div>

@if(session('showPasswordModal') || $errors->has('currentPassword') || $errors->has('newPassword') || $errors->has('confirmNewPassword'))
<script>
    window.addEventListener('DOMContentLoaded', function() {
        openPasswordModal();
    });
</script>
@endif

<script>
    // Tab switching
const profileTab = document.getElementById('profileTab');
const securityTab = document.getElementById('securityTab');
const profileTabContent = document.getElementById('profileTabContent');
const securityTabContent = document.getElementById('securityTabContent');

profileTab.addEventListener('click', () => {
    profileTab.classList.add('active');
    securityTab.classList.remove('active');
    profileTabContent.classList.remove('hidden');
    securityTabContent.classList.add('hidden');
});

securityTab.addEventListener('click', () => {
    profileTab.classList.remove('active');
    securityTab.classList.add('active');
    profileTabContent.classList.add('hidden');
    securityTabContent.classList.remove('hidden');
});

// Password modal functions
function openPasswordModal() {
    const modal = document.getElementById('passwordModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closePasswordModal() {
    const modal = document.getElementById('passwordModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Profile photo preview
document.getElementById('foto_profil').addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('profilePreview').src = event.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
@endsection
